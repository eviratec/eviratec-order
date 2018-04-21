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
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width" />
<?php wp_head(); ?>
</head>
<body <?php body_class( 'homepage' ); ?>>
  <div id="wrapper" class="hfeed">
    <header id="header" role="banner">
      <section id="branding">
        <!-- <div id="site-title"><?php if ( is_front_page() || is_home() || is_front_page() && is_home() ) { echo '<h1>'; } ?><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_html( get_bloginfo( 'name' ) ); ?>" rel="home"><?php echo esc_html( get_bloginfo( 'name' ) ); ?></a><?php if ( is_front_page() || is_home() || is_front_page() && is_home() ) { echo '</h1>'; } ?></div> -->
        <!-- <div id="site-description"><?php bloginfo( 'description' ); ?></div> -->
        <div class="toolbar-wrapper">
          <div class="logo">
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>"
              title="<?php echo esc_html( get_bloginfo( 'name' ) ); ?>"
              rel="home"></a>
          </div>
          <div style="display:flex;flex:auto;"></div>
          <div style="width:100px;">

          </div>
        </div>
      </section>
    </header>
    <div id="Homepage">
      <section class="hero">
        <div class="spacer"></div>
        <div class="content-area">
          <div class="main-text-wrapper">
            <div class="spacer"></div>
            <div class="main-text">
              <h1>
                Join the top global brands by using
                <strong>LOKE</strong>
                apps to drive new sales
              </h1>
              <p>
                Increase average speed and lower costs.
              </p>
            </div>
            <div class="call-to-action">
              <div class="button-wrapper">
                <a class="btn" href="/order/app-features">
                  Try it for free!
                </a>
              </div>
              <div class="offer-text">
                <p>
                  Start building your own app
                </p>
              </div>
            </div>
          </div>
          <div class="smartphone">
            <div class="smartphone-image">
              <div class="smartphone-bg"></div>
            </div>
            <div class="hero-cta-container">
              <a href="/order/app-features"
                title="Get started">
                Start building your own app
                <span class="material-icons">
                  chevron_right
                </span>
              </a>
            </div>
          </div>
        </div>
        <div class="spacer"></div>
      </section>

      <section class="main">
        <div class="spacer"></div>
        <div class="content-area">

          <?php
          $testimonials = new WP_Query( array(
            'post_type'      => 'tidy_testimonial',
            'posts_per_page' => -1,
          ) );
          ?>

          <?php if ($testimonials->have_posts()) : ?>
            <ol class="testimonial-list">
            <?php while ($testimonials->have_posts()) : ?>
              <?php $testimonials->the_post(); ?>
              <li class="testimonial">
                <div class="testimonial-card">
                  <div class="testimonial-card-content">

                    <!-- testimonial icon -->
                    <div class="testimonial-icon">
                      <img src="<?php echo get_field("testimonial_author_icon")['sizes']['thumbnail']; ?>"
                        alt="<?php echo get_field("testimonial_author_icon")['alt']; ?>"
                        style="height:75px;width:75px;" />
                    </div>

                    <div class="testimonial">

                      <!-- feature title -->
                      <header class="">
                        <h3>
                          <span class="author-name">
                            <?php echo get_field("testimonial_author_name"); ?>
                          </span>
                          <span class="author-position">
                            <?php echo get_field("testimonial_author_position"); ?>
                          </span>
                          <span class="author-at">
                            of
                          </span>
                          <span class="author-company">
                            <?php echo get_field("testimonial_author_company"); ?>
                          </span>
                        </h3>
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

        </div>
        <div class="spacer"></div>
      </section>

    </div>

    <div class="clear"></div>

  </div>
  <?php wp_footer(); ?>
</body>
</html>
