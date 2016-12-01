<?php
/**
 * Replace default breadcrubs trail with DW-Questions-related.
 *
 * @param  bool  $is_custom_breadcrumbs Default cutom breadcrumbs trigger.
 * @param  array $args                  Breadcrumb arguments.
 * @return bool|array
 */
function cherry_site_dw_breadcrumbs( $is_custom_breadcrumbs, $args ) {

	if ( ! class_exists( 'DW_Question_Answer' ) ) {
		return false;
	}

	if ( ! cherry_site_is_dw_qa_page() ) {
		return false;
	}

	if ( ! class_exists( 'Cherry_Site_DW_Breadcrumbs' ) ) {
		require_once trailingslashit( CHERRY_THEME_CLASSES ) . 'class-dw-questions-breadcrumbs.php';
	}

	$dw_breadcrums = new Cherry_Site_DW_Breadcrumbs( cherry_theme()->get_core(), $args );

	return array( 'items' => $dw_breadcrums->items, 'page_title' => $dw_breadcrums->page_title );

}

add_filter( 'cherry_breadcrumbs_custom_trail', 'cherry_site_dw_breadcrumbs', 10, 2 );

/**
 * Check if is DW plugin page
 *
 * @return bool
 */
function cherry_site_is_dw_qa_page() {

	$search = isset( $_GET['qs'] ) ? esc_html( $_GET['qs'] ) : false;
	$author = isset( $_GET['user'] ) ? esc_html( $_GET['user'] ) : false;

	if ( ! is_tax( 'dwqa-question_category' ) ) {
		return true;
	}

	if ( ! is_tax( 'dwqa-question_tag' ) ) {
		return true;
	}

	if ( is_singular( 'dwqa-question' ) ) {
		return true;
	}

	if ( $search || $author ) {
		return true;
	}

	return false;
}

/**
 * Remove default DW QA breadcrumbs
 */
remove_action( 'dwqa_before_questions_archive', 'dwqa_breadcrumb' );
remove_action( 'dwqa_before_single_question', 'dwqa_breadcrumb' );
