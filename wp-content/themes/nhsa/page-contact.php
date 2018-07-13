<?php
get_header(); ?>
<div class="content">
    <?= get_template_part('partials/block', 'hero-image'); ?>
    <div class="contact-us">
        <div class="mainArea">
            <?php
            $general = get_field('general');
            if ($general) {

                ?>
                <h3>General Contacts</h3>

                <div class="address"><?= $general['address'] ?></div>
                <div class="email"><a href="mailto:<?= $general['email']; ?>"><?= $general['email'] ?></a></div>
                <div class="phone"><?= $general['phone']; ?></div>
                <?php
            }

            $communicationsmarketing = get_field('communicationsmarketing');
            if ($communicationsmarketing) {

                ?>
                <h3>COMMUNICATIONS/MARKETING</h3>

                <div class="email"><a
                            href="mailto:<?= $communicationsmarketing['email']; ?>"><?= $communicationsmarketing['email'] ?></a>
                </div>
                <div class="text"><?= $communicationsmarketing['text']; ?></div>
                <?php
            }

            ?>
        </div>
        <div class="sidebar">
            <?= the_field('contact_us_form'); ?>

        </div>
    </div>
</div>
<?php get_footer(); ?>
