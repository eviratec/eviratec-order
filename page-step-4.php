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
    value="/order/payment/">
  <input type="hidden"
    name="prev-step"
    value="/order/step-3/">

  <?php foreach ($_REQUEST as $k => $v) : ?>
    <?php if ("order-id" === $k
      || "next-step" === $k
      || "prev-step" === $k) continue; ?>
    <input type="hidden"
      name="<?php echo esc_attr( stripslashes( $k ) ); ?>"
      value="<?php echo esc_attr( stripslashes( $v ) ); ?>">
  <?php endforeach; ?>

  <div id="AppIntroBackground_Component" class="form-component">
    <header>
      <h2>Welcome Screen Image</h2>
      <div class="component-description">
        <p>Add a background image for the initial loading screen which is shown when customers open your app.</p>
      </div>
    </header>
    <!-- <p><?php echo $_REQUEST["app-intro-background-image-url"]; ?></p> -->
    <div class="image-upload"></div>
    <script>
    (function ($) {"use strict";
      $.taAssetUploadComponent({
        id: "app-intro-background-image",
        $el: $("#AppIntroBackground_Component div.image-upload"),
        category: "image",
        initialValue: $("input[name=app-intro-background-image-url]").val(),
        storageId: $("input[name=order-id]").val(),
        onComplete: function (assetUrl) {
          $(document).trigger("tidy-form:update");
        },
      });
    })(jQuery);
    </script>
  </div>

  <div id="AppOnboardingConfig_Component" class="form-component">
    <header>
      <h2>Welcome Screen Message</h2>
      <div class="component-description">
        <p>Design your own welcome message.</p>
        <div style="flex:auto;"></div>
        <!-- <p>
          <label>
            <input name="use-custom-onboarding"
              type="checkbox"
              checked>
            I want to create custom onboarding
          </label>
        </p> -->
      </div>
    </header>
    <div class="onboarding-cards"></div>
    <script>
    (function ($) {"use strict";
      $.taOnboardingCard({
        id: "app-onboarding-card-1",
        $containerEl: $("#AppOnboardingConfig_Component .onboarding-cards"),
        cardTitle: "Screen #1",
        initialValues: {
          icon: $("input[name=app-onboarding-card-1-icon]").val(),
          headline: $("input[name=app-onboarding-card-1-headline]").val(),
          text: $("input[name=app-onboarding-card-1-text]").val(),
        },
        defaultValues: {
          icon: "shopping_cart",
          headline: "Welcome to our App",
          text: "Pay with the App and earn rewards",
        },
      });
      $.taOnboardingCard({
        id: "app-onboarding-card-2",
        $containerEl: $("#AppOnboardingConfig_Component .onboarding-cards"),
        cardTitle: "Screen #2",
        initialValues: {
          icon: $("input[name=app-onboarding-card-2-icon]").val(),
          headline: $("input[name=app-onboarding-card-2-headline]").val(),
          text: $("input[name=app-onboarding-card-2-text]").val(),
        },
        defaultValues: {
          icon: "",
          headline: "",
          text: "",
        },
      });
      $.taOnboardingCard({
        id: "app-onboarding-card-3",
        $containerEl: $("#AppOnboardingConfig_Component .onboarding-cards"),
        cardTitle: "Screen #3",
        initialValues: {
          icon: $("input[name=app-onboarding-card-3-icon]").val(),
          headline: $("input[name=app-onboarding-card-3-headline]").val(),
          text: $("input[name=app-onboarding-card-3-text]").val(),
        },
        defaultValues: {
          icon: "",
          headline: "",
          text: "",
        },
      });
    })(jQuery);
    </script>
  </div>

</section>

<?php get_sidebar( 'order' ); ?>

<?php get_footer( 'order' ); ?>
