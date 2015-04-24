=== ZigTrap ===
Contributors: ZigPress
Donate link: http://www.zigpress.com/donations/
Tags: honey trap, honey pot, comments, comment form, hidden field, spam trap, anti-spam, zig, zigpress
Requires at least: 3.6
Tested up to: 4.2
Stable tag: 0.3.6

ZigTrap adds a honey trap to your comments form.

== Description ==

ZIGTRAP NOW NEEDS PHP 5.3!

ZigTrap adds a hidden field to your comments form, which humans will leave empty because they don't know it's there. Spam bots, however, will normally enter some content in it, and this springs the trap, causing WordPress to show a message and not save the comment at all.

Use this in conjunction with Akismet for a pretty solid spam prevention package.

Please ensure that the comments form in your theme calls the 'comment_form' action.

For further information and support, please visit [the ZigTrap home page](http://www.zigpress.com/plugins/zigtrap/).

== Installation ==

1. Check that you are using WordPress 3.1 or greater, and PHP 5.3 or greater.
2. Unzip the installer and upload the resulting 'zigtrap' folder to the `/wp-content/plugins/` directory.  Alternatively, go to Admin > Plugins > Add New and enter ZigTrap in the search box.
3. Activate the plugin through the 'Plugins' menu in WordPress.

== Frequently Asked Questions ==

= Why isn't the counter working? =

* Please deactivate and reactivate the plugin, and check that you have the latest version.

= Where is the counter shown? =

* On the Admin Dashboard page, at the bottom of the "Right Now" panel.

= Why do I get this error when activating? "Parse error: syntax error, unexpected T_STRING, expecting T_OLD_FUNCTION or T_FUNCTION or T_VAR or '}' in ..." =

* Your server is running PHP4.  ZigTrap requires PHP5, as do all ZigPress plugins. PHP4 is dead.

For further information and support, please visit [the ZigTrap home page](http://www.zigpress.com/plugins/zigtrap/).

== Changelog ==

= 0.3.6 =
* Confirmed compatibility with WordPress 4.2
* Increased minimum PHP version to 5.3 in accordance with ZigPress policy of gradually dropping support for deprecated platforms
= 0.3.5 =
* Confirmed compatibility with WordPress 4.1
* Minimum compatible version raised to 3.6
= 0.3.4 =
* Confirmed compatibility with WordPress 3.9
* Changed name of trap field to keep foiling those spambots
= 0.3.3 =
* Changed name of trap field to keep foiling those spambots
* Updated donation link in readme
* Confirmed compatibility with WordPress 3.5.2
= 0.3.2 =
* Confirmed compatibility with WordPress 3.5
= 0.3.1 =
* Correction to plugin URL
= 0.3 =
* Confirmed compatibility with WordPress 3.4.2
* Changed code indentation and added some small code style improvements
* Changed name of trap field to keep foiling those spambots
* Updated plugin URL in header block to reflect new plugin homepage location
= 0.2.4 =
* Confirmed compatibility with WordPress 3.3.1
= 0.2.3 =
* Confirmed compatibility with WordPress 3.1.1
= 0.2.2 =
* Updated readme.txt to clarify PHP5 requirement
= 0.2.1 =
* Fix for the problem that meant manual deactivation and reactivation was sometimes necessary to start the counter going
= 0.2 =
* Added simple counter on dashboard
= 0.1 =
* First public release
