<?php
if (isset($_POST['action'])) {
    global $wpdb;
    // Check if ABSPATH is defined, if not, define it
    if (!defined('ABSPATH')) {
        define('ABSPATH', dirname(__FILE__) . '/../../../../../');
    }
    require_once(ABSPATH . 'wp-load.php');

    // Check nonce for security
//    check_ajax_referer('quick_form_nonce', 'security');

    $action = $_POST["action"];

    if ($action == 'submit_quick_form') {
        // Validation
        $full_name = sanitize_text_field($_POST['full-name']);
        $phone_number = sanitize_text_field($_POST['phone-number']);
        $prefer_call =sanitize_text_field($_POST['prefer_call']);
        $created_date = date('Y-m-d H:i:s');

        $errors = [];
        if (!preg_match('/^09[0-9]{9}$/', $phone_number)) {
            $errors[] = "شماره موبایل معتبر نمی‌باشد. لطفا شماره موبایل معتبری وارد کنید.";
        }

        if (!empty($errors)) {
            wp_send_json_error(array('success' => false, 'message' => implode('<br>', $errors)));
        } else {
            $data = array(
                'full_name' => $full_name,
                'phone_number' => $phone_number,
                'prefer_call' => $prefer_call,
                'created_date' => $created_date
            );

            $inserted = $wpdb->insert($wpdb->prefix . 'hoovision_quick_form_create', $data);
            if ($inserted) {
                wp_send_json_success(array('success' => true, 'message' => 'کارشناسان ما به زودی با شما تماس خواهند گرفت.'));
            } else {
                wp_send_json_error(array('success' => false, 'message' => 'خطایی رخ داده است. لطفاً دوباره امتحان کنید.'));
            }
            wp_die();
        }
    }
}

require_once "form/quick_form.php";
?>
