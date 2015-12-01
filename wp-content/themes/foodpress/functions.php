<?php

//////////////////////////////////////////////////////////////////
// Register WordPress 3 menus
//////////////////////////////////////////////////////////////////
add_action( 'init', 'register_my_menus' );

function register_my_menus() {
	register_nav_menus(
		array(
			'primary-menu' => __( 'Primary Menu' ),
			'top-menu' => __( 'Top Menu' ),
		)
	);
}

//////////////////////////////////////////////////////////////////
// Register sidebar and footer widgets
//////////////////////////////////////////////////////////////////
if ( function_exists('register_sidebar') ) {
	register_sidebar(array(
		'name' => 'Main Sidebar',
		'before_widget' => '<div class="widget">',
		'after_widget' => '</div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
	));
	register_sidebar(array(
		'name' => 'Footer 1',
		'before_widget' => '<div class="widget">',
		'after_widget' => '</div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
	));
	register_sidebar(array(
		'name' => 'Footer 2',
		'before_widget' => '<div class="widget">',
		'after_widget' => '</div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
	));
	register_sidebar(array(
		'name' => 'Footer 3',
		'before_widget' => '<div class="widget">',
		'after_widget' => '</div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
	));
	register_sidebar(array(
		'name' => 'Footer 4',
		'before_widget' => '<div class="widget last">',
		'after_widget' => '</div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
	));
}

//////////////////////////////////////////////////////////////////
// Options Framework Functions
//////////////////////////////////////////////////////////////////

/* Set the file path based on whether the Options Framework is in a parent theme or child theme */

if ( STYLESHEETPATH == TEMPLATEPATH ) {
	define('OF_FILEPATH', TEMPLATEPATH);
	define('OF_DIRECTORY', get_bloginfo('template_directory'));
} else {
	define('OF_FILEPATH', STYLESHEETPATH);
	define('OF_DIRECTORY', get_bloginfo('stylesheet_directory'));
}

/* These files build out the options interface.  Likely won't need to edit these. */

require_once (OF_FILEPATH . '/admin/admin-functions.php');		// Custom functions and plugins
require_once (OF_FILEPATH . '/admin/admin-interface.php');		// Admin Interfaces (options,framework, seo)

/* These files build out the theme specific options and associated functions. */

require_once (OF_FILEPATH . '/admin/theme-options.php'); 		// Options panel settings and custom settings
require_once (OF_FILEPATH . '/admin/theme-functions.php'); 	// Theme actions based on options settings

//////////////////////////////////////////////////////////////////
// Include function files
//////////////////////////////////////////////////////////////////
include("admin/widgets/widget-about-the-cook.php");
include("admin/widgets/widget-tabs.php");
include("admin/widgets/widget-recent-posts.php");
include("admin/widgets/widget-flickr.php");
include("admin/widgets/widget-twitter.php");
include("admin/widgets/widget-facebook.php");
include("admin/pagination.php");

//////////////////////////////////////////////////////////////////
// Post thumbnails
//////////////////////////////////////////////////////////////////
if ( function_exists( 'add_theme_support' ) ) {
	add_theme_support('post-thumbnails');
	add_image_size( 'small-thumb', 104, 78, true );
	add_image_size( 'post-thumb', 280, 210, true );
	add_image_size( 'cat-big-thumb', 300, 80, true );
	add_image_size( 'cat-small-thumb', 40, 40, true );
	add_image_size( 'slider-thumb', 133, 80, true );
	add_image_size( 'slider-image', 620, 300, true );
}

//////////////////////////////////////////////////////////////////
// Register custom meta box
//////////////////////////////////////////////////////////////////
$prefix = 'foodpress_';

