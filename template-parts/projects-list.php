<div class='swiper projects__section__swiper'>
  <div class='swiper-wrapper'>
    <?php
    $current_language = (function_exists('pll_current_language')) ? pll_current_language('name') : '';
    $parent_slug = ($current_language == 'EN') ? 'projects-en' : (($current_language == 'УКР') ? 'projects-uk' : 'projects-pl');
    $parent_page = get_page_by_path($parent_slug);
    $pages = get_pages(array(
        'parent' => $parent_page->ID,
        'sort_column' => 'post_date',
        'sort_order' => 'DESC'
      ));
    $children = get_page_children($parent_page->ID, $pages);
    
    $slideArray = [];
    $chunks = array_chunk($children, 5);

      foreach ($chunks as $chunk) {
          array_push($slideArray, $chunk);
      }

      foreach ($slideArray as $key => $slide) { ?>
    <div class="swiper-slide projects__section__swiper-slide">
      <?php foreach ($slide as $child) {
       get_template_part( 'template-parts/one-project', null, array('child' => $child, 'parent_page' => $parent_page));
    }
    ?>
    </div>
    <?php }
    ?>


  </div>
</div>