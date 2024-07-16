<div class="container customize-form mt-5 mb-5">
    <div class="panel panel-default">
        <div class="panel-heading bg-success"><p>.. بروزرسانی درخواست ..</p></div>
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
                        <label for="email-address">آدرس ایمیل</label>
                        <input type="email" id="email-address" name="email-address" placeholder="آدرس ایمیل" value="<?= $get_result[0]['email_address'] ?>">
                    </div>
                    <div class="col-md-6">
                        <label for="subject">انتخاب موضوع</label>
                        <select id="subject" name="subject" class="form-select">
                            <option value="<?= $get_result[0]['subject'] ?>"><?= $get_result[0]['subject'] ?></option>
                            <option value="general">عمومی</option>
                            <option value="support">پشتیبانی</option>
                            <option value="sales">فروش</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="phone-number">شماره تماس</label>
                        <input type="number" id="phone-number" name="phone-number" placeholder="شماره تماس" value="<?= $get_result[0]['phone_number'] ?>">
                    </div>
                    <div class="col-md-12">
                        <label for="message">پیغام شما</label>
                        <textarea id="message" name="message" placeholder="پیغام شما"><?= $get_result[0]['message'] ?></textarea>
                    </div>
                    <div class="col-md-12">
                        <input type="submit" name="updateInfo" id="update-info" class="btn" value="بروزرسانی">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>