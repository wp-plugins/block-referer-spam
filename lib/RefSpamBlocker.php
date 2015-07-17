<?php

/**
 * RefSpamBlocker
 *
 * @author codestic <hello@codestic.com>
 */

class RefSpamBlocker {

    public function __construct($pluginFile) {
        // load text domain
        load_textdomain('ref-spam-blocker', REFSPAMBLOCKER_PATH . 'lang/ref-spam-blocker-' . get_locale() . '.mo');

        // register activation
        register_activation_hook($pluginFile, [&$this, 'activate']);

        // add actions
        add_action('init', [&$this, 'init']);
        add_action('admin_init', [$this, 'registerSettings']);
        add_action('dailyCronjob', [$this, 'dailyCronjob']);
        add_action('wp', [&$this, 'pageLoad']);

        add_action('wp_logout', [$this, 'logout']);
        add_action('wp_login', [$this, 'logout']);
    }

    /**
     * activate()
     */
    public function activate() {
        // schedule daily update
        wp_schedule_event(time(), 'daily', 'dailyCronjob');
    }

    /**
     * init()
     */
    public function init() {
        // init
        add_action('admin_menu', [&$this, 'createMenu']);

        if (!session_id()) {
            session_start();
        }
    }

    /**
     * createMenu()
     * Create Admin Menu
     */
    public function createMenu() {
        $hook = add_menu_page(
            __('Block Referer Spam'),
            __('Referer Spam'),
            'manage_options',
            'ref-spam-block/',
            [&$this, 'adminDashboard'],
            'dashicons-shield-alt'
        );

        add_action("load-{$hook}", [&$this, 'updateSettings']);
    }

    /**
     * registerSettings()
     */
    public function registerSettings() {
        register_setting('ref-spam-block-settings', 'ref-spam-auto-update');
        register_setting('ref-spam-block-settings', 'ref-spam-custom-blocks');
        register_setting('ref-spam-block-settings', 'ref-spam-block-mode');
    }

    /**
     * updateSettings()
     */
    public function updateSettings() {

        // download
        if (isset($_GET['download']) && $_GET['download'] == 'true') {
            if ($this->downloadList()) {
                $_SESSION['ref-spam-block-flash'] = 'list-updated';
                header('Location: admin.php?page=ref-spam-block');

            } else {
                $_SESSION['ref-spam-block-flash'] = 'list-not-updated';
                header('Location: admin.php?page=ref-spam-block&downloaded=false');
            }
            exit;

        } elseif (isset($_GET['settings-updated']) && $_GET['settings-updated']) {
            // @todo: check custom blocks here not to mess up the users .htaccess / rewrite rules
            // $customBlocks = get_option('ref-spam-custom-blocks'');

            // get block mode
            $blockMode = get_option('ref-spam-block-mode', 'rewrite');

            if ($blockMode == 'rewrite') {
                // update htaccess
                $this->updateHtaccess();

            } else {
                // reset htaccess
                $this->resetHtaccess();
            }
        }
    }

    /*
     * updateHtaccess()
     */
    private function updateHtaccess() {
        // htaccess path
        $htaccess = get_home_path() . '.htaccess';

        // build lines
        $lines = [];
        $lines[] = '<IfModule mod_rewrite.c>';
        $lines[] = '  RewriteEngine on';

        // load list into array
        $list = $this->getList();

        foreach ($list as $host) {
            $lines[] = '  RewriteCond %{HTTP_REFERER} ' . str_replace('.', '\.', $host);
        }

        $lines[] = '  RewriteRule .* - [F]';
        $lines[] = '</IfModule>';

        // update htaccess
        insert_with_markers($htaccess, 'Referer Spam Blocker', $lines);
    }

    /**
     * resetHtaccess()
     * @return bool
     */
    private function resetHtaccess() {
        // htaccess path
        $htaccess = get_home_path() . '.htaccess';

        // load htaccess
        $content = file_get_contents($htaccess);

        // define tags
        $startTag = '# BEGIN Referer Spam Blocker';
        $endTag = '# END Referer Spam Blocker';

        if (strpos($content, $startTag) === false) {
            return false;
        }

        $startPos = strpos($content, $startTag);
        $endPos = strpos($content, $endTag);
        $textToDelete = substr($content, $startPos, ($endPos + strlen($endTag)) - $startPos);

        $content = str_replace($textToDelete, '', $content);

        $content = trim($content);

        file_put_contents($htaccess, $content);

        return true;
    }

    /**
     * pageLoad()
     * Function responsible for blocking in "WordPress" mode.
     *
     * @return bool
     */
    public function pageLoad() {
        // check block mode
        if (get_option('ref-spam-block-mode') != 'wordpress') {
            return false;
        }

        // get domain
        $domain = str_ireplace('www.', '', parse_url($_SERVER['HTTP_REFERER'], PHP_URL_HOST));

        // get list
        $list = $this->getList();

        foreach ($list as $host) {
            if (strpos($domain, $host) !== false) {
                header('HTTP/1.0 403 Forbidden');
                echo 'You are forbidden from accessing this website.<br>' .
                    'Powered by <a href="' . REFSPAMBLOCKER_PLUGIN_URL . '">Referer Spam Blocker</a>.';
                exit;
            }
        }

        return true;
    }

    /**
     * downloadList()
     * Function responsible to download the referer spam list
     *
     * @return bool
     */
    private function downloadList() {
        // download list
        $list = @file_get_contents(REFSPAMBLOCKER_LIST_URL);

        if (!$list) {
            return false;
        }

        // save list
        update_option('ref-blocker-list', $list);

        // save last updated stamp
        update_option('ref-blocker-updated', time());

        return true;
    }

    /**
     * getList()
     * Function responsible to return a clear, merged list of referers
     *
     * @return array
     */
    private function getList() {
        // get original list
        $list = preg_split('/[\n\r]+/', get_option('ref-blocker-list'));

        // get custom blocks
        $customBlocks = preg_split('/[\n\r]+/', get_option('ref-spam-custom-blocks'));

        // combine arrays
        $list = array_merge($list, $customBlocks);

        // clean up
        $list = array_filter($list);

        return $list;
    }

    /**
     * adminDashboard
     */
    public function adminDashboard() {
        include(dirname(__FILE__) . '/../admin/dashboard.php');
    }

    /**
     * dailyCronjob
     * Executed daily to update list and htaccess file
     */
    public function dailyCronjob() {
        // download list
        $this->downloadList();

        // update htaccess if necessary
        if (get_option('ref-spam-block-mode', 'rewrite') == 'rewrite') {
            $this->updateHtaccess();
        }
    }

    /**
     * Destroy session data when logging out
     */
    public function logout() {
        session_destroy();
    }
}