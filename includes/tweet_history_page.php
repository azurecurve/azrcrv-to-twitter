<div class="wrap arcrv-tt">
	
	<h1><?php echo esc_html(get_admin_page_title()); ?></h1>
	
	<table>
		<tr>
			<th style="width: 100px; ">Date</th>
			<th style="width: 80px; ">Time</th>
			<th style="width: 80px; ">Title</th>
			<th style="width: 300px; text-align: left; ">Tweet</th>
		</tr>
		<?php
		$tweet_history = array();
		
		$manual_tweet_history = get_option('azrcrv-tt-manual-tweet-history');
		$manual_tweet_history = array_reverse($manual_tweet_history, true);
		
		foreach ($manual_tweet_history as $key => $tweet){
			if ($tweet['status'] == 200){
				if (isset($tweet['key'])){
					$tweet_key = $tweet['key'];
				}else{
					$tweet_key = strtotime($tweet['date'].' '.$tweet['time']);
				}
				$tweet_history[] = array(
											'key' => $tweet_key,
											'date' => $tweet['date'],
											'time' => $tweet['time'],
											'title' => 'Manual Tweet',
											'tweet' => $tweet['tweet'],
											'tweet_id' => (isset($tweet['tweet_id']) ? $tweet['tweet_id'] : ''),
											'author' => (isset($tweet['author']) ? $tweet['author'] : ''),
										);
			}
		}
		
		$scheduled_tweet_history = get_option('azrcrv-tt-scheduled-tweet-history');
		$scheduled_tweet_history = array_reverse($scheduled_tweet_history, true);
		
		foreach ($scheduled_tweet_history as $key => $tweet){
			if ($tweet['status'] == 200){
				if (isset($tweet['key'])){
					$tweet_key = $tweet['key'];
				}else{
					$tweet_key = strtotime($tweet['date'].' '.$tweet['time']);
				}
				$tweet_history[] = array(
											'key' => $tweet_key,
											'date' => $tweet['date'],
											'time' => $tweet['time'],
											'title' => 'Scheduled Tweet',
											'tweet' => $tweet['tweet'],
											'tweet_id' => (isset($tweet['tweet_id']) ? $tweet['tweet_id'] : ''),
											'author' => (isset($tweet['author']) ? $tweet['author'] : ''),
										);
			}
		}
		
		global $wpdb;
		
		$SQL = "SELECT p.ID AS post_id, p.post_title FROM `".$wpdb->prefix."posts` p INNER JOIN `".$wpdb->prefix."postmeta` pm ON pm.post_id = p.id AND pm.meta_key = 	'_azrcrv_tt_tweet_history' WHERE p.post_status = 'publish' ORDER BY p.post_title";
		$posts = $wpdb->get_results($SQL);
		
		foreach ($posts as $post){
			if(metadata_exists('post', $post->post_id, '_azrcrv_tt_tweet_history')) {
				foreach(array_reverse(get_post_meta($post->post_id, '_azrcrv_tt_tweet_history', true )) as $key => $tweet){
					if (isset($tweet['key'])){
						$tweet_key = $tweet['key'];
						$tweet_date = $tweet['date'];
						$tweet_time = $tweet['time'];
					}else{
						$tweet_key = strtotime($key);
						$tweet_date = date_format(date_create($key), "Y-m-d");
						$tweet_time = date_format(date_create($key), "H:i");
					}
					
					$tweet_history[] = array(
												'key' => $tweet_key,
												'date' => $tweet_date,
												'time' => $tweet_time,
												'title' => $post->post_title,
												'tweet' => (is_array($tweet) ? $tweet['tweet'] : $tweet),
												'tweet_id' => (isset($tweet['tweet_id']) ? $tweet['tweet_id'] : ''),
												'author' => (isset($tweet['author']) ? $tweet['author'] : ''),
											);
				}
			}
		}
				
		krsort($tweet_history);
		$col = array_column( $tweet_history, "key" );
array_multisort( $col, SORT_DESC, $tweet_history );
		
		$found = false;
		foreach ($tweet_history as $key => $tweet){
			$found = true;
			if (isset($tweet['author']) AND strlen($tweet['author']) > 0){
				$tweet_link = '<a href="https://twitter.com/'.$tweet['author'].'/status/'.$tweet['tweet_id'].'" style="text-decoration: none; "><span class="dashicons dashicons-twitter"></span></a>&nbsp';
			}else{
				$tweet_link = '';
			}
			echo '<tr><td style=" text-align: center; ">'.$tweet['date'].'</td><td style="text-align: center; ">'.$tweet['time'].'</td><td style="text-align: center; ">'.$tweet['title'].'</td><td style=" ">'.$tweet_link.$tweet['tweet'].'</td></tr>';
		}
		if (!$found){
			echo '<tr><td></td><td></td><td></td><td><em>'.__('No tweet history found.', 'azrcrv-tt').'</em></td></tr>';
		}
		
		?>
	</table>
	
</div>