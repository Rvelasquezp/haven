<?php

if (!function_exists('theme_setup')) {
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which runs
	 * before the init hook.
	 */
	function theme_setup()
	{
		// Add support for block styles.
		add_theme_support('wp-block-styles');

		// Enqueue editor styles.
		add_editor_style(['assets/css/editor-style.css', 'build/style-index.css', 'build/index.css']);
	}
}

add_action('after_setup_theme', 'theme_setup');

function utopian_theme_scripts()
{
	wp_enqueue_style('style', get_stylesheet_directory_uri() . '/build/index.css');
	wp_enqueue_style('theme-style', get_stylesheet_directory_uri() . '/build/style-index.css');
	wp_enqueue_script('utopian', get_stylesheet_directory_uri() . '/build/index.js', '1.0.0', array(), true);
}

add_action('wp_enqueue_scripts', 'utopian_theme_scripts');

function be_gutenberg_scripts()
{
	wp_enqueue_script(
		'utopian-editor',
		get_stylesheet_directory_uri() . '/build/editor.js',
		'1',
		array('wp-blocks', 'wp-dom'),
		true
	);
}

add_action('enqueue_block_editor_assets', 'be_gutenberg_scripts');

function be_reusable_blocks_admin_menu()
{
	add_menu_page('Reusable Blocks', 'Reusable Blocks', 'edit_posts', 'edit.php?post_type=wp_block', '', 'dashicons-editor-table', 22);
}
add_action('admin_menu', 'be_reusable_blocks_admin_menu');

/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function utopian_theme_pingback_header()
{
	if (is_singular() && pings_open()) {
		echo '<link rel="pingback" href="', esc_url(get_bloginfo('pingback_url')), '">';
	}
}

add_action('wp_head', 'utopian_theme_pingback_header');

class JSXBlock
{
	function __construct($name, $renderCallback = null, $data = null, $dataIsFunction = false, $dependencies = ['wp-element'])
	{
		$this->name = $name;
		$this->location = "/build/blocks/{$name}/";
		$this->data = $data;
		$this->dataIsFunction = $dataIsFunction;
		$this->renderCallback = $renderCallback;
		$this->dependencies = $dependencies;
		add_action('init', [$this, 'onInit']);
		add_action('wp_enqueue_scripts', [$this, 'enqueueBlockFiles']);
	}

	function ourRenderCallback($attributes, $content)
	{
		ob_start();

		require get_theme_file_path("/assets/blocks/{$this->name}/{$this->name}.php");

		return ob_get_clean();
	}

	function onInit()
	{

		if ($this->data) {
			wp_localize_script($this->name, $this->name, $this->data);
		}

		$ourArgs = [];

		if ($this->renderCallback) {
			$ourArgs['render_callback'] = [$this, 'ourRenderCallback'];
		}

		register_block_type(__DIR__ . $this->location, $ourArgs);
	}

	function enqueueBlockFiles()
	{
		if ($this->renderCallback) {
			if (has_block("utopian/{$this->name}")) {

				$asset_file = include(__DIR__ . "{$this->location}{$this->name}.asset.php");

				if ($this->data) {
					wp_register_script(
						$this->name,
						get_stylesheet_directory_uri() . "{$this->location}/{$this->name}.js",
						$this->dependencies,
						$asset_file['version'],
						true
					);

					wp_localize_script($this->name, $this->name, $this->dataIsFunction ? call_user_func($this->data) : $this->data);

					wp_enqueue_script(
						$this->name
					);
				} else {
					wp_enqueue_script(
						$this->name,
						get_stylesheet_directory_uri() . "{$this->location}/{$this->name}.js",
						$this->dependencies,
						$asset_file['version'],
						true
					);
				}

				// If {$this->location}/{$this->name}.css exists, enqueue it
				if (file_exists(__DIR__ . "{$this->location}{$this->name}.css")) {
					wp_enqueue_style(
						$this->name,
						get_stylesheet_directory_uri() . "{$this->location}/{$this->name}.css",
						[],
						$asset_file['version']
					);
				}
			}
		}
	}
}
new JSXBlock('svg', true);
new JSXBlock('faq', true);
new JSXBlock('slider-logo', true);

if (function_exists('register_block_pattern_category')) {
	register_block_pattern_category(
		'utopian',
		array('label' => __('Utopian', 'utopian'))
	);
}

add_filter('wpcf7_autop_or_not', '__return_false');

