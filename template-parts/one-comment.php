<article class="grid-item feedback-post">
  <?php 
    $fullContent = $post->post_content;
    $randomNumber = mt_rand(25, 40);

    $content = wp_trim_words($post->post_content, 80);
    $contentMobile = wp_trim_words($post->post_content, 60, "...");
    $contentDesktop = wp_trim_words($post->post_content, $randomNumber, "...");  

    $excerptMobileLength = strlen($contentMobile);
    $excerptDesktopLength = strlen($contentDesktop);
    $fullContentLength = strlen($content); ?>

  <div class="feedback-post__box feedback-post__box-mobile">
    <?php if ($excerptMobileLength < $fullContentLength) { ?>
    <div class="feedback-post__excerpt"><?php echo $contentMobile; ?></div>

    <button id="" class='feedback-open__btn' type='button' onclick='

      const fullText = this.nextElementSibling;
      const shortText = this.previousElementSibling;

      if(fullText.classList.contains("hidden")){
        this.innerHTML = `<?php the_field("hide_btn", "option"); ?>`;
        fullText.classList.remove("hidden");
        shortText.classList.add("hidden");
      } else {
        this.innerHTML = `<?php the_field("read_more_btn", "option"); ?>`;
        fullText.classList.add("hidden");
        shortText.classList.remove("hidden");
      }

      '><?php the_field('read_more_btn', 'option'); ?></button>

    <div class="feedback-post__content hidden">
      <?php if($fullContent) echo $fullContent; ?>
    </div>

    <?php } else { ?>
    <div class="feedback-post__content">
      <?php if($fullContent) echo $fullContent; ?>
    </div>
    <?php } ?>
  </div>


  <div class="feedback-post__box feedback-post__box-desktop">
    <?php if ($excerptDesktopLength < $fullContentLength) { ?>
    <div class="feedback-post__excerpt"><?php echo $contentDesktop; ?></div>

    <button id="read-more-js" class='feedback-open__btn' type='button' onclick='

      const fullText = this.nextElementSibling;
      const shortText = this.previousElementSibling;

      if(fullText.classList.contains("hidden")){
        this.innerHTML = `<?php the_field("hide_btn", "option"); ?>`;
        fullText.classList.remove("hidden");
        shortText.classList.add("hidden");
      } else {
        this.innerHTML = `<?php the_field("read_more_btn", "option"); ?>`;
        fullText.classList.add("hidden");
        shortText.classList.remove("hidden");
      }

      '><?php the_field('read_more_btn', 'option'); ?></button>

    <div class="feedback-post__content hidden">
      <?php if($fullContent) echo $fullContent; ?>
    </div>

    <?php } else { ?>
    <div class="feedback-post__content">
      <?php if($fullContent) echo $fullContent; ?>
    </div>
    <?php } ?>
  </div>


  <div class="feedback-post__author"><?php echo $post->post_title; ?></div>
  <div class="feedback-post__author-role"><?php echo get_field('author_role', $post->ID); ?></div>
</article>