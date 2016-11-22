<?php
/**
 * Theme hooks.
 *
 * @package Cherry
 */

// Menu description.
add_filter( 'walker_nav_menu_start_el', 'cherry_nav_menu_description', 10, 4 );

// Menu item wrapper.
add_filter( 'cherry_main_menu_args', 'cherry_main_menu_args', 10, 4 );

// Sidebars classes.
add_filter( 'cherry_widget_area_classes', 'cherry_set_sidebar_classes', 10, 2 );

// Set footer columns.
add_filter( 'dynamic_sidebar_params', 'cherry_get_footer_widget_layout' );

// Adapt default image post format classes to current theme.
add_filter( 'cherry_post_formats_image_css_model', 'cherry_add_image_format_classes', 10, 2 );

// Enqueue sticky menu if required.
add_filter( 'cherry_theme_script_depends', 'cherry_enqueue_misc' );

// Add has/no thumbnail classes for posts.
add_filter( 'post_class', 'cherry_post_thumb_classes' );

// Modify a comment form.
add_filter( 'comment_form_defaults', 'cherry_modify_comment_form' );

// Additional body classes.
add_filter( 'body_class', 'cherry_extra_body_classes' );

// Render macros in text widgets.
add_filter( 'widget_text', 'cherry_render_widget_macros' );

// Adds the meta viewport to the header.
add_action( 'wp_head', 'cherry_meta_viewport', 0 );

// Customization for `Tag Cloud` widget.
add_filter( 'widget_tag_cloud_args', 'cherry_customize_tag_cloud' );

// Changed excerpt more string.
add_filter( 'excerpt_more', 'cherry_excerpt_more' );

// cherry projects permalink button text
add_filter( 'cherry-projects-permalink-text', 'cherry_projects_permalink_button_text' );

// cherry site shortcodes avaliable-styles
add_filter( 'cherry-site-shortcodes-avaliable-styles', 'cherry_site_shortcodes_avaliable_styles' );

add_filter( 'upload_mimes', 'cherry_site_mime_types');

add_filter( 'tm_testimonials_item_classes', 'tm_testimonials_item_classes');

add_filter( 'tm_the_testimonials_default_args', 'tm_the_testimonials_default_args');

// Register a new tmpl-file for `[cherry_team ]` shortcode.
add_filter( 'cherry_team_templates_list', 'cherry_add_team_template' );

// Trimmed a post content in `[tm-timeline]` shortcode.
add_filter( 'tm_timeline_format_content', 'cherry_timeline_format_content' );


/**
 * Append description into nav items
 *
 * @param  string  $item_output The menu item output.
 * @param  WP_Post $item        Menu item object.
 * @param  int     $depth       Depth of the menu.
 * @param  array   $args        wp_nav_menu() arguments.
 * @return string
 */
function cherry_nav_menu_description( $item_output, $item, $depth, $args ) {

	if ( 'main' !== $args->theme_location || ! $item->description ) {
		return $item_output;
	}

	$descr_enabled = get_theme_mod(
		'header_menu_attributes',
		cherry_theme()->customizer->get_default( 'header_menu_attributes' )
	);

	if ( ! $descr_enabled ) {
		return $item_output;
	}

	$current     = $args->link_after . '</a>';
	$description = '<div class="menu-item__desc">' . $item->description . '</div>';
	$item_output = str_replace( $current, $description . $current, $item_output );

	return $item_output;
}

function cherry_main_menu_args( $args ) {
	if ( wp_is_mobile() ) {
		$args[ 'before' ] = '<div class="menu-link-wrapper">';
		$args[ 'after' ] = '</div>';
	}
	return $args;
}

/**
 * Set layout classes for sidebars.
 *
 * @since  1.0.0
 * @uses   cherry_get_layout_classes.
 * @param  array  $classes Additional classes.
 * @param  string $area_id Sidebar ID.
 * @return array
 */
function cherry_set_sidebar_classes( $classes, $area_id ) {

	if ( 'sidebar' == $area_id ) {
		return cherry_get_layout_classes( 'sidebar', $classes );
	}

	if ( 'footer-area' == $area_id ) {
		$classes[] = 'row';
	}

	return $classes;
}

/**
 * Get footer widgets layout class
 *
 * @since  1.0.0
 * @param  string $params Existing widget classes.
 * @return string
 */
