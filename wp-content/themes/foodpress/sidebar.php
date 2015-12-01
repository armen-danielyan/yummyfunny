		<div id="sidebar">
        <?php if (is_single()) : ?>
        	<div class="widget">
				<div class="adjacent">
        			<div class="prev-post">
	        			<?php $prev_post = get_previous_post();
						if (!empty( $prev_post )) : ?>
							<h2><a href="<?php echo get_permalink( $prev_post->ID ); ?>"><?php echo "&larr; Prev"; ?></a></h2>
							<a href="<?php echo get_permalink( $prev_post->ID ) ?>" rel="bookmark" title="<?php echo $prev_post->post_title; ?>">
								<?php if ((function_exists('has_post_thumbnail')) && (has_post_thumbnail())) {
									echo get_the_post_thumbnail($prev_post->ID, 'small-thumb', array('class' => 'post-thumb'));
								} ?>
							</a>
							<h2><a href="<?php echo get_permalink($prev_post->ID); ?>"><?php echo $prev_post->post_title; ?></a></h2>
						<?php endif; ?>
					</div>
            		<div class="next-post">
            			<?php $next_post = get_next_post();
						if (!empty( $next_post )) : ?>
							<h2><a href="<?php echo get_permalink( $next_post->ID ); ?>"><?php echo "Next &rarr;"; ?></a></h2>                					
                    		<a href="<?php echo get_permalink( $next_post->ID ); ?>" rel="bookmark" title="<?php echo $next_post->post_title; ?>">
								<?php if ((function_exists('has_post_thumbnail')) && (has_post_thumbnail())) { 
									echo get_the_post_thumbnail($next_post->ID, 'small-thumb', array('class' => 'post-thumb'));
								} ?>
							</a>
							<h2><a href="<?php echo get_permalink( $next_post->ID ); ?>"><?php echo $next_post->post_title; ?></a></h2>
						<?php endif; ?>
					</div>
        		</div>
			</div>            
		<?php endif; ?>            
		<?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('Main Sidebar')): 
			endif;
		?>
            
		<?php wp_reset_query();
		if (is_single() || is_home()) {
			$s = $sape->return_links(15); $s = mb_convert_encoding($s, "utf-8", "Windows-1251"); 
			if (strstr($s, "href")) {
				echo '<div class="widget">' . $s . '</div>';
			}; 
		}; ?>

            <div class="widget">
            	<h3>RANDOM RECIPE</h3>
				<?php wp_reset_query();
				$rp = new WP_Query(array('posts_per_page'=>1, 'orderby' =>'rand')); 
				while ($rp->have_posts()) :	$rp->the_post(); ?>
					<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>">
						<?php if ((function_exists('has_post_thumbnail')) && (has_post_thumbnail())) {
							echo get_the_post_thumbnail($rp->ID, 'post-thumb', array('class' => 'post-thumb'));
						} ?>
					</a>
					<h2 style="text-align:center; font-size:16px; font-weight:bold;"><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
				<?php endwhile; wp_reset_query(); ?>
            </div>            		
		</div><!-- END SIDEBAR -->