add_action('acf/init', 'my_acf_blocks_init');
function my_acf_blocks_init()
{

	if (function_exists('acf_add_options_page')) {
		acf_add_options_page();
	}

	// 	Add Google API Key
	// 	acf_update_setting('google_api_key', 'xxx');

	// 	Check function exists.
	if (function_exists('acf_register_block_type')) {

		acf_register_block_type(array(
			'title'			=> __('Coming Soon', 'utopian'),
			'name'			=> 'coming-soon',
			'render_template'	=> 'assets/blocks/coming-soon/coming-soon.php',
			'mode'			=> 'preview',
			'supports'		=> [
				'align'			=> false,
				'anchor'		=> true,
				'customClassName'	=> true,
				'jsx' 			=> true,
			]
		));

		acf_register_block_type(array(
			'title'			=> __('Nav Toggler', 'utopian'),
			'name'			=> 'nav-toggler',
			'render_template'	=> 'assets/blocks/nav-toggler/nav-toggler.php',
			'mode'			=> 'preview',
			'supports'		=> [
				'align'			=> false,
				'anchor'		=> true,
				'customClassName'	=> true,
				'jsx' 			=> true,
			]
		));

		acf_register_block_type(array(
			'title'			=> __('Hero', 'utopian'),
			'name'			=> 'hero',
			'render_template'	=> 'assets/blocks/hero/hero.php',
			'mode'			=> 'preview',
			'supports'		=> [
				'align'			=> false,
				'anchor'		=> true,
				'customClassName'	=> true,
				'jsx' 			=> true,
			]
		));

		acf_register_block_type(array(
			'title'			=> __('Image Content', 'utopian'),
			'name'			=> 'image-content',
			'render_template'	=> 'assets/blocks/image-content/image-content.php',
			'mode'			=> 'preview',
			'supports'		=> [
				'align'			=> false,
				'anchor'		=> true,
				'customClassName'	=> true,
				'jsx' 			=> true,
			]
		));

		acf_register_block_type(array(
			'title'			=> __('Misson and Vision', 'utopian'),
			'name'			=> 'mission-and-vision',
			'render_template'	=> 'assets/blocks/mission-and-vision/mission-and-vision.php',
			'mode'			=> 'preview',
			'supports'		=> [
				'align'			=> false,
				'anchor'		=> true,
				'customClassName'	=> true,
				'jsx' 			=> true,
			]
		));

		acf_register_block_type(array(
			'title'			=> __('Services Slider', 'utopian'),
			'name'			=> 'services-slider',
			'render_template'	=> 'assets/blocks/services-slider/services-slider.php',
			'mode'			=> 'preview',
			'supports'		=> [
				'align'			=> false,
				'anchor'		=> true,
				'customClassName'	=> true,
				'jsx' 			=> true,
			]
		));

		acf_register_block_type(array(
			'title'			=> __('Our FAQ', 'utopian'),
			'name'			=> 'our-faq',
			'render_template'	=> 'assets/blocks/our-faq/our-faq.php',
			'mode'			=> 'preview',
			'supports'		=> [
				'align'			=> false,
				'anchor'		=> true,
				'customClassName'	=> true,
				'jsx' 			=> true,
			]
		));

		acf_register_block_type(array(
			'title'			=> __('Slider Logo', 'utopian'),
			'name'			=> 'slider-logo',
			'render_template'	=> 'assets/blocks/slider-logo/slider-logo.php',
			'mode'			=> 'preview',
			'supports'		=> [
				'align'			=> false,
				'anchor'		=> false,
				'customClassName'	=> false,
				'jsx' 			=> true,
			]
		));
	}
}


function create_posttype()
{


	// register_taxonomy(
	// 	'categorie-equipe',
	// 	'equipe',
	// 	array(
	// 		'hierarchical' => true,
	// 		'label' => 'Catégorie équipe',
	// 		'query_var' => true,
	// 		'show_in_rest' => true,
	// 		'rewrite' => array(
	// 			'slug' => 'categorie-equipe',
	// 			'with_front' => false
	// 		)
	// 	)
	// );

	register_post_type(
		'service',
		// CPT Options
		array(
			/* Labels */
			'labels' => array(
				'name'          => __('Services'),
				'singular_name' => __('Service'),
			),
		
			/* Core settings */
			'public'              => true,
			'hierarchical'        => false,
			'capability_type'     => 'page',
		
			/* Visibility */
			'show_ui'             => true,
			'show_in_menu'        => true,
			'show_in_admin_bar'   => true,
			'show_in_nav_menus'   => true,
			'publicly_queryable'  => true,
			'exclude_from_search' => false,
			'show_in_rest'        => true,
		
			/* Content & structure */
			'supports' => array(
				'title',
				'editor',
				'excerpt',
				'thumbnail',
				'custom-fields',
				'page-attributes',
			),
		
			'taxonomies' => array(), // o elimina esta línea si no usas taxonomías
		
			/* URLs */
			'rewrite'     => array('slug' => 'service'),
			'has_archive' => false,
		
			/* Admin UI */
			'menu_icon'     => 'dashicons-admin-tools',
			'menu_position' => 6,
		
			/* Other */
			'can_export' => true,
		)
		
	);

	// add_filter('woocommerce_show_page_title', '__return_true', 1);
	// add_filter('woocommerce_single_product_summary', 'woocommerce_template_single_title', 6);
}
// Hooking up our function to theme setup
add_action('init', 'create_posttype');

// hide admin bar
add_filter('show_admin_bar', '__return_false');
// hide admin bar