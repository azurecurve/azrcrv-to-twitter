<div class="wrap arcrv-tt">
	
	<h1><?php echo esc_html(get_admin_page_title()); ?></h1>
	
	<?php if( isset($_GET['tweet-scheduled']) ) { ?>
		<div class="notice notice-success is-dismissible">
			<p><strong><?php esc_html_e('Tweet scheduled'); ?></strong></p>
		</div>
	<?php } ?>
	<?php if (isset($_GET['tweet-failed'])) { ?>
		<div class="notice notice-error is-dismissible">
			<p><strong><?php printf(esc_html__('Tweet failed to schedule'), $_GET['tweet-failed']); ?></strong></p>
		</div>
	<?php }elseif (isset($_GET['tweet-deleted'])) { ?>
		<div class="notice notice-error is-dismissible">
			<p><strong><?php printf(esc_html__('Tweet has been deleted'), $_GET['tweet-deleted']); ?></strong></p>
		</div>
	<?php } ?>
	

		<h2 class="nav-tab-wrapper nav-tab-wrapper-azrcrv-tt">
			<a class="nav-tab nav-tab-active" data-item=".tabs-1" href="#tabs-1"><?php _e('Schedule new tweet', 'to-twitter') ?></a>
			<a class="nav-tab" data-item=".tabs-2" href="#tabs-2"><?php _e('Scheduled Tweets', 'to-twitter') ?></a>
			<a class="nav-tab" data-item=".tabs-3" href="#tabs-3"><?php _e('Scheduled Tweet History', 'to-twitter') ?></a>
		</h2>
		
		<div>
			<div class="azrcrv_tt_tabs tabs-1">
				<form method="post" action="admin-post.php">
					<input type="hidden" name="action" value="azrcrv_tt_schedule_tweet" />
					<?php wp_nonce_field('azrcrv-tt-st', 'azrcrv-tt-st-nonce'); ?>
					<p class="azrcrv_tt_horiz">
						<textarea name="tweet" rows="5" id="tweet" class="large-text code" maxlength="240" onkeyup="countChar(this)" placeholder="<?php _e("What's happening?", 'to-twitter'); ?>"autofocus></textarea>
						<div id="the-count" style='float: right;' >
							<span id="current_counter">0</span><span id="maximum">/240</span>
						</div>
						<p>
							<input type="date" id="scheduled-tweet[date]" name="scheduled-tweet[date]" value="<?php echo date("Y-m-d"); ?>" min="<?php echo date("Y-m-d"); ?>">&nbsp;<input type="time" id="scheduled-tweet[time]" name="scheduled-tweet[time]" value="<?php echo date("H:i"); ?>" required>
						</p>
						<input type="submit" style="margin:3px;" value="<?php _e('Schedule Tweet', 'to-twitter'); ?>" class="button-primary" id="submit" name="submit"/>
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
							if (!$found){
								echo '<tr><td></td><td></td><td></td><td><em>'.__('No scheduled tweets found.', 'azrcrv-tt').'</em></td></tr>';
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
						$tweet_history = array_reverse($scheduled_tweet_history, true);
						foreach ($tweet_history as $key => $tweet){
							$found = true;
							if ($tweet['status'] == 200){
								$status = $tweet['status'];
							}else{
								$status = '<span style="color: red; font-weight:900;">'.$tweet['status'].'</span>';
							}
							echo '<tr><td style="width: 100px; text-align: center; ">'.$tweet['date'].'</td><td style="width: 80px; text-align: center; ">'.$tweet['time'].'</td><td style="width: 80px; text-align: center; ">'.$status.'</td><td style="width: 300px; ">'.$tweet['tweet'].'</td></tr>';
						}
						if (!$found){
							echo '<tr><td></td><td></td><td></td><td><em>'.__('No scheduled tweet history found.', 'azrcrv-tt').'</em></td></tr>';
						}
					?>
					</table>
				</p>
			</div>
        </div>
</div>