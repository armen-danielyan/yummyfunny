	
	</div><!-- END WRAPPER -->
    
</div> <!-- end wrapper_content -->
	
	<div id="footer-wrapper">
	
		<div id="footer">
		
			<?php	/* Widgetised Area */	if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('Footer 1') ) ?>
			
			<?php	/* Widgetised Area */	if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('Footer 2') ) ?>
			
			<?php	/* Widgetised Area */	if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('Footer 3') ) ?>
			
			<?php	/* Widgetised Area */	if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('Footer 4') ) ?>
		
		</div>
	
	</div><!-- END FOOTER-WRAPPER -->
    
	<div id="footer-nav-wrapper">
    	<div id="footer-nav">
    		<ul>
    			<?php wp_list_categories('orderby=name&depth=1&exclude=1&title_li='); ?>
			</ul>
    	</div>
	</div>
	
	<div id="footer-bottom-wrapper">	
		<div id="footer-bottom">		
			<span class="footer-left">Copyright &copy; <?php echo date('Y'); ?> - <?php bloginfo('name'); ?>. All rights reserved</span>
			<span class="footer-right"></span> 
		</div>
	</div>
	
	<?php wp_footer(); ?>
	
<!--</div>-->
</body>
</html>