$meta_box = array(
    'id' => 'meta-box',
    'title' => 'Recipe Info',
    'page' => 'post',
    'context' => 'normal',
    'priority' => 'high',
    'fields' => array(
		array(
            'name' => 'Number of servings',
            'desc' => 'Enter the number of servings (eg. "4")',
            'id' => $prefix . 'servings',
            'type' => 'text',
            'std' => ''
        ),
        array(
            'name' => 'Cooking time',
            'desc' => 'Enter the cooking time (eg. "45 minutes")',
            'id' => $prefix . 'cooking_time',
            'type' => 'text',
            'std' => ''
        ),
		array(
            'name' => 'Ingredients',
            'desc' => 'Enter all the ingredients (eg. "8 ounces dried soba noodles"). <strong>IMPORTANT:</strong> Seperate the ingredients with a single line break',
            'id' => $prefix . 'ingredients',
            'type' => 'textarea',
            'std' => ''
        )
    )
);

add_action('admin_menu', 'mytheme_add_box');

// Add meta box
function mytheme_add_box() {
	global $meta_box;
	
	add_meta_box($meta_box['id'], $meta_box['title'], 'mytheme_show_box', $meta_box['page'], $meta_box['context'], $meta_box['priority']);
}

// Callback function to show fields in meta box
function mytheme_show_box() {
	global $meta_box, $post;
	
	// Use nonce for verification
	echo '<input type="hidden" name="mytheme_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';
	
	echo '<table class="form-table">';

	foreach ($meta_box['fields'] as $field) {
		// get current post meta data
		$meta = get_post_meta($post->ID, $field['id'], true);
		
		echo '<tr>',
				'<th style="width:20%"><label for="', $field['id'], '"><strong>', $field['name'], ':</strong></label></th>',
				'<td>';
		switch ($field['type']) {
			case 'text':
				echo '<input type="text" name="', $field['id'], '" id="', $field['id'], '" value="', $meta ? $meta : $field['std'], '" size="30" style="width:97%" />',
					'<br /><small>', $field['desc'],'</small>';
				break;
			case 'textarea':
				echo '<textarea name="', $field['id'], '" id="', $field['id'], '" cols="60" rows="4" style="width:97%">', $meta ? $meta : $field['std'], '</textarea>',
					'<br />', $field['desc'];
				break;
			case 'select':
				echo '<select name="', $field['id'], '" id="', $field['id'], '">';
				foreach ($field['options'] as $option) {
					echo '<option', $meta == $option ? ' selected="selected"' : '', '>', $option, '</option>';
				}
				echo '</select>';
				break;
			case 'radio':
				foreach ($field['options'] as $option) {
					echo '<input type="radio" name="', $field['id'], '" value="', $option['value'], '"', $meta == $option['value'] ? ' checked="checked"' : '', ' />', $option['name'];
				}
				break;
			case 'checkbox':
				echo '<input type="checkbox" name="', $field['id'], '" id="', $field['id'], '"', $meta ? ' checked="checked"' : '', ' />';
				break;
		}
		echo 	'<td>',
			'</tr>';
	}
	
	echo '</table>';
}

add_action('save_post', 'mytheme_save_data');

// Save data from meta box
function mytheme_save_data($post_id) {
	global $meta_box;
	
	// verify nonce
	if (!wp_verify_nonce($_POST['mytheme_meta_box_nonce'], basename(__FILE__))) {
		return $post_id;
	}

	// check autosave
	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
		return $post_id;
	}

	// check permissions
	if ('page' == $_POST['post_type']) {
		if (!current_user_can('edit_page', $post_id)) {
			return $post_id;
		}
	} elseif (!current_user_can('edit_post', $post_id)) {
		return $post_id;
	}
	
	foreach ($meta_box['fields'] as $field) {
		$old = get_post_meta($post_id, $field['id'], true);
		$new = $_POST[$field['id']];
		
		if ($new && $new != $old) {
			update_post_meta($post_id, $field['id'], $new);
		} elseif ('' == $new && $old) {
			delete_post_meta($post_id, $field['id'], $old);
		}
	}
}

