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
?>
<?php get_header( 'order' ); ?>

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

  <div style="display:none;">
    <div style="display:flex;flex-direction:column;">
      <h3>1x Location</h3>
      <div style="display:flex;flex-direction:row">
        <p>
          Features included:
        </p>
      </div>
    </div>

    <input type="hidden"
      name="next-step"
      value="/order/payment/">
    <input type="hidden"
      name="prev-step"
      value="/order/step-4/">

    <ul class="order-summary">
    <?php foreach ($_REQUEST as $k => $v) : ?>
      <?php if ("next-step" === $k
        || "prev-step" === $k
        || "-file" === substr($k, -5)) continue; ?>
      <li>
        <h4><?php echo esc_html($k); ?></h4>
        <?php echo esc_html($v); ?>
        <input type="hidden"
          name="<?php echo esc_attr($k); ?>"
          value="<?php echo esc_attr(stripslashes($v)); ?>">
      </li>
    <?php endforeach; ?>
    </ul>
  </div>

  <?php
  $features = new WP_Query( array(
    'post_type'      => 'site_feature',
    'posts_per_page' => -1,
    'meta_key'       => 'feature_display_order',
    'orderby'        => 'meta_value',
    'order'          => 'ASC'
  ) );
  ?>

  <div id="PaymentForm">
    <div class="payment-form-wrapper">
      <div class="payment-form">
        <header>
          <h1>
            Almost there!
          </h1>
          <p>
            Pay now to complete your order.
          </p>
        </header>
        <section class="order-form">
          <section class="locations-config">
            <div>
              Number of email addresses you want:
            </div>
            <div>
              <input id="OrderNumLocations"
                name="order_num_locations"
                type="number"
                value="1"
                min="1"
                required />
              <input id="PricePerLocation"
                type="hidden"
                value="<?php echo get_option('eviratec_order_option')['ta_price_per_location']; ?>" />
              <input id="PriceSetup"
                type="hidden"
                value="<?php echo get_option('eviratec_order_option')['ta_price_setup']; ?>" />
              <input id="TaxAmount"
                type="hidden"
                value="<?php echo get_option('eviratec_order_option')['ta_tax_amount']; ?>" />
              <input id="TaxApplies"
                type="hidden"
                value="<?php echo "1" === get_option('eviratec_order_option')['ta_apply_tax'] ? "1" : "0"; ?>" />
            </div>
          </section>

          <section class="order-line-items">
            <ul class="line-items">
              <li class="line-item">
                <div class="item-description">
                  <p>
                    Setup cost
                  </p>
                  <p class="line-item-desc">
                    <span class="label">Includes:</span>
                    WordPress Set-up, WooCommerce Set-up, Custom Theme Dev, and SSL Installation
                  </p>
                </div>
                <div class="item-price normal-price">

                </div>
                <div class="item-price">
                  <?php if (get_option('eviratec_order_option')['ta_price_setup_normal']) : ?>
                    <span class="normal-price">
                      &dollar;<?php echo get_option('eviratec_order_option')['ta_price_setup_normal']; ?>
                    </span>
                  <?php endif; ?>
                  <span>
                    &dollar;<?php echo get_option('eviratec_order_option')['ta_price_setup']; ?>
                  </span>
                </div>
              </li>

              <li class="line-item site-line-item">
                <div class="item-description">
                  <p>1x Mobile-first Responsive Online Store</p>
                  <p class="line-item-desc">
                    <span class="label">Features included:</span>
                    <?php $i = 0; ?>
                    <?php if ($features->have_posts()) : ?>
                      <?php while ($features->have_posts()) : ?>
                        <?php $features->the_post(); ?>
                        <?php if ($_REQUEST["feature-".get_the_ID()]) : ?>
                          <?php if ($i >= 1) : ?>, <?php endif; ?>
                          <span class="included-module-display-name">
                            <?php the_title(); ?>
                          </span>
                          <?php $i++; ?>
                        <?php endif; ?>
                      <?php endwhile; ?>
                      <?php wp_reset_postdata(); ?>
                    <?php endif; ?>
                  </p>
                </div>
                <div class="item-price">
                  &dollar;<span class="amount">99.00</span>
                </div>
              </li>

              <li class="line-item locations-line-item">
                <div class="item-description">
                  <p><span class="locations-num"></span>x Email Account(s)</p>
                  <p class="line-item-desc">
                    Provided by Gmail + Google Apps
                  </p>
                </div>
                <div class="item-price">
                  &dollar;<span class="amount"></span>
                </div>
              </li>

              <li class="line-item tax-line-item">
                <div class="item-description">
                  <p>
                    <?php echo get_option('eviratec_order_option')['ta_tax_type']; ?>
                    <span class="tax-amount">
                      (<?php echo get_option('eviratec_order_option')['ta_tax_amount']; ?>%)
                    </span>
                  </p>
                </div>
                <div class="item-price">
                  &dollar;<span class="amount"></span>
                </div>
              </li>

              <li class="lines-total">
                <div class="item-description">
                  <p>Total</p>
                </div>
                <div class="item-price">
                  &dollar;<span class="amount"></span>
                </div>
              </li>
            </ul>
          </section>

          <section class="order-button-container">
            <button id="ChoosePaymentMethod"
              class="btn">
              Order &amp; Pay Now
            </button>
            <p>
              Your app will be published for both iOS and Android
            </p>
          </section>
        </section>
      </div>
      <div class="app-preview">
        <?php get_sidebar( 'order' ); ?>
      </div>
    </div>
  </div>

  <input id="StripePublicKey"
    type="hidden"
    value="<?php echo get_option('eviratec_order_option')['stripe_pub_key']; ?>" />

  <input id="StripePaymentToken"
    name="stripe-payment-token"
    type="hidden"
    value="" />

  <script>
    (function ($) {"use strict";
      var DECIMAL_PLACES = 2;

      $("document").ready(function () {

        var $orderNumLocationsEl = $("input#OrderNumLocations");
        var $totalDisplayEl = $("li.lines-total div.item-price span.amount");
        var $dialogTotalDisplayEl = $("#PaymentModal div.payment-info span.total-amount");
        var $locTotalDisplayEl = $("li.line-item.locations-line-item div.item-price span.amount");
        var $taxTotalDisplayEl = $("li.line-item.tax-line-item div.item-price span.amount");
        var $locNumDisplayEl = $("li.line-item.locations-line-item div.item-description span.locations-num");

        var taxApplies = "1" === $("input#TaxApplies").val();
        var taxMultiplier = Number($("input#TaxAmount").val()) / 100;
        var priceSetup = Number($("input#PriceSetup").val());
        var pricePerLocation = Number($("input#PricePerLocation").val());

        $orderNumLocationsEl.change(function () {
          var numberOfLocations = Number($orderNumLocationsEl.val());
          if (numberOfLocations < 1) {
            $orderNumLocationsEl.val(1);
          }
          calcValues();
        });

        calcValues();

        function calcValues () {
          var numLocations = getNumLocations();
          var total = calcTotal();
          var locTotal = calcPriceLocations();
          var subTotal = calcSubTotal();
          var taxTotal = calcTax(calcSubTotal());
          $locNumDisplayEl.html(numLocations);
          updateTotalDisplay(total);
          updateLocTotalDisplay(locTotal);
          updateTaxTotalDisplay(taxTotal);
          window.tidyOrderData = {
            numLocations: numLocations,
            total: total,
            locTotal: locTotal,
            subTotal: subTotal,
            taxTotal: taxTotal,
          };
        }

        function calcTax (forAmount) {
          if (!taxApplies) {
            return 0.00;
          }
          return fixNumber(forAmount * taxMultiplier);
        }
        function calcSubTotal () {
          return fixNumber(calcPriceLocations() + priceSetup);
        }
        function calcTotal () {
          return fixNumber(calcSubTotal() + calcTax(calcSubTotal()));
        }

        function getNumLocations () {
          if ("0" === $orderNumLocationsEl.val()) {
            return 1;
          }
          return $orderNumLocationsEl.val();
        }

        function calcPriceLocations () {
          return fixNumber(getNumLocations() * pricePerLocation);
        }

        function fixNumber (n) {
          var num = Number(n);
          return parseFloat(num.toFixed(DECIMAL_PLACES));
        }

        function updateTotalDisplay (newValue) {
          var parsedValue = (Number(newValue)).toFixed(DECIMAL_PLACES);
          $totalDisplayEl.html(parsedValue);
          $dialogTotalDisplayEl.html(parsedValue);
        }
        function updateLocTotalDisplay(newValue) {
          $locTotalDisplayEl.html((Number(newValue)).toFixed(DECIMAL_PLACES));
        }
        function updateTaxTotalDisplay(newValue) {
          $taxTotalDisplayEl.html((Number(newValue)).toFixed(DECIMAL_PLACES));
        }

      });
    })(jQuery);
  </script>

</section>

<?php get_footer( 'order-payment' ); ?>
