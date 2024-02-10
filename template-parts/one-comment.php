<article class="grid-item feedback-post">
  <?php 
    $fullContent = $post->post_content;

    $content = wp_trim_words($post->post_content);
    $excerpt = wp_trim_words($post->post_content, 40); 

    $excerptLength = strlen($excerpt);
    $contentLength = strlen($content); 
    
    $randomNumber = rand(200, 280);?>

  <div class="feedback-post__box">
    <?php if ($excerptLength < $contentLength) { ?>
    <div id="read-more-container-js" class="feedback-post__excerpt" style="height: <?php echo $randomNumber?>px;">
      <?php if($fullContent) echo $fullContent; ?>
    </div>
    <button id="read-more-js" class='feedback-open__btn' type='button' onclick='

      const fullText = this.previousElementSibling;

      if(fullText.hasAttribute("style")){
        this.innerHTML = `<?php the_field("hide_btn", "option"); ?>`;
        fullText.classList.add("open");
        fullText.removeAttribute("style");
      } else {
        this.innerHTML = `<?php the_field("read_more_btn", "option"); ?>`;
        fullText.style.height = `<?php echo $randomNumber?>px`;
        fullText.classList.remove("open");
      }
      '>

      <?php the_field('read_more_btn', 'option'); ?></button>

    <?php } else { ?>
    <div class="feedback-post__content">
      <?php if($fullContent) echo $fullContent; ?>
    </div>
    <?php } ?>
  </div>

  <div class="feedback-post__author"><?php echo $post->post_title; ?></div>
  <h2 class="feedback-post__author-role"><?php echo get_field('author_role', $post->ID); ?></h2>
</article>