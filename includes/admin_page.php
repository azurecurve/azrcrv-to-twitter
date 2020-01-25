<?php $azrcrv_tt = get_option('azrcrv-tt'); ?>

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

        <div>
                <p class="azrcrv_tt_horiz">
                    <p><span class="description"><?= __('Consumer key','to-twitter') ?>:</span><br/>
                    <input type="text" size="60" name="azrcrv_tt_access_key" class="regular-text" value="<?php echo $azrcrv_tt['access_key']; ?>"></p>
                   <p> <span class="description"><?= __('Consumer secret','to-twitter') ?>:</span><br/>
                    <input type="text" size="60" name="azrcrv_tt_access_secret" class="regular-text" value="<?php echo $azrcrv_tt['access_secret']; ?>"></p>
                    <p><span class="description"><?= __('Access token','to-twitter') ?>:</span><br/>
                    <input type="text" size="60" name="azrcrv_tt_access_token" class="regular-text" value="<?php echo $azrcrv_tt['access_token']; ?>"></p>
                    <p><span class="description"><?= __('Access token secret','to-twitter') ?>:</span><br/>
                    <input type="text" size="60" name="azrcrv_tt_access_token_secret" class="regular-text" value="<?php echo $azrcrv_tt['access_token_secret']; ?>"></p>
                </p>
        </div>
		<input type="submit" style="margin-top: 6px;" value="<?php _e('Save Settings', 'to-twitter'); ?>" class="button-primary" id="submit" name="submit"/>
    </form>
</div>