<?php
get_header(); ?>
<div class="content">
    <!-- Slider -->


	<?php // open the WordPress loop
	if (have_posts()) : while (have_posts()) : the_post();

		// are $size = 'full'; // (thumbnail, medium, large, full or custom size)

		get_template_part('partials/block', 'image-slider');

		if( have_rows('home_page') ):

			// loop through all the rows of flexible content
			while ( have_rows('home_page') ) : the_row();
				// Twitter Feed
				if( get_row_layout() == 'twitter' ){
					get_template_part('partials/block', 'twitter');

				}
				// Events
				if( get_row_layout() == 'events' ){
					get_template_part('partials/block', 'events');
				}
				// Latest Updates
				if( get_row_layout() == 'latest_updates' ){
					get_template_part('partials/block', 'latest-updates-home');
				}
				// ARticle Types in with a Purple Background
				if( get_row_layout() == 'pages_purple' ){
					get_template_part('partials/block', 'pages_purple');
			}

				// Centered Text Blocktext_block
				if( get_row_layout() == 'text_block' ){

					get_template_part('partials/block', 'text-block');
				}

				// Member Organizations
				if( get_row_layout() == 'member_organizations' ){
					get_template_part('partials/block', 'member-organizations');

				}

				// Collaboration Public Policy and Initiatives
				if( get_row_layout() == 'collaboration_public_policy_and_initiatives' ){
					get_template_part('partials/block', 'collaboration-public-policy-and-initiatives');

				}
			endwhile; // close the loop of flexible content
		endif; // close flexible content conditional

	endwhile; endif; // close the WordPress loop ?>

</div>
<?php get_footer();?>
