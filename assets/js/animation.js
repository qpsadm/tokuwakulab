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

// slickの読み込み
$(function () {
    $(".slider_kv").slick({
        // 自動再生
        autoplay: true,
        // ドットインジケーターの表示
        dots: true,
        // 矢印の表示
        arrows: true
    });
})

$(function () {
    $('.slider_org').slick({
        autoplay: true, //自動でスクロール
        autoplaySpeed: 0, //自動再生のスライド切り替えまでの時間を設定
        speed: 10000, //スライドが流れる速度を設定
        cssEase: "linear", //スライドの流れ方を等速に設定
        slidesToShow: 2, //表示するスライドの数
        // swipe: false, // 操作による切り替えはさせない
        arrows: false, //矢印非表示
        pauseOnFocus: false, //スライダーをフォーカスした時にスライドを停止させるか
        pauseOnHover: false, //スライダーにマウスホバーした時にスライドを停止させるか
        responsive: [
            {
                breakpoint: 767,
                settings: {
                    slidesToShow: 1, //画面幅767px以下でスライド3枚表示
                }
            }
        ]
    });
});