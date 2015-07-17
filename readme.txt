=== Block Referer Spam ===
Contributors: codestic
Tags: spam, referer, referrer, blocker, semalt, buttons-for-website, floating-share-buttons, 4webmaster, ilovevitaly, referal, referral, analytics, analytics spam, referer spam, referrer spam, referal spam, referral spam
Requires at least: 3.0.1
Tested up to: 4.2.2
Stable tag: 1.0.1
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Blocks referer spam from accessing your site and cleans up your Google Analytics in the process!

== Description ==

__Block Referer Spam__ aims at blocking all (or most) websites that use Referer Spam to promote their – often more than dodgy – website content. This is accomplished by bots that very successfully simulate human behavior. They do this so well, that they even show up in __Google Analytics__. This plugin does not need any further configuration. Once active and auto-update is enabled, you will barely see any of those nasty spammers any more.

* Automatic or manual updates of referer spam list
* Option of adding custom referer spam hosts
* Two methods of blocking: mod_rewrite or WordPress based

Some of the sites blocked are:

* semalt
* buttons-for-website
* floating-share-buttons
* 4webmaster
* ilovevitaly
* ... any many more!

If you think you found a bug in Referer Spam Blocker, please contact me and I should be able to fix it within 48 hours. Further, if you want to contribute, feel free!

Moreover, if you have issues with this plugin, please contact me over my website or the support forum here.

---
Best Regards,

codestic.com

== Screenshots ==
1. Admin Interface

== Installation ==

Either download directly from the WordPress Plugin Repository or manually from GitHub and copy to your plugin directory.

== Frequently Asked Questions ==

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

= 1.0.1 =
* Added German localization
* Updated screenshot and fixed typos
* Added frequently asked questions

= 1.0 =
* Initial version