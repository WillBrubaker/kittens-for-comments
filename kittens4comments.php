<?php
/*
Plugin Name: Kittens for comments
Plugin URI: http://www.willthewebmechanic.com/kittens-for-comments.html
Description: Encourages comments by offering cute kitten pictures as a reward.  You can add more pictures by uploading them to wp-content/plugins/kittens4comments/images/kittens
Version: 3.0.2
Author: Will Brubaker
Author URI: http://www.willthewebmechanic.com
License: GPLv3
*/
/*
				Kittens for Comments WordPress plugin
				Copyright (C) 2013 Will Brubaker (Will the Web Mechanic)

				This program is free software: you can redistribute it and/or modify
				it under the terms of the GNU General Public License as published by
				the Free Software Foundation, either version 3 of the License, or
				(at your option) any later version.

				This program is distributed in the hope that it will be useful,
				but WITHOUT ANY WARRANTY; without even the implied warranty of
				MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
				GNU General Public License for more details.

				You should have received a copy of the GNU General Public License
				along with this program.  If not, see <http://www.gnu.org/licenses/>.
*/
class KittensForComments {

	public $wwm_page_link;

	public function __construct()
	{

		add_action( 'wp_enqueue_scripts', array( $this,'my_enqueue_scripts' ) );
		add_action( 'comment_form', array( $this,'kitten_comment_addons' ) );
		add_filter( 'comment_form_defaults', array( $this,'comment_form_addons' ) );
		add_action( 'admin_menu', array( $this, 'wwm_admin_menu' ) );
	}

	//this is a placeholder for future method of grabbing the id of the commentform
	public function comment_form_addons( $form )
	{

		return $form;
	}

	/**
		* adds the link to the plugin options page to the admin menu
		* @author Will the Web Mechanic <will@willthewebmechanic>
		* @link will@willthewebmechanic.com
		*
		* @since 3.0
		*/
	public function wwm_admin_menu()
	{

			global $_wwm_plugins_page;
			//if, in the future, there is an enhancement or improvement,
			//allow other plugins to overwrite the panel by using
			//a higher number version.
			$plugin_panel_version = 1;
			add_filter( 'wwm_plugin_links', array( $this, 'this_plugin_link' ), 99 );
			if ( empty( $_wwm_plugins_page ) || ( is_array( $_wwm_plugins_page ) && $plugin_panel_version > $_wwm_plugins_page[1] ) ) {
				$_wwm_plugins_page[0] = add_menu_page( 'WtWM Plugins', 'WtWM Plugins', 'manage_options', 'wwm_plugins', array( $this, 'wwm_plugin_links' ), plugins_url( 'images/wwm_wp_menu.png', __FILE__ ), '90.314' );
				$_wwm_plugins_page[1] = $plugin_panel_version;
			}
			add_submenu_page( 'wwm_plugins', 'Kittens for Comments', 'Kittens for Comments', 'manage_options', 'kittens-for-comments', array( $this, 'options_panel' ) );
	}

	/**
		* adds the link to this plugin's management page
		* to the $links array to be displayed on the WWM
		* plugins page:
		* @param  array $links the array of links
		* @return array $links the filtered array of links
		* @since 3.0
		* @author Will the Web Mechanic <will@willthewebmechanic>
		* @link http://willthewebmechanic.com
		*/
	public function this_plugin_link( $links )
	{

		$this->wwm_page_link = $menu_page_url = menu_page_url( 'kittens-for-comments', 0 );
		$links[] = '<a href="' . $this->wwm_page_link . '">Kittens for Comments</a>' . "\n";
		$links['github'] = 'Will the Web Mechanic on <a href="https://github.com/WillBrubaker">GitHub</a>';
		$links['wp_repo'] = 'Plugins in the WordPress plugin repository: <a href="http://profiles.wordpress.org/willthewebmechanic/#content-plugins">WordPress User Profile</a>';
		$links['portfolio'] = 'Will the Web Mechanic\'s <a href="http://www.willthewebmechanic.com">WordPress Plugin Developer Portfolio</a>';
		return $links;
	}

