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

class EviratecOrderSettingsPage
{
  /**
   * Holds the values to be used in the fields callbacks
   */
  private $options;

  /**
   * Start up
   */
  public function __construct()
  {
    add_action( 'admin_menu', array( $this, 'add_plugin_page' ) );
    add_action( 'admin_init', array( $this, 'page_init' ) );
  }

  /**
   * Add options page
   */
  public function add_plugin_page()
  {
    // This page will be under "Settings"
    add_options_page(
      'Settings Admin',
      'Eviratec Order Settings',
      'manage_options',
      'eviratec-order-setting-admin',
      array( $this, 'create_admin_page' )
    );
  }

  /**
   * Options page callback
   */
  public function create_admin_page()
  {
    // Set class property
    $this->options = get_option( 'eviratec_order_option' );
    ?>
    <div class="wrap">
      <h1>Eviratec Order Settings</h1>
      <form method="post" action="options.php">
      <?php
        // This prints out all hidden setting fields
        settings_fields( 'eviratec_option_group' );
        do_settings_sections( 'eviratec-order-setting-admin' );
        submit_button();
      ?>
      </form>
    </div>
    <?php
  }

  /**
   * Register and add settings
   */
  public function page_init()
  {
    register_setting(
      'eviratec_option_group', // Option group
      'eviratec_order_option', // Option name
      array( $this, 'sanitize' ) // Sanitize
    );

    $this->addMerchantSettingsFields();
    $this->addPriceSettingsFields();
    $this->addTaxSettingsFields();
    $this->addGoogleSettingsFields();
  }

  private function addMerchantSettingsFields () {
    add_settings_section(
      'ta_merchant_settings', // ID
      'Merchant Settings', // Title
      array( $this, 'print_merchant_section_info' ), // Callback
      'eviratec-order-setting-admin' // Page
    );

    add_settings_field(
      'stripe_pub_key', // ID
      'Stripe Public Key', // Title
      array( $this, 'stripe_pub_key_callback' ), // Callback
      'eviratec-order-setting-admin', // Page
      'ta_merchant_settings' // Section
    );

    add_settings_field(
      'stripe_secret_key',
      'Stripe Secret Key',
      array( $this, 'stripe_secret_key_callback' ),
      'eviratec-order-setting-admin',
      'ta_merchant_settings'
    );
  }

  private function addPriceSettingsFields () {
    add_settings_section(
      'ta_price_settings', // ID
      'Price Settings', // Title
      array( $this, 'print_price_section_info' ), // Callback
      'eviratec-order-setting-admin' // Page
    );

    add_settings_field(
      'ta_price_setup',
      'Price ($)',
      array( $this, 'ta_price_setup_callback' ),
      'eviratec-order-setting-admin',
      'ta_price_settings'
    );

    add_settings_field(
      'ta_price_setup_normal',
      'Normal Price ($)',
      array( $this, 'ta_price_setup_normal_callback' ),
      'eviratec-order-setting-admin',
      'ta_price_settings'
    );

    add_settings_field(
      'ta_price_per_location',
      'Price Per Location ($)',
      array( $this, 'ta_price_per_location_callback' ),
      'eviratec-order-setting-admin',
      'ta_price_settings'
    );
  }

  private function addTaxSettingsFields () {
    add_settings_section(
      'ta_tax_settings', // ID
      'Tax Settings', // Title
      array( $this, 'print_tax_section_info' ), // Callback
      'eviratec-order-setting-admin' // Page
    );

    add_settings_field(
      'ta_apply_tax', // ID
      'Apply Tax', // Title
      array( $this, 'ta_apply_tax_callback' ), // Callback
      'eviratec-order-setting-admin', // Page
      'ta_tax_settings' // Section
    );

    add_settings_field(
      'ta_tax_type',
      'Tax Type',
      array( $this, 'ta_tax_type_callback' ),
      'eviratec-order-setting-admin',
      'ta_tax_settings'
    );

    add_settings_field(
      'ta_tax_amount', // ID
      'Tax Amount (%)', // Title
      array( $this, 'ta_tax_amount_callback' ), // Callback
      'eviratec-order-setting-admin', // Page
      'ta_tax_settings' // Section
    );
  }

  private function addGoogleSettingsFields () {
    add_settings_section(
      'ta_google_settings',
      'Google Form Settings',
      array( $this, 'print_google_section_info' ),
      'eviratec-order-setting-admin'
    );

    add_settings_field(
      'google_form_url',
      'Google Form URL',
      array( $this, 'google_form_url_callback' ),
      'eviratec-order-setting-admin',
      'ta_google_settings'
    );
  }

