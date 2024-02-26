 <div class="activity__flip-card">
   <div class="activity__flip-card-inner">
     <div class="activity__flip-card-front">
       <?php 
      $image = get_field('activity_big_image');
      $size = 'medium_large'; // (thumbnail, medium, large, full or custom size)
      if( $image ) {
          echo wp_get_attachment_image( $image, $size );
      } ?>
     </div>
     <div class="activity__flip-card-back">
       <div class="flip-card-back-second"></div>
       <div class="flip-card-back-first">
         <ul class="activity__description">
           <li class="activity__item">
             <div class="activity__icon">
               <svg>
                 <use href="<?php echo get_template_directory_uri()?>/assets/images/sprite.svg#icon_calendar"></use>
               </svg>
             </div>
             <p class="activity__text"><?php the_field('activity_date'); ?></p>
           </li>
           <li class="activity__item">
             <div class="activity__icon">
               <svg>
                 <use href="<?php echo get_template_directory_uri()?>/assets/images/sprite.svg#icon_map"></use>
               </svg>
             </div>
             <div class="activity__text"><?php the_field('activity_location'); ?></div>
           </li>
           <li class="activity__item">
             <div class="activity__icon">
               <svg>
                 <use href="<?php echo get_template_directory_uri()?>/assets/images/sprite.svg#icon_money"></use>
               </svg>
             </div>
             <div class="activity__text"><?php the_field('activity_price'); ?></div>
           </li>
           <li class="activity__item">
             <div class="activity__icon">
               <svg>
                 <use href="<?php echo get_template_directory_uri()?>/assets/images/sprite.svg#icon_people"></use>
               </svg>
             </div>
             <div class="activity__text">
               <?php
              $category = get_the_terms($post->ID, 'activities-target');
              foreach ($category as $cat) {
                echo $cat->name;
              }?>
             </div>
           </li>

         </ul>

         <?php get_template_part( 'template-parts/activity-buttons' ); ?>

       </div>
     </div>
   </div>
 </div>