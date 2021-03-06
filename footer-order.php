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
</div>
<!-- <div class="clear"></div> -->
</div>
</form>
<footer id="footer" role="contentinfo">
  <div id="stepFooter">
    <?php if (!is_page("step-1")) : ?>
      <div>
        <button id="OrderButton_Back"
          class="btn primary-btn">
          Back
        </button>
      </div>
    <?php endif; ?>
    <div style="flex:auto;"></div>
    <div>
    <?php if (!is_page("payment")) : ?>
      <?php if (!is_page("step-1") && !is_page("step-4")) : ?>
        <!-- <button id="OrderButton_Skip"
          class="btn primary-btn">
          Skip
        </button> -->
      <?php endif; ?>
      <button id="OrderButton_Continue"
        class="btn primary-btn"
        type="submit">
        Next Step
      </button>
    <?php endif; ?>
    </div>
  </div>
</footer>
</div>
<?php wp_footer(); ?>
</body>
</html>
