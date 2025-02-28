'use strict';

// ①シンプルな実装（toggleClassで実装）
$(function () {
    // ボタンがクリックされたら発動
    $(".hamburger").on("click", function () {
        //     // ドロワーメニュー部分のアニメーション
        $(".menu").toggleClass("is-active");
        //     // ボタン部分のアニメーション
        $(".hamberger").toggleClass("is-active");
    });
    $(".menu li").click(function () {
        $(".menu").removeClass("is-active");
        $(".hamburger").removeClass("is-active");
    });
});

// slickの読み込み
$(function () {
    $(".slider").slick({
        // 自動再生
        autoplay: true,
        // ドットインジケーターの表示
        dots: true,
        // 矢印の表示
        // arrows: true
    });
})
