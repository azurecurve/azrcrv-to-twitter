<?php
/** 
 * ------------------------------------------------------------------------------
 * Plugin Name: To Twitter
 * Description: Automatically tweets when posts published.
 * Version: 1.8.0
 * Author: azurecurve
 * Author URI: https://development.azurecurve.co.uk/classicpress-plugins/
 * Plugin URI: https://development.azurecurve.co.uk/classicpress-plugins/to-twitter/
 * Text Domain: to-twitter
 * Domain Path: /languages
 * ------------------------------------------------------------------------------
 * This is free sottware released under the terms of the General Public License,
 * version 2, or later. It is distributed WITHOUT ANY WARRANTY; without even the
 * implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. Full
 * text of the license is available at https://www.gnu.org/licenses/gpl-2.0.html.
 * ------------------------------------------------------------------------------
 */

// Prevent direct access.
if (!defined('ABSPATH')){
	die();
}

// include plugin menu
require_once(dirname(__FILE__).'/pluginmenu/menu.php');
add_action('admin_init', 'azrcrv_create_plugin_menu_tt');

// include update client
require_once(dirname(__FILE__).'/libraries/updateclient/UpdateClient.class.php');

// include twitteroauth
require "libraries/twitteroauth/autoload.php";
use Abraham\TwitterOAuth\TwitterOAuth;

/**
 * Setup registration activation hook, actions, filters and shortcodes.
 *
 * @since 1.0.0
 *
 */
// register activation hook
register_activation_hook(__FILE__, 'azrcrv_tt_schedule_post_tweet_monday');
register_activation_hook(__FILE__, 'azrcrv_tt_schedule_post_tweet_tuesday');
register_activation_hook(__FILE__, 'azrcrv_tt_schedule_post_tweet_wednesday');
register_activation_hook(__FILE__, 'azrcrv_tt_schedule_post_tweet_thursday');
register_activation_hook(__FILE__, 'azrcrv_tt_schedule_post_tweet_friday');
register_activation_hook(__FILE__, 'azrcrv_tt_schedule_post_tweet_saturday');
register_activation_hook(__FILE__, 'azrcrv_tt_schedule_post_tweet_sunday');

register_activation_hook(__FILE__, 'azrcrv_tt_schedule_page_tweet_monday');
register_activation_hook(__FILE__, 'azrcrv_tt_schedule_page_tweet_tuesday');
register_activation_hook(__FILE__, 'azrcrv_tt_schedule_page_tweet_wednesday');
register_activation_hook(__FILE__, 'azrcrv_tt_schedule_page_tweet_thursday');
register_activation_hook(__FILE__, 'azrcrv_tt_schedule_page_tweet_friday');
register_activation_hook(__FILE__, 'azrcrv_tt_schedule_page_tweet_saturday');
register_activation_hook(__FILE__, 'azrcrv_tt_schedule_page_tweet_sunday');

// add actions
add_action('admin_init', 'azrcrv_tt_set_default_options');
add_action('admin_menu', 'azrcrv_tt_create_admin_menu');
add_action('admin_menu', 'azrcrv_tt_add_sidebar_metabox');
add_action('save_post', 'azrcrv_tt_save_sidebar_metabox', 10, 1);
add_action( 'add_meta_boxes', 'azrcrv_tt_create_tweet_metabox' );
add_action( 'save_post', 'azrcrv_tt_save_tweet_metabox', 11, 2 );
add_action( 'wp_insert_post', 'azrcrv_tt_autopost_tweet', 12, 2 );
add_action( 'transition_post_status', 'azrcrv_tt_post_status_transition', 13, 3 );
add_action('admin_post_azrcrv_tt_save_options', 'azrcrv_tt_save_options');
add_action('admin_post_azrcrv_tt_send_tweet', 'azrcrv_tt_send_tweet');
add_action('admin_post_azrcrv_tt_schedule_tweet', 'azrcrv_tt_schedule_tweet');
add_action('admin_post_azrcrv_tt_delete_scheduled_tweet', 'azrcrv_tt_delete_scheduled_tweet');
add_action('plugins_loaded', 'azrcrv_tt_load_languages');
add_action( 'azrcrv_tt_scheduled_post_tweet_monday', 'azrcrv_tt_scheduled_post_send_tweet_monday' );
add_action( 'azrcrv_tt_scheduled_post_tweet_tuesday', 'azrcrv_tt_scheduled_post_send_tweet_tuesday' );
add_action( 'azrcrv_tt_scheduled_post_tweet_wednesday', 'azrcrv_tt_scheduled_post_send_tweet_wednesday' );
add_action( 'azrcrv_tt_scheduled_post_tweet_thursday', 'azrcrv_tt_scheduled_post_send_tweet_thursday' );
add_action( 'azrcrv_tt_scheduled_post_tweet_friday', 'azrcrv_tt_scheduled_post_send_tweet_friday' );
add_action( 'azrcrv_tt_scheduled_post_tweet_saturday', 'azrcrv_tt_scheduled_post_send_tweet_saturday' );
add_action( 'azrcrv_tt_scheduled_post_tweet_sunday', 'azrcrv_tt_scheduled_post_send_tweet_sunday' );
add_action( 'azrcrv_tt_scheduled_page_tweet_monday', 'azrcrv_tt_scheduled_page_send_tweet_monday' );
add_action( 'azrcrv_tt_scheduled_page_tweet_tuesday', 'azrcrv_tt_scheduled_page_send_tweet_tuesday' );
add_action( 'azrcrv_tt_scheduled_page_tweet_wednesday', 'azrcrv_tt_scheduled_page_send_tweet_wednesday' );
add_action( 'azrcrv_tt_scheduled_page_tweet_thursday', 'azrcrv_tt_scheduled_page_send_tweet_thursday' );
add_action( 'azrcrv_tt_scheduled_page_tweet_friday', 'azrcrv_tt_scheduled_page_send_tweet_friday' );
add_action( 'azrcrv_tt_scheduled_page_tweet_saturday', 'azrcrv_tt_scheduled_page_send_tweet_saturday' );
add_action( 'azrcrv_tt_scheduled_page_tweet_sunday', 'azrcrv_tt_scheduled_page_send_tweet_sunday' );

// add filters
add_filter('plugin_action_links', 'azrcrv_tt_add_plugin_action_link', 10, 2);

/**
 * Load language files.
 *
 * @since 1.0.0
 *
 */
function azrcrv_tt_load_languages() {
    $plugin_rel_path = basename(dirname(__FILE__)).'/languages';
    load_plugin_textdomain('to-twitter', false, $plugin_rel_path);
}

/**
 * Set default options for plugin.
 *
 * @since 1.0.0
 *
 */
function azrcrv_tt_set_default_options($networkwide){
	
	$option_name = 'azrcrv-tt';
	
	$new_options = array(
						'access_key' => '',
						'access_secret' => '',
						'access_token' => '',
						'access_token_secret' => '',
						'default_autopost' => 0,
						'default-autopost-after-delay' => 0,
						'default-autopost-delay-prefix' => 'ICYMI:',
						'default-autopost-delay-number' => 1,
						'default-autopost-delay-unit' => 'hour',
						'default_autopost_page' => 0,
						'default-autopost-page-after-delay' => 0,
						'default-autopost-page-delay-prefix' => 'ICYMI:',
						'default-autopost-page-delay-number' => 1,
						'default-autopost-page-delay-unit' => 'day',
						'record_tweet_history' => 1,
						'prefix_tweets_with_dot' => 1,
						'category-hashtags' => array(),
						'tag-hashtags' => array(),
						'word-replacement' => array(),
						'scheduled-post' => array(
													0 => array(
																'time' => '11:00',
																'filter' => 'Is',
																'category' => 'all',
																'tag' => 'all',
																'enabled' => 0,
															),
													1 => array(
																'time' => '11:00',
																'filter' => 'Is',
																'category' => 'all',
																'tag' => 'all',
																'enabled' => 0,
															),
													2 => array(
																'time' => '11:00',
																'filter' => 'Is',
																'category' => 'all',
																'tag' => 'all',
																'enabled' => 0,
															),
													3 => array(
																'time' => '11:00',
																'filter' => 'Is',
																'category' => 'all',
																'tag' => 'all',
																'enabled' => 0,
															),
													4 => array(
																'time' => '11:00',
																'filter' => 'Is',
																'category' => 'all',
																'tag' => 'all',
																'enabled' => 0,
															),
													5 => array(
																'time' => '11:00',
																'filter' => 'Is',
																'category' => 'all',
																'tag' => 'all',
																'enabled' => 0,
															),
													6 => array(
																'time' => '11:00',
																'filter' => 'Is',
																'category' => 'all',
																'tag' => 'all',
																'enabled' => 0,
															),
												),
						'scheduled-tweet-generate' => 0,
						'scheduled-tweet-prefix' => 'ICYMI:',
						'scheduled-tweet-suffix' => 0,
						'newest-post-age' => 181,
						'excluded-tags' => array(),
						'scheduled-page' => array(
													0 => array(
																'time' => '15:00',
																'filter' => 'Contains',
																'textcontains' => '',
																'enabled' => 0,
															),
													1 => array(
																'time' => '15:00',
																'filter' => 'Contains',
																'textcontains' => '',
																'enabled' => 0,
															),
													2 => array(
																'time' => '15:00',
																'filter' => 'Contains',
																'textcontains' => '',
																'enabled' => 0,
															),
													3 => array(
																'time' => '15:00',
																'filter' => 'Contains',
																'textcontains' => '',
																'enabled' => 0,
															),
													4 => array(
																'time' => '15:00',
																'filter' => 'Contains',
																'textcontains' => '',
																'enabled' => 0,
															),
													5 => array(
																'time' => '15:00',
																'filter' => 'Contains',
																'textcontains' => '',
																'enabled' => 0,
															),
													6 => array(
																'time' => '15:00',
																'filter' => 'Contains',
																'textcontains' => '',
																'enabled' => 0,
															),
												),
						'scheduled-page-tweet-generate' => 0,
						'scheduled-page-tweet-prefix' => 'ICYMI:',
						'scheduled-page-tweet-suffix' => 0,
						'newest-page-age' => 0,
						'updated' => strtotime('2020-04-04'),
					);
	
	// set defaults for multi-site
	if (function_exists('is_multisite') && is_multisite()){
		// check if it is a network activation - if so, run the activation function for each blog id
		if ($networkwide){
			global $wpdb;

			$blog_ids = $wpdb->get_col("SELECT blog_id FROM $wpdb->blogs");
			$original_blog_id = get_current_blog_id();

			foreach ($blog_ids as $blog_id){
				switch_to_blog($blog_id);
				
				azrcrv_tt_update_options($option_name, $new_options, false);
			}

			switch_to_blog($original_blog_id);
		}else{
			azrcrv_tt_update_options( $option_name, $new_options, false);
		}
		if (get_site_option($option_name) === false){
			azrcrv_tt_update_options($option_name, $new_options, true);
		}
	}
	//set defaults for single site
	else{
		azrcrv_tt_update_options($option_name, $new_options, false);
	}
}

