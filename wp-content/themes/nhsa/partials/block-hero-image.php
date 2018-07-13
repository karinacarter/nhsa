	<?php
	$image = get_field( 'header_image' );
	$size  = 'HeroImage'; // (thumbnail, medium, large, full or custom size)
	//$size = "full";
	if ( $image) {

		$backgroundImage = 'style="background-image:url('.wp_get_attachment_image_url( $image, $size ).')"';

	}else{
	    if (is_post_type_archive()){
		    $backgroundImage = 'style="background-image:url(/wp-content/themes/nhsa/images/default/header-'.get_post_type().'.jpg)"';


	    }
    }


	?>
    <div class="header-image" <?=$backgroundImage; ?>">

    <div class="blackoverlay"></div>
    <div class="header-title">
        <h1><?php
            if (get_query_var( 'type' ) == 'resource'){
                echo "Resources";
            }else{

			if ( ! empty( get_field( 'header_title' ) ) ) {
				the_field( 'header_title' );
			} else {
            if (!is_post_type_archive()){
                the_title();
            }else{
	            echo post_type_archive_title( $prefix, $display );
            }

			}}
			?></h1>
        <?php if ( ! empty( get_field( 'header_sub_title' ) ) OR  get_field( 'header_sub_title' ) ==' ') {
            ?>

        <div class="subhead"><?= the_field( 'header_sub_title' ); ?></div>
<?php } ?>

    </div>


</div>
