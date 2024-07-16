<br/>
<?php
global $wpdb;
$checkInput = new checkInput();
if (isset($_GET['action']) && $_GET['action'] == "delete" && isset($_GET['id'])) {
    $id = $checkInput->filter($_GET['id']);
    $result = $wpdb->delete('hoovision_quick_form_create', array('id' => $id));
    if ($result) {
        echo "<p class='alert alert-success'>فرم با موفقیت حذف شد.</p>";
        echo "<script>
            setTimeout(function() {
                window.location.href = 'admin.php?page=quick_item';
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
$total_items = $wpdb->get_var("SELECT COUNT(*) FROM hoovision_quick_form_create");
$total_pages = ceil($total_items / $limit);

// Fetch data with limit and offset
$sql = "SELECT * FROM hoovision_quick_form_create LIMIT $limit OFFSET $offset";
$get_result = $wpdb->get_results($sql, ARRAY_A);
$counter = $offset + 1;

if (count($get_result)) {
    ?>
    <table class="wp-list-table widefat fixed striped table-view-list posts">
        <thead>
        <tr>
            <th>ردیف</th>
            <th>نام و نام خانوادگی</th>
            <th>شماره تماس</th>
            <th>نحوه تماس</th>
            <th>تاریخ</th>
            <td>حذف</td>
        </tr>
        </thead>
        <tbody>

        <?php
        foreach ($get_result as $item) {
            ?>
            <tr>
                <td><?= $counter++ ?></td>
                <td><?= $item['full_name'] ?></td>
                <td><?= $item['phone_number'] ?></td>
                <th><?= $item['prefer_call']?></th>
                <td><?= $item['created_date'] ?></td>
                <td><a class="button" href="?page=quick_item&action=delete&id=<?= $item['id'] ?>">حذف</a></td>
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
