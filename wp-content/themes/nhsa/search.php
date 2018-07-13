<?php
/**
* The template for displaying Search Results pages.
*
* @package Shape
* @since Shape 1.0
*/
?>
<?php
get_header(); ?>
<div class="content">


	<div class="breadcrumbs">
		<?php if ( function_exists('yoast_breadcrumb') )
		{yoast_breadcrumb('<p id="breadcrumbs">','</p>');} ?>

	</div>  <?php get_search_form(); ?>



	<?php
	global $query_string;
	$query_args = explode("&", $query_string);
	$search_query = array();

	foreach($query_args as $key => $string) {
		$query_split = explode("=", $string);
		$search_query[$query_split[0]] = urldecode($query_split[1]);
	} // foreach

	$the_query = new WP_Query($search_query);
	if ( $the_query->have_posts() ) :
		?>
    <!-- the loop -->
    <div class="archive-events">
        <div class="archive-content">
			<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
                <div class="event-item">
					<?php if (get_field( category) != 'None'){?><span class="archive-category"><?=the_field( category); ?></span> <?php } ?>
					<?php if (!empty(get_field( type))){?> <span class="archive-type"><?=the_field( type); ?></span> <?php } ?>

                    <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>

                    <div class="content"><?= the_excerpt();?></div>
                    <a href="<?php the_permalink(); ?>" class="btn">Learn More</a>

                    <p><?php the_tags(); ?></p>
                </div>




			<?php endwhile; ?>
            <!-- end of the loop -->

		<?php wp_reset_postdata(); ?>

	<?php else : ?>
		<p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
	<?php endif; ?>

</div>
<?php get_footer();?>
