<?php include('header.php'); ?>
<div id="wrapper_content">
	<div id="wrapper">    
		<div class="sidebar_left">
 	       <?php include ('sidebar_left.php'); ?>
		</div>    
		<div id="main">
			<?php if(get_option('fp_slider_tags')) { 			
				$featured_posts = new WP_Query(array(
					'showposts' => 4,
					'tag' => get_option('fp_slider_tags')
				));			
			?>
			<div id="featured-wrapper">			
				<div id="slider" class="featured-item">
					<?php while($featured_posts->have_posts()): $featured_posts->the_post(); ?>
					
					<?php $image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'slider-image'); ?>
					<?php $image_thumb = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'slider-thumb'); ?>
					
					<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>"><img src="<?php echo $image[0]; ?>" alt="<?php the_title(); ?>" title="#htmlcaption_<?php the_ID(); ?>" rel="<?php echo $image_thumb[0]; ?>" width="620" height="300" /></a>
					
					<?php endwhile; ?>
				</div>
				
				<?php while($featured_posts->have_posts()): $featured_posts->the_post(); ?>
				<div class="nivo-html-caption" id="htmlcaption_<?php the_ID(); ?>">
					<div class="featured-text">
						<span> <?php the_category(', ') ?></span>
						<h2><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
					</div>
				</div>
				<?php endwhile; ?>
			
			</div><!-- END FEATURED-WRAPPER -->
			<?php } ?>
            
            <div class="catalogue">
            	<?php include('catalogue.php'); ?>
            </div>
		
		</div><!-- END MAIN -->
        
<?php include('sidebar.php'); ?>
		
<?php include('footer.php'); ?>