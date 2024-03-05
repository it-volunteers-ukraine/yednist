<?php
/*
Template Name: fioh-team
*/
get_header();
?>

<main>
     <?php get_template_part( 'template-parts/breadcrumbs' ); ?> 
      <section class="section fioh-team__section"> 
        <div class="container">            
            <div class="inner-container">
                <h1 class="fioh-team__title page-title"><?php the_field('fioh-page_title'); ?></h1>
                <div class="fioh-team__image-wrapper">
                    <?php if (get_field('fioh-page_photo-main')): ?>
                        <img src="<?php the_field('fioh-page_photo-main'); ?>" />
                    <?php endif; ?>
                </div>
        </div>
        </div>
      </section> 
      <section class="section fioh-team__section"> 
        <div class="container">            
            <h2 class="fioh-team__subtitle section-title"><?php the_field('fioh-team_appeal-title'); ?></h2>
            <div class="inner-container">
                
                <div class="fioh-team__appeal-wrapper">
                    <p class="fioh-team__appeal-text-1"><?php the_field('fioh-team_appeal-text-1'); ?></p>
                    <p class="fioh-team__appeal-text-2"><?php the_field('fioh-team_appeal-text-2'); ?></p>
                    <p class="fioh-team__appeal-text-3"><?php the_field('fioh-team_appeal-text-3'); ?></p>
                    <p class="fioh-team__appeal-text-4"><?php the_field('fioh-team_appeal-text-4'); ?></p>
                    <p class="fioh-team__appeal-text-5"><?php the_field('fioh-team_appeal-text-5'); ?></p>
                    <p class="fioh-team__appeal-text-6"><?php the_field('fioh-team_appeal-text-6'); ?></p>
                </div>
        </div>
        </div>
      </section> 
      <section class="section fioh-team__section"> 
        <div class="container">            
            <h2 class="fioh-team__subtitle section-title"><?php the_field('fioh-team_projects-title'); ?></h2>
            <div class="inner-container">
                
                        
<!-- <ul class="project__list"> -->
          <?php
$total_rows = count(get_field("fioh-team_projects-repeater")); # всього постів
$count = 0;  # лічильник
$number = 3; # скільки відображати на сторінці
?>


<?php
// Якщо є вкладені поля
if (have_rows("fioh-team_projects-repeater")) { ?>

    <ul class="fioh-team__project__list">

        <?php
        while (have_rows("fioh-team_projects-repeater")) {
            the_row();

            if ($count == $number) {
                break; # якщо показали всі пости, виходимо з циклу
            } ?>

          <?php $projectName = get_sub_field("fioh-team_projects-repeater-title"); ?>
          <?php $projectLink = get_sub_field("fioh-team_projects-repeater-link"); ?>

          <li class="fioh-team__project__item">
                <div class="fioh-team__project__link">
                <?php echo $projectLink; ?>
                </div>
                <div class="fioh-team__project__name">
                    <p>
                <?php echo $projectName; ?>
                </p>
                </div>
              </li>
            <?php
            $count++;
        } ?>
      </ul>
<?php } ?>
          
       <div class="loadmore-wrapper">
           <button class="btn acf-loadmore button primary-button" onclick="javascript: acf_repeater_show_more();"
    <?php if ($total_rows < $count) : ?> style="display: none;" <?php endif; ?>>
    усі відео
</button>
       </div>
          
<!-- AJAX завантаження -->
<script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
<script>
  let buttonACF = document.querySelector('.acf-loadmore');
    let my_repeater_field_post_id = <?php echo $post->ID; ?>;
    let my_repeater_field_offset = <?php echo $number; ?>;
    let my_repeater_field_nonce = "<?php echo wp_create_nonce("my_repeater_field_nonce"); ?>";
    let my_repeater_ajax_url = "<?php echo admin_url("admin-ajax.php"); ?>";
    let my_repeater_more = true;

    function acf_repeater_show_more() {
      buttonACF.classList.add('loading');
        // робимо AJAX запит
        jQuery.post(my_repeater_ajax_url, {

            // AJAX, який ми налагодили в PHP
            "action": "acf_repeater_show_more",
            "post_id": my_repeater_field_post_id,
            "offset": my_repeater_field_offset,
            "nonce": my_repeater_field_nonce
        }, function (json) {
            // додаємо контент в контейнер
            // цей ідентифікатор має відповідати контейнеру
            // до якого ви хочете додати контент
            jQuery(".project__list").append(json["content"]);
            // оновимо зміщення
            my_repeater_field_offset = json["offset"];
            // перевіримо, чи є ще що завантажити
            if (!json["more"]) { // якщо ні, сховаємо кнопку завантаження
                jQuery(".acf-loadmore").css("display", "none");
            }
            else {
            buttonACF.classList.remove('loading');
        }
        }, "json");
    }
</script>

          <!-- </ul> -->
        </div>
        </div>
      </section> 
      <section class="section fioh-team__section"> 
        <div class="container">           
            <h2 class="fioh-team__subtitle section-title"><?php the_field('fioh-team_team-title'); ?></h2> 
            <div class="inner-container">
                

                    <?php if( have_rows('fioh-team_team-repeater') ): ?>
    <ul class="fioh-team__team-repeater">
    <?php while( have_rows('fioh-team_team-repeater') ): the_row(); 
        $name = get_sub_field('fioh-team_team-repeater-name');
        $age = get_sub_field('fioh-team_team-repeater-age');
        $bio = get_sub_field('fioh-team_team-repeater-bio');
        $image = get_sub_field('fioh-team_team-repeater-photo');
        ?>
        <li class="fioh-team__team-repeater-item">
            <div class="fioh-team__team-repeater-img" >
                <img 
                src="<?php echo $image['url']; ?>" 
                alt="<?php echo $image['alt']; ?>"/>
            </div>
            <div>
            <p class="fioh-team__team-repeater-item-bio"><?php echo $bio; ?></p>
            <p class="fioh-team__team-repeater-item-info">
                <span class="fioh-team__team-repeater-item-name"><?php echo $name; ?></span>
                <span class="fioh-team__team-repeater-item-age"><?php echo $age; ?></span>
            </p>
            </div>
        </li>
    <?php endwhile; ?>
    </ul>
<?php endif; ?>

        </div>
        </div>
      </section>           
</main>
<?php get_footer(); ?>