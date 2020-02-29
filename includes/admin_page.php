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
				<p><label for="record_tweet_history"><input name="record_tweet_history" type="checkbox" id="record_tweet_history" value="1" <?php checked('1', $options['record_tweet_history']); ?> /><?php _e('Record tweet history?', 'to-twitter'); ?></label></p>
			</p>
		</div>
		
		<div class="azrcrv_tt_tabs invisible tabs-3">
			<p class="azrcrv_tt_horiz">
				<span class="description"><?php _e('Enter default hashtags for categories (if the same hashtag is applied to multiple categories and/or tgs then only one instance will be included in the tweet):','to-twitter') ?></span><br/>
				<table>
				<tr><th>Category</th><th>Hashtags</th></tr>
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
				<span class="description"><?php _e('Enter default hashtags for tags (if the same hashtag is applied to multiple categories and/or tgs then only one instance will be included in the tweet):','to-twitter') ?></span><br/>
				<table>
				<tr><th>Tag</th><th>Hashtags</th></tr>
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
				<span class="description"><?php _e('Enter the word and the replacement word; if a replacement is a hashtag, dulicates from category and tag hashtags will be removed:','to-twitter') ?></span><br/>
				<table>
				<tr><th>Word</th><th>Replacement</th></tr>
				<?php
				
				foreach ($options['word-replacement'] as $key => $value) {
					echo '<tr><td><input type="text" name="word-replacement['.$key.'][key]" class="short-text" value="'.$key.'"></td><td><input type="text" name="word-replacement['.$key.'][value]" class="short-text" value="'.$value.'"></td></tr>';
				}
				for ($loop = 0; $loop < 10; $loop++) {
					echo '<tr><td><input type="text" name="word-replacement['.$loop.'][key]" class="short-text" value=""></td><td><input type="text" name="word-replacement['.$loop.'][value]" class="short-text" value=""></td></tr>';
				}
				?>
				</table>
				<span class="description"><?php _e('To remove a replacement, delete the entry in the word column.','to-twitter') ?></span><br/>
			</p>
		</div>
	</div>
	<input type="submit" style="margin-top: 6px;" value="<?php _e('Save Settings', 'to-twitter'); ?>" class="button-primary" id="submit" name="submit" />
	</form>
</div>