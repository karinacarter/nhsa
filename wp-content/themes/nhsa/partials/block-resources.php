<section class="resource">
<?php 		$current_category = get_field( 'category' );
?>
    <div class="block-resources">
        <div class="block-header"><h3>Resources</h3>
            <a href="/resources/filters/all/resource" class="btn">VIEW ALL RESOURCES</a>
        </div>

		<?php


		$meta_query = array(
			'relation' => 'AND',
		);

		$tax_query = array(
			'relation' => 'OR',
		);
		$all_tags = get_the_terms( get_the_ID(), 'tags');
		if($all_tags){
			$all_artices_link = '/tags/';
			foreach ($all_tags as &$value) {
				$addTags = array(
					'taxonomy'         => 'tags',
					'terms'            => &$value,
					'field'            => 'slug',
				);
				array_push( $tax_query, $addTags );

			}


		}




			$typeArray = array(
				'key'     => 'type',
				'value'   => 'resource',
				'compare' => '='
			);

			array_push( $meta_query, $typeArray );

//		echo get_field( 'count');
		// query events order
		$post_objects = get_posts( array(
			'posts_per_page' => 6,
			'post_type'      => 'resources',
			'order'          => 'ASC',
			'meta_query'     => $meta_query,
			'tax_query'      => $tax_query,

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