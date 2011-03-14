<?php
/*
Plugin Name: ZigTrap
Version: 0.2
Description: Adds a honey trap to the WordPress comment form.
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


# DEFINE PLUGIN


class ZigTrap
	{
	public $Options;


	public function __construct()
		{
		global $wp_version;
		if (version_compare($wp_version, '3.0', '<')) { wp_die('ZigTrap requires WordPress 3.0 or newer. Please update your installation.'); }
		if (version_compare(phpversion(), '5.0.0', '<')) { wp_die('ZigTrap requires PHP 5.0.0 or newer. Please update your server.'); }

		$this->Options = get_option('zigtrap_options');

		add_action('comment_form', array($this, 'RenderTrap'));
		add_filter('pre_comment_approved', array($this, 'CheckTrap'));

		add_action('rightnow_end', array($this, 'DashboardStats'));
		}


	public function Activate()
		{
		if (!$this->Options = get_option('zigtrap_options')) 
			{ 
			$this->Options = array(); 
			add_option('zigtrap_options', $this->Options);
			}
		if (!isset($this->Options['TotalTrapped'])) { $this->Options['TotalTrapped'] = 0; }
		update_option("zigtrap_options", $this->Options);
		}


	public function Deactivate()
		{
		}


	public function RenderTrap($postID) 
		{
		echo '<textarea name="comment_extra" style="display:none;"></textarea>';
		}


	public function CheckTrap($approved) 
		{
		if (!empty($_POST['comment_extra'])) 
			{
			$this->Options['TotalTrapped']++;
			update_option("zigtrap_options", $this->Options);
			wp_die('ZigTrap triggered - comment is spam.');
			}
		return $approved;
		}


	function DashboardStats() 
		{
		?>
		<p class="zigtrap-dashboard-stats"><a href="http://www.zigpress.com/wordpress/plugins/zigtrap/"><strong>ZigTrap</strong></a> has prevented <?php echo $this->Options['TotalTrapped']?> spam comments from being stored.</p>
		<?php
		}


	} # END OF CLASS


# INSTANTIATE PLUGIN


$objZigTrap = new ZigTrap();
register_activation_hook(__FILE__, array(&$objZigTrap, 'Activate'));
register_deactivation_hook(__FILE__, array(&$objZigTrap, 'Deactivate'));


# EOF
