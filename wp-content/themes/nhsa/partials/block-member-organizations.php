<div class="block-members">
<?php //var_dump(get_sub_field("category"));?>
<h3>Member Organizations</h3>
<?php


$member_cats=array();


// query events order
$post_objects = get_posts(array(
	'posts_per_page'	=> 20,
	'post_type'			=> 'member_organizations',
	'order'				=> 'ASC',
	'orderby'			=> 'rand',
	'relation' => 'OR', // Optional, defaults to "AND"
	array(
		'key'     => 'category',
		'type'   => 'PurchasingPoint',
		'compare' => '='
	),
	array(
		'relation' => 'AND',
		array(
			'key'     => 'category',
			'type'   => 'ncfy',
			'compare' => '='
		),
		array(
			'key'     => 'category',
			'type'   => 'Home',
			'compare' => '='
		)
	)
));

$Category = get_sub_field( 'category' );
var_dump($Category);
$query_args = array();

    if( $post_objects ): ?>
    <div class="slides">
	<?php foreach( $post_objects as $post): // variable must be called $post (IMPORTANT) ?>
		<?php setup_postdata($post); ?>
        <?php if  (get_field('url',  $post_object->ID)){?>
                <div class="slide">
    <a href="<?=the_field('url',  $post_object->ID);?>" target="_blank">

                 <?php  } ?>
            <img src="<?php the_field('logo',  $post_object->ID); ?>" alt="<?php the_title(); ?>">
		    <?php if  (get_field('url',  $post_object->ID)){?>
</a>

		    <?php  } ?>
            </div>
	<?php endforeach; ?>

	<?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>

    </div>
<?php endif; ?>

</div>