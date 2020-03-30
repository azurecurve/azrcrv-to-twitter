<?php $options = get_option('azrcrv-tt'); ?>

<div class="wrap arcrv-tt">

	<h1><?php echo esc_html(get_admin_page_title()); ?></h1>

	<?php if( isset($_GET['settings-updated']) ) { ?>
		<div class="notice notice-success is-dismissible">
			<p><strong><?php esc_html_e('Settings have been saved.', 'to-twitter') ?></strong></p>
		</div>
	<?php } ?>

	<form method="post" action="admin-post.php">
	<input type="hidden" name="action" value="azrcrv_tt_save_options" />
	
	<?php wp_nonce_field('azrcrv-tt', 'azrcrv-tt-nonce'); ?>

	<input type="hidden" name="azrcrv_tt_data_update" value="yes" />

	<?php
	if (isset($options['access_key']) AND strlen($options['access_key']) > 0){
		$showappsettings = false;
	}else{
		$showappsettings = true;
	}
	?>

	<h2 class="nav-tab-wrapper nav-tab-wrapper-azrcrv-tt">
		<a class="nav-tab <?php if ($showappsettings == true){ echo 'nav-tab-active'; } ?>" data-item=".tabs-1" href="#tabs-1"><?php _e('App Settings', 'to-twitter') ?></a>
		<a class="nav-tab <?php if ($showappsettings == false){ echo 'nav-tab-active'; } ?>" data-item=".tabs-2" href="#tabs-2"><?php _e('Default Settings', 'to-twitter') ?></a>
		<a class="nav-tab" data-item=".tabs-3" href="#tabs-3"><?php _e('Category Hashtags', 'to-twitter') ?></a>
		<a class="nav-tab" data-item=".tabs-4" href="#tabs-4"><?php _e('Tag Hashtags', 'to-twitter') ?></a>
		<a class="nav-tab" data-item=".tabs-5" href="#tabs-5"><?php _e('Word Replace', 'to-twitter') ?></a>
		<a class="nav-tab" data-item=".tabs-6" href="#tabs-6"><?php _e('Schedule Random Post', 'to-twitter') ?></a>
		<a class="nav-tab" data-item=".tabs-7" href="#tabs-7"><?php _e('Schedule Random Page', 'to-twitter') ?></a>
		<input type="submit" style="float: left; margin: 6px; margin-bottom: 3px " value="<?php _e('Save Settings', 'to-twitter'); ?>" class="button-primary" id="submit" name="submit" />
	</h2>

	<div>
		<div class="azrcrv_tt_tabs <?php if ($showappsettings == false){ echo 'invisible'; } ?> tabs-1">
			<p class="azrcrv_tt_horiz">
				<p><span class="description"><?php _e('Consumer key','to-twitter') ?>:</span><br/>
				<input type="text" name="access_key" class="regular-text" value="<?php echo $options['access_key']; ?>"></p>
				<p> <span class="description"><?php _e('Consumer secret','to-twitter') ?>:</span><br/>
				<input type="text" name="access_secret" class="regular-text" value="<?php echo $options['access_secret']; ?>"></p>
				<p><span class="description"><?php _e('Access token','to-twitter') ?>:</span><br/>
				<input type="text" name="access_token" class="regular-text" value="<?php echo $options['access_token']; ?>"></p>
				<p><span class="description"><?php _e('Access token secret','to-twitter') ?>:</span><br/>
				<input type="text" name="access_token_secret" class="regular-text" value="<?php echo $options['access_token_secret']; ?>"></p>
			</p>
		</div>
		
		<div class="azrcrv_tt_tabs <?php if ($showappsettings == true){ echo 'invisible'; } ?> tabs-2">
			<p class="azrcrv_tt_horiz">
				<p><label for="default_autopost"><input name="default_autopost" type="checkbox" id="default_autopost" value="1" <?php checked('1', $options['default_autopost']); ?> /><?php _e('Autopost new posts?', 'to-twitter'); ?></label></p>
				<p><label for="default_autopost_page"><input name="default_autopost_page" type="checkbox" id="default_autopost_page" value="1" <?php checked('1', $options['default_autopost_page']); ?> /><?php _e('Autopost new pages?', 'to-twitter'); ?></label></p>
				<p><label for="record_tweet_history"><input name="record_tweet_history" type="checkbox" id="record_tweet_history" value="1" <?php checked('1', $options['record_tweet_history']); ?> /><?php _e('Record tweet history?', 'to-twitter'); ?></label></p>
				<p><label for="prefix_tweets_with_dot"><input name="prefix_tweets_with_dot" type="checkbox" id="prefix_tweets_with_dot" value="1" <?php checked('1', $options['prefix_tweets_with_dot']); ?> /><?php _e('Prefix tweets with a dot which start with @?', 'to-twitter'); ?></label></p>
			</p>
		</div>
		
		<div class="azrcrv_tt_tabs invisible tabs-3">
			<p class="azrcrv_tt_horiz">
				<p><span class="description"><?php _e('Enter default hashtags for categories (if the same hashtag is applied to multiple categories and/or tgs then only one instance will be included in the tweet):','to-twitter') ?></span></p>
				
				<table>
					<tr><th><?php _e('Category', 'to-twitter'); ?></th><th><?php _e('Hashtags', 'to-twitter'); ?></th></tr>
					<?php
					$categories = get_categories(
													array(
														'orderby' => 'name',
														'hide_empty' => false,
													)
												);
					
					foreach ($categories as $category) {
						echo '<tr><td>'.$category->name.'</td><td><input type="text" name="category-hashtags['.$category->term_id.']" class="regular-text" value="'.$options['category-hashtags'][$category->term_id].'"></td></tr>';
					}
					?>
				</table>
			</p>
		</div>
		
		<div class="azrcrv_tt_tabs invisible tabs-4">
			<p class="azrcrv_tt_horiz">
				<p><span class="description"><?php _e('Enter default hashtags for tags (if the same hashtag is applied to multiple categories and/or tgs then only one instance will be included in the tweet):','to-twitter') ?></span></p>
				
				<table>
					<tr><th><?php _e('Tag', 'to-twitter'); ?></th><th><?php _e('Hashtags', 'to-twitter'); ?></th></tr>
					<?php
					$tags = get_tags(
													array(
														'orderby' => 'name',
														'hide_empty' => false,
													)
												);
					
					foreach ($tags as $tag) {
						echo '<tr><td>'.$tag->name.'</td><td><input type="text" name="tag-hashtags['.$tag->term_id.']" class="regular-text" value="'.$options['tag-hashtags'][$tag->term_id].'"></td></tr>';
					}
					?>
				</table>
			</p>
		</div>
		
		<div class="azrcrv_tt_tabs invisible tabs-5">
			<p class="azrcrv_tt_horiz">
				<p><span class="description"><?php _e('Enter the word and the replacement word; if a replacement is a hashtag, dulicates from category and tag hashtags will be removed:','to-twitter') ?></span></p>
				
				<table>
					<tr><th><?php _e('Word', 'to-twitter'); ?></th><th><?php _e('Replacement', 'to-twitter'); ?></th></tr>
					<?php
					
					foreach ($options['word-replacement'] as $key => $value){
						echo '<tr><td><input type="text" name="word-replacement['.$key.'][key]" class="short-text" value="'.$key.'"></td><td><input type="text" name="word-replacement['.$key.'][value]" class="short-text" value="'.$value.'"></td></tr>';
					}
					for ($loop = 0; $loop < 10; $loop++){
						echo '<tr><td><input type="text" name="word-replacement['.$loop.'][key]" class="short-text" value=""></td><td><input type="text" name="word-replacement['.$loop.'][value]" class="short-text" value=""></td></tr>';
					}
					?>
				</table>
				<p><span class="description"><?php _e('To remove a replacement, delete the entry in the word column.','to-twitter') ?></span></p>
			</p>
		</div>
		
		<div class="azrcrv_tt_tabs invisible tabs-6">
			<p class="azrcrv_tt_horiz">
				<p><span class="description"><?php _e('Due to the limitations of the WP Cron process, a scheduled tweet will only be sent if the site receives a visit on or after the scheduled time; this does mean a tweet scheduled for Monday at 10:00 woould, if a visitor first arrived at 21:09, get tweeted at that time. If there is no visitor on a day when a tweet is scheduled, then no tweet will be sent.','to-twitter') ?></span></p>
				
				<h4><?php _e('Schedule', 'to-twitter'); ?></h4>
				<p><table>
				<tr><th><?php _e('Day', 'to-twitter'); ?></th><th><?php _e('Time', 'to-twitter'); ?></th><th><?php _e('Filter', 'to-twitter'); ?></th><th><?php _e('Category', 'to-twitter'); ?></th><th><?php _e('Enable', 'to-twitter'); ?></th></tr>
				<?php
				
				$days = array(
								0 => 'Sunday',
								1 => 'Monday',
								2 => 'Tuesday',
								3 => 'Wednesday',
								4 => 'Thursday',
								5 => 'Friday',
								6 => 'Saturday',
							);
				
				for ($dayloop = 0; $dayloop < 7; $dayloop++){
					echo '<tr>';
					// day
					echo '<td>'.$days[$dayloop].'</td>';
					// time
					echo '<td>';
						echo	'<select name="scheduled-post['.$dayloop.'][time]">';
							for ($timeloop = 0; $timeloop < 24; $timeloop++){
								$time = substr('0'.$timeloop,-2);
								$selected_00 = '';
								$selected_30 = '';
								if ($options['scheduled-post'][$dayloop]['time'] == $time.':00'){
									$selected_00 = 'selected';
								}elseif ($options['scheduled-post'][$dayloop]['time'] == $time.':30'){
									$selected_30 = 'selected';
								}
								echo	'<option value="'.$time.':00" '.$selected_00.' >'.$time.':00</option>';
								echo	'<option value="'.$time.':30" '.$selected_30.' >'.$time.':30</option>';
							}
						echo	'</select>';
					echo '</td>';
					// filter
					echo '<td>';
						echo	'<select name="scheduled-post['.$dayloop.'][filter]">';
							if ($options['scheduled-post'][$dayloop]['filter'] == 'Is'){
								$selected_is = 'selected';
								$selected_isnot = '';
							}else{
								$selected_is = '';
								$selected_isnot = 'selected';
							}
							echo	'<option value="Is" '.$selected_is.' >Is</option>';
							echo	'<option value="Is Not" '.$selected_isnot.' >Is Not</option>';
						echo	'</select>';
					echo '</td>';
					// category
					echo '<td>';
						echo	'<select name="scheduled-post['.$dayloop.'][category]">';
							$categories = get_categories(
															array(
																'orderby' => 'name',
																'hide_empty' => false,
															)
														);
							
							foreach ($categories as $category) {
								if ($options['scheduled-post'][$dayloop]['category'] == $category->term_id){
									$selected = 'selected';
								}else{
									$selected = '';
								}
								echo	'<option value="'.$category->term_id.'" '.$selected.' >'.$category->name.'</option>';
							}
						echo	'</select>';
					echo '</td>';
					// enabled
					echo '<td>';
						if ($options['scheduled-post'][$dayloop]['enabled'] == 1){
							$checked = 'checked';
						}else{
							$checked = '';
						}
						echo '<input name="scheduled-post['.$dayloop.'][enabled]" type="checkbox" id="scheduled-post['.$dayloop.'][enabled]" value="1" '.$checked.' />';
					echo '</td>';
					echo '</tr>';
				}
				?>
				</table></p>
				
				<h4><?php _e('Tweet Settings', 'to-twitter'); ?></h4>
				<p>
					<label for="scheduled-tweet-generate"><input name="scheduled-tweet-generate" type="checkbox" id="scheduled-tweet-generate" value="1" <?php checked('1', $options['scheduled-tweet-generate']); ?> /><?php _e('Generate new tweet?', 'to-twitter'); ?></label>
				</p>
				<p>
					<p><span class="description"><?php _e('Scheduled tweet prefix','to-twitter') ?>:</span><br/>
					<input type="text" name="scheduled-tweet-prefix" class="short-text" value="<?php echo $options['scheduled-tweet-prefix']; ?>"></p>
				</p>
				<p>
					<label for="scheduled-tweet-suffix"><input name="scheduled-tweet-suffix" type="checkbox" id="scheduled-tweet-suffix" value="1" <?php checked('1', $options['scheduled-tweet-suffix']); ?> /><?php _e('Include numeric suffix?', 'to-twitter'); ?></label><br />
					<?php printf(__('Scheduled tweets will be appended with %s where %s is a sequential number.', 'to-twitter'), '<strong>[<em>n</em>]</strong>', '<strong><em>n</em></strong>'); ?>
				</p>
				<p>
					<p><span class="description"><?php _e('Select posts at least this many days old','to-twitter') ?>:</span><br/>
					<select name="newest-post-age">
						<?php
							for ($ageloop = 0; $ageloop <= 365; $ageloop++){
								if ($options['newest-post-age'] == $ageloop){
									$selected = 'selected';
								}else{
									$selected = '';
								}
								echo '<option value="'.$ageloop.'" '.$selected.' >'.$ageloop.'</option>';
							}
						?>
					</select>
				</p>
				
				<h4><?php _e('Select tags which should not be included in scheduled tweets:', 'to-twitter'); ?></h4>
				<p><table>
				<tr><th><?php _e('Tag', 'to-twitter'); ?></th><th><?php _e('Exclude', 'to-twitter'); ?></th></tr>
				<?php
				$tags = get_tags(
									array(
										'orderby' => 'name',
										'hide_empty' => false,
									)
								);
				
				foreach ($tags as $tag) {
					echo '<tr>';
						echo '<td>';
							echo $tag->name;
						echo '</td>';
						echo '<td>';
							if ($options['excluded-tags'][$tag->term_id] == 1){
								$checked = 'checked';
							}else{
								$checked = '';
							}
							echo '<input name="excluded-tags['.$tag->term_id.']" type="checkbox" id="excluded-tags['.$tag->term_id.']" value="1" '.$checked.' />';
						echo '</td>';
					echo '</tr>';
				}
				?>
				</table></p>
			</p>
		</div>
		
		<div class="azrcrv_tt_tabs invisible tabs-7">
			<p class="azrcrv_tt_horiz">
				<p><span class="description"><?php _e('Due to the limitations of the WP Cron process, a scheduled tweet will only be sent if the site receives a visit on or after the scheduled time; this does mean a tweet scheduled for Monday at 10:00 woould, if a visitor first arrived at 21:09, get tweeted at that time. If there is no visitor on a day when a tweet is scheduled, then no tweet will be sent.','to-twitter') ?></span></p>
				
				<h4><?php _e('Schedule', 'to-twitter'); ?></h4>
				<p><table>
				<tr><th><?php _e('Day', 'to-twitter'); ?></th><th><?php _e('Time', 'to-twitter'); ?></th><th><?php _e('Filter', 'to-twitter'); ?></th><th><?php _e('Post Content', 'to-twitter'); ?></th><th><?php _e('Enable', 'to-twitter'); ?></th></tr>
				<?php
				
				$days = array(
								0 => 'Sunday',
								1 => 'Monday',
								2 => 'Tuesday',
								3 => 'Wednesday',
								4 => 'Thursday',
								5 => 'Friday',
								6 => 'Saturday',
							);
				
				for ($dayloop = 0; $dayloop < 7; $dayloop++){
					echo '<tr>';
						// day
						echo '<td>'.$days[$dayloop].'</td>';
						// time
						echo '<td>';
							echo '<select name="scheduled-page['.$dayloop.'][time]">';
								for ($timeloop = 0; $timeloop < 24; $timeloop++){
									$time = substr('0'.$timeloop,-2);
									$selected_00 = '';
									$selected_30 = '';
									if ($options['scheduled-page'][$dayloop]['time'] == $time.':00'){
										$selected_00 = 'selected';
									}elseif ($options['scheduled-page'][$dayloop]['time'] == $time.':30'){
										$selected_30 = 'selected';
									}
									echo '<option value="'.$time.':00" '.$selected_00.' >'.$time.':00</option>';
									echo '<option value="'.$time.':30" '.$selected_30.' >'.$time.':30</option>';
								}
							echo '</select>';
						echo '</td>';
						// filter
						echo '<td>';
							echo '<select name="scheduled-page['.$dayloop.'][filter]">';
								if ($options['scheduled-page'][$dayloop]['filter'] == 'Contains'){
									$selected_contains = 'selected';
									$selected_doesnotcontain = '';
								}else{
									$selected_contains = '';
									$selected_doesnotcontain = 'selected';
								}
								echo '<option value="Contains" '.$selected_contains.' >Contains</option>';
								echo '<option value="Does Not Contain" '.$selected_doesnotcontain.' >Does Not Contain</option>';
							echo	'</select>';
						echo '</td>';
						// category
						echo '<td>';
							echo '<input type="text" name="scheduled-page['.$dayloop.'][textcontains]" class="short-text" value="'.$options['scheduled-page'][$dayloop]['textcontains'].'" style="margin-top: 12px; "></p>';
						echo '</td>';
						// enabled
						echo '<td>';
							if ($options['scheduled-page'][$dayloop]['enabled'] == 1){
								$checked = 'checked';
							}else{
								$checked = '';
							}
							echo '<input name="scheduled-page['.$dayloop.'][enabled]" type="checkbox" id="scheduled-page['.$dayloop.'][enabled]" value="1" '.$checked.' />';
						echo '</td>';
					echo '</tr>';
				}
				?>
				</table></p>
				
				<h4><?php _e('Tweet Settings', 'to-twitter'); ?></h4>
				<p>
					<label for="scheduled-page-tweet-generate"><input name="scheduled-page-tweet-generate" type="checkbox" id="scheduled-page-tweet-generate" value="1" <?php checked('1', $options['scheduled-page-tweet-generate']); ?> /><?php _e('Generate new tweet?', 'to-twitter'); ?></label>
				</p>
				<p>
					<p><span class="description"><?php _e('Scheduled tweet prefix','to-twitter') ?>:</span><br/>
					<input type="text" name="scheduled-page-tweet-prefix" class="short-text" value="<?php echo $options['scheduled-page-tweet-prefix']; ?>"></p>
				</p>
				<p>
					<label for="scheduled-page-tweet-suffix"><input name="scheduled-page-tweet-suffix" type="checkbox" id="scheduled-page-tweet-suffix" value="1" <?php checked('1', $options['scheduled-page-tweet-suffix']); ?> /><?php _e('Include numeric suffix?', 'to-twitter'); ?></label><br />
					<?php printf(__('Scheduled tweets will be appended with %s where %s is a sequential number.', 'to-twitter'), '<strong>[<em>n</em>]</strong>', '<strong><em>n</em></strong>'); ?>
				</p>
				<p>
					<p><span class="description"><?php _e('Select pages at least this many days old','to-twitter') ?>:</span><br/>
					<select name="newest-page-age">
						<?php
							for ($ageloop = 0; $ageloop <= 365; $ageloop++){
								if ($options['newest-page-age'] == $ageloop){
									$selected = 'selected';
								}else{
									$selected = '';
								}
								echo '<option value="'.$ageloop.'" '.$selected.' >'.$ageloop.'</option>';
							}
						?>
					</select>
				</p>
			</p>
		</div>
	</div>
	<input type="submit" style="margin-top: 6px;" value="<?php _e('Save Settings', 'to-twitter'); ?>" class="button-primary" id="submit" name="submit" />
	</form>
</div>
