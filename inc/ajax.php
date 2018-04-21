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

add_action( 'wp_ajax_nopriv_eviratec_process_order_payment', 'eviratec_process_order_payment' );
add_action( 'wp_ajax_eviratec_process_order_payment', 'eviratec_process_order_payment' );

function eviratec_process_order_payment () {
  $response = json_encode($_REQUEST);
  header("Content-Type: application/json;charset=utf-8");
  try {
    $paymentId = eviratec_attempt_charge($_REQUEST);
    $orderId = eviratec_finalise_order($_REQUEST);
    print json_encode([
      "Error" => false,
      "Message" => "Order finalised",
      "OrderId" => $orderId,
      "PaymentId" => $paymentId,
      "OrderData" => $_REQUEST
    ]);
  }
  catch (Exception $e) {
    print json_encode([
      "Error" => true,
      "Message" => $e->getMessage(),
    ]);
  }
  wp_die();
}

function eviratec_attempt_charge ($d) {
  try {
    \Stripe\Stripe::setApiKey(
      get_option('eviratec_order_option')['stripe_secret_key']
    );
    $stripe_data = $d["data"]["stripe_data"];
    $charge = \Stripe\Charge::create([
      'amount' => intval($d["data"]["payment"]["total"] * 100),
      'currency' => 'aud',
      'description' => "Example charge",
      'metadata' => array("order_id" => $d["data"]["order_id"]),
      'source' => $stripe_data['id'],
    ]);
    return $charge;
  }
  catch (Exception $e) {
    throw new Exception(
      sprintf(
        "ORDER_FAILED: PAYMENT_ERROR: %s",
        $e->getMessage()
      )
    );
  }
}

function eviratec_finalise_order ($d) {
  try {
    // finalise order
    $order_uuid = $d["data"]["order_id"];
    $orderData = $d["data"]["order_data"];
    $data = array();
    foreach ($orderData as $orderField) {
      $data[$orderField["name"]] = $orderField["value"];
    }
    $app_order = array(
      'post_title'    => wp_strip_all_tags($order_uuid),
      'post_content'  => htmlentities(json_encode($orderData)),
      'post_type'     => 'eviratec_site_order',
      'post_status'   => 'publish',
      'post_author'   => 1,
      'post_category' => array()
    );
    $app_order_id = wp_insert_post($app_order);
    // eviratec_google_form_submit(array(
    //   $order_uuid,
    //   $data["app-id-icon-url"],
    //   $data["app-name"],
    //   $data["app-name"],
    //   $data["app-text-color"],
    //   $data["app-primary-color"],
    //   $data["app-secondary-color"],
    //   $data["app-custom-font-url"],
    //   $data["app-sidenav-header-image-url"],
    //   $data["app-sidenav-links"],
    //   $data["app-intro-background-image-url"], // splash screen background
    //   json_encode($data), // onboarding screens
    // ));
    return $order_uuid;
  }
  catch (Exception $e) {
    throw new Exception(
      sprintf(
        "ORDER_FAILED: FAILED_TO_FINALISE: %s",
        $e->getMessage()
      )
    );
  }
}


function eviratec_google_form_submit ($values) {

  $getOperation = curl_init();

  // GET Fields
  curl_setopt($getOperation, CURLOPT_SSL_VERIFYPEER, false);
  curl_setopt($getOperation, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($getOperation, CURLOPT_URL,
    get_option('eviratec_order_option')['google_form_url'] .
    "viewform"
  );
  $result = curl_exec($getOperation);
  curl_close($getOperation);

  preg_match_all(
    "|<input[^>]+\\sname=['\"]{1}(.*)['\"]{1}[^>]+>|U",
    $result,
    $matches,
    PREG_PATTERN_ORDER
  );

  $submission_data = array();

  $i = 0;
  foreach ($matches[1] as $v) {
    if ("entry" !== substr($v, 0, 5)) {
      continue;
    }
    $submission_data[$v] = $values[$i];
    $i++;
  }

  // POST Submission
  $postOperation = curl_init();
  curl_setopt($postOperation, CURLOPT_SSL_VERIFYPEER, false);
  curl_setopt($postOperation, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($postOperation, CURLOPT_POST, count($submission_data));
  curl_setopt($postOperation, CURLOPT_POSTFIELDS,
    http_build_query($submission_data)
  );
  curl_setopt($postOperation, CURLOPT_URL,
    get_option('eviratec_order_option')['google_form_url'] .
    "formResponse"
  );
  $result = curl_exec($postOperation);

  curl_close($postOperation);

}
