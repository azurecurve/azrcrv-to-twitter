<?php $azrcrv_tt = azrcrv_tt_get_option('azrcrv-tt'); ?>

<div class="wrap arcrv-tt">
	
	<h1><?php echo esc_html(get_admin_page_title()); ?></h1>
	
	<?php if( isset($_GET['tweet-sent']) ) { ?>
		<div class="notice notice-success is-dismissible">
			<p><strong><?php esc_html_e('Tweet sent'); ?></strong></p>
		</div>
	<?php } ?>
	<?php if( isset($_GET['tweet-failed']) ) { ?>
		<div class="notice notice-error is-dismissible">
			<p><strong><?php printf(esc_html__('Tweet failed (status: %d)'), $_GET['tweet-failed']); ?></strong></p>
		</div>
	<?php } ?>
	
    <form method="post" action="admin-post.php">
		
		<input type="hidden" name="action" value="azrcrv_tt_send_tweet" />
		<?php
			wp_nonce_field('azrcrv-tt-smt', 'azrcrv-tt-smt-nonce');
			
			$no_image = plugin_dir_url(__FILE__).'../assets/images/no-image.svg';
			$tweet_image_1 = $no_image;
			$tweet_image_2 = $no_image;
			$tweet_image_3 = $no_image;
			$tweet_image_4 = $no_image;
		?>

        <div>
			<p class="azrcrv_tt_horiz">
				<textarea name="tweet" rows="5" id="tweet" class="large-text code" maxlength="240" onkeyup="countChar(this)" placeholder="<?php _e("What's happening?", 'to-twitter'); ?>"autofocus></textarea>
				<div id="the-count" style='float: right;' >
					<span id="current_counter">0</span><span id="maximum">/240</span>
				</div>
				<p style="clear: both; " />
				
				<div style="width: 100%; display: block; ">
					<div style="width: 100%; display: block; padding-bottom: 12px; ">
						<?php esc_html_e('Select up to four images to include with tweet.', 'to-twitter'); ?>
					</div>
					<?php
						$no_image = plugin_dir_url(__FILE__).'../assets/images/no-image.svg';
						$tweet_media = array();
						for ($media_loop = 1; $media_loop <= 4; $media_loop++){
							$tweet_image[$media_loop] = $no_image;
							echo '<div style="float: left; width: 170px; text-align: center; ">';
								echo '<img src="'.$tweet_image[$media_loop].'" id="tweet-image-'.$media_loop.'" style="width: 160px;"><br />';
								echo '<input type="hidden" name="tweet-selected-image-'.$media_loop.'" id="tweet-selected-image-'.$media_loop.'" value="" class="regular-text" />';
								echo '<input type="button" id="azrcrv-tt-upload-image-'.$media_loop.'" class="button upload" value="'.__('Upload', 'to-twitter').'" />&nbsp;';
								echo '<input type="button" id="azrcrv-tt-remove-image-'.$media_loop.'" class="button remove" value="'.__( 'Remove', 'to-twitter').'" />';
							echo '</div>';
						}
					?>
				</div>
				<p style="clear: both; " />
				<div style="width: 100%x; display: block; padding-top: 12px; ">
					<input type="submit" style="margin:3px;" value="<?php _e('Send Tweet', 'to-twitter'); ?>" class="button-primary" id="submit" name="submit"/>
				</div>
			</p>
        </div>
    </form>
</div>