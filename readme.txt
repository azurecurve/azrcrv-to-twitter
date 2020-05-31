=== To Twitter ===

Description:	Automate the tweeting of posts upon publication or randomly on a schedule.
Version:		1.10.0
Tags:			tweets,twitter,automatic 
Author:			azurecurve
Author URI:		https://development.azurecurve.co.uk/
Plugin URI:		https://development.azurecurve.co.uk/classicpress-plugins/to-twitter/
Download link:	https://github.com/azurecurve/azrcrv-to-twitter/releases/download/v1.10.0/azrcrv-to-twitter.zip
Donate link:	https://development.azurecurve.co.uk/support-development/
Requires PHP:	5.6
Requires:		1.0.0
Tested:			4.9.99
Text Domain:	to-twitter
Domain Path:	/languages
License: 		GPLv2 or later
License URI: 	http://www.gnu.org/licenses/gpl-2.0.html

Automate the tweeting of posts upon publication or randomly on a schedule.

== Description ==

# Description

Allows posts to be automatically tweeted when they are published or randomly on a schedule.

Mark the _Post tweet on publish/update?_ checkbox to post tweet when the post is published (works for both immediately and scheduled posts); also allows for an "incase you missed it" retweet on a user-definable delay.

Set hashtags in the hashtags box; these appear after the tweet.

Save a draft of the post to see auto-generated default tweet and amend if necessary; to regenerate default tweet, clear Tweet field and save draft; post URL is represented by a *%s* placeholder.

In the settings you can configure default hashtags for categories and tags to be assigned to tweets (dupicates are removed); word replacements can be configured, allowing you to, for example, switch the word `Microsoft` for `@microsoft`.

Tweet history can be enabled so you can see when a post was tweeted and what the tweet contained.

Integrates with azurecurve's [URL Shortener](https://development.azurecurve.co.uk/classicpress-plugins/url-shortener/) for URL in tweet.

Scheduled tweets to automatically post; history of scheduled tweets is available.

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
* [Series Index](https://development.azurecurve.co.uk/classicpress-plugins/series-index/)
* [To Twitter](https://development.azurecurve.co.uk/classicpress-plugins/to-twitter/)
* [Theme Switches](https://development.azurecurve.co.uk/classicpress-plugins/theme-switcher/)
* [Toggle Show/Hide](https://development.azurecurve.co.uk/classicpress-plugins/toggle-showhide/)