<div class="wrap arcrv-tt">
	
	<h1>
		<?php
			echo '<a href="https://development.azurecurve.co.uk/classicpress-plugins/"><img src="'.plugins_url('../pluginmenu/images/logo.svg', __FILE__).'" style="padding-right: 6px; height: 20px; width: 20px;" alt="azurecurve" /></a>';
			esc_html_e(get_admin_page_title());
		?>
	</h1>
	
	<?php if( isset($_GET['tweet-scheduled']) ) { ?>
		<div class="notice notice-success is-dismissible">
			<p><strong><?php esc_html_e('Tweet scheduled'); ?></strong></p>
		</div>
	<?php }
	if (isset($_GET['tweet-failed'])) { ?>
		<div class="notice notice-error is-dismissible">
			<p><strong><?php printf(esc_html__('Tweet failed to schedule'), $_GET['tweet-failed']); ?></strong></p>
		</div>
	<?php }elseif (isset($_GET['tweet-deleted'])) { ?>
		<div class="notice notice-error is-dismissible">
			<p><strong><?php printf(esc_html__('Tweet has been deleted'), $_GET['tweet-deleted']); ?></strong></p>
		</div>
	<?php }
	
	if( isset($_GET['reply-to']) ) {
		$reply_to = $_GET['reply-to'];
	}
	if( isset($_GET['reply-to']) ) {
		$reply_to = $_GET['reply-to'];
		$tweet_date = $_GET['date'];
		$tweet_time = $_GET['time'];
	}else{
		$tweet_date = date("Y-m-d");
		$tweet_time = date("H:i");
	}
	?>
	
	<h2 class="nav-tab-wrapper nav-tab-wrapper-azrcrv-tt">
		<a class="nav-tab nav-tab-active" data-item=".tabs-1" href="#tabs-1"><?php esc_html_e('Schedule new tweet', 'to-twitter') ?></a>
		<a class="nav-tab" data-item=".tabs-2" href="#tabs-2"><?php esc_html_e('Scheduled Tweets', 'to-twitter') ?></a>
		<a class="nav-tab" data-item=".tabs-3" href="#tabs-3"><?php esc_html_e('Scheduled Tweet History', 'to-twitter') ?></a>
	</h2>
	
	<div>
		<div class="azrcrv_tt_tabs tabs-1">
			<form method="post" action="admin-post.php">
				<input type="hidden" name="action" value="azrcrv_tt_schedule_tweet" />
				<?php
					wp_nonce_field('azrcrv-tt-st', 'azrcrv-tt-st-nonce');
					if ( isset( $azrcrv_tt['ignore-tweet-max-length'] ) && $azrcrv_tt['ignore-tweet-max-length'] = 1 ) {
						$tweet_max_length = '';
					}else{
						$tweet_max_length = 'maxlength="240"';
					}
				?>
				<p class="azrcrv_tt_horiz">
					<textarea name="tweet" rows="5" id="tweet" class="large-text code" <?php echo $tweet_max_length; ?> onkeyup="countChar(this)" placeholder="<?php esc_html_e("What's happening?", 'to-twitter'); ?>"autofocus></textarea>
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
					<p>
						<input type="date" id="scheduled-tweet[date]" name="scheduled-tweet[date]" value="<?php echo $tweet_date; ?>" min="<?php echo date("Y-m-d"); ?>">&nbsp;<input type="time" id="scheduled-tweet[time]" name="scheduled-tweet[time]" value="<?php echo $tweet_time; ?>" required>
					</p>
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
					<p style="clear: both; " />
					<div style="width: 100%x; display: block; padding-top: 12px; ">
						<input type="submit" style="margin:3px;" value="<?php esc_html_e('Schedule Tweet', 'to-twitter'); ?>" class="button-primary" id="submit" name="submit"/>
					</div>
				</p>
			</form>
		</div>
		<div class="azrcrv_tt_tabs invisible tabs-2">
			<p class="azrcrv_tt_horiz">
				<table>
					<tr>
						<th style="width: 20px; ">&nbsp;</th>
						<th style="width: 100px; ">Date</th>
						<th style="width: 80px; ">Time</th>
						<th style="width: 400px; ">Tweet</th>
					</tr>
					<?php
						$found = false;
						$scheduled_tweets = get_option('azrcrv-tt-scheduled-tweets');
						if (is_array($scheduled_tweets)){
							foreach ($scheduled_tweets as $key => $tweet){
								$found = true;
							?>
								<tr><td><form style="display:inline;" method="post" action="admin-post.php">
								<?php wp_nonce_field('azrcrv-tt-dst', 'azrcrv-tt-dst-nonce'); ?>
								<input type="hidden" name="action" value="azrcrv_tt_delete_scheduled_tweet" />
										<input type="hidden" name="tweettodelete" value="<?php echo $key; ?>" class="short-text" />
										<input style="display:inline;" type="image" src="<?php echo plugin_dir_url(dirname(__FILE__)); ?>assets/images/delete.png" name="delete" title="Delete" alt="Delete" value="Delete" class="azrcrv-tt"/></div>
									</form></td>
									<td style="width: 100px; text-align: center; "><?php echo $tweet['date']; ?></td>
									<td style="width: 80px; text-align: center; "><?php echo $tweet['time']; ?></td>
									<td style="width: 400px; "><?php echo $tweet['tweet']; ?></td>
								</tr>
								<?php
							}
						}
						if (!$found){
							echo '<tr><td></td><td></td><td></td><td><em>'.esc_html__('No scheduled tweets found.', 'azrcrv-tt').'</em></td></tr>';
						}
					?>
				</table>
			</p>
		</div>
		<div class="azrcrv_tt_tabs invisible tabs-3">
			<p class="azrcrv_tt_horiz">
				<table>
					<tr>
						<th style="width: 100px; ">Date</th>
						<th style="width: 80px; ">Time</th>
						<th style="width: 80px; ">Status</th>
						<th style="width: 300px; ">Tweet</th>
					</tr>
				<?php
					$found = false;
					$scheduled_tweet_history = get_option('azrcrv-tt-scheduled-tweet-history');
					if (is_array($scheduled_tweet_history)){
						$tweet_history = array_reverse($scheduled_tweet_history, true);
						foreach ($tweet_history as $key => $tweet){
							$found = true;
							if ($tweet['status'] == 200){
								$status = $tweet['status'];
							}else{
								$status = '<span style="color: red; font-weight:900;">'.$tweet['status'].'</span>';
							}
							if (isset($tweet['author']) AND strlen($tweet['author']) > 0){
								$tweet_link = '<a href="https://twitter.com/'.$tweet['author'].'/status/'.$tweet['tweet_id'].'" style="text-decoration: none; "><span class="dashicons dashicons-twitter"></span></a>&nbsp';
							}else{
								$tweet_link = '';
							}
							echo '<tr><td style="width: 100px; text-align: center; ">'.$tweet['date'].'</td><td style="width: 80px; text-align: center; ">'.$tweet['time'].'</td><td style="width: 80px; text-align: center; ">'.$status.'</td><td style="width: 300px; text-align: left; ">'.$tweet_link.$tweet['tweet'].'</td></tr>';
						}
					}
					if (!$found){
						echo '<tr><td></td><td></td><td></td><td><em>'.esc_html__('No scheduled tweet history found.', 'azrcrv-tt').'</em></td></tr>';
					}
				?>
				</table>
			</p>
		</div>
	</div>
</div>