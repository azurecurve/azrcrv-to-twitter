=== To Twitter ===

Description:	Automate the sending of tweets from your ClassicPress site to Twitter.
Version:		1.16.1
Tags:			tweets,twitter,automatic 
Author:			azurecurve
Author URI:		https://development.azurecurve.co.uk/
Plugin URI:		https://development.azurecurve.co.uk/classicpress-plugins/to-twitter/
Download link:	https://github.com/azurecurve/azrcrv-to-twitter/releases/download/v1.16.1/azrcrv-to-twitter.zip
Donate link:	https://development.azurecurve.co.uk/support-development/
Requires PHP:	5.6
Requires:		1.0.0
Tested:			4.9.99
Text Domain:	to-twitter
Domain Path:	/languages
License: 		GPLv2 or later
License URI: 	http://www.gnu.org/licenses/gpl-2.0.html

Automate the sending of tweets from your ClassicPress site to Twitter.

== Description ==

# Description

To Twitter includes the following functionality;
 * Automatic tweeting of posts and pages to Twitter as they are published.
 * Automatic retweeting of posts and pages a user specified period of time after publication.
 * Scheduled tweeting of posts and pages on a randomly selected basis at a user specified date and time (each day separately configurable).
 * Automatic adding of hashtags to posts and pages (save draft before manually adding any required hashtags).
 * Automatic replacement of word or phrases with hashtags (for example, switch the word `ClassicPress` for `@GetClassicPress`).
 * Sending of manual tweets (including tweet threads).
 * Sending of scheduled tweets (including tweet threads) at a user specified date and time.
 * Support for four media images attached to a tweet from posts, pages, manual and scheduled tweets.
 * Integrates with [Short URLs](https://development.azurecurve.co.uk/classicpress-plugins/short-urls/) from [azurecurve](https://development.azurecurve.co.uk/classicpress-plugins/ for post and page addresses in tweets.
 * Retain and view tweet history.
 * Links to tweets on Twitter in tweet history.

As scheduled tweets rely on cron for processing, large images can cause timeouts. This can be mitigated by switching off the wp-cron and setting up a cron job on your web host control panel.

This plugin is multisite compatible with each site having its own settings.

== Installation ==

# Installation Instructions

* Download the plugin from [GitHub](https://github.com/azurecurve/azrcrv-to-twitter/releases/latest/).
* Upload the entire zip file using the Plugins upload function in your ClassicPress admin panel.
* Activate the plugin.
* Apply for a [Twitter Developer account](https://developer.twitter.com/en/apply-for-access).
* Create your Twitter application [here](https://developer.twitter.com/en/apps).
* Configure settings (including your Consumer API Keys and Access Token and Secret) via the configuration page in the admin control panel.

== Frequently Asked Questions ==

# Frequently Asked Questions

### Can I translate this plugin?
Yes, the .pot fie is in the plugins languages folder and can also be downloaded from the plugin page on https://development.azurecurve.co.uk; if you do translate this plugin, please sent the .po and .mo files to translations@azurecurve.co.uk for inclusion in the next version (full credit will be given).

### Is this plugin compatible with both WordPress and ClassicPress?
This plugin is developed for ClassicPress, but will likely work on WordPress.

== Changelog ==

# Changelog

### [Version 1.16.1](https://github.com/azurecurve/azrcrv-to-twitter/releases/tag/v1.16.1)
 * Fix missing icon.
 * Fix issue in uninstall.php file stopping plugin being uninstalled.
 
### [Version 1.16.0](https://github.com/azurecurve/azrcrv-to-twitter/releases/tag/v1.16.0)
 * Add tweet send status to all history.
 * Update post/page meta box to have separate tweet history section.
 * Update azurecurve menu.
 * Fix bug in display of tweet history page when no manual or scheduled tweets have been sent.
 * Fix bug in display of scheduled tweet page when no scheduled tweets are scheduled.
 * Fix bug in display of scheduled tweet history page when no scheduled tweets have been sent.
 * Fix bug where blank tweet sent if no random scheduled page or post could be found.

### [Version 1.15.1](https://github.com/azurecurve/azrcrv-to-twitter/releases/tag/v1.15.1)
 * Remove debug code.

### [Version 1.15.0](https://github.com/azurecurve/azrcrv-to-twitter/releases/tag/v1.15.0)
 * Add manual tweets to history (when option to record history is set).
 * Add link to Twitter for tweets on all history sections and pages.
 * Add thread support to manual tweets.
 * Add thread support to scheduled tweets.
 * Update send tweet to record id of sent tweet.
 * Fix bug with tweet of scheduled post tweet not recording history when tweet send failed.
 * Fix bug with tweet history either not recording full history or not displaying full history.

### [Version 1.14.1](https://github.com/azurecurve/azrcrv-to-twitter/releases/tag/v1.14.1)
 * Fix incorrect download link.
 
### [Version 1.14.0](https://github.com/azurecurve/azrcrv-to-twitter/releases/tag/v1.14.0)
 * Add image media upload to posts, pages, manual and scheduled tweets (up to four images supported).
 * Fix bug with empty array when reloading post.
 
### [Version 1.13.0](https://github.com/azurecurve/azrcrv-to-twitter/releases/tag/v1.13.0)
 * Add function to handle multilevel default options correctly.
 
### [Version 1.12.0](https://github.com/azurecurve/azrcrv-to-twitter/releases/tag/v1.12.0)
 * Fix plugin action link to use admin_url() function.
 * Rewrite option handling so defaults not stored in database on plugin initialisation.
 * Add plugin icon and banner.
 * Update azurecurve plugin menu.

### [Version 1.11.0](https://github.com/azurecurve/azrcrv-to-twitter/releases/tag/v1.11.0)
 * Add options to limit number of times a post/page can be automatically tweeted on a schedule.
 * Fix bug with selection of posts/pages to exclude from scheduled tweets.

### [Version 1.10.3](https://github.com/azurecurve/azrcrv-to-twitter/releases/tag/v1.10.3)
 * Fix bug with scheduled post tweet duplicating content.

### [Version 1.10.2](https://github.com/azurecurve/azrcrv-to-twitter/releases/tag/v1.10.2)
 * Fix bug with select of scheduled tweet.

### [Version 1.10.1](https://github.com/azurecurve/azrcrv-to-twitter/releases/tag/v1.10.1)
 * Fix bug with scheduled tweets not including post title.

### [Version 1.10.0](https://github.com/azurecurve/azrcrv-to-twitter/releases/tag/v1.10.0)
 * Add tweet history page (only shown when keep tweet history option set.

### [Version 1.9.1](https://github.com/azurecurve/azrcrv-to-twitter/releases/tag/v1.9.1)
 * Fix bug with tweet format when option not set.

### [Version 1.9.0](https://github.com/azurecurve/azrcrv-to-twitter/releases/tag/v1.9.0)
 * Add options for default post and page tweet formats.

### [Version 1.8.0](https://github.com/azurecurve/azrcrv-to-twitter/releases/tag/v1.8.0)
 * Add *All* to categories selection for scheduled posts.
 * Add tags for selection for scheduled posts.

### [Version 1.7.3](https://github.com/azurecurve/azrcrv-to-twitter/releases/tag/v1.7.3)
 * Fix bug with scheduled page tags joining onto URL.

### [Version 1.7.2](https://github.com/azurecurve/azrcrv-to-twitter/releases/tag/v1.7.2)
 * Fix bug with setting of default options.
 * Fix bug with plugin menu.
 * Update plugin menu css.
 * Add missing registration hooks to restart scheduled tasks.

### [Version 1.7.1](https://github.com/azurecurve/azrcrv-to-twitter/releases/tag/v1.7.1)
 * Rewrite default option creation function to resolve several bugs.
 * Upgrade azurecurve plugin to store available plugins in options.

### [Version 1.7.0](https://github.com/azurecurve/azrcrv-to-twitter/releases/tag/v1.7.0)
 * Improve handling of duplicate tags.
 * Add function allowing retweets on delay after original tweet of post or pages.
 * Fix bugs produced and visible in debug mode for new settings.

### [Version 1.6.0](https://github.com/azurecurve/azrcrv-to-twitter/releases/tag/v1.6.0)
 * Fix bug with tweet being erased on post save.
 * Add option to allow prefix of dit to be added when generated tweet starts with an @.

### [Version 1.5.0](https://github.com/azurecurve/azrcrv-to-twitter/releases/tag/v1.5.0)
 * Add scheduled tweet of random page.
 * Add option to exclude individual posts or pages from random scheduled tweets.

### [Version 1.4.1](https://github.com/azurecurve/azrcrv-to-twitter/releases/tag/v1.4.1)
 * Fix bug with setting of default options.

### [Version 1.4.0](https://github.com/azurecurve/azrcrv-to-twitter/releases/tag/v1.4.0)
 * Add scheduled tweets.

### [Version 1.3.0](https://github.com/azurecurve/azrcrv-to-twitter/releases/tag/v1.3.0)
 * Add scheduled tweet of random post.
 * Add azurecurve menu entry.
 * Amend Send Tweet to Send Manual tweet.
 * Amend Send Manual tweet character counter to count up instead of down.
 * Fix bug of Send Manual Tweet counter not counting final character.
 * Update Update Manager class to v2.0.0.

### [Version 1.2.1](https://github.com/azurecurve/azrcrv-to-twitter/releases/tag/v1.2.1)
 * Fix incorrect version number problem.

### [Version 1.2.0](https://github.com/azurecurve/azrcrv-to-twitter/releases/tag/v1.2.0)
 * Add option to check autopost on new post.
 * Add tweet history for posts.
 * Add default category hashtags.
 * Add default tag hashtags.
 * Add word replacement where words in tweet can be replaced with @ or hashtags.
 * Record and display history of tweets; includes setting to enable/disable.

### [Version 1.1.1](https://github.com/azurecurve/azrcrv-to-twitter/releases/tag/v1.1.1)
 * Fix bug with incorrect language load text domain.

### [Version 1.1.0](https://github.com/azurecurve/azrcrv-to-twitter/releases/tag/v1.1.0)
 * Add integration with Update Manager for automatic updates.
 * Add load_plugin_textdomain to handle translations.

### [Version 1.0.0](https://github.com/azurecurve/azrcrv-to-twitter/releases/tag/v1.0.0)
 * Initial release.

== Other Notes ==

# About azurecurve

**azurecurve** was one of the first plugin developers to start developing for Classicpress; all plugins are available from [azurecurve Development](https://development.azurecurve.co.uk/) and are integrated with the [Update Manager plugin](https://codepotent.com/classicpress/plugins/update-manager/) by [CodePotent](https://codepotent.com/) for fully integrated, no hassle, updates.

Some of the top plugins available from **azurecurve** are:
* [Add Twitter Cards](https://development.azurecurve.co.uk/classicpress-plugins/add-twitter-cards/)
* [Breadcrumbs](https://development.azurecurve.co.uk/classicpress-plugins/breadcrumbs/)
* [SMTP](https://development.azurecurve.co.uk/classicpress-plugins/smtp/)
* [To Twitter](https://development.azurecurve.co.uk/classicpress-plugins/to-twitter/)
* [Theme Switcher](https://development.azurecurve.co.uk/classicpress-plugins/theme-switcher/)
* [Toggle Show/Hide](https://development.azurecurve.co.uk/classicpress-plugins/toggle-showhide/)