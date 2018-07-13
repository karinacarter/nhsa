<?php /* Template Name: Article/Event Listing Template */ ?>

<?php
get_header(); ?>
<div class="content">
<div class="header-image">
    <?=the_post_thumbnail();?>
    <h1><?= the_title( ); ?></h1>
</div>



    <div class="breadcrumbs">
        <?php if ( function_exists('yoast_breadcrumb') )
        {yoast_breadcrumb('<p id="breadcrumbs">','</p>');} ?>

    </div>
	<?php





	// check if the repeater field has rows of data
	if( have_rows('staff_or_board_member') ):
		// loop through the rows of data
		while ( have_rows('staff_or_board_member') ) : the_row();
?>
        <div class="staff" style="width: 30%; display:inline-block">
            <img style="width:100%" src="<?=the_sub_field('staff-image');?>" />

			<h3><?=the_sub_field('staff-name');?></h3>
            <h2><?=the_sub_field('staff-title');?></h2>
            <div class="bio">
	            <?=the_sub_field('staff-bio');?>
            </div>
        </div>
<?php

		endwhile;

	else :

		// no rows found

	endif;

	?>
</div>
<?php get_footer();?>
