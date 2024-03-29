<?php
/*
Template Name: about
*/
get_header();
global $post;
?>
<main class="about">  
    <?php get_template_part( 'template-parts/breadcrumbs' ); ?>   
     <section class="about__hero section"> 
        <div class="container">            
            <div class="inner-container">
               <h2 class="about__title page-title"><?php the_field('about-title'); ?></h2>
                <div class="about__img">
                    <img src="<?php the_field('about-img-hero'); ?>" alt="hero">                    
                </div>
                <div class="about__purpose">
                    <div class="about__mission"><p><?php the_field('about-mission'); ?></p></div>
                    <div class="about__message">
                        <div class="about__message-row">
                            <div class="about__message-block about__message-first"><p><?php the_field('about-message-1'); ?></p></div>
                            <div class="about__message-block about__message-second"><p><?php the_field('about-message-2'); ?></p></div>
                        </div> 
                        <div class="about__message-column about__message-block">
                            <p><?php the_field('about-message-3'); ?></p>
                        </div> 
                    </div> 
                </div>
            </div>  
        </div>    
    </section>  
    <section class="about__activity section"> 
        <div class="container"> 
            <h2 class="about__activity-title section-title"><?php the_field('about-activity'); ?></h2>           
            <div class="inner-container">
                <div class="about__activity-body">
                    <p class="about__activity-text"><?php the_field('about-activity-text'); ?></p>  
                </div> 
            </div>     
        </div>
    </section>     
    <section class="about__gallery section"> 
        <div class="container"> 
            <h2 class="about__gallery-title section-title"><?php the_field('about-gallery'); ?></h2>           
            <div class="inner-container">
                <div class="about__gallery-body">
                    <div class="gallery">
                        <div class="gallery__body">
                             <?php get_template_part( 'template-parts/gallery-section' ); ?> 
                            <div class="about__gallery-album">
                                <div class="about__gallery-img"><img src="<?php the_field('about-img-album'); ?>" alt="album"></div>
                                <a href="<?php the_field('about-gallery-link'); ?>" class= "about__gallery-link" target="_blank"><?php the_field('about-gallery-photo'); ?></a> 
                            </div>
                        </div>
                    </div> 
                    <div class="gallery-mobile">         
                        <?php get_template_part( 'template-parts/gallery-mobile' ); ?>  
                        <div class="gallery__body">                                                                                    
                            <a href="<?php the_field('about-gallery-link'); ?>" class= "about__gallery-link" target="_blank"><?php the_field('about-gallery-photo'); ?></a>                             
                        </div>
                    </div>  
                </div> 
            </div>     
        </div> 
    </section> 
    <section class="about__history section"> 
        <div class="container"> 
            <h2 class="section-title"><?php the_field('about-history'); ?></h2>           
            <div class="inner-container">
                <div class="about__history-body">
                    <?php get_template_part( 'template-parts/about-history' ); ?> 
                </div>
            </div>    
        </div>    
    </section>  
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
                                                <div class="about__documents-text"><p><?php echo $name ?></p></div>                                                
                                            </div>
                                        </a>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                        <button class="about__documents-button about-button-show"><?php the_field('about-button-show'); ?> <img src="<?php bloginfo('template_url'); ?>/assets/images/show.svg"> </button>
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
                                                <div class="about__documents-text"><p><?php echo $name ?></p></div>                                                
                                            </div>
                                        </a>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            <?php endif; ?>                        
                        </div> 
                        <button class="about__documents-button about-button-hide"><?php the_field('about-button-hide'); ?> <img src="<?php bloginfo('template_url'); ?>/assets/images/hide.svg"> </button>                   
                    </div>
                </div>
            </div>    
        </div>    
    </section>                        
</main>
<?php get_footer(); ?>
