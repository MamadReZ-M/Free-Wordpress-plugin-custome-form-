<br/>
<?php
global $wpdb;
$checkInput = new checkInput();

if (isset($_GET['action']) && $_GET['action'] == 'edit' && isset($_GET['id'])) {
    $id = $checkInput->filter($_GET['id']);
    $get_result = $wpdb->get_results("SELECT * FROM hoovision_form_create WHERE `id` = $id", ARRAY_A);

    if (!empty($get_result)) {
        include_once "form/update-form.php";

        if (isset($_POST['updateInfo'])) {
            $data = array(
                'full_name' => $checkInput->filter($_POST['full-name']),
                'email_address' => $checkInput->filter($_POST['email-address']),
                'subject' => $checkInput->filter($_POST['subject']),
                'phone_number' => $checkInput->filter($_POST['phone-number']),
                'message' => $checkInput->filter($_POST['message'])
            );
            $result = $wpdb->update('hoovision_form_create', $data, array('id' => $id));
            if ($result !== false) {
                echo "<p class='alert alert-success'>اطلاعات با موفقیت بروزرسانی شد.!</p>";
                echo "<script>
                    setTimeout(function() {
                        window.location.href = 'admin.php?page=contact_item';
                    }, 1000);
                </script>";
            } else {
                echo "<p class='alert alert-warning'>مشکلی در بروزرسانی اطلاعات وجود دارد.</p>";
            }
        }
    }
} elseif (isset($_GET['action']) && $_GET['action'] == "delete" && isset($_GET['id'])) {
    $id = $checkInput->filter($_GET['id']);
    $result = $wpdb->delete('hoovision_form_create', array('id' => $id));
    if ($result) {
        echo "<p class='alert alert-success'>فرم با موفقیت حذف شد.</p>";
        echo "<script>
            setTimeout(function() {
                window.location.href = 'admin.php?page=contact_item';
            }, 1000);
        </script>";
    } else {
        echo "<p class='alert alert-warning'>فرم حذف نشد، لطفا برای پشتیبانی با خانوم موسویان تماس بگیرید.</p>";
    }
}

// Pagination settings
$limit = 30;
$page = isset($_GET['paged']) ? intval($_GET['paged']) : 1;
$offset = ($page - 1) * $limit;
$total_items = $wpdb->get_var("SELECT COUNT(*) FROM hoovision_form_create");
$total_pages = ceil($total_items / $limit);

// Fetch data with limit and offset
$sql = "SELECT * FROM hoovision_form_create LIMIT $limit OFFSET $offset";
$get_result = $wpdb->get_results($sql, ARRAY_A);
$counter = $offset + 1;

if (count($get_result)) {
    ?>
    <table class="wp-list-table widefat fixed striped table-view-list posts">
        <thead>
        <tr>
            <th>ردیف</th>
            <th>نام و نام خانوادگی</th>
            <th>ایمیل</th>
            <th>شماره تماس</th>
            <th>موضوع</th>
            <th>تاریخ ایجاد</th>
            <th>حذف</th>
            <th>ویرایش</th>
        </tr>
        </thead>
        <tbody>

        <?php
        foreach ($get_result as $item) {
            ?>
            <tr>
                <td><?= $counter++ ?></td>
                <td><?= $item['full_name'] ?></td>
                <td><?= $item['email_address'] ?></td>
                <td><?= $item['phone_number'] ?></td>
                <td><?= $item['subject'] ?></td>
                <td><?= $item['created_date'] ?></td>
                <td><a class="button" href="?page=contact_item&action=delete&id=<?= $item['id'] ?>">حذف</a></td>
                <td><a class="button" href="?page=contact_item&action=edit&id=<?= $item['id'] ?>">ویرایش</a></td>
            </tr>
            <?php
        }
        ?>
        </tbody>
    </table>
    <?php
    // Display pagination
    $pagination_args = array(
        'base' => add_query_arg('paged', '%#%'),
        'format' => '',
        'current' => max(1, $page),
        'total' => $total_pages,
        'prev_text' => __('« قبلی'),
        'next_text' => __('بعدی »'),
    );
    echo '<div class="pagination-wrap">';
    echo paginate_links($pagination_args);
    echo '</div>';
} else {
    echo '<p>هیچ موردی یافت نشد!</p>';
}
?>
