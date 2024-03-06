<section class="breadcrumbs__section">
  <div class="container">
    <div class="breadcrumbs__line"></div>
    <div class="inner-container">
      <div class="breadcrumbs">
        <?php
          if ( function_exists('yoast_breadcrumb') ) {
            yoast_breadcrumb( '<p id="breadcrumbs">','</p>' );
          }
          ?>
      </div>
    </div>
  </div>
</section>