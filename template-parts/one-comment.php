<article class="grid-item feedback-post">
  <?php 

    $content = wp_trim_words($post->post_content);
    $excerpt = wp_trim_words($post->post_content, 40); 

    $excerptLength = strlen($excerpt);
    $contentLength = strlen($content); ?>

  <div class="feedback-post__box">
    <?php if ($excerptLength < $contentLength) { ?>
    <div class="feedback-post__excerpt"><?php echo $excerpt; ?></div>
    <button class='feedback-post__btn' type='button'><?php the_field('read_more_btn', 'option'); ?></button>
    <?php } else { ?>
    <div class="feedback-post__content">
      <?php if($content) echo $content; ?>
    </div>
    <?php } ?>
  </div>

  <div class="feedback-post__author"><?php echo $post->post_title; ?></div>
  <h2 class="feedback-post__author-role"><?php echo get_field('author_role', $post->ID); ?></h2>
</article>