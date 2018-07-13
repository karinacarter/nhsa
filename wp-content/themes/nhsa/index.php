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

</div>
<?php get_footer();?>
