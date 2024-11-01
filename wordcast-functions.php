<?php
/**
 * Feedback Notice
 * */
function wc_feedback_notice () {
	if ( isset( $_GET['post'] ) && isset( $_GET['action'] ) && $_GET['action'] == 'edit' ) {
	$hitsID = $_GET['post'];
	$hits_post_type = get_post_type($hitsID);
		
		if ( $hits_post_type == 'wordcastepisode'  || $hits_post_type == 'wordcastchannel' ) {
			
			echo '
				<div class="notice notice-info is-dismissible">
					<p>If you have questions or request for features for WordCast please write me on mail@emilwibe.dk</p>
				</div>
			';
			
		}
	}
	
}
add_action('admin_notices', 'wc_feedback_notice');
//REMOVE ADD CATEGORY BUTTON
add_action('admin_footer', function(){
	echo '
		<script>
		
			let
				wordcastAddCat = document.getElementById("wordcast_category-adder")
			;
		
			if(wordcastAddCat){
				wordcastAddCat.parentNode.removeChild(wordcastAddCat);
			}
		
		</script>
	';
});