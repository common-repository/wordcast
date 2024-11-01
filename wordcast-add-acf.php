<?php
add_action('plugins_loaded', function(){
	if(!class_exists('ACF') || !class_exists('ACF_PRO')){
		add_action('tgmpa_register', function(){
			$plugins = array(
				array(
					'name' => 'Advanced Custom Fields',
					'slug' => 'advanced-custom-fields',
					'required' => false
				)
			);
			$config = array(
				'id' => 'wordcast',
				'has_notices'  => true, // Show admin notices
    		'dismissable'  => false, // the notices are NOT dismissable
    		'dismiss_msg'  => __('For WordCast to work AT ALL You need to install this plugin, okay?<br>(ACF PRO WILL ALSO WORK 🤘)', 'wordcast'), // this message will be output at top of nag
    		'is_automatic' => true, // automatically activate plugins after installation
    		'message'      => '<!--Hey there.-->', // message to output right before the plugins table
	);
 
	tgmpa( $plugins, $config );
});

	}
});