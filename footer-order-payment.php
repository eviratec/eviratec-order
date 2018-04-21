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
</div>
<!-- <div class="clear"></div> -->
</div>
</form>

<!-- Payment Modal -->
<div id="PaymentModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <form id="StripePaymentForm">
      <header>
        <h2>Pay now</h2>
        <span class="close">&times;</span>
      </header>
      <section class="modal-body">
        <p>Pay now to finalise your order.</p>
        <div id="card-element">
          <!-- A Stripe Element will be inserted here. -->
        </div>
        <div id="card-errors"></div>
      </section>
      <footer>
        <div class="payment-info">
          <strong>Total due:</strong>
          &dollar;
          <span class="total-amount">1234.50</span>
        </div>
        <div>
          <button id="ProcessPayment">
            Pay now
          </button>
          <div class="progress-view-wrapper">
            <div class="progress-indicator"></div>
            Processing Payment
          </div>
        </div>
      </footer>
    </form>
  </div>

</div>

<script>
  (function ($) {"use strict";
    var $modalEl = $('#PaymentModal');
    var $modalContentEl = $('#PaymentModal div.modal-content');
    var $paymentButtonEl = $("#ChoosePaymentMethod");
    var $closeModalButtonEl = $("#PaymentModal div.modal-content header span.close");

    $modalEl.click(function (event) {
      event.preventDefault();
      closeModal();
    });

    $closeModalButtonEl.click(function (event) {
      event.preventDefault();
      closeModal();
    });

    $modalContentEl.click(function (event) {
      event.preventDefault();
      event.stopPropagation();
    });

    $paymentButtonEl.click(function (event) {
      event.preventDefault();
      $modalEl.show();
    });

    function openModal () {
      $modalEl.show();
    }

    function closeModal () {
      $modalEl.hide();
    }
  })(jQuery);
</script>

<script>
  var X = function ($, Stripe, pubKey, submittable, onProcessing, stripeTokenHandler) {"use strict";

    // Create a Stripe client.
    var stripe = Stripe(pubKey);

    // Create an instance of Elements.
    var elements = stripe.elements();

    // Custom styling can be passed to options when creating an Element.
    // (Note that this demo uses a wider set of styles than the guide below.)
    var style = {
      base: {
        color: '#32325d',
        lineHeight: '18px',
        fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
        fontSmoothing: 'antialiased',
        fontSize: '16px',
        '::placeholder': {
          color: '#aab7c4'
        }
      },
      invalid: {
        color: '#fa755a',
        iconColor: '#fa755a'
      }
    };

    // Create an instance of the card Element.
    var card = elements.create('card', {style: style});

    // Add an instance of the card Element into the `card-element` <div>.
    card.mount('#card-element');

    // Handle real-time validation errors from the card Element.
    card.addEventListener('change', function(event) {
      var displayError = document.getElementById('card-errors');
      if (event.error) {
        displayError.innerHTML = event.error.message;
      } else {
        displayError.innerHTML = '';
      }
    });

    // Handle form submission.
    var $processPaymentButtonEl = $("#ProcessPayment");
    $processPaymentButtonEl.click(function(event) {
      event.preventDefault();

      if (false === submittable()) {
        return;
      }

      onProcessing();

      stripe.createToken(card).then(function(result) {
        console.log(result);
        if (result.error) {
          // Inform the user if there was an error.
          var errorElement = document.getElementById('card-errors');
          errorElement.innerHTML = result.error.message;
        } else {
          // Send the token to your server.
          stripeTokenHandler(result.token);
        }
      });
    });

  };

  (function ($, Stripe, ajaxurl) {"use strict";
    var $stripeTokenEl = $("#StripePaymentToken");
    var stripePubKey = $("#StripePublicKey").val();

    var $processPaymentButtonEl = $("#PaymentModal #ProcessPayment");
    var $processPaymentButtonEl = $("#PaymentModal #ProcessPayment");
    var $progressEl = $("#PaymentModal div.progress-view-wrapper");

    var isSubmitting = false;

    loadingOff();

    X($, Stripe, stripePubKey, submittable, onProcessing, onTokenGet);

    function submittable () {
      return !isSubmitting;
    }

    function onTokenGet (d) {
      processPayment(d);
    }

    function processPayment (d) {
      $.post(
        ajaxurl,
        {
          action: 'tidy_process_order_payment',
          data: {
            order_id: $("input[name=order-id]").val(),
            order_data: $("form#OrderForm").serializeArray(),
            payment: window.tidyOrderData || {},
            stripe_data: d,
          },
        },
        function (response) {
          console.log('The server responded: ', response);
          if (false === response.Error) {
            onSuccess(response);
            return;
          }
          onError(response);
        }
      );
    }

    function onProcessing () {
      loadingOn();
    }

    function onSuccess (response) {
      $("form#OrderForm").attr("action", "/order/complete");
      $("form#OrderForm").submit();
    }

    function onError (response) {
      loadingOff();
    }

    function loadingOn () {
      isSubmitting = true;
      $processPaymentButtonEl.hide();
      $progressEl.show();
    }

    function loadingOff () {
      isSubmitting = false;
      $processPaymentButtonEl.show();
      $progressEl.hide();
    }
  })(jQuery, Stripe, tidy_ajax_url);
</script>


<footer id="footer" role="contentinfo">
  <div id="stepFooter">
    <?php if (!is_page("app-features")) : ?>
      <div>
        <button id="OrderButton_Back"
          class="btn primary-btn">
          Back
        </button>
      </div>
    <?php endif; ?>
    <div style="flex:auto;"></div>
    <div>
    <?php if (!is_page("payment")) : ?>
      <button id="OrderButton_Skip"
        class="btn primary-btn">
        Skip
      </button>
      <button id="OrderButton_Continue"
        class="btn primary-btn"
        type="submit">
        Continue
      </button>
    <?php endif; ?>
    </div>
  </div>
</footer>
</div>
<?php wp_footer(); ?>
</body>
</html>
