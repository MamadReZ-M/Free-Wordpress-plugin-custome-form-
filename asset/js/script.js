function validateForms() {
    var fullName = $("#full-name").val();
    var emailAddress = $('#email-address').val();
    var subject = $('#subject').val();
    var phoneNumber = $('#phone-number').val();
    var message = $('#message').val();

    var phoneRegex = /^09[0-9]{9}$/;  // Regex for Iranian phone numbers
    var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/; // Simple regex for email

    if (fullName == '' || emailAddress == '' || subject == '' || phoneNumber == '' || message == '') {
        $("#alert-msg").html(
            "<h4 class='alert alert-danger'>لطفا فیلدی را خالی نگذارید..!</h4>"
        );
        $('html, body').animate({
            scrollTop: $("#alert-msg").offset().top - 180
        }, 1000);
        return false;
    }

    if (!phoneRegex.test(phoneNumber)) {
        $("#alert-msg").html(
            "<h4 class='alert alert-danger'>شماره موبایل معتبر نمی‌باشد. لطفا شماره موبایل معتبری وارد کنید.</h4>"
        );
        $('html, body').animate({
            scrollTop: $("#alert-msg").offset().top - 180
        }, 1000);
        return false;
    }

    if (!emailRegex.test(emailAddress)) {
        $("#alert-msg").html(
            "<h4 class='alert alert-danger'>آدرس ایمیل معتبر نمی‌باشد. لطفا ایمیل معتبر وارد کنید.</h4>"
        );
        $('html, body').animate({
            scrollTop: $("#alert-msg").offset().top - 180
        }, 1000);
        return false;
    }

}




