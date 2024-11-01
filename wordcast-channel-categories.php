<?php
	add_action('admin_head', function(){
		
		$wordcast_categories = array(
			'Arts' => array(
				'Design',
				'Fashion & Beauty',
				'Food',
				'Literature',
				'Performing Arts',
				'Visual Arts'
			),
			'Business' => array(
				'Business News',
				'Careers',
				'Investing',
				'Management & Marketing',
				'Shopping'
			),
			'Comedy' => false,
			'Education' => array(
				'Educational Technology',
				'Higher Education',
				'K-12',
				'Language Courses',
				'Training'
			),
			'Games & Hobbies' => array(
				'Automotive',
				'Aviation',
				'Hobbies',
				'Other Games',
				'Video Games'
			),
			'Government & Organizations' => array(
				'Local',
				'National',
				'Non-Profit',
				'Regional'
			),
			'Health' => array(
				'Alternative Health',
				'Fitness & Nutrition',
				'Self-Help',
				'Sexuality'
			),
			'Kids & Family' => false,
			'Music' => false,
			'News & Politics' => false,
			'Religion & Spirituality' => array(
				'Buddhism',
				'Christianity',
				'Hinduism',
				'Islam',
				'Judaism',
				'Other',
				'Spirituality'
			),
			'Science & Medicine' => array(
				'Medicine',
				'Natural Sciences',
				'Social Sciences'
			),
			'Society & Culture' => array(
				'History',
				'Personal Journals',
				'Philosophy',
				'Places & Travel'
			),
			'Sports & Recreation' => array(
				'Amateur',
				'College & High School',
				'Outdoor',
				'Professional'
			),
			'Technology' => array(
				'Gadgets',
				'Tech News',
				'Podcasting',
				'Software How-To'
			),
			'TV & Film' => false
		);
		
		foreach($wordcast_categories as $key => $value){
			if(!term_exists($key, 'wordcast_category')){
				wp_insert_term(
					$key,
					'wordcast_category'
				);
				$term_id = get_term_by('name', $key, 'wordcast_category');
				if($value && $term_id){
					foreach($value as $child){
						wp_insert_term(
							$child,
							'wordcast_category',
							array(
								'parent' => $term_id->term_id
							)
						);
					}
				}
			}
		}
	}, 15);