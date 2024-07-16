<div class="customize-form">
    <?php

    if (isset($_POST['sendProfile'])) {
        $checkInput = new checkInput();
        $rand_security = $checkInput->filter($_POST['rand-security']);
        $security_check = $checkInput->filter($_POST['security-check']);
        if ($rand_security === $security_check) {

            $full_name = $checkInput->filter($_POST['full-name']);
            $email_address = $checkInput->filter($_POST['email-address']);
            $subject = $checkInput->filter($_POST['subject']);
            $phone_number = $checkInput->filter($_POST['phone_number']);
            $message = $checkInput->filter($_POST['message']);
            $created_date = date('Y-m-d H:i:s');
            // Validation
            $errors = [];

            if (!preg_match('/^09[0-9]{9}$/', $phone_number)) {
                $errors[] = "شماره موبایل معتبر نمی‌باشد. لطفا شماره موبایل معتبری وارد کنید.";
            }

            if (!filter_var($email_address, FILTER_VALIDATE_EMAIL)) {
                $errors[] = "آدرس ایمیل معتبر نمی‌باشد. لطفا ایمیل معتبر وارد کنید.";
            }

            if (empty($full_name) || empty($email_address) || empty($subject) || empty($phone_number) || empty($message)) {
                $errors[] = "لطفا فیلدی را خالی نگذارید.";
            }

            if (!empty($errors)) {
                foreach ($errors as $error) {
                    echo "<p class='alert alert-warning'>$error</p>";
                }
            } else {
                // Insert new Register Members
                $data = array(
                    'full_name' => $full_name,
                    'email_address' => $email_address,
                    'subject' => $subject,
                    'phone_number' => $phone_number,
                    'message' => $message,
                    'created_date' => $created_date
                );

                global $wpdb;
                $wpdb->insert('hoovision_form_create', $data);
                $hoovision_insert_id = $wpdb->insert_id;
                if ($hoovision_insert_id) {
                    echo "<p class='alert alert-success'>به زودی کارشناسان ما با شما تماس خواهند گرفت.</p>";
                } else {
//                $wpdb_error = $wpdb->last_error;
                    echo "<p class='alert alert-warning'>لطفا مدتی دیگر تست نمایید.</p>";
                }
            }
        } else {
            echo "<p class='alert alert-danger'>لطفا کد امنیتی را وارد کنید.</p>";
        }

    }
    include_once "form/register-form.php";
    ?>

</div>
