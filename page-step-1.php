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

      <header class="header">

      </header>

      <section class="entry-content">
        <?php if ( has_post_thumbnail() ) { the_post_thumbnail(); } ?>
        <?php the_content(); ?>
        <div class="entry-links"><?php wp_link_pages(); ?></div>
      </section>

    </article>

  <?php endwhile; endif; ?>

  <input type="hidden"
    name="next-step"
    value="/order/step-2/">

  <?php foreach ($_REQUEST as $k => $v) : ?>
    <?php if ("order-id" === $k
      || "next-step" === $k
      || "prev-step" === $k
      || "feature-" === substr($k, 0,8 )) continue; ?>
    <input type="hidden"
      name="<?php echo esc_attr( stripslashes( $k ) ); ?>"
      value="<?php echo esc_attr( stripslashes( $v ) ); ?>">
  <?php endforeach; ?>

  <div id="AppId_Component" class="form-component">
    <div class="app-id-icon image-upload">
      <div class="app-icon-wrapper">
        <div class="app-id-icon-placeholder">
          <a title="Upload Icon">
            <span class="material-icons">add_a_photo</span>
          </a>
        </div>
        <div class="app-id-icon-image">
          <img src="" style="height:64px;width:64px;">
        </div>
      </div>
      <div class="icon-upload-advice">
        512x512px
      </div>
    </div>
    <script>
    (function ($) {"use strict";
      var appIconUrl = $("input[name=app-id-icon-url]").val();
      if (appIconUrl) {
        $("#AppId_Component div.app-id-icon-placeholder").hide();
        $("#AppId_Component div.app-id-icon-image").load(function () {
          $("#AppId_Component div.app-id-icon-image").show();
        });
        $("#AppId_Component div.app-id-icon-image img").attr(
          "src",
          appIconUrl
        );
        return;
      }
      $("#AppId_Component div.app-id-icon-image").hide();
    })(jQuery);
    </script>
    <script>
    (function ($) {"use strict";
      $.taAssetUploadComponent({
        id: "app-id-icon",
        $el: $("#AppId_Component div.image-upload"),
        showUi: false,
        category: "icon",
        initialValue: $("input[name=app-id-icon-url]").val(),
        storageId: $("input[name=order-id]").val(),
        onComplete: function (assetUrl) {
          $("#AppId_Component div.app-id-icon-placeholder").hide();
          $("#AppId_Component div.app-id-icon-image").show();
          $("#AppId_Component div.app-id-icon-image img").attr("src", assetUrl);
          $(document).trigger("tidy-form:update");
        },
      });
    })(jQuery);
    </script>
    <div class="app-id-name">
      <input id="AppName_Input"
        name="app-name"
        value="<?php echo esc_attr( stripslashes( $_REQUEST["app-name"] ) ); ?>"
        placeholder="Enter your app name"
        maxlength="50">
      <span class="character-limit">
        50 char max.
      </span>
    </div>
  </div>

  <h2>Select features</h2>

  <?php
  $features = new WP_Query( array(
    'post_type'      => 'eviratec_site_feature',
    'posts_per_page' => -1,
    'meta_key'       => 'feature_display_order',
    'orderby'        => 'meta_value',
    'order'          => 'ASC'
  ) );
  ?>

  <?php if ($features->have_posts()) : ?>
    <ol class="feature-list">
    <?php while ($features->have_posts()) : ?>
      <?php $features->the_post(); ?>
      <li class="feature">
        <div class="feature-card">
          <div class="feature-card-content">

            <!-- feature toggle -->
            <div class="feature-toggle">
              <span class="material-icons feature-selected">
                check_box
              </span>
              <span class="material-icons feature-not-selected">
                check_box_outline_blank
              </span>
              <input type="checkbox"
                name="feature-<?php echo get_the_ID(); ?>"
                value="on"
                <?php if ("on" === $_REQUEST["feature-".get_the_ID()]) : ?>checked<?php endif; ?>>
            </div>

            <!-- feature icon -->
            <div class="feature-icon">
              <i class="material-icons" style="font-size:48px;">
                <?php echo get_field("feature_icon"); ?>
              </i>
            </div>

            <div class="feature">

              <!-- feature title -->
              <header class="">
                <h3><?php echo get_the_title(); ?></h3>
                <span></span>
                <div style="flex:auto;"></div>
                <div></div>
              </header>

              <!-- feature description -->
              <div class="feature-description">
                <?php the_content(); ?>
              </div>

            </div>

          </div>
        </div>
      </li>
    <?php endwhile; ?>
    <?php wp_reset_postdata(); ?>
  </ol>
  <?php endif; ?>

  <script>
  (function ($) {"use strict";

    $(document).ready(function () {
      var $featureEls = $("ol.feature-list li.feature");

      $featureEls.each(function (i, el) {
        var $el = $(el);
        var $checkboxEl = $el.find("input[type=checkbox]");
        $checkboxEl.click(function () {
          if ($checkboxEl.attr("checked")) {
            selectFeature($el);
            return;
          }
          deselectFeature($el);
        });
      });

      refreshSelectedFeatures();

      function refreshSelectedFeatures () {
        $featureEls.each(function (i, el) {
          var $el = $(el);
          var $checkboxEl = $el.find("input[type=checkbox]");
          if ($checkboxEl.attr("checked")) {
            selectFeature($el);
            return;
          }
          deselectFeature($el);
        });
      }
    });

    function selectFeature ($el) {
      $el.addClass("feature-selected");
      $el.find("div.feature-toggle span.material-icons").hide();
      $el.find("div.feature-toggle span.material-icons.feature-selected").show();
    }

    function deselectFeature ($el) {
      $el.removeClass("feature-selected");
      $el.find("div.feature-toggle").find("span.material-icons").hide();
      $el.find("div.feature-toggle").find("span.material-icons.feature-not-selected").show();
    }

  })(jQuery);
  </script>

</section>

<?php get_sidebar( 'order' ); ?>

<?php get_footer( 'order' ); ?>
