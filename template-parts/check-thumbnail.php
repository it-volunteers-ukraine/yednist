<?php if (has_post_thumbnail()) {
  the_post_thumbnail();
} else { ?>
<img src="<?php the_field('image-placeholder', "options") ?>" alt="логотип компанії">
<?php } ?>