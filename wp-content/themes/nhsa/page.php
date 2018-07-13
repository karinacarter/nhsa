<?php

get_header(); ?>
<div class="content">
	<!-- Slider -->



	<?php
	if (have_posts()) : while (have_posts()) : the_post();
		get_template_part('partials/block', 'hero-image');?>
		<div class="breadcrumbs">
			<?php if ( function_exists('yoast_breadcrumb') )
			{yoast_breadcrumb('<p id="breadcrumbs">','</p>');} ?>

		</div>
		<?php
		if( have_rows('simple-template') ):
			get_row_layout();
			// loop through all the rows of flexible content
			while ( have_rows('simple-template') ) : the_row();
				// Latest Updates
				if( get_row_layout() == 'latest_updates' ){
					get_template_part('partials/block', 'latest-updates');
				}
// Sub Pages
				if( get_row_layout() == 'sub_pages' ){
					get_template_part('partials/block', 'sub_pages');

				}
				// Centered Text Block
				if( get_row_layout() == 'text_block' ){
					get_template_part('partials/block', 'text-block');
				}



				// resources
				if( get_row_layout() == 'resources' ){
					get_template_part('partials/block', 'resources');
				}

				// wysiwyg
				if( get_row_layout() == 'wysiwyg' ){
					get_template_part('partials/block', 'wysiwyg');
				}


				// resources
				if( get_row_layout() == 'call_outs' ){
					get_template_part('partials/block', 'call-outs');
				}

				//featured_articles

				if( get_row_layout() == 'featured_articles' ){
					get_template_part('partials/block', 'featured-articles');

				}

				//member_organizations
				if( get_row_layout() == 'member_organizations' ){
					get_template_part('partials/block', 'member-organizations');
				}




			endwhile; // close the loop of flexible content
		endif; // close flexible content conditional

	endwhile; endif; // close the WordPress loop ?>

</div>
<?php get_footer();?>
