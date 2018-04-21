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

(function ($, w) {"use strict";

  var CardIconElement;
  var CardElement;
  var IconDrawerElement;

  var icons = [
    "account_balance",
    "account_balance_wallet",
    "card_giftcard",
    "card_membership",
    "card_travel",
    "credit_card",
    "face",
    "favorite",
    "favorite_border",
    "home",
    "language",
    "loyalty",
    "motorcycle",
    "pets",
    "redeem",
    "room",
    "search",
    "shopping_basket",
    "shopping_cart",
    "star",
    "stars",
    "store",
    "today",
    "toll",
    "touch_app",
    "visibility",
    "watch_later",
    "work",
    "textsms",
    "flight",
    "local_pizza",
    "cake",
    "local_bar",
    "local_cafe",
    "local_convenience_store",
    "local_dining",
    "local_drink",
    "local_florist",
    "local_gas_station",
    "local_hotel",
    "local_mall",
    "local_movies",
    "local_offer",
    "local_play",
    "local_taxi",
    "map",
    "rate_review",
    "restaurant",
    "public",
    "whatshot",
    "share",
    "sentiment_very_satisfied",
    "mood",
    "person",
    "group",
  ];

  /**
   * Icon Drawer Element
   *
   */
  IconDrawerElement = (function () {"use strict";

    function __IconDrawerElement (cardIconElement, _d) {

      var thisDrawerElement = this;

      var $el = $(document.createElement("div"));
      var $iconListEl = $(document.createElement("ul"));

      $el.addClass("icon-drawer");

      $iconListEl.appendTo($el);

      addIconsTo($iconListEl);

      Object.defineProperties(this, {

        $el: {
          value: $el,
        },

      });

      this.close();

      function addIconsTo ($el) {
        icons.forEach(function (icon) {
          var $iconEl = $(document.createElement("li"));
          $iconEl.html('<span class="material-icons">' + icon + "</span>");
          $iconEl.click(function () {
            cardIconElement.setIcon(icon);
            thisDrawerElement.close();
          });
          $iconEl.appendTo($iconListEl);
        });
      }

    }

    __IconDrawerElement.prototype.toggle = function () {
      this.$el.toggle();
    };

    __IconDrawerElement.prototype.close = function () {
      this.$el.hide();
    };

    __IconDrawerElement.prototype.open = function () {
      this.$el.show();
    };

    return __IconDrawerElement;

  })();

  /**
   * Card Icon Element
   *
   */
  CardIconElement = (function () {"use strict";

    function __CardIconElement (_d) {

      var thisIconElement = this;

      var $el = $(document.createElement("div"));

      var $valueEl = makeValueInputEl(valueInputName("icon"));

      var iconDrawerElement = new IconDrawerElement(this, _d);

      var $iconEl = $(document.createElement("div"));
      var $iconInnerEl = $(document.createElement("span"));

      iconDrawerElement.$el.appendTo($el);

      $iconEl.addClass("screen-icon");
      $iconInnerEl.addClass("material-icons");

      $el.addClass("onboarding-screen-icon");

      $iconInnerEl.appendTo($iconEl);

      spacerEl().appendTo($el);
      $iconEl.appendTo($el);
      spacerEl().appendTo($el);

      $valueEl.appendTo($el);

      Object.defineProperties(this, {

        $el: {
          value: $el,
        },

        $valueEl: {
          value: $valueEl,
        },

      });

      $iconEl.click(function () {
        iconDrawerElement.open();
      });

      this.setIconDisplay = function (newValue) {
        if (!newValue) {
          clearIcon();
          return;
        }
        needsIcon(false);
        $iconInnerEl.html(newValue);
      };

      this.setIcon = function (newValue) {
        thisIconElement.$valueEl.val(newValue);
        thisIconElement.setIconDisplay(newValue);
      };

      this.setIcon(initialValue(_d, "icon"));

      function clearIcon () {
        needsIcon(true);
        $iconInnerEl.html("add");
      }

      function needsIcon (newValue) {
        if (true === newValue) {
          $iconEl.removeClass("has-icon");
          $iconEl.addClass("needs-icon");
          return;
        }
        $iconEl.removeClass("needs-icon");
        $iconEl.addClass("has-icon");
      }

      function valueInputName (key) {
        return [_d.id, key].join("-");
      }

    }

    function makeValueInputEl (name) {
      var $el = $(document.createElement("input"));
      $el.attr("type", "hidden");
      $el.attr("name", name);
      return $el;
    }

    function initialValue (_d, key) {
      return _initialValue(_d.initialValues[key], _d.defaultValues[key]);
      function _initialValue (value, defaultValue) {
        if (!value) {
          return defaultValue;
        }
        return value;
      }
    }

    function spacerEl () {
      var $el = $(document.createElement("div"));
      $el.attr("style", "flex:auto;");
      return $el;
    }

    return __CardIconElement;

  })();

  /**
   * Card Element
   *
   */
  CardElement = (function () {"use strict";

    function __CardElement (_d) {

      var thisCardElement = this;

      var $el = $(document.createElement("div"));

      var $cardTitleEl = $(document.createElement("h3"));

      var cardIconElement = new CardIconElement(_d);

      var $headlineValueEl = makeInputEl(valueInputName("headline"));
      var $textValueEl = makeInputEl(valueInputName("text"));

      $el.addClass("card-element onboarding-card");

      $headlineValueEl.addClass("onboarding-screen-headline");
      $textValueEl.addClass("onboarding-screen-text");

      $headlineValueEl.attr("placeholder", "Headline");
      $textValueEl.attr("placeholder", "Text");

      $cardTitleEl.html(_d.cardTitle);
      $cardTitleEl.appendTo($el);

      cardIconElement.$el.appendTo($el);

      $headlineValueEl.appendTo($el);
      $textValueEl.appendTo($el);

      $headlineValueEl.change(function () {
        if ($headlineValueEl.val()) {
          thisCardElement.needsHeadlineValue(false);
          return;
        }
        thisCardElement.needsHeadlineValue(true);
      });

      $textValueEl.change(function () {
        if ($textValueEl.val()) {
          thisCardElement.needsTextValue(false);
          return;
        }
        thisCardElement.needsTextValue(true);
      });

      Object.defineProperties(this, {

        $el: {
          value: $el,
        },

        cardIconElement: {
          value: cardIconElement,
        },

        $headlineValueEl: {
          value: $headlineValueEl,
        },

        $textValueEl: {
          value: $textValueEl,
        },

      });

      this.setHeadline(initialValue(_d, "headline"));
      this.setText(initialValue(_d, "text"));

      function valueInputName (key) {
        return [_d.id, key].join("-");
      }

    }

    __CardElement.prototype.setIcon = function (newValue) {
      this.cardIconElement.setIcon(newValue);
    };

    __CardElement.prototype.setHeadline = function (newValue) {
      if (!newValue) {
        this.clearHeadline();
        return;
      }
      this.needsHeadlineValue(false);
      this.$headlineValueEl.val(newValue);
    };

    __CardElement.prototype.setText = function (newValue) {
      if (!newValue) {
        this.clearText();
        return;
      }
      this.needsTextValue(false);
      this.$textValueEl.val(newValue);
    };

    __CardElement.prototype.clearHeadline = function () {
      this.needsHeadlineValue(true);
      this.$headlineValueEl.val("");
    };

    __CardElement.prototype.clearText = function () {
      this.needsTextValue(true);
      this.$textValueEl.val("");
    };

    __CardElement.prototype.needsHeadlineValue = function (newValue) {
      if (true === newValue) {
        this.$headlineValueEl.removeClass("has-value");
        this.$headlineValueEl.addClass("needs-value");
        return;
      }
      this.$headlineValueEl.removeClass("needs-value");
      this.$headlineValueEl.addClass("has-value");
    };

    __CardElement.prototype.needsTextValue = function (newValue) {
      if (true === newValue) {
        this.$textValueEl.removeClass("has-value");
        this.$textValueEl.addClass("needs-value");
        return;
      }
      this.$textValueEl.removeClass("needs-value");
      this.$textValueEl.addClass("has-value");
    };

    function makeInputEl (name) {
      var $el = $(document.createElement("input"));
      $el.attr("name", name);
      return $el;
    }

    function initialValue (_d, key) {
      return _initialValue(_d.initialValues[key], _d.defaultValues[key]);
      function _initialValue (value, defaultValue) {
        if (!value) {
          return defaultValue;
        }
        return value;
      }
    }

    return __CardElement;

  })();

  $.taOnboardingCard = function (_d) {

    _d = _d || {};

    var $containerEl = _d.$containerEl;
    var cardElement = new CardElement(_d);

    if (!$containerEl) {
      throw new Error(
        "Unable to initialise OnboardingCard: No $containerEl option"
      );
    }

    cardElement.$el.appendTo($containerEl);

  };

})(jQuery, window);
