// 非同期検索用スクリプト

document.addEventListener('DOMContentLoaded', function () {

    const form = document.getElementById('search-form');
    if (!form) return;

    form.addEventListener('submit', function (e) {

        e.preventDefault();

        // フォームデータ取得
        const formData = new FormData(form);

        // URL作成
        const queryString = new URLSearchParams(formData).toString();
        const url = form.action + '?' + queryString;

        console.log('送信URL:', url);

        // product-list を取得
        const productList = document.getElementById('product-list');

        fetch(url, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
            .then(response => response.text())
            .then(html => {
                // product-list を差し替え
                productList.innerHTML = html;
            })
            .catch(error => {
                console.error('検索エラー:', error);
            });

    });

});