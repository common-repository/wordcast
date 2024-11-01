<?php
	//RETURNS COMMA SEPARATED LIST OF KEYWORDS - RETURNS FALSE IF NONE
	function wordcast_keywords($POST_ID, $TAXONOMY){
		if(get_the_terms($POST_ID, $TAXONOMY)){
			
			$wordcast_keywords_list = get_the_terms($POST_ID, $TAXONOMY);
			$wordcast_keywords_list_formatted = "";
			foreach($wordcast_keywords_list as $keyword){
				$wordcast_keywords_list_formatted = $wordcast_keywords_list_formatted . $keyword->name . ',';
			}
			$wordcast_keywords_list_formatted = rtrim($wordcast_keywords_list_formatted, ',');
			$wordcast_keywords_list_formatted = htmlspecialchars($wordcast_keywords_list_formatted);
			return $wordcast_keywords_list_formatted;
		} else {
			return false;
		}
	}

	//RETURNS PODCAST FRIENDLY XML OF CATEGORIES
	function wordcast_categories($POST_ID, $TERMS){
		if(get_the_terms($POST_ID, $TERMS)){
			$wordcast_categories_list = get_the_terms($POST_ID, $TERMS);
			$wordcast_categories_arr = array();
			$wordcast_categories_formatted = "";
			
			foreach($wordcast_categories_list as $category){
				if($category->parent){
					if(!isset($wordcast_categories_arr[$category->parent])){
						$wordcast_categories_arr[$category->parent] = array();
					}
					$wordcast_categories_arr[$category->parent][] = $category->term_id;
				} elseif(!isset($wordcast_categories_arr[$category->term_id])){
					$wordcast_categories_arr[$category->term_id] = array();
				}
				
			}
			
			foreach($wordcast_categories_arr as $parent => $child){
				$wordcast_categories_formatted = $wordcast_categories_formatted . "\t\t" . '<itunes:category text="' . get_term($parent)->name . '">' . "\n";
				
				foreach($child as $cat){
					$wordcast_categories_formatted = $wordcast_categories_formatted . "\t\t\t" . '<itunes:category text="' . get_term($cat)->name . '" />' . "\n";
				}
				
				$wordcast_categories_formatted = $wordcast_categories_formatted . "\t\t" . '</itunes:category>' . "\n";
			}
			
			return $wordcast_categories_formatted;
		} else {
			return false;
		}
	}