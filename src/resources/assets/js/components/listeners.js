var settingsUrls;

$(document).ready(function() {
    settingsUrls = $('.js-setting-url').val();
    console.log(settingsUrls);
    if (typeof settingsUrls !== 'undefined') {
        $('.js-endo-setting').on('change', function () {
            changeSetting($(this));
        });
    }
});

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