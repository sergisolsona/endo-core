var settingsUrls;

function changeSetting(input) {
    var setting = input.attr('name');
    var value = input.val();

    if (input.attr('type') === 'checkbox') {
        value = input.is(':checked') ? 1 : 0;
    }

    $.ajax({
        url: settingsUrls,
        method: "POST",
        data: {
            setting: setting,
            value: value
        },
        error: function(data) {
            console.log(data);
            toastr.error('Error');
        }
    });
}


$(document).ready(function() {
    settingsUrls = $('.js-setting-url').val();

    if (typeof settingsUrls !== 'undefined') {
        $('.js-endo-setting').on('change', function () {
            changeSetting($(this));
        });
    }
});


$(".js-delete-entity").each(function (e, item) {
    $(item).on('click', function (e) {
        var $element = $(this);
        var entityMessage = $element.data('entity-message');
        if(confirm(entityMessage)) {
            var deleteUrl = $element.data('url');
            var token = $element.data('token');
            var redirectUrl = $element.data('redirect');

            $.ajax({
                type: "DELETE",
                url: deleteUrl,
                data: ({_token: token}),
                cache: false,
                dataType: "text",
                success: function (data) {
                    if (typeof redirectUrl !== 'undefined') {
                        window.location = redirectUrl;
                    }
                },
                error: function () {
                    toastr.error('Error!');
                }
            });
        }
    })
});


$('.js-update-status').on('click', function () {
    var url = $(this).data('url');
    var name = $(this).data('name');
    var current = $(this).data('current-value');
    var redirectUrl = $(this).data('redirect');

    $.ajax({
        type: 'POST',
        url: url,
        data: {
            _token: $('meta[name="csrf-token"]').attr('content'),
            name: name,
            current: current,
        },
        success: function (data) {
            window.location = redirectUrl;
        },
        error: function (data, textStatus) {
            toastr.error(data.responseJSON.message);
        }
    })
});


$('.js-translatable-checkbox').on('change', function () {
    if ($(this).is(':checked')) {
        $('.js-non-translatable').slideUp('fast');
        $('.js-translatable').slideDown('fast');
    } else {
        $('.js-translatable').slideUp('fast');
        $('.js-non-translatable').slideDown('fast');
    }
});



$.each($('.js-sluggify'), function () {
    $('#' + $(this).data('target')).slugify($(this)); // Type as you slug
});