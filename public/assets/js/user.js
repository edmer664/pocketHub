$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});


$(function () {
    $('#userInfoForm').on('input change', function() {
        $('#userInfoFormBtn').attr('disabled', false);
    });
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
                    Toast.create("Success", data.msg , TOAST_STATUS.SUCCESS, 5000);
                }
            }
        });
    });

    $('#userPasswordForm').on('input change', function() {
        $('#userPasswordFormBtn').attr('disabled', false);
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
                    Toast.create("Success", data.msg , TOAST_STATUS.SUCCESS, 5000);
                }
            }
        });
    });

    $('#uploadImage').on('input change', function() {
        $('#uploadImageBtn').attr('disabled', false);
    });

    $('#uploadImage').on('submit', function (e) {
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
                    $('.default-avatar').each(function () {
                        $(this).addClass("d-none");
                    });
                    $('.avatar').each(function () {
                        $(this).attr("src", data.url + "/storage/avatars/" + data.avatar);
                        $(this).removeClass("d-none");
                    });
                    $('.avatar-hide').each(function () {
                        $(this).addClass("d-none");
                    });
                    $('#uploadImage')[0].reset();
                    Toast.create("Success", data.msg , TOAST_STATUS.SUCCESS, 5000);
                    $('#staticBackdrop').modal('hide')
                }
            }
        });
    });

    $('#deactivateForm').on('input change', function() {
        $('#deactivateFormBtn').attr('disabled', false);
    });

    $('#deactivateForm').on('submit', function (e) {
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
                    console.log(data.status)
                    $.each(data.error, function (prefix, val) {
                        $('span.error-text'+'.'+prefix).text(val[0]);
                    });
                }
            },
            error: function (httpObj) {
                if(httpObj.status==401){
                    location.reload();
                }  
            }
        });
    });
});
