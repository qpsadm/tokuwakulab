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
        prevArrow: slickParams.prevArrow,
        nextArrow: slickParams.nextArrow,
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
        prevArrow: slickParams.prevArrow,
        nextArrow: slickParams.nextArrow,
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


// コンテンツ表示の関数
$(window).scroll(function () {
    // スクロール値を取得
    let scroll = $(window).scrollTop();
    // 画面の高さを取得
    let windowHeight = $(window).height();

    $(".section").each(function () {
        // それぞれのコンテンツまでの高さを取得
        let boxHeight = $(this).offset().top;
        // 条件式に合致する場合はis-activeを付与
        if (scroll + windowHeight > boxHeight) {
            $(this).addClass("is-active-scroll");
        }
    });
});