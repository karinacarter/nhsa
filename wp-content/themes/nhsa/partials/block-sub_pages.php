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

        <div class="tags"><?php $terms = wp_get_object_terms( get_the_ID(), 'tags', '', ',' ); ?></div>

        <?php


    $category = get_field('category',  $post_object->ID);
var_dump(count($terms));
            ?>

            <div class="subPage">
                <h3><a href="<?php the_permalink(); ?>">Articles</a></h3>
                <div class="teaser_text"><?= the_sub_field( 'article_text' ); ?></div>
                <a href="/resources/filters/<?=$category?>/all/" class="btn">Learn More</a>
            </div>

			<?php

		}
		?>
    </div>
</div>
