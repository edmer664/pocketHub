$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(function () {
    $('#userInfoForm').on('submit', function (e) {
        e.preventDefault();
        $.ajax({
            url: $(this).attr('action'),
            method: $(this).attr('method'),
            data: new FormData(this),
            processData: false,
            dataType: 'json',
            contentType: false,
            beforeSend: function () {
                $(document).find('span.error-text').text('');
            },
            success: function (data) {
                if (data.status == 0) {
                    $.each(data.error, function (prefix, val) {
                        $('span.error-text'+'.'+prefix).text(val[0]);
                    });
                } else {
                    $('.name').each(function () {
                        $(this).html($('#userInfoForm').find($('input[name="first_name"]')).val() +' '+ $('#userInfoForm').find($('input[name="last_name"]')).val());
                    });
                    alert(data.msg);
                }
            }
        });
    });

    $('#userPasswordForm').on('submit', function (e) {
        e.preventDefault();
        $.ajax({
            url: $(this).attr('action'),
            method: $(this).attr('method'),
            data: new FormData(this),
            processData: false,
            dataType: 'json',
            contentType: false,
            beforeSend: function () {
                $(document).find('span.error-text').text('');
            },
            success: function (data) {
                if (data.status == 0) {
                    $.each(data.error, function (prefix, val) {
                        $('span.error-text'+'.'+prefix).text(val[0]);
                    });
                } else {
                    $('#userPasswordForm')[0].reset();
                    alert(data.msg);
                }
            }
        });
    });

});
