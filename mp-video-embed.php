<?php
/*
Plugin Name: MP Video Embed for WordPress Classic Editor
Plugin URI:  https://petrov.net.ua/
Description: Insert adaptive videos for WordPress Classic Editor
Author: Mykhaylo Petrov
Author URI: https://petrov.net.ua/
*/

if ( ! defined( 'ABSPATH' ) ) {
    die; // or exit;
}

add_action( 'wp_enqueue_scripts', function() {
	wp_register_style( 'mp-video-embed-style', plugins_url( '/assets/css/style.css', __FILE__ ) );
    wp_enqueue_style( 'mp-video-embed-style' );
});

if ( ! function_exists( 'mp_video_embed_render' ) ) {
	function mp_video_embed_render( $text ) {
		$text = preg_replace( '/\[mp_video\]/', '<div class="mp-video-embed">', $text );
		$text = preg_replace( '/\[\/mp_video\]/', '</div>', $text );
	
	   return $text;
	}
}

if ( ! function_exists( 'mp_video_embed_tinymce_button' ) ) {
	function mp_video_embed_tinymce_button() {
		if ( current_user_can( 'edit_posts' ) && current_user_can( 'edit_pages' ) ) {
			add_filter( 'mce_external_plugins', 'mp_video_embed_add_tinymce_button' );
			add_filter( 'mce_buttons_2', 'mp_video_embed_register_tinymce_button' );
		}
	}
}

if ( ! function_exists( 'mp_video_embed_add_tinymce_button' ) ) {
	function mp_video_embed_add_tinymce_button( $plugin_array ) {
		$plugin_array['mp_video_embed_button_script'] = plugins_url( '/assets/js/mp-video-embed-button.js', __FILE__ );
	
		return $plugin_array;
	}
}

if ( ! function_exists( 'mp_video_embed_register_tinymce_button' ) ) {
	function mp_video_embed_register_tinymce_button( $buttons ) {
		array_push( $buttons, "mp_video" );
	
		return $buttons;
	}
}

add_filter( 'the_content', 'mp_video_embed_render', 10 );
add_filter( 'the_excerpt', 'mp_video_embed_render', 10 );
add_action( 'init', 'mp_video_embed_tinymce_button' );