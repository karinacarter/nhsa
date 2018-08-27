<div class="block-events">
    <div class="block-content">


		<?php
		$meta_query2 = array(
			array(

				'key'     => 'end_date',
				'value'   => date( 'Ymd' ),
				'type'    => 'DATE',
				'compare' => '>='
			)

		);
		$today       = date( 'Ymd' );

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
		/// Get featured
		///
		// WP_Query arguments
		$args = array(
			'post_type'      => 'events',
			'posts_per_page' => '1',
			'order'          => 'ASC',
			'orderby'        => 'start_date',
			'meta_query'     => array(
				'relation' => 'AND',
				array(
					'key'   => 'featured',
					'value' => '1',
				),
				array(
					'key'     => 'start_date',
					'value'   => date( Ymd ),
					'compare' => '>=',
					'type'    => 'DATE',
				),
			),
		);
		$meta_query = array(
				'relation' => 'AND',
				array(
					'key'   => 'featured',
					'value' => '1',
				),
				array(
					'key'     => 'start_date',
					'value'   => date( Ymd ),
					'compare' => '>=',
					'type'    => 'DATE',
				),
			);
		var_dump($meta_query);
		// The Query
		$query = get_posts( $args );

		if ( ! empty( $query ) ) {

			foreach ( $query as $post ) { // variable must be called $post (IMPORTANT)
				setup_postdata( $post );

				$new_start_date = date_create_from_format( 'F j, Y g:i a', get_field( 'start_date' ) );
				$new_end_date   = date_create_from_format( 'F j, Y g:i a', get_field( 'end_date' ) );
				if ( date_format( $new_start_date, "g:i a" ) != '12:00 am' ) {
					$featured_event_time = date_format( $new_start_date, "g:i a" ) . " - " . date_format( $new_end_date, "g:i a" );
				}
				$featured_event_date  = dsp_correct_event_datetime( get_field( 'start_date' ), get_field( 'end_date' ) );
				$featured_event_title = get_the_title();

				$location                = get_field( 'location' );
				if(!is_array($location)){
					$featured_event_location = get_field( 'location' );

				}else{

					$featured_event_location = str_replace( ', USA', '', $location['address'] );

				}
				$featured_event_content  = get_the_excerpt();
				$featured_event_link     = get_permalink();
				$feature_event           = 1;
				wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly


			}

		}

		$query_args = array();
		$is_first   = '';
		$count      = '0';
		if ( $post_objects ): ?>
		<?php foreach ( $post_objects

		as $post ): // variable must be called $post (IMPORTANT)             ?>
		<?php setup_postdata( $post );
		$count = $count + 1;
		if ( ! $feature_event AND $is_first == '' ) {
			$new_start_date = date_create_from_format( 'F j, Y g:i a', get_field( 'start_date' ) );
			$new_end_date   = date_create_from_format( 'F j, Y g:i a', get_field( 'end_date' ) );
			if ( date_format( $new_start_date, "g:i a" ) != '12:00 am' ) {
				$featured_event_time = date_format( $new_start_date, "g:i a" ) . " - " . date_format( $new_end_date, "g:i a" );
			}
			$featured_event_date  = dsp_correct_event_datetime( get_field( 'start_date' ), get_field( 'end_date' ) );
			$featured_event_title = get_the_title();

			$location                = get_field( 'location' );
			if(!is_array($location)){
				$featured_event_location = get_field( 'location' );

			}else{

				$featured_event_location = str_replace( ', USA', '', $location['address'] );

			}


			$featured_event_content  = get_the_excerpt();
			$featured_event_link     = get_permalink();

		}
		if ( empty( $is_first ) ){
		if ( empty( $location ) ) {

			$halfwidth = 'halfwidth';
		}
		?>
        <div class="featured-event matchContentHeight">
            <h2>
                Featured Event
            </h2>
            <a href="<?= $featured_event_link; ?>"><?= $featured_event_title ?></a>
            <div class="eventdate-location">
                <span class="date <?= $halfwidth ?>"><?= $featured_event_date; ?></span>
                <span class="time <?= $halfwidth ?>"><?= $featured_event_time; ?></span>
				<?= $featured_event_location; ?>

            </div>

            <div class="teaser_text"><?= $featured_event_content; ?></div>
            <a href="<?= $featured_event_link ?>" class="btn">Event Details</a>
        </div>
        <div class="other-events matchContentHeight"><h3>Other Events</h3>
			<?php
			$is_first = "No";
			if ( $feature_event ) {
				?>
                <div class="other-event-item"><a href="<?= the_permalink(); ?>"><?= the_title(); ?></a>
                    <span class="date"><?php echo dsp_correct_event_datetime( get_field( 'start_date' ), get_field( 'end_date' ) ); ?>
                </span>
                </div>
				<?php
			}
			} else {
				if ( get_the_title() != $featured_event_title AND $count <= 4) {


					?>
                    <div class="other-event-item"><a href="<?= the_permalink(); ?>"><?= the_title(); ?></a>
                    <span class="date"><?php echo dsp_correct_event_datetime( get_field( 'start_date' ), get_field( 'end_date' ) ); ?>
                </span>
                    </div><?php }
			} ?>
			<?php endforeach; ?>

			<?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>


			<?php endif; ?>

            <div class="events-button"><a href="/events" class="btn">View All Events</a></div>
        </div>
    </div>
</div>