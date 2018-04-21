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

(function ($, d, w) {"use strict";

  var InputElement;
  var UploadComponent;
  var UploadDetailsComponent;
  var FileSyncController;

  var UPLOAD_CATEGORY_FONT = "font";
  var UPLOAD_CATEGORY_ICON = "icon";
  var UPLOAD_CATEGORY_IMAGE = "image";

  var DEFAULT_UPLOAD_CATEGORY = UPLOAD_CATEGORY_IMAGE;

  var INPUT_TYPE_FILE = "file";
  var INPUT_TYPE_HIDDEN = "hidden";

  /**
   * Input Element
   *
   */
  InputElement = (function () {"use strict";

    function __InputElement (id, uploadComponent, type, fileType) {
      var el;
      var $el;

      this.uploadComponent = uploadComponent;

      el = createInput(type);
      $el = $(el);

      Object.defineProperties(this, {
        type: {
          value: type,
        },
        fileType: {
          value: fileType,
        },
        el: {
          value: el,
        },
        $el: {
          value: $el,
        },
      });

      $el.attr("name", id + ( INPUT_TYPE_HIDDEN === type ? "-url" : "-file" ));
      if (INPUT_TYPE_FILE === type) {
        $el.attr("accept", acceptAttrFor(this));
      }

    };

    function acceptAttrFor (inputElement) {
      if ("image" === inputElement.fileType) {
        return "image/*";
      }
      if ("icon" === inputElement.fileType) {
        return "image/*";
      }
      if ("font" === inputElement.fileType) {
        return ".woff,.woff2,.ttf,.otf";
      }
    }

    __InputElement.prototype.setValue = function (newValue) {
      if (INPUT_TYPE_FILE === this.type) {
        return;
      }
      this.$el.val(newValue);
    };

    __InputElement.prototype.getValue = function () {
      return this.$el.val();
    };

    __InputElement.prototype.showInEl = function ($el) {
      this.$el.appendTo($el);
    };

    __InputElement.prototype.onChange = function (fn) {
      this.$el.on("change", fn);
    };

    return __InputElement;

    function createInput (type) {
      var el = d.createElement("input");
      el.setAttribute("type", type);
      return el;
    }

  })();

  /**
   * Upload Details Component
   *
   */
  UploadDetailsComponent = (function () {"use strict";

    function __UploadDetailsComponent (type) {
      var _data = {
        remotePath: "",
      };

      var $el = $(document.createElement("div"));

      $el.addClass("upload-details");

      $el.html("No " + type + " selected.");

      Object.defineProperties(this, {
        $el: {
          value: $el,
        },
        d: {
          value: _data,
        },
      });
    }

    __UploadDetailsComponent.prototype.setRemotePath = function (newValue) {
      this.d.remotePath = newValue;
      this.$el.html(newValue);
      return this;
    };

    return __UploadDetailsComponent;

  })();

  /**
   * Upload Component
   *
   */
  UploadComponent = (function () {"use strict";

    var labels = {};

    labels[UPLOAD_CATEGORY_FONT] = "Upload font";
    labels[UPLOAD_CATEGORY_ICON] = "Upload icon";
    labels[UPLOAD_CATEGORY_IMAGE] = "Upload image";

    function __UploadComponent (id, $el, category, initialValue, storageId, showUi, onComplete) {
      var fileInputElement = new InputElement(id, this, INPUT_TYPE_FILE, category);
      var dataInputElement = new InputElement(id, this, INPUT_TYPE_HIDDEN);
      var $buttonEl = $(document.createElement("button"));

      var uploadDetails = new UploadDetailsComponent(category);

      initialValue = initialValue || null;
      showUi = undefined === showUi ? true : showUi;

      onComplete = onComplete || function () {};

      $buttonEl.addClass("btn form-btn file-select-btn");

      Object.defineProperties(this, {
        id: {
          value: id,
        },
        fileInput: {
          value: fileInputElement,
        },
        uploadData: {
          value: dataInputElement,
        }
      });

      $el.addClass("file-upload-component");

      $buttonEl.html(labelFor(category));

      if (true === showUi) {
        $buttonEl.appendTo($el);
      }

      fileInputElement.showInEl($el);
      dataInputElement.showInEl($el);

      uploadDetails.setRemotePath(uploadDisplayText(initialValue));

      $.ltS3Upload({
        s3Bucket: "https://s3-ap-southeast-2.amazonaws.com/tidy-loke-preview-eviratec-software/",
        containerEl: $el,
        photoUrlEl: dataInputElement.$el,
        uploadInputEl: fileInputElement.$el,
        initialValue: initialValue,
        storageId: storageId,
        onBeforeUpload: function (d) {
          console.log(d);
          uploadDisplayText("");
        },
        onUploadComplete: function (d) {
          uploadDetails.setRemotePath(
            // "/{order_id}/" + category + "s/" + ev.target.files[0].name
            uploadDisplayText(d.upload.photo.remoteUrl)
          );
          onComplete(d.upload.photo.remoteUrl);
          console.log(d);
        },
      });

      uploadDetails.$el.appendTo($el);

      function uploadDisplayText (x) {
        if (false === showUi) {
          return "";
        }
        if (null === x) {
          return "No file uploaded yet";
        }
        if ("" === x) {
          return "";
        }
        return x.split("/").slice(-1)[0];
      }
    };

    __UploadComponent.prototype.processUpload = function () {

    };

    __UploadComponent.prototype.getValue = function () {
      return this.uploadData.getValue();
    };

    return __UploadComponent;

    function labelFor (category) {
      return "<span style=\"flex:auto;\"></span>" +
        "<span class=\"material-icons\">file_upload</span><span>" +
        labels[category] + "</span><span style=\"flex:auto;\"></span>";
    }

  })();

  /**
   * File Sync Controller
   *
   */
  FileSyncController = (function (FileSyncController) {"use strict";

    function __FileSyncController () {

    };

    return __FileSyncController;

  })();

  /**
   * App Preview
   *
   */
  (function () {"use strict";

    function AppPreview (data) {
      data = data || {};
      Object.defineProperties(this, {
        data: {
          value: data,
        },
      });
    }

    $.taAppPreview = function (form, data) {
      var $form;
      var $el;
      var appPreview;

      data = data || {};

      $form = data.$form;
      $el = data.$el;

      uploadComponent = new AppPreview({

        $el: $el,

        appIcon: $form.find("input[name=app-icon-url]").val(),
        appName: $form.find("input[name=app-name]").val(),

        navLinks: $form.find("input[name=app-sidenav-links-data]").val(),
        navHeaderImage: $form.find("input[name=app-sidenav-header-image-url]").val(),

        font: $form.find("input[name=app-custom-font-url]").val(),
        textColor: $form.find("input[name=text-color]").val(),
        primaryColor: $form.find("input[name=primary-color]").val(),
        secondaryColor: $form.find("input[name=secondary-color]").val(),

        splashScreenBackground: $form.find("input[name=app-intro-background-image-url]").val(),
        introCards: $form.find("input[name=app-intro-cards-data]").val(),

      });
    };

  })();

  /**
   * App Builder
   *
   */
  (function () {"use strict";

    var fileSyncCtrl = new FileSyncController();

    $.taAssetUploadComponent = function (data) {
      var el;
      var $el;
      var category;
      var uploadComponent;
      var initialValue;
      var storageId;
      var showUi;

      data = data || {};

      $el = data.$el;
      category = data.category || DEFAULT_UPLOAD_CATEGORY;
      initialValue = data.initialValue || "";
      storageId = data.storageId || "__unknown_id__";
      showUi = undefined === data.showUi ? true : data.showUi;

      uploadComponent = new UploadComponent(data.id, $el, category, initialValue, storageId, showUi, data.onComplete);
    };

    $(document).ready(function () {

      var buttons = {
        order: {
          back: $("#OrderButton_Back"),
          skip: $("#OrderButton_Skip"),
          continue: $("#OrderButton_Continue"),
        },
      };

      var orderForm = $("#OrderForm");
      var prevStepUrl = orderForm.find("input[name=prev-step]").val();
      var nextStepUrl = orderForm.find("input[name=next-step]").val();

      $("ol.feature-list li.feature").click(function (ev) {
        toggleFeature($(ev.target).parents("li.feature"));
      });

      $("#OrderButton_Back").click(function () {
        goPrevStep();
      });

      $("#OrderButton_Continue").click(function () {
        goNextStep();
      });

      $("#OrderButton_Skip").click(function () {
        goNextStep();
      });

      $("#menu .step-navigation li a").each(function (i, el) {
        var stepTargetUrl = $(el).attr("href");
        $(el).click(function(event) {
          event.preventDefault();
          event.stopPropagation();
          orderForm.attr("action", stepTargetUrl);
          orderForm.submit();
        })
      });

      function toggleFeature (el) {
        el.find("input[type=checkbox]")[0].click();
      }

      function goPrevStep () {
        orderForm.attr("action", prevStepUrl);
        orderForm.submit();
      }

      function goNextStep () {
        orderForm.attr("action", nextStepUrl);
        orderForm.submit();
      }

    });

  })();

})(jQuery, document, window);
