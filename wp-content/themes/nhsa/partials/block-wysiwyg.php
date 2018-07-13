<div class="block-wyswig">
    <div class="content">
		<?php if ( get_sub_field( 'image' )["url"] ) { ?>

            <div class="image">
                <img src="<?= get_sub_field( 'image' )["url"]; ?>">
            </div>
		<?php } ?>
        <h2><?= get_sub_field( 'title' ); ?></h2>
        <div><?= get_sub_field( 'content' ); ?></div>
    </div>
	<?php if ( get_sub_field( 'bullets' ) ) {

		?>
        <ul class="bullets">


			<?php
			while ( has_sub_field( 'bullets' ) ): ?>

                <li><?php the_sub_field( 'item' ); ?></li>

			<?php endwhile; ?>

        </ul>

	<?php } ?>


</div>
