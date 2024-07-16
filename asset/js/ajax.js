function updateOrder() {
    var fullName = $("#full-name").val();
    var preferCall = $("input[name='prefer-call']:checked").val();
    var phoneNumber = $('#phone-number').val();
    var phoneRegex = /^09[0-9]{9}$/;  // Regex for Iranian phone numbers

    if (fullName === '' || phoneNumber === '' || preferCall === '') {
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

    var formData = {
        action: 'submit_quick_form',
        'full-name': fullName,
        'phone-number': phoneNumber,
        'prefer_call': preferCall
    };

    $.ajax({
        type: 'POST',
        url: hoovisionAjax.ajaxurl,
        dataType: "json",
        data: formData,
        success: function (response) {
            if (response.success) {
                $("#alert-msg").html(
                    "<h4 class='alert alert-success'>کارشناسان ما به زودی با شما تماس خواهند گرفت.</h4>"
                );
            } else {
                $("#alert-msg").html(
                    "<h4 class='alert alert-danger'>" + response.message + "</h4>"
                );
            }
            $('html, body').animate({
                scrollTop: $("#alert-msg").offset().top - 180
            }, 1000);
            $('#quick-form')[0].reset();
            setTimeout(function() {
                $("#alert-msg").html("");
            }, 5000);
        },
        error: function (response) {
            $("#alert-msg").html(
                "<h4 class='alert alert-danger'>خطایی رخ داده است. لطفاً دوباره امتحان کنید.</h4>"
            );
            $('html, body').animate({
                scrollTop: $("#alert-msg").offset().top - 180
            }, 1000);
        }
    });
}

$('#quick-form').on('submit', function (e) {
    e.preventDefault();
    updateOrder();
});