//////////////////////////////////////////////////////////
// Related Posts
//////////////////////////////////////////////////////////
function get_related_posts($post_id, $tags = array()) {
	$query = new WP_Query();
	
	$post_types = get_post_types();
	unset($post_types['page'], $post_types['attachment'], $post_types['revision'], $post_types['nav_menu_item']);
	
	if($tags) {
		foreach($tags as $tag) {
			$tagsA[] = $tag->term_id;
		}
	}
	
	$args = wp_parse_args($args, array(
		'showposts' => 5,
		'post_type' => $post_types,
		'post__not_in' => array($post_id),
		'tag__in' => $tagsA,
		'ignore_sticky_posts' => 1,
	));
	
	$query = new WP_Query($args);
	
  	return $query;
}

//////////////////////////////////////////////////////////////////
// How comments are displayed
//////////////////////////////////////////////////////////////////
function leetpress_comment($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment; ?>
	<li <?php comment_class(); ?> id="comment-<?php comment_ID() ?>">
	
		<div class="the-comment">
		
			<?php echo get_avatar($comment,$size='60'); ?>
			
			<div class="comment-arrow"></div>
			
			<div class="comment-box">
			
				<div class="comment-author">
					<strong><?php echo get_comment_author_link() ?></strong>
					<small><?php printf(__('%1$s at %2$s'), get_comment_date(),  get_comment_time()) ?></a><?php edit_comment_link(__('Edit'),'  ','') ?> - <?php comment_reply_link(array_merge( $args, array('reply_text' => 'Reply', 'add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth']))) ?></small>
				</div>
			
				<div class="comment-text">
					<?php if ($comment->comment_approved == '0') : ?>
					<em><?php _e('Your comment is awaiting moderation.') ?></em>
					<br />
					<?php endif; ?>
					<?php comment_text() ?>
				</div>
			
			</div>
			
		</div>

<?php }


