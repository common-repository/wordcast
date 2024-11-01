<?php
add_action('admin_menu', function(){
	add_menu_page(
		'WordCast',
		'WordCast',
		'edit_posts',
		'WordCast_admin',
		function(){
			//THIS FUNCTION ROCKS
		},
		'dashicons-controls-volumeon',
		4		
	);
});