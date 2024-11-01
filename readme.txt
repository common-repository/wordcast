=== WordCast ===
Contributors: emilwibe
Donate link: https://paypal.com/paypalme/emilwibe
Tags: podcast, wordcast
Requires at least: 
Tested up to: 6.5.2
Requires PHP: 7.4
Stable tag: trunk
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
 
Serve your podcast channels and episodes with WordPress.

== Description ==
 
Host your podcast channels and episodes with WordPress. You're hosting your posts and pages on your WordPress site so why not your podcasts?

**Supports.** mp3, m4a and mp4 for now.
 
**It's a Snap.** As easy as creating a post or a page. You create a channel and fill in the imformation. Create an episode and attach it to the channel.

**No cluttering.** WordCast is made on WordPress' standard functionality using custom post types so the database will not be cluttered with extra tables or so.

**Host your files yourself.** With WordCast you are hosting your files, feed and data yourself and retain full ownership of it all.

== Features ==

* **FREE** - Yup. It's not a bug, it's a feature
* **Simple & Intuitive**
* **Unlimited** Channels and Episodes

== Links ==

* [Website](https://ew.dk)
 
== Installation ==
 
1. **Visit** Plugins > Add New
2. **Search** for "WordCast"
3. **Activate** WordCast from your Plugins page
4. **Click** on the new menu item "WordCast Channel" and create your first Channel
5. **Click** on the new menu item "WordCast Episode" and create your first Episode. Point the episode to the channel you just created
 
== Frequently Asked Questions ==
 
= My episode isn't showing up in my podcast app =
 
Google Podcast, Apple Podcast and other podcast directories updates the feeds 1 - 2 times a day. So please allow for up to 24 hours for the episode to show in your favourite podcast application.
 
= Apple Podcast says that my feed doesn't support HTTP HEAD requests =
 
Most hosting providers support HTTP HEAD requests. If yours doesn't please content your hosting provider as this is a server issue
 
= Why can't I add new categories to Channels and Episodes? =

The categories in the WordCast Channels and Episodes are categories that are used by Google Podcast and Apple Podcast. The categories are static because they are the only categories that will be accepted.

== Screenshots ==
 
1. Create a Channel as you would create any post or page
2. Create an Episode as you would create any post or page
3. Add the Episode to the Channel it should be a part of
4. Add the feed URL to Google Podcast, Apple Podcast or to your podcast listener / viewer of choice
 
== Changelog ==

= 1.1.4 =
* Tested to version bump. Nothing else to see here ;)

= 1.1.3 =
* In podcast episode number field only visible if a season number is entered

= 1.1.2 =
* Label: only external mp3's and m4a's are possible at this time. Label put on input field

= 1.1.1 =
* Bugfix: Duration for external sources not showing
= 1.1 =
* Added feature to serve podcast episodes through WordPress from external source

= 1.0.8 =
* Added admin notice for feedback
* Changed Donations URL (as if there will be any donations ;))

= 1.0.7 =
* Stat counter set on activation and deactivation hooks for statistics for this plugin. This will only register site url and if this is activated or deactivated

= 1.0.6 =
* Tested with WordPress 5.6
* Changed plugin description

= 1.0.5 =
* Tested with WordPress 5.5.1

= 1.0.4 =
* Fix: Special characters are now being converted to html entities

= 1.0.3 =
* Fix: Missing PHP Class for reading MP3 duration

= 1.0.2 =
* Fix: Dates and times are now internationally
* Fix: Mp3 duration is no longer set by meta data but calculated

= 1.0.1 =
* Added Admin Notice Error when pretty permalinks are not activated
* Added link to Podbase Feed Validator in channel editor
 
= 1.0 =
* The first version. Well this is it. WordCast is alive!