<?php 
/**
 * Plugin Name: Grieve Law Plugin
 * Description: A plugin to add elementor widgets & other features to Grieve Law sites. Please don't use this.
 * Plugin URI: https://grievelaw.com/
 * Version: 1.0.4
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

	require_once(__DIR__ . '/widgets/double-button-widget.php');
	$mgr->register(new \Elementor_Double_Button_Widget());
	wp_register_style('doubleButtonWidgetStyle', plugin_dir_url(__FILE__) . '/widgets/double-button-widget.css');
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
 * @since 1.0.2
 * @author Nate Northway
 * */
include_once(plugin_dir_path(__FILE__) . 'autoupdate.php');
$updater = new autoupdate(__FILE__);
$updater->set_username('grieve-law');
$updater->set_repository('grievelaw');
$updater->initialize();


/**
 * Add Dashboard Widget
 * @since 1.0.3
 * @author Nate Northway
 * */
function gl_dashboard_widget() {
	global $wp_meta_boxes;
	wp_add_dashboard_widget('gl_plugin_widget', 'Grieve Law', 'gl_setup_widget');
}

function gl_setup_widget() {
	$user = wp_get_current_user();
	echo "<h3>Hello, " . $user->display_name . "</h3>";
}

add_action('wp_dashboard_setup', 'gl_dashboard_widget');