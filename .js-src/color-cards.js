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

(function ($, w) {

  var DEFAULT_CARD_TITLE = "Color";
  var DEFAULT_COLOR_TEXT = "Choose color";
  var LABEL_BUTTON_CHANGE = "Change";
  var LABEL_BUTTON_CANCEL = "Cancel";
  var LABEL_BUTTON_SAVE = "Save";
  var TEXT_COLOR_CARD = "text-color";
  var COLOR_CARD = "color";

  var CardElement;
  var ColorElement;
  var TextColorElement;
  var CardHeaderElement;
  var CardFooterElement;
  var ColorPickerElement;

  w.eviratec_ajax_url = eviratec_ajax_object.ajax_url;

  /**
   * Color Picker Element
   *
   */
  ColorPickerElement = (function () {"use strict";

    function __ColorPickerElement (initialHexValue, onPickColor) {

      var thisColorPicker = this;
      var lastHexValue = initialHexValue;

      var $el = $(document.createElement("div"));
      var $mainEl = $(document.createElement("div"));

      var $hexInputEl = $(document.createElement("input"));
      var $hSpaceEl = $(document.createElement("div"));
      var $saveButtonEl = $(document.createElement("button"));
      var $cancelButtonEl = $(document.createElement("button"));

      $el.addClass("color-picker");
      $mainEl.addClass("color-picker-content");

      $hexInputEl.attr("type", "color");
      $hexInputEl.val(initialHexValue);

      $mainEl.appendTo($el);

      $hexInputEl.appendTo($mainEl);

      $cancelButtonEl.addClass("cancel");
      $cancelButtonEl.html(
        "<span class=\"material-icons\">" +
        "cancel" +
        "</span>"
      );
      $cancelButtonEl.appendTo($mainEl);

      $hSpaceEl.addClass("horizontal-spacer")
      $hSpaceEl.appendTo($mainEl);

      $saveButtonEl.html(LABEL_BUTTON_SAVE);
      $saveButtonEl.appendTo($mainEl);

      $saveButtonEl.click(function (event) {
        event.preventDefault();
        lastHexValue = $hexInputEl.val();
        onPickColor($hexInputEl.val());
        thisColorPicker.toggle();
      });

      $cancelButtonEl.click(function (event) {
        event.preventDefault();
        $hexInputEl.val(lastHexValue);
        thisColorPicker.toggle();
      });

      Object.defineProperties(this, {

        $el: {
          value: $el,
        },

      });

    }

    __ColorPickerElement.prototype.toggle = function () {
      this.$el.toggle();
    };

    return __ColorPickerElement;

  })();

  /**
   * Card Footer Element
   *
   */
  ColorElement = (function () {"use strict";

    function __ColorElement (_d) {

      var $el = $(document.createElement("div"));
      var $mainEl = $(document.createElement("div"));

      $el.addClass("color-indicator");
      $mainEl.addClass("color");

      $mainEl.appendTo($el);
      $mainEl.html(
        "<span></span>" +
        "<span>" + DEFAULT_COLOR_TEXT + "</span>" +
        "<span></span>"
      );

      Object.defineProperties(this, {

        $el: {
          value: $el,
        },

      });

      this.setBackgroundColor = function (hexCode) {
        $mainEl.attr("style", "background-color: " + hexCode);
      };

    }

    __ColorElement.prototype.setCurrentColor = function (newValue) {
      this.setBackgroundColor(newValue);
    };

    return __ColorElement;

  })();

  /**
   * Card Footer Element
   *
   */
  TextColorElement = (function () {"use strict";

    function __TextColorElement (_d) {

      var $el = $(document.createElement("div"));
      var $mainEl = $(document.createElement("div"));

      $el.addClass("color-indicator");
      $mainEl.addClass("text-color");

      $mainEl.appendTo($el);
      $mainEl.html(
        "<span></span>" +
        "<span class=\"text-preview large\">AaBb</span>" +
        "<span class=\"text-preview small\">AaBbCcDdEeFfGgHh</span>"
      );

      Object.defineProperties(this, {

        $el: {
          value: $el,
        },

      });

      this.setTextColor = function (hexCode) {
        $mainEl.attr("style", "color: " + hexCode);
      };

    }

    __TextColorElement.prototype.setCurrentColor = function (newValue) {
      this.setTextColor(newValue);
    };

    return __TextColorElement;

  })();

  /**
   * Card Footer Element
   *
   */
  CardFooterElement = (function () {"use strict";

    function __CardFooterElement (_d) {

      var $el = $(document.createElement("footer"));
      var $buttonEl = $(document.createElement("button"));

      $buttonEl.appendTo($el);
      $buttonEl.html(LABEL_BUTTON_CHANGE);

      $buttonEl.click(function (event) {
        event.preventDefault();
      });

      Object.defineProperties(this, {

        $el: {
          value: $el,
        },

        $buttonEl: {
          value: $buttonEl,
        },

      });

    }

    return __CardFooterElement;

  })();

  /**
   * Card Header Element
   *
   */
  CardHeaderElement = (function () {"use strict";

    function __CardHeaderElement (_d) {

      var title = _d.title || DEFAULT_CARD_TITLE;

      var $el = $(document.createElement("header"));
      var $titleEl = $(document.createElement("h4"));

      $titleEl.appendTo($el);
      $titleEl.html(title);

      Object.defineProperties(this, {

        $el: {
          value: $el,
        },

      });

    }

    return __CardHeaderElement;

  })();

  /**
   * Card Element
   *
   */
  CardElement = (function () {"use strict";

    function __CardElement (_d) {

      var contentElement;
      var colorPickerElement;

      var thisCardElement = this;

      var cardTitle = _d.cardTitle || DEFAULT_CARD_TITLE;
      var initialHexValue = initialValue(_d.initialValue, _d.defaultValue);

      var $el = $(document.createElement("div"));

      var $inputEl = makeValueInputEl(_d.id);
      var headerElement = new CardHeaderElement({
        title: cardTitle,
      });
      var footerElement = new CardFooterElement();

      $el.addClass("card-element color-card");

      switch (_d.cardType) {
        case TEXT_COLOR_CARD:
          contentElement = new TextColorElement();
          break;
        case COLOR_CARD:
          contentElement = new ColorElement();
          break;
      }

      headerElement.$el.appendTo($el);
      contentElement.$el.appendTo($el);
      footerElement.$el.appendTo($el);

      $inputEl.appendTo($el);

      Object.defineProperties(this, {

        $el: {
          value: $el,
        },

        $inputEl: {
          value: $inputEl,
        },

      });

      colorPickerElement = new ColorPickerElement(initialHexValue, onPickColor);
      colorPickerElement.$el.appendTo($el);
      colorPickerElement.$el.hide();

      footerElement.$buttonEl.click(function () {
        colorPickerElement.toggle();
      });

      this.setValue(initialHexValue);
      contentElement.setCurrentColor(initialHexValue);

      function onPickColor (color) {
        thisCardElement.setValue(color);
        contentElement.setCurrentColor(color);
        if (_d.onColorChange) {
          _d.onColorChange();
        }
      }

    }

    __CardElement.prototype.setValue = function (newValue) {
      this.$inputEl.val(newValue);
    };

    function makeValueInputEl (name, initialValue) {
      var $el = $(document.createElement("input"));
      $el.attr("type", "hidden");
      $el.attr("name", name);
      return $el;
    }

    function initialValue (value, defaultValue) {
      if (!value) {
        return defaultValue;
      }
      return value;
    }

    return __CardElement;

  })();

  $.taColorCard = function (_d) {

    _d = _d || {};

    _d.cardType = COLOR_CARD;

    var $containerEl = _d.$containerEl;
    var cardElement = new CardElement(_d);

    if (!$containerEl) {
      throw new Error("Unable to initialise ColorCard: No $containerEl option");
    }

    cardElement.$el.appendTo($containerEl);

  };

  $.taTextColorCard = function (_d) {

    _d = _d || {};

    _d.cardType = TEXT_COLOR_CARD;

    var $containerEl = _d.$containerEl;
    var cardElement = new CardElement(_d);

    if (!$containerEl) {
      throw new Error("Unable to initialise ColorCard: No $containerEl option");
    }

    cardElement.$el.appendTo($containerEl);

  };

})(jQuery, window);
