<!DOCTYPE html>
<html>
<head>
	<title>
	</title>
	<link rel="stylesheet" id="headway-google-fonts" href="//fonts.googleapis.com/css?family=Raleway" type="text/css" media="all">
	<?php wp_head(); ?>
</head>
<body>
	<?php
	//REGEX FUNCTION TO READ LOCATION FIELD
	function get_city_and_state($str)
	{
		$regex_state_abbreviations = '';
		$state_abbreviations = array (0 => 'AL', 1 => 'AK', 2 => 'AS', 3 => 'AZ', 4 => 'AR', 5 => 'CA', 6 => 'CO', 7 => 'CT', 8 => 'DE', 9 => 'DC', 10 => 'FM', 11 => 'FL', 12 => 'GA', 13 => 'GU', 14 => 'HI', 15 => 'ID', 16 => 'IL', 17 => 'IN', 18 => 'IA', 19 => 'KS', 20 => 'KY', 21 => 'LA', 22 => 'ME', 23 => 'MH', 24 => 'MD', 25 => 'MA', 26 => 'MI', 27 => 'MN', 28 => 'MS', 29 => 'MO', 30 => 'MT', 31 => 'NE', 32 => 'NV', 33 => 'NH', 34 => 'NJ', 35 => 'NM', 36 => 'NY', 37 => 'NC', 38 => 'ND', 39 => 'MP', 40 => 'OH', 41 => 'OK', 42 => 'OR', 43 => 'PW', 44 => 'PA', 45 => 'PR', 46 => 'RI', 47 => 'SC', 48 => 'SD', 49 => 'TN', 50 => 'TX', 51 => 'UT', 52 => 'VT', 53 => 'VI', 54 => 'VA', 55 => 'WA', 56 => 'WV', 57 => 'WI', 58 => 'WY', 59 => 'ON', 60 => "BC", 61 => "AB", 62 => "SK", 63 => "MB", 64 => "QC", 65 => "NS",66 => "NT",67 => "YT",68 => "NB");
		foreach ($state_abbreviations as $state_abbreviation) {
			$regex_state_abbreviations .= "|$state_abbreviation";
		}
		$regex_state_abbreviations = ltrim($regex_state_abbreviations,"|");
		preg_match("/\w*?,?\s?($regex_state_abbreviations)/",$str,$matches);
		if(!empty($matches[0]))
		{
			return $matches[0];
		}
		////////////////////
		//
		//  TRY THE NEXT METHOD OF CITY & STATE EXTRACTION IF REGEX DIDN'T WORK
		//
		////////////////////
		$show_address_field = $str;
		$location_split = explode(',', $show_address_field);
		$state_abbreviation = trim(end($location_split));
		array_pop($location_split);
		$city = trim(end($location_split));
		$location = "$city, $state_abbreviation";
		return $location;
	}
	?>
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
						$location = get_city_and_state(get_field("show_address"));
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