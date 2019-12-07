<?php
	//REGEX FUNCTION TO READ LOCATION FIELD
	if(!function_exists('get_city_and_state'))
	{
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
	}
	?>
	<div id="block" class="front-custom-code block block-type-custom-code block-fluid-height" data-alias="TourDates">
		<div class="single_page_all_shows">
			<h3>Upcoming Shows:</h3>
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
				while ( $the_query->have_posts() ) 
				{
					$the_query->the_post();
					//debug
					// echo get_the_title();
					//image
					$images = get_field('image');
					$thumbnail_url = $images['sizes']['medium'];
					$thumbnail_width = $images['sizes']['medium-width'];
					$thumbnail_height = $images['sizes']['medium-height'];
					//date
					$date = date("M dS, Y", strtotime(get_field('date_of_show')));
					$venue = get_field('venue');
					//location
					$show_address_field = get_field("show_address");
					$location_split = explode(',', $show_address_field);
					$state_abbreviation = trim(end($location_split));
					array_pop($location_split);
					$city = trim(end($location_split));
					$location = "$city, $state_abbreviation";
					//google map (get from google maps data first, and then get from address if no google maps)
					$google_map = get_field('google_map');
					if(!empty($google_map))
					{
						$longitude = $google_map['lng'];
						$latitude = $google_map['lat'];
						$map_display_url = 'https://maps.google.com/maps?q='.$latitude.','.$longitude.'&hl=es;z=11&amp;output=embed';
					}
					else
					{
						$map_display_url = 'https://maps.google.com/maps?q='.$show_address_field.'&hl=es;z=11&amp;output=embed';
					}	
					//more info link 
					$detail_link = get_field('more_info_link');
					//ticket link
					$ticket_link = get_field('ticket_link');
					//Title
					$title = "$date - $venue - $location";
					//excerpt
					$excerpt = get_field('excerpt');
					echo '<div class="dv-show-listing"><div class="dv-show-img desktop"><a href="' . $detail_link . '"><img width="'.$thumbnail_width.'" height="200" src="'.$thumbnail_url.'" sizes="(max-width: 300px) 100vw, 300px"></a></div> <div class="dv-show-detail"><span class="dv-date">'.$title.'</span><span class="dv-desc">'.$excerpt.'</span><br><span class="dv-links"><a class="grey-button" href=". $detail_link .">Details</a>&nbsp;&nbsp;&nbsp;<a class="grey-button" href="'.$ticket_link.'" target="_blank">Tickets</a></span></div> <div class="dv-show-img mobile"><a href="'.$detail_link.'"><img width="300" height="200" src="'.$thumbnail_url.'" sizes="(max-width: 300px) 100vw, 300px"></a></div> <div class="dv-map desktop"><iframe src="'.$map_display_url.'" width="298" height="198" frameborder="0" style="border:0" allowfullscreen=""></iframe></div> <div class="dv-map mobile"><iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d13899.761230826558!2d-98.488751!3d29.430541!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xb265a799b3314ad7!2sTobin+Center+for+the+Performing+Arts!5e0!3m2!1sen!2sus!4v1481027893123" width="450" height="150" frameborder="0" style="border:0" allowfullscreen=""></iframe></div></div>'; }
			wp_reset_postdata();
		}
		?>
		<h3>Past Shows:</h3>
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
			while ( $the_query->have_posts() ) 
			{
				$the_query->the_post();
					//debug
					// echo get_the_title();
					//image
					$images = get_field('image');
					$thumbnail_url = $images['sizes']['medium'];
					$thumbnail_width = $images['sizes']['medium-width'];
					$thumbnail_height = $images['sizes']['medium-height'];
					//date
					$date = date("M dS, Y", strtotime(get_field('date_of_show')));
					$venue = get_field('venue');
					//location
					$show_address_field = get_field("show_address");
					$location_split = explode(',', $show_address_field);
					$state_abbreviation = trim(end($location_split));
					array_pop($location_split);
					$city = trim(end($location_split));
					$location = "$city, $state_abbreviation";
					//google map (get from google maps data first, and then get from address if no google maps)
					$google_map = get_field('google_map');
					if(!empty($google_map))
					{
						$longitude = $google_map['lng'];
						$latitude = $google_map['lat'];
						$map_display_url = 'https://maps.google.com/maps?q='.$latitude.','.$longitude.'&hl=es;z=11&amp;output=embed';
					}
					else
					{
						$map_display_url = 'https://maps.google.com/maps?q='.$show_address_field.'&hl=es;z=11&amp;output=embed';
					}	
					//more info link
					$detail_link = get_field('more_info_link');
					//ticket link
					$ticket_link = get_field('ticket_link');
					//Title
					$title = "$date - $venue - $location";
					//excerpt
					$excerpt = get_field('excerpt');
					echo '<div class="dv-show-listing"><div class="dv-show-img desktop"><a href="' . $detail_link . '"><img width="'.$thumbnail_width.'" height="200" src="'.$thumbnail_url.'" sizes="(max-width: 300px) 100vw, 300px"></a></div> <div class="dv-show-detail"><span class="dv-date">'.$title.'</span><span class="dv-desc">'.$excerpt.'</span><br><span class="dv-links"><a class="grey-button" href=". $detail_link .">Details</a></span></div> <div class="dv-show-img mobile"><a href="'.$detail_link.'"><img width="300" height="200" src="'.$thumbnail_url.'" sizes="(max-width: 300px) 100vw, 300px"></a></div> <div class="dv-map desktop"><iframe src="'.$map_display_url.'" width="298" height="198" frameborder="0" style="border:0" allowfullscreen=""></iframe></div> <div class="dv-map mobile"><iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d13899.761230826558!2d-98.488751!3d29.430541!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xb265a799b3314ad7!2sTobin+Center+for+the+Performing+Arts!5e0!3m2!1sen!2sus!4v1481027893123" width="450" height="150" frameborder="0" style="border:0" allowfullscreen=""></iframe></div></div>'; 
			}
			/* Restore original Post Data */
			wp_reset_postdata();
		}
		?>