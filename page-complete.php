<?php
/**
 * Copyright (c) 2018 Callan Peter Milne
 *
 * Permission to use, copy, modify, and/or distribute this software for any
 * purpose with or without fee is hereby granted, provided that the above
 * copyright notice and this permission notice appear in all copies.
 *
 * THE SOFTWARE IS PROVIDED "AS IS" AND THE AUTHOR DISCLAIMS ALL WARRANTIES WITH
 * REGARD TO THIS SOFTWARE INCLUDING ALL IMPLIED WARRANTIES OF MERCHANTABILITY
 * AND FITNESS. IN NO EVENT SHALL THE AUTHOR BE LIABLE FOR ANY SPECIAL, DIRECT,
 * INDIRECT, OR CONSEQUENTIAL DAMAGES OR ANY DAMAGES WHATSOEVER RESULTING FROM
 * LOSS OF USE, DATA OR PROFITS, WHETHER IN AN ACTION OF CONTRACT, NEGLIGENCE OR
 * OTHER TORTIOUS ACTION, ARISING OUT OF OR IN CONNECTION WITH THE USE OR
 * PERFORMANCE OF THIS SOFTWARE.
 */
if ("/order/complete" === $_REQUEST["from-page"]) {
  $app_order_info = array(
    'post_title'    => wp_strip_all_tags($_REQUEST["order-id"]) . " (Additional Info)",
    'post_content'  => htmlentities(json_encode($_REQUEST)),
    'post_type'     => 'eviratec_site_feature',
    'post_status'   => 'publish',
    'post_author'   => 1,
    'post_category' => array()
  );
  wp_insert_post($app_order_info);
  header("Location: /");
  exit;
}
?>
<?php get_header( 'order-complete' ); ?>

<section id="content" role="main" class="step order-step-content">

  <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

      <section class="entry-content">
        <?php if ( has_post_thumbnail() ) { the_post_thumbnail(); } ?>
        <?php the_content(); ?>
        <div class="entry-links"><?php wp_link_pages(); ?></div>
      </section>

    </article>

  <?php endwhile; endif; ?>

  <div id="AdditionalDetails">

    <div class="additional-details-wrapper">
      <div class="additional-details">
        <header>
          <h1>
            Awesome!
          </h1>
          <p>
            Please fill out the remaining details required to publish your site.
          </p>
        </header>
        <section class="details-form">

          <ul class="detail-cards-vertical">

            <li class="detail-card">
              <header>
                <h3>
                  Store Type
                </h3>
              </header>
              <div class="detail-card-body">
                <select name="store-type"
                  placeholder="Select one">
                  <option>Takeaway / fast-food</option>
                  <option>Health food</option>
                  <option>Dining</option>
                </select>
              </div>
            </li>

            <li class="detail-card">
              <header>
                <h3>
                  Business Name
                </h3>
                <p>
                  This is your franchise or over-arching business name
                </p>
              </header>
              <div class="detail-card-body">
                <input name="business-name"
                  placeholder="E.g. Simpsons Burgers"
                  value="" />
              </div>
            </li>

            <li class="detail-card">
              <header>
                <h3>
                  Store Name
                </h3>
                <p>
                  The specific store usually with a location
                </p>
              </header>
              <div class="detail-card-body">
                <input name="business-name"
                  placeholder="E.g. Simpsons Burgers (Russell St)"
                  value="" />
              </div>
            </li>

            <li class="detail-card">
              <header>
                <h3>
                  Store Address
                </h3>
                <p>
                  Number, Street, Shopping Centre etc.
                </p>
              </header>
              <div class="detail-card-body">
                <input name="business-name"
                  placeholder="E.g. 143 Russell St, Melbourne VIC"
                  value="" />
              </div>
            </li>

          </ul>

        </section>
      </div>

    </div>

  </div>

</section>

<?php
$steps = array(
  array(
    "icon" => "smartphone",
    "label" => "Customise your app",
    "complete" => true
  ),
  array(
    "icon" => "payment",
    "label" => "Payment",
    "complete" => true
  ),
  array(
    "icon" => "assignment",
    "label" => "Additional details",
    "complete" => false
  ),
  array(
    "icon" => "sentiment_very_satisfied",
    "label" => "Go live",
    "complete" => false
  ),
);
?>

<div id="OrderProgress">
  <span class="spacer"></span>
  <div class="steps-wrapper">
    <span class="spacer"></span>
    <ul class="steps">

      <?php foreach ($steps as $step) : ?>
      <li class="step <?php echo true === $step['complete'] ? 'step-complete' : ''; ?>">
        <div class="step-complete-indicator">
          <span class="material-icons">
            check
          </span>
        </div>
        <div class="step-icon">
          <span class="spacer"></span>
          <span class="material-icons">
            <?php echo $step['icon']; ?>
          </span>
          <span class="spacer"></span>
        </div>
        <div class="step-info">
          <p>
            <?php echo $step['label']; ?>
          </p>
        </div>
      </li>
      <?php endforeach; ?>

    </ul>
    <span class="spacer"></span>
  </div>
  <span class="spacer"></span>
</div>

<?php get_footer( 'order-complete' ); ?>