/**
 * Update options.
 *
 * @since 1.7.1
 *
 */
function azrcrv_tt_update_options($option_name, $new_options, $is_network_site){
	if ($is_network_site == true){
		if (get_site_option($option_name) === false){
			add_site_option($option_name, $new_options);
		}else{
			$options = get_site_option($option_name);
			if (!isset($options['updated']) OR $options['updated'] < $new_options['updated'] ){
				$options['updated'] = $new_options['updated'];
				update_site_option($option_name, azrcrv_tt_update_default_options($options, $new_options));
			}
		}
	}else{
		if (get_option($option_name) === false){
			add_option($option_name, $new_options);
		}else{
			$options = get_option($option_name);
			if (!isset($options['updated']) OR $options['updated'] < $new_options['updated'] ){
				$options['updated'] = $new_options['updated'];
				update_option($option_name, azrcrv_tt_update_default_options($options, $new_options));
			}
		}
	}
}

/**
 * Add default options to existing options.
 *
 * @since 1.7.1
 *
 */
function azrcrv_tt_update_default_options( &$default_options, $current_options ) {
    $default_options = (array) $default_options;
    $current_options = (array) $current_options;
    $updated_options = $current_options;
    foreach ($default_options as $key => &$value) {
        if (is_array( $value) && isset( $updated_options[$key])){
            $updated_options[$key] = azrcrv_tt_update_default_options($value, $updated_options[$key]);
        } else {
			$updated_options[$key] = $value;
        }
    }
    return $updated_options;
}

/**
 * Add To Twitter action link on plugins page.
 *
 * @since 1.0.0
 *
 */
function azrcrv_tt_add_plugin_action_link($links, $file){
	static $this_plugin;

	if (!$this_plugin){
		$this_plugin = plugin_basename(__FILE__);
	}

	if ($file == $this_plugin){
		$settings_link = '<a href="'.get_bloginfo('wpurl').'/wp-admin/admin.php?page=azrcrv-tt"><img src="'.plugins_url('/pluginmenu/images/Favicon-16x16.png', __FILE__).'" style="padding-top: 2px; margin-right: -5px; height: 16px; width: 16px;" alt="azurecurve" />'.esc_html__('Settings' ,'to-twitter').'</a>';
		array_unshift($links, $settings_link);
	}

	return $links;
}

/**
 * Add to menu.
 *
 * @since 1.0.0
 *
 */
function azrcrv_tt_create_admin_menu(){
	
    add_menu_page(
				__('To Twitter', 'to-twitter')
				,__('To Twitter','to-twitter')
				,'manage_options'
				,'azrcrv-tt'
				,'azrcrv_tt_display_options'
				,'dashicons-twitter', 50);
    
	add_submenu_page(
				'azrcrv-tt'
				,__('Settings', 'to-twitter')
				,__('Settings', 'to-twitter')
				,'manage_options'
				,'azrcrv-tt'
				,'azrcrv_tt_display_options');
				
    add_submenu_page(
				'azrcrv-tt'
				,__('Send Tweet', 'to-twitter')
				,__('Send Tweet', 'to-twitter')
				,'manage_options'
				,'azrcrv-tt-smt'
				,'azrcrv_tt_display_send_manual_tweet');
				
    add_submenu_page(
				'azrcrv-tt'
				,__('Scheduled Tweets', 'to-twitter')
				,__('Scheduled Tweets', 'to-twitter')
				,'manage_options'
				,'azrcrv-tt-st'
				,'azrcrv_tt_display_schedule_tweet');
	
	add_submenu_page("azrcrv-plugin-menu"
						,__("To Twitter", "to-twitter")
						,__("To Twitter", "to-twitter")
						,'manage_options'
						,'azrcrv-tt'
						,'azrcrv_tt_display_options');
	
	
    wp_enqueue_script("to-twitter-js", plugins_url('assets/jquery/jquery.js', __FILE__), array('jquery', 'jquery-ui-core', 'jquery-ui-tabs'));
    wp_enqueue_style("to-twitter-css", plugins_url('assets/css/styles.css', __FILE__), array('colors-fresh'), '1.7.0');
    wp_enqueue_style("to-twitter-css-ui", plugins_url('assets/css/styles-ui.css', __FILE__), array('to-twitter-css'), '1.7.0');
}

/**
 * Add post metabox to sidebar.
 *
 * @since 1.0.0
 *
 */
function azrcrv_tt_add_sidebar_metabox(){
	add_meta_box('azrcrv-tt-box', esc_html__('Autopost Tweet', 'to-twitter'), 'azrcrv_tt_generate_sidebar_metabox', array('post','page'), 'side', 'default');	
}

/**
 * Generate post sidebar metabox.
 *
 * @since 1.0.0
 *
 */
function azrcrv_tt_generate_sidebar_metabox(){
	
	global $post;
	
	$options = get_option('azrcrv-tt');
	
	if(metadata_exists('post', $post->ID, '_azrcrv_tt_autopost')) {
		$autopost = get_post_meta($post->ID, '_azrcrv_tt_autopost', true);
	}else{
		if ($post->post_type == 'post'){
			$autopost = $options['default_autopost'];
		}else{
			$autopost = $options['default_autopost_page'];
		}
	}
	
	if(metadata_exists('post', $post->ID, '_azrcrv_tt_autopost_after_delay')) {
		$autopost_after_delay = get_post_meta($post->ID, '_azrcrv_tt_autopost_after_delay', true);
	}else{
		if ($post->post_type == 'post'){
			$autopost_after_delay = $options['default-autopost-after-delay'];
		}else{
			$autopost_after_delay = $options['default-autopost-page-after-delay'];
		}
	}
	
	$tweeted = get_post_meta($post->ID, '_azrcrv_tt_tweeted', true);
	?>
	<p class="autopost">
		<?php wp_nonce_field(basename(__FILE__), 'azrcrv-tt-nonce');
		if ($tweeted == 1){
			if ($post->post_type == 'post'){
				printf( '<p>'.esc_html__('This post has already been tweeted', 'to-twitter').'</p>');
			}else{
				printf( '<p>'.esc_html__('This page has already been tweeted', 'to-twitter').'</p>');
			}
		}
		?>
		<p><input type="checkbox" name="autopost" <?php if( $autopost == 1 ) { ?>checked="checked"<?php } ?> />  <?php esc_html_e('Post tweet on publish/update?', 'to-twitter'); ?></p>
		<p>
			<label for="hashtags">Hashtags</label><br/>
			<?php
				$hashtags = get_post_meta($post->ID, '_azrcrv_tt_hashtags', true);
				if (strlen($hashtags) == 0){
					$hashtags = azrcrv_tt_get_hashtags($post->ID);
				}
			?>
			<input name="hashtags" type="text" style="width: 100%;" value="<?php echo $hashtags; ?>" />
		</p>
		
		<p><input type="checkbox" name="autopost-after-delay" <?php if( $autopost_after_delay == 1 ) { ?>checked="checked"<?php } ?> />  <?php esc_html_e('Post retweet on delay after post/update?', 'to-twitter'); ?></p>
		
		<p><input type="checkbox" name="exclude-schedule" />  <?php esc_html_e('Exclude from schedule', 'to-twitter'); ?></p>
	</p>
	
<?
}

/**
 * Load default hashtags.
 *
 * @since 1.2.0
 *
 */
function azrcrv_tt_get_hashtags($post_id){
	
	$hashtags = get_post_meta( $post_id, '_azrcrv_tt_hashtags', true );
	
	if (strlen($hashtags) == 0){
	
		$options = get_option('azrcrv-tt');
		
		$hashtags = array();
		
		$categories = wp_get_post_categories($post_id);
		foreach($categories as $category){
			$cat = get_category($category);
			$items = explode(' ', $options['category-hashtags'][$cat->term_id]);
			foreach($items as $item){
				if (strlen($item) > 0 ){
					$hashtags[] = $item;
				}
			}
		}
		
		$tags = wp_get_post_tags($post_id);
		foreach($tags as $tag){
			$t = get_tag($tag);
			$items = explode(' ', $options['tag-hashtags'][$t->term_id]);
			foreach($items as $item){
				if (strlen($item) > 0 ){
					$hashtags[] = $item;
				}
			}
		}
		
		sort($hashtags);
		$newhashtags = array_unique($hashtags);
		
		return implode(' ', $newhashtags);
	}
}

