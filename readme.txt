=== Block Referer Spam ===
Contributors: codestic
Tags: spam, referer, referrer, blocker, semalt, buttons-for-website, floating-share-buttons, 4webmaster, ilovevitaly, referal, referral, analytics, analytics spam, referer spam, referrer spam, referal spam, referral spam, blacklist, block, blocker, protector, protect, domain, anti referer, anti referrer, anti referral, block analytics, anti-spam, antispam, spambot, spam-bot, spam bot, bot block, googlespam, google spam, seo spam, seo, block spam, apache, spammers, referer attack, referrer attach, referral attack, referer blockieren, referrer blockieren, spam blockieren, domain blockieren, bot, nospam, spam security, wp-spamfree, domain direct, bot redirect, spam redirect, spam filter, bot filter, spam attack
Requires at least: 3.0.1
Tested up to: 4.2.2
Stable tag: 1.0.4
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Blocks referer spam from accessing your site and cleans up your Google Analytics in the process!

== Description ==

__Block Referer Spam__ aims at blocking all (or most) websites that use Referer Spam to promote their – often more than dodgy – website content. This is accomplished by bots that very successfully simulate human behavior. They do this so well, that they even show up in __Google Analytics__. This plugin does not need any further configuration. Once active and auto-update is enabled, you will barely see any of those nasty spammers any more.

From [Wikipedia](https://en.wikipedia.org/wiki/Referer_spam):

`Referrer spam (also known as log spam or referrer
bombing) is a kind of spamdexing (spamming aimed
at search engines). The technique involves making
repeated web site requests using a fake referer URL
to the site the spammer wishes to advertise. Sites that
publish their access logs, including referer statistics,
will then inadvertently link back to the spammer's site.
These links will be indexed by search engines
as they crawl the access logs.

This benefits the spammer because the free link improves
the spammer site's search engine ranking owing
to link-counting algorithms that search engines use.`

__Features__

* Automatic or manual updates of referer spam list
* Option of adding custom referer spam hosts
* Two methods of blocking: mod_rewrite or WordPress based

__Examples Blocked__

* semalt
* buttons-for-website
* floating-share-buttons
* 4webmaster
* ilovevitaly
* ... and many more!

If you think you found a bug in Referer Spam Blocker, please contact me and I should be able to fix it within 48 hours. Further, if you want to contribute, feel free!

Moreover, if you have issues with this plugin, please contact me over my website or the support forum here.

Anything else, please get in touch!

Rob / codestic.com


== Screenshots ==

1. Admin Interface

== Installation ==

To install Block Referer Spam and start cleaning up your Google Analytics:

1. Install Block Referer Spam automatically or by uploading the ZIP file.
2. Activate the plugin through the 'Plugins' menu in WordPress.
3. Block Referer Spam is now activated. Go to the "Referer Spam" menu and start review your options.
3. You are not protected!

__Using WP-CLI__
`wp plugin install block-referer-spam --activate`

== Frequently Asked Questions ==

= What sites are blocked? =

To give you the least of an headache, this plugin is not using one, but indeed several sources of referer spam lists. Our severs merge multiple lists every couple hours to provide you with the best possible protection.

= I still see those websites in my statistics! =

This plugin will not remove existing Google Analytics Spam. What it will do is block further spam from being logged. You can however filter out those websites, a good tutorial for this is here: https://megalytic.com/blog/how-to-filter-out-fake-referrals-and-other-google-analytics-spam.

= I tested my site and those referers can still access my site! =

This can basically have three reasons.

1. The site is not blocked by our list. The list is updated multiple times a day (every 6 hours) and chances are, the site will be on it very soon. If not, try custom blocks.
2. Some plugins interfere with the "Rewrite" block mode on server side level. Examples for these are caching plugins, that not always work. In this case, use the "WordPress" block mode instead.
3. While using the "Rewrite" block mode is faster, you may cannot write to your servers .htaccess file, in this case please use the "WordPress" block mode instead.

= I found a bug! =

This is my first openly available WordPress Plugin. While I wrote many for clients of mine, none ever had the exposure of this one. If you find a bug, please report it either here or directly [on my website / email](http://codestic.com). I will always aim to fix the issue within 48 hours.

== Changelog ==

= 1.0.4 =
* Fixed the plugin to run on PHP versions lower than 5.4. It should now work on older providers and servers that have not been updated for a while.

= 1.0.3 =
* Fixed a bug that in "Rewrite Blocking", rules were not actually enforced. Sorry about that!

= 1.0.2 =

* Improved FAQs
* Added writable check for .htaccess
* Added WP-CLI installation instructions
* Added part of Wikipedia about referer spam

= 1.0.1 =

* Added German localization
* Updated screenshot and fixed typos
* Added frequently asked questions

= 1.0 =

* Initial version