//////////////////////////////////////////////////////////////////
// Breadcrumb
//////////////////////////////////////////////////////////////////
function dimox_breadcrumbs() {

	/* === OPTIONS === */
	$text['home']     = 'Home'; // text for the 'Home' link
	$text['category'] = 'Archive by Category "%s"'; // text for a category page
	$text['search']   = 'Search Results for "%s" Query'; // text for a search results page
	$text['tag']      = 'Posts Tagged "%s"'; // text for a tag page
	$text['author']   = 'Articles Posted by %s'; // text for an author page
	$text['404']      = 'Error 404'; // text for the 404 page

	$show_current   = 1; // 1 - show current post/page/category title in breadcrumbs, 0 - don't show
	$show_on_home   = 0; // 1 - show breadcrumbs on the homepage, 0 - don't show
	$show_home_link = 1; // 1 - show the 'Home' link, 0 - don't show
	$show_title     = 1; // 1 - show the title for the links, 0 - don't show
	$delimiter      = ' &raquo; '; // delimiter between crumbs
	$before         = '<span class="current">'; // tag before the current crumb
	$after          = '</span>'; // tag after the current crumb
	/* === END OF OPTIONS === */

	global $post;
	$home_link    = home_url('/');
	$link_before  = '<span typeof="v:Breadcrumb">';
	$link_after   = '</span>';
	$link_attr    = ' rel="v:url" property="v:title"';
	$link         = $link_before . '<a' . $link_attr . ' href="%1$s">%2$s</a>' . $link_after;
	$parent_id    = $parent_id_2 = $post->post_parent;
	$frontpage_id = get_option('page_on_front');

	if (is_home() || is_front_page()) {

		if ($show_on_home == 1) echo '<div class="breadcrumbs"><a href="' . $home_link . '">' . $text['home'] . '</a></div>';

	} else {

		echo '<div class="breadcrumbs" xmlns:v="http://rdf.data-vocabulary.org/#">';
		if ($show_home_link == 1) {
			echo sprintf($link, $home_link, $text['home']);
			if ($frontpage_id == 0 || $parent_id != $frontpage_id) echo $delimiter;
		}

		if ( is_category() ) {
			$this_cat = get_category(get_query_var('cat'), false);
			if ($this_cat->parent != 0) {
				$cats = get_category_parents($this_cat->parent, TRUE, $delimiter);
				if ($show_current == 0) $cats = preg_replace("#^(.+)$delimiter$#", "$1", $cats);
				$cats = str_replace('<a', $link_before . '<a' . $link_attr, $cats);
				$cats = str_replace('</a>', '</a>' . $link_after, $cats);
				if ($show_title == 0) $cats = preg_replace('/ title="(.*?)"/', '', $cats);
				echo $cats;
			}
			if ($show_current == 1) echo $before . sprintf($text['category'], single_cat_title('', false)) . $after;

		} elseif ( is_search() ) {
			echo $before . sprintf($text['search'], get_search_query()) . $after;

		} elseif ( is_day() ) {
			echo sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y')) . $delimiter;
			echo sprintf($link, get_month_link(get_the_time('Y'),get_the_time('m')), get_the_time('F')) . $delimiter;
			echo $before . get_the_time('d') . $after;

		} elseif ( is_month() ) {
			echo sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y')) . $delimiter;
			echo $before . get_the_time('F') . $after;

		} elseif ( is_year() ) {
			echo $before . get_the_time('Y') . $after;

		} elseif ( is_single() && !is_attachment() ) {
			if ( get_post_type() != 'post' ) {
				$post_type = get_post_type_object(get_post_type());
				$slug = $post_type->rewrite;
				printf($link, $home_link . '/' . $slug['slug'] . '/', $post_type->labels->singular_name);
				if ($show_current == 1) echo $delimiter . $before . get_the_title() . $after;
			} else {
				$cat = get_the_category(); $cat = $cat[0];
				$cats = get_category_parents($cat, TRUE, $delimiter);
				if ($show_current == 0) $cats = preg_replace("#^(.+)$delimiter$#", "$1", $cats);
				$cats = str_replace('<a', $link_before . '<a' . $link_attr, $cats);
				$cats = str_replace('</a>', '</a>' . $link_after, $cats);
				if ($show_title == 0) $cats = preg_replace('/ title="(.*?)"/', '', $cats);
				echo $cats;
				if ($show_current == 1) echo $before . get_the_title() . $after;
			}

		} elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {
			$post_type = get_post_type_object(get_post_type());
			echo $before . $post_type->labels->singular_name . $after;

		} elseif ( is_attachment() ) {
			$parent = get_post($parent_id);
			$cat = get_the_category($parent->ID); $cat = $cat[0];
			$cats = get_category_parents($cat, TRUE, $delimiter);
			$cats = str_replace('<a', $link_before . '<a' . $link_attr, $cats);
			$cats = str_replace('</a>', '</a>' . $link_after, $cats);
			if ($show_title == 0) $cats = preg_replace('/ title="(.*?)"/', '', $cats);
			echo $cats;
			printf($link, get_permalink($parent), $parent->post_title);
			if ($show_current == 1) echo $delimiter . $before . get_the_title() . $after;

		} elseif ( is_page() && !$parent_id ) {
			if ($show_current == 1) echo $before . get_the_title() . $after;

		} elseif ( is_page() && $parent_id ) {
			if ($parent_id != $frontpage_id) {
				$breadcrumbs = array();
				while ($parent_id) {
					$page = get_page($parent_id);
					if ($parent_id != $frontpage_id) {
						$breadcrumbs[] = sprintf($link, get_permalink($page->ID), get_the_title($page->ID));
					}
					$parent_id = $page->post_parent;
				}
				$breadcrumbs = array_reverse($breadcrumbs);
				for ($i = 0; $i < count($breadcrumbs); $i++) {
					echo $breadcrumbs[$i];
					if ($i != count($breadcrumbs)-1) echo $delimiter;
				}
			}
			if ($show_current == 1) {
				if ($show_home_link == 1 || ($parent_id_2 != 0 && $parent_id_2 != $frontpage_id)) echo $delimiter;
				echo $before . get_the_title() . $after;
			}

		} elseif ( is_tag() ) {
			echo $before . sprintf($text['tag'], single_tag_title('', false)) . $after;

		} elseif ( is_author() ) {
	 		global $author;
			$userdata = get_userdata($author);
			echo $before . sprintf($text['author'], $userdata->display_name) . $after;

		} elseif ( is_404() ) {
			echo $before . $text['404'] . $after;
		}

		if ( get_query_var('paged') ) {
			if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ' (';
			echo __('Page') . ' ' . get_query_var('paged');
			if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ')';
		}

		echo '</div><!-- .breadcrumbs -->';

	}
} // end dimox_breadcrumbs()


