<div class="block-pages-purple">

    <div class="content">
		<?php
		$desktop_size = 'homepagePurpleBoxes'; // (thumbnail, medium, large, full or custom size)
		$mobile_size  = 'mobileHomepagePurpleBoxes'; // (thumbnail, medium, large, full or custom size)
		/*
		*  Loop through post objects (assuming this is a multi-select field) ( setup postdata )
		*  Using this method, you can use all the normal WP functions as the $post object is temporarily initialized within the loop
		*  Read more: http://codex.wordpress.org/Template_Tags/get_posts#Reset_after_Postlists_with_offset
		*/

		$post_objects = get_sub_field( 'types' );

		if ( $post_objects ): ?>

			<?php foreach ( $post_objects as $post ): // variable must be called $post (IMPORTANT) ?>
				<?php setup_postdata( $post );
				$image = get_field( 'header_image' );
				?>
                <div class="sub-purple-page"
                     style="background-image: url('<?= wp_get_attachment_image_url( $image, $desktop_size ); ?>')">
					<?php if ( get_field( 'header_image' ) ) {


						?>


						<?php
					}
					?>
                    <div class="text">
                        <h3><a href="<?= the_permalink(); ?>"><?php the_title(); ?></a></h3>

                        <div class="teaser_text"><?php the_excerpt() ?></div>
                        <a href="<?= the_permalink(); ?>" class="btn">Learn More</a>
                    </div>
                </div>
			<?php endforeach; ?>

			<?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>
		<?php endif;

		?>
    </div>
</div>
