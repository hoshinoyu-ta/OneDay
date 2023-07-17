'use strict'
{

    // XMLHttpRequestオブジェクトを作成します
        let xhr = new XMLHttpRequest();

        // トップページのHTMLファイルのURLを指定します
        let url = '/webapp/oneday.html';

        // GETリクエストを送信します
        xhr.open('GET', url, true);

        // レスポンスが返ってきた時の処理を定義します
        xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            // レスポンスのHTMLを取得します
            let responseHTML = xhr.responseText;
            
            // レスポンスのHTMLをパースしてDOMオブジェクトを作成します
            let parser = new DOMParser();
            let doc = parser.parseFromString(responseHTML, 'text/html');
            
            // 取得したDOMオブジェクトから要素にアクセスします
            let topImage = doc.getElementById('#window');
            // トップページの画像要素が存在するか確認します
        if (topImage) {
            // 画像が存在する場合の処理を記述します
            // ここで画像の属性やスタイルを変更するなどの操作が可能です
            // 例: topImage.src = 'path/to/new-image.jpg';
            } else {
            // 画像が存在しない場合の処理を記述します
            }
            }
        };






    const btn = document.querySelector('#register')
    const img1 = document.querySelector('#window');
    const img2 = document.querySelector('#window-c');
    let img1Visible = false;

    function imgchg(){
        if (img1Visible) {
            img1.style.display = 'inline-block';
        } else {
            img1.style.display = 'none';
        }

        if (img2.style.display === 'none') {
            img2.style.display = 'inline-block';
        } else {
            img2.style.display = 'none';
        }

        return  img1Visible;
    }

    btn.addEventListener('click',()=>{
        const result = imgchg()
        const url = 'oneday.html?result=' + encodeURIComponent(result);
        window.location.href = url;
    })

    console.log('画像が入れ替わりました');
}