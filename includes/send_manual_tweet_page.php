<?php $azrcrv_tt = azrcrv_tt_get_option('azrcrv-tt'); ?>

<div class="wrap arcrv-tt">
	
	<h1>
		<?php
			echo '<a href="https://development.azurecurve.co.uk/classicpress-plugins/"><img src="'.plugins_url('../pluginmenu/images/logo.svg', __FILE__).'" style="padding-right: 6px; height: 20px; width: 20px;" alt="azurecurve" /></a>';
			esc_html_e(get_admin_page_title());
		?>
	</h1>
	
	<?php if( isset($_GET['tweet-sent']) ) { ?>
		<div class="notice notice-success is-dismissible">
			<p><strong><?php esc_html_e('Tweet sent'); ?></strong></p>
		</div>
	<?php }
	if( isset($_GET['tweet-failed']) ) { ?>
		<div class="notice notice-error is-dismissible">
			<p><strong><?php printf(esc_html__('Tweet failed (status: %d)'), $_GET['tweet-failed']); ?></strong></p>
		</div>
	<?php }
	if( isset($_GET['reply-to']) ) {
		$reply_to = $_GET['reply-to'];
	}
	?>
	
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
				<textarea name="tweet" rows="5" id="tweet" class="large-text code" maxlength="240" onkeyup="countChar(this)" placeholder="<?php esc_html_e("What's happening?", 'to-twitter'); ?>"autofocus></textarea>
				<div id="the-count" style='float: right;' >
					<span id="current_counter">0</span><span id="maximum">/240</span>
				</div>
				
				<?php
				if (isset($reply_to)){
					$thread = 1;
					$thread_message = esc_html__('Send as part of thread? (unmark to send as last tweet in thread)', 'to-twitter');
					echo '<input type="hidden" name="reply-to" value="'.esc_attr($reply_to).'" />';
				}else{
					$thread = 0;
					$thread_message = esc_html__('Send as part of thread?', 'to-twitter');
				}
				?>
				<p><label for="thread"><input name="thread" type="checkbox" id="thread" value="1" <?php checked('1', $thread); ?> /><?php echo $thread_message; ?></label></p>
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
								echo '<input type="button" id="azrcrv-tt-upload-image-'.$media_loop.'" class="button upload" value="'.esc_html__('Upload', 'to-twitter').'" />&nbsp;';
								echo '<input type="button" id="azrcrv-tt-remove-image-'.$media_loop.'" class="button remove" value="'.esc_html__( 'Remove', 'to-twitter').'" />';
							echo '</div>';
						}
					?>
				</div>
				
				<p style="clear: both; " />
				<div style="width: 100%x; display: block; padding-top: 12px; ">
					<input type="submit" style="margin:3px;" value="<?php esc_html_e('Send Tweet', 'to-twitter'); ?>" class="button-primary" id="submit" name="submit"/>
				</div>
			</p>
        </div>
    </form>
</div>