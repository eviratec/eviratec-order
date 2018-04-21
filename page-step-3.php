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
    value="/order/step-4/">
  <input type="hidden"
    name="prev-step"
    value="/order/step-2/">

  <?php foreach ($_REQUEST as $k => $v) : ?>
    <?php if ("order-id" === $k
      || "next-step" === $k
      || "prev-step" === $k) continue; ?>
    <input type="hidden"
      name="<?php echo esc_attr( stripslashes( $k ) ); ?>"
      value="<?php echo esc_attr( stripslashes( $v ) ); ?>">
  <?php endforeach; ?>

  <div id="AppCustomSidenav_Component" class="form-component">
    <header>
      <h2>Custom Side Menu</h2>
      <div class="component-description">
        <p>If you want to show something from your website in the app: you can add a custom link in your menu.</p>
      </div>
    </header>
    <div class="custom-sidenav-links"></div>
    <script>
    (function ($) {"use strict";
      $.taSidenavLinkManagerComponent({
        id: "app-sidenav-links",
        $el: $("#AppCustomSidenav_Component div.custom-sidenav-links"),
        initialValue: $("input[name=app-sidenav-links]").val(),
      });
    })(jQuery);
    </script>
  </div>

  <div id="AppSidenavHeaderImage_Component" class="form-component">
    <header>
      <h2>Menu Header Image</h2>
      <div class="component-description">
        <p>Choose an image that represents your brand.</p>
      </div>
    </header>
    <!-- <p><?php echo $_REQUEST["app-sidenav-header-image-url"]; ?></p> -->
    <div class="image-upload"></div>
    <script>
    (function ($) {"use strict";
      $.taAssetUploadComponent({
        id: "app-sidenav-header-image",
        $el: $("#AppSidenavHeaderImage_Component div.image-upload"),
        category: "image",
        initialValue: $("input[name=app-sidenav-header-image-url]").val(),
        storageId: $("input[name=order-id]").val(),
        onComplete: function (assetUrl) {
          $(document).trigger("tidy-form:update");
        },
      });
    })(jQuery);
    </script>
  </div>

</section>

<?php get_sidebar( 'order' ); ?>

<?php get_footer( 'order' ); ?>
