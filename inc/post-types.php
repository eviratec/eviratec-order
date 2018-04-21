<?php
/**
 * Copyright (c) 2018 Callan Peter Milne
 *
 * Permission to use, copy, modify, and/or distribute this software for any
 * purpose with or without fee is hereby granted, provided that the above
 * copyright notice and this permission notice appear in all copies.
 *
 * THE SOFTWARE IS PROVIDED "AS IS" AND THE AUTHOR DISCLAIMS ALL WARRANTIES WITH
 * REGARD TO THIS SOFTWARE INCLUDING ALL IMPLIED WARRANTIES OF MERCHANTABILITY
 * AND FITNESS. IN NO EVENT SHALL THE AUTHOR BE LIABLE FOR ANY SPECIAL, DIRECT,
 * INDIRECT, OR CONSEQUENTIAL DAMAGES OR ANY DAMAGES WHATSOEVER RESULTING FROM
 * LOSS OF USE, DATA OR PROFITS, WHETHER IN AN ACTION OF CONTRACT, NEGLIGENCE OR
 * OTHER TORTIOUS ACTION, ARISING OUT OF OR IN CONNECTION WITH THE USE OR
 * PERFORMANCE OF THIS SOFTWARE.
 */

add_action("init", "eviratec_register_post_types");

function eviratec_register_post_types () {
  eviratec_register_order_post_type();
  eviratec_register_testimonial_post_type();
  eviratec_register_site_feature_post_type();
}

function eviratec_register_order_post_type () {

  $labels = array(
    'name'               => _x( 'Orders', 'post type general name', 'evirateconline' ),
    'singular_name'      => _x( 'Order', 'post type singular name', 'evirateconline' ),
    'menu_name'          => _x( 'Orders', 'admin menu', 'evirateconline' ),
    'name_admin_bar'     => _x( 'Order', 'add new on admin bar', 'evirateconline' ),
    'add_new'            => _x( 'Add New', 'app-order', 'evirateconline' ),
    'add_new_item'       => __( 'Add New Order', 'evirateconline' ),
    'new_item'           => __( 'New Order', 'evirateconline' ),
    'edit_item'          => __( 'Edit Order', 'evirateconline' ),
    'view_item'          => __( 'View Order', 'evirateconline' ),
    'all_items'          => __( 'All Orders', 'evirateconline' ),
    'search_items'       => __( 'Search Orders', 'evirateconline' ),
    'parent_item_colon'  => __( 'Parent Orders:', 'evirateconline' ),
    'not_found'          => __( 'No app orders found.', 'evirateconline' ),
    'not_found_in_trash' => __( 'No app orders found in Trash.', 'evirateconline' )
  );
  $args = array(
    'labels'             => $labels,
    'description'        => __( 'Description.', 'evirateconline' ),
    'public'             => true,
    'publicly_queryable' => true,
    'show_ui'            => true,
    // 'show_in_menu'        => 'evirateconline',
    'show_in_nav_menus'   => false,
    'show_in_admin_bar'   => false,
    'query_var'          => true,
    'rewrite'            => array( 'slug' => 'app-order' ),
    'capability_type'    => 'post',
    'has_archive'        => true,
    'hierarchical'       => false,
    'supports'           => array( 'title', 'comments', 'editor' )
  );
  register_post_type( 'eviratec_site_order', $args );

}

function eviratec_register_testimonial_post_type () {

  $labels = array(
    'name'               => _x( 'Testimonials', 'post type general name', 'evirateconline' ),
    'singular_name'      => _x( 'Testimonial', 'post type singular name', 'evirateconline' ),
    'menu_name'          => _x( 'Testimonials', 'admin menu', 'evirateconline' ),
    'name_admin_bar'     => _x( 'Testimonial', 'add new on admin bar', 'evirateconline' ),
    'add_new'            => _x( 'Add New', 'testimonial', 'evirateconline' ),
    'add_new_item'       => __( 'Add New Testimonial', 'evirateconline' ),
    'new_item'           => __( 'New Testimonial', 'evirateconline' ),
    'edit_item'          => __( 'Edit Testimonial', 'evirateconline' ),
    'view_item'          => __( 'View Testimonial', 'evirateconline' ),
    'all_items'          => __( 'All Testimonials', 'evirateconline' ),
    'search_items'       => __( 'Search Testimonials', 'evirateconline' ),
    'parent_item_colon'  => __( 'Parent Testimonials:', 'evirateconline' ),
    'not_found'          => __( 'No testimonials found.', 'evirateconline' ),
    'not_found_in_trash' => __( 'No testimonials found in Trash.', 'evirateconline' )
  );
  $args = array(
    'labels'             => $labels,
    'description'        => __( 'Description.', 'evirateconline' ),
    'public'             => true,
    'publicly_queryable' => true,
    'show_ui'            => true,
    // 'show_in_menu'        => 'evirateconline',
    'show_in_nav_menus'   => false,
    'show_in_admin_bar'   => false,
    'query_var'          => true,
    'rewrite'            => array( 'slug' => 'testimonial' ),
    'capability_type'    => 'post',
    'has_archive'        => true,
    'hierarchical'       => false,
    'supports'           => array( 'title', 'comments', 'editor' )
  );
  register_post_type( 'eviratec_testimonial', $args );

}

function eviratec_register_site_feature_post_type () {

  $labels = array(
    'name'               => _x( 'Features', 'post type general name', 'evirateconline' ),
    'singular_name'      => _x( 'Feature', 'post type singular name', 'evirateconline' ),
    'menu_name'          => _x( 'Features', 'admin menu', 'evirateconline' ),
    'name_admin_bar'     => _x( 'Feature', 'add new on admin bar', 'evirateconline' ),
    'add_new'            => _x( 'Add New', 'feature', 'evirateconline' ),
    'add_new_item'       => __( 'Add New Feature', 'evirateconline' ),
    'new_item'           => __( 'New Feature', 'evirateconline' ),
    'edit_item'          => __( 'Edit Feature', 'evirateconline' ),
    'view_item'          => __( 'View Feature', 'evirateconline' ),
    'all_items'          => __( 'All Features', 'evirateconline' ),
    'search_items'       => __( 'Search Features', 'evirateconline' ),
    'parent_item_colon'  => __( 'Parent Features:', 'evirateconline' ),
    'not_found'          => __( 'No features found.', 'evirateconline' ),
    'not_found_in_trash' => __( 'No features found in Trash.', 'evirateconline' )
  );
  $args = array(
    'labels'             => $labels,
    'description'        => __( 'Description.', 'evirateconline' ),
    'public'             => true,
    'publicly_queryable' => true,
    'show_ui'            => true,
    // 'show_in_menu'        => 'evirateconline',
    'show_in_nav_menus'   => false,
    'show_in_admin_bar'   => false,
    'query_var'          => true,
    'rewrite'            => array( 'slug' => 'site-feature' ),
    'capability_type'    => 'post',
    'has_archive'        => true,
    'hierarchical'       => false,
    'supports'           => array( 'title', 'comments', 'editor' )
  );
  register_post_type( 'eviratec_site_feature', $args );

}
