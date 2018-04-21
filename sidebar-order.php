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
<aside id="AppPreviewWrapper" role="complementary" class="app-preview">

  <?php if (!is_page("payment")) : ?>
  <header>
    <div>
      <h2>Mobile preview</h2>
    </div>
    <div style="flex:auto;"></div>
    <div class="app-preview-tabs">
      <ol>
        <li data-screen-id="splash-screen">Splash Screen</li>
        <li data-screen-id="home-screen">Home Screen</li>
        <li data-screen-id="side-navigation">Side Menu</li>
        <li data-screen-id="onboarding">Welcome Screen</li>
      </ol>
    </div>
  </header>
  <?php endif; ?>

  <!-- app preview -->
  <div id="AppPreview">

    <div style="flex:auto;"></div>
    <div id="AppPreview_Screen">

      <div style="flex:auto;"></div>

      <!-- splash screen -->
      <div class="preview-screen splash-screen">

        <div style="flex:auto;"></div>
        <div class="col-center">

          <div style="flex:auto;"></div>
          <div class="center-screen">

            <div class="app-id-icon">
              <div class="app-id-icon-image">
                <img id="appIdIconImage">
              </div>
              <div class="app-id-icon-placeholder">
                <span class="material-icons">photo</span>
              </div>
            </div>

            <div class="app-name">Your App Name</div>

          </div>
          <div style="flex:auto;"></div>

        </div>
        <div style="flex:auto;"></div>

      </div>

      <!-- home screen -->
      <div class="preview-screen home-screen">
        <header>
          <div class="phone-top-bar"></div>
          <div class="app-top-bar">
            <div class="icon-button">
              <span class="material-icons">
                menu
              </span>
            </div>
            <div class="spacer"></div>
            <div class="app-name">
              Your App Name
            </div>
            <div class="spacer"></div>
            <div class="icon-button">
              <span class="material-icons">
                notifications
              </span>
            </div>
          </div>
        </header>
        <div class="home-screen-points">
          <div class="points-balance">
            352 points
          </div>
          <div class="separator"></div>
          <div class="cash-balance">
            &dollar;98.45 credit
          </div>
        </div>
        <div class="home-screen-cards">
          <ul>
            <li class="home-screen-card">
              <div class="card-hero"
                style="background-image:url(<?php echo get_stylesheet_directory_uri(); ?>/img/preview-card-img-00.png);">

              </div>
              <footer>
                <div class="card-text">&dollar;10 Credit for FREE</div>
                <div style="flex:auto;"></div>
                <div class="offer-cta-wrapper">
                  <span class="offer-cta">CLAIM</span>
                </div>
              </footer>
            </li>
            <li class="home-screen-card">
              <div class="card-hero"
                style="background-image:url(<?php echo get_stylesheet_directory_uri(); ?>/img/preview-card-img-01.png);">

              </div>
              <footer>
                <div class="card-text">TGIF Deal 🍔 + 🍺 = 😎</div>
                <div style="flex:auto;"></div>
                <div class="offer-cta-wrapper">
                  <span class="offer-cta">$10.00</span>
                </div>
              </footer>
            </li>
            <li class="home-screen-card">
              <div class="card-hero"
                style="background-image:url(<?php echo get_stylesheet_directory_uri(); ?>/img/preview-card-img-02.png);">

              </div>
              <footer>
                <div class="card-text">Our New Summer Menu</div>
                <div style="flex:auto;"></div>
                <div class="offer-cta-wrapper">
                  <span class="offer-cta">VIEW</span>
                </div>
              </footer>
            </li>
          </ul>
        </div>
      </div>

      <!-- preview screen -->
      <div class="preview-screen side-navigation">
        <div class="home-screen-container">
          <header>
            <div class="phone-top-bar"></div>
            <div class="app-top-bar">
              <div class="icon-button">
                <span class="material-icons">
                  menu
                </span>
              </div>
              <div class="spacer"></div>
              <div class="app-name">
                Your App Name
              </div>
              <div class="spacer"></div>
              <div class="icon-button">
                <span class="material-icons">
                  notifications
                </span>
              </div>
            </div>
          </header>
          <div class="home-screen-points">
            <div class="points-balance">
              352 points
            </div>
            <div class="separator"></div>
            <div class="cash-balance">
              &dollar;98.45 credit
            </div>
          </div>
          <div class="home-screen-cards">
            <ul>
              <li class="home-screen-card">
                <div class="card-hero"
                  style="background-image:url(<?php echo get_stylesheet_directory_uri(); ?>/img/preview-card-img-00.png);">

                </div>
                <footer>
                  <div class="card-text">&dollar;10 Credit for FREE</div>
                  <div style="flex:auto;"></div>
                  <div class="offer-cta-wrapper">
                    <span class="offer-cta">CLAIM</span>
                  </div>
                </footer>
              </li>
              <li class="home-screen-card">
                <div class="card-hero"
                  style="background-image:url(<?php echo get_stylesheet_directory_uri(); ?>/img/preview-card-img-01.png);">

                </div>
                <footer>
                  <div class="card-text">TGIF Deal 🍔 + 🍺 = 😎</div>
                  <div style="flex:auto;"></div>
                  <div class="offer-cta-wrapper">
                    <span class="offer-cta">$10.00</span>
                  </div>
                </footer>
              </li>
              <li class="home-screen-card">
                <div class="card-hero"
                  style="background-image:url(<?php echo get_stylesheet_directory_uri(); ?>/img/preview-card-img-02.png);">

                </div>
                <footer>
                  <div class="card-text">Our New Summer Menu</div>
                  <div style="flex:auto;"></div>
                  <div class="offer-cta-wrapper">
                    <span class="offer-cta">VIEW</span>
                  </div>
                </footer>
              </li>
            </ul>
          </div>
        </div>
        <div class="side-nav-overlay">
          <div class="side-nav">
            <header>
              <div class="inner">
                <div>
                  <div style="flex:auto;"></div>
                  <div class="profile-image"></div>
                </div>
                <div>
                  <span class="user-display-name">
                    John Smith
                  </span>
                </div>
              </div>
            </header>
            <div class="side-nav-items">
              <ol>
                <li>
                  <span class="material-icons">
                    home
                  </span>
                  <span>Home</span>
                </li>
              </ol>
              <ol class="custom-menu-items">

              </ol>
              <ol>
                <li>
                  <span class="material-icons">
                    place
                  </span>
                  <span>Store Locator</span>
                </li>
                <li>
                  <span class="material-icons">
                    local_offer
                  </span>
                  <span>Voucher</span>
                </li>
                <li>
                  <span class="material-icons">
                    star
                  </span>
                  <span>Saved Offers</span>
                </li>
                <li>
                  <span class="material-icons">
                    credit_card
                  </span>
                  <span>Payment</span>
                </li>
                <li>
                  <span class="material-icons">
                    local_dining
                  </span>
                  <span>My Activity</span>
                </li>
                <li>
                  <span class="material-icons">
                    settings
                  </span>
                  <span>Settings</span>
                </li>
              </ol>
            </div>
          </div>
        </div>
      </div>

      <!-- onboarding screen -->
      <div class="preview-screen onboarding">

        <div class="onboarding-screen-indicator">
          <div class="spacer"></div>
          <ul class="indicators">
            <li class="first selected"><span></span></li>
            <li class="second"><span></span></li>
            <li class="third"><span></span></li>
          </ul>
          <div class="spacer"></div>
        </div>

        <div class="onboarding-screen-controls">
          <div class="prev-ctrl">
            <div class="spacer"></div>
            <span class="material-icons">chevron_left</span>
            <div class="spacer"></div>
          </div>
          <div class="spacer"></div>
          <div class="next-ctrl">
            <div class="spacer"></div>
            <span class="material-icons">chevron_right</span>
            <div class="spacer"></div>
          </div>
        </div>
        <div class="onboarding-screens">

          <!-- first onboarding screen card -->
          <div class="onboarding-screen first-screen">
            <div class="spacer"></div>
            <div class="onboarding-screen-content">
              <div class="spacer"></div>
              <div class="onboarding-screen-icon">
                <div class="spacer"></div>
                <span class="material-icons">
                  shopping_cart
                </span>
                <div class="spacer"></div>
              </div>
              <div class="onboarding-screen-text">
                <div class="onboarding-screen-text-headline">
                  Quick Shopping
                </div>
                <div class="onboarding-screen-text-text">
                  Something texty
                </div>
              </div>
              <div class="spacer"></div>
            </div>
            <div class="spacer"></div>
          </div>

          <!-- second onboarding screen card -->
          <div class="onboarding-screen second-screen">
            <div class="spacer"></div>
            <div class="onboarding-screen-content">
              <div class="spacer"></div>
              <div class="onboarding-screen-icon">
                <div class="spacer"></div>
                <span class="material-icons">
                  add
                </span>
                <div class="spacer"></div>
              </div>
              <div class="onboarding-screen-text">
                <div class="onboarding-screen-text-headline">
                  Headline
                </div>
                <div class="onboarding-screen-text-text">
                  Text
                </div>
              </div>
              <div class="spacer"></div>
            </div>
            <div class="spacer"></div>
          </div>

          <!-- third onboarding screen card -->
          <div class="onboarding-screen third-screen">
            <div class="spacer"></div>
            <div class="onboarding-screen-content">
              <div class="spacer"></div>
              <div class="onboarding-screen-icon">
                <div class="spacer"></div>
                <span class="material-icons">
                  add
                </span>
                <div class="spacer"></div>
              </div>
              <div class="onboarding-screen-text">
                <div class="onboarding-screen-text-headline">
                  Headline
                </div>
                <div class="onboarding-screen-text-text">
                  Text
                </div>
              </div>
              <div class="spacer"></div>
            </div>
            <div class="spacer"></div>
          </div>

        </div>
      </div>

      <div style="flex:auto;"></div>

    </div>
    <div style="flex:auto;"></div>

  </div>

  <script>
  (function ($) {
    "use strict";

    var ctrls = $("#AppPreview_Screen .preview-screen.onboarding .onboarding-screen-controls");
    var prevCtrl = ctrls.find(".prev-ctrl");
    var nextCtrl = ctrls.find(".next-ctrl");
    var screenEls = $("#AppPreview_Screen .preview-screen.onboarding .onboarding-screens .onboarding-screen");
    var currentScreen = "first";
    var screens = ["first", "second", "third"];

    var indicatorsEl = $("#AppPreview_Screen .preview-screen.onboarding .onboarding-screen-indicator ul.indicators");

    var lastScreenIndex = screens.length - 1;

    for (var i = 0; i < screens.length; i++) {
      (function (screenName) {
        indicatorsEl.find("li." + screenName).click(function () {
          selectScreen(screenName);
        });
      })(screens[i]);
    }

    prevCtrl.click(function () {
      prevOnboardingScreen();
    });
    nextCtrl.click(function () {
      nextOnboardingScreen();
    });

    function prevOnboardingScreen () {
      var currentScreenIndex = screens.indexOf(currentScreen);
      var targetScreenIndex = currentScreenIndex - 1;
      if (targetScreenIndex < 0) {
        currentScreen = screens[lastScreenIndex];
        return showCurrentScreen();
      }
      currentScreen = screens[targetScreenIndex];
      showCurrentScreen();
    }
    function nextOnboardingScreen () {
      var currentScreenIndex = screens.indexOf(currentScreen);
      var targetScreenIndex = currentScreenIndex + 1;
      if (targetScreenIndex > lastScreenIndex) {
        currentScreen = screens[0];
        return showCurrentScreen();
      }
      currentScreen = screens[targetScreenIndex];
      showCurrentScreen();
    }
    function selectScreen (id) {
      console.log("show screen", id);
      currentScreen = id;
      showCurrentScreen();
    }
    function showCurrentScreen () {
      screenEls.hide();
      $("#AppPreview_Screen .preview-screen.onboarding .onboarding-screens")
        .find(".onboarding-screen." + currentScreen + "-screen").show();
      updateCurrentScreenIndicator();
    }
    function updateCurrentScreenIndicator () {
      var indicatorsEl = $("#AppPreview_Screen .preview-screen.onboarding .onboarding-screen-indicator ul.indicators");
      indicatorsEl.find("li").removeClass("selected");
      indicatorsEl.find("li." + currentScreen).addClass("selected");
    }

  })(jQuery);

  (function ($) {
    "use strict";

    var DEFAULT_APP_TEXT_COLOR = '#242424';
    var DEFAULT_APP_PRIMARY_COLOR = '#0D47A1';
    var DEFAULT_APP_SECONDARY_COLOR = '#';

    var form = $("#OrderForm");
    var fields = [];

    var onboardingScreensEl = $("#AppPreview_Screen .preview-screen.onboarding .onboarding-screens");

    var appNameEl = $("#AppPreview_Screen .preview-screen .app-name");
    var appIdIconImageEl = $("#appIdIconImage");
    var appIdIconPlaceholderEl = $("#AppPreview_Screen .preview-screen.splash-screen .app-id-icon .app-id-icon-placeholder");

    var homeScreenPointsEl = $("#AppPreview_Screen .preview-screen div.home-screen-points");
    var homeScreenPointsSeparatorEl = $("#AppPreview_Screen .preview-screen div.home-screen-points div.separator");

    var ctaButtonEls = $("#AppPreview_Screen .preview-screen div.home-screen-cards ul li.home-screen-card footer div.offer-cta-wrapper span.offer-cta");
    var sidenavHeaderEl = $("#AppPreview_Screen .preview-screen.side-navigation div.side-nav-overlay .side-nav header");
    var sidenavHeaderInnerEl = $("#AppPreview_Screen .preview-screen.side-navigation div.side-nav-overlay .side-nav header div.inner");

    var sidenavCustomMenuItemsEl = $("#AppPreview_Screen .preview-screen.side-navigation ol.custom-menu-items");

    var currentPreviewScreen = "splash-screen";

    if (window.location.pathname) {
      switch (window.location.pathname) {
        case "/order/step-1":
          currentPreviewScreen = "splash-screen";
          break;
        case "/order/step-2":
          currentPreviewScreen = "home-screen";
          break;
        case "/order/step-3":
          currentPreviewScreen = "side-navigation";
          break;
        case "/order/step-4":
          currentPreviewScreen = "onboarding";
          break;
      }
    }

    $(document).ready(function () {

      updatePreview();
      selectPreviewScreen(currentPreviewScreen);
      showOnboardingScreen("first");

      $("#AppPreview_Screen div.preview-screen").addClass("loaded");

      form.change(function (event) {
        updatePreview();
      });

      $(document).on("tidy-form:update", function () {
        console.log("tidy-form:update");
        updatePreview();
      });

      $("#AppPreviewWrapper header div.app-preview-tabs ol li").each(function(i, el) {
        var $el = $(el);
        var screenId = $el.attr("data-screen-id");
        $el.click(function () {
          selectPreviewScreen(screenId);
        });
      });

    });

    function updatePreview () {

      clearFields();

      newFields(form.serializeArray());

      // App Icon & Identification
      setAppIdIcon(getField("app-id-icon-url"));
      setAppName(getField("app-name"));

      // App Colors
      setAppTextColor(getField("app-text-color"));
      setAppPrimaryColor(getField("app-primary-color"));
      setAppSecondaryColor(getField("app-secondary-color"));

      // Images
      setSplashScreenBackgroundImage(getField("app-intro-background-image-url"));
      setSidenavHeaderBackgroundImage(getField("app-sidenav-header-image-url"));

      // Onboarding
      setOnboardingScreens();

      // Custom sidenav links
      setSidenavLinks(getField("app-sidenav-links"));

    }

    function clearFields () {
      fields.splice(0);
    }

    function newFields (arr) {
      for (var i = 0; i < arr.length; i++) {
        fields.push(arr[i]);
      }
    }

    function getField (key) {
      var field;
      for (var i = 0; i < fields.length; i++) {
        if (key !== fields[i].name) {
          continue;
        }
        field = fields[i];
      }
      return field && field.value;
    }

    /** Sidenav links **/
    function setSidenavLinks (newValue) {
      var sideNavLinks;
      sidenavCustomMenuItemsEl.html("");
      if (!newValue) {
        return;
      }
      sideNavLinks = JSON.parse(newValue);
      for (var i = 0; i < sideNavLinks.length; i++) {
        addSidenavLink(sideNavLinks[i].title, sideNavLinks[i].target);
      }
    }

    function addSidenavLink (text, link) {
      var $newSidenavItemEl = $('<li class=""></li>');
      var $iconEl = $('<span style="width:26px;"></span>');
      var $linkEl = $('<a href="' + link + '"><span>' + text + '</span></a>');
      $iconEl.appendTo($newSidenavItemEl);
      $linkEl.appendTo($newSidenavItemEl);
      $linkEl.click(function (event) {
        event.preventDefault();
      });
      $newSidenavItemEl.appendTo(sidenavCustomMenuItemsEl);
    }

    /** Splash screen background **/
    function setSplashScreenBackgroundImage (newValue) {
      if (!newValue) {
        return;
      }
      var splashScreenEl = $("#AppPreview_Screen .preview-screen.splash-screen");
      var onboardingScreenEl = $("#AppPreview_Screen .preview-screen.onboarding");
      splashScreenEl.attr("style", "background-image:url(" + newValue + ");background-size:cover;background-position:center;");
      onboardingScreenEl.attr("style", "background-image:url(" + newValue + ");background-size:cover;background-position:center;");
      selectPreviewScreen(currentPreviewScreen);
    }

    function setSidenavHeaderBackgroundImage (newValue) {
      if (!newValue) {
        return;
      }
      sidenavHeaderInnerEl.attr("style", "background-image:url(" + newValue + ");background-size:cover;background-position:center;");
    }

    /** App Onboarding Screens **/
    function setOnboardingScreens () {

      var first = getOnboardingScreen("first");
      var second = getOnboardingScreen("second");
      var third = getOnboardingScreen("third");

      if (!getField("app-onboarding-card-1-icon")) {
        return;
      }

      setOnboardingScreenIcon(first, getField("app-onboarding-card-1-icon"));
      setOnboardingScreenHeadline(first, getField("app-onboarding-card-1-headline"));
      setOnboardingScreenText(first, getField("app-onboarding-card-1-text"));

      setOnboardingScreenIcon(second, getField("app-onboarding-card-2-icon"));
      setOnboardingScreenHeadline(second, getField("app-onboarding-card-2-headline"));
      setOnboardingScreenText(second, getField("app-onboarding-card-2-text"));

      setOnboardingScreenIcon(third, getField("app-onboarding-card-3-icon"));
      setOnboardingScreenHeadline(third, getField("app-onboarding-card-3-headline"));
      setOnboardingScreenText(third, getField("app-onboarding-card-3-text"));

    }

    function getOnboardingScreen (id) {
      return onboardingScreensEl.find("." + id + "-screen");
    }

    function setOnboardingScreenIcon (screenEl, newValue) {
      var iconEl = screenEl.find(".onboarding-screen-icon .material-icons");
      iconEl.text(newValue || "add");
    }

    function setOnboardingScreenHeadline (screenEl, newValue) {
      var headlineEl = screenEl.find(".onboarding-screen-text-headline");
      headlineEl.text(newValue || "Headline");
    }

    function setOnboardingScreenText (screenEl, newValue) {
      var textEl = screenEl.find(".onboarding-screen-text-text");
      textEl.text(newValue || "Text");
    }

    /** App Colors **/
    function setAppTextColor (newValue) {
      if (!newValue) {
        return clearAppTextColor();
      }
    }

    function clearAppTextColor () {
      setAppPrimaryColor(DEFAULT_APP_TEXT_COLOR);
    }

    function setAppPrimaryColor (newValue) {
      if (!newValue) {
        return clearAppPrimaryColor();
      }
      ctaButtonEls.attr("style", "color: " + newValue);
      sidenavHeaderEl.attr("style", "background-color: " + newValue);
      homeScreenPointsEl.attr("style", "color: " + newValue);
      homeScreenPointsSeparatorEl.attr("style", "background-color: " + newValue);
      $(".side-nav div.side-nav-items span.material-icons")
        .attr("style", "color: " + newValue);
    }

    function clearAppPrimaryColor () {
      setAppPrimaryColor(DEFAULT_APP_PRIMARY_COLOR);
    }

    function setAppSecondaryColor (newValue) {
      if (!newValue) {
        return clearAppSecondaryColor();
      }
    }

    function clearAppSecondaryColor () {
      setAppSecondaryColor(DEFAULT_APP_SECONDARY_COLOR);
    }

    /** App ID Icon **/
    function setAppIdIcon (newUrlValue) {
      if (!newUrlValue) {
        return clearAppIdIcon();
      }
      appIdIconImageEl.attr("src", newUrlValue);
      appIdIconImageEl.show();
      appIdIconPlaceholderEl.hide();
    }

    function setAppName (newValue) {
      if (!newValue) {
        return clearAppName();
      }
      appNameEl.text(newValue);
    }

    function clearAppIdIcon () {
      appIdIconImageEl.hide();
      appIdIconPlaceholderEl.show();
    }

    function clearAppName () {
      setAppName("Your App Name");
    }

    /** Onboarding Screens **/
    function showOnboardingScreen (id) {
      hideOnboardingScreens();
      console.log("#AppPreview_Screen div.preview-screen.onboarding div.onboarding-screens div.onboarding-screen." + id + "-screen");
      $("#AppPreview_Screen div.preview-screen.onboarding div.onboarding-screens div.onboarding-screen." + id + "-screen").show();
    }

    function selectPreviewScreen (screenId) {
      hidePreviewScreens();
      showPreviewScreen(screenId);
      clearSelectedTab();
      selectTab(screenId);
      currentPreviewScreen = screenId;
    }

    function hideOnboardingScreens () {
      $("#AppPreview_Screen div.preview-screen.onboarding div.onboarding-screens div.onboarding-screen").each(function(i, el) {
        $(el).hide();
      });
    }

    function hidePreviewScreens () {
      $("#AppPreview_Screen div.preview-screen").each(function(i, el) {
        $(el).hide();
      });
    }

    function showPreviewScreen (name) {
      $("#AppPreview_Screen div.preview-screen." + name).show();
    }

    function clearSelectedTab () {
      $("#AppPreviewWrapper header div.app-preview-tabs ol li").removeClass("selected");
    }

    function selectTab (screenId) {
      $("#AppPreviewWrapper header div.app-preview-tabs ol li[data-screen-id=" + screenId + "]").toggleClass("selected");
    }

  })(jQuery);
  </script>

</aside>
