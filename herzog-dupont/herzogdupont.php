<?php

/**
 * Herzog Dupont
 *
 * @package           Herzog Dupont for YOOtheme Pro
 * @author            Thomas Weidlich
 * @copyright         Copyright (C) 2021-2023 Thomas Weidlich
 * @license           GNU General Public License version 3, see LICENSE.txt
 *
 * @wordpress-plugin
 * Plugin Name:       Herzog Dupont for YOOtheme Pro
 * Plugin URI:        https://herzog-dupont.de/yootheme-pro
 * Description:       A plugin for the YOOtheme Pro page builder which adds more elements to the element library.
 * Version:           1.7.0
 * Requires at least: 5.4
 * Requires PHP:      8.0
 * Author:            Thomas Weidlich
 * Author URI:        https://herzog-dupont.de
 * Text Domain:       herzog-dupont
 * License:           GNU General Public License version 3
 * License URI:       https://gnu.org/licenses/gpl-3.0
 */

// If this file is not called by WordPress, die.
if ( !defined( 'WPINC' ) )
	die;

// Current plugin version.
define( 'HERZOGDUPONT_VERSION', '1.7.0' );

// The code that runs during plugin activation.
function activate_herzogdupont() {
    require_once plugin_dir_path( __FILE__ ) . 'includes/class-herzogdupont-activator.php';
    Herzogdupont_Activator::activate();
}

register_activation_hook( __FILE__ , 'activate_herzogdupont');

// The core plugin class that is used to define hooks.
require plugin_dir_path( __FILE__ ) . 'includes/class-herzogdupont.php';

function run_herzogdupont() {
    $plugin = new Herzogdupont();
    $plugin->run();
}
run_herzogdupont();
