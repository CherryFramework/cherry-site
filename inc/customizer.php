<?php
/**
 * Theme Customizer.
 *
 * @package Cherry
 */

/**
 * Retrieve a holder for Customizer options.
 *
 * @since  1.0.0
 * @return array
 */
function cherry_get_customizer_options() {
	/**
	 * Filter a holder for Customizer options (for theme/plugin developer customization).
	 *
	 * @since 1.0.0
	 */
	return apply_filters( 'cherry_get_customizer_options' , array(
		'prefix'     => 'cherry',
		'capability' => 'edit_theme_options',
		'type'       => 'theme_mod',
		'options'    => array(

			/** `Site Indentity` section */
			'show_tagline' => array(
				'title'    => esc_html__( 'Show tagline after logo', 'cherry' ),
				'section'  => 'title_tagline',
				'priority' => 60,
				'default'  => false,
				'field'    => 'checkbox',
				'type'     => 'control',
			),
			'totop_visibility' => array(
				'title'   => esc_html__( 'Show ToTop button', 'cherry' ),
				'section' => 'title_tagline',
				'priority' => 61,
				'default' => true,
				'field'   => 'checkbox',
				'type'    => 'control',
			),
			'page_preloader' => array(
				'title'    => esc_html__( 'Show page preloader', 'cherry' ),
				'section'  => 'title_tagline',
				'priority' => 62,
				'default'  => true,
				'field'    => 'checkbox',
				'type'     => 'control',
			),
			'general_settings' => array(
				'title'       => esc_html__( 'General Site settings', 'cherry' ),
				'priority'    => 40,
				'type'        => 'panel',
			),

			/** `Logo & Favicon` section */
			'logo_favicon' => array(
				'title'       => esc_html__( 'Logo &amp; Favicon', 'cherry' ),
				'priority'    => 25,
				'panel'       => 'general_settings',
				'type'        => 'section',
			),
			'header_logo_type' => array(
				'title'   => esc_html__( 'Logo Type', 'cherry' ),
				'section' => 'logo_favicon',
				'default' => 'image_text',
				'field'   => 'radio',
				'choices' => array(
					'image'      => esc_html__( 'Image', 'cherry' ),
					'text'       => esc_html__( 'Text', 'cherry' ),
					'image_text' => esc_html__( 'Image&Text', 'cherry' ),
				),
				'type' => 'control',
			),
			'header_logo_url' => array(
				'title'           => esc_html__( 'Logo Upload', 'cherry' ),
				'description'     => esc_html__( 'Upload logo image', 'cherry' ),
				'section'         => 'logo_favicon',
				'default'         => '%s/assets/images/single-logo.png',
				'field'           => 'image',
				'type'            => 'control',
				'active_callback' => 'cherry_is_header_logo_image',
			),
			'retina_header_logo_url' => array(
				'title'           => esc_html__( 'Retina Logo Upload', 'cherry' ),
				'description'     => esc_html__( 'Upload logo for retina-ready devices', 'cherry' ),
				'section'         => 'logo_favicon',
				'default'         => '%s/assets/images/single-logo-retina.png',
				'field'           => 'image',
				'type'            => 'control',
				'active_callback' => 'cherry_is_header_logo_image',
			),
			'header_logo_font_family' => array(
				'title'           => esc_html__( 'Font Family', 'cherry' ),
				'section'         => 'logo_favicon',
				'default'         => 'Raleway, sans-serif',
				'field'           => 'fonts',
				'type'            => 'control',
				'active_callback' => 'cherry_is_header_logo_text',
			),
			'header_logo_font_style' => array(
				'title'           => esc_html__( 'Font Style', 'cherry' ),
				'section'         => 'logo_favicon',
				'default'         => 'normal',
				'field'           => 'select',
				'choices'         => cherry_get_font_styles(),
				'type'            => 'control',
				'active_callback' => 'cherry_is_header_logo_text',
			),
			'header_logo_font_weight' => array(
				'title'           => esc_html__( 'Font Weight', 'cherry' ),
				'section'         => 'logo_favicon',
				'default'         => '800',
				'field'           => 'select',
				'choices'         => cherry_get_font_weight(),
				'type'            => 'control',
				'active_callback' => 'cherry_is_header_logo_text',
			),
			'header_logo_font_size' => array(
				'title'           => esc_html__( 'Font Size, px', 'cherry' ),
				'section'         => 'logo_favicon',
				'default'         => '26',
				'field'           => 'number',
				'input_attrs'     => array(
					'min'  => 6,
					'max'  => 50,
					'step' => 1,
				),
				'type'            => 'control',
				'active_callback' => 'cherry_is_header_logo_text',
			),
			'header_logo_character_set' => array(
				'title'           => esc_html__( 'Character Set', 'cherry' ),
				'section'         => 'logo_favicon',
				'default'         => 'latin',
				'field'           => 'select',
				'choices'         => cherry_get_character_sets(),
				'type'            => 'control',
				'active_callback' => 'cherry_is_header_logo_text',
			),

			/** `Breadcrumbs` section */
			'breadcrumbs' => array(
				'title'    => esc_html__( 'Breadcrumbs', 'cherry' ),
				'priority' => 30,
				'type'     => 'section',
				'panel'    => 'general_settings',
			),
			'breadcrumbs_visibillity' => array(
				'title'   => esc_html__( 'Enable Breadcrumbs', 'cherry' ),
				'section' => 'breadcrumbs',
				'default' => true,
				'field'   => 'checkbox',
				'type'    => 'control',
			),
			'breadcrumbs_front_visibillity' => array(
				'title'   => esc_html__( 'Enable Breadcrumbs on front page', 'cherry' ),
				'section' => 'breadcrumbs',
				'default' => false,
				'field'   => 'checkbox',
				'type'    => 'control',
			),
			'breadcrumbs_page_title' => array(
				'title'   => esc_html__( 'Enable page title in breadcrumbs area', 'cherry' ),
				'section' => 'breadcrumbs',
				'default' => true,
				'field'   => 'checkbox',
				'type'    => 'control',
			),
			'breadcrumbs_path_type' => array(
				'title'   => esc_html__( 'Show full/minified path', 'cherry' ),
				'section' => 'breadcrumbs',
				'default' => 'full',
				'field'   => 'select',
				'choices' => array(
					'full'     => esc_html__( 'Full', 'cherry' ),
					'minified' => esc_html__( 'Minified', 'cherry' ),
				),
				'type'    => 'control',
			),

			/** `Social links` section */
			'social_links' => array(
				'title'    => esc_html__( 'Social links', 'cherry' ),
				'priority' => 50,
				'type'     => 'section',
				'panel'    => 'general_settings',
			),
			'header_social_links' => array(
				'title'   => esc_html__( 'Show social links in header', 'cherry' ),
				'section' => 'social_links',
				'default' => false,
				'field'   => 'checkbox',
				'type'    => 'control',
			),
			'footer_social_links' => array(
				'title'   => esc_html__( 'Show social links in footer', 'cherry' ),
				'section' => 'social_links',
				'default' => false,
				'field'   => 'checkbox',
				'type'    => 'control',
			),
			'blog_post_share_buttons' => array(
				'title'   => esc_html__( 'Show social sharing to blog posts', 'cherry' ),
				'section' => 'social_links',
				'default' => true,
				'field'   => 'checkbox',
				'type'    => 'control',
			),
			'single_post_share_buttons' => array(
				'title'   => esc_html__( 'Show social sharing to single blog post', 'cherry' ),
				'section' => 'social_links',
				'default' => true,
				'field'   => 'checkbox',
				'type'    => 'control',
			),

			/** `Page Layout` section */
			'page_layout' => array(
				'title'    => esc_html__( 'Page Layout', 'cherry' ),
				'priority' => 55,
				'type'     => 'section',
				'panel'    => 'general_settings',
			),
			'header_container_type' => array(
				'title'   => esc_html__( 'Header type', 'cherry' ),
				'section' => 'page_layout',
				'default' => 'boxed',
				'field'   => 'select',
				'choices' => array(
					'boxed'     => esc_html__( 'Boxed', 'cherry' ),
					'fullwidth' => esc_html__( 'Fullwidth', 'cherry' ),
				),
				'type' => 'control',
			),
			'content_container_type' => array(
				'title'   => esc_html__( 'Content type', 'cherry' ),
				'section' => 'page_layout',
				'default' => 'boxed',
				'field'   => 'select',
				'choices' => array(
					'boxed'     => esc_html__( 'Boxed', 'cherry' ),
					'fullwidth' => esc_html__( 'Fullwidth', 'cherry' ),
				),
				'type' => 'control',
			),
			'footer_container_type' => array(
				'title'   => esc_html__( 'Footer type', 'cherry' ),
				'section' => 'page_layout',
				'default' => 'boxed',
				'field'   => 'select',
				'choices' => array(
					'boxed'     => esc_html__( 'Boxed', 'cherry' ),
					'fullwidth' => esc_html__( 'Fullwidth', 'cherry' ),
				),
				'type' => 'control',
			),
			'container_width' => array(
				'title'       => esc_html__( 'Container width (px)', 'cherry' ),
				'section'     => 'page_layout',
				'default'     => 1300,
				'field'       => 'number',
				'input_attrs' => array(
					'min'  => 960,
					'max'  => 1920,
					'step' => 1,
				),
				'type' => 'control',
			),
			'sidebar_width' => array(
				'title'   => esc_html__( 'Sidebar width', 'cherry' ),
				'section' => 'page_layout',
				'default' => '1/3',
				'field'   => 'select',
				'choices' => array(
					'1/3' => '1/3',
					'1/4' => '1/4',
				),
				'sanitize_callback' => 'sanitize_text_field',
				'type'              => 'control',
			),
			'content_padding_top' => array(
				'title'       => esc_html__( 'Content padding top (px)', 'cherry' ),
				'section'     => 'page_layout',
				'default'     => 30,
				'field'       => 'number',
				'input_attrs' => array(
					'min'  => 0,
					'max'  => cherry_get_content_padding_max_value(),
					'step' => 1,
				),
				'type' => 'control',
			),
			'content_padding_bottom' => array(
				'title'       => esc_html__( 'Content padding bottom (px)', 'cherry' ),
				'section'     => 'page_layout',
				'default'     => 30,
				'field'       => 'number',
				'input_attrs' => array(
					'min'  => 0,
					'max'  => cherry_get_content_padding_max_value(),
					'step' => 1,
				),
				'type' => 'control',
			),

			/** `Color Scheme` panel */
			'color_scheme' => array(
				'title'       => esc_html__( 'Color Scheme', 'cherry' ),
				'description' => esc_html__( 'Configure Color Scheme', 'cherry' ),
				'priority'    => 40,
				'type'        => 'panel',
			),

			/** `Regular scheme` section */
			'regular_scheme' => array(
				'title'       => esc_html__( 'Regular scheme', 'cherry' ),
				'priority'    => 1,
				'panel'       => 'color_scheme',
				'type'        => 'section',
			),
			'regular_accent_color_1' => array(
				'title'   => esc_html__( 'Accent color (1)', 'cherry' ),
				'section' => 'regular_scheme',
				'default' => '#f62e46',
				'field'   => 'hex_color',
				'type'    => 'control',
			),
			'regular_accent_color_2' => array(
				'title'   => esc_html__( 'Accent color (2)', 'cherry' ),
				'section' => 'regular_scheme',
				'default' => '#3a3a3a',
				'field'   => 'hex_color',
				'type'    => 'control',
			),
			'regular_accent_color_3' => array(
				'title'   => esc_html__( 'Accent color (3)', 'cherry' ),
				'section' => 'regular_scheme',
				'default' => '#f0f0f0',
				'field'   => 'hex_color',
				'type'    => 'control',
			),
			'regular_accent_color_4' => array(
				'title'   => esc_html__( 'Accent color (4)', 'cherry' ),
				'section' => 'regular_scheme',
				'default' => '#2a445d',
				'field'   => 'hex_color',
				'type'    => 'control',
			),
			'regular_accent_color_5' => array(
				'title'   => esc_html__( 'Accent color (5)', 'cherry' ),
				'section' => 'regular_scheme',
				'default' => '#17c5cc',
				'field'   => 'hex_color',
				'type'    => 'control',
			),
			'regular_text_color' => array(
				'title'   => esc_html__( 'Text color', 'cherry' ),
				'section' => 'regular_scheme',
				'default' => '#777777',
				'field'   => 'hex_color',
				'type'    => 'control',
			),
			'regular_link_color' => array(
				'title'   => esc_html__( 'Link color', 'cherry' ),
				'section' => 'regular_scheme',
				'default' => '#f62e46',
				'field'   => 'hex_color',
				'type'    => 'control',
			),
			'regular_link_hover_color' => array(
				'title'   => esc_html__( 'Link hover color', 'cherry' ),
				'section' => 'regular_scheme',
				'default' => '#333333',
				'field'   => 'hex_color',
				'type'    => 'control',
			),
			'regular_h1_color' => array(
				'title'   => esc_html__( 'H1 color', 'cherry' ),
				'section' => 'regular_scheme',
				'default' => '#333333',
				'field'   => 'hex_color',
				'type'    => 'control',
			),
			'regular_h2_color' => array(
				'title'   => esc_html__( 'H2 color', 'cherry' ),
				'section' => 'regular_scheme',
				'default' => '#333333',
				'field'   => 'hex_color',
				'type'    => 'control',
			),
			'regular_h3_color' => array(
				'title'   => esc_html__( 'H3 color', 'cherry' ),
				'section' => 'regular_scheme',
				'default' => '#333333',
				'field'   => 'hex_color',
				'type'    => 'control',
			),
			'regular_h4_color' => array(
				'title'   => esc_html__( 'H4 color', 'cherry' ),
				'section' => 'regular_scheme',
				'default' => '#333333',
				'field'   => 'hex_color',
				'type'    => 'control',
			),
			'regular_h5_color' => array(
				'title'   => esc_html__( 'H5 color', 'cherry' ),
				'section' => 'regular_scheme',
				'default' => '#333333',
				'field'   => 'hex_color',
				'type'    => 'control',
			),
			'regular_h6_color' => array(
				'title'   => esc_html__( 'H6 color', 'cherry' ),
				'section' => 'regular_scheme',
				'default' => '#333333',
				'field'   => 'hex_color',
				'type'    => 'control',
			),

			/** `Invert scheme` section */
			'invert_scheme' => array(
				'title'       => esc_html__( 'Invert scheme', 'cherry' ),
				'priority'    => 1,
				'panel'       => 'color_scheme',
				'type'        => 'section',
			),
			'invert_accent_color_1' => array(
				'title'   => esc_html__( 'Accent color (1)', 'cherry' ),
				'section' => 'invert_scheme',
				'default' => '#fff',
				'field'   => 'hex_color',
				'type'    => 'control',
			),
			'invert_accent_color_2' => array(
				'title'   => esc_html__( 'Accent color (2)', 'cherry' ),
				'section' => 'invert_scheme',
				'default' => '#303043',
				'field'   => 'hex_color',
				'type'    => 'control',
			),
			'invert_accent_color_3' => array(
				'title'   => esc_html__( 'Accent color (3)', 'cherry' ),
				'section' => 'invert_scheme',
				'default' => '#fefefe',
				'field'   => 'hex_color',
				'type'    => 'control',
			),
			'invert_text_color' => array(
				'title'   => esc_html__( 'Text color', 'cherry' ),
				'section' => 'invert_scheme',
				'default' => '#fff',
				'field'   => 'hex_color',
				'type'    => 'control',
			),
			'invert_link_color' => array(
				'title'   => esc_html__( 'Link color', 'cherry' ),
				'section' => 'invert_scheme',
				'default' => '#fff',
				'field'   => 'hex_color',
				'type'    => 'control',
			),
			'invert_link_hover_color' => array(
				'title'   => esc_html__( 'Link hover color', 'cherry' ),
				'section' => 'invert_scheme',
				'default' => '#f62e46',
				'field'   => 'hex_color',
				'type'    => 'control',
			),
			'invert_h1_color' => array(
				'title'   => esc_html__( 'H1 color', 'cherry' ),
				'section' => 'invert_scheme',
				'default' => '#fff',
				'field'   => 'hex_color',
				'type'    => 'control',
			),
			'invert_h2_color' => array(
				'title'   => esc_html__( 'H2 color', 'cherry' ),
				'section' => 'invert_scheme',
				'default' => '#fff',
				'field'   => 'hex_color',
				'type'    => 'control',
			),
			'invert_h3_color' => array(
				'title'   => esc_html__( 'H3 color', 'cherry' ),
				'section' => 'invert_scheme',
				'default' => '#fff',
				'field'   => 'hex_color',
				'type'    => 'control',
			),
			'invert_h4_color' => array(
				'title'   => esc_html__( 'H4 color', 'cherry' ),
				'section' => 'invert_scheme',
				'default' => '#fff',
				'field'   => 'hex_color',
				'type'    => 'control',
			),
			'invert_h5_color' => array(
				'title'   => esc_html__( 'H5 color', 'cherry' ),
				'section' => 'invert_scheme',
				'default' => '#fff',
				'field'   => 'hex_color',
				'type'    => 'control',
			),
			'invert_h6_color' => array(
				'title'   => esc_html__( 'H6 color', 'cherry' ),
				'section' => 'invert_scheme',
				'default' => '#fff',
				'field'   => 'hex_color',
				'type'    => 'control',
			),

			/** `Typography Settings` panel */
			'typography' => array(
				'title'       => esc_html__( 'Typography', 'cherry' ),
				'description' => esc_html__( 'Configure typography settings', 'cherry' ),
				'priority'    => 45,
				'type'        => 'panel',
			),

			/** `Body text` section */
			'body_typography' => array(
				'title'       => esc_html__( 'Body text', 'cherry' ),
				'priority'    => 5,
				'panel'       => 'typography',
				'type'        => 'section',
			),
			'body_font_family' => array(
				'title'   => esc_html__( 'Font Family', 'cherry' ),
				'section' => 'body_typography',
				'default' => 'Raleway, sans-serif',
				'field'   => 'fonts',
				'type'    => 'control',
			),
			'body_font_style' => array(
				'title'   => esc_html__( 'Font Style', 'cherry' ),
				'section' => 'body_typography',
				'default' => 'normal',
				'field'   => 'select',
				'choices' => cherry_get_font_styles(),
				'type'    => 'control',
			),
			'body_font_weight' => array(
				'title'   => esc_html__( 'Font Weight', 'cherry' ),
				'section' => 'body_typography',
				'default' => '400',
				'field'   => 'select',
				'choices' => cherry_get_font_weight(),
				'type'    => 'control',
			),
			'body_font_size' => array(
				'title'       => esc_html__( 'Font Size, px', 'cherry' ),
				'section'     => 'body_typography',
				'default'     => '14',
				'field'       => 'number',
				'input_attrs' => array(
					'min'  => 6,
					'max'  => 50,
					'step' => 1,
				),
				'type' => 'control',
			),
			'body_line_height' => array(
				'title'       => esc_html__( 'Line Height', 'cherry' ),
				'description' => esc_html__( 'Relative to the font-size of the element', 'cherry' ),
				'section'     => 'body_typography',
				'default'     => '1.7',
				'field'       => 'number',
				'input_attrs' => array(
					'min'  => 1.0,
					'max'  => 3.0,
					'step' => 0.1,
				),
				'type' => 'control',
			),
			'body_letter_spacing' => array(
				'title'       => esc_html__( 'Letter Spacing, px', 'cherry' ),
				'section'     => 'body_typography',
				'default'     => '0',
				'field'       => 'number',
				'input_attrs' => array(
					'min'  => -10,
					'max'  => 10,
					'step' => 1,
				),
				'type' => 'control',
			),
			'body_character_set' => array(
				'title'   => esc_html__( 'Character Set', 'cherry' ),
				'section' => 'body_typography',
				'default' => 'latin',
				'field'   => 'select',
				'choices' => cherry_get_character_sets(),
				'type'    => 'control',
			),
			'body_text_align' => array(
				'title'   => esc_html__( 'Text Align', 'cherry' ),
				'section' => 'body_typography',
				'default' => 'left',
				'field'   => 'select',
				'choices' => cherry_get_text_aligns(),
				'type'    => 'control',
			),

			/** `H1 Heading` section */
			'h1_typography' => array(
				'title'       => esc_html__( 'H1 Heading', 'cherry' ),
				'priority'    => 10,
				'panel'       => 'typography',
				'type'        => 'section',
			),
			'h1_font_family' => array(
				'title'   => esc_html__( 'Font Family', 'cherry' ),
				'section' => 'h1_typography',
				'default' => 'Raleway, sans-serif',
				'field'   => 'fonts',
				'type'    => 'control',
			),
			'h1_font_style' => array(
				'title'   => esc_html__( 'Font Style', 'cherry' ),
				'section' => 'h1_typography',
				'default' => 'normal',
				'field'   => 'select',
				'choices' => cherry_get_font_styles(),
				'type'    => 'control',
			),
			'h1_font_weight' => array(
				'title'   => esc_html__( 'Font Weight', 'cherry' ),
				'section' => 'h1_typography',
				'default' => '600',
				'field'   => 'select',
				'choices' => cherry_get_font_weight(),
				'type'    => 'control',
			),
			'h1_font_size' => array(
				'title'       => esc_html__( 'Font Size, px', 'cherry' ),
				'section'     => 'h1_typography',
				'default'     => '40',
				'field'       => 'number',
				'input_attrs' => array(
					'min'  => 10,
					'max'  => 200,
					'step' => 1,
				),
				'type' => 'control',
			),
			'h1_line_height' => array(
				'title'       => esc_html__( 'Line Height', 'cherry' ),
				'description' => esc_html__( 'Relative to the font-size of the element', 'cherry' ),
				'section'     => 'h1_typography',
				'default'     => '1.1',
				'field'       => 'number',
				'input_attrs' => array(
					'min'  => 1.0,
					'max'  => 3.0,
					'step' => 0.1,
				),
				'type' => 'control',
			),
			'h1_letter_spacing' => array(
				'title'       => esc_html__( 'Letter Spacing, px', 'cherry' ),
				'section'     => 'h1_typography',
				'default'     => '0',
				'field'       => 'number',
				'input_attrs' => array(
					'min'  => -10,
					'max'  => 10,
					'step' => 1,
				),
				'type' => 'control',
			),
			'h1_character_set' => array(
				'title'   => esc_html__( 'Character Set', 'cherry' ),
				'section' => 'h1_typography',
				'default' => 'latin',
				'field'   => 'select',
				'choices' => cherry_get_character_sets(),
				'type'    => 'control',
			),
			'h1_text_align' => array(
				'title'   => esc_html__( 'Text Align', 'cherry' ),
				'section' => 'h1_typography',
				'default' => 'inherit',
				'field'   => 'select',
				'choices' => cherry_get_text_aligns(),
				'type'    => 'control',
			),

			/** `H2 Heading` section */
			'h2_typography' => array(
				'title'       => esc_html__( 'H2 Heading', 'cherry' ),
				'priority'    => 15,
				'panel'       => 'typography',
				'type'        => 'section',
			),
			'h2_font_family' => array(
				'title'   => esc_html__( 'Font Family', 'cherry' ),
				'section' => 'h2_typography',
				'default' => 'Raleway, sans-serif',
				'field'   => 'fonts',
				'type'    => 'control',
			),
			'h2_font_style' => array(
				'title'   => esc_html__( 'Font Style', 'cherry' ),
				'section' => 'h2_typography',
				'default' => 'normal',
				'field'   => 'select',
				'choices' => cherry_get_font_styles(),
				'type'    => 'control',
			),
			'h2_font_weight' => array(
				'title'   => esc_html__( 'Font Weight', 'cherry' ),
				'section' => 'h2_typography',
				'default' => '600',
				'field'   => 'select',
				'choices' => cherry_get_font_weight(),
				'type'    => 'control',
			),
			'h2_font_size' => array(
				'title'       => esc_html__( 'Font Size, px', 'cherry' ),
				'section'     => 'h2_typography',
				'default'     => '35',
				'field'       => 'number',
				'input_attrs' => array(
					'min'  => 10,
					'max'  => 200,
					'step' => 1,
				),
				'type' => 'control',
			),
			'h2_line_height' => array(
				'title'       => esc_html__( 'Line Height', 'cherry' ),
				'description' => esc_html__( 'Relative to the font-size of the element', 'cherry' ),
				'section'     => 'h2_typography',
				'default'     => '1.1',
				'field'       => 'number',
				'input_attrs' => array(
					'min'  => 1.0,
					'max'  => 3.0,
					'step' => 0.1,
				),
				'type' => 'control',
			),
			'h2_letter_spacing' => array(
				'title'       => esc_html__( 'Letter Spacing, px', 'cherry' ),
				'section'     => 'h2_typography',
				'default'     => '0',
				'field'       => 'number',
				'input_attrs' => array(
					'min'  => -10,
					'max'  => 10,
					'step' => 1,
				),
				'type' => 'control',
			),
			'h2_character_set' => array(
				'title'   => esc_html__( 'Character Set', 'cherry' ),
				'section' => 'h2_typography',
				'default' => 'latin',
				'field'   => 'select',
				'choices' => cherry_get_character_sets(),
				'type'    => 'control',
			),
			'h2_text_align' => array(
				'title'   => esc_html__( 'Text Align', 'cherry' ),
				'section' => 'h2_typography',
				'default' => 'inherit',
				'field'   => 'select',
				'choices' => cherry_get_text_aligns(),
				'type'    => 'control',
			),

			/** `H3 Heading` section */
			'h3_typography' => array(
				'title'       => esc_html__( 'H3 Heading', 'cherry' ),
				'priority'    => 20,
				'panel'       => 'typography',
				'type'        => 'section',
			),
			'h3_font_family' => array(
				'title'   => esc_html__( 'Font Family', 'cherry' ),
				'section' => 'h3_typography',
				'default' => 'Raleway, sans-serif',
				'field'   => 'fonts',
				'type'    => 'control',
			),
			'h3_font_style' => array(
				'title'   => esc_html__( 'Font Style', 'cherry' ),
				'section' => 'h3_typography',
				'default' => 'normal',
				'field'   => 'select',
				'choices' => cherry_get_font_styles(),
				'type'    => 'control',
			),
			'h3_font_weight' => array(
				'title'   => esc_html__( 'Font Weight', 'cherry' ),
				'section' => 'h3_typography',
				'default' => '600',
				'field'   => 'select',
				'choices' => cherry_get_font_weight(),
				'type'    => 'control',
			),
			'h3_font_size' => array(
				'title'       => esc_html__( 'Font Size, px', 'cherry' ),
				'section'     => 'h3_typography',
				'default'     => '30',
				'field'       => 'number',
				'input_attrs' => array(
					'min'  => 10,
					'max'  => 200,
					'step' => 1,
				),
				'type' => 'control',
			),
			'h3_line_height' => array(
				'title'       => esc_html__( 'Line Height', 'cherry' ),
				'description' => esc_html__( 'Relative to the font-size of the element', 'cherry' ),
				'section'     => 'h3_typography',
				'default'     => '1.2',
				'field'       => 'number',
				'input_attrs' => array(
					'min'  => 1.0,
					'max'  => 3.0,
					'step' => 0.1,
				),
				'type' => 'control',
			),
			'h3_letter_spacing' => array(
				'title'       => esc_html__( 'Letter Spacing, px', 'cherry' ),
				'section'     => 'h3_typography',
				'default'     => '0',
				'field'       => 'number',
				'input_attrs' => array(
					'min'  => -10,
					'max'  => 10,
					'step' => 1,
				),
				'type' => 'control',
			),
			'h3_character_set' => array(
				'title'   => esc_html__( 'Character Set', 'cherry' ),
				'section' => 'h3_typography',
				'default' => 'latin',
				'field'   => 'select',
				'choices' => cherry_get_character_sets(),
				'type'    => 'control',
			),
			'h3_text_align' => array(
				'title'   => esc_html__( 'Text Align', 'cherry' ),
				'section' => 'h3_typography',
				'default' => 'inherit',
				'field'   => 'select',
				'choices' => cherry_get_text_aligns(),
				'type'    => 'control',
			),

			/** `H4 Heading` section */
			'h4_typography' => array(
				'title'       => esc_html__( 'H4 Heading', 'cherry' ),
				'priority'    => 25,
				'panel'       => 'typography',
				'type'        => 'section',
			),
			'h4_font_family' => array(
				'title'   => esc_html__( 'Font Family', 'cherry' ),
				'section' => 'h4_typography',
				'default' => 'Raleway, sans-serif',
				'field'   => 'fonts',
				'type'    => 'control',
			),
			'h4_font_style' => array(
				'title'   => esc_html__( 'Font Style', 'cherry' ),
				'section' => 'h4_typography',
				'default' => 'normal',
				'field'   => 'select',
				'choices' => cherry_get_font_styles(),
				'type'    => 'control',
			),
			'h4_font_weight' => array(
				'title'   => esc_html__( 'Font Weight', 'cherry' ),
				'section' => 'h4_typography',
				'default' => '600',
				'field'   => 'select',
				'choices' => cherry_get_font_weight(),
				'type'    => 'control',
			),
			'h4_font_size' => array(
				'title'       => esc_html__( 'Font Size, px', 'cherry' ),
				'section'     => 'h4_typography',
				'default'     => '25',
				'field'       => 'number',
				'input_attrs' => array(
					'min'  => 10,
					'max'  => 200,
					'step' => 1,
				),
				'type' => 'control',
			),
			'h4_line_height' => array(
				'title'       => esc_html__( 'Line Height', 'cherry' ),
				'description' => esc_html__( 'Relative to the font-size of the element', 'cherry' ),
				'section'     => 'h4_typography',
				'default'     => '1.3',
				'field'       => 'number',
				'input_attrs' => array(
					'min'  => 1.0,
					'max'  => 3.0,
					'step' => 0.1,
				),
				'type' => 'control',
			),
			'h4_letter_spacing' => array(
				'title'       => esc_html__( 'Letter Spacing, px', 'cherry' ),
				'section'     => 'h4_typography',
				'default'     => '0',
				'field'       => 'number',
				'input_attrs' => array(
					'min'  => -10,
					'max'  => 10,
					'step' => 1,
				),
				'type' => 'control',
			),
			'h4_character_set' => array(
				'title'   => esc_html__( 'Character Set', 'cherry' ),
				'section' => 'h4_typography',
				'default' => 'latin',
				'field'   => 'select',
				'choices' => cherry_get_character_sets(),
				'type'    => 'control',
			),
			'h4_text_align' => array(
				'title'   => esc_html__( 'Text Align', 'cherry' ),
				'section' => 'h4_typography',
				'default' => 'inherit',
				'field'   => 'select',
				'choices' => cherry_get_text_aligns(),
				'type'    => 'control',
			),

			/** `H5 Heading` section */
			'h5_typography' => array(
				'title'       => esc_html__( 'H5 Heading', 'cherry' ),
				'priority'    => 30,
				'panel'       => 'typography',
				'type'        => 'section',
			),
			'h5_font_family' => array(
				'title'   => esc_html__( 'Font Family', 'cherry' ),
				'section' => 'h5_typography',
				'default' => 'Raleway, sans-serif',
				'field'   => 'fonts',
				'type'    => 'control',
			),
			'h5_font_style' => array(
				'title'   => esc_html__( 'Font Style', 'cherry' ),
				'section' => 'h5_typography',
				'default' => 'normal',
				'field'   => 'select',
				'choices' => cherry_get_font_styles(),
				'type'    => 'control',
			),
			'h5_font_weight' => array(
				'title'   => esc_html__( 'Font Weight', 'cherry' ),
				'section' => 'h5_typography',
				'default' => '600',
				'field'   => 'select',
				'choices' => cherry_get_font_weight(),
				'type'    => 'control',
			),
			'h5_font_size' => array(
				'title'       => esc_html__( 'Font Size, px', 'cherry' ),
				'section'     => 'h5_typography',
				'default'     => '20',
				'field'       => 'number',
				'input_attrs' => array(
					'min'  => 10,
					'max'  => 200,
					'step' => 1,
				),
				'type' => 'control',
			),
			'h5_line_height' => array(
				'title'       => esc_html__( 'Line Height', 'cherry' ),
				'description' => esc_html__( 'Relative to the font-size of the element', 'cherry' ),
				'section'     => 'h5_typography',
				'default'     => '1.4',
				'field'       => 'number',
				'input_attrs' => array(
					'min'  => 1.0,
					'max'  => 3.0,
					'step' => 0.1,
				),
				'type' => 'control',
			),
			'h5_letter_spacing' => array(
				'title'       => esc_html__( 'Letter Spacing, px', 'cherry' ),
				'section'     => 'h5_typography',
				'default'     => '0',
				'field'       => 'number',
				'input_attrs' => array(
					'min'  => -10,
					'max'  => 10,
					'step' => 1,
				),
				'type' => 'control',
			),
			'h5_character_set' => array(
				'title'   => esc_html__( 'Character Set', 'cherry' ),
				'section' => 'h5_typography',
				'default' => 'latin',
				'field'   => 'select',
				'choices' => cherry_get_character_sets(),
				'type'    => 'control',
			),
			'h5_text_align' => array(
				'title'   => esc_html__( 'Text Align', 'cherry' ),
				'section' => 'h5_typography',
				'default' => 'inherit',
				'field'   => 'select',
				'choices' => cherry_get_text_aligns(),
				'type'    => 'control',
			),

			/** `H6 Heading` section */
			'h6_typography' => array(
				'title'       => esc_html__( 'H6 Heading', 'cherry' ),
				'priority'    => 35,
				'panel'       => 'typography',
				'type'        => 'section',
			),
			'h6_font_family' => array(
				'title'   => esc_html__( 'Font Family', 'cherry' ),
				'section' => 'h6_typography',
				'default' => 'Raleway, sans-serif',
				'field'   => 'fonts',
				'type'    => 'control',
			),
			'h6_font_style' => array(
				'title'   => esc_html__( 'Font Style', 'cherry' ),
				'section' => 'h6_typography',
				'default' => 'normal',
				'field'   => 'select',
				'choices' => cherry_get_font_styles(),
				'type'    => 'control',
			),
			'h6_font_weight' => array(
				'title'   => esc_html__( 'Font Weight', 'cherry' ),
				'section' => 'h6_typography',
				'default' => '600',
				'field'   => 'select',
				'choices' => cherry_get_font_weight(),
				'type'    => 'control',
			),
			'h6_font_size' => array(
				'title'       => esc_html__( 'Font Size, px', 'cherry' ),
				'section'     => 'h6_typography',
				'default'     => '15',
				'field'       => 'number',
				'input_attrs' => array(
					'min'  => 10,
					'max'  => 200,
					'step' => 1,
				),
				'type' => 'control',
			),
			'h6_line_height' => array(
				'title'       => esc_html__( 'Line Height', 'cherry' ),
				'description' => esc_html__( 'Relative to the font-size of the element', 'cherry' ),
				'section'     => 'h6_typography',
				'default'     => '1.4',
				'field'       => 'number',
				'input_attrs' => array(
					'min'  => 1.0,
					'max'  => 3.0,
					'step' => 0.1,
				),
				'type' => 'control',
			),
			'h6_letter_spacing' => array(
				'title'       => esc_html__( 'Letter Spacing, px', 'cherry' ),
				'section'     => 'h6_typography',
				'default'     => '0',
				'field'       => 'number',
				'input_attrs' => array(
					'min'  => -10,
					'max'  => 10,
					'step' => 1,
				),
				'type' => 'control',
			),
			'h6_character_set' => array(
				'title'   => esc_html__( 'Character Set', 'cherry' ),
				'section' => 'h6_typography',
				'default' => 'latin',
				'field'   => 'select',
				'choices' => cherry_get_character_sets(),
				'type'    => 'control',
			),
			'h6_text_align' => array(
				'title'   => esc_html__( 'Text Align', 'cherry' ),
				'section' => 'h6_typography',
				'default' => 'inherit',
				'field'   => 'select',
				'choices' => cherry_get_text_aligns(),
				'type'    => 'control',
			),

			/** `Breadcrumbs` section */
			'breadcrumbs_typography' => array(
				'title'       => esc_html__( 'Breadcrumbs', 'cherry' ),
				'priority'    => 45,
				'panel'       => 'typography',
				'type'        => 'section',
			),
			'breadcrumbs_font_family' => array(
				'title'   => esc_html__( 'Font Family', 'cherry' ),
				'section' => 'breadcrumbs_typography',
				'default' => 'Raleway, sans-serif',
				'field'   => 'fonts',
				'type'    => 'control',
			),
			'breadcrumbs_font_style' => array(
				'title'   => esc_html__( 'Font Style', 'cherry' ),
				'section' => 'breadcrumbs_typography',
				'default' => 'normal',
				'field'   => 'select',
				'choices' => cherry_get_font_styles(),
				'type'    => 'control',
			),
			'breadcrumbs_font_weight' => array(
				'title'   => esc_html__( 'Font Weight', 'cherry' ),
				'section' => 'breadcrumbs_typography',
				'default' => '400',
				'field'   => 'select',
				'choices' => cherry_get_font_weight(),
				'type'    => 'control',
			),
			'breadcrumbs_font_size' => array(
				'title'       => esc_html__( 'Font Size, px', 'cherry' ),
				'section'     => 'breadcrumbs_typography',
				'default'     => '12',
				'field'       => 'number',
				'input_attrs' => array(
					'min'  => 6,
					'max'  => 50,
					'step' => 1,
				),
				'type' => 'control',
			),
			'breadcrumbs_line_height' => array(
				'title'       => esc_html__( 'Line Height', 'cherry' ),
				'description' => esc_html__( 'Relative to the font-size of the element', 'cherry' ),
				'section'     => 'breadcrumbs_typography',
				'default'     => '1.5',
				'field'       => 'number',
				'input_attrs' => array(
					'min'  => 1.0,
					'max'  => 3.0,
					'step' => 0.1,
				),
				'type' => 'control',
			),
			'breadcrumbs_letter_spacing' => array(
				'title'       => esc_html__( 'Letter Spacing, px', 'cherry' ),
				'section'     => 'breadcrumbs_typography',
				'default'     => '0',
				'field'       => 'number',
				'input_attrs' => array(
					'min'  => -10,
					'max'  => 10,
					'step' => 1,
				),
				'type' => 'control',
			),
			'breadcrumbs_character_set' => array(
				'title'   => esc_html__( 'Character Set', 'cherry' ),
				'section' => 'breadcrumbs_typography',
				'default' => 'latin',
				'field'   => 'select',
				'choices' => cherry_get_character_sets(),
				'type'    => 'control',
			),

			/** `Header` panel */
			'header_options' => array(
				'title'       => esc_html__( 'Header', 'cherry' ),
				'priority'    => 60,
				'type'        => 'panel',
			),

			/** `Header styles` section */
			'header_styles' => array(
				'title'       => esc_html__( 'Styles', 'cherry' ),
				'priority'    => 5,
				'panel'       => 'header_options',
				'type'        => 'section',
			),
			'header_layout_type' => array(
				'title'   => esc_html__( 'Layout', 'cherry' ),
				'section' => 'header_styles',
				'default' => 'minimal',
				'field'   => 'select',
				'choices' => cherry_get_header_layout_options(),
				'type' => 'control',
			),
			'header_invert_textcolorscheme' => array(
				'title'           => esc_html__( 'Invert text colorscheme', 'cherry' ),
				'section'         => 'header_styles',
				'default'         => false,
				'field'           => 'checkbox',
				'type'            => 'control',
				'active_callback' => 'cherry_is_transparent_header_layout_type',
			),
			'header_bg_color' => array(
				'title'           => esc_html__( 'Background Color', 'cherry' ),
				'section'         => 'header_styles',
				'field'           => 'hex_color',
				'default'         => '#ffffff',
				'type'            => 'control',
				'active_callback' => 'cherry_is_not_transparent_header_layout_type',
			),
			'header_bg_image' => array(
				'title'   => esc_html__( 'Background Image', 'cherry' ),
				'section' => 'header_styles',
				'field'   => 'image',
				'type'    => 'control',
				'active_callback' => 'cherry_is_not_transparent_header_layout_type',
			),
			'header_bg_repeat' => array(
				'title'   => esc_html__( 'Background Repeat', 'cherry' ),
				'section' => 'header_styles',
				'default' => 'repeat',
				'field'   => 'select',
				'choices' => array(
					'no-repeat'  => esc_html__( 'No Repeat', 'cherry' ),
					'repeat'     => esc_html__( 'Tile', 'cherry' ),
					'repeat-x'   => esc_html__( 'Tile Horizontally', 'cherry' ),
					'repeat-y'   => esc_html__( 'Tile Vertically', 'cherry' ),
				),
				'type' => 'control',
				'active_callback' => 'cherry_is_not_transparent_header_layout_type',
			),
			'header_bg_position_x' => array(
				'title'   => esc_html__( 'Background Position', 'cherry' ),
				'section' => 'header_styles',
				'default' => 'center',
				'field'   => 'select',
				'choices' => array(
					'left'   => esc_html__( 'Left', 'cherry' ),
					'center' => esc_html__( 'Center', 'cherry' ),
					'right'  => esc_html__( 'Right', 'cherry' ),
				),
				'type' => 'control',
				'active_callback' => 'cherry_is_not_transparent_header_layout_type',
			),
			'header_bg_attachment' => array(
				'title'   => esc_html__( 'Background Attachment', 'cherry' ),
				'section' => 'header_styles',
				'default' => 'scroll',
				'field'   => 'select',
				'choices' => array(
					'scroll' => esc_html__( 'Scroll', 'cherry' ),
					'fixed'  => esc_html__( 'Fixed', 'cherry' ),
				),
				'type' => 'control',
				'active_callback' => 'cherry_is_not_transparent_header_layout_type',
			),

			/** `Top Panel` section */
			'header_top_panel' => array(
				'title'       => esc_html__( 'Top Panel', 'cherry' ),
				'priority'    => 10,
				'panel'       => 'header_options',
				'type'        => 'section',
			),
			'top_panel_text' => array(
				'title'       => esc_html__( 'Disclaimer Text', 'cherry' ),
				'description' => esc_html__( 'HTML formatting support', 'cherry' ),
				'section'     => 'header_top_panel',
				'default'     => cherry_get_default_top_panel_text(),
				'field'       => 'textarea',
				'type'        => 'control',
			),
			'top_panel_search' => array(
				'title'   => esc_html__( 'Enable search', 'cherry' ),
				'section' => 'header_top_panel',
				'default' => false,
				'field'   => 'checkbox',
				'type'    => 'control',
			),
			'top_panel_bg' => array(
				'title'   => esc_html__( 'Background color', 'cherry' ),
				'section' => 'header_top_panel',
				'default' => '#fff',
				'field'   => 'hex_color',
				'type'    => 'control',
			),

			/** `Main Menu` section */
			'header_main_menu' => array(
				'title'       => esc_html__( 'Main Menu', 'cherry' ),
				'priority'    => 15,
				'panel'       => 'header_options',
				'type'        => 'section',
			),
			'header_menu_sticky' => array(
				'title'   => esc_html__( 'Enable sticky menu', 'cherry' ),
				'section' => 'header_main_menu',
				'default' => false,
				'field'   => 'checkbox',
				'type'    => 'control',
			),
			'header_menu_attributes' => array(
				'title'   => esc_html__( 'Enable title attributes', 'cherry' ),
				'section' => 'header_main_menu',
				'default' => true,
				'field'   => 'checkbox',
				'type'    => 'control',
			),

			/** `Sidebar` section */
			'sidebar_settings' => array(
				'title'    => esc_html__( 'Sidebar', 'cherry' ),
				'priority' => 105,
				'type'     => 'section',
			),
			'sidebar_position' => array(
				'title'   => esc_html__( 'Sidebar Position', 'cherry' ),
				'section' => 'sidebar_settings',
				'default' => 'one-right-sidebar',
				'field'   => 'select',
				'choices' => array(
					'one-left-sidebar'  => esc_html__( 'Sidebar on left side', 'cherry' ),
					'one-right-sidebar' => esc_html__( 'Sidebar on right side', 'cherry' ),
					'fullwidth'         => esc_html__( 'No sidebars', 'cherry' ),
				),
				'type' => 'control',
			),

			/** `MailChimp` section */
			'mailchimp' => array(
				'title'       => esc_html__( 'MailChimp', 'cherry' ),
				'description' => esc_html__( 'Setup MailChimp settings for subscribe widget', 'cherry' ),
				'priority'    => 109,
				'type'        => 'section',
			),
			'mailchimp_api_key' => array(
				'title'   => esc_html__( 'MailChimp API key', 'cherry' ),
				'section' => 'mailchimp',
				'field'   => 'text',
				'type'    => 'control',
				'default' => '0fabd7822dcc3cb8547dcf9109750d92-us10',
			),
			'mailchimp_list_id' => array(
				'title'   => esc_html__( 'MailChimp list ID', 'cherry' ),
				'section' => 'mailchimp',
				'field'   => 'text',
				'type'    => 'control',
				'default' => '2a6603b219',
			),

			/** `Ads Management` panel */
			'ads_management' => array(
				'title'    => esc_html__( 'Ads Management', 'cherry' ),
				'priority' => 110,
				'type'     => 'section',
			),
			'ads_header' => array(
				'title'             => esc_html__( 'Header', 'cherry' ),
				'section'           => 'ads_management',
				'field'             => 'textarea',
				'default'           => '',
				'sanitize_callback' => 'esc_html',
				'type'              => 'control',
			),
			'ads_home_before_loop' => array(
				'title'             => esc_html__( 'Front Page Before Loop', 'cherry' ),
				'section'           => 'ads_management',
				'field'             => 'textarea',
				'default'           => '',
				'sanitize_callback' => 'esc_html',
				'type'              => 'control',
			),
			'ads_post_before_content' => array(
				'title'             => esc_html__( 'Post Before Content', 'cherry' ),
				'section'           => 'ads_management',
				'field'             => 'textarea',
				'default'           => '',
				'sanitize_callback' => 'esc_html',
				'type'              => 'control',
			),
			'ads_post_before_comments' => array(
				'title'             => esc_html__( 'Post Before Comments', 'cherry' ),
				'section'           => 'ads_management',
				'field'             => 'textarea',
				'default'           => '',
				'sanitize_callback' => 'esc_html',
				'type'              => 'control',
			),

			/** `Footer` panel */
			'footer_options' => array(
				'title'    => esc_html__( 'Footer', 'cherry' ),
				'priority' => 110,
				'type'     => 'section',
			),
			'footer_logo_url' => array(
				'title'   => esc_html__( 'Logo upload', 'cherry' ),
				'section' => 'footer_options',
				'field'   => 'image',
				'default' => '',
				'type'    => 'control',
			),
			'footer_copyright' => array(
				'title'   => esc_html__( 'Copyright text', 'cherry' ),
				'section' => 'footer_options',
				'default' => cherry_get_default_footer_copyright(),
				'field'   => 'textarea',
				'type'    => 'control',
			),
			'footer_widget_columns' => array(
				'title'   => esc_html__( 'Widget Area Columns', 'cherry' ),
				'section' => 'footer_options',
				'default' => '4',
				'field'   => 'select',
				'choices' => array(
					'1' => '1',
					'2' => '2',
					'3' => '3',
					'4' => '4',
				),
				'type' => 'control'
			),
			'footer_layout_type' => array(
				'title'   => esc_html__( 'Layout', 'cherry' ),
				'section' => 'footer_options',
				'default' => 'centered',
				'field'   => 'select',
				'choices' => array(
					'default'  => esc_html__( 'Style 1', 'cherry' ),
					'centered' => esc_html__( 'Style 2', 'cherry' ),
					'minimal'  => esc_html__( 'Style 3', 'cherry' ),
				),
				'type' => 'control'
			),
			'footer_widgets_bg' => array(
				'title'   => esc_html__( 'Footer Widgets Area color', 'cherry' ),
				'section' => 'footer_options',
				'default' => '#303043',
				'field'   => 'hex_color',
				'type'    => 'control',
			),
			'footer_bg' => array(
				'title'   => esc_html__( 'Footer Background color', 'cherry' ),
				'section' => 'footer_options',
				'default' => '#fff',
				'field'   => 'hex_color',
				'type'    => 'control',
			),

			/** `Blog Settings` panel */
			'blog_settings' => array(
				'title'       => esc_html__( 'Blog Settings', 'cherry' ),
				'priority'    => 115,
				'type'        => 'panel',
			),

			/** `Blog` section */
			'blog' => array(
				'title'           => esc_html__( 'Blog', 'cherry' ),
				'panel'           => 'blog_settings',
				'priority'        => 10,
				'type'            => 'section',
				'active_callback' => 'is_home',
			),
			'blog_layout_type' => array(
				'title'   => esc_html__( 'Layout', 'cherry' ),
				'section' => 'blog',
				'default' => 'default',
				'field'   => 'select',
				'choices' => array(
					'default'          => esc_html__( 'Listing', 'cherry' ),
					'grid-2-cols'      => esc_html__( 'Grid (2 Columns)', 'cherry' ),
					'grid-3-cols'      => esc_html__( 'Grid (3 Columns)', 'cherry' ),
					'masonry-2-cols'   => esc_html__( 'Masonry (2 Columns)', 'cherry' ),
					'masonry-3-cols'   => esc_html__( 'Masonry (3 Columns)', 'cherry' ),
					'vertical-justify' => esc_html__( 'Vertical Justify', 'cherry' ),
				),
				'type' => 'control',
			),
			'blog_sticky_type' => array(
				'title'   => esc_html__( 'Sticky label type', 'cherry' ),
				'section' => 'blog',
				'default' => 'icon',
				'field'   => 'select',
				'choices' => array(
					'label' => esc_html__( 'Text Label', 'cherry' ),
					'icon'  => esc_html__( 'Font Icon', 'cherry' ),
					'both'  => esc_html__( 'Text with Icon', 'cherry' ),
				),
				'type' => 'control',
			),
			'blog_sticky_icon' => array(
				'title'           => esc_html__( 'Icon for sticky post', 'cherry' ),
				'section'         => 'blog',
				'field'           => 'iconpicker',
				'default'         => 'fa-star-o',
				'icon_data'       => array(
					'icon_set'    => 'cherryTeamFontAwesome',
					'icon_css'    => get_template_directory_uri() . '/assets/css/font-awesome.min.css',
					'icon_base'   => 'fa',
					'icon_prefix' => 'fa-',
					'icons'       => cherry_get_icons_set(),
				),
				'type'            => 'control',
				'active_callback' => 'cherry_is_sticky_icon',
			),
			'blog_sticky_label' => array(
				'title'           => esc_html__( 'Featured Post Label', 'cherry' ),
				'description'     => esc_html__( 'Label for sticky post', 'cherry' ),
				'section'         => 'blog',
				'default'         => esc_html__( 'Featured', 'cherry' ),
				'field'           => 'text',
				'active_callback' => 'cherry_is_sticky_text',
				'type'            => 'control',
			),
			'blog_posts_content' => array(
				'title'   => esc_html__( 'Post content', 'cherry' ),
				'section' => 'blog',
				'default' => 'excerpt',
				'field'   => 'select',
				'choices' => array(
					'excerpt' => esc_html__( 'Only excerpt', 'cherry' ),
					'full'    => esc_html__( 'Full content', 'cherry' ),
				),
				'type' => 'control',
			),
			'blog_featured_image' => array(
				'title'   => esc_html__( 'Featured image', 'cherry' ),
				'section' => 'blog',
				'default' => 'fullwidth',
				'field'   => 'select',
				'choices' => array(
					'small'     => esc_html__( 'Small', 'cherry' ),
					'fullwidth' => esc_html__( 'Fullwidth', 'cherry' ),
				),
				'type' => 'control',
			),
			'blog_read_more_text' => array(
				'title'   => esc_html__( 'Read More button text', 'cherry' ),
				'section' => 'blog',
				'default' => esc_html__( 'More', 'cherry' ),
				'field'   => 'text',
				'type'    => 'control',
			),
			'blog_post_author' => array(
				'title'   => esc_html__( 'Show post author', 'cherry' ),
				'section' => 'blog',
				'default' => true,
				'field'   => 'checkbox',
				'type'    => 'control',
			),
			'blog_post_publish_date' => array(
				'title'   => esc_html__( 'Show publish date', 'cherry' ),
				'section' => 'blog',
				'default' => true,
				'field'   => 'checkbox',
				'type'    => 'control',
			),
			'blog_post_categories' => array(
				'title'   => esc_html__( 'Show categories', 'cherry' ),
				'section' => 'blog',
				'default' => true,
				'field'   => 'checkbox',
				'type'    => 'control',
			),
			'blog_post_tags' => array(
				'title'   => esc_html__( 'Show tags', 'cherry' ),
				'section' => 'blog',
				'default' => true,
				'field'   => 'checkbox',
				'type'    => 'control',
			),
			'blog_post_comments' => array(
				'title'   => esc_html__( 'Show comments', 'cherry' ),
				'section' => 'blog',
				'default' => true,
				'field'   => 'checkbox',
				'type'    => 'control',
			),

			/** `Post` section */
			'blog_post' => array(
				'title'           => esc_html__( 'Post', 'cherry' ),
				'panel'           => 'blog_settings',
				'priority'        => 20,
				'type'            => 'section',
				'active_callback' => 'callback_single',
			),
			'single_post_author' => array(
				'title'   => esc_html__( 'Show post author', 'cherry' ),
				'section' => 'blog_post',
				'default' => true,
				'field'   => 'checkbox',
				'type'    => 'control',
			),
			'single_post_publish_date' => array(
				'title'   => esc_html__( 'Show publish date', 'cherry' ),
				'section' => 'blog_post',
				'default' => true,
				'field'   => 'checkbox',
				'type'    => 'control',
			),
			'single_post_categories' => array(
				'title'   => esc_html__( 'Show categories', 'cherry' ),
				'section' => 'blog_post',
				'default' => true,
				'field'   => 'checkbox',
				'type'    => 'control',
			),
			'single_post_tags' => array(
				'title'   => esc_html__( 'Show tags', 'cherry' ),
				'section' => 'blog_post',
				'default' => true,
				'field'   => 'checkbox',
				'type'    => 'control',
			),
			'single_post_comments' => array(
				'title'   => esc_html__( 'Show comments', 'cherry' ),
				'section' => 'blog_post',
				'default' => true,
				'field'   => 'checkbox',
				'type'    => 'control',
			),
			'single_author_block' => array(
				'title'   => esc_html__( 'Enable the author block after each post', 'cherry' ),
				'section' => 'blog_post',
				'default' => true,
				'field'   => 'checkbox',
				'type'    => 'control',
			),

			/** `Related Posts` section */
			'related_posts' => array(
				'title'           => esc_html__( 'Related posts block', 'cherry' ),
				'panel'           => 'blog_settings',
				'priority'        => 30,
				'type'            => 'section',
				'active_callback' => 'callback_single',
			),
			'related_posts_visible' => array(
				'title'   => esc_html__( 'Show related posts block', 'cherry' ),
				'section' => 'related_posts',
				'default' => true,
				'field'   => 'checkbox',
				'type'    => 'control',
			),
			'related_posts_block_title' => array(
				'title'   => esc_html__( 'Related posts block title', 'cherry' ),
				'section' => 'related_posts',
				'default' => esc_html__( 'Related Posts', 'cherry' ),
				'field'   => 'text',
				'type'    => 'control',
			),
			'related_posts_count' => array(
				'title'   => esc_html__( 'Number of post', 'cherry' ),
				'section' => 'related_posts',
				'default' => '4',
				'field'   => 'text',
				'type'    => 'control',
			),
			'related_posts_grid' => array(
				'title'   => esc_html__( 'Layout', 'cherry' ),
				'section' => 'related_posts',
				'default' => '4',
				'field'   => 'select',
				'choices' => array(
					'2'        => esc_html__( '2 columns', 'cherry' ),
					'3'        => esc_html__( '3 columns', 'cherry' ),
					'4'        => esc_html__( '4 columns', 'cherry' ),
				),
				'type' => 'control',
			),
			'related_posts_title' => array(
				'title'   => esc_html__( 'Show post title', 'cherry' ),
				'section' => 'related_posts',
				'default' => true,
				'field'   => 'checkbox',
				'type'    => 'control',
			),
			'related_posts_title_length' => array(
				'title'   => esc_html__( 'Number of words in the title', 'cherry' ),
				'section' => 'related_posts',
				'default' => '5',
				'field'   => 'text',
				'type'    => 'control',
			),
			'related_posts_image' => array(
				'title'   => esc_html__( 'Show post image', 'cherry' ),
				'section' => 'related_posts',
				'default' => true,
				'field'   => 'checkbox',
				'type'    => 'control',
			),
			'related_posts_content' => array(
				'title'   => esc_html__( 'Display content', 'cherry' ),
				'section' => 'related_posts',
				'default' => 'post_excerpt',
				'field'   => 'select',
				'choices' => array(
					'hide'				=> esc_html__( 'Hide', 'cherry' ),
					'post_excerpt'		=> esc_html__( 'Excerpt', 'cherry' ),
					'post_content'		=> esc_html__( 'Content', 'cherry' ),
				),
				'type' => 'control',
			),
			'related_posts_content_length' => array(
				'title'   => esc_html__( 'Number of words in the content', 'cherry' ),
				'section' => 'related_posts',
				'default' => '10',
				'field'   => 'text',
				'type'    => 'control',
			),
			'related_posts_categories' => array(
				'title'   => esc_html__( 'Show post categories', 'cherry' ),
				'section' => 'related_posts',
				'default' => true,
				'field'   => 'checkbox',
				'type'    => 'control',
			),
			'related_posts_tags' => array(
				'title'   => esc_html__( 'Show post tags', 'cherry' ),
				'section' => 'related_posts',
				'default' => true,
				'field'   => 'checkbox',
				'type'    => 'control',
			),
			'related_posts_author' => array(
				'title'   => esc_html__( 'Show post author', 'cherry' ),
				'section' => 'related_posts',
				'default' => true,
				'field'   => 'checkbox',
				'type'    => 'control',
			),
			'related_posts_publish_date' => array(
				'title'   => esc_html__( 'Show post publish date', 'cherry' ),
				'section' => 'related_posts',
				'default' => true,
				'field'   => 'checkbox',
				'type'    => 'control',
			),
			'related_posts_comment_count' => array(
				'title'   => esc_html__( 'Show post comment count', 'cherry' ),
				'section' => 'related_posts',
				'default' => true,
				'field'   => 'checkbox',
				'type'    => 'control',
			),
	) ) );
}

