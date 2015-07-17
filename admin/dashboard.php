<div class="wrap">
    <h2><?php _e('Block Referer Spam', 'ref-spam-blocker'); ?></h2>

    <?php if (isset($_GET['settings-updated'])) : ?>
        <div id="message" class="updated">
            <p><strong><?php _e('Settings saved.') ?></strong></p>
        </div>

    <?php elseif (isset($_SESSION['ref-spam-block-flash'])) : ?>
        <?php if ($_SESSION['ref-spam-block-flash'] == 'list-updated') : ?>
            <div id="message" class="updated">
                <p><strong><?php _e('List updated.') ?></strong></p>
            </div>

        <?php elseif ($_SESSION['ref-spam-block-flash'] == 'list-not-updated') : ?>
            <div id="message" class="error">
                <p><strong><?php _e('List failed to update.') ?></strong></p>
            </div>
        <?php endif; ?>
    <?php endif; ?>

    <div id="poststuff">
        <div id="post-body" class="metabox-holder columns-2">

            <!-- LEFT COLUMN -->
            <div id="post-body-content">
                <div class="meta-box-sortables ui-sortable">
                    <div class="postbox">
                        <div class="inside">
                            <form method="post" action="options.php">
                                <table class="form-table">
                                    <?php settings_fields('ref-spam-block-settings'); ?>
                                    <?php do_settings_sections('ref-spam-block-settings'); ?>

                                    <tbody>

                                    <!-- SETTINGS -->
                                    <tr>
                                        <th>
                                            <label><?php _e('Auto Update', 'ref-spam-blocker'); ?></label>
                                        </th>
                                        <td>
                                            <fieldset>
                                                <label>
                                                    <input type="radio" name="ref-spam-auto-update"
                                                           value="yes"<?php echo(get_option('ref-spam-auto-update', 'yes') == 'yes' ? ' checked="checked"' : '') ?>>
                                                    <span><?php _e('Yes, once daily', 'ref-spam-blocker'); ?></span>
                                                </label>

                                                <br>

                                                <label>
                                                    <input type="radio" name="ref-spam-auto-update"
                                                           value="no"<?php echo(get_option('ref-spam-auto-update') == 'no' ? ' checked="checked"' : '') ?>>
                                                    <span><?php _e('No, only manual', 'ref-spam-blocker'); ?></span>
                                                </label>
                                            </fieldset>
                                        </td>
                                    </tr>

                                    <tr>
                                        <th>
                                            <label><?php _e('Block Mode', 'ref-spam-blocker'); ?></label>
                                        </th>
                                        <td>
                                            <fieldset>
                                                <label>
                                                    <input type="radio" name="ref-spam-block-mode"
                                                           value="rewrite"<?php echo(get_option('ref-spam-block-mode', 'rewrite') == 'rewrite' ? ' checked="checked"' : '') ?>>
                                                    <span><?php _e('Rewrite Block', 'ref-spam-blocker'); ?></span>
                                                </label>

                                                <br>

                                                <label>
                                                    <input type="radio" name="ref-spam-block-mode"
                                                           value="wordpress"<?php echo(get_option('ref-spam-block-mode') == 'wordpress' ? ' checked="checked"' : '') ?>>
                                                    <span><?php _e('WordPress Block', 'ref-spam-blocker'); ?></span>
                                                </label>
                                            </fieldset>

                                            <p class="description">
                                                <?php _e('Rewrite Block is faster and occurs on the web-server level. If you run into problems (e.g. you cannot write your .htaccess file), use the WordPress Block instead.', 'ref-spam-blocker'); ?></p>
                                        </td>
                                    </tr>

                                    <!-- MANUAL UPDATE -->
                                    <tr>
                                        <th><label><?php _e('Manual Update', 'ref-spam-blocker'); ?></label></th>
                                        <td>
                                            <a href="admin.php?page=ref-spam-block&download=true"
                                               class="button button-secondary"><?php _e('Download Updates', 'ref-spam-blocker'); ?></a>

                                            <p class="description">
                                                <?php _e('Clicking this button will force an update of the referer spam list.', 'ref-spam-blocker'); ?>
                                            </p>
                                        </td>
                                    </tr>

                                    <tr>
                                        <th><label><?php _e('Last Update', 'ref-spam-blocker'); ?></label></th>
                                        <td>
                                            <p>
                                                <?php if (get_option('ref-blocker-updated') !== false) : ?>
                                                    <?php echo date(get_option('date_format') . ' ' . get_option('time_format'), get_option('ref-blocker-updated')); ?>
                                                <?php else : ?>
                                                    <?php _e('Never', 'ref-spam-blocker'); ?>
                                                <?php endif; ?>
                                            </p>
                                        </td>
                                    </tr>

                                    <!-- CUSTOM BLOCKS -->
                                    <tr>
                                        <th>
                                            <label
                                                for="custom-blocks"><?php _e('Custom Blocks', 'ref-spam-blocker'); ?></label>
                                        </th>
                                        <td>
                                                <textarea name="ref-spam-custom-blocks" id="custom-blocks" rows="8" cols="50"
                                                          placeholder="super-spammy-website.com"><?php echo esc_attr(get_option('ref-spam-custom-blocks')); ?></textarea>

                                            <p class="description">
                                                <?php esc_attr_e('If you find that the spammer list does not catch all sites you want to block, feel free to add more. Custom blocks may be reported back anonymously to our servers to improve the list.', 'ref-spam-blocker'); ?>
                                            </p>
                                        </td>
                                    </tr>

                                    </tbody>
                                </table>

                                <?php submit_button(); ?>
                            </form>

                        </div>
                    </div>
                </div>
            </div>

            <!-- RIGHT COLUMN -->
            <div id="postbox-container-1" class="postbox-container">
                <div class="meta-box-sortables">
                    <div class="postbox">
                        <h3><?php esc_attr_e('About the Plugin', 'ref-spam-blocker'); ?></h3>

                        <div class="inside">
                            <p><?php _e('<b>Block Referer Spam</b> aims at blocking all (or most) websites that use <a href="https://en.wikipedia.org/wiki/Referer_spam" target="_blank">Referer Spam</a> to promote their – often more than dodgy – website content.', 'ref-spam-blocker'); ?></p>

                            <p><?php _e('This is accomplished by bots that very successfully simulate human behavior. They do this so well, that they even show up in <b>Google Analytics.</b>', 'ref-spam-blocker'); ?></p>

                            <p><?php _e('This plugin does not need any further configuration. Once active and auto-update is enabled, you will barely see any of those nasty spammers any more.', 'ref-spam-blocker'); ?></p>

                            <p><?php _e('If you think you found a bug in <b>Block Referer Spam</b>, please contact me and I should be able to fix it within 48 hours.', 'ref-spam-blocker'); ?></p>
                        </div>
                    </div>

                    <div class="postbox">
                        <h3><?php esc_attr_e('About the Author', 'ref-spam-blocker'); ?></h3>

                        <div class="inside">
                            <p><?php _e('My name is Robin and I am a <b>Web Developer</b>, <b>UI/UX Designer</b> and <b>IT Consultant.</b>', 'ref-spam-blocker'); ?></p>

                            <p><?php _e('I am regularly available for interesting freelance projects. If you ever need my help, do not hesitate to get in touch.', 'ref-spam-blocker'); ?></p>

                            <p><?php _e('<b>Email:</b> <a href="mailto:hello@codestic.com">hello@codestic.com</a><br><b>Website:</b> <a href="http://codestic.com" target="_blank">codestic.com</a>', 'ref-spam-blocker'); ?></p>

                            <hr>

                            <img src="<?php echo plugins_url('assets/images/brand.png', dirname(__FILE__) . '../'); ?>"
                                 style="max-width: 100%">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br class="clear">
    </div>
</div>

<?php unset($_SESSION['ref-spam-block-flash']); ?>