<div class="feedback-block">

  <article class="feedback-post">
    <?php 
    $content = get_the_content();
     ?>
    <div class="feedback-post__box">
      <div class="feedback-post__content"><?php if($content): echo $content; endif; ?></div>
      <button class="feedback-post__btn" type="button"><?php the_field('read_more_btn', 'option'); ?></button>
    </div>
    <div class="feedback-post__author"><?php the_title(); ?></div>
    <h2 class="feedback-post__author-role"><?php the_field('author_role'); ?></h2>
  </article>

</div>