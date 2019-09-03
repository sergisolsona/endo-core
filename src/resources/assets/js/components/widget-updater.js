(function(window, $){
    var oldWidgets;

    var WidgetUpdater = function() {
        this.init();
    };

    WidgetUpdater.prototype = {
        init: function () {
            oldWidgets = {};

            this.bindings();
        },

        bindings: function () {
            var me = this;

            var fresh = false;

            var url = new URL(window.location.href);
            var freshParam = url.searchParams.get("fresh");

            if (freshParam) {
                fresh = freshParam;
            }

            $('.js-backoffice-widget').each(function () {
                var divElement = $(this);
                var widgetDataUrl = divElement.data('url');

                if (widgetDataUrl) {
                    var dataUrl = new URL(widgetDataUrl);
                    var updateInterval = divElement.data('interval');

                    if (fresh) {
                        dataUrl.searchParams.set('fresh', fresh);
                    }

                    me.update(dataUrl.href, divElement);

                    if (updateInterval) {
                        var updateUrl = new URL(widgetDataUrl);
                        updateUrl.searchParams.set('fresh', 'yes');

                        setInterval(function() { me.update(updateUrl.href, divElement); }, updateInterval);
                    }
                }
            });
        },

        update: function (url, widget) {
            var me = this;
            var errorId = widget.data('error-id');

            $.ajax({
                url: url,
                type: 'GET',
                dataType: 'json',
                processData: false,
                contentType: false,
                success: function(d){
                    if (errorId) {
                        $("#" + errorId).html("");
                    }

                    me.replaceWidget(widget, d.widget);
                },
                error: function(){
                    if (errorId) {
                        $("#" + errorId).html("Update error");
                    }
                }
            });
        },

        updateChart: function (url, chart) {
            $.ajax({
                url: url,
                type: 'GET',
                dataType: 'json',
                processData: false,
                contentType: false,
                success: function(d){
                    var updated = false;
                    var canvas = $('#' + chart.canvas.id);
                    var totalId = canvas.data('total-id');

                    if ('labels' in d && d.labels.toString() !== chart.data.labels.toString()) {
                        chart.data.labels = d.labels;
                        updated = true;
                    }

                    for (var key in chart.data.datasets) {
                        // String compare is fine
                        if (chart.data.datasets[key].data.toString() !== d.rows[key].toString()) {
                            chart.data.datasets[key].data = d.rows[key];
                            updated = true;
                        }
                    }

                    if (updated) {
                        chart.update();

                        if (totalId) {
                            $('#' + totalId).html(d.total);
                        }
                    }

                    canvas.closest('.ibox-content').removeClass('sk-loading');
                },
                error: function(){

                }
            });
        },

        updateMap: function (url, mapObject, mapDiv) {
            var me = this;
            $.ajax({
                url: url,
                type: 'GET',
                dataType: 'json',
                processData: false,
                contentType: false,
                success: function(d) {
                    mapObject.series.regions[0].clear();

                    if (typeof d.maxValue !== 'undefined') {
                        mapObject.series.regions[0].params.max = d.maxValue
                    }

                    if (typeof d.minValue !== 'undefined') {
                        mapObject.series.regions[0].params.min = d.minValue
                    }

                    mapObject.series.regions[0].setValues(d.mapData);

                    mapDiv.closest('.ibox-content').removeClass('sk-loading');

                    me.replaceWidget($('.js-map-widget').first(), d.widget);
                },
                error: function(){

                }
            });
        },

        replaceWidget: function (widget, newContent) {
            if (typeof newContent !== 'string' || typeof widget === 'undefined' || widget === null) {
                return;
            }

            if (!widget[0].id) {
                widget[0].id = 'js-id-' + Math.random().toString(36).substr(2, 16);
            }

            var widgetId = widget[0].id;

            if (typeof oldWidgets === 'undefined' || !(widgetId in oldWidgets)) {
                oldWidgets[widgetId] = '';
            }

            if (oldWidgets[widgetId] === newContent) {
                return;
            }

            oldWidgets[widgetId] = newContent;

            var animation = widget.data('animation');
            if (newContent !== '') {
                if (animation && !$.trim(widget.html())) {
                    newContent = newContent.replace('animated', 'animated ' + animation);
                }

                widget.html(newContent);

                if (newContent !== '' && widget.data('footable')) {
                    $('.footable').footable({paginate: false});
                }

                if (newContent !== '' && widget.data('tooltip')) {
                    $('[data-toggle="tooltip"]').tooltip({
                        container: "body"
                    });
                }
            } else if($.trim(widget.html())) {
                if (!animation) {
                    widget.html(newContent);
                    return;
                }

                var animatedWidget = widget.find('.animated').first();
                animatedWidget.removeClass(animation).removeClass('animated');
                animation = animation.replace('In', 'Out');
                if (animation.includes('Down')) {
                    animation = animation.replace('Down', 'Up');
                } else if (animation.includes('Up')) {
                    animation = animation.replace('Up', 'Down');
                }

                animatedWidget.addClass('animated').addClass(animation);

                setTimeout(function() { widget.html(newContent); }, 1000);
            }
        }
    };

    if (typeof self !== 'undefined') {
        self.WidgetUpdater = WidgetUpdater;
    }

    // Expose as a CJS module
    if (typeof exports === 'object') {
        module.exports = WidgetUpdater;
    }
})(window, $);

if (typeof window !== 'undefined') {
    window.WidgetUpdater = new WidgetUpdater();
}
