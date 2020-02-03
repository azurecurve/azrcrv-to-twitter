=== To Twitter ===

Description:	Automate the tweeting of posts upon publication.
Version:		1.1.1
Tags:			tweets,twitter,automatic
Author:			azurecurve
Author URI:		https://development.azurecurve.co.uk/
Plugin URI:		https://development.azurecurve.co.uk/classicpress-plugins/to-twitter/
Download link:	https://github.com/azurecurve/azrcrv-to-twitter/releases/download/v1.1.0/azrcrv-to-twitter.zip
Donate link:	https://development.azurecurve.co.uk/support-development/
Requires PHP:	5.6
Requires:		1.0.0
Tested:			4.9.99
Text Domain:	to-twitter
Domain Path:	/languages
License: 		GPLv2 or later
License URI: 	http://www.gnu.org/licenses/gpl-2.0.html

Automate the tweeting of posts upon publication.

== Description ==

# Description

Allows posts to be automatically tweeted when they are published.

Mark the _Post tweet on publish/update?_ checkbox to post tweet when the post is published (works for both immediately and scheduled posts.

Set hashtags in the hashtags box; these appear after the tweet.

Save a draft of the post to see auto-generated default tweet and amend if necessary; to regenerate default tweet, clear Tweet field and save draft; post URL is represented by a *%s* placeholder.

Integrates with [azurecurve's URL Shortener](https://development.azurecurve.co.uk/classicpress-plugins/url-shortener/) for URL in tweet.

This plugin is multisite compatible with each site having it's own settings.

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

### [Version 1.1.1](https://github.com/azurecurve/azrcrv-to-twitter/tree/v1.1.1)
 * Fix bug with incorrect language load text domain.

### [Version 1.1.0](https://github.com/azurecurve/azrcrv-to-twitter/tree/v1.1.0)
 * Add integration with Update Manager for automatic updates.
 * Add load_plugin_textdomain to handle translations.

### [Version 1.0.0](https://github.com/azurecurve/azrcrv-to-twitter/tree/v1.0.0)
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