/**
 * Return true if header layout type is transparent. Otherwise - return false.
 *
 * @param  object  $control
 * @return bool
 */
function cherry_is_transparent_header_layout_type( $control ) {

	if ( $control->manager->get_setting( 'header_layout_type' )->value() == 'transparent' ) {
		return true;
	}

	return false;
}

/**
 * Return true if header layout type is NOT transparent. Otherwise - return false.
 *
 * @param  object  $control
 * @return bool
 */
function cherry_is_not_transparent_header_layout_type( $control ) {
	return ! cherry_is_transparent_header_layout_type( $control );
}

/**
* Return true if logo in header has image type. Otherwise - return false.
 *
 * @param  object $control Parent control.
 * @param  string $setting Setting name to check.
 * @param  string $value   Setting value to compare.
 * @return bool
 */
function cherry_is_setting( $control, $setting, $value ) {

	if ( is_array( $value ) ) {
		foreach ( $value as $key => $val ) {
			if ( $val == $control->manager->get_setting( $setting )->value() ) {
				return true;
			}
		}
	}

	if ( $value == $control->manager->get_setting( $setting )->value() ) {
		return true;
	}

	return false;

}

/**
 * Return true if value of passed setting is not equal with passed value.
 *
 * @param  object $control Parent control.
 * @param  string $setting Setting name to check.
 * @param  string $value   Setting value to compare.
 * @return bool
 */
