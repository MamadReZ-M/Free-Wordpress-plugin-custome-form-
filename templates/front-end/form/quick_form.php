<form id="quick-form" action="" method="post" enctype="multipart/form-data">
    <!-- Alert Message -->
    <div id="alert-msg"></div>
    <div class="row align-items-center">
        <div class="col-md-12 mt-2 mb-2">
            <div class="form-group">
                <label for="full-name">نام و نام خانوادگی<b>*</b> </label>
                <input type="text" id="full-name" name="full-name" placeholder="نام و نام خانوادگی">
            </div>
        </div>
        <div class="col-md-12 mt-2 mb-2">
            <div class="form-group">
                <label for="phone-number">تلفن همراه<b>*</b> </label>
                <input type="text" id="phone-number" name="phone-number" placeholder="شماره تماس">
            </div>
        </div>
        <div class="col-md-12 mt-2 mb-2">
            <p>شما چی ترجیح میدید؟</p>
            <div class="form-check">
                <input type="radio" name="prefer-call" id="phone" checked value="phone">
                <label class="form-check-label" for="phone">
                    تلفنی باهاتون صحبت کنیم
                </label>
            </div>
            <div class="form-check">
                <input type="radio" name="prefer-call" id="chat" value="chat">
                <label class="form-check-label" for="chat">
                    توی تلگرام باهاتون چت کنیم
                </label>
            </div>
        </div>
        <div class="col-md-12 mt-2 mb-2">
            <div class="form-group">
                <input type="submit" name="quick_confirm" id="quick_confirm" class="btn" value="دریافت مشاوره">
            </div>
        </div>
    </div>
</form>
