<?php
	include(plugin_dir_path(__FILE__) . '../functions/MP3File.class.php');
	include(plugin_dir_path(__FILE__) . '../functions/channel-functions.php');

	$int_day = array();
	$int_day[0] = "Sun";
	$int_day[1] = "Mon";
	$int_day[2] = "Tue";
	$int_day[3] = "Wed";
	$int_day[4] = "Thu";
	$int_day[5] = "Fri";
	$int_day[6] = "Sat";

	$int_month = array();
	$int_month[1] = "Jan";
	$int_month[2] = "Feb";
	$int_month[3] = "Mar";
	$int_month[4] = "Apr";
	$int_month[5] = "May";
	$int_month[6] = "Jun";
	$int_month[7] = "Jul";
	$int_month[8] = "Aug";
	$int_month[9] = "Sep";
	$int_month[10] = "Oct";
	$int_month[11] = "Nov";
	$int_month[12] = "Dec";
	
	$channel_meta = array();
	$channel_content = array();

$args = array(
	'post_type' => 'wordcastepisode',
	'posts_per_page' => '1',
	'orderby' => 'modified',
	'order' => 'DESC'
);
$wcModified =  new WP_Query($args);

	if(have_posts()){
		while(have_posts()){
			the_post();
			
			$channel_meta['modified']['time'] = get_the_modified_time('H:i:s', $wcModified->posts[0]->ID);
			$channel_meta['modified']['day'] = $int_day[get_the_modified_time('w', $wcModified->posts[0]->ID)];
			$channel_meta['modified']['date'] = get_the_modified_time('j', $wcModified->posts[0]->ID);
			$channel_meta['modified']['month'] = $int_month[get_the_modified_time('n', $wcModified->posts[0]->ID)];
			$channel_meta['modified']['year'] = get_the_modified_time('Y', $wcModified->posts[0]->ID);
			
			$channel_meta['modified']['string'] = $channel_meta['modified']['day'] . ', ' . gmdate($channel_meta['modified']['date']) . ' ' . $channel_meta['modified']['month'] . ' ' . $channel_meta['modified']['year'] . ' ' . $channel_meta['modified']['time'] . ' GMT';

			$channel_meta['ID'] = get_the_ID();
			$channel_meta['title'] = htmlspecialchars(get_the_title());
			$channel_meta['link'] = get_field('channel_link_wordcast');
			$channel_meta['image'] = false;
			$channel_meta['image'] = get_field('featured_image_wordcast');
			$channel_meta['description'] = htmlspecialchars(get_field('channel_description_wordcast'));
			$channel_meta['language'] = get_field('channel_language_wordcast');
			$channel_meta['subtitle'] = get_field('channel_subtitle_wordcast');
			$channel_meta['author'] = htmlspecialchars(get_field('channel_author_wordcast'));
			$channel_meta['copyright'] = htmlspecialchars(get_field('channel_copyright_wordcast'));
			$channel_meta['owner'] = htmlspecialchars(get_field('channel_owner_wordcast'));
			$channel_meta['owner_mail'] = get_field('channel_owner_mail_wordcast');
			$channel_meta['explicit'] = get_field('channel_explicit_wordcast');
			$channel_meta['categories'] = wordcast_categories($channel_meta['ID'], 'wordcast_category');;
			$channel_meta['type'] = get_field('channel_type_wordcast');
			$channel_meta['blocked'] = get_field('block_channel_wordcast');
		}
	}

$args	= array(
	'post_type' => 'wordcastepisode',
	'posts_per_page' => -1,
	'orderby'  => 'date',
	'order' => 'DESC',
	'meta_query' => array(
		array(
			'key' => 'episode_channel_wordcast',
			'value' => $channel_meta['ID'],
			'type' => 'numeric',
			'compare' => '=='
		)
	)
);

$wcQuery = new WP_Query($args);

if($wcQuery->have_posts()){
	while($wcQuery->have_posts()){
		$wcQuery->the_post();
		
		$episode_published['time'] = gmdate(get_the_date('H:i:s'));
		$episode_published['day'] = $int_day[get_the_date('w')];
		$episode_published['date'] = get_the_date('j');
		$episode_published['month'] = $int_month[get_the_date('n')];
		$episode_published['year'] = get_the_date('Y');
		
		$episode_published['string'] = $episode_published['day'] . ', ' . $episode_published['date'] . ' ' . $episode_published['month'] . ' ' . $episode_published['year'] . ' ' . $episode_published['time'] . ' GMT';
			
		/**
		* test if podcast file is external
		*/
		$ewwc_file_url;
		$ewwc_file_length;
		$ewwc_file_mime_type;
		
		if ( get_field('external_episode_link_wordcast') ) {
			$ewwc_file_url = get_field('external_episode_link_wordcast');
			$ch = curl_init($ewwc_file_url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  		curl_exec($ch);
			
			$ewwc_file_mime_type = curl_getinfo($ch, CURLINFO_CONTENT_TYPE);
			$ewwc_file_length = curl_getinfo($ch, CURLINFO_CONTENT_LENGTH_DOWNLOAD);
		} else {
			$ewwc_file_url = wp_get_attachment_url(get_field('file_episode_wordcast'));
			$ewwc_file_length = filesize(get_attached_file(get_field('file_episode_wordcast')));
			$ewwc_file_mime_type = return_mime_type(get_attached_file(get_field('file_episode_wordcast')));
		}
		
		$channel_content[] = array(
			
			'ID' => get_the_ID(),
			'title' => htmlspecialchars(get_the_title()),
			'length' => $ewwc_file_length,
			'mime_type' => $ewwc_file_mime_type,
			'file_url' => $ewwc_file_url,
			'file_meta' => wp_get_attachment_metadata(get_field('file_episode_wordcast')),
			'pub_date' => $episode_published['string'],
			'description' => htmlspecialchars(get_field('description_episode_wordcast')),
			'subtitle' => htmlspecialchars(get_field('episode_subtitle_wordcast')),
			'type' => get_field('type_episode_wordcast'),
			'image' => get_field('featured_image_wordcast'),
			'explicit' => get_field('explicit_episode_wordcast'),
			'categories' => wordcast_categories(get_the_ID(), 'wordcast_category'),
			'keywords' => wordcast_keywords(get_the_ID(), 'wordcast_keywords'),
			'blocked' => get_field('block_episode_wordcast'),
			'episode_type' => get_field('episodetype_episode_wordcast'),
			'season' => get_field('season_episode_wordcast'),
			'episode_number' => get_field('number_episode_wordcast')
		);
	}
	wp_reset_postdata();
	
	foreach($channel_content as $key => $value){
		if(isset($value['file_meta']["length_formatted"])){
			$channel_content[$key]['duration'] = $value['file_meta']['length_formatted'];
		} elseif(strtolower(pathinfo($value['file_url'], PATHINFO_EXTENSION)) == 'mp3' || strtolower(pathinfo($value['file_url'], PATHINFO_EXTENSION)) == 'mp4'){
			$mp3file = new MP3File($value['file_url']);
			$duration = $mp3file->getDuration();
			$channel_content[$key]['duration'] = MP3File::formatTime($duration);
		}
	}
}