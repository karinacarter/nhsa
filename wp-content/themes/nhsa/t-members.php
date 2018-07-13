<?php /* Template Name: Member Listing Template */ ?>
<?php

get_header(); ?>
<div class="members-page">
    <?php get_template_part( 'partials/block', 'hero-image' ); ?>

    <div class="content">
    <!-- Slider -->
    <?php
    $member_cats = array();


    // query events order
    $post_objects = get_posts(array(
        'posts_per_page' => -1,
        'post_type' => 'member_organizations',
        'order' => 'ASC',
        'orderby' => 'title',
        'relation' => 'OR', // Optional, defaults to "AND"
        array(
            'key' => 'category',
            'type' => 'PurchasisngPoint',
            'compare' => '='
        ),
        array(
            'relation' => 'AND',
            array(
                'key' => 'category',
                'type' => 'ncfy',
                'compare' => '='
            ),
            array(
                'key' => 'category',
                'type' => 'Home',
                'compare' => '='
            )
        )
    ));

    $query_args = array();


    $groups = Array();


    ksort($groups);


    if ($post_objects):
        $current_Letter = ''; ?>
        <div class="all_members">
            <?php foreach( $post_objects as $post): // variable must be called $post (IMPORTANT) ?>
            <?php setup_postdata($post);

            $startsWith = strtolower(mb_substr(get_the_title(), 0, 1, 'utf-8'));
                if  (get_field('url', $post_object->ID)){

           $logo .= '<a href="'.get_field('url', $post_object->ID).'" target="_blank">';
}


            $logo .= '<img src="' . get_field('logo', $post_object->ID) . '" alt="' . get_the_title() . '">';

                if  (get_field('url', $post_object->ID)) {

$logo .=' </a>';
                }

                if (array_key_exists($startsWith, $groups))
                array_push($groups[$startsWith], $logo);
            else {
                $groups[$startsWith] = Array($logo);
            }
$logo ='';
            ?><?php endforeach; ?>

<?php //var_dump($groups);

            echo "<div class='filter-navigation pagination'> <a class='all'>ALL</a> ";
                foreach (range('A', 'Z') as $char) {
                    if (array_key_exists(mb_strtolower($char), $groups)) {
                        echo '<a href="#">'.$char . " </a>";

                    }else{
                                    echo $char . " ";
                    }
                }
                echo "</div>";
            ?>
           <?php
           foreach($groups as $key => $value ) {
            ?>
            <div class="letter-group logo-group-<?php echo strtoupper($key) ?>"">
                <div class="letter"><?php echo strtoupper($key) ?></div>
                <?php foreach ($value as $member) { ?>
                    <div class="single-logo"><?php echo $member ?></div>
                <?php } ?>
            </div>
            <?php
    } ?>




            <?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>

        </div>
    <?php endif; ?>

</div>
<?php get_footer(); ?>
