<div class="container customize-form mt-5 mb-5">
    <div class="panel panel-default">
        <div class="panel-heading mb-5">
            <p class="sub-title">.. ارسال درخواست ..</p>
            <p class="title">هر چیزی که می خواهید بدانید را بپرسید</p>
        </div>
        <div class="panel-body">
            <form action="" method="post" enctype="multipart/form-data" onsubmit="return validateForms()">
                <!-- Alert Message -->
                <div id="alert-msg"></div>
                <div class="row">
                    <div class="col-md-6">
                        <label for="full-name">نام و نام خانوادگی</label>
                        <input type="text" id="full-name" name="full-name" placeholder="نام و نام خانوادگی">
                    </div>
                    <div class="col-md-6">
                        <label for="email-address">آدرس ایمیل</label>
                        <input type="email" id="email-address" name="email-address" placeholder="آدرس ایمیل">
                    </div>
                    <div class="col-md-6">
                        <label for="subject">انتخاب موضوع</label>
                        <select id="subject" name="subject" class="form-select">
                            <option value="">انتخاب کنید</option>
                            <option value="general">عمومی</option>
                            <option value="support">پشتیبانی</option>
                            <option value="sales">فروش</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="phone_number">شماره تماس</label>
                        <input type="text" id="phone_number" name="phone_number" placeholder="شماره تماس">
                    </div>
                    <div class="col-md-12">
                        <label for="message">پیغام شما</label>
                        <textarea id="message" name="message" placeholder="پیغام شما"></textarea>
                    </div>
                    <?php
                    $randomNumber1 = rand(1, 9);
                    $randomNumber2 = rand(1, 9);
                    $randomSum = $randomNumber1 + $randomNumber2;
                    ?>

                    <div class="col-md-12 mt-2 mb-2">
                        <label for="rand-security">حاصل جمع <?= $randomNumber1 ?> و <?= $randomNumber2 ?> را در کادر
                            بنویسید.</label>
                        <input type="number" name="rand-security" id="rand-security" placeholder="پاسخ را وارد کنید">
                        <input type="hidden" id="security-check" name="security-check" value="<?= $randomSum ?>">
                    </div>
                    <div class="col-md-12">
                        <input type="submit" name="sendProfile" id="send-profile" class="btn" value="ثبت نام">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
