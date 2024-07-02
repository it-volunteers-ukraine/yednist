<form action="<?php echo get_template_directory_uri()?>/create-donate.php" method="post"
  class="moneysupport__buttons--box">
  <div class="moneysupport__name-value">
    <label for="donation_amount" class="moneysupport__name"><?php the_field("payment_amount", "options") ?></label>
    <input class="current_account" type="number" id="donation_amount" name="donation_amount" min="1"
      placeholder="<?php the_field("enter_amount", "options") ?>" required>
  </div>
  <div class="moneysupport__name-value">
    <label for="donation_name" class="moneysupport__name"><?php the_field("payment_name", "options") ?></label>
    <input class="current_account" type="text" id="donation_name" name="donation_name"
      placeholder="<?php the_field("enter_name", "options") ?>" required>
  </div>
  <div class="moneysupport__name-value">
    <label for="donation_surname" class="moneysupport__name"><?php the_field("payment_surname", "options") ?></label>
    <input class="current_account" type="text" id="donation_surname" name="donation_surname"
      placeholder="<?php the_field("enter_surname", "options") ?>" required>
  </div>
  <div class="moneysupport__name-value">
    <label for="donation_email" class="moneysupport__name"><?php the_field("payment_email", "options") ?></label>
    <input class="current_account" type="email" id="donation_email" name="donation_email"
      placeholder="<?php the_field("enter_email", "options") ?>" required>
  </div>
  <button type="submit" class="button moneysupport__button" aria-label="support by PayU">
    <svg>
      <use href="<?php echo get_template_directory_uri()?>/assets/images/sprite.svg#icon_PayU"></use>
    </svg>
  </button>
</form>