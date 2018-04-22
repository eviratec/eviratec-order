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

  <div id="CustomerCompanyName_Component" class="form-component input-field-component">
    <header>
      <h2>Company Name</h2>
    </header>
    <div class="customer-company-name text-input-wrapper">
      <input id="CustomerCompanyName_Input"
        name="customer-company-name"
        value="<?php echo esc_attr( stripslashes( $_REQUEST["customer-company-name"] ) ); ?>"
        placeholder="My Online Store Pty. Ltd.">
    </div>
  </div>

  <div id="CustomerName_Component" class="form-component input-field-component">
    <header>
      <h2>Your Name</h2>
    </header>
    <div class="customer-name text-input-wrapper">
      <input id="CustomerName_Input"
        name="customer-name"
        value="<?php echo esc_attr( stripslashes( $_REQUEST["customer-name"] ) ); ?>"
        placeholder="John Smith">
    </div>
  </div>

  <div id="CustomerEmail_Component" class="form-component input-field-component">
    <header>
      <h2>Contact Email Address</h2>
    </header>
    <div class="customer-email text-input-wrapper">
      <input id="CustomerEmail_Input"
        name="customer-email"
        type="email"
        value="<?php echo esc_attr( stripslashes( $_REQUEST["customer-email"] ) ); ?>"
        placeholder="you@gmail.com">
    </div>
  </div>

  <div id="CustomerPhone_Component" class="form-component input-field-component">
    <header>
      <h2>Phone Number</h2>
    </header>
    <div class="customer-phone text-input-wrapper">
      <input id="CustomerPhone_Input"
        name="customer-phone"
        type="email"
        value="<?php echo esc_attr( stripslashes( $_REQUEST["customer-phone"] ) ); ?>"
        placeholder="+61400123456">
    </div>
  </div>

</section>

<?php get_footer( 'order' ); ?>
