/**
 * Created by sergisolsona on 23/1/17.
 */

require('../components/datapicker/bootstrap-datepicker');

(function(window, $) {
    var BackofficeDatePicker = function () {

        this.init();
    };

    BackofficeDatePicker.prototype = {
        init: function () {
            this.bindings();
        },

        bindings: function () {
            var inputDates = $('.input-group.date');

            inputDates.datepicker({
                keyboardNavigation: true,
                forceParse: false,
                calendarWeeks: true,
                autoclose: true,
                format: "yyyy/mm/dd",
                todayBtn: "linked",
                todayHighlight:true
            });

            inputDates.each(function (e) {

                var inputDate = $(this);
                var changeUrl = inputDate.data('change-url');

                if (changeUrl) {
                    inputDate.datepicker().on('changeDate', function (ev) {
                        window.location.href = changeUrl.replace("/change-date/", '/' + ev.format() + '/');
                        $('.backoffice-loader').show();
                    });
                }

                var changeParamUrl = inputDate.data('change-paramurl');

                if (changeParamUrl) {
                    inputDate.datepicker().on('changeDate', function (ev) {
                        window.location.href = changeParamUrl +ev.format();
                        $('.backoffice-loader').show();
                    });
                }

                if (inputDate.hasClass('js-edit-pedido-date')) {
                    inputDate.datepicker().on('changeDate', function (ev) {
                        var updateUrl = inputDate.data('update-url') + '?date=' + ev.format();

                        WidgetUpdater.update(updateUrl, $('#js-new-pedido-details'));
                    });
                }
            });
        }
    };

    if (typeof self !== 'undefined') {
        self.BackofficeDatePicker = BackofficeDatePicker;
    }

    // Expose as a CJS module
    if (typeof exports === 'object') {
        module.exports = BackofficeDatePicker;
    }
})(window, $);

var dateElement =  $('.input-group.date').first();
if (typeof dateElement !== 'undefined' && dateElement !== null && dateElement.length > 0)
{
    new BackofficeDatePicker();
}