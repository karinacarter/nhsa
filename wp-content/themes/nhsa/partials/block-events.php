<div class="block-events">
    <div class="block-content">


		<?php
		$meta_query2 = array(
			array(

				'key' => 'end_date',
				'value' => date('Ymd'),
				'type' => 'DATE',
				'compare' => '>='
			)

		);
		$today = date('Ymd');

		// query events order
		$post_objects = get_posts( array(
			'posts_per_page' => 4,
			'post_type'      => 'events',
			'order'          => 'ASC',
			'orderby'        => 'start_date',
			'meta_key'       => 'start_date',
			'meta_type'      => 'DATETIME',
			'meta_query'     => $meta_query2


		) );


		$is_first = '';

		$query_args = array();

		if ( $post_objects ): ?>
		<?php foreach ( $post_objects

		as $post ): // variable must be called $post (IMPORTANT)    ?>
		<?php setup_postdata( $post );


		if ( empty( $is_first ) ){
		    if(empty( $location )){

		        $halfwidth = 'halfwidth';
            }
		?>
        <div class="featured-event matchContentHeight">
            <h2>
                Featured Event
            </h2>
            <a href="<?= the_permalink(); ?>"><?= the_title(); ?></a>
            <div class="eventdate-location">
                <span class="date <?=$halfwidth?>"><?php
	                echo dsp_correct_event_datetime( get_field( 'start_date' ), get_field( 'end_date' ) );
	                ?>
            </span>
				<?php

				$new_start_date = date_create_from_format( 'F j, Y g:i a', get_field( 'start_date' ) );
				$new_end_date   = date_create_from_format( 'F j, Y g:i a', get_field( 'end_date' ) );
				if ( date_format( $new_start_date, "g:i a" ) != '12:00 am' ) {
					?><span class="time <?=$halfwidth?>"><?php
					echo date_format( $new_start_date, "g:i a" ) . " - " . date_format( $new_end_date, "g:i a" );


					?></span>
					<?php
				}
				$location = get_field( 'location' );

				if ( ! empty( $location ) ) { ?>
                    <span class="location"><?= str_replace(', USA' , '', $location['address']);?></span>

				<?php }
				?>
            </div>

            <div class="teaser_text"><?= the_excerpt(); ?></div>
            <a href="<?= the_permalink(); ?>" class="btn">Event Details</a>
        </div>
        <div class="other-events matchContentHeight"><h3>Other Events</h3>
			<?php
			$is_first = "No";
			} else {
				?>
                <div class="other-event-item"><a href="<?= the_permalink(); ?>"><?= the_title(); ?></a>
				<span class="date"><?php echo dsp_correct_event_datetime( get_field( 'start_date' ), get_field( 'end_date' ) );?>
                </span>
				</div><?php } ?>
			<?php endforeach; ?>

			<?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>


			<?php endif; ?>

            <div class="events-button"><a href="/events" class="btn">View All Events</a></div>
        </div>
    </div>
</div>