<?php

/*

Plugin Name: Image Puzzle
Plugin URI: 
Version: 1.05
Description: Create beautiful puzzle effect on your images
Author: Manu225
Author URI: 
Network: false
Text Domain: image-puzzle
Domain Path: 
*/



add_action( 'admin_menu', 'register_image_puzzle_menu' );



function register_image_puzzle_menu() {

	add_menu_page('Image Puzzle', 'Image Puzzle', 'edit_pages', 'image_puzzle', 'image_puzzle', plugins_url( 'icon.png', __FILE__ ), 32);

}



add_action('admin_print_styles', 'image_puzzle_css' );

function image_puzzle_css() {

    wp_enqueue_style( 'ImagePuzzleStylesheet', plugins_url('css/admin.css', __FILE__) );

}

function load_image_puzzle_media_files() {

    wp_enqueue_media();

}

add_action( 'admin_enqueue_scripts', 'load_image_puzzle_media_files' );

   

function image_puzzle() {

	if (is_admin()) {

		include(plugin_dir_path( __FILE__ ) . 'views/shortcode_generator.php');

	}

}

add_action( 'wp_ajax_ip_preview', 'image_puzzle_preview' );

function image_puzzle_preview() {

	$src = sanitize_text_field($_POST['src']);
	$effect = sanitize_text_field($_POST['effect']);

	echo do_shortcode('[image-puzzle src="'.$src.'" effect="'.$effect.'"]');

	wp_die();

}

function display_image_puzzle($atts) {

        if(!empty($atts['src']))
        {	
        	ob_start();
			include( plugin_dir_path( __FILE__ ) . 'views/image_puzzle.tpl.php' );
			return ob_get_clean();
        }
        else
        	return "No image defined!";

}

add_shortcode('image-puzzle', 'display_image_puzzle');