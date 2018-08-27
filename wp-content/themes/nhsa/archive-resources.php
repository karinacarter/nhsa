<?php
/**
 * The template for displaying Resource Results pages.
 *
 * @package Shape
 * @since Shape 1.0
 */
?>
<?php
get_header(); ?>
<div class="content">
	<?php

	global $query_string;
	$paged    = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
	$type     = ( get_query_var( 'type' ) ) ? get_query_var( 'type' ) : 'all';
	$category = ( get_query_var( 'category' ) ) ? get_query_var( 'category' ) : 'all';


	global $wp_query;
	//	var_dump($wp_query->query_vars);
	$meta_query = array(
		'relation' => 'AND',
	);

	$showheader = '';
	if ( $type !== 'all' ) {
		if ( $type != 'resource' ) {
			$showheader = 1;
		}
		$typeArray = array(
			'key'     => 'type',
			'value'   => $type,
			'compare' => '='
		);

		array_push( $meta_query, $typeArray );
	}
	if ( $category !== 'all' ) {
		$showheader = 1;

		$categoryArray = array(
			'key'     => 'category',
			'value'   => $category,
			'compare' => '='
		);
		array_push( $meta_query, $categoryArray );
	}

	if ( $showheader !== 1 ) {
		get_template_part( 'partials/block', 'hero-image' );

	}
	?>


    <div class="breadcrumbs">
		<?php if ( function_exists( 'yoast_breadcrumb' ) ) {
			yoast_breadcrumb( '<p id="breadcrumbs">', '</p>' );
		} ?>

    </div>


	<?php


	$query_args   = explode( "&", $query_string );
	$search_query = array(
		'posts_per_page' => 5,
		'paged'          => $paged,
		'post_status'    => 'publish',
		'orderby'        => 'publish_date',
		'order'          => 'DESC',
		'meta_query'     => $meta_query
	);
	foreach ( $query_args as $key => $string ) {
		$query_split                     = explode( "=", $string );
		$search_query[ $query_split[0] ] = urldecode( $query_split[1] );
	} // foreach

	$the_query = new WP_Query( $search_query );
	?>
    <div class="archive-events">
        <div class="archive-content matchContentHeight">
			<?php
			if ( $the_query->have_posts() ) :
				?>
                <!-- the loop -->

				<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
                <div class="event-item">
					<?php if ( strtolower( get_field( category ) ) != 'none' ) { ?><span
                            class="archive-category"><?= the_field( category ); ?></span> <?php } ?>
					<?php if ( ! empty( get_field( type ) ) ) { ?> <span
                            class="archive-type"><?= the_field( type ); ?></span> <?php } ?>

                    <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
					<?= get_the_date(); ?>

                    <div><?= the_excerpt(); ?></div>
                    <div class="tags"><?php echo get_the_term_list( get_the_ID(), 'tags', '', ',' ); ?></div>
                    <a href="<?php the_permalink(); ?>" class="btn">Learn More</a>

                </div>


			<?php endwhile; ?>
                <!-- end of the loop -->


			<?php else : ?>
                <p><?php _e( 'Sorry, no resources matched your criteria.' ); ?></p>
			<?php endif; ?>
            <div class="pagination">
				<?php
				$big        = 999999999; // need an unlikely integer
				$pagination = paginate_links( array(
					'base'      => str_replace( $big, '%#%', get_pagenum_link( $big ) ),
					'format'    => '?paged=%#%',
					'current'   => $paged,
					'total'     => $the_query->max_num_pages,
					'prev_next' => 0,
					'mid_size'  => 8
				) );
				if ( ! empty( $pagination ) ) {


					echo $pagination;
				}

				wp_reset_postdata(); ?>
            </div>

        </div>
        <div class="archive-sidebar matchContentHeight">
			<?php get_search_form();

			?>

            <div id="archive-filters">
				<?php
				$category = ( get_query_var( "category" ) ) ? get_query_var( "category" ) : 'all';
				$type     = ( get_query_var( "type" ) ) ? get_query_var( "type" ) : 'all';


				?>
				<?php foreach ( $GLOBALS['my_query_filters'] as $key => $name ):

					// get the field's settings without attempting to load a value
					$field = get_field_object( $key, false, true );

					// set value if available

					if ( isset( $field[ ID ] ) ) {
						if ( $type == 'resource' AND $name == 'type' ) {
						} else {
							// create filter
							?>
                            <!-- STart Loop -->

                            <div class="filter" data-filter="<?php echo $name; ?>">
                                FILTER BY <?= $name ?>
                                <ul id="archive-<?= $name ?>">

                                    <li><?= $$name; ?>
                                        <ul>
											<?php

											if ( $name == "type" ) {
												echo "<li><a href='" . home_url( get_post_type() ) . "/filters/" . $category . "/all'>all</a></li>";

												$choices = $field['choices'];
												foreach ( $choices as $option => $choice ):
													if ( strtoupper( $choice ) != "NONE" AND strtoupper( $choice ) != "RESOURCE" ) {
														echo "<li><a href='" . home_url( get_post_type() ) . "/filters/$category/$option'>" . $choice . "</a></li>";
													}
												endforeach;
											}


											if ( $name == "category" ) {
												echo "<li><a href='" . home_url( get_post_type() ) . "/filters/all/$type'>All</a></li>";

												$choices = $field['choices'];
												foreach ( $choices as $option => $choice ):
													if ( strtoupper( $choice ) != "NONE" ) {

														echo "<li><a href='" . home_url( get_post_type() ) . "/filters/$option/$type'>" . $choice . "</a></li>";
													}
												endforeach;


											}


											?>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                            <!-- End Loop -->
						<?php }
					}
				endforeach;
				?>
            </div>
			<?php dynamic_sidebar( 'sidebar-events' ); ?>
            <!--FEatured ARticles-->

        </div>
    </div>
</div>

<?php get_footer(); ?>
