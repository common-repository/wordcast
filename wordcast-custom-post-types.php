<?php
add_action('init', 'wordcast_custom_pt');

function wordcast_custom_pt(){
  register_post_type('wordcastepisode', array(
    'labels' => array(
      'name' =>								__('WordCast Episodes', 'wordcast'),
      'singular_name' =>			__('WordCast Episode', 'wordcast'),
      'add_new' => 						__('Add New', 'wordcast'),
      'add_new_item' =>				__('Add New Episode', 'wordcast'),
			'edit' =>								__('Edit', 'wordcast'),
			'edit_item' =>					__('Edit Episode', 'wordcast'),
			'new_item' =>						__('New Episode', 'wordcast'),
			'view' =>								__('View Episode', 'wordcast'),
			'view_item' =>					__('View Episode', 'wordcast'),
			'search_items' =>				__('Search Episodes', 'wordcast'),
			'not_found' =>					__('No Episodes found', 'wordcast'),
			'not_found_in_trash' =>	__('No Episodes found in Trash', 'wordcast'),
			'parent' =>							__('Parent Episode', 'wordcast')
			
    ),
    'public' => true,
    'has_archive' => true,
    'show_in_rest' => true,
    'show_in_menu' => 'WordCast_admin',
    'supports' => array('title','author')
  ));
  register_post_type('wordcastchannel', array(
    'labels' => array(
      'name' =>								__('WordCast Channels', 'wordcast'),
      'singular_name' =>			__('WordCast Channel', 'wordcast'),
      'add_new' =>						__('Add New', 'wordcast'),
      'add_new_item' =>				__('Add New Channel', 'wordcast'),
			'edit' =>								__('Edit', 'wordcast'),
			'edit_item' =>					__('Edit Channel', 'wordcast'),
			'new_item' =>						__('New Channel', 'wordcast'),
			'view' =>								__('View Channel', 'wordcast'),
			'view_item' =>					__('View Channel', 'wordcast'),
			'search_items' =>				__('Search Channels', 'wordcast'),
			'not_found' =>					__('No Channels found', 'wordcast'),
			'not_found_in_trash' =>	__('No Channels found in Trash', 'wordcast'),
			'parent' =>							__('Parent Channel', 'wordcast')
    ),
    'public' => true,
    'has_archive' => true,
    'show_in_rest' => true,
    'show_in_menu' => 'WordCast_admin',
		'supports' => array('title', 'author')
  ));
}

//CUSTOM COLUMNS
add_filter('manage_wordcastepisode_posts_columns', function($columns){
  $newColumns = array();
	$newColumns['cb'] = 'cb';
  $newColumns['title'] = 'title';
  $newColumns['wordcastchannel'] = __('WordCast Channel', 'wordcast');
  $newColumns['author'] = 'author';
	//FUTURE FEATURE
	/*$newColumns['wordcastcategories'] = __('categories', 'wordcast');*/
	/*$newColumns['wordcastkeywords'] = __('keywords', 'wordcast');*/
  $newColumns['date'] = 'date';
  return $newColumns;
});

add_filter('manage_wordcastchannel_posts_columns', function($columns){
	$newColumns = array();
	$newColumns['cb'] = 'cb';
	$newColumns['title'] = 'title';
	$newColumns['author'] = 'author';
	//FUTURE FEATURE
	/*$newColumns['wordcastcategories'] = __('categories', 'wordcast');*/
	$newColumns['wordcastfeedurl'] = __('Podcast Feed URL', 'wordcast');
	$newColumns['date'] = 'date';
	return $newColumns;
});

if(function_exists('acf_add_local_field_group')){
	
	add_action('manage_wordcastepisode_posts_custom_column', function($column, $post_id){
 		switch($column){
    	case 'wordcastchannel' :
      	echo get_the_title(get_field('episode_channel_wordcast'));
				break;
			//FUTURE FEATURE
			/*case 'wordcastcategories' :
				the_terms($post_id, 'wordcast_category');
				break;*/
			/*case 'wordcastkeywords' :
				the_terms($post_id, 'wordcast_keywords');
				break;*/
		}
	}, 10, 2);
	
	add_action('manage_wordcastchannel_posts_custom_column', function($column, $post_id){
 		switch($column){
    	case 'wordcastfeedurl' :
      	echo '<a href="' . get_the_permalink() . '" target="_blank">' . get_the_permalink() . '</a>';
				break;
			//FUTURE FEATURE
			/*case 'wordcastcategories' :
				the_terms($post_id, 'wordcast_category');
				break;*/
		}
	}, 10, 2);
}

add_filter('manage_edit-wordcastepisode_sortable_columns', function($columns){
  $columns['wordcastchannel'] = 'wordcastchannel';
  $columns['author'] = 'author';
  
  return $columns;
});

add_filter('the_content', function($content){
	if(get_post_type() === 'wordcastepisode'){
		$wordcast_file_meta = wp_get_attachment_metadata(get_field('file_episode_wordcast'));
		
		$wordcast_episode_content = array();
		
		if($wordcast_file_meta["mime_type"] === 'video/mp4'){
			$wordcast_episode_content[] = '<video controls>
  			<source src="' . wp_get_attachment_url(get_field('file_episode_wordcast')) . '" type="video/mp4">
  			Your browser does not support HTML5 video.
				</video>';
		} else {
			$wordcast_episode_content[] = '<audio controls>
  			<source src="' . wp_get_attachment_url(get_field('file_episode_wordcast')) . '" type="' . $wordcast_file_meta["mime_type"] . '">
				Your browser does not support the audio element.
				</audio>';
		}
		
		$wordcast_episode_content[] = '<p>' . get_field('description_episode_wordcast') . '</p>';
		
		
		$content = implode(" ", $wordcast_episode_content);
	}
	return $content;
});