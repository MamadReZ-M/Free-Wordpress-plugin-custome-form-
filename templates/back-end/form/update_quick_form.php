<div class="container customize-form mt-5 mb-5">
    <div class="panel panel-default">
        <div class="panel-heading bg-success"><p>.. بروزرسانی فرم سریع ..</p></div>
        <div class="panel-body">
            <form action="" method="post" enctype="multipart/form-data" onsubmit="return validateForms()">
                <!-- Alert Message -->
                <div id="alert-msg"></div>
                <div class="row">
                    <div class="col-md-6">
                        <label for="full-name">نام و نام خانوادگی</label>
                        <input type="text" id="full-name" name="full-name" placeholder="نام و نام خانوادگی" value="<?= $get_result[0]['full_name'] ?>">
                    </div>
                    <div class="col-md-6">
                        <label for="phone-number">شماره تماس</label>
                        <input type="text" id="phone-number" name="phone-number" placeholder="شماره تماس" value="<?= $get_result[0]['phone_number'] ?>">
                    </div>
                    <div class="col-md-12">
                        <input type="submit" name="UpdateQuick" id="send-quick" class="btn" value="بروزرسانی">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

