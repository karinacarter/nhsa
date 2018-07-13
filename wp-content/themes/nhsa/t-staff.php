<?php /* Template Name: Staff/Board Listing Template */ ?>
<?php

get_header(); ?>
<div class="staff-page">
    <div class="content">
        <!-- Slider -->


		<?php
		if ( have_posts() ) : while ( have_posts() ) : the_post();
			get_template_part( 'partials/block', 'hero-image' ); ?>
            <div class="breadcrumbs">
				<?php if ( function_exists( 'yoast_breadcrumb' ) ) {
					yoast_breadcrumb( '<p id="breadcrumbs">', '</p>' );
				} ?>

            </div>
<div class="grid-expand">			<?php


			// check if the repeater field has rows of data
			if ( have_rows( 'staff_or_board_member' ) ):
				// loop through the rows of data
				while ( have_rows( 'staff_or_board_member' ) ) : the_row();
					?>
                    <div class="staff cell">
						<?php
						$image = get_sub_field( 'image' );
						$size  = 'staff'; // (thumbnail, medium, large, full or custom size)
						//$size = "full";
						if ( $image ) {
							echo wp_get_attachment_image( $image, $size );
						}


						?><h2><?= the_sub_field( 'name' ); ?></h2>
                       <div class="title"><?= the_sub_field( 'title' ); ?></div>
                        <div class="bio detail-info group">
                                <div class="close"><img src="<?= get_theme_file_uri(); ?>/images/close.png" alt="Close Bio"></div>
                            <div class="content">
                                <h2><?= the_sub_field( 'name' ); ?></h2>

                                <?= the_sub_field( 'content' ); ?>
                            </div>
                        </div>

                    </div>

				<?php


				endwhile; // close the loop of flexible content
			endif; // close flexible content conditional

		endwhile; endif; // close the WordPress loop ?>
</div>
    </div>
</div>
<?php get_footer(); ?>