function cherry_is_not_setting( $control, $setting, $value ) {

	if ( $value !== $control->manager->get_setting( $setting )->value() ) {
		return true;
	}

	return false;

}

/**
 * Return true if logo in header has image type. Otherwise - return false.
 *
 * @param  object $control
 * @return bool
 */
function cherry_is_header_logo_image( $control ) {
	return cherry_is_setting( $control, 'header_logo_type', array( 'image', 'image_text' ) );
}

/**
 * Return true if logo in header has text type. Otherwise - return false.
 *
 * @param  object $control
 * @return bool
 */
function cherry_is_header_logo_text( $control ) {
	return cherry_is_setting( $control, 'header_logo_type', array( 'text', 'image_text' ) );
}


/**
 * Return true if sticky label type set to text or text with icon.
 *
 * @param  object $control
 * @return bool
 */
function cherry_is_sticky_text( $control ) {
	return cherry_is_not_setting( $control, 'blog_sticky_type', 'icon' );
}

/**
 * Return true if sticky label type set to icon or text with icon.
 *
 * @param  object $control
 * @return bool
 */
function cherry_is_sticky_icon( $control ) {
	return cherry_is_not_setting( $control, 'blog_sticky_type', 'label' );
}

/**
 * Return true if More button (in the main menu) has image type. Otherwise - return false.
 *
 * @param  object $control
 * @return bool
 */
