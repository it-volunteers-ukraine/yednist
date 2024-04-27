<?php 
    $gallery_post_title = get_the_title();    
    $gallery_post_link = get_permalink();   
    $gallery_post_folder = get_field('gallery-post-folder'); 
    $gallery_post_img = get_field('gallery-post-image', $post)[0]['sizes']['medium_large'];
    $gallery_img_alt = get_post_meta(get_post_thumbnail_id(), '_wp_attachment_image_alt', true);      
    $gallery_post_date = get_field('gallery-post-date');
  ?>
<div class="gallery__item">
  <a href="<?php echo $gallery_post_link ?>">
    <?php if (has_post_thumbnail()): ?>
    <div class="gallery__post-img"><?php the_post_thumbnail('medium_large'); ?></div>
    <?php else: ?>
    <div class="gallery__post-img"><img src="<?php echo $gallery_post_img ?>"
        alt="<?php echo $gallery_img_alt ?>"></div>
    <?php endif; ?>
    <div class="gallery__post-content">
      <div class="gallery__post-block">
        <p class="gallery__post-cat"><?php echo $gallery_post_folder ?></p>
        <p class="gallery__post-title"><?php echo $gallery_post_title ?></p>
      </div>
      <div class="gallery__post-block">
        <p class="gallery__post-date"><?php echo $gallery_post_date ?></p>
      </div>
    </div>
  </a>
</div>