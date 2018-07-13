<?php /* Template Name: Level 2 Landing Template */ ?>
<?php

get_header(); ?>
<div class="content">
    <!-- Slider -->



    <?php
    if (have_posts()) : while (have_posts()) : the_post();
        get_template_part('partials/block', 'hero-image');

		if( have_rows('landing-template') ):

			// loop through all the rows of flexible content
			while ( have_rows('landing-template') ) : the_row();
//				print get_row_layout();
				// Latest Updates
				if( get_row_layout() == 'latest_update' ){
					get_template_part('partials/block', 'latest-updates');
				}

				// Centered Text Block
				if( get_row_layout() == 'text_block' ){

					the_sub_field('testing');

					get_template_part('partials/block', 'text-block');
				}

				// Sub Pages
				if( get_row_layout() == 'sub_pages' ){
				get_template_part('partials/block', 'sub_pages');

				}

				// resources
				if( get_row_layout() == 'resources' ){
					get_template_part('partials/block', 'resources');
				}

				// resources
				if( get_row_layout() == 'call_outs' ){
					get_template_part('partials/block', 'call-outs');
				}

                //featured_articles

                if( get_row_layout() == 'featured_articles' ){
					get_template_part('partials/block', 'featured-articles');

				}

				// Collaboration Public Policy and Initiatives
				if( get_row_layout() == 'collaboration_public_policy_and_initiatives' ){
					get_template_part('partials/block', 'collaboration_public_policy_and_initiatives');

				}




			endwhile; // close the loop of flexible content
		endif; // close flexible content conditional

	endwhile; endif; // close the WordPress loop ?>

</div>
<?php get_footer();?>