function cherry_is_more_button_type_image( $control ) {

	if ( $control->manager->get_setting( 'more_button_type' )->value() == 'image' ) {
		return true;
	}

	return false;
}

/**
 * Return true if More button (in the main menu) has text type. Otherwise - return false.
 *
 * @param  object $control
 * @return bool
 */
function cherry_is_more_button_type_text( $control ) {

	if ( $control->manager->get_setting( 'more_button_type' )->value() == 'text' ) {
		return true;
	}

	return false;
}

/**
 * Return true if More button (in the main menu) has icon type. Otherwise - return false.
 *
 * @param  object $control
 * @return bool
 */
function cherry_is_more_button_type_icon( $control ) {

	if ( $control->manager->get_setting( 'more_button_type' )->value() == 'icon' ) {
		return true;
	}

	return false;
}

/**
 * Get default header layouts.
 *
 * @since  1.0.0
 * @return array
 */
function cherry_get_header_layout_options() {
	return apply_filters( 'cherry_header_layout_options', array(
		'minimal'      => esc_html__( 'Minimal', 'cherry' ),
		'centered'     => esc_html__( 'Centered', 'cherry' ),
		'default'      => esc_html__( 'Default', 'cherry' ),
		'transparent'  => esc_html__( 'Transparent', 'cherry' ),
	) );
}