/**
 * Save To Twitter Sidebar Metabox.
 *
 * @since 1.0.0
 *
 */
function azrcrv_tt_save_sidebar_metabox($post_id){
	
	if(! isset($_POST[ 'azrcrv-tt-nonce' ]) || ! wp_verify_nonce($_POST[ 'azrcrv-tt-nonce' ], basename(__FILE__))){
		return $post_id;
	}
	
	if(defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
		return $post_id;
	
	if(! current_user_can('edit_post', $post_id)){
		return $post_id;
	}
	
	$post_type = get_post_type( $post_ID );
	
    if ($post_type == 'post'||$post_type == 'page') {
		if (isset($_POST['autopost'])){
			$autopost = 1;
		}else{
			$autopost = 0;
		}
		
		if (isset($_POST['autopost-after-delay'])){
			$autopost_after_delay = 1;
		}else{
			$autopost_after_delay = 0;
		}
		
		if (isset($_POST['exclude-schedule'])){
			$exclude = 1;
		}else{
			$exclude = 0;
		}
		
		update_post_meta($post_id, '_azrcrv_tt_autopost', $autopost);
		update_post_meta($post_id, '_azrcrv_tt_autopost_after_delay', $autopost_after_delay);
		update_post_meta($post_id, '_azrcrv_tt_exclude_schedule', $exclude);
		update_post_meta($post_id, '_azrcrv_tt_hashtags', esc_attr($_POST['hashtags']));
	}
	
	return esc_attr($_POST[ 'autopost' ]);
}

/**
 * Create the post tweet metabox
 *
 * @since 1.0.0
 *
 */
function azrcrv_tt_create_tweet_metabox() {

	// Can only be used on a single post type (ie. page or post or a custom post type).
	// Must be repeated for each post type you want the metabox to appear on.
	add_meta_box(
		'azrcrv_tt_tweet_metabox', // Metabox ID
		'Tweet', // Title to display
		'azrcrv_tt_render_tweet_metabox', // Function to call that contains the metabox content
		array('post','page'), // Post type to display metabox on
		'normal', // Where to put it (normal = main colum, side = sidebar, etc.)
		'default' // Priority relative to other metaboxes
	);

}

/**
 * Render the post tweet metabox markup
 *
 * @since 1.0.0
 *
 */
function azrcrv_tt_render_tweet_metabox() {
	// Variables
	global $post; // Get the current post data
	$post_tweet = get_post_meta( $post->ID, '_azrcrv_tt_post_tweet', true ); // Get the saved values
	?>

		<fieldset>
			<div>
				<table style="width: 100%; border-collapse: collapse;">
					<tr>
						<td style="width: 100%;">
							<input
								type="text"
								name="post_tweet"
								id="post_tweet"
								class="large-text"
								value="<?php echo esc_attr( $post_tweet ); ?>"
							><br />
							<?php printf(__('%s placeholder is replaced with the URL when the post is published.', 'to-twitter'), '<strong>%s</strong>'); ?><br />
							<?php printf(__('To regenerate tweet blank the field and update post.', 'to-twitter'), '%s'); ?>
							
							<p>
							<?php
							if(metadata_exists('post', $post->ID, '_azrcrv_tt_tweet_history')) {
								echo '<strong>'.__('Previous Tweets', 'to-twitter').'</strong><br />';
								foreach(array_reverse(get_post_meta($post->ID, '_azrcrv_tt_tweet_history', true )) as $key => $tweet){
									echo '•&nbsp;'.$key.' - <em>'.$tweet.'</em><br />';
								}	
							}
							?>
							</p>
						<td>
					</tr>
				</table>
			</div>
		</fieldset>

	<?php
	// Security field
	// This validates that submission came from the
	// actual dashboard and not the front end or
	// a remote server.
	wp_nonce_field( 'azrcrv_tt_form_tweet_metabox_nonce', 'azrcrv_tt_form_tweet_metabox_process' );
}

/**
 * Save the post tweet metabox
 * @param  Number $post_id The post ID
 * @param  Array  $post    The post data
 *
 * @since 1.0.0
 *
 */
function azrcrv_tt_save_tweet_metabox( $post_id, $post ) {

	// Verify that our security field exists. If not, bail.
	if ( !isset( $_POST['azrcrv_tt_form_tweet_metabox_process'] ) ) return;

	// Verify data came from edit/dashboard screen
	if ( !wp_verify_nonce( $_POST['azrcrv_tt_form_tweet_metabox_process'], 'azrcrv_tt_form_tweet_metabox_nonce' ) ) {
		return $post->ID;
	}

	// Verify user has permission to edit post
	if ( !current_user_can( 'edit_post', $post->ID )) {
		return $post->ID;
	}
	
	if (strlen($_POST['post_tweet']) == 0){
		$additional_hashtags_string = get_post_meta($post->ID, '_azrcrv_tt_hashtags', true);
		
		if (strlen($additional_hashtags_string) == 0){
			$additional_hashtags = explode(' ', azrcrv_tt_get_hashtags($post->ID));
		}else{
			$additional_hashtags = explode(' ', $additional_hashtags_string);
		}
		
		$tweet = $post->post_title;
		
		$options = get_option('azrcrv-tt');
		
		foreach($options['word-replacement'] as $word => $replacement){
			if (stristr($tweet, $word)){
				if (substr($replacement, 0, 1) == '#'){
					$additional_hashtags = array_diff($additional_hashtags, array($replacement));
				}
				$tweet = str_ireplace($word, $replacement, $tweet);
			}
		}
		$additional_hashtags_string = implode(' ', $additional_hashtags);
				
		$url = '%s';
		
		if ($options['prefix_tweets_with_dot'] == 1){
			if (substr($tweet, 0, 1) == '@'){
				$tweet = '.'.$tweet;
			}
		}
		
		$post_tweet = $tweet.' '.$url.' '.$additional_hashtags_string; //text for your tweet.
	}else{
		/**
		 * Sanitize the submitted data
		 */
		$post_tweet = sanitize_text_field( $_POST['post_tweet'] );
	}
	// Save our submissions to the database
	update_post_meta( $post->ID, '_azrcrv_tt_post_tweet', $post_tweet );

}

/**
 * Post status changes to "publish".
 *
 * @since 1.0.0
 *
 */
function azrcrv_tt_post_status_transition($new_status, $old_status, $post) { 
    if (($post->post_type == 'post'||$post->post_type == 'page') && $new_status == 'publish'){	// && $old_status != 'publish') {
		azrcrv_tt_autopost_tweet($post->ID, $post);
    }
}

/**
 * Autopost tweet for post when status changes to "publish".
 *
 * @since 1.0.0
 *
 */
function azrcrv_tt_autopost_tweet($post_id, $post){
    remove_action( 'wp_insert_post', 'updated_to_publish', 10, 2 );
	
	if (($post->post_type == 'post'||$post->post_type == 'page') && $post->post_status == 'publish'){
		
		$autopost = get_post_meta( $post->ID, '_azrcrv_tt_autopost', true );
		
		if ($autopost == 1){
			
			$post_tweet = get_post_meta( $post_id, '_azrcrv_tt_post_tweet', true ); // get tweet content
			
			if (strlen($post_tweet) > 0){
			
				if (function_exists('azrcrv_urls_get_custom_shortlink')){
					$url = azrcrv_urls_get_custom_shortlink($post_id);
				}else{
					$url = get_permalink($post_id);
				}
				$post_tweet = sprintf($post_tweet, $url);
				
				$tweet_post_status = azrcrv_tt_post_tweet($post_tweet);
				
				if ($tweet_post_status == 200) {
					update_post_meta($post_id, '_azrcrv_tt_autopost', ''); // remove autpost tweet fag
					update_post_meta($post_id, '_azrcrv_tt_tweeted', 1); // set tweeted flag = true
					update_post_meta( $post_id, '_azrcrv_tt_post_tweet', $post_tweet );
					
					$options = get_option('azrcrv-tt');
					
					if ($options['record_tweet_history'] == 1){
						$dateTime = date(get_option('date_format').' '.get_option('time_format'),strtotime(get_option('gmt_offset').' hours'));
						if (metadata_exists('post',$post_id,'_azrcrv_tt_tweet_history')){

							$tweet_history = get_post_meta($post_id, '_azrcrv_tt_tweet_history', true);
							$tweet_history[$dateTime] = $post_tweet;
							update_post_meta($post_id, '_azrcrv_tt_tweet_history',$tweet_history);

						} else {
							update_post_meta($post_id, '_azrcrv_tt_tweet_history',array($dateTime => $post_tweet));   
						}
					}
					
					/* send icymi */
					$autopost_after_delay = get_post_meta($post_id, '_azrcrv_tt_autopost_after_delay', true);
					if ($autopost_after_delay == 1){
						$scheduled_tweets = get_option('azrcrv-tt-scheduled-tweets');
						$schedule_id = $post_id;
						$icymi_date = date("Y-m-d H:i:s");
						$icymi_date = strtotime($icymi_date);
						
						$prefix = '';
						if (get_post_type($schedule_id) === 'post') {
							$prefix = $options['default-autopost-delay-prefix'];
							
							$number = $options['default-autopost-delay-number'];
						
							if ($options['default-autopost-delay-unit'] == 'minutes'){
								$multiplier = 60;
							}elseif ($options['default-autopost-delay-unit'] == 'hours'){
								$multiplier = 3600;
							}else{
								$multiplier = 86400;
							}
						}else{
							$prefix = $options['default-autopost-delay-prefix'];
							
							$number = $options['default-autopost-page-delay-number'];
						
							if ($options['default-autopost-page-delay-unit'] == 'minutes'){
								$multiplier = 60;
							}elseif ($options['default-autopost-page-delay-unit'] == 'hours'){
								$multiplier = 3600;
							}else{
								$multiplier = 86400;
							}
						}
						if (strlen($prefix) > 0){ $prefix .= ' '; }
	 
						$icymi_date = $icymi_date + ($multiplier * $number);
						$schedule_id .= '-'.date('Y-m-d H:i', $icymi_date);
						
						$scheduled_tweets[$schedule_id]['tweet'] = 'ICYMI: '.$post_tweet;
						$scheduled_tweets[$schedule_id]['date'] = date("Y-m-d", $icymi_date);
						$scheduled_tweets[$schedule_id]['time'] = date("H:i", $icymi_date);
						
						wp_schedule_single_event(strtotime(
														date("Y-m-d H:i", $icymi_date)
														), 'azrcrv_tt_scheduled_tweet', array($schedule_id) 
													);
			
						
						update_option('azrcrv-tt-scheduled-tweets', $scheduled_tweets);
					}
				}
			}
		}
	}
}

/**
 * Post tweet.
 *
 * @since 1.0.0
 *
 */
function azrcrv_tt_post_tweet($tweet){
				
	$options = get_option('azrcrv-tt');
	
	define('CONSUMER_KEY', $options['access_key']);
	define('CONSUMER_SECRET', $options['access_secret']);
	define('ACCESS_TOKEN', $options['access_token']);
	define('ACCESS_TOKEN_SECRET', $options['access_token_secret']);
	
	$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, ACCESS_TOKEN, ACCESS_TOKEN_SECRET);
	
	$tweet_post_status = $connection->post("statuses/update", ["status" => $tweet]);
	
	$tweet_post_status = $connection->getLastHttpCode();
	
	return $tweet_post_status;
}

