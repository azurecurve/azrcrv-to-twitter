<div class="wrap arcrv-tt">
	
	<h1><?php echo esc_html(get_admin_page_title()); ?></h1>
	
	<table>
		<tr>
			<th style="width: 100px; ">Date</th>
			<th style="width: 80px; ">Time</th>
			<th style="width: 80px; ">Title</th>
			<th style="width: 300px; ">Tweet</th>
		</tr>
		<?php
		$tweet_history = array();
		$scheduled_tweet_history = get_option('azrcrv-tt-scheduled-tweet-history');
		$scheduled_tweet_history = array_reverse($scheduled_tweet_history, true);
		
		foreach ($scheduled_tweet_history as $key => $tweet){
			if ($tweet['status'] == 200){
				$tweet_history[strtotime($tweet['date'].' '.$tweet['time'])] = array(
																						'date' => $tweet['date'],
																						'time' => $tweet['time'],
																						'title' => 'Scheduled Tweet',
																						'tweet' => $tweet['tweet'],
																					);
			}
		}
		
		global $wpdb;
		
		$SQL = "SELECT p.ID AS post_id, p.post_title FROM `".$wpdb->prefix."posts` p INNER JOIN `".$wpdb->prefix."postmeta` pm ON pm.post_id = p.id AND pm.meta_key = 	'_azrcrv_tt_tweet_history' WHERE p.post_status = 'publish' ORDER BY p.post_title";
		$posts = $wpdb->get_results($SQL);
		
		foreach ($posts as $post){
			if(metadata_exists('post', $post->post_id, '_azrcrv_tt_tweet_history')) {
				foreach(array_reverse(get_post_meta($post->post_id, '_azrcrv_tt_tweet_history', true )) as $key => $tweet){
					$tweet_history[strtotime($key)] = array(
																'date' => date_format(date_create($key), "Y-m-d"),
																'time' => date_format(date_create($key), "H:i"),
																'title' => $post->post_title,
																'tweet' => $tweet,
															);
				}
			}
		}
				
		krsort($tweet_history);
		
		$found = false;
		foreach ($tweet_history as $key => $tweet){
			$found = true;
			echo '<tr><td style=" text-align: center; ">'.$tweet['date'].'</td><td style="text-align: center; ">'.$tweet['time'].'</td><td style="text-align: center; ">'.$tweet['title'].'</td><td style=" ">'.$tweet['tweet'].'</td></tr>';
		}
		if (!$found){
			echo '<tr><td></td><td></td><td></td><td><em>'.__('No tweet history found.', 'azrcrv-tt').'</em></td></tr>';
		}
		
		?>
	</table>
	
</div>