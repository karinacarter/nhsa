<?php
/**
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
    <!--[if lt IE 9]>
    <![endif]-->
	<?php wp_head(); ?>

    <link rel="stylesheet" href="https://use.typekit.net/yef6qcb.css">
    <link rel="stylesheet" type="text/css" href="<?php bloginfo( 'stylesheet_url' ); ?>"/>
	<?php wp_enqueue_script( 'jquery-ui-menu' ); ?>
	<?php wp_enqueue_script( 'jquery-ui-selectmenu' ); ?>
	<?php wp_enqueue_script( 'dropdown', get_template_directory_uri() . '/js/jquery.slicknav.js', array( 'jquery' ), 1.1, true ); ?>
	<?php wp_enqueue_script( 'slideslider', get_template_directory_uri() . '/js/slick.min.js', array( 'jquery' ), 1.1, true ); ?>


	<?php wp_enqueue_script( 'script', get_template_directory_uri() . '/js/scripts.js', array( 'jquery' ), 1.1, true ); ?>
    <link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/favicon.ico"/>

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-49470239-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-49470239-1');
    </script>
</head>
<body <?php body_class(); ?> >
<div class="container">
    <div class="mobile-nav"><a href="/"><img src="<?= get_theme_file_uri(); ?>/images/logo.png"
                                 alt="National Human Services Assembly"></a></div>

    <div class="header">
        <div class="blueBar">
            <div class="utility-nav">
                <div class="social-links-menu">
					<?php
					wp_nav_menu( array(
						'theme_location'  => 'social-navigation',
						'container_class' => 'social-navigation'
					) );
					?></div>
	            <?php get_search_form(); ?>

				<?php
				wp_nav_menu( array(
					'theme_location'  => 'utility-navigation',
					'container_class' => 'utility-navigation'
				) );
				?>
            </div>
        </div>
        <div class="navigation-container">
            <div class="navigation">
                <div class="logo">
                    <a href="/"><img src="<?= get_theme_file_uri(); ?>/images/logo.png"
                                     alt="National Human Services Assembly"/></a>
                </div>
				<?php
//				wp_nav_menu( array('theme_location'=>'primary', );
				wp_nav_menu( array(
					'theme_location'  => 'primary-navigation',
					'container_class' => 'primary-navigation',
					'walker' => new SH_Child_Only_Walker()

				) );




				?>
            </div>


        </div>
        <div class="nav-sticky-container">
            <div class="nav-sticky">
                <div class="logo">
                    <a href="/"><img src="<?= get_theme_file_uri(); ?>/images/sticky-logo.png"
                                     alt="National Human Services Assembly"/></a>
                </div>
				<?php
				wp_nav_menu( array(
					'theme_location'  => 'primary-navigation',
					'container_class' => 'primary-navigation',
					'walker' => new SH_Child_Only_Walker()

				) );
				?>
            </div>
        </div>
    </div>