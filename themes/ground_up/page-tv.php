<?php get_header(); ?>
<!-- START BODY -->
<div class="pane">
	<div class="pane_inner">

		<!-- Top TV Menu -->
		<ul class="top_tv_menu">
			<!-- Search Bar -->
			<li class="text-center">
				<input type="text" class="tv_search_bar" value="Enter TV Show Here"/>
			</li><!-- Search Bar -->
			<!-- Episode Drop Down -->

			<li class="tv_drop_down_wrapper">
				<div class="tv_drop_down_list dropdown">
					<button class="tv_drop_down_button btn btn-primary dropdown-toggle" style="background-color: black; color: #ED2734; outline: none; border: 1px solid #ED2734" type="button" data-toggle="dropdown">
						<span class="tv_drop_down_loading"></span>
						<span class="tv_drop_down_list_text">Write TV Show on the left</span>
						<span class="caret"></span>
					</button>
					<ul class="dropdown-menu">
						<li><a class="episode_link" onclick="javascript: void(0);" value="aHR0cDovL29ud2F0Y2hzZXJpZXMudG8vZXBpc29kZS9zb3V0aF9wYXJrX3MyMF9lOS5odG1s">Season 20, Episode 9       ()</a></li>
						

						
					</ul>
				</div>
			</li>
		</ul> <!-- Top TV Menu -->
		<!-- Video Area -->
		<div class="player_wrapper">
			<video poster="">
				<!-- Video files -->
				<source src="http://www.newpaltzartist.com/banff.mp4" id="player_source" type="video/mp4"/>
			</video>
		</div><!-- Video Area -->
	</div><!-- END pane_inner -->
</div><!-- END pane -->
<script>
	(function() { 
			//start player
			instances = plyr.setup();	

			//ajax call activation by keypress
			ajax_timeout_object = null;
			jQuery('.tv_search_bar').keypress(function(e){
				$(".tv_drop_down_list_text").first().html("Wait for search results for " + $('.tv_search_bar').first().val() + String.fromCharCode(e.keyCode || e.which));
				clearTimeout(ajax_timeout_object);
				ajax_timeout_object = setTimeout(ajax_call,3500);
			});

			/////////////////
			////
			////	MOVIE LINK AJAX
			////
			/////////////////
			function ajax_call()
			{
				$.ajax({
					url:  "<?php bloginfo( 'wpurl' ); ?>" + "/wp-admin/admin-ajax.php",
					type: 'GET',
					dataType: 'html',
					data: {action: 'get_episodes', query: jQuery('.tv_search_bar').first().val(), key: '<?php echo wp_create_nonce( 'safety' ); ?>' },
					beforeSend: function(){
						$(".tv_drop_down_loading").css({ display: "block" });
						$(".tv_drop_down_list_text").hide();
						$(".caret").hide();		
					}
				})
				.done(function(response) {
					//loading
					$(".tv_drop_down_loading").css({ display: "none" });
					$(".tv_drop_down_list_text").show();
					$(".tv_drop_down_list_text").html('Click here to see episode list');
					$(".caret").show();	
					//fill ul li
					$(".dropdown-menu").html(response);
				})
				.fail(function() {
					console.log("error");
				})
				.always(function() {
					console.log("complete");
				});
			}

			/////////////////
			////
			////	GET MOVIE AJAX
			////
			/////////////////
			$(document).on('click','.episode_link',function(event) {
				$.sent_request = $.ajax({
					url: "<?php bloginfo( 'wpurl' ); ?>" + "/wp-admin/admin-ajax.php",
					type: 'GET',
					data: {action: 'get_movie_link', url: $(this).attr('value'), key: '<?php echo wp_create_nonce( 'movie_link_safety' ); ?>' }, 
					dataType: 'html'
				})
				.done(function(response) {	
					change_movie(response.trim())
					console.log(response.trim());
				})
				.fail(function() {
					console.log('Movie Link Request Failed');					
				})
				.always(function() {
					
				});
			});


			function change_movie(url)
			{
				instances[0].source({
					type:       'video',
					title:      'Example title',
					sources: [{
						src:    url,
						type:   'video/mp4'
					}]});
				instances[0].play();
			}


})();
</script>
<?php get_footer(); ?>