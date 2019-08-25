/**
 * Created by sergisolsona on 23/11/17.
 */

$('.js-filter').on('change', function () {
    var route = new URL(window.location.href);
    var paramName = $(this).data('param');
    if (typeof paramName === 'undefined') {
        paramName = 'filter';
    }
    route.searchParams.delete(paramName);

    var filter = $(this).data('filter');

    if (filter) {
        route.searchParams.set(paramName, filter);
    }

    route.searchParams.delete('page');

    window.location.href = route.href;
});

$('.js-sort').on('click', function () {
    var route = new URL(window.location.href);
    route.searchParams.set('sort', $(this).data('sort') + '-' + $(this).data('direction'));

    route.searchParams.delete('page');

    window.location.href = route.href;
});

$('.js-clear-search').on('click', function () {
    var route = new URL(window.location.href);
    route.searchParams.delete('keyword');

    route.searchParams.delete('page');

    window.location.href = route.href;
});

$('.js-filter-form').on('change', function () {
    $(this.closest('form').submit());
});