/*
 * Display admin page for this plugin
 *
 * @since 1.0.0
 *
 */
function azrcrv_tt_display_options(){

	if (!current_user_can('manage_options')) {
		wp_die(__('You do not have sufficient permissions to access this page.', 'to-twitter'));
	}
	
	$options = get_option('azrcrv-tt');

    require_once('includes/admin_page.php');
}

function azrcrv_tt_save_options(){

	// Check that user has proper security level
	if (!current_user_can('manage_options')){
		wp_die(esc_html__('You do not have permissions to perform this action', 'to-twitter'));
	}
	// Check that nonce field created in configuration form is present
	if (! empty($_POST) && check_admin_referer('azrcrv-tt', 'azrcrv-tt-nonce')){
	
		if (!function_exists('curl_init')) {
			error_log('The From Twitter plugin requires CURL libraries');
			return;
		}
		
		$options = get_option('azrcrv-tt');
		
		if (!empty($options['access_key']) && !empty($options['access_secret']) && !empty($options['access_token']) && !empty($options['access_token_secret'])) {
			$connection = new TwitterOAuth($options['access_key'], $options['access_secret'], $options['access_token'], $options['access_token_secret']);
		}else{
			$tokens_error = true;
		}		

		
		/*
		* UPDATE FORMATTING OPTIONS
		*/
		$options['access_key'] = sanitize_text_field($_POST['access_key']);
		$options['access_secret'] = sanitize_text_field($_POST['access_secret']);
		$options['access_token'] = sanitize_text_field($_POST['access_token']);
		$options['access_token_secret'] = sanitize_text_field($_POST['access_token_secret']);
		
		$option_name = 'prefix_tweets_with_dot';
		if (isset($_POST[$option_name])){
			$options[$option_name] = 1;
		}else{
			$options[$option_name] = 0;
		}
		$option_name = 'record_tweet_history';
		if (isset($_POST[$option_name])){
			$options[$option_name] = 1;
		}else{
			$options[$option_name] = 0;
		}
		
		$option_name = 'default_autopost';
		if (isset($_POST[$option_name])){
			$options[$option_name] = 1;
		}else{
			$options[$option_name] = 0;
		}
		$option_name = 'default-autopost-after-delay';
		if (isset($_POST[$option_name])){
			$options[$option_name] = 1;
		}else{
			$options[$option_name] = 0;
		}
		$option_name = 'default-autopost-delay-prefix';
		$options[$option_name] = sanitize_text_field($_POST[$option_name]);
		$option_name = 'default-autopost-delay-number';
		$options[$option_name] = sanitize_text_field($_POST[$option_name]);
		$option_name = 'default-autopost-delay-unit';
		$options[$option_name] = sanitize_text_field($_POST[$option_name]);
		
		$option_name = 'default_autopost_page';
		if (isset($_POST[$option_name])){
			$options[$option_name] = 1;
		}else{
			$options[$option_name] = 0;
		}
		$option_name = 'default-autopost-page-after-delay';
		if (isset($_POST[$option_name])){
			$options[$option_name] = 1;
		}else{
			$options[$option_name] = 0;
		}
		$option_name = 'default-autopost-page-delay-prefix';
		$options[$option_name] = sanitize_text_field($_POST[$option_name]);
		$option_name = 'default-autopost-page-delay-number';
		$options[$option_name] = sanitize_text_field($_POST[$option_name]);
		$option_name = 'default-autopost-page-delay-unit';
		$options[$option_name] = sanitize_text_field($_POST[$option_name]);
		
		/*
		* Update category hashtags
		*/
		$option_name = 'category-hashtags';
		$newoptions = array();
		if (isset($_POST[$option_name])){
			foreach ($_POST[$option_name] as $key => $val ) {
				if (strlen($val) > 0){
					$newoptions[$key] = sanitize_text_field($val);
				}
			}
		}
		$options[$option_name] = $newoptions;
		
		/*
		* Update tag hashtags
		*/
		$option_name = 'tag-hashtags';
		$newoptions = array();
		if (isset($_POST[$option_name])){
			foreach ($_POST[$option_name] as $key => $val ) {
				if (strlen($val) > 0){
					$newoptions[$key] = sanitize_text_field($val);
				}
			}
		}
		$options[$option_name] = $newoptions;
		
		/*
		* Update word replace
		*/
		$option_name = 'word-replacement';
		$newoptions = array();
		if (isset($_POST[$option_name])){
			foreach ($_POST[$option_name] as $array ) {
				if (strlen($array['key']) > 0){
					$newoptions[$array['key']] = sanitize_text_field($array['value']);
				}
			}
		}
		$options[$option_name] = $newoptions;
		
		/*
		* Scheduled posts
		*/
		$option_name = 'scheduled-post';
		$newoptions = array();
		if (isset($_POST[$option_name])){
			for ($dayloop = 0; $dayloop < 7; $dayloop++){
				$newoptions[$dayloop]['time'] = sanitize_text_field($_POST[$option_name][$dayloop]['time']);
				$newoptions[$dayloop]['filter'] = sanitize_text_field($_POST[$option_name][$dayloop]['filter']);
				$newoptions[$dayloop]['category'] = sanitize_text_field($_POST[$option_name][$dayloop]['category']);
				$newoptions[$dayloop]['tag'] = sanitize_text_field($_POST[$option_name][$dayloop]['tag']);
				if (isset($_POST[$option_name][$dayloop]['enabled'])){
					$newoptions[$dayloop]['enabled'] = 1;
				}else{
					$newoptions[$dayloop]['enabled'] = 0;
				}
			}
		}
		$options[$option_name] = $newoptions;
		
		/*
		* Prefix for scheduled tweets
		*/
		$option_name = 'scheduled-tweet-prefix';
		$options[$option_name] = sanitize_text_field($_POST[$option_name]);
		
		/*
		* Include suffix
		*/
		$option_name = 'scheduled-tweet-suffix';
		if (isset($_POST[$option_name])){
			$options[$option_name] = 1;
		}else{
			$options[$option_name] = 0;
		}
		
		/*
		* Prefix for scheduled tweets
		*/
		$option_name = 'scheduled-tweet-generate';
		if (isset($_POST[$option_name])){
			$options[$option_name] = 1;
		}else{
			$options[$option_name] = 0;
		}
		
		/*
		* Scheduled tweet must be at leat this old
		*/
		$option_name = 'newest-post-age';
		$options[$option_name] = sanitize_text_field($_POST[$option_name]);
		
		/*
		* Update excluded tags
		*/
		$option_name = 'excluded-tags';
		$newoptions = array();
		if (isset($_POST[$option_name])){
			foreach ($_POST[$option_name] as $key => $val ) {
				if (isset($_POST[$option_name][$key])){
					$newoptions[$key] = 1;
				}else{
					$newoptions[$key] = 0;
				}
			}
		}
		$options[$option_name] = $newoptions;
		
		/*
		* Scheduled pages
		*/
		$option_name = 'scheduled-page';
		$newoptions = array();
		if (isset($_POST[$option_name])){
			for ($dayloop = 0; $dayloop < 7; $dayloop++){
				$newoptions[$dayloop]['time'] = sanitize_text_field($_POST[$option_name][$dayloop]['time']);
				$newoptions[$dayloop]['filter'] = sanitize_text_field($_POST[$option_name][$dayloop]['filter']);
				$newoptions[$dayloop]['textcontains'] = sanitize_text_field($_POST[$option_name][$dayloop]['textcontains']);
				if (isset($_POST[$option_name][$dayloop]['enabled'])){
					$newoptions[$dayloop]['enabled'] = 1;
				}else{
					$newoptions[$dayloop]['enabled'] = 0;
				}
			}
		}
		$options[$option_name] = $newoptions;
		
		/*
		* Prefix for scheduled tweets
		*/
		$option_name = 'scheduled-page-tweet-prefix';
		$options[$option_name] = sanitize_text_field($_POST[$option_name]);
		
		/*
		* Include suffix
		*/
		$option_name = 'scheduled-page-tweet-suffix';
		if (isset($_POST[$option_name])){
			$options[$option_name] = 1;
		}else{
			$options[$option_name] = 0;
		}
		
		/*
		* Prefix for scheduled-page tweets
		*/
		$option_name = 'scheduled-page-tweet-generate';
		if (isset($_POST[$option_name])){
			$options[$option_name] = 1;
		}else{
			$options[$option_name] = 0;
		}
		
		/*
		* scheduled-page page must be at leat this old
		*/
		$option_name = 'newest-page-age';
		$options[$option_name] = sanitize_text_field($_POST[$option_name]);
		
		/*
		* Update options
		*/
		update_option('azrcrv-tt', $options);
		
		/*
		* Remove scheduled post events
		*/
		wp_clear_scheduled_hook("azrcrv_tt_scheduled_post_tweet_monday");
		wp_clear_scheduled_hook("azrcrv_tt_scheduled_post_tweet_tuesday");
		wp_clear_scheduled_hook("azrcrv_tt_scheduled_post_tweet_wednesday");
		wp_clear_scheduled_hook("azrcrv_tt_scheduled_post_tweet_thursday");
		wp_clear_scheduled_hook("azrcrv_tt_scheduled_post_tweet_friday");
		wp_clear_scheduled_hook("azrcrv_tt_scheduled_post_tweet_saturday");
		wp_clear_scheduled_hook("azrcrv_tt_scheduled_post_tweet_sunday");
		
		/*
		* Add scheduled post event
		*/
		azrcrv_tt_schedule_post_tweet_monday();
		azrcrv_tt_schedule_post_tweet_tuesday();
		azrcrv_tt_schedule_post_tweet_wednesday();
		azrcrv_tt_schedule_post_tweet_thursday();
		azrcrv_tt_schedule_post_tweet_friday();
		azrcrv_tt_schedule_post_tweet_saturday();
		azrcrv_tt_schedule_post_tweet_sunday();
		
		/*
		* Remove scheduled page events
		*/
		wp_clear_scheduled_hook("azrcrv_tt_scheduled_page_tweet_monday");
		wp_clear_scheduled_hook("azrcrv_tt_scheduled_page_tweet_tuesday");
		wp_clear_scheduled_hook("azrcrv_tt_scheduled_page_tweet_wednesday");
		wp_clear_scheduled_hook("azrcrv_tt_scheduled_page_tweet_thursday");
		wp_clear_scheduled_hook("azrcrv_tt_scheduled_page_tweet_friday");
		wp_clear_scheduled_hook("azrcrv_tt_scheduled_page_tweet_saturday");
		wp_clear_scheduled_hook("azrcrv_tt_scheduled_page_tweet_sunday");
		
		/*
		* Add scheduled page event
		*/
		azrcrv_tt_schedule_page_tweet_monday();
		azrcrv_tt_schedule_page_tweet_tuesday();
		azrcrv_tt_schedule_page_tweet_wednesday();
		azrcrv_tt_schedule_page_tweet_thursday();
		azrcrv_tt_schedule_page_tweet_friday();
		azrcrv_tt_schedule_page_tweet_saturday();
		azrcrv_tt_schedule_page_tweet_sunday();
		
		// Redirect the page to the configuration form that was processed
		wp_redirect( add_query_arg( 'page', 'azrcrv-tt&settings-updated', admin_url( 'admin.php' ) ) );
		exit;
	}
}

