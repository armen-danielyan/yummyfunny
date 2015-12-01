<?php get_header(); ?>

<div id="wrapper_content">

	<div id="wrapper">    
    
        <div class="sidebar_left">
 	       <?php include ('sidebar_left.php'); ?>
		</div>

		<div id="main">
        
            <div id="crumbs-wrapper">
			
				<?php if (function_exists('dimox_breadcrumbs')) dimox_breadcrumbs(); ?>
			
			</div>

			<div id="title-wrapper">
	
				<div id="title">
	
					<div class="title-text">
						<?php if (have_posts()) : ?>
	
						<?php /* Get author data */
						if(get_query_var('author_name')) :
						$curauth = get_userdatabylogin(get_query_var('author_name'));
						else :
						$curauth = get_userdata(get_query_var('author'));
						endif;
						?>
						<?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>
						<?php /* If this is a category archive */ if (is_category()) { ?>
                        <h1>Category: &nbsp;<?php single_cat_title(); ?></h1>
                        <?php /* If this is a tag archive */ } elseif( is_tag() ) { ?>
                        <h1>Tagged: &nbsp;<?php single_tag_title(); ?></h1>
                        <?php /* If this is a daily archive */ } elseif (is_day()) { ?>
                        <h1>Archive: &nbsp;<?php the_time('F jS, Y'); ?></h1>
                        <?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
                        <h1>Archive: &nbsp;<?php the_time('F, Y'); ?></h1>
                        <?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
                        <h1>Archive: &nbsp;<?php the_time('Y'); ?></h1>
                        <?php /* If this is an author archive */ } elseif (is_author()) { ?>
                        <h1>All Posts By: <?php echo $curauth->display_name; ?></h1>
                        
                        <?php } ?>
					</div>
			
				</div>
	
			</div>
	
			<div class="catalogue">
		
				<?php while (have_posts()) : the_post(); ?>
			
				<div class="category-posts">
                	<div class="category-list-first">                		
						<h2><a href="<?php echo get_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
        				<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>">
							<?php if ((function_exists('has_post_thumbnail')) && (has_post_thumbnail())) { 
								echo the_post_thumbnail('cat-big-thumb'); 
							} ?>
						</a>
        				<span><?php if(function_exists('the_ratings')) { the_ratings(); } ?></span>						
                    </div>
					
					<div class="category-list-items">
						<span><?php the_category(', ') ?></span>
                        <?php the_excerpt(); ?>					
					</div>
				</div>
			
				<?php endwhile; ?>
			
			</div>
		
		<?php kriesi_pagination(); ?>
	
		<?php endif; ?>

		</div>
		<!-- END MAIN -->
		
<?php get_sidebar(); ?>

<?php get_footer(); ?>