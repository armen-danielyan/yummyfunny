<?php include('header.php'); ?>
<div id="wrapper_content">	
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>    
    <div id="wrapper">
    	<div class="sidebar_left">
			<?php include ('sidebar_left.php'); ?>
		</div>
		<div itemscope itemtype="http://schema.org/Recipe" id="main">        
            <div id="crumbs-wrapper">			
				<?php if (function_exists('dimox_breadcrumbs')) dimox_breadcrumbs(); ?>			
			</div>    
			<div id="title-wrapper">	
				<div id="title">	
					<div class="title-text">
						<h1><?php the_title(); ?></h1>
						<meta itemprop="recipeCategory" content="<?php $category = get_the_category(); echo $category[0]->cat_name; ?>">
					</div>
				</div>        
			</div>		
			<div id="post">		
				<?php if ((function_exists('has_post_thumbnail')) && (has_post_thumbnail())) {
					the_post_thumbnail('post-thumb', array('class' => 'post-thumb', 'itemprop' => 'image'));
				} ?>
                
                <div class="post-meta">
                	<div class="cat"><?php the_category(', '); ?></div>
                    <div class="sep"></div>
				<?php if(get_post_meta($post->ID, "foodpress_servings", true) || get_post_meta($post->ID, "foodpress_cooking_time", true)) { ?>
					<div id="recipe-info">
				<?php if(get_post_meta($post->ID, "foodpress_servings", true)) { ?>
				<span class="persons" itemprop="recipeYield"><?php echo get_post_meta($post->ID, "foodpress_servings", true); ?></span>
				<?php } ?>
				<?php if(get_post_meta($post->ID, "foodpress_cooking_time", true)) { ?>
				<span class="time">~ <?php echo get_post_meta($post->ID, "foodpress_cooking_time", true); ?></span>
				<?php } ?>
                	</div>
                    <div class="sep"></div>
				<?php } ?>                	
                    <div class="views">
                    	<?php wpb_set_post_views(get_the_ID()); echo wpb_get_post_views(get_the_ID()) . " Views"; ?>
                    </div>
                    
                    <div class="sep"></div>
            
					<div class="rating">
						<?php if(function_exists('the_ratings')) { the_ratings(); } ?>
                	</div>
                
                </div>
                
				<div class="post-content">
				
					<?php if(get_post_meta($post->ID, "foodpress_ingredients", true)) { ?>
					<div class="note-wrapper">					
						<div class="note-top"></div>						
						<div class="note-content">						
							<ul>
								<?php $get_ingredients = get_post_meta($post->ID, "foodpress_ingredients", true);
								$ingredients = explode("\n", $get_ingredients);
								foreach($ingredients as $ingredient) {									
									echo '<li itemprop="ingredients">' . $ingredient . '</li>';
								} ?>
							</ul>						
						</div>						
						<div class="note-bottom"></div>					
					</div>
					<?php } ?>
					
					<?php the_content(); ?>
                    
					<?php wp_link_pages('before=<span class="page-links"><strong>Pages:</strong> &after=</span>'); ?>
					
				</div>
                                		
			</div>

			<?php if(get_option('fp_related_posts') == "false" || get_option('fp_related_posts') == "") { ?>
			<?php $tags = get_the_tags(); ?>
			<?php if($tags): ?>
			<?php $related = get_related_posts($post->ID, $tags); ?>
			<?php if($related->have_posts()) : ?>
			<div class="post-block">
			
				<h3>Recipes You May Also Like</h3>
				
				<?php wp_reset_query();
				while($related->have_posts()): $related->the_post();
                $relatedurl = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), '' );
				$relatedimg = $relatedurl[0]; ?>
				<div class="post-item-grid">				
					<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>">
						<?php if ((function_exists('has_post_thumbnail')) && (has_post_thumbnail())) { 
							echo get_the_post_thumbnail($related->ID, 'small-thumb', array('class' => 'post-thumb')); 
						} ?>
					</a>					
					<h2><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
				</div>
				<?php endwhile; wp_reset_query(); ?>
			
			</div>
			<?php endif; ?>
			<?php endif; ?>
			<?php wp_reset_query(); ?>
			<?php } ?>
			
			<div class="post-block">
				
				<?php comments_template(); ?>
			
			</div>
			
			<?php endwhile; endif; ?>
		
		</div><!-- END MAIN -->

<?php include('sidebar.php'); ?>

<?php include('footer.php'); ?>