<!DOCTYPE html>
<html>
<head>
	<title>
	</title>
	<?php wp_head(); ?>
</head>
<body>
	<div id="block" class="front-custom-code block block-type-custom-code block-fluid-height" data-alias="TourDates">
		<div class="block-content">
			<h3>Upcoming Shows:</h3>
			<!-- insert custom code -->
			<div class="rsslist">
				<div class="header screen">
					<span class="rssdate title">Date</span><span class="rssvenue title">Venue</span><span class="rsslocation title">Location</span><span class="rssdetails title">More Info</span><span class="rsstickets title">Tickets</span>
					<div class="header mobile"><span class="title">Date / Venue</span></div>
				</div>
				<?php
				////////////////////
				//
				//  UPCOMING SHOWS
				//
				////////////////////
				$the_query = new WP_Query(
					array(
						'post_type' => array('show'),
						'nopaging' => true,
						'meta_key' => 'date_of_show',
						'meta_value'   => date("Ymd"),
						'meta_compare' => '>',
						'orderby' => 'date_of_show',
						'order' => 'ASC'
						)
					);
				if ( $the_query->have_posts() )
				{
					while ( $the_query->have_posts() ) {
						$the_query->the_post();
						//debug
						//echo get_the_title();
						//date
						$date = date("M dS", strtotime(get_field('date_of_show')));
						//location
						$show_address_field = get_field("show_address");
						$location_split = explode(',', $show_address_field);
						$state_abbreviation = trim(end($location_split));
						array_pop($location_split);
						$city = trim(end($location_split));
						$location = "$city, $state_abbreviation";
						//more info link
						$detail_link = get_field('more_info_link');
						//ticket link
						$ticket_link = get_field('ticket_link');
						echo '<div class="rssupcomingshows"><span class="rssdate">'.$date.'</span><span class="rssvenue">'.get_field('venue').'</span><span class="rsslocation">'.$location.'</span><span class="rssdetails"><a href="'.$detail_link.'">Details</a></span><span class="rsstickets"><a href="'.$ticket_link.'" target="_blank">Tickets</a></span></div>';
					}
					/* Restore original Post Data */
					wp_reset_postdata();
				}
				?>
			</div>
			<div style="margin-top:15px;">
				<h3>Past Shows:</h3>
			</div>
			<div class="rsslist">
				<div class="header screen">
					<span class="rssdate title">Date</span><span class="rssvenue title">Venue</span><span class="rsslocation title">Location</span><span class="rssdetails title">More Info</span>
				</div>
				<div class="header mobile"><span class="title">Date / Venue</span></div>

				<?php
				////////////////////
				//
				//  PAST SHOWS
				//
				////////////////////
				$the_query = new WP_Query(
					array(
						'post_type' => array('show'),
						'nopaging' => true,
						'meta_key' => 'date_of_show',
						'meta_value'   => date("Ymd"),
						'meta_compare' => '<',
						'orderby' => 'date_of_show',
						'order' => 'DESC'
						)
					);
				if ( $the_query->have_posts() )
				{
					while ( $the_query->have_posts() ) {
						$the_query->the_post();
						//debug
						//echo get_the_title();
						//date
						$date = date("M dS", strtotime(get_field('date_of_show')));
						//location
						$show_address_field = get_field("show_address");
						$location_split = explode(',', $show_address_field);
						$state_abbreviation = trim(end($location_split));
						array_pop($location_split);
						$city = trim(end($location_split));
						$location = "$city, $state_abbreviation";
						//more info link
						$detail_link = get_field('more_info_link');
						//ticket link
						$ticket_link = get_field('ticket_link');
						echo '<div class="rssupcomingshows"><span class="rssdate">'.$date.'</span><span class="rssvenue">'.get_field('venue').'</span><span class="rsslocation">'.$location.'</span><span class="rssdetails"><a href="'.$detail_link.'">Details</a></span><span class="rsstickets"></span></div>';
					}
					/* Restore original Post Data */
					wp_reset_postdata();
				}
				?>
			</div>

		</div>
	</div>
</body>