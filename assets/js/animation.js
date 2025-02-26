'use strict';

// ①シンプルな実装（toggleClassで実装）
$(function () {
    // ボタンがクリックされたら発動
    $(".hamburger_btn").on("click", function () {
        //     // ドロワーメニュー部分のアニメーション
        $(".menu").toggleClass("is-active");
        //     // ボタン部分のアニメーション
        $(".hamberger_btn").toggleClass("is-active");
    });
    $(".menu li").click(function () {
        $(".menu").removeClass("is-active");
        $(".hamburger_btn").removeClass("is-active");
    });
});
