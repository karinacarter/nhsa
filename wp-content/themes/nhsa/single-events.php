<?php /* Template Name: Article/Event Listing Template */ ?>

<?php
get_header(); ?>
<div class="content">






    <div class="breadcrumbs">
		<?php if ( function_exists('yoast_breadcrumb') )
		{yoast_breadcrumb('<p id="breadcrumbs">','</p>');} ?>

    </div>
    <div class="header-image">

		<?php
		$desktopSize = 'HeroImage'; // (thumbnail, medium, large, full or custom size)
		$mobileSize = 'MobileHeroImage'; // (thumbnail, medium, large, full or custom size)

		?>
       <?php if ( have_rows( 'slider' ) ): ?>

            <div class="slides">

				<?php while ( have_rows( 'slider' ) ): the_row();

					// vars
					$image   = get_sub_field( 'image' );

					?>

                    <div class="slide">


                        <div class="image desktop-only"><?=wp_get_attachment_image( $image, $desktopSize ); ?></div>
                        <div class="image mobile-only"><?=wp_get_attachment_image( $image, $mobileSize ); ?></div>





                    </div>

				<?php endwhile; ?>

            </div>

		<?php endif; ?>


    </div>

    <div class="main-content">
        <div class="main-left">
	        <?php if (strtolower(get_field( category)) != 'none'){?><span class="archive-category"><?=the_field( category); ?></span> <?php } ?>
	        <?php if (!empty(get_field( type))){?> <span class="archive-type"><?=the_field( type); ?></span> <?php } ?>
            <h1><?= the_title( ); ?></h1>
	        <?php $location = get_field('location'); ?>

            <?php
            if(!is_array($location)){
            $actual_location = get_field( 'location' );

            }else{
            $actual_location = str_replace( ', USA', '', $location['address'] );

            } ?>


            <div class="location"><?= $actual_location;?></div>
	        <?php
	        echo dsp_correct_event_datetime( get_field( 'start_date' ), get_field( 'end_date' ) );

	        $new_start_date = date_create_from_format( 'F j, Y g:i a', get_field( 'start_date' ) );
	        $new_end_date   = date_create_from_format( 'F j, Y g:i a', get_field( 'end_date' ) );
	        if ( date_format( $new_start_date, "g:i a" ) != '12:00 am' ) {
		        ?><span class="time <?= $halfwidth ?>"> <?php
		        echo date_format( $new_start_date, "g:i a" ) . " - " . date_format( $new_end_date, "g:i a" );


		        ?></span>
		        <?php

	        }

	        ?>
			<?php the_content(); ?>
            <div class="tags"><?php echo get_the_term_list( get_the_ID(), 'tags', '', ',' ); ?></div>

        </div>

    <div class="main-right">

	    <?php dynamic_sidebar( 'sidebar-events-details' ); ?>


    </div>
    </div>



</div>
<?php get_footer();?>
