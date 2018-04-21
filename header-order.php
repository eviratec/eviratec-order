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
<body <?php body_class(); ?>>
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

        <?php

        $steps = array(
          "app-features" => array(
            "num" => 1,
            "class" => array(),
          ),
          "app-colours-and-fonts" => array(
            "num" => 2,
            "class" => array(),
          ),
          "app-navigation" => array(
            "num" => 3,
            "class" => array(),
          ),
          "app-intro" => array(
            "num" => 4,
            "class" => array(),
          ),
          "payment" => array(
            "num" => 5,
            "class" => array(),
          ),
        );

        $current_step_number = 0;
        foreach ($steps as $step => $d) {
          if (is_page($step)) {
            $current_step_number = $d["num"];
            $steps[$step]["class"][] = "current-step";
          }
        }
        foreach ($steps as $step => $d) {
          if ($current_step_number > $d["num"]) {
            $steps[$step]["class"][] = "previous-step";
          }
        }

        ?>

        <nav id="menu" role="navigation">
          <div class="step-navigation">
            <ol class="steps">
              <li class="<?php echo join(" ", $steps["app-features"]["class"]); ?>">
                <a href="/order/app-features">
                  <span>App Features</span>
                  <span class="indicator-container">
                    <span style="flex:auto;"></span>
                    <span class="indicator">
                      <span class="material-icons">check</span>
                    </span>
                    <span style="flex:auto;"></span>
                  </span>
                </a>
              </li>
              <li class="<?php echo join(" ", $steps["app-colours-and-fonts"]["class"]); ?>">
                <a href="/order/app-colours-and-fonts">
                  <span>Colours &amp; Fonts</span>
                  <span class="indicator-container">
                    <span style="flex:auto;"></span>
                    <span class="indicator">
                      <span class="material-icons">check</span>
                    </span>
                    <span style="flex:auto;"></span>
                  </span>
                </a>
              </li>
              <li class="<?php echo join(" ", $steps["app-navigation"]["class"]); ?>">
                <a href="/order/app-navigation">
                  <span>Side Menu Bar</span>
                  <span class="indicator-container">
                    <span style="flex:auto;"></span>
                    <span class="indicator">
                      <span class="material-icons">check</span>
                    </span>
                    <span style="flex:auto;"></span>
                  </span>
                </a>
              </li>
              <li class="<?php echo join(" ", $steps["app-intro"]["class"]); ?>">
                <a href="/order/app-intro">
                  <span>Welcome Screens</span>
                  <span class="indicator-container">
                    <span style="flex:auto;"></span>
                    <span class="indicator">
                      <span class="material-icons">check</span>
                    </span>
                    <span style="flex:auto;"></span>
                  </span>
                </a>
              </li>
            </ol>
          </div>
        </nav>

        <div style="display:flex;flex:auto;"></div>
        <div style="width:100px;">

        </div>
      </div>
    </section>
  </header>
  <form id="OrderForm" action="#" method="post">
    <div id="container" class="order-step">
      <div class="step-wrapper">

        <?php if ($_REQUEST['order-id']) : ?>
          <input type="hidden"
            name="order-id"
            value="<?php echo esc_attr($_REQUEST["order-id"]); ?>">
        <?php else : ?>
          <input type="hidden"
            name="order-id"
            value="<?php echo esc_attr(eviratec_generate_order_id()); ?>">
        <?php endif; ?>