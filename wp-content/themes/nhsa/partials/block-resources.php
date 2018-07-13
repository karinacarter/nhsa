<section class="resource">
<?php 		$current_category = get_field( 'category' );
?>
    <div class="block-resources">
        <div class="block-header"><h3>Resources</h3>
            <a href="/resources/filters/<?=$current_category;?>/all" class="btn">VIEW ALL RESOURCES</a>
        </div>


		<?php


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
//		echo get_field( 'count');
		// query events order
		$post_objects = get_posts( array(
			'posts_per_page' => 6,
			'post_type'      => 'resources',
			'order'          => 'ASC',
			'meta_query'     => $meta_query

		) );


		$query_args = array();

		if ( $post_objects ): ?>
			<?php foreach ( $post_objects as $post ): // variable must be called $post (IMPORTANT) ?>
				<?php setup_postdata( $post );
				$category = get_field( 'category', $post_object->ID );
				$category = strtolower( $category );
				$category = str_replace( ' ', '-', $category );

				?>
                <div class="item">

                    <a href="<?= the_permalink(); ?>"><?php the_title(); ?></a>
                    <div class="teaser_text"><?= the_excerpt(); ?>
                    </div>

                </div>


			<?php endforeach; ?>

			<?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>


		<?php endif; ?>

    </div>


</section>