<?php include('header.php'); ?>

<div id="wrapper_content">
	
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	
	<div id="wrapper">
    
        <div class="sidebar_left">
			<? include ('sidebar_left.php'); ?>
		</div>
	
		<div id="main">
        
        	<div id="crumbs-wrapper">
			
				<?php if (function_exists('dimox_breadcrumbs')) dimox_breadcrumbs(); ?>
                    
            </div>
            
            <div id="title-wrapper">
            
                <div id="title">
            
                    <div class="title-text">
                        <h1><?php the_title(); ?></h1>
                    </div>
                    
                </div>
            
            </div>

			<div id="post">
				
				<div class="post-content">
				
					<?php the_content(); ?>
					
				</div>
		
			</div>

			<?php endwhile; endif; ?>
		
		</div><!-- END MAIN -->

<?php include('sidebar.php'); ?>
		
<?php include('footer.php'); ?>