function cherry_get_footer_widget_layout( $params ) {

	if ( is_admin() ) {
		return $params;
	}

	if ( empty( $params[0]['id'] ) || 'footer-area' !== $params[0]['id'] ) {
		return $params;
	}

	if ( empty( $params[0]['before_widget'] ) ) {
		return $params;
	}

	$columns = get_theme_mod(
		'footer_widget_columns',
		cherry_theme()->customizer->get_default( 'footer_widget_columns' )
	);

	$columns = intval( $columns );
	$classes = 'class="col-xs-12 col-sm-%2$s col-md-%1$s %3$s ';

	switch ( $columns ) {
		case 4:
			$md_col = 3;
			$sm_col = 6;
			$extra  = '';
			break;

		case 3:
			$md_col = 4;
			$sm_col = 4;
			$extra  = '';
			break;

		case 2:
			$md_col = 6;
			$sm_col = 6;
			$extra  = '';
			break;

		default:
			$md_col = 12;
			$sm_col = 12;
			$extra  = 'footer-area--centered';
			break;
	}

	$params[0]['before_widget'] = str_replace(
		'class="',
		sprintf( $classes, $md_col, $sm_col, $extra ),
		$params[0]['before_widget']
	);

	return $params;
}

/**
 * Filter image CSS model
 *
 * @param  array $css_model Default CSS model.
 * @param  array $args      Post formats module arguments.
 * @return array
 */
function cherry_add_image_format_classes( $css_model, $args ) {
	$css_model['link'] .= ' post-thumbnail--fullwidth';

	return $css_model;
}

/**
 * Add jQuery Stickup to theme script dependencies if required.
 *
 * @param  array $depends Default dependencies.
 * @return array
 */
function cherry_enqueue_misc( $depends ) {
	$header_menu_sticky = get_theme_mod( 'header_menu_sticky', cherry_theme()->customizer->get_default( 'header_menu_sticky' ) );

	if ( $header_menu_sticky && ! wp_is_mobile() ) {
		$depends[] = 'jquery-stickup';
	}

	$totop_visibility = get_theme_mod( 'totop_visibility', cherry_theme()->customizer->get_default( 'totop_visibility' ) );

	if ( $totop_visibility ) {
		$depends[] = 'jquery-totop';
	}

	return $depends;
}

/**
 * Add has/no thumbnail classes for posts
 *
 * @param  array $classes Existing classes.
 * @return array
 */
function cherry_post_thumb_classes( $classes ) {
	$thumb = 'no-thumb';

	if ( has_post_thumbnail() ) {
		$thumb = 'has-thumb';
	}

	$classes[] = $thumb;

	return $classes;
}

/**
 * Add placeholder attributes for comment form fields.
 *
 * @param  array $args Argumnts for comment form.
 * @return array
 */
function cherry_modify_comment_form( $args ) {
	$args = wp_parse_args( $args );

	if ( ! isset( $args['format'] ) ) {
		$args['format'] = current_theme_supports( 'html5', 'comment-form' ) ? 'html5' : 'xhtml';
	}

	$req       = get_option( 'require_name_email' );
	$aria_req  = ( $req ? " aria-required='true'" : '' );
	$html_req  = ( $req ? " required='required'" : '' );
	$html5     = 'html5' === $args['format'];
	$commenter = wp_get_current_commenter();

	$args['label_submit'] = esc_html__( 'Submit Comment', 'cherry' );

	$args['fields']['author'] = '<p class="comment-form-author"><input id="author" class="comment-form__field" name="author" type="text" placeholder="' . esc_html__( 'Your name', 'cherry' ) . ( $req ? ' *' : '' ) . '" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . $html_req . ' /></p>';

	$args['fields']['email'] = '<p class="comment-form-email"><input id="email" class="comment-form__field" name="email" ' . ( $html5 ? 'type="email"' : 'type="text"' ) . ' placeholder="' . esc_html__( 'Your e-mail', 'cherry' ) . ( $req ? ' *' : '' ) . '" value="' . esc_attr( $commenter['comment_author_email'] ) . '" size="30" aria-describedby="email-notes"' . $aria_req . $html_req  . ' /></p>';

	$args['fields']['url'] = '<p class="comment-form-url"><input id="url" class="comment-form__field" name="url" ' . ( $html5 ? 'type="url"' : 'type="text"' ) . ' placeholder="' . esc_html__( 'Your website', 'cherry' ) . '" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" /></p>';

	$args['comment_field'] = '<p class="comment-form-comment"><textarea id="comment" class="comment-form__field" name="comment" placeholder="' . esc_html__( 'Comments *', 'cherry' ) . '" cols="45" rows="8" aria-required="true" required="required"></textarea></p>';

	return $args;
}

