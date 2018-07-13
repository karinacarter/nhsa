<div class="block-callouts">


<?php

/*
*  Loop through post objects (assuming this is a multi-select field) ( setup postdata )
*  Using this method, you can use all the normal WP functions as the $post object is temporarily initialized within the loop
*  Read more: http://codex.wordpress.org/Template_Tags/get_posts#Reset_after_Postlists_with_offset
*/

$post_objects = get_sub_field('call_outs');

if( $post_objects ): ?>
		<?php foreach( $post_objects as $post): // variable must be called $post (IMPORTANT) ?>
			<?php setup_postdata($post);
		$image = get_field( 'image' );

		if(!empty($image)){
			    $size  = 'mobileHomepagePurpleBoxes'; // (thumbnail, medium, large, full or custom size)
			    $backgroundImage = 'style="background-image:url('.wp_get_attachment_image_url( $image, $size ).')"';

    }
			?>







    <div class="call-out" <?=$backgroundImage; ?>>
        <div class="call-out-text">
          <h4><a href="<?php the_field('link'); ?>"><?php if (!empty(get_field('display_title'))){
              the_field('display_title');}else{the_title();} ?></a></h4>
                <span><?php the_field('content'); ?></span>
        <div class="button-links"><a href="<?php the_field('link'); ?>" class="btn">Learn More</a></div>
        </div>
    </div><?php endforeach; ?>



	<?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>
<?php endif;

?>
</div>
