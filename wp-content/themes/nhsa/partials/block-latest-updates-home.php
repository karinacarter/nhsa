<div class="block-latest-updates">
    <div class="block-content">
        <h4>
            Latest Updates
        </h4>


		<?php
		$current_category = get_field( 'category' );
if (strtolower($current_category) == 'none' ){
	$current_category = '';
}
		$args         = array(
			'posts_per_page' => 1,

			'post_type' => 'resources', // must

			'order'     => 'desc',
			'meta_query'	=> array(
				'relation'		=> 'AND',
				array(
					'key'	 	=> 'category',
					'value'	  	=> array(get_sub_field( 'first_' )),
					'compare' 	=> 'IN',
				)
			),
		);
		$post_objects = get_posts( $args );

		if ( $post_objects ): ?>

			<?php foreach ( $post_objects as $post ): // variable must be called $post (IMPORTANT) ?>
				<?php setup_postdata( $post );
				$category = get_field('category',  $post_object->ID);
				$catObject = get_field_object('category',  $post_object->ID);
				$category =  strtolower($category);
				$category = str_replace(' ', '-', $category);
				if (strtolower($current_category) ==  strtolower($category) OR strtolower($category) == 'none'){


					$classname=' nocatname';
				}
				?>
                <div class="update-item <?=$classname;?>">
                    <div class="category"><?=$catObject['choices'][$category]?></div>
					<?php if(get_field('image')){
						$image = get_field('image');
						$size = 'latestUpdateImage'; // (thumbnail, medium, large, full or custom size)
						?>

                        <div class="image"><?= wp_get_attachment_image( $image[0]['image'], $size);?></div>
					<?php }else{
						?><div class="image"><img alt="" src="/wp-content/themes/nhsa/images/default/<?=$category?>.jpg"></div><?php
					}
					?>
                    <a href="<?=the_permalink();?>"><?php echo wp_trim_words( get_the_title(), 3, '...' ); ?></a>
                    <div class="teaser_text"><?php
						//$content = the_excerpt();
						echo wp_trim_words( get_the_content(), 10, '...' ); ?></div>

                    <a href="<?=the_permalink();?>">VIEW FULL ARTICLE</a>
                </div>

			<?php endforeach; ?>

			<?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>
		<?php endif;
		?>




	    <?php

	    $args         = array(
		    'posts_per_page' => 1,

		    'post_type' => 'resources', // must

		    'order'     => 'desc',
		    'meta_query'	=> array(
			    'relation'		=> 'AND',
			    array(
				    'key'	 	=> 'category',
				    'value'	  	=> array(get_sub_field( 'second_' )),
				    'compare' 	=> 'IN',
			    )
		    ),
	    );
	    $post_objects = get_posts( $args );

	    if ( $post_objects ): ?>

		    <?php foreach ( $post_objects as $post ): // variable must be called $post (IMPORTANT) ?>
			    <?php setup_postdata( $post );
			    $category = get_field('category',  $post_object->ID);
			    $category =  strtolower($category);
			    $category = str_replace(' ', '-', $category);
			    if (strtolower($current_category) ==  strtolower($category) OR strtolower($category) == 'none'){


				    $classname=' nocatname';
			    }
			    ?>
                <div class="update-item <?=$classname;?>">
                    <div class="category"><?= the_field('category',  $post_object->ID)?></div>
				    <?php if(get_field('image')){
					    $image = get_field('image');
					    $size = 'latestUpdateImage'; // (thumbnail, medium, large, full or custom size)
					    ?>

                        <div class="image"><?= wp_get_attachment_image( $image[0]['image'], $size);?></div>
				    <?php }else{
					    ?><div class="image"><img alt="" src="/wp-content/themes/nhsa/images/default/<?=$category?>.jpg"></div><?php
				    }
				    ?>
                    <a href="<?=the_permalink();?>"><?php echo wp_trim_words( get_the_title(), 3, '...' ); ?></a>
                    <div class="teaser_text"><?php
					    //$content = the_excerpt();
					    echo wp_trim_words( get_the_content(), 10, '...' ); ?></div>

                    <a href="<?=the_permalink();?>">VIEW FULL ARTICLE</a>
                </div>

		    <?php endforeach; ?>

		    <?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>
	    <?php endif;
	    ?>

	    <?php

	    $args         = array(
		    'posts_per_page' => 1,

		    'post_type' => 'resources', // must

		    'order'     => 'desc',
		    'meta_query'	=> array(
			    'relation'		=> 'AND',
			    array(
				    'key'	 	=> 'category',
				    'value'	  	=> array(get_sub_field( 'third' )),
				    'compare' 	=> 'IN',
			    )
		    ),
	    );
	    $post_objects = get_posts( $args );

	    if ( $post_objects ): ?>

		    <?php foreach ( $post_objects as $post ): // variable must be called $post (IMPORTANT) ?>
			    <?php setup_postdata( $post );
                $category = get_field('category',  $post_object->ID);
                $category =  strtolower($category);
                $category = str_replace(' ', '-', $category);
                if (strtolower($current_category) ==  strtolower($category) OR strtolower($category) == 'none'){


                $classname=' nocatname';
                }
                ?>
                <div class="update-item <?=$classname;?>">
                    <div class="category"><?= the_field('category',  $post_object->ID)?></div>
				    <?php if(get_field('image')){
					    $image = get_field('image');
					    $size = 'latestUpdateImage'; // (thumbnail, medium, large, full or custom size)
					    ?>

                        <div class="image"><?= wp_get_attachment_image( $image[0]['image'], $size);?></div>
				    <?php }else{
					    ?><div class="image"><img alt="" src="/wp-content/themes/nhsa/images/default/<?=$category?>.jpg"></div><?php
				    }
				    ?>
                    <a href="<?=the_permalink();?>"><?php echo wp_trim_words( get_the_title(), 3, '...' ); ?></a>
                    <div class="teaser_text"><?php
					    //$content = the_excerpt();
					    echo wp_trim_words( get_the_content(), 10, '...' ); ?></div>

                    <a href="<?=the_permalink();?>">VIEW FULL ARTICLE</a>
                </div>

		    <?php endforeach; ?>

		    <?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>
	    <?php endif;
	    ?>


    </div>
    <div><a href="/resources" class="btn">View All <?= $current_category; ?> Updates</a></div>

</div>