/**
 * Get default header layouts options for Post Meta boxes
 *
 * @return array
 */
function cherry_get_header_layout_pm_options() {
	$options = array(
		'inherit' => array(
			'label'   => esc_html__( 'Inherit', 'cherry' ),
			'img_src' => trailingslashit( CHERRY_THEME_URI ) . 'assets/images/admin/inherit.svg',
		),
	);

	foreach( cherry_get_header_layout_options() as $key => $label ) {
		$options[ $key ] = array(
			'label' => $label,
			'img_src' => trailingslashit( CHERRY_THEME_URI ) . 'assets/images/admin/header-layout-' . $key . '.svg',
		);
	}

	return $options;
}

/**
 * Move native `site_icon` control (based on WordPress core) into custom section.
 *
 * @since 1.0.0
 * @param  object $wp_customize
 * @return void
 */
function cherry_customizer_change_core_controls( $wp_customize ) {
	$wp_customize->get_control( 'site_icon' )->section      = 'cherry_logo_favicon';
	$wp_customize->get_control( 'background_color' )->label = esc_html__( 'Body Background Color', 'cherry' );
}

// Move native `site_icon` control (based on WordPress core) in custom section.
add_action( 'customize_register', 'cherry_customizer_change_core_controls', 20 );

/**
 * Get font styles
 *
 * @since 1.0.0
 * @return array
 */