/*
 * Display manual send tweet page
 *
 * @since 1.0.0
 *
 */
function azrcrv_tt_display_send_manual_tweet(){

	if (!current_user_can('manage_options')) {
		wp_die(__('You do not have sufficient permissions to access this page.', 'to-twitter'));
	}
	
	$azrcrv_tt = get_option('azrcrv-tt');

    require_once('includes/send_manual_tweet_page.php');
}


/*
 * Send tweet
 *
 * @since 1.0.0
 *
 */
function azrcrv_tt_send_tweet(){
	
	// Check that user has proper security level
	if (!current_user_can('manage_options')){
		wp_die(__('You do not have permissions to perform this action', 'to-twitter'));
	}
	// Check that nonce field created in configuration form is present
	if (! empty($_POST) && check_admin_referer('azrcrv-tt-smt', 'azrcrv-tt-smt-nonce')){
	
		if (!function_exists('curl_init')) {
			error_log(__('The To Twitter plugin requires CURL libraries', 'to-twitter'));
			return;
		}
		
		$azrcrv_tt = get_option('azrcrv-tt');
		
		if (!empty($azrcrv_tt['access_key']) && !empty($azrcrv_tt['access_secret']) && !empty($azrcrv_tt['access_token']) && !empty($azrcrv_tt['access_token_secret'])) {
			$connection = new TwitterOAuth($azrcrv_tt['access_key'], $azrcrv_tt['access_secret'], $azrcrv_tt['access_token'], $azrcrv_tt['access_token_secret']);
		}else{
			$tokens_error = true;
		}
		
		$tweet_post_status = 'tweet-failed';
		if (isset($_POST['tweet'])){ // AND $token_error != true) {
			$status = azrcrv_tt_post_tweet($_POST['azrcrv_tt_tweet']);
			
			if ($status == 200) {
				$tweet_post_status = 'tweet-sent='.$status;
			}else{
				$tweet_post_status .= '='.$status;
			}
		}
		
		// Redirect the page to the configuration form that was processed
		wp_redirect(add_query_arg( 'page', 'azrcrv-tt-smt&'.$tweet_post_status, admin_url('admin.php')));
		exit;
	}
}

/*
 * Display schedule tweet page
 *
 * @since 1.4.0
 *
 */
function azrcrv_tt_display_schedule_tweet(){

	if (!current_user_can('manage_options')) {
		wp_die(__('You do not have sufficient permissions to access this page.', 'to-twitter'));
	}
	
	$azrcrv_tt = get_option('azrcrv-tt');

    require_once('includes/schedule_tweet_page.php');
}

/*
 * Schedule tweet
 *
 * @since 1.3.0
 *
 */
function azrcrv_tt_schedule_tweet(){
	
	// Check that user has proper security level
	if (!current_user_can('manage_options')){
		wp_die(__('You do not have permissions to perform this action', 'to-twitter'));
	}
	// Check that nonce field created in configuration form is present
	if (! empty($_POST) && check_admin_referer('azrcrv-tt-st', 'azrcrv-tt-st-nonce')){
		
		$options = get_option('azrcrv-tt');
	
		if (!function_exists('curl_init')) {
			error_log(__('The To Twitter plugin requires CURL libraries', 'to-twitter'));
			return;
		}
		
		if (!empty($options['access_key']) && !empty($options['access_secret']) && !empty($options['access_token']) && !empty($options['access_token_secret'])) {
			$connection = new TwitterOAuth($options['access_key'], $options['access_secret'], $options['access_token'], $options['access_token_secret']);
		}else{
			$tokens_error = true;
		}
		
		$tweet_post_status = 'tweet-failed';
 
		$option_name = 'scheduled-tweet';
		if (isset($_POST[$option_name])){
			$scheduled_tweets = get_option('azrcrv-tt-scheduled-tweets');
			$schedule_id = date("Y-m-d H:i:s");
			$scheduled_tweets[$schedule_id]['tweet'] = $_POST['tweet'];
			$scheduled_tweets[$schedule_id]['date'] = $_POST[$option_name]['date'];
			$scheduled_tweets[$schedule_id]['time'] = $_POST[$option_name]['time'];
			wp_schedule_single_event(strtotime(
											$_POST[$option_name]['date'].' '.
											date($_POST[$option_name]['time'])
											), 'azrcrv_tt_scheduled_tweet', array($schedule_id) 
										);
		
			/*
			* set status
			*/
			$tweet_post_status = 'tweet-scheduled';
			update_option('azrcrv-tt-scheduled-tweets', $scheduled_tweets);
		}
		/*
		* Update options
		*/
		update_option('azrcrv-tt', $options);

		// Redirect the page to the configuration form that was processed
		wp_redirect(add_query_arg( 'page', 'azrcrv-tt-st&'.$tweet_post_status, admin_url('admin.php')));
		exit;
	}
}

/*
 * Schedule tweet
 *
 * @since 1.3.0
 *
 */
function azrcrv_tt_delete_scheduled_tweet(){
	
	// Check that user has proper security level
	if (!current_user_can('manage_options')){
		wp_die(__('You do not have permissions to perform this action', 'to-twitter'));
	}
	// Check that nonce field created in configuration form is present
	if (! empty($_POST) && check_admin_referer('azrcrv-tt-dst', 'azrcrv-tt-dst-nonce')){
			
		$scheduled_tweets = get_option('azrcrv-tt-scheduled-tweets');
		$option_name = 'tweettodelete';
		
		wp_clear_scheduled_hook('azrcrv_tt_scheduled_tweet', array($_POST[$option_name]));
		
		unset($scheduled_tweets[$_POST[$option_name]]);
		/*
		* set status
		*/
		$tweet_post_status = 'tweet-deleted';
		
		/*
		* Update options
		*/
		update_option('azrcrv-tt-scheduled-tweets', $scheduled_tweets);

		// Redirect the page to the configuration form that was processed
		wp_redirect(add_query_arg( 'page', 'azrcrv-tt-st&'.$tweet_post_status, admin_url('admin.php')));
		exit;
	}
}

