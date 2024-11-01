<?php
	add_action('init', function(){
		register_taxonomy('wordcast_category', array('wordcastchannel', 'wordcastepisode'), array(
			'hierarchical' => true,
			'labels' => array(
				'name' => __('Categories', 'wordcast'),
				'singular_name' => __('Category', 'wordcast'),
				'search_items' => __('Search Categories', 'wordcast'),
				'all_items' => __('All Categories', 'wordcast'),
				'edit_item' => __('Edit Category', 'wordcast'),
				'update_item' => __('Update Category', 'wordcast'),
				'add_new_item' => __('Add New Category', 'wordcast'),
				'new_item_name' => __('New Category Name', 'wordcast'),
				'separate_items_with_commas' => __('Separate Categories with commas', 'wordcast'),
				'add_or_remove_items' => __('Add or remove Categories', 'wordcast'),
				'choose_from_most_used' => __('Choose from the most used Categories', 'wordcast'),
				'menu_name' => __('Categories', 'wordcast')
			),
			'show_ui' => true,
			'show_in_rest' => true,
			'show_admin_column' => true,
			'query_var' => true
		));
	});

	add_action('init', function(){
		register_taxonomy('wordcast_keywords', array('wordcastepisode'), array(
			'hierarchical' => false,
			'labels' => array(
				'name' => __('Keywords', 'wordcast'),
				'singular_name' => __('Keyword', 'wordcast'),
				'search_items' => __('Search Keywords', 'wordcast'),
				'all_items' => __('All Keywords', 'wordcast'),
				'edit_item' => __('Edit Keyword', 'wordcast'),
				'update_item' => __('Update Keyword', 'wordcast'),
				'add_new_item' => __('Add New Keyword', 'wordcast'),
				'new_item_name' => __('New Keyword Name', 'wordcast'),
				'separate_items_with_commas' => __('Separate Keywords with commas', 'wordcast'),
				'add_or_remove_items' => __('Add or remove Keywords', 'wordcast'),
    		'choose_from_most_used' => __('Choose from the most used Keywords', 'wordcast'),
				'menu_name' => __('Keywords', 'wordcast')
			),
			'show_ui' => true,
			'show_in_rest' => true,
			'show_admin_column' => true,
			'query_var' => true
		));
	});