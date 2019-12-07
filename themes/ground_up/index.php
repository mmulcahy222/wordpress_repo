<?php get_header(); ?>
<!-- START BODY -->

<!-- LEFT BIG COLUMN -->
<div class="col-xs-12 col-md-9 col-lg-9 col-xl-9">
	<?php 
	#loop
	if(have_posts())
	{
		while(have_posts())
		{
			the_post();
			?>
			<div class="post">
				<div class="post_title">
					<a href="<?php the_permalink(); ?>" ><?php echo strtoupper(get_the_title()); ?></a>
				</div>
				<div class="post_date_who" style="border-radius: 0px">
					<?php echo strtoupper(get_the_time('F j, Y')); ?> BY <?php echo strtoupper(the_author_posts_link()); ?>
				</div>
				<div class="post_content">
					<?php the_content(); ?>
				</div>
			</div><!-- END entry -->
			<?php
		}	
	}
	?>
	<!-- PAGINATION -->
	<nav class="text-center">
		<ul class="pagination">
			<li>
				<?php previous_posts_link(); ?>
			</li>
			<li>
				<?php next_posts_link(); ?>
			</li>
		</ul><!-- .pagination -->
	</nav><!-- .text-center -->
</div><!-- END left_content -->
<!-- END LEFT BIG COLUMN -->




<!-- SIDEBAR -->
<div class="col-xs-12 col-md-3 col-lg-3 col-xl-3 sidebar">
	<?php if ( is_active_sidebar( 'pwn_sidebar_1' ) ) : ?>
		<div class="sidebar_section">
			<?php dynamic_sidebar( 'pwn_sidebar_1' ); ?>
		</div>
	<?php endif; ?>
</div><!-- END right_sidebar -->
<!-- END SIDEBAR -->




<!-- END BODY -->
<?php get_footer(); ?>
