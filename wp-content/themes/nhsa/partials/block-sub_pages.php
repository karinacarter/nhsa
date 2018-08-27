<div class="block-subpages">

    <div class="content">
		<?php

		$show_articles = get_sub_field( 'show_articles' );
		$post_objects  = get_sub_field( 'pages' );

		if ( $post_objects ): ?>

			<?php foreach ( $post_objects as $post ): // variable must be called $post (IMPORTANT) ?>
				<?php setup_postdata( $post ); ?>
                <div class="subPage">
                    <h3><a href="<?= the_permalink(); ?>"><?php the_title(); ?></a></h3>

                    <div class="teaser_text"><?php the_excerpt() ?></div>
                    <a href="<?= the_permalink(); ?>" class="btn">Learn More</a>
                </div>
			<?php endforeach; ?>

			<?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>
		<?php endif;
		if ( $show_articles != "No" ) { ?>


        <?php
            $all_tags = get_the_terms( get_the_ID(), 'tags');
            if(!$all_tags){
	            $all_artices_link = '/resources/filters/'.get_field('category',  $post_object->ID).'/all/';

            }else{
	            $all_artices_link = '/tags/';
			foreach ($all_tags as &$value) {
				$all_artices_link .= ",".$value->slug;
			}
                

            }

            ?>

            <div class="subPage">
                <h3><a href="<?=$all_artices_link?>">Articles</a></h3>
                <div class="teaser_text"><?= the_sub_field( 'article_text' ); ?></div>
                <a href="<?=$all_artices_link?>" class="btn">Learn More</a>
            </div>

			<?php

		}
		?>
    </div>
</div>
