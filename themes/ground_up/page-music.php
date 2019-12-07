<?php get_header(); ?>
<!-- START BODY -->
<div class="pane">
	<div class="pane_inner">
		
		<!-- IF YOU WANT TO SEE THE CONTENT FROM the ADMIN, JUST ECHO the_content() -->
		<div id="player" ></div>
		<!-- player -->
		<div id="my_custom_player" >
			<div class="icons">
				<a onclick="change_button(this)" id="player_control_button_id" type="button" class="control_link" aria-label="Left Align">
					<span id="glyph_holder" class="glyphicon glyphicon-pause" aria-hidden="true"></span>
				</a>
			</div>
			<div class="slider_div vertical-align">
				<div id="slider_timeline" style="width: 600px"></div> 
			</div>
			<div class="music_time vertical-align">
				0:00
			</div>
		</div>
		<!-- end player -->
		<!-- directions -->
		<div class="music_directions">
			Click on the name of the song or album, and the song will play.
		</div>
		<!-- end directions -->
		<?php

		//Database Call
		$ordered_category_ids = $wpdb->get_col('SELECT t.term_id FROM '.$wpdb->terms.' as t LEFT JOIN '.$wpdb->term_taxonomy.' AS tt ON t.term_id = tt.term_id WHERE tt.taxonomy = "category" AND t.term_id > 1 ORDER BY t.term_order');

		//run through all categories
		foreach ($ordered_category_ids as $key => $category_id) 
		{
			echo '<div class="music_category_title">' . get_cat_name($category_id) . '</div>';
			echo '<div class="song_list">'; //start song list
			$the_query = new WP_Query( 
				array( 
					'post_type' => array('song','album'),
					'nopaging' => true,
					'cat' => $category_id,
					'meta_key' => 'rating',
					'orderby' => 'meta_value_num',
					'order' => 'ASC'
					) 
				);
			if ( $the_query->have_posts() ) 
			{
				while ( $the_query->have_posts() ) {
					$the_query->the_post();

					echo "<div video-id='" . get_video_id_with_link(get_field('youtube_link')) . "' time='". get_field('time_of_best_part') ."'><span onclick='switch_song(this.parentNode)' class='band_song_name'>". get_field('rating') . '. ' . ucfirst(get_the_title())."</span></div>";
				}
				/* Restore original Post Data */
				wp_reset_postdata();
			} 
		
			echo '</div>'; //end the song list
		}
		?>
		<!-- <div class="song_list">
			<div video-id="gOm6B-ZV4Qk" time="0:44"><span onclick="switch_song(this.parentNode)" class="band_song_name">Django Django - Silver Rays</span></div>
		-->
	</div><!-- END pane_inner -->
</div><!-- END pane -->
<?php get_footer(); ?>