function cherry_get_font_styles() {
	return apply_filters( 'cherry_get_font_styles', array(
		'normal'  => esc_html__( 'Normal', 'cherry' ),
		'italic'  => esc_html__( 'Italic', 'cherry' ),
		'oblique' => esc_html__( 'Oblique', 'cherry' ),
		'inherit' => esc_html__( 'Inherit', 'cherry' ),
	) );
}

/**
 * Get character sets
 *
 * @since 1.0.0
 * @return array
 */
function cherry_get_character_sets() {
	return apply_filters( 'cherry_get_character_sets', array(
		'latin'        => esc_html__( 'Latin', 'cherry' ),
		'greek'        => esc_html__( 'Greek', 'cherry' ),
		'greek-ext'    => esc_html__( 'Greek Extended', 'cherry' ),
		'vietnamese'   => esc_html__( 'Vietnamese', 'cherry' ),
		'cyrillic-ext' => esc_html__( 'Cyrillic Extended', 'cherry' ),
		'latin-ext'    => esc_html__( 'Latin Extended', 'cherry' ),
		'cyrillic'     => esc_html__( 'Cyrillic', 'cherry' ),
	) );
}

/**
 * Get text aligns
 *
 * @since 1.0.0
 * @return array
 */
function cherry_get_text_aligns() {
	return apply_filters( 'cherry_get_text_aligns', array(
		'inherit' => esc_html__( 'Inherit', 'cherry' ),
		'center'  => esc_html__( 'Center', 'cherry' ),
		'justify' => esc_html__( 'Justify', 'cherry' ),
		'left'    => esc_html__( 'Left', 'cherry' ),
		'right'   => esc_html__( 'Right', 'cherry' ),
	) );
}

