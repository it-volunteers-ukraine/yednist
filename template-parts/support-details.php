<?php
if (isset($args['row'])) {
    $row = $args['row'];
}
?>

<div class="moneysupport__name-value">
  <p class="moneysupport__name"><?php echo $row['name']; ?></p>
  <div class="current_account">
    <p id="" class="moneysupport__value"><?php echo $row['value']; ?></p>
    <?php if ($row['icon_copy']) { ?>
    <button class="icon_copy" aria-label="copy string">
      <svg width="20px" height="20px">
        <use href="<?php echo get_template_directory_uri()?>/assets/images/sprite.svg#icon-copy_doc">
        </use>
      </svg>
      <svg id="" class="hidden-checkmark copy_current_account-js" width="8px" height="8px">
        <use href="<?php echo get_template_directory_uri()?>/assets/images/sprite.svg#icon-checkmark">
        </use>
      </svg>
    </button>
    <?php }?>
  </div>
</div>