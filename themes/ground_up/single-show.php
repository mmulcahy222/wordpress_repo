<!DOCTYPE html>
<html>
<head>
	<title>
	</title>
	<link rel="stylesheet" id="headway-google-fonts" href="//fonts.googleapis.com/css?family=Raleway" type="text/css" media="all">
	<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri() . '/single_show.css?v=' . time(); ?>">

</head>
<body style="">
	<?php 
	$id = get_the_ID();
	$md = get_post_meta($id);
	$description = $md['description']['0'];
	$show_title = $md['show_title']['0'];
	$band_or_artist = $md['band_or_artist']['0'];
	$date_of_show = $md['date_of_show']['0'];
	$date_of_show = date("l, M dS", strtotime(get_field('date_of_show')));
	$show_time = $md['show_time']['0'];
	$show_address = $md['show_address']['0'];
	$google_map = $md['google_map']['0'];
	$ticket_link = $md['ticket_link']['0'];
	$more_info_link = $md['more_info_link']['0'];
	$excerpt = $md['excerpt']['0'];
	$discount_code = $md['discount_code']['0'];
	$promo_partner_link = $md['promo_partner_link']['0'];
	$charity_partner_link = $md['charity_partner_link']['0'];
	$charity_partner_link = (!empty($charity_partner_link)) ? $charity_partner_link : "TBA";
	$venue = $md['venue']['0'];
	$images = get_field('image');
	$thumbnail_url = $images['sizes']['thumbnail'];
	$thumbnail_width = $images['sizes']['medium-width'];
	$thumbnail_height = $images['sizes']['medium-height'];
	?>
	<div id="view_3_wrapper">
		<div class="wrapper wrapper-fluid wrapper-fixed-grid grid-fluid-24-30-30 responsive-grid wrapper-first" data-alias="Header - Small Text">
			<div class="grid-container clearfix">
				<section class="row row-1">
				</section>
			</div>
		</div>
		<div class="wrapper wrapper-fluid wrapper-fixed-grid grid-fluid-24-30-30 responsive-grid" data-alias="">
			<div class="grid-container clearfix">
				<section class="row row-1">
					<section class="column column-1 grid-left-0 grid-width-24">
						<div class="block block-type-content block-fluid-height" data-alias="">
							<div class="block-content">
								<div class="loop">
									<article id="post-515" class="post-515 show type-show status-publish has-post-thumbnail hentry author-rsswpadmin " itemscope="" itemtype="http://schema.org/CreativeWork">
										<a href="https://rockstarsandstripesshow.com/show/grove-anaheim-rock-stars-and-stripes/" class="post-thumbnail post-thumbnail-left">
											<img src="<?php echo $thumbnail_url; ?>" alt="The Grove of Anaheim welcomes Rock Stars &amp; Stripes" width="125" height="125" itemprop="image" title="" style="">
										</a>
										<header>
											<h1 class="entry-title" itemprop="headline"><?php echo $venue; ?> welcomes <?php echo $band_or_artist; ?></h1>
										</header>
										<div class="entry-content" itemprop="text">
											<h3><?php echo $date_of_show; ?> @ <?php echo $show_time; ?></h3>
											<h5><strong>Get your tickets here</strong>:&nbsp;<strong><a href="<?php echo $ticket_link; ?>"><?php echo $ticket_link; ?></a></strong></h5>
											<?php echo $description; ?>
											<h3>Charity of the Evening:&nbsp;<?php echo $charity_partner_link; ?></h3>
											<p>We are currently seeking a charity partner for this show to be our “Charity of the Evening”. You can help us support our Charity of the Evening&nbsp;by participating in the Rock Stars &amp; Stripes autographed LIVE auction or by buying a collectible RS&amp;S tour book, which the cast is happy to autograph for you after the show.</p>
											<div style="clear: both;"></div>
											<h3>Charity Guitar Auction</h3>
											<figure id="attachment_288" style="width: 600px" class="wp-caption alignright">
												<img class="rss-highlight wp-image-288" src="http://localhost/rock_roll_site/view_3_files/rss-guitar-wrap-300x187.jpg" alt="Rock Stars &amp; Stripes - autographed and wrapped guitar to benefit the evening&#39;s charity" width="600" height="375" srcset="https://rockstarsandstripesshow.com/wp2016/wp-content/uploads/2016/05/rss-guitar-wrap-300x187.jpg 300w, https://rockstarsandstripesshow.com/wp2016/wp-content/uploads/2016/05/rss-guitar-wrap-768x480.jpg 768w, https://rockstarsandstripesshow.com/wp2016/wp-content/uploads/2016/05/rss-guitar-wrap-1024x640.jpg 1024w" sizes="(max-width: 600px) 100vw, 600px">
												<figcaption class="wp-caption-text">A ROCK STARS &amp; STRIPES wrapped and autographed guitar will be auctioned off each and every show night with the proceeds benefiting the Charity of the Evening</figcaption>
											</figure>
											<p>One of the ways David Victor Presents is raising money for our Charity of the Evening&nbsp;is through the Charity Guitar Auction. A wrapped and autographed ROCK STARS &amp; STRIPES guitar is auctioned off during the show. <strong>All proceeds of this guitar auction on this night will go to the Charity of the Evening. </strong></p>
											<p>We also offer a collectable Tour Book for sale, with all the profits going to the Charity of the Evening.</p>
											<p>Be sure to stop by the media table at the end of the night and <strong>get your Tour Book autographed by all the members of the cast</strong>!<strong><br>
											</strong>
										</p>
										<div style="clear: both;"></div>
										<h2>Sponsored By:</h2>
										<p>Sponsorships for this show are available. Contact Linda Brothers of David Victor Presents at 717.495.1996 or linda@davidvictor.com today!</p>
									</div>
								</article>
							</div>
						</div>
					</div>
				</section>
			</section>
		</div>
	</div>
	<footer>
		<div class="footer-heading">
			<h2 class="share-heading">Connect and Share on Social Media</h2>
			<h3 class="share-heading">We're tracking the #rockstarsandstripes #americanrockexperience #musicnotpolitics tags</h3>
		</div>
		<div class="social-icons-container">
			<ul class="social-icons">
				<li><a href="https://www.facebook.com/RockStarsAndStripesShow/"><img src="http://localhost/rock_roll_site/view_3_files/Facebook.png" class="img-1"></a></li>
				<li><a href="https://twitter.com/rokstarsnstripe"><img src="http://localhost/rock_roll_site/view_3_files/Twitter.png" class="img-2"></a></li>
				<li><a href="https://www.instagram.com/rockstarsandstripes/"><img src="http://localhost/rock_roll_site/view_3_files/Instagram.png" class="img-3"></a></li>
			</ul>
		</div>
		<div class="visit_container">
			<p class="copyright">© 2017 <a href="http://www.davidvictorpresents.com/" target="_blank">David Victor Presents</a></p>
		</div>
	</footer>
</div>
</body>
</html>