/**
 * Get font weights
 *
 * @since 1.0.0
 * @return array
 */
function cherry_get_font_weight() {
	return apply_filters( 'cherry_get_font_weight', array(
		'100' => '100',
		'200' => '200',
		'300' => '300',
		'400' => '400',
		'500' => '500',
		'600' => '600',
		'700' => '700',
		'800' => '800',
		'900' => '900',
	) );
}

/**
 * Return array of arguments for dynamic CSS module
 *
 * @return array
 */
function cherry_get_dynamic_css_options() {
	return apply_filters( 'cherry_get_dynamic_css_options', array(
		'prefix'    => 'cherry',
		'type'      => 'theme_mod',
		'single'    => true,
		'css_files' => array(
			CHERRY_THEME_DIR . '/assets/css/dynamic.css',
			CHERRY_THEME_DIR . '/assets/css/dynamic/site/elements.css',
			CHERRY_THEME_DIR . '/assets/css/dynamic/site/header.css',
			CHERRY_THEME_DIR . '/assets/css/dynamic/site/forms.css',
			CHERRY_THEME_DIR . '/assets/css/dynamic/site/social.css',
			CHERRY_THEME_DIR . '/assets/css/dynamic/site/menus.css',
			CHERRY_THEME_DIR . '/assets/css/dynamic/site/post.css',
			CHERRY_THEME_DIR . '/assets/css/dynamic/site/navigation.css',
			CHERRY_THEME_DIR . '/assets/css/dynamic/site/footer.css',
			CHERRY_THEME_DIR . '/assets/css/dynamic/site/misc.css',
			CHERRY_THEME_DIR . '/assets/css/dynamic/site/buttons.css',
			CHERRY_THEME_DIR . '/assets/css/dynamic/widgets/widget-default.css',
			CHERRY_THEME_DIR . '/assets/css/dynamic/widgets/taxonomy-tiles.css',
			CHERRY_THEME_DIR . '/assets/css/dynamic/widgets/image-grid.css',
			CHERRY_THEME_DIR . '/assets/css/dynamic/widgets/carousel.css',
			CHERRY_THEME_DIR . '/assets/css/dynamic/widgets/smart-slider.css',
			CHERRY_THEME_DIR . '/assets/css/dynamic/widgets/instagram.css',
			CHERRY_THEME_DIR . '/assets/css/dynamic/widgets/subscribe.css',
			CHERRY_THEME_DIR . '/assets/css/dynamic/plugins/projects.css',
			CHERRY_THEME_DIR . '/assets/css/dynamic/plugins/plugins-list.css',
			CHERRY_THEME_DIR . '/assets/css/dynamic/plugins/timeline.css',
			CHERRY_THEME_DIR . '/assets/css/dynamic/plugins/team.css',
			CHERRY_THEME_DIR . '/assets/css/dynamic/plugins/question.css',
		),
		'options' => array(
			'header_logo_font_style',
			'header_logo_font_weight',
			'header_logo_font_size',
			'header_logo_font_family',

			'body_font_style',
			'body_font_weight',
			'body_font_size',
			'body_line_height',
			'body_font_family',
			'body_letter_spacing',
			'body_text_align',

			'h1_font_style',
			'h1_font_weight',
			'h1_font_size',
			'h1_line_height',
			'h1_font_family',
			'h1_letter_spacing',
			'h1_text_align',

			'h2_font_style',
			'h2_font_weight',
			'h2_font_size',
			'h2_line_height',
			'h2_font_family',
			'h2_letter_spacing',
			'h2_text_align',

			'h3_font_style',
			'h3_font_weight',
			'h3_font_size',
			'h3_line_height',
			'h3_font_family',
			'h3_letter_spacing',
			'h3_text_align',

			'h4_font_style',
			'h4_font_weight',
			'h4_font_size',
			'h4_line_height',
			'h4_font_family',
			'h4_letter_spacing',
			'h4_text_align',

			'h5_font_style',
			'h5_font_weight',
			'h5_font_size',
			'h5_line_height',
			'h5_font_family',
			'h5_letter_spacing',
			'h5_text_align',

			'h6_font_style',
			'h6_font_weight',
			'h6_font_size',
			'h6_line_height',
			'h6_font_family',
			'h6_letter_spacing',
			'h6_text_align',

			'breadcrumbs_font_style',
			'breadcrumbs_font_weight',
			'breadcrumbs_font_size',
			'breadcrumbs_line_height',
			'breadcrumbs_font_family',
			'breadcrumbs_letter_spacing',
			'breadcrumbs_text_align',

			'regular_accent_color_1',
			'regular_accent_color_2',
			'regular_accent_color_3',
			'regular_accent_color_4',
			'regular_accent_color_5',
			'regular_text_color',
			'regular_link_color',
			'regular_link_hover_color',
			'regular_h1_color',
			'regular_h2_color',
			'regular_h3_color',
			'regular_h4_color',
			'regular_h5_color',
			'regular_h6_color',

			'invert_accent_color_1',
			'invert_accent_color_2',
			'invert_accent_color_3',
			'invert_text_color',
			'invert_link_color',
			'invert_link_hover_color',
			'invert_h1_color',
			'invert_h2_color',
			'invert_h3_color',
			'invert_h4_color',
			'invert_h5_color',
			'invert_h6_color',

			'header_bg_color',
			'header_bg_image',
			'header_bg_repeat',
			'header_bg_position_x',
			'header_bg_attachment',

			'top_panel_bg',

			'container_width',
			'content_padding_top',
			'content_padding_bottom',

			'footer_widgets_bg',
			'footer_bg',
		),
	) );
}

