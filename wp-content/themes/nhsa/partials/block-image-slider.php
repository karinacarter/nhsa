<div class="header-image">

	<?php
	$desktopSize = 'homeSlider'; // (thumbnail, medium, large, full or custom size)
	$mobileSize = 'MobileHeroImage'; // (thumbnail, medium, large, full or custom size)

	?>
	<?php if ( have_rows( 'slider' ) ): ?>

        <div class="slides">

			<?php while ( have_rows( 'slider' ) ): the_row();

				// vars
				$image   = get_sub_field( 'image' );
				$content = get_sub_field( 'content' );
				$link    = get_sub_field( 'link_url' );

				$title = get_sub_field( 'title' );

				?>

                <div class="slide">


                    <div class="image desktop-only"><?=wp_get_attachment_image( $image, $desktopSize ); ?></div>
                    <div class="image mobile-only"><?=wp_get_attachment_image( $image, $mobileSize ); ?></div>



                    <div class="blackoverlay"></div>
                    <div class="header-title">
                        <h2><?php echo $title; ?></h2>

                        <div class="subhead"><?php echo $content; ?></div>


                    </div>
					<?php if ( $link ): ?>


                        <div class="button"><a href="<?php echo $link; ?>" class="btn">Learn More</a></div>
					<?php endif; ?>
                </div>

			<?php endwhile; ?>

        </div>

	<?php endif; ?>


</div>