/**
 * Add extra body classes
 *
 * @param  array $classes Existing classes.
 * @return array
 */
function cherry_extra_body_classes( $classes ) {

	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	if ( ! cherry_is_top_panel_visible() ) {
		$classes[] = 'top-panel-invisible';
	}

	// Adds a class based on header layout type.
	$header_layout = get_theme_mod( 'header_layout_type', cherry_theme()->customizer->get_default( 'header_layout_type' ) );

	if ( wp_is_mobile() ) {
		$header_layout = 'mobile';
	}

	$classes[] = 'header-layout-' . $header_layout;

	// Adds a options-based classes.
	$header_layout  = get_theme_mod( 'header_container_type', cherry_theme()->customizer->get_default( 'header_container_type' ) );
	$content_layout = get_theme_mod( 'content_container_type', cherry_theme()->customizer->get_default( 'content_container_type' ) );
	$footer_layout  = get_theme_mod( 'footer_container_type', cherry_theme()->customizer->get_default( 'footer_container_type' ) );
	$blog_layout    = get_theme_mod( 'blog_layout_type', cherry_theme()->customizer->get_default( 'blog_layout_type' ) );
	$sb_position    = get_theme_mod( 'sidebar_position', cherry_theme()->customizer->get_default( 'sidebar_position' ) );
	$sidebar        = get_theme_mod( 'sidebar_width', cherry_theme()->customizer->get_default( 'sidebar_width' ) );

	return array_merge( $classes, array(
		'header-layout-' . $header_layout,
		'content-layout-' . $content_layout,
		'footer-layout-' . $footer_layout,
		'blog-' . $blog_layout,
		'position-' . $sb_position,
		'sidebar-' . str_replace( '/', '-', $sidebar ),
	) );
}

/**
 * Replace macroses in text widget.
 *
 * @param  string $text Default text.
 * @return string
 */
function cherry_render_widget_macros( $text ) {
	$uploads = wp_upload_dir();

	$data = array(
		'/%%uploads_url%%/' => $uploads['baseurl'],
		'/%%home_url%%/'    => esc_url( home_url( '/' ) ),
		'/%%theme_url%%/'   => get_stylesheet_directory_uri(),
	);

	return preg_replace( array_keys( $data ), array_values( $data ), $text );
}

/**
 * Adds the meta viewport to the header.
 *
 * @since  1.0.1
 * @return string `<meta>` tag for viewport.
 */
function cherry_meta_viewport() {
	echo '<meta name="viewport" content="width=device-width, initial-scale=1" />' . "\n";
}

/**
 * Customization for `Tag Cloud` widget.
 *
 * @since  1.0.1
 * @param  array $args Widget arguments.
 * @return array
 */
function cherry_customize_tag_cloud( $args ) {
	$args['smallest'] = 14;
	$args['largest']  = 14;
	$args['unit']     = 'px';

	return $args;
}

/**
 * Replaces `[...]` (appended to automatically generated excerpts) with `...`.
 *
 * @since  1.0.1
 * @param  string $more The string shown within the more link.
 * @return string
 */
function cherry_excerpt_more( $more ) {

	if ( is_admin() ) {
		return $more;
	}

	return ' &hellip;';
}


function cherry_projects_permalink_button_text( $text ) {
	$text = esc_html__( 'Details', 'cherry' );

	return $text;
}

function cherry_site_shortcodes_avaliable_styles( $styles ) {
	unset( $styles['grid'] );
	//unset( $styles['element'] );

	return $styles;
}

function cherry_site_mime_types( $mimes ) {
	$mimes['svg'] = 'image/svg+xml';

	return $mimes;
}

function tm_testimonials_item_classes( $classes ) {
	$classes[] = 'col-xs-12';
	$classes[] = 'col-md-6';
	$classes[] = 'col-lg-4';

	return $classes;
}

function tm_the_testimonials_default_args( $args ) {
	$args['container'] = '<div class="tm-testi__list row">%s</div>';

	return $args;
}

function cherry_add_team_template( $templates ) {
	$templates['boxed'] = 'boxed.tmpl';

	return $templates;
}

function cherry_timeline_format_content( $content ) {
	$content = strip_shortcodes( $content );
	$content = apply_filters( 'the_content', $content );
	$content = str_replace( ']]>', ']]&gt;', $content );
	$content = wp_trim_words( $content, 20, '&hellip;' );

	return $content;
}