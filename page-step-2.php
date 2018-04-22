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

<?php get_sidebar( 'order' ); ?>

<section id="content" role="main" class="step order-step-content">

  <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

      <header class="header">
        <!-- <h1 class="entry-title"><?php the_title(); ?></h1> -->
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
    value="/order/step-3/">
  <input type="hidden"
    name="prev-step"
    value="/order/step-1/">

  <?php foreach ($_REQUEST as $k => $v) : ?>
    <?php if ("order-id" === $k
      || "next-step" === $k
      || "prev-step" === $k) continue; ?>
    <input type="hidden"
      name="<?php echo esc_attr( stripslashes( $k ) ); ?>"
      value="<?php echo esc_attr( stripslashes( $v ) ); ?>">
  <?php endforeach; ?>

  <div id="AppColorScheme_Component" class="form-component">
    <header>
      <h2>Colour Scheme</h2>
      <div class="component-description">
        <p>Your site's colour scheme.</p>
      </div>
    </header>
    <div class="color-cards">
      <script>
      (function ($) {
        $.taTextColorCard({
          id: "app-text-color",
          $containerEl: $("#AppColorScheme_Component .color-cards"),
          cardTitle: "Text colour",
          initialValue: $("input[name=app-text-color]").val(),
          defaultValue: "#242424",
          onColorChange: function () {
            $(document).trigger("eviratec-form:update");
          },
        });
        $.taColorCard({
          id: "app-primary-color",
          $containerEl: $("#AppColorScheme_Component .color-cards"),
          cardTitle: "Primary colour",
          initialValue: $("input[name=app-primary-color]").val(),
          defaultValue: "#2196F3",
          onColorChange: function () {
            $(document).trigger("eviratec-form:update");
          },
        });
        $.taColorCard({
          id: "app-secondary-color",
          $containerEl: $("#AppColorScheme_Component .color-cards"),
          cardTitle: "Secondary colour",
          initialValue: $("input[name=app-secondary-color]").val(),
          defaultValue: "#FFFFFF",
          onColorChange: function () {
            $(document).trigger("eviratec-form:update");
          },
        });
      })(jQuery);
      </script>
    </div>
  </div>

  <div id="AppCustomFont_Component" class="form-component">
    <header>
      <h2>Custom Font</h2>
      <div class="component-description">
        <p>Custom font for your site.</p>
      </div>
    </header>
    <!-- <p><?php echo $_REQUEST["app-custom-font-url"]; ?></p> -->
    <div class="font-upload"></div>
    <script>
    (function ($) {"use strict";
      $.taAssetUploadComponent({
        id: "app-custom-font",
        $el: $("#AppCustomFont_Component div.font-upload"),
        category: "font",
        initialValue: $("input[name=app-custom-font-url]").val(),
        storageId: $("input[name=order-id]").val(),
        onComplete: function (assetUrl) {
          $(document).trigger("eviratec-form:update");
        },
      });
    })(jQuery);
    </script>
  </div>

</section>

<?php get_footer( 'order' ); ?>