function azrcrv_tt_send_scheduled_tweet( $schedule_id ) {
	
	$scheduled_tweets = get_option('azrcrv-tt-scheduled-tweets');
	
	if (isset($scheduled_tweets[$schedule_id]['tweet'])){ // AND $token_error != true) {
		
		$status = azrcrv_tt_post_tweet($scheduled_tweets[$schedule_id][tweet]);
		
		$schedule = explode('-', $schedule_id);
		$post_id = $schedule[0];
		if (get_post_status($post_id)){
			$options = get_option('azrcrv-tt');
			
			if ($options['record_tweet_history'] == 1){
				$dateTime = date(get_option('date_format').' '.get_option('time_format'),strtotime(get_option('gmt_offset').' hours'));
				if (metadata_exists('post',$post_id,'_azrcrv_tt_tweet_history')){

					$tweet_history = get_post_meta($post_id, '_azrcrv_tt_tweet_history', true);
					$tweet_history[$dateTime] = $scheduled_tweets[$schedule_id]['tweet'];
					update_post_meta($post_id, '_azrcrv_tt_tweet_history',$tweet_history);

				} else {
					update_post_meta($post_id, '_azrcrv_tt_tweet_history',array($dateTime => $scheduled_tweets[$schedule_id]['tweet']));   
				}
			}
		}else{
			$scheduled_tweet_history = get_option('azrcrv-tt-scheduled-tweet-history');
			$scheduled_tweet_history[$schedule_id]['tweet'] = $scheduled_tweets[$schedule_id]['tweet'];
			$scheduled_tweet_history[$schedule_id]['date'] = $scheduled_tweets[$schedule_id]['date'];
			$scheduled_tweet_history[$schedule_id]['time'] = $scheduled_tweets[$schedule_id]['time'];
			$scheduled_tweet_history[$schedule_id]['status'] = $status;
			
			update_option('azrcrv-tt-scheduled-tweet-history', $scheduled_tweet_history);
		}
		
		unset($scheduled_tweets[$schedule_id]);
		
		/*
		* Update options
		*/
		update_option('azrcrv-tt-scheduled-tweets', $scheduled_tweets);
	}
	
}
add_action( 'azrcrv_tt_scheduled_tweet', 'azrcrv_tt_send_scheduled_tweet', 10, 3 );

/**
 * Schedule Sunday cron post event.
 *
 * @since 1.3.0
 *
 */
function azrcrv_tt_schedule_post_tweet_sunday(){
	
	$options = get_option('azrcrv-tt');
	
	if ($options['scheduled-post'][0]['enabled'] == 1){
		wp_schedule_event(strtotime($options['scheduled-post'][0]['time'].':00'), 'daily', 'azrcrv_tt_scheduled_post_tweet_sunday');
	}
}

/**
 * Send scheduled Sunday post event.
 *
 * @since 1.3.0
 *
 */
function azrcrv_tt_scheduled_post_send_tweet_sunday(){
	
	$option_name = 'azrcrv-tt';
	
	$options = get_option($option_name);
	
	if (date('D') == 'Sun' and $options['scheduled_tweet_sent']['Sun'] != date('Y-m-d')){
		azrcrv_tt_scheduled_post_send_tweet();
		$options['scheduled_tweet_sent']['Sun'] = date('Y-m-d');
		
		/*
		* Update options
		*/
		update_option('azrcrv-tt', $options);
	}
}


/**
 * Schedule Monday cron post event.
 *
 * @since 1.3.0
 *
 */
function azrcrv_tt_schedule_post_tweet_monday(){
	
	$options = get_option('azrcrv-tt');
	
	if ($options['scheduled-post'][1]['enabled'] == 1){
		wp_schedule_event(strtotime($options['scheduled-post'][1]['time'].':00'), 'daily', 'azrcrv_tt_scheduled_post_tweet_monday');
	}
	
}

/**
 * Send scheduled Monday post event.
 *
 * @since 1.3.0
 *
 */
function azrcrv_tt_scheduled_post_send_tweet_monday(){
	
	$option_name = 'azrcrv-tt';
	
	$options = get_option($option_name);
	
	if (date('D') == 'Mon' and $options['scheduled_tweet_sent']['Mon'] != date('Y-m-d')){
		azrcrv_tt_scheduled_post_send_tweet();
		$options['scheduled_tweet_sent']['Mon'] = date('Y-m-d');
		
		/*
		* Update options
		*/
		update_option('azrcrv-tt', $options);
	}
}

/**
 * Schedule Tuesday cron post event.
 *
 * @since 1.3.0
 *
 */
function azrcrv_tt_schedule_post_tweet_tuesday(){
	
	$options = get_option('azrcrv-tt');
	
	if ($options['scheduled-post'][2]['enabled'] == 1){
		wp_schedule_event(strtotime($options['scheduled-post'][2]['time'].':00'), 'daily', 'azrcrv_tt_scheduled_post_tweet_tuesday');
	}
}

/**
 * Send scheduled Tuesday post event.
 *
 * @since 1.3.0
 *
 */
function azrcrv_tt_scheduled_post_send_tweet_tuesday(){
	
	$option_name = 'azrcrv-tt';
	
	$options = get_option($option_name);
	
	if (date('D') == 'Tue' and $options['scheduled_tweet_sent']['Tue'] != date('Y-m-d')){
		azrcrv_tt_scheduled_post_send_tweet();
		$options['scheduled_tweet_sent']['Tue'] = date('Y-m-d');
		
		/*
		* Update options
		*/
		update_option('azrcrv-tt', $options);
	}
}

/**
 * Schedule Wednesday cron post event.
 *
 * @since 1.3.0
 *
 */
function azrcrv_tt_schedule_post_tweet_wednesday(){
	
	$options = get_option('azrcrv-tt');
	
	if ($options['scheduled-post'][3]['enabled'] == 1){
		wp_schedule_event(strtotime($options['scheduled-post'][3]['time'].':00'), 'daily', 'azrcrv_tt_scheduled_post_tweet_wednesday');
	}
}

/**
 * Send scheduled Wednesday post event.
 *
 * @since 1.3.0
 *
 */
function azrcrv_tt_scheduled_post_send_tweet_wednesday(){
	
	$option_name = 'azrcrv-tt';
	
	$options = get_option($option_name);
	
	if (date('D') == 'Wed' and $options['scheduled_tweet_sent']['Wed'] != date('Y-m-d')){
		azrcrv_tt_scheduled_post_send_tweet();
		$options['scheduled_tweet_sent']['Wed'] = date('Y-m-d');
		
		/*
		* Update options
		*/
		update_option('azrcrv-tt', $options);
	}
}

/**
 * Schedule Thursday cron post event.
 *
 * @since 1.3.0
 *
 */
function azrcrv_tt_schedule_post_tweet_thursday(){
	
	$options = get_option('azrcrv-tt');
	
	if ($options['scheduled-post'][4]['enabled'] == 1){
		wp_schedule_event(strtotime($options['scheduled-post'][4]['time'].':00'), 'daily', 'azrcrv_tt_scheduled_post_tweet_thursday');
	}
}

/**
 * Send scheduled Thursday post event.
 *
 * @since 1.3.0
 *
 */
function azrcrv_tt_scheduled_post_send_tweet_thursday(){
	
	$option_name = 'azrcrv-tt';
	
	$options = get_option($option_name);
	
	if (date('D') == 'Thu' and $options['scheduled_tweet_sent']['Thu'] != date('Y-m-d')){
		azrcrv_tt_scheduled_post_send_tweet();
		$options['scheduled_tweet_sent']['Thu'] = date('Y-m-d');
		
		/*
		* Update options
		*/
		update_option('azrcrv-tt', $options);
	}
}

/**
 * Schedule Friday cron post event.
 *
 * @since 1.3.0
 *
 */
function azrcrv_tt_schedule_post_tweet_friday(){
	
	$options = get_option('azrcrv-tt');
	
	if ($options['scheduled-post'][5]['enabled'] == 1){
		wp_schedule_event(strtotime($options['scheduled-post'][5]['time'].':00'), 'daily', 'azrcrv_tt_scheduled_post_tweet_friday');
	}
}

/**
 * Send scheduled Friday post event.
 *
 * @since 1.3.0
 *
 */
function azrcrv_tt_scheduled_post_send_tweet_friday(){
	
	$option_name = 'azrcrv-tt';
	
	$options = get_option($option_name);
	
	if (date('D') == 'Fri' and $options['scheduled_tweet_sent']['Fri'] != date('Y-m-d')){
		azrcrv_tt_scheduled_post_send_tweet();
		$options['scheduled_tweet_sent']['Fri'] = date('Y-m-d');
		
		/*
		* Update options
		*/
		update_option('azrcrv-tt', $options);
	}
}

/**
 * Schedule Saturday cron post event.
 *
 * @since 1.3.0
 *
 */
function azrcrv_tt_schedule_post_tweet_saturday(){
	
	$options = get_option('azrcrv-tt');
	
	if ($options['scheduled-post'][6]['enabled'] == 1){
		wp_schedule_event(strtotime($options['scheduled-post'][6]['time'].':00'), 'daily', 'azrcrv_tt_scheduled_post_tweet_saturday');
	}
}

/**
 * Send scheduled Saturday post event.
 *
 * @since 1.3.0
 *
 */
function azrcrv_tt_scheduled_post_send_tweet_saturday(){
	
	$option_name = 'azrcrv-tt';
	
	$options = get_option($option_name);
	
	if (date('D') == 'Sat' and ($options['scheduled_tweet_sent']['Sat'] != date('Y-m-d') or !isset($options['scheduled_tweet_sent']['Sat']))){
		azrcrv_tt_scheduled_post_send_tweet();
		$options['scheduled_tweet_sent']['Sat'] = date('Y-m-d');
		
		/*
		* Update options
		*/
		update_option('azrcrv-tt', $options);
	}
}

