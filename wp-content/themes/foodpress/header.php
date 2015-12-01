<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<?php
     if (!defined('_SAPE_USER')){
        define('_SAPE_USER', '364ab648cdc156452e2375acd0e4a98d');
     }
     require_once(realpath($_SERVER['DOCUMENT_ROOT'].'/'._SAPE_USER.'/sape.php'));
     $sape = new SAPE_client();
	 $sape_article = new SAPE_articles();
?>
<?php include_once("analyticstracking.php") ?>
<meta name="google-site-verification" content="s1uaRLgj0G0wy5Jso5JouEK4Aaa52PvgurHiLHuNTpg" />
<meta name="msvalidate.01" content="2AA2B1AF3A5631D3FECFC9191D7A18E4" />
<meta name='wmail-verification' content='cb2e91c6a13eaf0e' />
<meta name='yandex-verification' content='437a53b599859a21' />

<meta http-equiv="content-type" content="text/html; charset=utf-8" />
 
<title><?php wp_title(' | ', true, 'right'); ?> <?php bloginfo('name'); ?></title>

<?php if (is_single() || is_page()) { if ( have_posts() ) { while ( have_posts() ) { the_post(); ?>
<meta name="description" content="<?php the_excerpt_rss();?>" />
<meta name="keywords" content="<?php meta_post_keywords(); ?>" />
<?php } } } elseif (is_home() || is_category()) {?>
<meta name="description" content="<?php bloginfo('description'); ?>" />
<meta name="keywords" content="kitchen, cuisine, recipe, delicious, delightful, breakfast, brunch, dessert, cake, cookie, mousse, parfait, beverage, cocktail, smoothie, main dish, side dish, appetizer, beef, chicken, veal, duck, turkey, rabbit, pork, fish & seafood, pasta, vegetarian, soup, salad, vegan, holiday recipes" />
<?php }; ?>

<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" />
<link rel="icon" href="<?php echo home_url('/') . 'favicon.ico'; ?>" type="image/x-icon" />
<link rel="shortcut icon" href="<?php echo home_url('/') . 'favicon.ico'; ?>" type="image/x-icon" />

<?php if ($tz_feedburner) { ?>
<link rel="alternate" type="application/rss+xml" title="<?php bloginfo( 'name' ); ?> RSS Feed" href="http://feeds.feedburner.com/<?php echo ($fp_feedburner); ?>" />
<?php } else { ?>
<link rel="alternate" type="application/rss+xml" title="<?php bloginfo( 'name' ); ?> RSS Feed" href="<?php bloginfo( 'rss2_url' ); ?>" />
<?php } ?>

<?php wp_enqueue_script('jquery'); ?>
<?php wp_enqueue_script('FoodPress', get_bloginfo('template_directory'). '/js/scripts.js'); ?>
<?php wp_enqueue_script('nivo', get_bloginfo('template_directory'). '/js/jquery.nivo.slider.pack.js'); ?>

<meta property="fb:admins" content="816972429" />

<?php wp_head(); ?>

<script type="text/javascript">
jQuery(document).ready(function($) {
    jQuery('#slider').nivoSlider({
        effect:'<?php echo get_option('fp_slider_effect'); ?>', // Specify sets like: 'fold,fade,sliceDown'
        pauseTime:<?php echo get_option('fp_slider_time'); ?>, // How long each slide will show
		captionOpacity:false, // Universal caption opacity
        directionNav:false, // Next & Prev navigation
        directionNavHide:false, // Only show on hover
        controlNavThumbs:true, // Use thumbnails for Control Nav
        controlNavThumbsFromRel:true, // Use image rel for thumbs
    });
});
</script>

</head>

<body <?php body_class($class); ?>>
	<div id="top-header-wrapper">
		<div id="top-header">
        	<div id="top-navigation">
				<ul>
					<?php wp_nav_menu( array( 'container' => false, 'theme_location' => 'top-menu' ) ); ?>
				</ul>
			</div>
			<div id="header-social">
            
				<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_GB/all.js#xfbml=1&appId=331333976986902";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
				<div class="fb-like" data-href="http://www.facebook.com/yummyfunnycom" data-width="100" data-layout="button_count" data-show-faces="false" data-send="false"></div>
                
				<div class="g-follow" data-annotation="bubble" data-height="20" data-href="//plus.google.com/104486934803745753764" data-rel="publisher"></div>
<script type="text/javascript">
  (function() {
    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
    po.src = 'https://apis.google.com/js/plusone.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
  })();
</script>

				<a href="https://twitter.com/YummyFunnyCom" class="twitter-follow-button" data-show-count="false" data-show-screen-name="false">Follow @YummyFunnyCom</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>

			</div>
		</div>
	</div>
	<div id="header-wrapper">
		<div id="header">
			<div id="header-banner">
				<script id="mNCC" language="javascript">  medianet_width='728';  medianet_height= '90';  medianet_crid='122213423';  </script>  <script id="mNSC" src="http://contextual.media.net/nmedianet.js?cid=8CU5K3HI8" language="javascript"></script> 
            </div>
			<div id="header-search">  
				<script>
                  (function() {
                    var cx = '018362116486815312437:WMX-841111802';
                    var gcse = document.createElement('script'); gcse.type = 'text/javascript'; gcse.async = true;
                    gcse.src = (document.location.protocol == 'https:' ? 'https:' : 'http:') +
                        '//www.google.com/cse/cse.js?cx=' + cx;
                    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(gcse, s);
                  })();
                </script>
                
                <gcse:searchbox-only></gcse:searchbox-only>
            </div>
		</div>
	</div>
	<div id="navigation-wrapper">
		<div id="navigation">
			<ul>
				<?php wp_nav_menu( array( 'container' => false, 'theme_location' => 'primary-menu' ) ); ?>
			</ul>
		</div>
	</div>