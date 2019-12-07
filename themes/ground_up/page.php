<?php get_header(); ?>
<!-- START BODY -->
<div class="pane">
	<div class="pane_inner">
	<?php 
	#loop
	if(have_posts())
	{
		while(have_posts())
		{
			the_post();
			the_content();
		}	
	}
	?>
	</div><!-- END pane_inner -->
</div><!-- END pane -->
<?php get_footer(); ?>