  /**
   * Sanitize each setting field as needed
   *
   * @param array $input Contains all settings fields as array keys
   */
  public function sanitize( $input )
  {
    $new_input = array();
    if ( isset( $input['stripe_pub_key'] ) )
      $new_input['stripe_pub_key'] = sanitize_text_field( $input['stripe_pub_key'] );

    if ( isset( $input['stripe_secret_key'] ) )
      $new_input['stripe_secret_key'] = sanitize_text_field( $input['stripe_secret_key'] );

    if ( isset( $input['ta_apply_tax'] ) )
      $new_input['ta_apply_tax'] = sanitize_text_field( $input['ta_apply_tax'] );

    if ( isset( $input['ta_tax_type'] ) )
      $new_input['ta_tax_type'] = sanitize_text_field( $input['ta_tax_type'] );

    if ( isset( $input['ta_tax_amount'] ) )
      $new_input['ta_tax_amount'] = sanitize_text_field( $input['ta_tax_amount'] );

    if ( isset( $input['ta_price_setup'] ) )
      $new_input['ta_price_setup'] = sanitize_text_field( $input['ta_price_setup'] );

    if ( isset( $input['ta_price_setup_normal'] ) )
      $new_input['ta_price_setup_normal'] = sanitize_text_field( $input['ta_price_setup_normal'] );

    if ( isset( $input['ta_price_per_location'] ) )
      $new_input['ta_price_per_location'] = sanitize_text_field( $input['ta_price_per_location'] );

    if ( isset( $input['google_form_url'] ) )
      $new_input['google_form_url'] = sanitize_text_field( $input['google_form_url'] );

    return $new_input;
  }

  /**
   * Print the Google Section text
   */
  public function print_google_section_info()
  {
    print 'Google settings';
  }

  /**
   * Print the Merchant Section text
   */
  public function print_merchant_section_info()
  {
    print 'Merchant settings';
  }

  /**
   * Print the Price Section text
   */
  public function print_price_section_info()
  {
    print 'Price settings';
  }

  /**
   * Print the Tax Section text
   */
  public function print_tax_section_info()
  {
    print 'Tax settings';
  }

  /**
   * Get the settings option array and print one of its values
   */
  public function stripe_pub_key_callback()
  {
    printf(
      '<input type="text" id="stripe_pub_key" name="eviratec_order_option[stripe_pub_key]" value="%s" />',
      isset( $this->options['stripe_pub_key'] ) ? esc_attr( $this->options['stripe_pub_key']) : ''
    );
  }

  /**
   * Get the settings option array and print one of its values
   */
  public function stripe_secret_key_callback()
  {
    printf(
      '<input type="text" id="stripe_secret_key" name="eviratec_order_option[stripe_secret_key]" value="%s" />',
      isset( $this->options['stripe_secret_key'] ) ? esc_attr( $this->options['stripe_secret_key']) : ''
    );
  }

  /**
   * Get the settings option array and print one of its values
   */
  public function ta_apply_tax_callback()
  {
    $checked = "1" === $this->options['ta_apply_tax'];
    printf(
      '<input type="checkbox" id="ta_apply_tax" name="eviratec_order_option[ta_apply_tax]" value="1" %s />',
      $checked ? 'checked' : ''
    );
  }

  /**
   * Get the settings option array and print one of its values
   */
  public function ta_tax_type_callback()
  {
    printf(
      '<input type="text" id="ta_tax_type" name="eviratec_order_option[ta_tax_type]" value="%s" />',
      isset( $this->options['ta_tax_type'] ) ? esc_attr( $this->options['ta_tax_type']) : ''
    );
  }

  /**
   * Get the settings option array and print one of its values
   */
  public function ta_tax_amount_callback()
  {
    printf(
      '<input type="number" id="ta_tax_amount" name="eviratec_order_option[ta_tax_amount]" value="%s" />',
      isset( $this->options['ta_tax_amount'] ) ? esc_attr( $this->options['ta_tax_amount']) : ''
    );
  }

  /**
   * Get the settings option array and print one of its values
   */
  public function ta_price_setup_callback()
  {
    printf(
      '<input type="number" id="ta_price_setup" name="eviratec_order_option[ta_price_setup]" value="%s" />',
      isset( $this->options['ta_price_setup'] ) ? esc_attr( $this->options['ta_price_setup']) : ''
    );
  }

  /**
   * Get the settings option array and print one of its values
   */
  public function ta_price_setup_normal_callback()
  {
    printf(
      '<input type="number" id="ta_price_setup_normal" name="eviratec_order_option[ta_price_setup_normal]" value="%s" />',
      isset( $this->options['ta_price_setup_normal'] ) ? esc_attr( $this->options['ta_price_setup_normal']) : ''
    );
  }

  /**
   * Get the settings option array and print one of its values
   */
  public function ta_price_per_location_callback()
  {
    printf(
      '<input type="number" id="ta_price_per_location" name="eviratec_order_option[ta_price_per_location]" value="%s" />',
      isset( $this->options['ta_price_per_location'] ) ? esc_attr( $this->options['ta_price_per_location']) : ''
    );
  }

  /**
   * Get the settings option array and print one of its values
   */
  public function google_form_url_callback()
  {
    printf(
      '<input type="text" id="google_form_url" name="eviratec_order_option[google_form_url]" value="%s" />',
      isset( $this->options['google_form_url'] ) ? esc_attr( $this->options['google_form_url']) : ''
    );
  }

}

if ( is_admin() ) {
  $my_settings_page = new EviratecOrderSettingsPage();
}
