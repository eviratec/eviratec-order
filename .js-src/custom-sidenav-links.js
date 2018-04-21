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

  var SidenavLinkList;
  var SidenavLinkListItem;
  var SidenavLinkListItemModel;
  var SidenavLinkManager;

  var BUTTON_TEXT_LINK_ADD = "Add custom navigation link";
  var BUTTON_ICON_REMOVE_ITEM = "delete";
  var INPUT_PLACEHOLDER_ITEM_TITLE = "Text";
  var INPUT_PLACEHOLDER_ITEM_TARGET = "Target URL";

  /**
   * Sidenav Link List Item Model
   *
   */
  SidenavLinkListItemModel = (function () {"use strict";

    function __SidenavLinkListItemModel (title, target) {
      this.title = title || "";
      this.target = target || "";
    }

    return __SidenavLinkListItemModel;

  })();

  /**
   * Sidenav Link List Item
   *
   */
  SidenavLinkListItem = (function () {"use strict";

    function __SidenavLinkListItem (sidenavLinkList, title, target) {

      var model = new SidenavLinkListItemModel(title, target);

      var thisLinkListItem = this;

      var $el = $(document.createElement("li"));
      var $titleInputEl = $(document.createElement("input"));
      var $targetInputEl = $(document.createElement("input"));

      var $removeItemButton = $(document.createElement("button"));

      $titleInputEl.attr("placeholder", INPUT_PLACEHOLDER_ITEM_TITLE);
      $targetInputEl.attr("placeholder", INPUT_PLACEHOLDER_ITEM_TARGET);

      $titleInputEl.val(model.title);
      $targetInputEl.val(model.target);

      $titleInputEl.appendTo($el);
      $targetInputEl.appendTo($el);

      $titleInputEl.change(function () {
        model.title = $titleInputEl.val();
        sidenavLinkList.persist();
      });

      $targetInputEl.change(function () {
        model.target = $targetInputEl.val();
        sidenavLinkList.persist();
      });

      $removeItemButton.html(
        "<span class=\"material-icons\">" +
        BUTTON_ICON_REMOVE_ITEM +
        "</span>"
      );
      $removeItemButton.appendTo($el);
      $removeItemButton.click(function (event) {
        event.preventDefault();
        sidenavLinkList.removeLink(thisLinkListItem);
      });

      Object.defineProperties(this, {

        $el: {
          value: $el,
        },

        model: {
          value: model,
        },

      });

    }

    return __SidenavLinkListItem;

  })();

  /**
   * Sidenav Link List
   *
   */
  SidenavLinkList = (function () {"use strict";

    function __SidenavLinkList (_d) {

      var links = [];
      var initialValues = _d.initialValue &&
        JSON.parse(_d.initialValue) || [];

      var $el = $(document.createElement("ol"));

      var $valueEl = $(document.createElement("input"));

      $valueEl.attr("name", _d.id);
      $valueEl.attr("type", "hidden");

      $valueEl.appendTo($el);

      Object.defineProperties(this, {

        $el: {
          value: $el,
        },

        links: {
          value: links,
        },

      });

      this.persist = function () {
        var d = links.slice(0);
        for (var i = 0; i < d.length; i++) {
          d[i] = {
            title: d[i].model.title,
            target: d[i].model.target,
          };
        }
        $valueEl.val(JSON.stringify(d));
      };

      for (var i = 0; i < initialValues.length; i++) {
        this.addLink(initialValues[i].title, initialValues[i].target);
      }

    }

    __SidenavLinkList.prototype.removeLink = function (linkListItem) {
      var listItemIndex = this.links.indexOf(linkListItem);
      this.links.splice(listItemIndex, 1);
      linkListItem.$el.remove();
      this.persist();
    };

    __SidenavLinkList.prototype.addLink = function (title, target) {
      var newLink = new SidenavLinkListItem(this, title, target);
      this.links.push(newLink);
      newLink.$el.appendTo(this.$el);
      this.persist();
    };

    return __SidenavLinkList;

  })();

  /**
   * Sidenav Link Manager
   *
   */
  SidenavLinkManager = (function () {"use strict";

    function __SidenavLinkManager (_d) {

      var $el = $(document.createElement("div"));
      var $buttonEl = $(document.createElement("button"));

      var linkList = new SidenavLinkList(_d);

      linkList.$el.appendTo($el);

      $buttonEl.addClass("btn form-btn");
      $buttonEl.html(BUTTON_TEXT_LINK_ADD);

      $buttonEl.appendTo($el);

      $buttonEl.click(function (event) {
        event.preventDefault();
        linkList.addLink();
      });

      Object.defineProperties(this, {

        $el: {
          value: $el,
        },

      });

    }

    return __SidenavLinkManager;

  })();

  $.taSidenavLinkManagerComponent = function (_d) {

    _d = _d || {};

    var $el = _d.$el;
    var sidenavLinkManager = new SidenavLinkManager(_d);

    if (!$el) {
      throw new Error("Unable to initialise SidenavLinkManager: No $el option");
    }

    sidenavLinkManager.$el.appendTo($el);

  };

})(jQuery, window);
