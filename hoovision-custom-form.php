<?php
/*
    Plugin Name: Free Wordpress plugin custome form
    Plugin URI: https://hoovision.com/tutorials/training-from-0-to-100-to-make-contact-us-plugin/
    Description: This plugin is written to create special forms. 
    Version: 1.1
    Author: mohammadreza mousavi, hoovision
    Author URI: https://hoovision.com/mohammadreza-mousavi-site-designer/
    License: GPL2
    License URI: https://hoovision.com/
    Text Domain: hoovision
    Domain Path: /languages
*/
if (!defined('ABSPATH')) {
    exit;
}

global $wpdb;

function form_create($atr = null)
{
    global $wpdb;

    $wp_track_table = $wpdb->prefix . 'hoovision_form_create';

    #Check to see if the table exists already, if not, then create it

    if ($wpdb->get_var("show tables like '$wp_track_table'") != $wp_track_table) {

        $sql = " CREATE TABLE `$wp_track_table` (";
        $sql .= " `id` int NOT NULL AUTO_INCREMENT, ";
        $sql .= " `full_name` varchar(80) NOT NULL, ";
        $sql .= " `email_address` varchar(80) NOT NULL, ";
        $sql .= " `subject` varchar(80) NOT NULL, ";
        $sql .= " `phone_number` varchar(11) NOT NULL, ";
        $sql .= " `message` varchar(800) NOT NULL, ";
        $sql .= " `created_date` TIMESTAMP NOT NULL default CURRENT_TIMESTAMP, ";
        $sql .= " PRIMARY KEY (`id`) ";
        $sql .= " ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 ";
        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        dbDelta($sql);

    }

}

register_activation_hook(__FILE__, 'form_create');

function form_quick_create($atr = null)
{
    global $wpdb;

    $wp_track_table = $wpdb->prefix . 'hoovision_quick_form_create';

    #Check to see if the table exists already, if not, then create it

    if ($wpdb->get_var("show tables like '$wp_track_table'") != $wp_track_table) {

        $sql = " CREATE TABLE `$wp_track_table` (";
        $sql .= " `id` int NOT NULL AUTO_INCREMENT, ";
        $sql .= " `full_name` varchar(80) NOT NULL, ";
        $sql .= " `phone_number` varchar(11) NOT NULL, ";
        $sql .= " `prefer_call` varchar(7) NOT NULL default 'phone', ";
        $sql .= " `created_date` TIMESTAMP NOT NULL default CURRENT_TIMESTAMP, ";
        $sql .= " PRIMARY KEY (`id`) ";
        $sql .= " ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 ";
        require_once(ABSPATH . '/wp-admin/includes/upgrade.php');
        dbDelta($sql);

    }

}

register_activation_hook(__FILE__, 'form_quick_create');

function hoovisionContactAdminMenu()
{
    add_menu_page("لیست تماس", " لیست تماس", 'administrator', 'contact_item', 'contactList', 'dashicons-category', 2);
    add_submenu_page('contact_item', 'فرم سریع', 'فرم سریع', 'administrator', 'quick_item', 'quickForm');
}

add_action('admin_menu', 'hoovisionContactAdminMenu');


function contactList()
{
    global $dir;
    $dir = plugin_dir_path(__FILE__);

    wp_enqueue_style('hoovision-custom-form-style', site_url() . '/wp-content/plugins/hoovision-custom-form/asset/css/style.css');
    wp_enqueue_style('hoovision-custom-form-bootstrap', site_url() . '/wp-content/plugins/hoovision-custom-form/asset/css/bootstrap.min.css');
    wp_enqueue_script('hoovision-custom-form-jquery', site_url() . '/wp-content/plugins/hoovision-custom-form/asset/js/jquery.min.js', array('jquery'), 3.7, true);
    wp_enqueue_script('hoovision-custom-form-script', site_url() . '/wp-content/plugins/hoovision-custom-form/asset/js/script.js', array('jquery'), 1.1, true);

    require_once $dir . 'includes/check-input.php';
    $checkInput = new checkInput;

    require_once $dir . 'templates/back-end/contact_item.php';
}

