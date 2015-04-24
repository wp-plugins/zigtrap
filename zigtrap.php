<?php
/*
Plugin Name: ZigTrap
Plugin URI: http://www.zigpress.com/plugins/zigtrap/
Version: 0.3.6
Description: Adds a honey trap to the WordPress comment form.
Author: ZigPress
Requires at least: 3.6
Tested up to: 4.2
Author URI: http://www.zigpress.com/
License: GPLv2
*/


/*  
Copyright (c) 2011-2015 ZigPress
 
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


# DEFINE PLUGIN


if (!class_exists('zigtrap')) {


	class zigtrap
	{
	
	
		private $options;
		private $fieldname;
	
	
		public function __construct() {
			$this->fieldname = 'extranote';
			global $wp_version;
			if (version_compare($wp_version, '3.5', '<')) { wp_die('ZigTrap requires WordPress 3.5 or newer. Please update your installation.'); }
			if (version_compare(phpversion(), '5.3', '<')) { wp_die('ZigTrap requires PHP 5.3 or newer. Please update your server.'); }
			if (!$this->options = get_option('zigtrap_options')) { 
				$this->options = array(); 
				add_option('zigtrap_options', $this->options);
			}
			if (!isset($this->options['TotalTrapped'])) { 
				$this->options['TotalTrapped'] = 0; 
				update_option("zigtrap_options", $this->options);
			}
			add_action('comment_form', array($this, 'action_comment_form'));
			add_action('rightnow_end', array($this, 'action_rightnow_end'));
			add_filter('pre_comment_approved', array($this, 'filter_pre_comment_approved'));
			add_filter('plugin_row_meta', array($this, 'filter_plugin_row_meta'), 10, 2);
			/* That which can be added without discussion, can be removed without discussion. */
			remove_filter('the_title', 'capital_P_dangit', 11);
			remove_filter('the_content', 'capital_P_dangit', 11);
			remove_filter('comment_text', 'capital_P_dangit', 31);
		}
	
	
		public function action_comment_form($postID) {
			?>
			<textarea name="<?php echo $this->fieldname?>" style="display:none;"></textarea>
			<?php
		}
	
	
		public function action_rightnow_end() {
			?>
			<p class="zigtrap_dashboard_stats"><a href="http://www.zigpress.com/plugins/zigtrap/"><strong>ZigTrap</strong></a> has prevented <?php echo $this->options['TotalTrapped']?> spam comments from being stored.</p>
			<?php
		}
	
	
		public function filter_pre_comment_approved($approved) {
			if (!empty($_POST[$this->fieldname])) {
				$this->options['TotalTrapped']++;
				update_option("zigtrap_options", $this->options);
				wp_die('<a href="http://www.zigpress.com/plugins/zigtrap/">ZigTrap</a> triggered - comment is spam.');
			}
			return $approved;
		}
	
	
		public function filter_plugin_row_meta($links, $file) {
			$plugin = plugin_basename(__FILE__);
			if ($file == $plugin) return array_merge($links, array('<a target="_blank" href="http://www.zigpress.com/donations/">Donate</a>'));
			return $links;
		}
	
	
	} # END OF CLASS


} else {
	wp_die('Namespace clash! Class zigtrap already exists.');
}


# INSTANTIATE PLUGIN


$zigtrap = new zigtrap(); # by this point we know the class exists so no check needed


# EOF
