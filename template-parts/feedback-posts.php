<?php
global $post;

$myposts = get_posts([ 
    'post_type'      => 'feedbacks',
    'numberposts'    => -1,
    'posts_per_page' => -1,
    'order'          => 'DESC',  
    'orderby'        => 'modified'
]);

$step = 4;
$arrOfArr = [];

function breakUp($posts, $step) {
    $newArr = [];
    for ($i = 0; $i < count($posts); $i += $step) {
        $newArr[] = array_slice($posts, $i, $step);
    }
    return $newArr;
}

$arrOfArr = breakUp($myposts, $step);

foreach ($arrOfArr as $block) { ?>
<div class="swiper-slide feedback-section__slide">
  <div class="grid feedback-section__wrapper">
    <div class="grid-sizer"></div>

    <?php foreach ($block as $article) {  
      // print_r($article); ?>
    <article class="grid-item feedback-post">
      <?php 

    $content = wp_trim_words($article->post_content);
    $excerpt = wp_trim_words($article->post_content, 40); 

    $excerptLength = strlen($excerpt);
    $contentLength = strlen($content); ?>

      <div class="feedback-post__box">
        <?php if ($excerptLength < $contentLength) { ?>
        <div class="feedback-post__excerpt"><?php if($excerpt) echo $excerpt; ?></div>
        <button class='feedback-post__btn' type='button'><?php the_field('read_more_btn', 'option'); ?></button>
        <?php } else { ?>
        <div class="feedback-post__content">
          <?php if($content) echo $content; ?>
        </div>
        <?php } ?>
      </div>

      <div class="feedback-post__author"><?php echo $article->post_title; ?></div>
      <h2 class="feedback-post__author-role"><?php echo get_field('author_role', $article->ID); ?></h2>
    </article>
    <?php } ?>
  </div>
</div>
<?php }

wp_reset_postdata(); ?>