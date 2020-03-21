<?php $azrcrv_tt = get_option('azrcrv-tt'); ?>

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
		<?php wp_nonce_field('azrcrv-tt-smt', 'azrcrv-tt-smt-nonce'); ?>

        <div>
			<p class="azrcrv_tt_horiz">
				<textarea name="azrcrv_tt_tweet" rows="5" id="azrcrv_tt_tweet" class="large-text code" maxlength="240" onkeyup="countChar(this)" placeholder="<?php _e("What's happening?", 'to-twitter'); ?>"autofocus></textarea>
				<div id="the-count" style='float: right;' >
					<span id="current_counter">0</span><span id="maximum">/240</span>
				</div>
				<input type="submit" style="margin:3px;" value="<?php _e('Send Tweet', 'to-twitter'); ?>" class="button-primary" id="submit" name="submit"/>
			</p>
        </div>
    </form>
</div>