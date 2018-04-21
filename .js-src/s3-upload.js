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

  $.ltS3Upload = function (_d) {
    _d = _d || {
      contailerEl: null,
      photoUrlEl: null,
      uploadInputEl: null,
      initialValue: null,
      storageId: "__UNKNOWN_ID__",
      onBeforeUpload: function () { },
      onUploadComplete: function () { },
    };

    function ProgressView (queue) {
      var interval;
      var progressPercent = 0;
      var currentUploadN = 0;
      var totalUploadN = 0;
      var bytesTransferred = 0;
      var totalBytes = 0;
      var speedTick = 0;
      var kbTransferEstimate = 0;
      var el = (function () { return $(
        '<div class="progress-view-wrapper">' +
        '  <div class="progress-indicator"></div>' +
        '  <div class="progress-view">' +
        '    <span>Uploading</span>' +
        '    <span class="current-upload-n">1</span>' +
        '    <span>of</span>' +
        '    <span class="total-upload-n">1</span>' +
        '  </div>' +
        // '  <div class="progress-percent">0%</div>' +
        '</div>'
      ) })();
      this.setSpeedTick = function (kbps) {
        kbTransferEstimate = 0;
        speedTick = kbps;
        if (0 === kbps) {
          return stopTick();
        }
        startTick();
      };
      function tick () {
        kbTransferEstimate+=speedTick*550;
        setProgressPercent(Math.ceil(100*((bytesTransferred+kbTransferEstimate)/totalBytes)));
      }
      function startTick () {
        if (isTicking()) {
          return;
        }
        interval = setInterval(tick, 500);
      }
      function stopTick () {
        if (!isTicking()) {
          return;
        }
        clearInterval(interval);
      }
      function isTicking () {
        return !!interval;
      }
      this.show = function () {
        el.show();
      }
      this.hide = function () {
        el.hide();
      }
      function setByteCounts (a, b) {
        bytesTransferred = a;
        totalBytes = b;
      }
      this.stat = function (stats) {
        setCurrentUploadN(stats.currentUploadN);
        setTotalUploadN(stats.count.items.added);
        setByteCounts(stats.total.bytesTransferred, stats.total.bytes);
        setProgressPercent(Math.ceil(100*(bytesTransferred/totalBytes)));
      }
      this.el = function () {
        return el;
      }
      function setProgressPercent (newValue) {
        progressPercent = newValue;
        el.find("div.progress-indicator span.progress").attr("style", "width: " + newValue + "%");
        el.find("div.progress-percent").html(newValue + "%");
      }
      function setCurrentUploadN (newValue) {
        currentUploadN = newValue;
        el.find("span.current-upload-n").html(newValue);
      }
      function setTotalUploadN (newValue) {
        totalUploadN = newValue;
        el.find("span.total-upload-n").html(newValue);
      }
    }
    function GridItem (grid, item) {
      var el = (function () { return $(
        '<li class="photo-wrap"><div class="file-name"></div></li>'
      ) })();
      var fileNameEl = el.find("div.file-name");
      fileNameEl.html(item.file.name);
      this.setImgSrc = function (newValue) {
        el.attr("style", "background-image:url(" + newValue + ")");
      };
      this.el = function () {
        return el;
      }
    }
    function Grid (el) {
      console.log(el);
      // console.log(el.append($("<li>Foo</li>")));
      this.add = function (upload) {
        var x = new GridItem(this, upload);
        el.append(x.el());
        return x;
      };
    }
    function Photo (file) {
      this.remoteUrl = urlFor(file.name);
      function urlFor (fileName) {
        return _d.s3Bucket
          + window.location.hostname
          + "/"
          + _d.storageId
          + "/"
          + encodeURI(fileName);
      }
    }
    function Upload (queue, file) {
      var _log = {};
      this.file = file;
      this.queue = queue;
      this.photo = new Photo(file);
      this.uploadUrl = this.photo.remoteUrl;
      this.gridItem = null;
      this.log = function (ev) {
        _log[ev] = Date.now();
      };
      this.getTransferTimeMs = function () {
        return _log.done - _log.start;
      };
      this.getBytesTransferred = function () {
        return this.file.size;
      };
      this.getTransferKbps = function () {
        if (!_log.start || !_log.done) {
          return 0;
        }
        var bytesTransferred = this.getBytesTransferred();
        var transferTimeMs = this.getTransferTimeMs();
        return Math.ceil(bytesTransferred / transferTimeMs);
      };
    }
    function Queue (grid) {
      var _ = {
        waiting: [],
        inprogress: null,
        finished: []
      };
      var _cb = {
        onItemAdded: [],
        onEmpty: [],
        onBeforeUpload: [],
        onUploadComplete: [],
      };
      var queueSize = 0;
      var bytesTransferred = 0;
      var currentUploadN = 0;
      var itemsAdded = 0;
      var itemsQueued = 0;
      var itemsFinished = 0;
      this.stats = function () {
        return {
          currentUploadN: currentUploadN,
          count: {
            items: {
              added: itemsAdded,
              queued: itemsQueued,
              finished: itemsFinished
            }
          },
          total: {
            bytes: queueSize,
            bytesTransferred: bytesTransferred
          }
        };
      };
      this.add = function (newItem) {
        newItem = new Upload(this, newItem);
        // console.log("Queueing: ", newItem);
        // console.log("Upload to: " + newItem.photo.remoteUrl);
        _.waiting.push(newItem);
        newItem.gridItem = grid.add(newItem);
        if (newItem.file.size) {
          queueSize+=newItem.file.size;
        }
        itemsQueued++;
        itemsAdded++;
        emit("onItemAdded", {
          upload: newItem,
        });
        // console.log(this);
        uploadNext();
      };
      this.on = function (ev, cb) {
        _cb[ev].push(cb);
      };
      this.uploadNext = uploadNext;
      function emit (ev, d) {
        if (!_cb[ev] || !_cb[ev].length) {
          return;
        }
        _cb[ev].forEach(function (cb) {
          cb(d);
        });
      }
      function queueEmpty () {
        emit("onEmpty");
      }
      function uploadNext () {
        var next;
        if (uploading()) {
          console.log("already uploading", _.inprogress);
          return;
        }
        next = nextWaiting();
        if (!next) {
          return queueEmpty();
        }
        currentUploadN++;
        _.inprogress = next;
        g(next);
      }
      function g (next) {
        next.log("start");
        $.ajax({
          url: next.photo.remoteUrl,
          method: 'put',
          data: next.file,
          processData: false,
          contentType: "multipart/form-data; charset=UTF-8",
          beforeSend: function (xhr) {
            var n = next;
            var nextPhoto = n.photo;
            var nextGridItem = n.gridItem;
            emit("onBeforeUpload", {
              xhr: xhr,
              upload: next,
            });
            xhr
              .always(function () {
                console.log("always");
                console.log(arguments);
              })
              .progress(function () {
                console.log("progress event");
                console.log(arguments);
              })
              .done(function () {
                // var imgEl = $('<img src="' + nextPhoto.remoteUrl + '" />');
                // nextGridItem.el().append(imgEl);
                n.gridItem.setImgSrc(nextPhoto.remoteUrl);
                n.log("done");
                console.log('***',n.getTransferKbps());
                finish(n);
                uploadNext();
              });
          },
        });
      }
      function finish (item) {
        var finished;
        if (item !== _.inprogress) {
          return;
        }
        _.finished.push(item);
        itemsFinished++;
        if (item.file.size) {
          bytesTransferred+=item.file.size;
        }
        emit("onUploadComplete", {
          upload: item,
        });
        clearInprogress();
      }
      function clearInprogress () {
        _.inprogress = null;
        itemsQueued--;
      }
      function nextWaiting () {
        return _.waiting.pop();
      }
      function uploading () {
        return null !== _.inprogress || false;
      }
    }
    var _GRID = w._GRID = new Grid($("ol#photoManager"));
    var _QUEUE = w._QUEUE = new Queue(_GRID);
    var _PROGRESS = w._PROGRESS = new ProgressView(_QUEUE);
    console.log(_QUEUE);
    _QUEUE.on("onItemAdded", function (d) {
      console.log("*onBeforeUpload*", d);
      _PROGRESS.stat(_QUEUE.stats());
    });
    _QUEUE.on("onBeforeUpload", function (d) {
      console.log("*onBeforeUpload*", d);
      _d.onBeforeUpload(d);
      _PROGRESS.stat(_QUEUE.stats());
      _PROGRESS.show();
    });
    _QUEUE.on("onUploadComplete", function (d) {
      console.log("*onUploadComplete*", d);
      savePhotoUrl(d.upload.photo.remoteUrl);
      _d.onUploadComplete(d);
      _PROGRESS.stat(_QUEUE.stats());
      _PROGRESS.setSpeedTick(d.upload.getTransferKbps());
      _PROGRESS.hide();
    });
    _QUEUE.on("onEmpty", function (d) {
      console.log("*onEmpty*", d);
      _PROGRESS.stat(_QUEUE.stats());
      _PROGRESS.setSpeedTick(0);
      _PROGRESS.hide();
    });
    _d.containerEl.append(_PROGRESS.el());
    _PROGRESS.hide();
    if (null !== _d.initialValue) {
      savePhotoUrl(_d.initialValue);
    }
    function savePhotoUrl (newUrl) {
      var el = _d.photoUrlEl;
      el.val(newUrl);
    }
    _d.uploadInputEl.on("change", function (ev) {
      var files = filesIn(ev.target);
      queueUploads(files);
    });
    function filesIn (input) {
      return input.files;
    }
    function queueUploads (newFiles) {
      console.log("Queuing uploads");
      console.log(newFiles);
      Array.prototype.forEach.call(newFiles, function (newFile) {
        _QUEUE.add(newFile)
      });
    }
  };
})(jQuery, window);