function wpb_contact_form()
{
    global $dir;
    $dir = plugin_dir_path(__FILE__);

    wp_enqueue_style('hoovision-custom-form-style', site_url() . '/wp-content/plugins/hoovision-custom-form/asset/css/style.css');
    wp_enqueue_style('hoovision-custom-form-bootstrap', site_url() . '/wp-content/plugins/hoovision-custom-form/asset/css/bootstrap.min.css');
    wp_enqueue_script('hoovision-custom-form-jquery', site_url() . '/wp-content/plugins/hoovision-custom-form/asset/js/jquery.min.js', array('jquery'), 3.7, true);
    wp_enqueue_script('hoovision-custom-form-script', site_url() . '/wp-content/plugins/hoovision-custom-form/asset/js/script.js', array('jquery'), 1.1, true);

    require_once $dir . 'includes/check-input.php';
    $checkInput = new checkInput;

    require_once $dir . 'templates/front-end/contact_form.php';
}


// [hoovision-form-shortcode]
add_shortcode('hoovision-form-shortcode', 'wpb_contact_form');


function wpb_quick_contact_form() {
    global $dir;
    $dir = plugin_dir_path(__FILE__);
    wp_enqueue_style('hoovision-custom-form-style', site_url() . '/wp-content/plugins/hoovision-custom-form/asset/css/style.css');

    wp_enqueue_script('custom-form-ajax-js', plugins_url('/asset/js/ajax.js', __FILE__), array('jquery'), '1', true);
    wp_localize_script('custom-form-ajax-js', 'hoovisionAjax', array('ajaxurl' => admin_url('admin-ajax.php')));

    require_once $dir . 'includes/check-input.php';
    $checkInput = new CheckInput;

    require_once $dir . 'templates/front-end/form/quick_form.php';
}

// [hoovision-quick-form-shortcode]
add_shortcode('hoovision-quick-form-shortcode', 'wpb_quick_contact_form');

add_action('wp_ajax_submit_quick_form', 'handle_quick_form_submission');
add_action('wp_ajax_nopriv_submit_quick_form', 'handle_quick_form_submission');

function handle_quick_form_submission() {
    global $wpdb;

    $full_name = sanitize_text_field($_POST['full-name']);
    $phone_number = sanitize_text_field($_POST['phone-number']);
    $prefer_call = sanitize_text_field($_POST['prefer_call']);
    $created_date = date('Y-m-d H:i:s');
    // validation
    $errors = [];
    // We make sure that the values ​​are not empty
    if (empty($full_name) || empty($phone_number) || empty($prefer_call)) {
        $errors[] = "لطفا تمام فیلدها را پر کنید.";
    }
    // Iranian Phone number preg match
    if (!preg_match('/^09[0-9]{9}$/', $phone_number)) {
        $errors[] = "شماره موبایل معتبر نمی‌باشد. لطفا شماره موبایل معتبری وارد کنید.";
    }
    // If there is a problem, we will send an appropriate message
    if (!empty($errors)) {
        wp_send_json_error(array('success' => false, 'message' => implode('<br>', $errors)));
    // Receive information and send to the database
    } else {
        $data = array(
            'full_name' => $full_name,
            'phone_number' => $phone_number,
            'prefer_call' => $prefer_call,
            'created_date' => $created_date
        );

        $table_name = $wpdb->prefix . 'hoovision_quick_form_create';

        $inserted = $wpdb->insert($table_name, $data);
        if ($inserted) {
            // Success message sent with Json
            wp_send_json_success(array('success' => true, 'message' => 'فرم با موفقیت ارسال شد!'));
        } else {
          // Faild message sent with Json
            wp_send_json_error(array('success' => false, 'message' => 'خطایی رخ داده است. لطفاً دوباره امتحان کنید.'));
        }
    }
    wp_die();
}
