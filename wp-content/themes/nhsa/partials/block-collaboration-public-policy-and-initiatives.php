<div class="block-cppi">

    <div class="content"><?php


		$args         = array(
			'post_type' => 'page', // must
			'post__in'  => array( 67, 72, 74 ),
			'order'     => 'ASC',
		);
		$post_objects = get_posts( $args );


		if ( $post_objects ): ?>

			<?php foreach ( $post_objects as $post ): // variable must be called $post (IMPORTANT) ?>
				<?php setup_postdata( $post ); ?>
                <div class="cppiPages">
					<?php $image = get_field( 'header_image' );
					$size        = 'homepageCppi'; // (thumbnail, medium, large, full or custom size)
					//$size = "full";


					echo wp_get_attachment_image( $image, $size );
					?>

                    <h3><a href="<?= the_permalink(); ?>"><?php the_title(); ?></a></h3>

                    <div class="teaser_text"><?php the_excerpt() ?></div>
                    <a href="<?= the_permalink(); ?>" class="btn">Learn More</a>
                </div>
			<?php endforeach; ?>

			<?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>
		<?php endif;
		?>
    </div>
</div>
