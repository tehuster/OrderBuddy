<?php
/*
Plugin Name: OrderBuddy
Description: Helping out with orders since 2019
Version: 0.0.1
Author: Thomas Huster
Author URI: http://thomashuster.nl
*/

function order_options_install() {

    global $wpdb;

    $table_name = $wpdb->prefix . "orders";
    $charset_collate = $wpdb->get_charset_collate();
    $sql = "CREATE TABLE $table_name (
            id int NOT NULL AUTO_INCREMENT,
            order_name varchar(64) NOT NULL,
						order_desc varchar(255) NOT NULL,
						order_amount int(4) NOT NULL,
						order_liters int(4) NOT NULL,
						order_price int(4) NOT NULL,
						img_url varchar(64) NOT NULL,
            PRIMARY KEY (`id`)
          ) $charset_collate; ";

		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );		
    dbDelta($sql);
}

// run the install scripts upon plugin activation
register_activation_hook(__FILE__, 'order_options_install');

//menu items
add_action('admin_menu','orderBuddy_orders_modifymenu');

function orderBuddy_orders_modifymenu() {
	
	//this is the main item for the menu
	add_menu_page('Order', //page title
	'Order Buddy', //menu title
	'manage_options', //capabilities
	'order_list', //menu slug
	'orderBuddy_orders_list' //function
	);
	
	//this is a submenu
	add_submenu_page('order_list', //parent slug
	'Add New Order', //page title
	'Add New', //menu title
	'manage_options', //capability
	'create_order', //menu slug
	'orderBuddy_orders_create'); //function
	
	//this submenu is HIDDEN, however, we need to add it anyways
	add_submenu_page(NULL, //parent slug
	'Update Order', //page title
	'Update', //menu title
	'manage_options', //capability
	'update_order', //menu slug
	'orderBuddy_orders_update'); //function
}

define('ROOTDIR', plugin_dir_path(__FILE__));
require_once(ROOTDIR . 'order-list.php');
require_once(ROOTDIR . 'order-create.php');
require_once(ROOTDIR . 'order-update.php');
require_once(ROOTDIR . 'order-show.php');