	/**
		* outputs an admin panel and displays links to all
		* admin pages that have been added to the $wwm_plugin_links array
		* via apply_filters
		* @since 3.0
		* @author Will the Web Mechanic <will@willthewebmechanic>
		* @link http://willthewebmechanic.com
		*/
	public function wwm_plugin_links()
	{

		$wwm_plugin_links = apply_filters( 'wwm_plugin_links', $wwm_plugin_links );
		//set a version here so that everything can be overwritten by future plugins.
		//and pass it via the do_action calls
		$plugin_links_version = 1;
		echo '<div class="wrap">' . "\n";
		echo '<div id="icon-plugins" class="icon32"><br></div>' . "\n";
		echo '<h2>Will the Web Mechanic Plugins</h2>' . "\n";
		do_action( 'before_wwm_plugin_links', $plugin_links_version, $wwm_plugin_links );
		if ( ! empty( $wwm_plugin_links ) ) {
			echo '<ul>' . "\n";
			foreach ( $wwm_plugin_links as $link ) {
				echo '<li>' . $link . '</li>' . "\n";
			}
			echo '</ul>';
		}
		do_action( 'after_wwm_plugin_links', $plugin_links_version );
		echo '</div>' . "\n";
	}

	/**
		* outputs an options panel for this plugin
		* @since 3.0
		* @author Will the Web Mechanic <will@willthewebmechanic>
		* @link http://willthewebmechanic.com
		*/
	public function options_panel()
	{

		?>
		<style>
			.wwm-dashicon {
				font-size: 60px;
				height: 60px;
			}
		</style>
		<div class="wrap">
			<div class="dashicons dashicons-admin-tools wwm-dashicon"></div><h3>Kittens for Comments Options Panel</h3>
			<p>
				Currently, there are no options for this plugin. <br>You can submit a feature request via the WordPress plugin page <a href="http://wordpress.org/support/plugin/kittens-for-comments">here</a>
			</p>
		</div>
		<?php
	}

	/**
		* injects the js into the comment form
		* to make this work.
		* @param  string $form the comment form
		* @since 1.0
		* @author Will the Web Mechanic <will@willthewebmechanic>
		* @link http://willthewebmechanic.com
		*/
	public function kitten_comment_addons( $form )
	{

		$kittenpic = $this->random_pic();
		echo '<script type="text/javascript"> var kittenPic = "' . plugins_url( 'images/kittens/' . $kittenpic, __FILE__ ) . '"</script>';
		?>
			<div class="kittenpanel">
			<p>Your comments make us happy.</p>  <p>Leave a comment, get a kitten!</p>
			</div>

		<?php
	}

	/**
		* enqueues the necessary js/css for this plugin
		* @since 1.0
		* @author Will the Web Mechanic <will@willthewebmechanic>
		* @link http://willthewebmechanic.com
		*/
	public function my_enqueue_scripts()
	{

		if( is_single() ) {
			$suffix = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';
			wp_register_script( 'waypoints', plugins_url( 'js/waypoints.min.js', __FILE__ ), array( 'jquery', ), '2.0.2', true );
			wp_register_script( 'colorbox', plugins_url( 'js/jquery.colorbox-min.js', __FILE__ ), array( 'jquery' ), '1.4.33', true );
			wp_enqueue_script( 'kittens4comments', plugins_url( 'js/kittens4comments' . $suffix . '.js', __FILE__ ), array( 'waypoints', 'colorbox', ), '1.0', true );
			wp_enqueue_style( 'colorbox', plugins_url( 'css/colorbox.min.css', __FILE__ ) );
			wp_enqueue_style( 'kittens4commentsstyle', plugins_url( 'css/kittens4comments' . $suffix . '.css', __FILE__ ) );
		}
	}

	/**
		* gets a random image from the images/kittens
		* directory and returns it as a path to
		* the image
		* @return string path to the randomized kitten image
		* @since  1.0
		*
		*/
	public function random_pic()
	{

		$dir = plugin_dir_path( __FILE__ ) . 'images/kittens';

		if ( $dh = opendir( $dir ) ) {

			while ( ( $file = readdir( $dh ) ) !== false ) {
				if ( 'dir' != filetype( $dir . '/' . $file ) && getimagesize( $dir . '/' . $file ) ) {
					$files[] = $file;
				}
			}
		}

		$file = array_rand( $files );
		return $files[ $file ];
	}
}
$kittens4comments = new KittensForComments;
