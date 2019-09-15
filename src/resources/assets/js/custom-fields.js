(function(window, $) {
    var CustomFields = function () {
        this.init();
    };

    CustomFields.prototype = {
        init: function () {
            this.bindings();
        },

        bindings: function () {
            var me = this;

            $('.js-add-field').on('click', function () {
                me.addCf($(this).data('add-url') + '?order=' + $('.cf-item').length);
            });

            $(document).on('click', '.js-params-toggle', function () {
                $(this).closest('.custom-field-row').find('.js-params-content').toggleClass('collapse');
            });

            $(document).on('click', '.js-params-delete', function () {
                $(this).closest('.custom-field-row').remove();
            });

            $(document).on('change', '.js-custom-field-types', function () {
                WidgetUpdater.update($(this).data('change-url') + '?type=' + $(this).val() + '&cf-id=' + $(this).data('cf-id') + '&cfg-id=' + $(this).data('cfg-id'),
                    $(this).closest('.custom-field-row').find('.js-param-rows'));
            });
        },

        addCf: function (url) {
            $.ajax({
                url: url,
                type: 'GET',
                dataType: 'json',
                processData: false,
                contentType: false,
                success: function(data){
                    $('.js-custom-field').append(data.view);
                },
                error: function(){
                    toastr.error('Error!');
                }
            });
        },

        changeType: function (url, type) {
            $.ajax({
                url: url,
                type: 'GET',
                dataType: 'json',
                processData: false,
                contentType: false,
                success: function(data){
                    $('.js-param-rows').html(data.view);
                },
                error: function(){
                    toastr.error('Error!');
                }
            });
        }
    };

    if (typeof self !== 'undefined') {
        self.CustomFields = CustomFields;
    }

    // Expose as a CJS module
    if (typeof exports === 'object') {
        module.exports = CustomFields;
    }
})(window, $);

var addCfButton =  $('.js-add-field').first();
if (typeof addCfButton !== 'undefined' && addCfButton !== null && addCfButton.length > 0) {
    new CustomFields();
}