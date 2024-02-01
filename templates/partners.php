<?php
/*
Template Name: partners
*/
get_header();
?>

    <section class="section">
        <div class="container">
            <div class="wrapper">
                <h2 class="page-title"><?php the_title();?></h2>
                <div class="partners">
                    <?php
                    $repeater_data = get_field('partners');
                    foreach ($repeater_data as $row) : ?>
                        <div class="partners-item">
                            <img src="<?= $row['image'];?>" alt="image">
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
    </section>

<?php get_footer(); ?>