/**
 * Send scheduled tweet.
 *
 * @since 1.3.0
 *
 */
function azrcrv_tt_scheduled_post_send_tweet(){
	
	global $wpdb;
	
	$sql = azrcrv_tt_select_scheduled_random_post_tweet(date('w'));
	
	$post_id = $wpdb->get_var($sql);
	$post = get_post($post_id);
	
	$options = get_option('azrcrv-tt');
	
	if ($options['scheduled-tweet-generate'] == 1 or !metadata_exists('post',$post_id,'_azrcrv_tt_post_tweet')){
		
		$tweet = $post->post_title;
		
		if(metadata_exists('post',$post_id,'_azrcrv_tt_hashtags')){
			$additional_hashtags_string = get_post_meta($post_id, '_azrcrv_tt_hashtags', true);
		}else{
			$additional_hashtags_string = '';
		}
		
		if (strlen($additional_hashtags_string) == 0){
			$additional_hashtags = explode(' ', azrcrv_tt_get_hashtags($post_id));
		}else{
			$additional_hashtags = explode(' ', $additional_hashtags_string);
		}
		
		foreach($options['word-replacement'] as $word => $replacement){
			if (stristr($tweet, $word)){
				if (substr($replacement, 0, 1) == '#'){
					$additional_hashtags = array_diff($additional_hashtags, array($replacement));
				}
				$tweet = str_ireplace($word, $replacement, $tweet);
			}
		}
		if (count($additional_hashtags) > 0){
			$additional_hashtags_string = ' '.implode(' ', $additional_hashtags);
		}else{
			$additional_hashtags_string = '';
		}
		
		if (function_exists('azrcrv_urls_get_custom_shortlink')){
			$url = azrcrv_urls_get_custom_shortlink($post_id);
		}else{
			$url = get_permalink($post_id);
		}
		
		if ($options['prefix_tweets_with_dot'] == 1){
			if (substr($tweet, 0, 1) == '@'){
				$tweet = '.'.$tweet;
			}
		}
		
		$tweet = $tweet.' '.$url.$additional_hashtags_string;
	}else{
		$tweet = get_post_meta($post_id, '_azrcrv_tt_post_tweet', true);
	}
	
	if(metadata_exists('post',$post_id,'_azrcrv_tt_scheduled_post_times_tweeted')){
		$times_retweeted = get_post_meta($post_id, '_azrcrv_tt_scheduled_post_times_tweeted', true);
		$times_retweeted++;
	}else{
		$times_retweeted = 1;
	}
	update_post_meta($post_id, '_azrcrv_tt_scheduled_post_times_tweeted', $times_retweeted); 
	
	$prefix = $options['scheduled-tweet-prefix'];
	if (strlen($prefix) > 0){
		$prefix .= ' ';
	}
	
	if ($options['scheduled-tweet-suffix'] == 0){
		$suffix = '';
	}else{
		$suffix = ' ['.$times_retweeted.']';
	}
	
	$tweet = $prefix.$tweet.$suffix; //text for your tweet.
	
	$tweet_post_status = azrcrv_tt_post_tweet($tweet);
	
	if ($tweet_post_status == 200){
		update_post_meta($post_id, '_azrcrv_tt_tweeted', 1); // set tweeted flag = true
		
		if ($options['record_tweet_history'] == 1){
			$dateTime = date(get_option('date_format').' '.get_option('time_format'),strtotime(get_option('gmt_offset').' hours'));
			if(metadata_exists('post',$post_id,'_azrcrv_tt_tweet_history')){

				$tweet_history = get_post_meta($post_id, '_azrcrv_tt_tweet_history', true);
				$tweet_history[$dateTime] = $tweet;
				update_post_meta($post_id, '_azrcrv_tt_tweet_history',$tweet_history);

			} else {
				update_post_meta($post_id, '_azrcrv_tt_tweet_history',array($dateTime => $tweet));   
			}
		}
	}
}

/**
 * Prepare scheduled random tweet SQL statement.
 *
 * @since 1.3.0
 *
 */