/**
 * Return array of arguments for Google Font loader module.
 *
 * @since  1.0.0
 * @return array
 */
function cherry_get_fonts_options() {
	return apply_filters( 'cherry_get_fonts_options', array(
		'prefix'  => 'cherry',
		'type'    => 'theme_mod',
		'single'  => true,
		'options' => array(
			'body' => array(
				'family'  => 'body_font_family',
				'style'   => 'body_font_style',
				'weight'  => 'body_font_weight',
				'charset' => 'body_character_set',
			),
			'h1' => array(
				'family'  => 'h1_font_family',
				'style'   => 'h1_font_style',
				'weight'  => 'h1_font_weight',
				'charset' => 'h1_character_set',
			),
			'h2' => array(
				'family'  => 'h2_font_family',
				'style'   => 'h2_font_style',
				'weight'  => 'h2_font_weight',
				'charset' => 'h2_character_set',
			),
			'h3' => array(
				'family'  => 'h3_font_family',
				'style'   => 'h3_font_style',
				'weight'  => 'h3_font_weight',
				'charset' => 'h3_character_set',
			),
			'h4' => array(
				'family'  => 'h4_font_family',
				'style'   => 'h4_font_style',
				'weight'  => 'h4_font_weight',
				'charset' => 'h4_character_set',
			),
			'h5' => array(
				'family'  => 'h5_font_family',
				'style'   => 'h5_font_style',
				'weight'  => 'h5_font_weight',
				'charset' => 'h5_character_set',
			),
			'h6' => array(
				'family'  => 'h6_font_family',
				'style'   => 'h6_font_style',
				'weight'  => 'h6_font_weight',
				'charset' => 'h6_character_set',
			),
			'header_logo' => array(
				'family'  => 'header_logo_font_family',
				'style'   => 'header_logo_font_style',
				'weight'  => 'header_logo_font_weight',
				'charset' => 'header_logo_character_set',
			),
			'breadcrumbs' => array(
				'family'  => 'breadcrumbs_font_family',
				'style'   => 'breadcrumbs_font_style',
				'weight'  => 'breadcrumbs_font_weight',
				'charset' => 'breadcrumbs_character_set',
			),
		)
	) );
}

/**
 * Get default top panel text.
 *
 * @since  1.0.0
 * @return string
 */
function cherry_get_default_top_panel_text() {
	return '';
}

/**
 * Get default footer copyright.
 *
 * @since  1.0.0
 * @return string
 */
function cherry_get_default_footer_copyright() {
	return esc_html__( 'Copyright %%year%% CherryFramework Team', 'cherry' );
}

/**
 * Get default content padding max value.
 *
 * @since  1.0.0
 * @return string
 */
function cherry_get_content_padding_max_value() {
	return apply_filters( 'cherry_content_padding_max_value', 200 );
}


/**
 * Get icons set
 *
 * @return array
 */
function cherry_get_icons_set() {
	ob_start();

	include CHERRY_THEME_DIR . '/assets/js/icons.json';
	$json = ob_get_clean();

	$result = array();
	$icons  = json_decode( $json, true );

	foreach ( $icons['icons'] as $icon ) {
		$result[] = $icon['id'];
	}

	return $result;
}
