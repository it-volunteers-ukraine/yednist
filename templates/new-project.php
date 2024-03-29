<?php
/*
Template Name: new-project
*/
get_header();
?>

<main>
    <?php get_template_part('template-parts/breadcrumbs'); ?>
        <section class="section new-project__section">
        <div class="container">
            <div class="inner-container">
                <h1 class="new-project__title page-title">
                    <?php the_field('new-project_title'); ?>
                </h1>
                <div class="new-project__image-wrapper">
                    <?php if (get_field('new-project_photo-main')): ?>
                        <img src="<?php the_field('new-project_photo-main'); ?>" />
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>
    <section class="section new-project__section">
        <div class="container">
            <h2 class="new-project__subtitle section-title">
                <?php the_field('new-project_aim-title'); ?>
            </h2>
            <div class="inner-container">
                <div class="new-project__aim-wrapper">
                    <div class="new-project__aim-image-wrapper">
                    <?php if (get_field('new-project_photo-aim')): ?>
                        <img src="<?php the_field('new-project_photo-aim'); ?>" />
                    <?php endif; ?>
                    </div>
                    <div class="new-project__aim-text-wrapper">
                        <p class="new-project__aim-text">
                        <?php the_field('new-project_aim-text'); ?>
                        </p>
                        <a class="button primary-button new-project__btn"
                        href="<?php echo esc_attr(get_field('support_link', 'option') ); ?>">
                        <?php the_field('support_btn', 'option'); ?></a>
                    </div>
                    
                </div>
                </div>
                </div>
                </section>
</main>

<?php get_footer(); ?>