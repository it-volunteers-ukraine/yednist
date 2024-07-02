<section class="about__documents section">
    <div class="container">
      <h2 class="section-title"><?php the_field('about-documents'); ?></h2>
      <div class="inner-container">
        <div class="about__documents-body">
          <div class="about__documents-part">
            <div class="about__documents-content">
              <?php  
                            $rows = get_field('documents');                            
                            if (!empty($rows)) : 
                                foreach ($rows as $row):
                                    $name = $row['doc__link__name'];
                                    $file = $row['doc__file'];
                                    $image = $row['doc__img'];
                                    if(!empty($file)): ?>
              <a href="<?php echo $file['url']; ?>" target='_blank'>
                <div class="about__documents-name">
                  <div class="about__documents-img"><?php echo wp_get_attachment_image( $image, 'full' );  ?></div>
                  <div class="about__documents-text">
                    <p><?php echo $name ?></p>
                  </div>
                </div>
              </a>
              <?php endif; ?>
              <?php endforeach; ?>
              <?php endif; ?>
            </div>
            <button class="about__documents-button about-button-show"><?php the_field('about-button-show'); ?> <img
                src="<?php bloginfo('template_url'); ?>/assets/images/show.svg"> </button>
          </div>
          <div class="about__documents-all">
            <div class="about__documents-content">
              <?php                    
                            $rows = get_field('documents');
                            if (!empty($rows)) : 
                                foreach ($rows as $row):
                                    $name = $row['doc__link__name'];
                                    $file = $row['doc__file'];
                                    $image = $row['doc__img'];
                                    if(!empty($file)): ?>
              <a href="<?php echo $file['url']; ?>" target='_blank'>
                <div class="about__documents-name">
                  <div class="about__documents-img"><?php echo wp_get_attachment_image( $image, 'full' );  ?></div>
                  <div class="about__documents-text">
                    <p><?php echo $name ?></p>
                  </div>
                </div>
              </a>
              <?php endif; ?>
              <?php endforeach; ?>
              <?php endif; ?>
            </div>
            <button class="about__documents-button about-button-hide"><?php the_field('about-button-hide'); ?> <img
                src="<?php bloginfo('template_url'); ?>/assets/images/hide.svg"> </button>
          </div>
        </div>
      </div>
    </div>
  </section>