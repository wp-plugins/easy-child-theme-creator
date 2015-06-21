<?php
/**
 * @package Easy_Child_Theme
 * @version 1.1
 */
/*
 Plugin Name: Easy Child Theme
 Plugin URI: http://ashokg.in/easy-child-theme
 Description: Hassle Free Child Theme Creator.
 Author: Ashok G
 Version: 1.1
 Author URI: http://ashokg.in/
 */
include __DIR__."/functions.php";
add_action('admin_menu', 'easy_ctc_menu');
add_action('admin_enqueue_scripts', 'ect_plugin_admin_styles');

function easy_ctc_menu(){
	add_menu_page( 'Easy Child Theme Creator', 'Easy Child Theme Creator', 'manage_options', 'easy-ctc', 'easy_ctc_menu_init' );
}

function easy_ctc_menu_init(){
	include __DIR__ . "/options.php";
	
}