//////////////////////////////////////////////////////////////////
// Disable Automatic Formatting on Posts
//////////////////////////////////////////////////////////////////
function my_formatter($content) {
	$new_content = '';
	$pattern_full = '{(\[raw\].*?\[/raw\])}is';
	$pattern_contents = '{\[raw\](.*?)\[/raw\]}is';
	$pieces = preg_split($pattern_full, $content, -1, PREG_SPLIT_DELIM_CAPTURE);

	foreach ($pieces as $piece) {
		if (preg_match($pattern_contents, $piece, $matches)) {
			$new_content .= $matches[1];
		} else {
			$new_content .= wptexturize(wpautop($piece));
		}
	}

	return $new_content;
}

remove_filter('the_content', 'wpautop');
remove_filter('the_content', 'wptexturize');

add_filter('the_content', 'my_formatter', 99);

//////////////////////////////////////////////////////////////////
// Youtube shortcode
//////////////////////////////////////////////////////////////////
add_shortcode('youtube', 'shortcode_youtube');
	function shortcode_youtube($atts) {
		$atts = shortcode_atts(
			array(
				'id' => '',
				'width' => 620,
				'height' => 360
			), $atts);
		
			return '<div class="video-shortcode"><iframe title="YouTube video player" width="' . $atts['width'] . '" height="' . $atts['height'] . '" src="http://www.youtube.com/embed/' . $atts['id'] . '" frameborder="0" allowfullscreen></iframe></div>';
	}
	
//////////////////////////////////////////////////////////////////
// Vimeo shortcode
//////////////////////////////////////////////////////////////////
add_shortcode('vimeo', 'shortcode_vimeo');
	function shortcode_vimeo($atts) {
		$atts = shortcode_atts(
			array(
				'id' => '',
				'width' => 620,
				'height' => 360
			), $atts);
		
			return '<div class="video-shortcode"><iframe src="http://player.vimeo.com/video/' . $atts['id'] . '" width="' . $atts['width'] . '" height="' . $atts['height'] . '" frameborder="0"></iframe></div>';
	}
	
//////////////////////////////////////////////////////////////////
// Button shortcode
//////////////////////////////////////////////////////////////////
add_shortcode('button', 'shortcode_button');
	function shortcode_button($atts, $content = null) {
		$atts = shortcode_atts(
			array(
				'color' => 'black',
				'link' => '#',
			), $atts);
		
			return '[raw]<span class="button ' . $atts['color'] . '"><a href="' . $atts['link'] . '" >' .do_shortcode($content). '</a></span>[/raw]';
	}
	
//////////////////////////////////////////////////////////////////
// Dropcap shortcode
//////////////////////////////////////////////////////////////////
add_shortcode('dropcap', 'shortcode_dropcap');
	function shortcode_dropcap( $atts, $content = null ) {  
		
		return '<span class="dropcap">' .do_shortcode($content). '</span>';  
		
}

//////////////////////////////////////////////////////////////////
// Add buttons to tinyMCE
//////////////////////////////////////////////////////////////////
add_action('init', 'add_button');

function add_button() {  
   if ( current_user_can('edit_posts') &&  current_user_can('edit_pages') )  
   {  
     add_filter('mce_external_plugins', 'add_plugin');  
     add_filter('mce_buttons_3', 'register_button');  
   }  
}  

