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
<?php if ( 'comments.php' == basename( $_SERVER['SCRIPT_FILENAME'] ) ) return; ?>
<section id="comments">
<?php
if ( have_comments() ) :
global $comments_by_type;
$comments_by_type = &separate_comments( $comments );
if ( ! empty( $comments_by_type['comment'] ) ) :
?>
<section id="comments-list" class="comments">
<h3 class="comments-title"><?php comments_number(); ?></h3>
<?php if ( get_comment_pages_count() > 1 ) : ?>
<nav id="comments-nav-above" class="comments-navigation" role="navigation">
<div class="paginated-comments-links"><?php paginate_comments_links(); ?></div>
</nav>
<?php endif; ?>
<ul>
<?php wp_list_comments( 'type=comment' ); ?>
</ul>
<?php if ( get_comment_pages_count() > 1 ) : ?>
<nav id="comments-nav-below" class="comments-navigation" role="navigation">
<div class="paginated-comments-links"><?php paginate_comments_links(); ?></div>
</nav>
<?php endif; ?>
</section>
<?php
endif;
if ( ! empty( $comments_by_type['pings'] ) ) :
$ping_count = count( $comments_by_type['pings'] );
?>
<section id="trackbacks-list" class="comments">
<h3 class="comments-title"><?php echo '<span class="ping-count">' . $ping_count . '</span> ' . ( $ping_count > 1 ? __( 'Trackbacks', 'blankslate' ) : __( 'Trackback', 'blankslate' ) ); ?></h3>
<ul>
<?php wp_list_comments( 'type=pings&callback=blankslate_custom_pings' ); ?>
</ul>
</section>
<?php
endif;
endif;
if ( comments_open() ) comment_form();
?>
</section>
