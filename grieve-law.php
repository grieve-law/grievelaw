<?php 
/**
 * Plugin Name: Grieve Law Plugin
 * Description: A plugin to add elementor widgets & other features to Grieve Law sites. Please don't use this.
 * Plugin URI: https://grievelaw.com/
 * Version: 1.0.1
 * Author: Nate Northway
 * Author URI: https://www.grievelaw.com
 * Text Domain: gl
 *  
 * Requires Plugins: elementor
 * Elementor tested up to: 3.24.0
 * Elementor Pro tested up to: 3.24.0
 * */
defined( 'ABSPATH' ) || exit;

/**
 * Register Numbered Header Widget
 * Include Widget File & register widget class
 * @since 1.0.0
 * @author Nate Northway
 * */
function register_widgets($mgr) {
	require_once(__DIR__ . '/widgets/numbered-header-widget.php');
	$mgr->register(new \Elementor_Numbered_Header_Widget());
	wp_register_style('numberedHeaderWidgetStyle', plugin_dir_url(__FILE__) . '/widgets/numbered-header-widget.css');

	require_once(__DIR__ . '/widgets/slide-up-widget.php');
	$mgr->register(new \Elementor_Slide_Up_Widget());
	wp_register_style('slideupWidgetStyle', plugin_dir_url(__FILE__) . '/widgets/slide-up-widget.css');

	require_once(__DIR__ . '/widgets/bubble-button-widget.php');
	$mgr->register(new \Elementor_Bubble_Button_Widget());
	wp_register_style('bubbleButtonWidgetStyle', plugin_dir_url(__FILE__) . '/widgets/bubble-button-widget.css');
}
add_action('elementor/widgets/register', 'register_widgets');


/**
 * Add Widget Categories
 * @since 1.0.0
 * @author Nate Northway
 * */
function add_elementor_widget_cats($elements_mgr) {
	$elements_mgr->add_category(
		'grieve-law',
		[
			'title' => esc_html__('Grieve Law', 'gl'),
			'icon' => 'fa fa-building-columns'
		]
	);
}
add_action('elementor/elements/categories_registered', 'add_elementor_widget_cats');

/**
 * Auto Updates
 * @since 1.0.0
 * @author Nate Northway
 * */
function grieve_activate_au() {
	require_once('autoupdate.php');
	$current = '1.0.1';
	$remote = 'https://wordpress-1360069-5045689.cloudwaysapps.com/plugin/update.php';
	$slug = plugin_basename(__FILE__);
	new autoupdate($current, $remote, $slug);
}
add_action('init', 'grieve_activate_au');