<?php
/*
Template Name: team
*/
get_header();
?>


    <main>
        <section class="section">
            <div class="container">
                <div class="inner-container">
                    <h1 class="page-title team-title"><?php the_title(); ?></h1>
                    <div class="team-image">
                        <img src="<?php the_field('image'); ?>" alt="team-image">
                    </div>
                </div>
            </div>
        </section>


        <section class="section">
            <div class="container">
                <h2 class="section-title members-title"><?php the_field('title'); ?></h2>
                <div class="inner-container">
                    <div class="team-members">
                        <?php
                        $teamMembers = get_field('team-members');
                        foreach ($teamMembers as $row) : ?>
                            <div class="team-member">
                                <div class="team-image">
                                    <img src="<?= $row['image']; ?>" alt="image">
                                    <div class="block">
                                        <div class="info"><?= $row['hover-info']; ?></div>
                                    </div>
                                </div>
                                <span><?= $row['description']; ?></span>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </section>
    </main>


<?php get_footer(); ?>