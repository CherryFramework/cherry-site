<?php
/**
 * Custom WooCommerce breadcrumbs for Cherry
 * (extends default Cherry breadcrumbs)
 */
class Cherry_Site_DW_Breadcrumbs extends Cherry_Breadcrumbs {

	/**
	 * Build breadcrumbs trail items array
	 */
	public function build_trail() {

		$this->is_extend = true;

		if ( is_front_page() ) {
			// if we on front page
			$this->add_front_page();
		} else {
			// do this for all other pages
			$this->add_network_home_link();
			$this->add_site_home_link();
			$this->add_qa_page();
			if ( is_singular( 'dwqa-question' ) ) {
				$this->add_single_question();
			} elseif ( is_tax( array( 'dwqa-question_category', 'dwqa-question_tag' ) ) ) {
				$this->add_qa_tax();
			}
		}

		/* Add paged items if they exist. */
		$this->add_paged_items();

		/**
		 * Filter final item array
		 *
		 * @var array
		 */
		$this->items = apply_filters( 'cherry_breadcrumbs_items', $this->items, $this->args );
	}

	/**
	 * Add single product trailings
	 */
	private function add_single_question() {

		$terms = false;

		global $post;

		$terms = wp_get_post_terms( $post->ID, 'dwqa-question_category' );

		if ( $terms ) {
			$main_term = apply_filters( 'cherry_dw_qa_breadcrumb_main_term', $terms[0], $terms );
			$this->term_ancestors( $main_term->term_id, 'dwqa-question_category' );
			$this->_add_item( 'link_format', $main_term->name, get_term_link( $main_term ) );
		}

		$this->_add_item( 'target_format', get_the_title( $post->ID ) );
		$this->page_title = get_the_title( $post->ID );
	}

	/**
	 * Add parent erms items for a term
	 *
	 * @param string $taxonomy
	 */
	private function term_ancestors( $term_id, $taxonomy ) {
		$ancestors = get_ancestors( $term_id, $taxonomy );
		$ancestors = array_reverse( $ancestors );
		foreach ( $ancestors as $ancestor ) {
			$ancestor = get_term( $ancestor, $taxonomy );
			if ( ! is_wp_error( $ancestor ) && $ancestor ) {
				$this->_add_item( 'link_format', $ancestor->name, get_term_link( $ancestor ) );
			}
		}
	}

	/**
	 * Get product category page trilink
	 */
	private function add_qa_tax() {

		$current_term = $GLOBALS['wp_query']->get_queried_object();

		if ( is_tax( 'product_cat' ) ) {
			$this->term_ancestors( $current_term->term_id, $current_term->taxonomy );
		}
		$this->_add_item( 'target_format', $current_term->name );
	}

	/**
	 * Add DW QA main page
	 */
	private function add_qa_page() {

		global $dwqa_general_settings;
		if ( empty( $dwqa_general_settings['pages']['archive-question'] ) ) {
			return;
		}

		$page_id = $dwqa_general_settings['pages']['archive-question'];
		$label   = get_the_title( $page_id );
		$url     = get_permalink( $page_id );

		if ( ! is_page( $page_id ) ) {
			$this->_add_item( 'link_format', $label, $url );
		} elseif ( $label ) {
			$this->page_title = $label;
			$this->_add_item( 'target_format', $label );
		}
	}
}
