<?php
/*
Template Name: partners
*/
get_header();
?>

    <main>
        <?php get_template_part('template-parts/breadcrumbs'); ?>
        <section class="section">
            <div class="container">
                <div class="inner-container">
                    <h2 class="page-title partners-title"><?php the_title(); ?></h2>
                    <div class="partners">
                        <?php
                        $repeater_data = get_field('partners');
                        foreach ($repeater_data as $row) : ?>
                            <div class="partners-item">
                                <img src="<?= $row['image']; ?>" alt="image">
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
        </section>
    </main>


<?php get_footer(); ?>