//////////////////////////////////////////////////////////////////
// Highlight shortcode
//////////////////////////////////////////////////////////////////
add_shortcode('highlight', 'shortcode_highlight');
	function shortcode_highlight($atts, $content = null) {
		$atts = shortcode_atts(
			array(
				'color' => 'yellow',
			), $atts);
			
			if($atts['color'] == 'black') {
				return '<span class="highlight2">' .do_shortcode($content). '</span>';
			} else {
				return '<span class="highlight1">' .do_shortcode($content). '</span>';
			}

	}
	
//////////////////////////////////////////////////////////////////
// Column one_half shortcode
//////////////////////////////////////////////////////////////////
add_shortcode('one_half', 'shortcode_one_half');
	function shortcode_one_half($atts, $content = null) {
		$atts = shortcode_atts(
			array(
				'last' => 'no',
			), $atts);
			
			if($atts['last'] == 'yes') {
				return '<div class="one_half last">' .do_shortcode($content). '</div><div class="clearboth"></div>';
			} else {
				return '<div class="one_half">' .do_shortcode($content). '</div>';
			}

	}
	
//////////////////////////////////////////////////////////////////
// Column one_third shortcode
//////////////////////////////////////////////////////////////////
add_shortcode('one_third', 'shortcode_one_third');
	function shortcode_one_third($atts, $content = null) {
		$atts = shortcode_atts(
			array(
				'last' => 'no',
			), $atts);
			
			if($atts['last'] == 'yes') {
				return '<div class="one_third last">' .do_shortcode($content). '</div><div class="clearboth"></div>';
			} else {
				return '<div class="one_third">' .do_shortcode($content). '</div>';
			}

	}
	
//////////////////////////////////////////////////////////////////
// Column two_third shortcode
//////////////////////////////////////////////////////////////////
add_shortcode('two_third', 'shortcode_two_third');
	function shortcode_two_third($atts, $content = null) {
		$atts = shortcode_atts(
			array(
				'last' => 'no',
			), $atts);
			
			if($atts['last'] == 'yes') {
				return '<div class="two_third last">' .do_shortcode($content). '</div><div class="clearboth"></div>';
			} else {
				return '<div class="two_third">' .do_shortcode($content). '</div>';
			}

	}
	
//////////////////////////////////////////////////////////////////
// Column one_fourth shortcode
//////////////////////////////////////////////////////////////////
add_shortcode('one_fourth', 'shortcode_one_fourth');
	function shortcode_one_fourth($atts, $content = null) {
		$atts = shortcode_atts(
			array(
				'last' => 'no',
			), $atts);
			
			if($atts['last'] == 'yes') {
				return '<div class="one_fourth last">' .do_shortcode($content). '</div><div class="clearboth"></div>';
			} else {
				return '<div class="one_fourth">' .do_shortcode($content). '</div>';
			}

	}
	
//////////////////////////////////////////////////////////////////
// Column three_fourth shortcode
//////////////////////////////////////////////////////////////////
add_shortcode('three_fourth', 'shortcode_three_fourth');
	function shortcode_three_fourth($atts, $content = null) {
		$atts = shortcode_atts(
			array(
				'last' => 'no',
			), $atts);
			
			if($atts['last'] == 'yes') {
				return '<div class="three_fourth last">' .do_shortcode($content). '</div><div class="clearboth"></div>';
			} else {
				return '<div class="three_fourth">' .do_shortcode($content). '</div>';
			}

	}
	
//////////////////////////////////////////////////////////////////
// Tabs shortcode
//////////////////////////////////////////////////////////////////
add_shortcode('tabs', 'shortcode_tabs');
	function shortcode_tabs( $atts, $content = null ) {
	extract(shortcode_atts(array(
    ), $atts));

	$out .= '[raw]<div class="tabs-wrapper">[/raw]';
	
	$out .= '<ul class="tabs">';
	foreach ($atts as $key => $tab) {
		$out .= '<li><a href="#' . $key . '">' . $tab . '</a></li>';
	}
	$out .= '</ul>';
	
	$out .= '<div class="tabs_container">';

	$out .= do_shortcode($content) .'[raw]</div></div>[/raw]';
	
	return $out;
}

