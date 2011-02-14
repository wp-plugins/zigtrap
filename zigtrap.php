<?php
/*
Plugin Name: ZigTrap
Version: 0.1
Description: Adds a honey trap to the WordPress comment form. Requires WordPress 3.0 or newer, running on PHP 5.0 or newer.
Author: ZigPress
Author URI: http://www.zigpress.com/
Plugin URI: http://www.zigpress.com/wordpress/plugins/zigtrap/
*/


/*  
Copyright (c) 2011 ZigPress
 
This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; GNU GPL version 3 of the License.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/


/*
ZigPress PHP code uses Whitesmiths indent style: http://en.wikipedia.org/wiki/Indent_style#Whitesmiths_style
*/


# VERSION CHECKS


global $wp_version;
if (version_compare($wp_version, "3.0", "<")) 
	{ 
	exit('ZigTrap requires WordPress 3.0 or newer. Please update your installation.'); 
	}
if (floatval(phpversion()) < 5)
	{
	exit('ZigTrap requires PHP 5.0 or newer. Please update your installation.'); 
	}


# DEFINE PLUGIN


if (!class_exists('ZigTrap'))
	{
	class ZigTrap
		{


		function __construct()
			{
			add_action('comment_form', array($this, 'RenderTrap'));
			add_filter('pre_comment_approved', array($this, 'CheckTrap'));
			}


		function RenderTrap($postID) 
			{
			echo '<textarea name="comment_extra" style="display:none;"></textarea>';
			}


		function CheckTrap($approved) 
			{
			if (!empty($_POST['comment_extra'])) 
				{
				wp_die('ZigTrap triggered - comment is spam.');
				}
			return $approved;
			}


		} # END OF CLASS
	}
else
	{
	exit('Class ZigTrap already declared!');
	}


# INSTANTIATE PLUGIN


$objZigTrap = new ZigTrap();


# EOF
