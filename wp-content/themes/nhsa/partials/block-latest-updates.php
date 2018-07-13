<div class="block-latest-updates">
    <div class="block-content">
        <h4>
            Latest Updates
        </h4>


		<?php
		$current_category = get_field( 'category' );


		$meta_query = array(
			'relation' => 'AND',
		);


		if ( $current_category != "none" ) {
			$categoryArray = array(
				'key'     => 'category',
				'value'   => $current_category,
				'compare' => '='
			);

			array_push( $meta_query, $categoryArray );
		} else {
			$current_category = "";
		}
		// query events order
		$post_objects = get_posts( array(
			'posts_per_page' => 3,
			'post_type'      => 'resources',
			'post_status' => 'publish',
			'orderby'     => 'publish_date',
			'order'       => 'DESC',

			'meta_query' => $meta_query

		) );

		$query_args = array();

		if ( $post_objects ): ?>
			<?php foreach ( $post_objects as $post ): // variable must be called $post (IMPORTANT) ?>
				<?php setup_postdata( $post );
				$category = get_field( 'category', $post_object->ID );
				$category = strtolower( $category );
				$category = str_replace( ' ', '-', $category );
				if ( strtolower( $current_category ) == strtolower( $category ) OR strtolower( $category ) == 'none' ) {


					$classname = ' nocatname';
				}
				?>
                <div class="update-item <?= $classname; ?>">
                    <div class="category"><?= the_field( 'category', $post_object->ID ) ?></div>
					<?php if ( get_field( 'image' ) ) {
						$image = get_field( 'image' );
						$size  = 'latestUpdateImage'; // (thumbnail, medium, large, full or custom size)
						?>

                        <div class="image"><?= wp_get_attachment_image( $image[0]['image'], $size ); ?></div>
					<?php } else {
						?>
                        <div class="image"><img alt=""
                                                src="/wp-content/themes/nhsa/images/default/<?= $category ?>.jpg">
                        </div><?php
					}
					?>
                    <a href="<?= the_permalink(); ?>"><?php echo wp_trim_words( get_the_title(), 3, '...' ); ?></a>
                    <div class="teaser_text"><?php
						//$content = the_excerpt();
						echo wp_trim_words( get_the_content(), 10, '...' ); ?></div>

                    <a href="<?= the_permalink(); ?>">VIEW FULL ARTICLE</a>
                </div>


			<?php endforeach; ?>

			<?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>


		<?php endif; ?>

    </div>
    <div><a href="/resources/filters/<?= $current_category; ?>/all/" class="btn">View All <?= $current_category; ?>
            Updates</a></div>

</div>