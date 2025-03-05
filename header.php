<?php
// 開発モードで公開の時は、管理画面へのログインが必要です。
if (!is_user_logged_in() && IS_DEV == true) {
    header('Location:' . home_url('/') . 'wp-admin');
    exit;
}
?>

<?php
$description = "このサイトは徳島県内の科学的なイベント情報を集約したサイトです。";

// ★確認して消す　今野3/4
// if (is_home()) {
//     $description = "description,description,descriptiondescription,description,description。";
// } else {
//     $description = "description1,description1,description1,description1,description1。";
// }

$keywords = '徳島,科学,イベント,体験,プログラミング,親子,ロボット,教育,学び,実験,理科,科学館,サイエンス,ものづくり,環境,化学,小学生,中学生,高校生,'
?>


<!DOCTYPE html>

<!-- <html <?php language_attributes(); ?>> もともとの記述はこちら（石田） -->
<html lang="<?php bloginfo('language'); ?>">

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, user-scalable=no">

    <!-- ディスクリプション変数を出力する。各ページごとに異なる説明文を動的に設定。不要なら修正要 -->
    <meta name="description" content="<?php echo $description; ?>">

    <!-- keywords変数を出力する。 -->
    <meta name="keywords" content="<?php echo $keywords; ?>">

    <!-- 電話番号自動認識機能OFF -->
    <meta name="format-detection" content="telephone=no">

    <!-- wp_head()を呼び出す -->
    <?php
    wp_head();
    ?>
</head>

<body <?php body_class(); ?>>
    <!-- wp_body_open()を呼び出す -->
    <?php
    wp_body_open();
    ?>

    <header>
        <div class="inner">
            <!-- ロゴ -->
            <h1>
                <a href="<?php echo home_url(); ?>">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/logo.svg" alt="徳島わくわくラボのロゴ">
                </a>
            </h1>
            <!-- ハンバーガーボタン -->
            <div class="hamburger pc_none">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>

        <nav class="menu pc_none">
            <ul>
                <li>
                    <a href="<?php echo home_url('/'); ?>">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/logo.svg" alt="徳島わくわくラボのロゴ">
                    </a>
                </li>
                <li class="menu_item"><a href="<?php echo home_url('/event/'); ?>">イベント月別一覧</a></li>
                <li class="menu_item"><a href="<?php echo home_url('/?s='); ?>">イベントをさがす</a></li>
                <li class="menu_item"><a href="<?php echo home_url('/category/news/'); ?>">お知らせ</a></li>
                <li class="menu_item"><a href="<?php echo home_url('/organization/'); ?>">主催団体一覧</a></li>
                <li class="menu_item"><a href="<?php echo home_url('/column/'); ?>">コラム</a></li>
                <li class="menu_item"><a href="<?php echo home_url('/mypage/'); ?>">お気に入り</a></li>
                <li class="menu_item"><a href="<?php echo home_url('/contact/'); ?>">主催団体様<br>
                        お問い合わせ</a></li>
            </ul>
        </nav>
        <nav class="sp_none">
            <ul>
                <li><a href="<?php echo home_url('/event/'); ?>">イベント月別一覧</a></li>
                <li><a href="<?php echo home_url('/?s='); ?>">イベントをさがす</a></li>
                <li><a href="<?php echo home_url('/category/news/'); ?>">お知らせ</a></li>
                <li><a href="<?php echo home_url('/organization/'); ?>">主催団体一覧</a></li>
                <li><a href="<?php echo home_url('/column/'); ?>">コラム一覧</a></li>
                <li><a href="<?php echo home_url('/mypage/'); ?>">お気に入り</a></li>
                <li><a href="<?php echo home_url('/contact/'); ?>">主催団体様<br>
                        お問い合わせ</a></li>
            </ul>
        </nav>



    </header>
