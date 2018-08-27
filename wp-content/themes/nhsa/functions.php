<?php


/* MENUS */

function wpb_custom_new_menu() {
	register_nav_menus(
		array(
			'utility-navigation' => __( 'Utility Navigation' ),
			'primary-navigation' => __( 'Primary Navigation' ),
			'social-navigation'  => __( 'social Navigation' )
		)
	);
}

add_action( 'init', 'wpb_custom_new_menu' );
add_theme_support( 'title-tag' );


add_filter( 'wp_revisions_to_keep', 'filter_function_name', 10, 2 );

function filter_function_name( $num, $post ) {
	return $num;
}


function my_scripts_method() {
	// register your script location, dependencies and version
	wp_register_script( 'nhsa-script',
		get_template_directory_uri() . '/js/script.js',
		array( 'jquery' ),
		'1.0' );

}

add_action( 'wp_enqueue_scripts', 'my_scripts_method' );

/* Sidebars */
/**
 * Add a sidebar.
 */
function wpdocs_theme_slug_widgets_init() {


	register_sidebar( array(
		'name'          => __( 'Events & Articles Listing Pages Sidebar', 'nhsa' ),
		'id'            => 'sidebar-events',
		'description'   => __( 'Sidebar on the right of the Events and Articles Listing page. Under the Filtering options', 'nhsa' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Articles Detail Pages Sidebar', 'nhsa' ),
		'id'            => 'sidebar-events-details',
		'description'   => __( 'Sidebar on the right of the Events and Articles Details page.', 'nhsa' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
}

add_action( 'widgets_init', 'wpdocs_theme_slug_widgets_init' );


/*George's Functions stuff */


//Move Yoast SEO to bottom of Page Editor
add_filter( 'wpseo_metabox_prio', function () {
	return 'low';
} );

//Disable Yoast Redirect Notifications on URL change
add_filter( 'wpseo_enable_notification_post_slug_change', '__return_false' );
add_filter( 'wpseo_enable_notification_term_slug_change', '__return_false' );

// Remove Feed Funk
function itsme_disable_feed() {
	wp_die( __( 'No feed available, please visit the <a href="' . esc_url( home_url( '/' ) ) . '">homepage</a>!' ) );
}

add_action( 'do_feed', 'itsme_disable_feed', 1 );
add_action( 'do_feed_rdf', 'itsme_disable_feed', 1 );
add_action( 'do_feed_rss', 'itsme_disable_feed', 1 );
add_action( 'do_feed_rss2', 'itsme_disable_feed', 1 );
add_action( 'do_feed_atom', 'itsme_disable_feed', 1 );
add_action( 'do_feed_rss2_comments', 'itsme_disable_feed', 1 );
add_action( 'do_feed_atom_comments', 'itsme_disable_feed', 1 );

// Remove Header Link Funk
remove_action( 'wp_head', 'feed_links_extra', 3 );
remove_action( 'wp_head', 'feed_links', 2 );
remove_action( 'wp_head', 'rsd_link' );
remove_action( 'wp_head', 'wlwmanifest_link' );
remove_action( 'wp_head', 'wp_shortlink_wp_head' );
remove_action( 'wp_head', 'wp_generator' );

// Stop WordPress re-ordering categories/taxonomies when one selects them
function stop_reordering_my_categories( $args ) {
	$args['checked_ontop'] = false;

	return $args;
}

add_filter( 'wp_terms_checklist_args', 'stop_reordering_my_categories' );

//Remove Comments & Posts from Admin
function remove_menus() {
	remove_menu_page( 'edit-comments.php' );
	remove_menu_page( 'edit.php' );                   //Posts

}

add_action( 'admin_menu', 'remove_menus' );

/* allow shortcodes in Contact Form 7 */
add_filter( 'wpcf7_form_elements', 'do_shortcode' );

// create Site Options tab for sitewide ACF settings
if ( function_exists( 'acf_add_options_page' ) ) {
	acf_add_options_page( 'Site Options' );
}

add_theme_support( 'post-thumbnails' );


/**** Google API KEy for the Location ***
 * function my_acf_init() {
 *
 * acf_update_setting('google_api_key', 'xxx');
 * }
 *
 * add_action('acf/init', 'my_acf_init');
 */

/* Adding in the Archives in here ***/


/* Custom Image Sizes */
add_image_size( 'HeroImage', 1330, 522, true );
add_image_size( 'homeSlider', 1330, 627, true );
add_image_size( 'MobileHeroImage', 750, 669, true );
add_image_size( 'latestUpdateImage', 366, 279, true );
add_image_size( 'homepagePurpleBoxes', 456, 400, true );
add_image_size( 'mobileHomepagePurpleBoxes', 751, 657, true );
add_image_size( 'homepageCppi', 367, 200, true );
add_image_size( 'staff', 458, 341, true );


/**
 * Removes the regular excerpt box. We're not getting rid
 * of it, we're just moving it above the wysiwyg editor
 *
 * @return null
 */
function oz_remove_normal_excerpt() {
	remove_meta_box( 'postexcerpt', 'post', 'normal' );
}

add_action( 'admin_menu', 'oz_remove_normal_excerpt' );

/**
 * Add the excerpt meta box back in with a custom screen location
 *
 * @param  string $post_type
 *
 * @return null
 */
function oz_add_excerpt_meta_box( $post_type ) {
	if ( in_array( $post_type, array( 'post', 'page' ) ) ) {
		add_meta_box(
			'oz_postexcerpt',
			__( 'Teaser - Text to show on other pages', 'thetab-theme' ),
			'post_excerpt_meta_box',
			$post_type,
			'after_title',
			'high'
		);
	}
}

add_action( 'add_meta_boxes', 'oz_add_excerpt_meta_box' );

/**
 * You can't actually add meta boxes after the title by default in WP so
 * we're being cheeky. We've registered our own meta box position
 * `after_title` onto which we've regiestered our new meta boxes and
 * are now calling them in the `edit_form_after_title` hook which is run
 * after the post tile box is displayed.
 *
 * @return null
 */
function oz_run_after_title_meta_boxes() {
	global $post, $wp_meta_boxes;
	# Output the `below_title` meta boxes:
	do_meta_boxes( get_current_screen(), 'after_title', $post );
}

add_action( 'edit_form_after_title', 'oz_run_after_title_meta_boxes' );

add_action( 'admin_init', 'remove_textarea' );

function remove_textarea() {
	remove_post_type_support( 'page', 'editor' );
}


/*********************************/
/* Change Search Button Text
/**************************************/
/*
// Add to your child-theme functions.php
add_filter( 'get_search_form', 'my_search_form_text' );

function my_search_form_text( $text ) {
	$text = str_replace( 'value=""', 'value="Search"', $text ); //set as value the text you want

	return $text;
}
*/

function dsp_correct_event_datetime( $start_date, $end_date ) {

	$new_start_date = date_create_from_format( 'F j, Y g:i a', $start_date );
	$new_end_date   = date_create_from_format( 'F j, Y g:i a', $end_date );
	$displayDate    = '';

	if ( date_format( $new_start_date, "F j" ) == date_format( $new_end_date, "F j" ) ) {
		$displayDate = date_format( $new_start_date, "F " ) . date_format( $new_end_date, "j, Y" );
	} else {
		if ( date_format( $new_start_date, "F" ) == date_format( $new_end_date, "F" ) ) {
			$displayDate = date_format( $new_start_date, "F j" ) . " - " . date_format( $new_end_date, "j, Y" );
		}else{
			$displayDate = date_format( $new_start_date, "F j, Y" ) . " - " . date_format( $new_end_date, "F j, Y" );
}
	}


	return $displayDate;

}

function add_query_vars_filter( $vars ) {
	$vars[] = "type";
	$vars[] = "category";

	return $vars;
}

add_filter( 'query_vars', 'add_query_vars_filter' );
// array of filters (field key => field name)
$GLOBALS['my_query_filters'] = array(
	'category' => 'category',
	'type'     => 'type'
);

function custom_rewrite_rule() {

	add_rewrite_rule( '^([^/]*)/filters/([^/]*)/([^/]*)/?', 'index.php?post_type=$matches[1]&category=$matches[2]&type=$matches[3]', 'top' );

}

function custom_rewrite_rule2() {
	add_rewrite_rule( '^([^/]*)/filters/([^/]*)/([^/]*)/page/([0-9]{1,})/?', 'index.php?post_type=$matches[1]&category=$matches[2]&type=$matches[3]&paged=$matches[4]', 'top' );

}
add_action( 'init', 'custom_rewrite_rule2', 10, 0 );
add_action( 'init', 'custom_rewrite_rule', 10, 0 );



class SH_Child_Only_Walker extends Walker_Nav_Menu {
	// add main/sub classes to li's and links
	function start_el(&$output, $item, $depth = 0, $args = Array(), $id = 0){
		global $wp_query;
		$indent = ( $depth > 0 ? str_repeat( "\t", $depth ) : '' ); // code indent
		// passed classes
		$classes = empty( $item->classes ) ? array() : (array) $item->classes;

		$class_names = esc_attr( implode( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) ) );

		// build html
		$output .= $indent . '<li id="nav-menu-item-' . $item->ID . '" class="' . $class_names . '">';

		// link attributes
		$attributes = ! empty( $item->attr_title ) ? ' title="' . esc_attr( $item->attr_title ) . '"' : '';
		$attributes .= ! empty( $item->target ) ? ' target="' . esc_attr( $item->target ) . '"' : '';
		$attributes .= ! empty( $item->xfn ) ? ' rel="' . esc_attr( $item->xfn ) . '"' : '';
		$attributes .= ! empty( $item->url ) ? ' href="' . esc_attr( $item->url ) . '"' : '';
		$attributes .= ' class="menu-link ' . ( $depth > 0 ? 'sub-menu-link' : 'main-menu-link' ) . '"';

		$item_output = sprintf( '%1$s<a%2$s>%3$s%4$s%5$s</a>%6$s',
			$args->before,
			$attributes,
			$args->link_before,
			apply_filters( 'the_title', $item->title, $item->ID ),
			$args->link_after,
			$args->after
		);

		// build html
		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );

		if ( nav_hasChildren( $item->object_id ) ) {
			$output .= '<ul class="sub-menu">';
			ob_start();
			wp_list_pages(
				array(
					'child_of' => $item->object_id,
					'depth'    => 2,
					'title_li' => ''
				)
			);
			$output .= ob_get_clean();
			$output .= '</ul>';
		}
	}
}

/** Check if item has Children **/
function nav_hasChildren( $pid ) {
	$children = get_pages( 'child_of=' . $pid );
	if ( $children ) {
		return true;
	} else {
		return false;
	}
}

/***** STart of all the Theme Settings Page ******/

function theme_settings_page() {
	?>
    <div class="wrap">
        <h1>NHSA Settings</h1>
        <form method="post" action="options.php">
			<?php
			settings_fields( "section" );
			do_settings_sections( "theme-options" );
			submit_button();
			?>
        </form>
    </div>
	<?php
}

function display_twitter_element() {
	?>
    <input type="text" name="twitter_url" id="twitter_url" value="<?php echo get_option( 'twitter_url' ); ?>"/>
	<?php
}

function display_facebook_element() {
	?>
    <input type="text" name="facebook_url" id="facebook_url" value="<?php echo get_option( 'facebook_url' ); ?>"/>
	<?php
}

function display_instagram_element() {
	?>
    <input type="text" name="instagram_url" id="instagram_url" value="<?php echo get_option( 'instagram_url' ); ?>"/>
	<?php
}

function display_404_title_element() {
	?>
    <textarea id='default_404_title' name='default_404_title' rows='3' cols='50' type='textarea'><?=get_option( 'default_404_title' );?></textarea>

	<?php
}
function display_404_element() {

	echo "<textarea id='default_404' name='default_404' rows='7' cols='50' type='textarea'>" . get_option( 'default_404' ) . "</textarea>";

	/*	<input type="textarea" name="default_404" id="default_404" value="<?php echo get_option('default_404'); ?>" />*/
}

function display_layout_element() {
	?>
    <input id="upload_image" type="text" size="36" name="ad_image" value=<?PHP echo get_option( 'ad_image' ); ?>/>
    <input id="upload_image_button" class="button" type="button" value="Upload Menu"/>
	<?php
}


// WYSIWYG Visual Editor - Name: plugin_options[textarea_one]
function setting_visual_fn() {
	$options = get_option( 'plugin_options' );
	$args    = array( "textarea_name" => "plugin_options[textarea_one]" );
	wp_editor( $options['textarea_one'], "plugin_options[textarea_one]", $args );

// Add another text box
	$options = get_option( 'plugin_options' );
	$args    = array( "textarea_name" => "plugin_options[textarea_two]" );
	wp_editor( $options['textarea_two'], "plugin_options[textarea_two]", $args );
}

function display_theme_panel_fields() {
	add_settings_section( "section", "All Settings", null, "theme-options" );

//	add_settings_field( "twitter_url", "Twitter Url", "display_twitter_element", "theme-options", "section" );
//	register_setting( "section", "twitter_url" );

//	add_settings_field( "facebook_url", "Facebook  Url", "display_facebook_element", "theme-options", "section" );
//	add_settings_field( "instagram_url", "Instagram Url", "display_instagram_element", "theme-options", "section" );
//	register_setting( "section", "instagram_url" );

	add_settings_field( "default_404_title", "Default 404 Title", "display_404_title_element", "theme-options", "section" );
	register_setting( "section", "default_404_title" );

	add_settings_field( "default_404", "Default 404 Text", "display_404_element", "theme-options", "section" );
	register_setting( "section", "default_404" );

//	add_settings_field( "theme_layout", "Do you want the layout to be responsive?", "display_layout_element", "theme-options", "section" );
//	register_setting( "section", "theme_layout" );

//	register_setting( "section", "facebook_url" );
}

add_action( "admin_init", "display_theme_panel_fields" );

function add_theme_menu_item() {
	add_menu_page( "NHSA Settings", "NHSA Settings", "manage_options", "nhsa-panel", "theme_settings_page", null, 99 );
}

add_action( "admin_menu", "add_theme_menu_item" );



add_action( 'restrict_manage_posts', 'my_restrict_manage_posts' );

function my_restrict_manage_posts() {
	global $typenow, $post, $post_id;

	if( $typenow != "page" && $typenow != "post" ){
		//get post type
		$post_type=get_query_var('post_type');

		//get taxonomy associated with current post type
		$taxonomies = get_object_taxonomies($post_type);

		//in next loop add filter for tax
		if ($taxonomies) {
			foreach ($taxonomies as $tax_slug) {
				$tax_obj = get_taxonomy($tax_slug);
				$tax_name = $tax_obj->labels->name;
				$terms = get_terms($tax_slug);
				echo "<select name='$tax_slug' id='$tax_slug' class='postform'>";
				echo "<option value=''>Show All $tax_name</option>";
				foreach ($terms as $term) {
					$label = (isset($_GET[$tax_slug])) ? $_GET[$tax_slug] : ''; // Fix
					echo '<option value='. $term->slug, $label == $term->slug ? ' selected="selected"' : '','>' . $term->name .' (' . $term->count .')</option>';
				}
				echo "</select>";
			}
		}
	}
}
add_filter( 'tiny_mce_before_init', 'custom_mce_before_init' );
function custom_mce_before_init( $settings ) {
	$style_formats = array(
		array(
			'title' => 'Some Style',
			'selector' => 'a',
			'classes' => 'my-anchor-class',
		)
	);
	$settings['style_formats'] = json_encode( $style_formats );
	return $settings;
}


/**
 * Add extra dropdowns to the List Tables
 *
 * @param required string $post_type    The Post Type that is being displayed
 */
add_action('restrict_manage_posts', 'add_extra_tablenav');
function add_extra_tablenav($post_type){

	global $wpdb;

	/** Ensure this is the correct Post Type*/
	if($post_type !== 'resources')
		return;

	/** Grab the results from the DB */
	$query = $wpdb->prepare('
        SELECT DISTINCT pm.meta_value FROM %1$s pm
        LEFT JOIN %2$s p ON p.ID = pm.post_id
        WHERE pm.meta_key = "%3$s" 
        AND p.post_status = "%4$s" 
        AND p.post_type = "%5$s"
        ORDER BY "%3$s"',
		$wpdb->postmeta,
		$wpdb->posts,
		'category', // Your meta key - change as required
		'publish',          // Post status - change as required
		$post_type
	);
	//print $query;
	$results = $wpdb->get_col($query);

	/** Ensure there are options to show */
	if(empty($results))
		return;

	/** Grab all of the options that should be shown */
	$catoptions[] = sprintf('<option value="-1">%1$s</option>', __('All Categories', 'your-text-domain'));
	foreach($results as $result) :



//		'. $term->slug, $label == $term->slug ? ' selected="selected"' : '','
		if ($_GET['post_type']) {
		//$selected = ' selected="selected"';
    }
		$catoptions[] = sprintf('<option value="%1$s" '. $selected .'>%2$s</option>', esc_attr($result), $result);
	endforeach;

	/** Output the dropdown menu */
	echo '<select class="" id="categories-name" name="categories-name">';
	echo join("\n", $catoptions);
	echo '</select>';




	$query = $wpdb->prepare('
        SELECT DISTINCT pm.meta_value FROM %1$s pm
        LEFT JOIN %2$s p ON p.ID = pm.post_id
        WHERE pm.meta_key = "%3$s" 
        AND p.post_status = "%4$s" 
        AND p.post_type = "%5$s"
        ORDER BY "%3$s"',
		$wpdb->postmeta,
		$wpdb->posts,
		'type', // Your meta key - change as required
		'publish',          // Post status - change as required
		$post_type
	);
	//print $query;
	$results = $wpdb->get_col($query);

	/** Ensure there are options to show */
	if(empty($results))
		return;

	/** Grab all of the options that should be shown */
	$options[] = sprintf('<option value="-1">%1$s</option>', __('All Types', 'your-text-domain'));
	foreach($results as $result) :



//		'. $term->slug, $label == $term->slug ? ' selected="selected"' : '','
		if ($_GET['post_type']) {
			//$selected = ' selected="selected"';
		}
		$options[] = sprintf('<option value="%2$s" '. $selected .'>%1$s</option>', esc_attr($result), $result);
	endforeach;

	/** Output the dropdown menu */
	echo '<select class="" id="types-name" name="types-name">';
	echo join("\n", $options);
	echo '</select>';




}


add_filter('manage_edit-member_organizations_columns', 'my_columns');
function my_columns($columns) {
	$columns['member_category'] = ' Category';

	return $columns;
}

add_action('manage_posts_custom_column',  'my_show_columns');
function my_show_columns($name) {
	global $post;
	switch ($name) {


		case 'member_category':
			$member_category = get_post_meta($post->ID, 'member_category', true);
			if(!empty($member_category)){
			foreach ($member_category as &$mvalue) {
				echo $mvalue . "<BR>";
			}}
	}
}



?>
