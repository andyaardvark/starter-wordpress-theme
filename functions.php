<?php
	/**
	 * functions and definitions
	 * For more information on hooks, actions, and filters, see http://codex.wordpress.org/Plugin_API.
	 */


	/*  Required external files */

	require_once( 'external/utilities.php' );

	
	/*   Theme specific settings   */

	// Define menus
	register_nav_menus( array(
	'primary' => 'Primary Navigation',
	) );

     // Custom admin logo
     function my_custom_login_logo() {
	 echo '<style type="text/css">
        h1 a { background-image:url('.get_bloginfo('template_directory').'/images/aardvark-logo-admin.png) !important; }
      </style>';
      }
     add_action('login_head', 'my_custom_login_logo');
	
     // Remove contact form 7 css and js scripts	
	add_action( 'wp_print_styles', 'deregister_cf7_styles', 100 );
	function deregister_cf7_styles() {
	    if ( !is_page(100) ) {
	        wp_deregister_style( 'contact-form-7' );
	    }
	}

	add_action( 'wp_print_scripts', 'deregister_cf7_javascript', 100 );
	function deregister_cf7_javascript() {
	    if ( !is_page(100) ) {
	        wp_deregister_script( 'contact-form-7' );
	    }
	}

	// Remove unnessary classes (keep "current-menu-item")
	add_filter('nav_menu_css_class', 'my_css_attributes_filter', 100, 1);
	add_filter('nav_menu_item_id', 'my_css_attributes_filter', 100, 1);
	add_filter('page_css_class', 'my_css_attributes_filter', 100, 1);
	  function my_css_attributes_filter($var) {
		  return is_array($var) ? array_intersect($var, array('current-menu-item')) : '';
		  }
	
	/*  Actions and Filters */

	add_action( 'wp_enqueue_scripts', 'script_enqueuer' );

	add_filter( 'body_class', 'add_slug_to_body_class' );
	
	
	/* Custom Post Types - include custom post types and taxonimies here e.g.

	e.g. require_once( 'custom-post-types/your-custom-post-type.php' );  */

	/* ---------  */
	
	

	/* Scripts  */

	/** Add scripts via wp_head() */

	function script_enqueuer() {
	wp_deregister_script('jquery');
	wp_register_script( 'jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js', array( 'jquery' ), '1.0', true );
		wp_register_script( 'settings', get_template_directory_uri().'/js/settings.js', array( 'jquery' ), '1.0', true  );
		wp_enqueue_script( 'jquery' );
		wp_enqueue_script( 'settings' );

		wp_register_style( 'screen', get_template_directory_uri().'/style.css', '', '', 'screen' );
        wp_enqueue_style( 'screen' );
	}	
	
		add_action('wp_enqueue_scripts', 'my_scripts_method');
		

	/* Comments  */

	/*  Custom callback for outputting comments  */
	function starkers_comment( $comment, $args, $depth ) {
		$GLOBALS['comment'] = $comment; 
		?>
		<?php if ( $comment->comment_approved == '1' ): ?>	
		<li>
			<article id="comment-<?php comment_ID() ?>">
				<?php echo get_avatar( $comment ); ?>
				<h4><?php comment_author_link() ?></h4>
				<time><a href="#comment-<?php comment_ID() ?>" pubdate><?php comment_date() ?> at <?php comment_time() ?></a></time>
				<?php comment_text() ?>
			</article>
		<?php endif;
	}
	


