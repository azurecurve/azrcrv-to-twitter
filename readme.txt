=== To Twitter ===

Description:	Automate the sending of tweets from your ClassicPress site to Twitter.
Version:		1.18.2
Tags:			tweets,twitter,automatic 
Author:			azurecurve
Author URI:		https://development.azurecurve.co.uk/
Plugin URI:		https://development.azurecurve.co.uk/classicpress-plugins/to-twitter/
Download link:	https://github.com/azurecurve/azrcrv-to-twitter/releases/download/v1.18.2/azrcrv-to-twitter.zip
Donate link:	https://development.azurecurve.co.uk/support-development/
Requires PHP:	5.6
Requires CP:	1.0
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

* Download the latest release of the plugin from [GitHub](https://github.com/azurecurve/azrcrv-to-twitter/releases/latest/).
* Upload the entire zip file using the Plugins upload function in your ClassicPress admin panel.
* Activate the plugin.
* Apply for a [Twitter Developer account](https://developer.twitter.com/en/apply-for-access).
* Create your Twitter application [here](https://developer.twitter.com/en/portal/dashboard).
* Request upgrade of your Twitter Essential developer profile to Twitter Elevated.
* Configure settings (including your Consumer API Keys and Access Token and Secret) via the configuration page in the admin control panel.

== Frequently Asked Questions ==

# Frequently Asked Questions

### Can I translate this plugin?
Yes, the .pot file is in the plugins languages folder; if you do translate this plugin, please sent the .po and .mo files to translations@azurecurve.co.uk for inclusion in the next version (full credit will be given).

### Is this plugin compatible with both WordPress and ClassicPress?
This plugin is developed for ClassicPress, but will likely work on WordPress.

== Changelog ==

# Changelog

### [Version 1.18.2](https://github.com/azurecurve/azrcrv-to-twitter/releases/tag/v1.18.2)
 * Update readme file for compatibility with ClassicPress Directory.
 
### [Version 1.18.1](https://github.com/azurecurve/azrcrv-to-twitter/releases/tag/v1.18.1)
 * Fix bug to resolve error message on attempted to display of history metabox when there is no history.
 * Fix bug which includes \ before single and double quotes when sending a tweet
 * Fix bug when viewing scheduled tweets and scheduled tweet history where \ was being included before single or double quotes.
 
### [Version 1.18.0](https://github.com/azurecurve/azrcrv-to-twitter/releases/tag/v1.18.0)
 * Add option to ignore maximum tweet length for manual and scheduled tweets.
 
### [Version 1.17.5](https://github.com/azurecurve/azrcrv-to-twitter/releases/tag/v1.17.5)
 * Fix bug with Exclude from Schedule checkbox on post/page admin pages not populating correctly.

### [Version 1.17.4](https://github.com/azurecurve/azrcrv-to-twitter/releases/tag/v1.17.4)
 * Update readme files.
 * Update language template.
 * Fix bug with azurecurve menu.
 
### [Version 1.17.3](https://github.com/azurecurve/azrcrv-to-twitter/releases/tag/v1.17.3)
 * Update azurecurve menu.
 * Update readme files.

### [Version 1.17.2](https://github.com/azurecurve/azrcrv-to-twitter/releases/tag/v1.17.2)
 * Fix but with display of tweeted confirmation message in sidebar metabox.
 * Update azurecurve menu.
 * Update readme.txt and readme.md

### [Version 1.17.1](https://github.com/azurecurve/azrcrv-to-twitter/releases/tag/v1.17.1)
 * Fix security issue with missing escape on send manual tweet and scheudled tweet.
 * Fix bug with azurecurve icon display.
 
### [Version 1.17.0](https://github.com/azurecurve/azrcrv-to-twitter/releases/tag/v1.17.0)
 * Update azurecurve logo.
 * Update translations to escape strings.
 
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
 * Fix incorrect Download link.
 
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

**azurecurve** was one of the first plugin developers to start developing for ClassicPress; all plugins are available from [azurecurve Development](https://development.azurecurve.co.uk/) and are integrated with the [Update Manager plugin](https://directory.classicpress.net/plugins/update-manager) for fully integrated, no hassle, updates.

Some of the other plugins available from **azurecurve** are:
 * Add Open Graph Tags - [details](https://development.azurecurve.co.uk/classicpress-plugins/add-open-graph-tags/) / [download](https://github.com/azurecurve/azrcrv-add-open-graph-tags/releases/latest/)
 * Add Twitter Cards - [details](https://development.azurecurve.co.uk/classicpress-plugins/add-twitter-cards/) / [download](https://github.com/azurecurve/azrcrv-add-twitter-cards/releases/latest/)
 * Avatars - [details](https://development.azurecurve.co.uk/classicpress-plugins/avatars/) / [download](https://github.com/azurecurve/azrcrv-avatars/releases/latest/)
 * BBCode - [details](https://development.azurecurve.co.uk/classicpress-plugins/bbcode/) / [download](https://github.com/azurecurve/azrcrv-bbcode/releases/latest/)
 * Breadcrumbs - [details](https://development.azurecurve.co.uk/classicpress-plugins/breadcrumbs/) / [download](https://github.com/azurecurve/azrcrv-breadcrumbs/releases/latest/)
 * Call-out Boxes - [details](https://development.azurecurve.co.uk/classicpress-plugins/call-out-boxes/) / [download](https://github.com/azurecurve/azrcrv-call-out-boxes/releases/latest/)
 * Check Plugin Status - [details](https://development.azurecurve.co.uk/classicpress-plugins/check-plugin-status/) / [download](https://github.com/azurecurve/azrcrv-check-plugin-status/releases/latest/)
 * Code - [details](https://development.azurecurve.co.uk/classicpress-plugins/code/) / [download](https://github.com/azurecurve/azrcrv-code/releases/latest/)
 * Comment Validator - [details](https://development.azurecurve.co.uk/classicpress-plugins/comment-validator/) / [download](https://github.com/azurecurve/azrcrv-comment-validator/releases/latest/)
 * Conditional Links - [details](https://development.azurecurve.co.uk/classicpress-plugins/conditional-links/) / [download](https://github.com/azurecurve/azrcrv-conditional-links/releases/latest/)
 * Contact Forms - [details](https://development.azurecurve.co.uk/classicpress-plugins/contact-forms/) / [download](https://github.com/azurecurve/azrcrv-contact-forms/releases/latest/)
 * Disable FLoC - [details](https://development.azurecurve.co.uk/classicpress-plugins/disable-floc/) / [download](https://github.com/azurecurve/azrcrv-disable-floc/releases/latest/)
 * Display After Post Content - [details](https://development.azurecurve.co.uk/classicpress-plugins/display-after-post-content/) / [download](https://github.com/azurecurve/azrcrv-display-after-post-content/releases/latest/)
 * Estimated Read Time - [details](https://development.azurecurve.co.uk/classicpress-plugins/estimated-read-time/) / [download](https://github.com/azurecurve/azrcrv-estimated-read-time/releases/latest/)
 * Events - [details](https://development.azurecurve.co.uk/classicpress-plugins/events/) / [download](https://github.com/azurecurve/azrcrv-events/releases/latest/)
 * Filtered Categories - [details](https://development.azurecurve.co.uk/classicpress-plugins/filtered-categories/) / [download](https://github.com/azurecurve/azrcrv-filtered-categories/releases/latest/)
 * Flags - [details](https://development.azurecurve.co.uk/classicpress-plugins/flags/) / [download](https://github.com/azurecurve/azrcrv-flags/releases/latest/)
 * Floating Featured Image - [details](https://development.azurecurve.co.uk/classicpress-plugins/floating-featured-image/) / [download](https://github.com/azurecurve/azrcrv-floating-featured-image/releases/latest/)
 * From Twitter - [details](https://development.azurecurve.co.uk/classicpress-plugins/from-twitter/) / [download](https://github.com/azurecurve/azrcrv-from-twitter/releases/latest/)
 * Gallery From Folder - [details](https://development.azurecurve.co.uk/classicpress-plugins/gallery-from-folder/) / [download](https://github.com/azurecurve/azrcrv-gallery-from-folder/releases/latest/)
 * Get GitHub File - [details](https://development.azurecurve.co.uk/classicpress-plugins/get-github-file/) / [download](https://github.com/azurecurve/azrcrv-get-github-file/releases/latest/)
 * Icons - [details](https://development.azurecurve.co.uk/classicpress-plugins/icons/) / [download](https://github.com/azurecurve/azrcrv-icons/releases/latest/)
 * Images - [details](https://development.azurecurve.co.uk/classicpress-plugins/images/) / [download](https://github.com/azurecurve/azrcrv-images/releases/latest/)
 * Insult Generator - [details](https://development.azurecurve.co.uk/classicpress-plugins/insult-generator/) / [download](https://github.com/azurecurve/azrcrv-insult-generator/releases/latest/)
 * Load Admin CSS - [details](https://development.azurecurve.co.uk/classicpress-plugins/load-admin-css/) / [download](https://github.com/azurecurve/azrcrv-load-admin-css/releases/latest/)
 * Loop Injection - [details](https://development.azurecurve.co.uk/classicpress-plugins/loop-injection/) / [download](https://github.com/azurecurve/azrcrv-loop-injection/releases/latest/)
 * Maintenance Mode - [details](https://development.azurecurve.co.uk/classicpress-plugins/maintenance-mode/) / [download](https://github.com/azurecurve/azrcrv-maintenance-mode/releases/latest/)
 * Markdown - [details](https://development.azurecurve.co.uk/classicpress-plugins/markdown/) / [download](https://github.com/azurecurve/azrcrv-markdown/releases/latest/)
 * Mobile Detection - [details](https://development.azurecurve.co.uk/classicpress-plugins/mobile-detection/) / [download](https://github.com/azurecurve/azrcrv-mobile-detection/releases/latest/)
 * Multisite Favicon - [details](https://development.azurecurve.co.uk/classicpress-plugins/multisite-favicon/) / [download](https://github.com/azurecurve/azrcrv-multisite-favicon/releases/latest/)
 * Nearby - [details](https://development.azurecurve.co.uk/classicpress-plugins/nearby/) / [download](https://github.com/azurecurve/azrcrv-nearby/releases/latest/)
 * Page Index - [details](https://development.azurecurve.co.uk/classicpress-plugins/page-index/) / [download](https://github.com/azurecurve/azrcrv-page-index/releases/latest/)
 * Post Archive - [details](https://development.azurecurve.co.uk/classicpress-plugins/post-archive/) / [download](https://github.com/azurecurve/azrcrv-post-archive/releases/latest/)
 * Redirect - [details](https://development.azurecurve.co.uk/classicpress-plugins/redirect/) / [download](https://github.com/azurecurve/azrcrv-redirect/releases/latest/)
 * Remove Revisions - [details](https://development.azurecurve.co.uk/classicpress-plugins/remove-revisions/) / [download](https://github.com/azurecurve/azrcrv-remove-revisions/releases/latest/)
 * RSS Feed - [details](https://development.azurecurve.co.uk/classicpress-plugins/rss-feed/) / [download](https://github.com/azurecurve/azrcrv-rss-feed/releases/latest/)
 * RSS Suffix - [details](https://development.azurecurve.co.uk/classicpress-plugins/rss-suffix/) / [download](https://github.com/azurecurve/azrcrv-rss-suffix/releases/latest/)
 * Series Index - [details](https://development.azurecurve.co.uk/classicpress-plugins/series-index/) / [download](https://github.com/azurecurve/azrcrv-series-index/releases/latest/)
 * Shortcodes in Comments - [details](https://development.azurecurve.co.uk/classicpress-plugins/shortcodes-in-comments/) / [download](https://github.com/azurecurve/azrcrv-shortcodes-in-comments/releases/latest/)
 * Shortcodes in Widgets - [details](https://development.azurecurve.co.uk/classicpress-plugins/shortcodes-in-widgets/) / [download](https://github.com/azurecurve/azrcrv-shortcodes-in-widgets/releases/latest/)
 * Sidebar Login - [details](https://development.azurecurve.co.uk/classicpress-plugins/sidebar-login/) / [download](https://github.com/azurecurve/azrcrv-sidebar-login/releases/latest/)
 * SMTP - [details](https://development.azurecurve.co.uk/classicpress-plugins/smtp/) / [download](https://github.com/azurecurve/azrcrv-smtp/releases/latest/)
 * Snippets - [details](https://development.azurecurve.co.uk/classicpress-plugins/snippets/) / [download](https://github.com/azurecurve/azrcrv-snippets/releases/latest/)
 * Strong Password Generator - [details](https://development.azurecurve.co.uk/classicpress-plugins/strong-password-generator/) / [download](https://github.com/azurecurve/azrcrv-strong-password-generator/releases/latest/)
 * Tag Cloud - [details](https://development.azurecurve.co.uk/classicpress-plugins/tag-cloud/) / [download](https://github.com/azurecurve/azrcrv-tag-cloud/releases/latest/)
 * Taxonomy Index - [details](https://development.azurecurve.co.uk/classicpress-plugins/taxonomy-index/) / [download](https://github.com/azurecurve/azrcrv-taxonomy-index/releases/latest/)
 * Taxonomy Order - [details](https://development.azurecurve.co.uk/classicpress-plugins/taxonomy-order/) / [download](https://github.com/azurecurve/azrcrv-taxonomy-order/releases/latest/)
 * Theme Switcher - [details](https://development.azurecurve.co.uk/classicpress-plugins/theme-switcher/) / [download](https://github.com/azurecurve/azrcrv-theme-switcher/releases/latest/)
 * Timelines - [details](https://development.azurecurve.co.uk/classicpress-plugins/timelines/) / [download](https://github.com/azurecurve/azrcrv-timelines/releases/latest/)
 * To Twitter - [details](https://development.azurecurve.co.uk/classicpress-plugins/to-twitter/) / [download](https://github.com/azurecurve/azrcrv-to-twitter/releases/latest/)
 * Toggle Show/Hide - [details](https://development.azurecurve.co.uk/classicpress-plugins/toggle-showhide/) / [download](https://github.com/azurecurve/azrcrv-toggle-showhide/releases/latest/)
 * URL Shortener - [details](https://development.azurecurve.co.uk/classicpress-plugins/url-shortener/) / [download](https://github.com/azurecurve/azrcrv-url-shortener/releases/latest/)
 * Username Protection - [details](https://development.azurecurve.co.uk/classicpress-plugins/username-protection/) / [download](https://github.com/azurecurve/azrcrv-username-protection/releases/latest/)
 * Widget Announcements - [details](https://development.azurecurve.co.uk/classicpress-plugins/widget-announcements/) / [download](https://github.com/azurecurve/azrcrv-widget-announcements/releases/latest/)
 