function azrcrv_tt_select_scheduled_random_post_tweet($day){
	
	global $wpdb;
	
	$options = get_option('azrcrv-tt');
	
	if ($options['scheduled-post'][$day]['filter'] == 'Is'){
		$filter = '=';
	}else{
		$filter = '<>';
	}
	
	$taxonomy_string = '';
	$category_join_string = '';
	$tag_join_string = '';
	$category = $options['scheduled-post'][$day]['category'];
	if ($category <> 'all'){
		$category_join_string = '
								INNER JOIN
									'.$wpdb->prefix.'term_relationships AS trc
										ON
											trc.object_id = p.ID
								INNER JOIN
									'.$wpdb->prefix.'term_taxonomy AS ttc
										ON
											ttc.term_taxonomy_id = trc.term_taxonomy_id
										AND
											ttc.taxonomy = \'category\'
								';
		$taxonomy_filter_string = 
									'
									AND ttc.term_id '.$filter.' \''.$category.'\'
									';
	}
	$tag = $options['scheduled-post'][$day]['tag'];
	if ($tag <> 'all'){
		$tag_join_string = '
							INNER JOIN
								'.$wpdb->prefix.'term_relationships AS trt
									ON
										trt.object_id = p.ID
							INNER JOIN
								'.$wpdb->prefix.'term_taxonomy AS ttt
									ON
										ttt.term_taxonomy_id = trt.term_taxonomy_id
									AND
										ttt.taxonomy = \'post_tag\'
							';
		$taxonomy_filter_string .= 
									'
									AND ttt.term_id '.$filter.' \''.$tag.'\'
									';
	}
	
	$tags = array();
	foreach ($options['excluded-tags'] AS $tag => $exclude){
		if ($exclude == 1){
			$tags[] = $tag;
		}
	}
	if (count($tags) == 0){
		$tag_string = '';
	}else{
		$tag_string = 'AND
				(
				SELECT
					COUNT(*)
				FROM
					'.$wpdb->prefix.'posts AS ip
				INNER JOIN
					'.$wpdb->prefix.'term_relationships AS itr
						ON
							itr.object_id = ip.ID
				INNER JOIN
					'.$wpdb->prefix.'term_taxonomy AS itt
						ON
							itt.term_taxonomy_id = itr.term_taxonomy_id
						AND
							itt.taxonomy = \'post_tag\'
				INNER JOIN
					'.$wpdb->prefix.'terms AS it
						ON
							it.term_id = itt.term_id
						AND
							it.term_id IN ('.implode(',', $tags).')
				WHERE
					ip.ID = p.ID
				) = 0';
	}
	
	$before = $options['newest-post-age'];
	
	$sql = 'SELECT
				p.ID
			FROM
				'.$wpdb->prefix.'posts AS p
			'.$category_join_string.'
			'.$tag_join_string.'
			WHERE
				p.post_status = \'publish\'
			AND
				p.post_type = \'post\'
				'.$taxonomy_filter_string.'
				'.$tag_string.'
			AND
				p.post_date <= DATE_ADD(\''.DATE('Y-m-d 23:59:59').'\', INTERVAL -'.$before.' DAY) 
			ORDER BY
				RAND()
			LIMIT
				0,1';
	
	return $sql;
}

/**
 * Schedule Sunday cron page event.
 *
 * @since 1.3.0
 *
 */
function azrcrv_tt_schedule_page_tweet_sunday(){
	
	$options = get_option('azrcrv-tt');
	
	if ($options['scheduled-page'][0]['enabled'] == 1){
		wp_schedule_event(strtotime($options['scheduled-page'][0]['time'].':00'), 'daily', 'azrcrv_tt_scheduled_page_tweet_sunday');
	}
}

/**
 * Send scheduled Sunday page event.
 *
 * @since 1.3.0
 *
 */
function azrcrv_tt_scheduled_page_send_tweet_sunday(){
	
	$option_name = 'azrcrv-tt';
	
	$options = get_option($option_name);
	
	if (date('D') == 'Sun' and $options['scheduled_page_tweet_sent']['Sun'] != date('Y-m-d')){
		azrcrv_tt_scheduled_page_send_tweet();
		$options['scheduled_page_tweet_sent']['Sun'] = date('Y-m-d');
		
		/*
		* Update options
		*/
		update_option('azrcrv-tt', $options);
	}
}


/**
 * Schedule Monday cron page event.
 *
 * @since 1.3.0
 *
 */
function azrcrv_tt_schedule_page_tweet_monday(){
	
	$options = get_option('azrcrv-tt');
	
	if ($options['scheduled-page'][1]['enabled'] == 1){
		wp_schedule_event(strtotime($options['scheduled-page'][1]['time'].':00'), 'daily', 'azrcrv_tt_scheduled_page_tweet_monday');
	}
	
}

/**
 * Send scheduled Monday page event.
 *
 * @since 1.3.0
 *
 */
function azrcrv_tt_scheduled_page_send_tweet_monday(){
	
	$option_name = 'azrcrv-tt';
	
	$options = get_option($option_name);
	
	if (date('D') == 'Mon' and $options['scheduled_page_tweet_sent']['Mon'] != date('Y-m-d')){
		azrcrv_tt_scheduled_page_send_tweet();
		$options['scheduled_page_tweet_sent']['Mon'] = date('Y-m-d');
		
		/*
		* Update options
		*/
		update_option('azrcrv-tt', $options);
	}
}

/**
 * Schedule Tuesday cron page event.
 *
 * @since 1.3.0
 *
 */
function azrcrv_tt_schedule_page_tweet_tuesday(){
	
	$options = get_option('azrcrv-tt');
	
	if ($options['scheduled-page'][2]['enabled'] == 1){
		wp_schedule_event(strtotime($options['scheduled-page'][2]['time'].':00'), 'daily', 'azrcrv_tt_scheduled_page_tweet_tuesday');
	}
}

/**
 * Send scheduled Tuesday page event.
 *
 * @since 1.3.0
 *
 */
function azrcrv_tt_scheduled_page_send_tweet_tuesday(){
	
	$option_name = 'azrcrv-tt';
	
	$options = get_option($option_name);
	
	if (date('D') == 'Tue' and $options['scheduled_page_tweet_sent']['Tue'] != date('Y-m-d')){
		azrcrv_tt_scheduled_page_send_tweet();
		$options['scheduled_page_tweet_sent']['Tue'] = date('Y-m-d');
		
		/*
		* Update options
		*/
		update_option('azrcrv-tt', $options);
	}
}

/**
 * Schedule Wednesday cron page event.
 *
 * @since 1.3.0
 *
 */
function azrcrv_tt_schedule_page_tweet_wednesday(){
	
	$options = get_option('azrcrv-tt');
	
	if ($options['scheduled-page'][3]['enabled'] == 1){
		wp_schedule_event(strtotime($options['scheduled-page'][3]['time'].':00'), 'daily', 'azrcrv_tt_scheduled_page_tweet_wednesday');
	}
}

/**
 * Send scheduled Wednesday page event.
 *
 * @since 1.3.0
 *
 */
function azrcrv_tt_scheduled_page_send_tweet_wednesday(){
	
	$option_name = 'azrcrv-tt';
	
	$options = get_option($option_name);
	
	if (date('D') == 'Wed' and $options['scheduled_page_tweet_sent']['Wed'] != date('Y-m-d')){
		azrcrv_tt_scheduled_page_send_tweet();
		$options['scheduled_page_tweet_sent']['Wed'] = date('Y-m-d');
		
		/*
		* Update options
		*/
		update_option('azrcrv-tt', $options);
	}
}

/**
 * Schedule Thursday cron page event.
 *
 * @since 1.3.0
 *
 */
function azrcrv_tt_schedule_page_tweet_thursday(){
	
	$options = get_option('azrcrv-tt');
	
	if ($options['scheduled-page'][4]['enabled'] == 1){
		wp_schedule_event(strtotime($options['scheduled-page'][4]['time'].':00'), 'daily', 'azrcrv_tt_scheduled_page_tweet_thursday');
	}
}

/**
 * Send scheduled Thursday page event.
 *
 * @since 1.3.0
 *
 */
function azrcrv_tt_scheduled_page_send_tweet_thursday(){
	
	$option_name = 'azrcrv-tt';
	
	$options = get_option($option_name);
	
	if (date('D') == 'Thu' and $options['scheduled_page_tweet_sent']['Thu'] != date('Y-m-d')){
		azrcrv_tt_scheduled_page_send_tweet();
		$options['scheduled_page_tweet_sent']['Thu'] = date('Y-m-d');
		
		/*
		* Update options
		*/
		update_option('azrcrv-tt', $options);
	}
}

/**
 * Schedule Friday cron page event.
 *
 * @since 1.3.0
 *
 */
function azrcrv_tt_schedule_page_tweet_friday(){
	
	$options = get_option('azrcrv-tt');
	
	if ($options['scheduled-page'][5]['enabled'] == 1){
		wp_schedule_event(strtotime($options['scheduled-page'][5]['time'].':00'), 'daily', 'azrcrv_tt_scheduled_page_tweet_friday');
	}
}

/**
 * Send scheduled Friday page event.
 *
 * @since 1.3.0
 *
 */
function azrcrv_tt_scheduled_page_send_tweet_friday(){
	
	$option_name = 'azrcrv-tt';
	
	$options = get_option($option_name);
	
	if (date('D') == 'Fri' and $options['scheduled_page_tweet_sent']['Fri'] != date('Y-m-d')){
		azrcrv_tt_scheduled_page_send_tweet();
		$options['scheduled_page_tweet_sent']['Fri'] = date('Y-m-d');
		
		/*
		* Update options
		*/
		update_option('azrcrv-tt', $options);
	}
}

/**
 * Schedule Saturday cron page event.
 *
 * @since 1.3.0
 *
 */
function azrcrv_tt_schedule_page_tweet_saturday(){
	
	$options = get_option('azrcrv-tt');
	
	if ($options['scheduled-page'][6]['enabled'] == 1){
		wp_schedule_event(strtotime($options['scheduled-page'][6]['time'].':00'), 'daily', 'azrcrv_tt_scheduled_page_tweet_saturday');
	}
}

/**
 * Send scheduled Saturday page event.
 *
 * @since 1.3.0
 *
 */
function azrcrv_tt_scheduled_page_send_tweet_saturday(){
	
	$option_name = 'azrcrv-tt';
	
	$options = get_option($option_name);
	
	if (date('D') == 'Sat' and ($options['scheduled_page_tweet_sent']['Sat'] != date('Y-m-d') or !isset($options['scheduled_page_tweet_sent']['Sat']))){
		azrcrv_tt_scheduled_page_send_tweet();
		$options['scheduled_page_tweet_sent']['Sat'] = date('Y-m-d');
		
		/*
		* Update options
		*/
		update_option('azrcrv-tt', $options);
	}
}

/**
 * Send scheduled tweet.
 *
 * @since 1.3.0
 *
 */
function azrcrv_tt_scheduled_page_send_tweet(){
	
	global $wpdb;
	
	$sql = azrcrv_tt_select_scheduled_random_page_tweet(date('w'));
	
	$post_id = $wpdb->get_var($sql);
	$post = get_post($post_id);
	
	$options = get_option('azrcrv-tt');
	
	if ($options['scheduled-tweet-generate'] == 1 or !metadata_exists('post',$post_id,'_azrcrv_tt_post_tweet')){
		
		$tweet = $post->post_title;
		
		if(metadata_exists('post',$post_id,'_azrcrv_tt_hashtags')){
			$additional_hashtags_string = get_post_meta($post_id, '_azrcrv_tt_hashtags', true);
		}else{
			$additional_hashtags_string = '';
		}
		
		if (function_exists('azrcrv_urls_get_custom_shortlink')){
			$url = azrcrv_urls_get_custom_shortlink($post_id);
		}else{
			$url = get_permalink($post_id);
		}
		$tweet = $tweet.' '.$url.' '.$additional_hashtags_string;
	}else{
		$tweet = get_post_meta($post_id, '_azrcrv_tt_post_tweet', true);
	}
	
	if(metadata_exists('post',$post_id,'_azrcrv_tt_scheduled_page_times_tweeted')){
		$times_retweeted = get_post_meta($post_id, '_azrcrv_tt_scheduled_page_times_tweeted', true);
		$times_retweeted++;
	}else{
		$times_retweeted = 1;
	}
	update_post_meta($post_id, '_azrcrv_tt_scheduled_page_times_tweeted', $times_retweeted); 
	
	$prefix = $options['scheduled-page-tweet-prefix'];
	if (strlen($prefix) > 0){
		$prefix .= ' ';
	}
	
	if ($options['scheduled-page-tweet-suffix'] == 0){
		$suffix = '';
	}else{
		$suffix = ' ['.$times_retweeted.']';
	}
	
	$tweet = $prefix.$tweet.$suffix; //text for your tweet.
	
	$tweet_page_status = azrcrv_tt_post_tweet($tweet);
	
	//if ($tweet_page_status == 200){
		update_post_meta($post_id, '_azrcrv_tt_tweeted', 1); // set tweeted flag = true
		
		if ($options['record_tweet_history'] == 1){
			//$tweet .= ' ('.$tweet_page_status.')';
			$dateTime = date(get_option('date_format').' '.get_option('time_format'),strtotime(get_option('gmt_offset').' hours'));
			if(metadata_exists('post',$post_id,'_azrcrv_tt_tweet_history')){

				$tweet_history = get_post_meta($post_id, '_azrcrv_tt_tweet_history', true);
				$tweet_history[$dateTime] = $tweet;
				update_post_meta($post_id, '_azrcrv_tt_tweet_history',$tweet_history);

			} else {
				update_post_meta($post_id, '_azrcrv_tt_tweet_history',array($dateTime => $tweet));   
			}
		}
	//}
}

/**
 * Prepare scheduled random tweet SQL statement.
 *
 * @since 1.3.0
 *
 */
function azrcrv_tt_select_scheduled_random_page_tweet($day){
	
	global $wpdb;
	
	$options = get_option('azrcrv-tt');
	
	if ($options['scheduled-page'][$day]['filter'] == 'Contains'){
		$filter = 'LIKE';
	}else{
		$filter = 'NOT LIKE';
	}
	
	$before = $options['newest-page-age'];
	
	$sql = 'SELECT
				p.ID
			FROM
				'.$wpdb->prefix.'posts AS p
			LEFT JOIN
				'.$wpdb->prefix.'postmeta AS pm
					ON
						pm.meta_key = \'_azrcrv_tt_exclude_schedule\'
			WHERE
				p.post_status = \'publish\'
			AND
				p.post_type = \'page\'
			AND
				p.post_content '.$filter.' \'%'.$options['scheduled-page'][$day]['textcontains'].'%\'
			AND
				p.post_date <= DATE_ADD(\''.DATE('Y-m-d 23:59:59').'\', INTERVAL -'.$before.' DAY) 
			AND
				(pm.meta_key <> 1 OR pm.meta_key IS NULL)
			ORDER BY
				RAND()
			LIMIT
				0,1';
	
	return $sql;
}