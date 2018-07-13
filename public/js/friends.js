
$(function() {
    // クッキー保存されている or いない場合
    if ($.cookie('num')) {
        num = $.cookie('num');  
    } else {
        num = 0;    // ←★2
    }
 
    // タブ処理
    tabSwitching(num);
 
 
    // クリックされた場合
    $('#tab li').click(function() {
        // クリックされた <li> のインデックス番号を取得
        num = $('#tab li').index(this);
 
        // タブ処理
        tabSwitching(num);
 
 
        // クッキーを保存
        // 有効期限は1日(ブラウザを閉じたら初期化)
        $.cookie('num', num, {expires: 1});     // ←★3
    });
 
 
    // タブ切り替え処理
    function tabSwitching( num ){
        // リストに設定されている class="chose" を削除
        $('#tab li').removeClass('chose');
 
        // 前回クリックされていた <li> に class="chose" 追加
        $('#tab li').eq(num).addClass('chose');
 
        // tabContents に class="hide" を追加
        $('.tabContents').addClass('hide');
 
        // 取得したインデックス番号の class="hide" を削除
        $('.tabContents').eq(num).removeClass('hide');
    }
$.cookie('num', num, {
    expires: 2,
    path: '/',
    domain: 'wataame.sumomo.ne.jp',
    secure: true
});
});





