<div class="widget">
	<a href="<?php echo home_url(); ?>"><img src="<?php bloginfo('template_url'); ?>/logo.png" width="160" height="160" alt="<?php bloginfo( 'name' ); ?>" /></a>
</div>
<div class="widget">
	<h3>Count of recipes</h3>
	<div style="background-color:#f8560e; color:#fff; text-align:center; line-height: 60px; font-size:40px; text-shadow:1px 1px 0 #666;">
		<?php $posts_count = wp_count_posts()->publish; echo $posts_count; ?>
	</div>
</div>
<div class="widget">
	<script id="mNCC" language="javascript">  medianet_width='160';  medianet_height= '600';  medianet_crid='163181479';  </script>  <script id="mNSC" src="http://contextual.media.net/nmedianet.js?cid=8CU5K3HI8" language="javascript"></script> 
</div>
<div class="widget">
	<ul class="left_nav">
		<? wp_list_categories('exclude=1&title_li='); ?>
	</ul>
</div>
<div class="widget">
	<h3>TOP RECIPES</h3>
	<ul class="popular_posts">        
	<?php $pps = new WP_Query( array( 'posts_per_page' => 5, 'meta_key' => 'wpb_post_views_count', 'orderby' => 'meta_value_num', 'order' => 'DESC'  ) );
	$k=0;
	wp_reset_query();
	while ( $pps->have_posts() ) : $pps->the_post();
		$k++; ?>
		<li <?php if ($k == 5) echo 'style="border:none; padding:0; margin:0"'; ?>>				
				<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>">
					<?php if((function_exists('has_post_thumbnail')) && (has_post_thumbnail())) {
						the_post_thumbnail('thumbnail', array('class' => 'post-thumb'));
					} ?>
				</a>				
				<h2><a href="<?php the_permalink(); ?>" rel="bookmark" title="Permanent Link: <?php the_title(); ?>"><?php the_title(); ?></a></h2>
		</li>
	<?php endwhile; wp_reset_query();?>
	</ul>
</div>
<div class="widget">
	<iframe data-aa='63456' src='//ad.a-ads.com/63456?size=160x90' scrolling='no' style='width:160px; height:90px; border:0px; padding:0;overflow:hidden' allowtransparency='true'></iframe>
</div>