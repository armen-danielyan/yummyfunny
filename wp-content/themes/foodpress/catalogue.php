<?php wp_reset_query();
$cats = get_categories('exclude=1, 6, 10, 12, 13, 17, 18, 21, 20, 22, 23, 24, 25, 26');
foreach ($cats as $cat) : ?>
<div class="category-posts">
<?php $args = array(
	'orderby' =>'rand',
	'posts_per_page' => 4,
	'cat' => $cat -> term_id,
);
$j = 0;
query_posts($args);
if (have_posts()) : 
	$cat_name = $cat->name;
	$cat_id = get_cat_id($cat_name);
	$cat_url = get_category_link($cat_id); ?>
	<h3><a href=<?php echo $cat_url; ?> title="<?php echo $cat_name; ?>"><?php echo $cat_name; ?></a></h3>
	<div class="sep"></div>
	<?php while (have_posts()) : the_post();
		$j++; 
		if ($j==1) { echo '<div class="category-list-first">'; ?>
			<h2><a href="<?php echo get_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
        	<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>">
				<?php if ((function_exists('has_post_thumbnail')) && (has_post_thumbnail())) { 
					echo the_post_thumbnail('cat-big-thumb'); 
				} ?>
			</a>
        	<span><?php if(function_exists('the_ratings')) { the_ratings(); } ?></span>
        	<?php the_excerpt(); ?>
	</div>
    <div class="category-list-items">
<?php } else { ?>
		<div class="category-list-item">
			<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>">
				<?php if ((function_exists('has_post_thumbnail')) && (has_post_thumbnail())) { 
					echo the_post_thumbnail('cat-small-thumb'); 
				} ?>
			</a>
			<h2><a href="<?php echo get_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
		</div>
<?php } ?>
<?php endwhile; ?>
	</div>
<?php else :
echo '<h2>No Posts for '.$cat->name.' Category</h2>';
endif; wp_reset_query; ?>
</div>
<?php endforeach; ?>