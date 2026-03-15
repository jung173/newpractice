import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

import './products/search';

import $ from 'jquery';

$(document).ready(function() {

    $('#search-form').on('submit', function(e) {
        e.preventDefault();

        $.ajax({
            url: $(this).attr('action'),
            type: 'GET',
            data: $(this).serialize(),
            success: function(response) {
                $('#product-list').html(response);
            },
            error: function() {
                alert('通信エラーが発生しました');
            }
        });

    });
    updateSortIcons();
});

$(document).on('submit', '.delete-form', function(e) {

    e.preventDefault();

    if (!confirm('削除しますか？')) {
        return;
    }

    let form = $(this);

    $.ajax({
        url: form.attr('action'),
        type: 'POST',
        data: form.serialize(),
        success: function() {
            form.closest('tr').remove();
        },
        error: function() {
            alert('削除に失敗しました');
        }
    });

});

let currentSort = 'id';
let currentDirection = 'desc';

$(document).on('click', 'th[data-sort]', function() {

    let sort = $(this).data('sort');

    if (currentSort === sort) {
        currentDirection = currentDirection === 'asc' ? 'desc' : 'asc';
    } else {
        currentSort = sort;
        currentDirection = 'asc';
    }

    loadProducts();
});

function loadProducts() {
    $.ajax({
        url: '/products',
        type: 'GET',
        data: {
            sort: currentSort,
            direction: currentDirection
        },
        success: function(response) {
            $('#product-list').html(response);
            updateSortIcons();
        },
        error: function() {
            alert('通信エラーが発生しました');
        }
    });
}

function updateSortIcons() {

    // すべてのアイコンをリセット
    $('th[data-sort]').removeClass('active-sort');
    $('.sort-icon').text('');

    // 現在ソート中のヘッダーを取得
    let activeHeader = $('th[data-sort="' + currentSort + '"]');

    activeHeader.addClass('active-sort');

    if (currentDirection === 'asc') {
        activeHeader.find('.sort-icon').text('▲');
    } else {
        activeHeader.find('.sort-icon').text('▼');
    }
}