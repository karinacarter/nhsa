<?php /* Template Name: Article/Event Listing Template */ ?>

<?php
get_header(); ?>
<div class="content">


    <div class="breadcrumbs">
		<?php if ( function_exists( 'yoast_breadcrumb' ) ) {
			yoast_breadcrumb( '<p id="breadcrumbs">', '</p>' );
		} ?>

    </div>
    <div class="header-image">

		<?php
		$desktopSize = 'HeroImage'; // (thumbnail, medium, large, full or custom size)
		$mobileSize  = 'MobileHeroImage'; // (thumbnail, medium, large, full or custom size)

		?>
		<?php if ( have_rows( 'slider' ) ): ?>

            <div class="slides">

				<?php while ( have_rows( 'slider' ) ): the_row();

					// vars
					$image = get_sub_field( 'image' );

					?>

                    <div class="slide">


                        <div class="image desktop-only"><?= wp_get_attachment_image( $image, $desktopSize ); ?></div>
                        <div class="image mobile-only"><?= wp_get_attachment_image( $image, $mobileSize ); ?></div>


                    </div>

				<?php endwhile; ?>

            </div>

		<?php endif; ?>


    </div>

    <div class="main-content">
        <div class="main-left">
			<?php if ( strtolower( get_field( category ) ) != 'none' ) { ?><span
                    class="archive-category"><?= the_field( category ); ?></span> <?php } ?>
			<?php if ( ! empty( get_field( type ) ) ) { ?> <span
                    class="archive-type"><?= the_field( type ); ?></span> <?php } ?>
            <h1><?= the_title(); ?></h1>
			<?= get_the_date(); ?>
			<?php the_content(); ?>
            <div class="tags"><?php echo get_the_term_list( get_the_ID(), 'tags', '', ',' ); ?></div>

        </div>

        <div class="main-right">
			<?php dynamic_sidebar( 'sidebar-events-details' ); ?>

			<?php


			$post_objects = get_posts( array(
				'posts_per_page' => 4,

				'order'     => 'DESC',
				'post_type' => 'resources',


				'meta_query' => array(
					'relation' => 'OR',
					array(
						'key'     => 'category',
						'value'   => get_field( category ),
						'compare' => '=',
					),

				),
			) );

			?>

            <aside id="related-articles" class="widget widget_text"><h3 class="widget-title">Related News</h3>
                <div class="textwidget">
                    <ul>
						<?php
						$articleID = get_the_ID();


						foreach ( $post_objects as $post ): // variable must be called $post (IMPORTANT)
							?>
							<?php setup_postdata( $post );
							if ( get_the_ID() != $articleID ) {
								$category = get_field( 'category', $post->ID );

								?>
                                <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
								<?php
							}
						endforeach; ?>

						<?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>
                    </ul>
                </div>
            </aside>


        </div>
    </div>


</div>
<?php get_footer(); ?>
