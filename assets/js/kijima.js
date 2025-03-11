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
        autoplay: true,// 自動再生
        autoplaySpeed: 5000,//自動再生のスピード
        dots: true,// ドットインジケーターの表示
        // 矢印の表示
        prevArrow: '<button class="slick_prev_kv"><img src="../assets/img/slickarrow_left.png" alt="Previous"></button>',
        nextArrow: '<button class="slick_next_kv"><img src="../assets/img/slickarrow_right.png" alt="Next"></button>',
    });
})
$(function () {
    // メイン画像のオプション
    $(".slider_org").slick({
        slidesToShow: 1,    // 表示するスライド数
        slidesToScroll: 1,  // スクロールするスライド数
        centerMode: true,   // 中央揃え
        variableWidth: true, // 幅の自動調整
        autoplay: true, // 自動再生ON/OFF
        autoplaySpeed: 3000, // 自動再生スピード[msec]
        infinite: true, // ループ再生ON/OFF
        cssEase: 'linear', // イージングモード
        pauseOnFocus: true,    // フォーカスで停止ON/OFF
        pauseOnHover: true,    // ホバーで停止ON/OFF
        swipeToSlide: true, // スワイプ切り替えON/OFF
        // 矢印の表示
        prevArrow: '<button class="slick_prev_org"><img src="../assets/img/slickarrow_left.png" alt="Previous"></button>',
        nextArrow: '<button class="slick_next_org"><img src="../assets/img/slickarrow_right.png" alt="Next"></button>',
        // レスポンシブ設定
        responsive: [
            {
                breakpoint: 1280,   // 横幅がこのpx未満に適用
                settings: {
                    slidesToShow: 3,    // スライド数
                    centerMode: false,   // 中央揃え
                }
            },
            {
                breakpoint: 780,    // 横幅がこのpx未満に適用
                settings: {
                    slidesToShow: 2,    // スライド数
                    slidesToScroll: 1,  //  明示的に指定
                }
            },
        ]
    });
});
