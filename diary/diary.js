'use strict'
const textarea = document.getElementById('write');

// textarea要素にフォーカスが当たった時のイベントリスナーを登録
textarea.addEventListener('focus', function () {
  // カーソルの位置を3文字目に移動する
    const position = 130;
    textarea.setSelectionRange(position, position);
});
