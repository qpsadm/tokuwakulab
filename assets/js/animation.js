'use strict';

// ①シンプルな実装（toggleClassで実装）
$(function () {
    // ボタンがクリックされたら発動
    $(".hamburger").on("click", function () {
        //     // ドロワーメニュー部分のアニメーション
        $(".menu").toggleClass("is-active");
        //     // ボタン部分のアニメーション
        $(".hamburger").toggleClass("is-active");
    });
    $(".menu li").click(function () {
        $(".menu").removeClass("is-active");
        $(".hamburger").removeClass("is-active");
    });
});




// コンテンツをスクロールでふわっと表示
$(window).scroll(function () {
    // スクロール値を取得
    let scroll = $(window).scrollTop();
    // 画面の高さを取得
    let windowHeight = $(window).height();

    $("section").each(function () {
        // それぞれのコンテンツまでの高さを取得
        let boxHeight = $(this).offset().top;
        // 条件式に合致する場合はis-activeを付与
        if (scroll + windowHeight > boxHeight) {
            $(this).addClass("is-active-scroll");
        }
    });
});

// お問い合わせ画面、チェックボックスを入れるまで送信ボタンを無効化

// チェックボックスが変更されたときのイベントリスナー
document.addEventListener('DOMContentLoaded', function () {
    var checkbox = document.querySelector('.check-policy');
    var submitButton = document.querySelector('#submit');
    var hover = document.querySelector('.contact_nxt_btn');

    // 初期状態では送信ボタンを無効化
    submitButton.disabled = true;

    // チェックボックスが変更されたときのイベントリスナー
    checkbox.addEventListener('change', function () {
        if (this.checked) {
            submitButton.disabled = false;
            submitButton.style.backgroundColor = '#FF7B00';
            // チェックされたら送信ボタンを有効化

            // 確認ボタンのhover時のボタンの色を変える
            hover.addEventListener('mouseover', handleMouseOver);
            hover.addEventListener('mouseout', handleMouseOut);
        } else {
            submitButton.disabled = true; // チェックが外れたら送信ボタンを無効化

            // ホバーイベントを解除
            hover.removeEventListener('mouseover', handleMouseOver);
            hover.removeEventListener('mouseout', handleMouseOut);

            // ボタンの色を元に戻す
            hover.style.backgroundColor = '#ccc';

        }
    });

    function handleMouseOver() {
        hover.style.backgroundColor = '#fff';  // 背景色を変える
        hover.style.color = '#FF7B00'; // 文字色を変える
    }

    function handleMouseOut() {
        hover.style.backgroundColor = '#FF7B00';  // 元の背景色に戻す
        hover.style.color = '#FFF'; // 文字色を元に戻す
    }
});