add_shortcode('tab', 'shortcode_tab');
	function shortcode_tab( $atts, $content = null ) {
	extract(shortcode_atts(array(
    ), $atts));
	
	$out .= '[raw]<div id="tab' . $atts['id'] . '" class="tab_content shortcode">[/raw]' . do_shortcode($content) .'</div>';
	
	return $out;
}

//////////////////////////////////////////////////////////////////
// Toggle shortcode
//////////////////////////////////////////////////////////////////
add_shortcode('toggle', 'shortcode_toggle');
	function shortcode_toggle( $atts, $content = null ) {
	extract(shortcode_atts(array(
        'title'      => '',
    ), $atts));
	
	$out .= '<h5 class="toggle"><a href="#">' .$title. '</a></h5>';
	$out .= '<div class="toggle-content">';
	$out .= '<div class="block">';
	$out .= do_shortcode($content);
	$out .= '</div>';
	$out .= '</div>';
	
   return $out;
}

function register_button($buttons) {  
   array_push($buttons, "youtube", "vimeo", "button", "dropcap", "highlight", "one_half", "one_third", "two_third", "one_fourth", "three_fourth", "tabs", "toggle");  
   return $buttons;  
}  

function add_plugin($plugin_array) {  
   $plugin_array['youtube'] = get_template_directory_uri().'/admin/tinymce/customcodes.js';
   $plugin_array['vimeo'] = get_template_directory_uri().'/admin/tinymce/customcodes.js';
   $plugin_array['button'] = get_template_directory_uri().'/admin/tinymce/customcodes.js';
   $plugin_array['dropcap'] = get_template_directory_uri().'/admin/tinymce/customcodes.js';
   $plugin_array['highlight'] = get_template_directory_uri().'/admin/tinymce/customcodes.js';
   $plugin_array['one_half'] = get_template_directory_uri().'/admin/tinymce/customcodes.js';
   $plugin_array['one_third'] = get_template_directory_uri().'/admin/tinymce/customcodes.js';
   $plugin_array['two_third'] = get_template_directory_uri().'/admin/tinymce/customcodes.js';
   $plugin_array['one_fourth'] = get_template_directory_uri().'/admin/tinymce/customcodes.js';
   $plugin_array['three_fourth'] = get_template_directory_uri().'/admin/tinymce/customcodes.js';
   $plugin_array['tabs'] = get_template_directory_uri().'/admin/tinymce/customcodes.js';
   $plugin_array['toggle'] = get_template_directory_uri().'/admin/tinymce/customcodes.js';
   return $plugin_array;  
} 

//////////////////////////////////////////////////////////////////
// Change excerpt from [...] to ...
//////////////////////////////////////////////////////////////////
function new_excerpt_more($more) {
       global $post;
	return '... <a href="'. get_permalink($post->ID) . '">Read More &raquo;</a>';
}
add_filter('excerpt_more', 'new_excerpt_more');

//////////////////////////////////////////////////////////////////
// Change length of excerpt
//////////////////////////////////////////////////////////////////
function new_excerpt_length($length) {
global $post;
return 28;
}
add_filter('excerpt_length', 'new_excerpt_length');

//////////////////////////////////////////////////////////////////
// meta post keywords
//////////////////////////////////////////////////////////////////
function meta_post_keywords() {
	$posttags = get_the_tags();
	foreach((array)$posttags as $tag) {
		$meta_post_keywords .= $tag->name . ', ';
	}
	echo $meta_post_keywords;
}

//////////////////////////////////////////////////////////////////
// set post view count
//////////////////////////////////////////////////////////////////
function wpb_set_post_views($postID) {
    $count_key = 'wpb_post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    }else{
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
}
//To keep the count accurate, lets get rid of prefetching
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);

//////////////////////////////////////////////////////////////////
// set post view count
//////////////////////////////////////////////////////////////////
function wpb_get_post_views($postID){
    $count_key = 'wpb_post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
        return "0";
    }
    return $count;
}

?>