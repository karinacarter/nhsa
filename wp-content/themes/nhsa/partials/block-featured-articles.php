<div class="block-featured-article">
    <div class="slides">


        <?php


        $current_category = get_field('category');




        $meta_query = array(
            'relation' => 'AND',
        );


        if ($current_category != "none"){
            $categoryArray = array(
                'key' => 'category',
                'value' => $current_category,
                'compare' => '='
            );

            array_push($meta_query, $categoryArray);
        }else{
            $current_category = "";
        }
        // query events order
        $post_objects = get_posts(array(
            'posts_per_page'	=> 3,
            'post_type'			=> 'resources',
            'post_status' => 'publish',
            'orderby'     => 'publish_date',
            'order'       => 'DESC',
            'meta_query' => $meta_query

        ));



        $is_first = '';

        $query_args = array();
        //var_dump($post_objects);

        if ($post_objects): ?>
            <?php foreach ($post_objects as $post): // variable must be called $post (IMPORTANT)    ?>
                <?php setup_postdata($post);
                $category = get_field('category',  $post_object->ID);
                $category =  strtolower($category);
                $category = str_replace(' ', '-', $category);
                ?>
                <div class="slide " >
                    <div class="featured-image ">
                        <?php if(get_field('image')) {
	                        $image    = get_field( 'image' );
	                        $size     = 'latestUpdateImage'; // (thumbnail, medium, large, full or custom size)
	                        $imageURL = wp_get_attachment_image_url( $image[0]['image'], $size );
                        }else {
	                        $imageURL = '/wp-content/themes/nhsa/images/default/' . $category . '.jpg';
                        }
	                    ?>

                        <div class="image" style='background-image:url(<?=$imageURL;?>); height:100vh; max-height: 500px;background-size: cover; background-position: center center'></div>


                    </div>
                    <div class="featured-content matchContentHeight2">
                        <h3>FEATURED ARTICLES</h3>
                        <a href="<?= the_permalink(); ?>" class="article-title"><?= the_title(); ?></a><br>
                        <?= the_excerpt(); ?>
                        <div class="featured-links">
                            <a href="<?= the_permalink(); ?>">VIEW FULL STORY</a>
                            <a href="/resources">VIEW ALL ARTICLES</a>
                        </div>
                    </div>

                </div>



            <?php endforeach; ?>

            <?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>


        <?php endif;
        ?>


    </div>
</div>