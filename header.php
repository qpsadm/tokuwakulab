<?php
// 開発モードで公開の時は、管理画面へのログインが必要です。
if (!is_user_logged_in() && IS_DEV == true) {
    header('Location:' . home_url('/') . 'wp-admin');
    exit;
}
?>

<?php
$description = "";

if (is_home()) {
    $description = "description,description,descriptiondescription,description,description。";
} else {
    $description = "description1,description1,description1,description1,description1。";
}
?>


<!DOCTYPE html>

<!-- <html <?php language_attributes(); ?>> もともとの記述はこちら（石田） -->
<html lang="<?php bloginfo('language'); ?>">

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, user-scalable=no">

    <!-- デliスクリプション変数を出力する。各ページごとに異なる説明文を動的に設定。不要なら修正要 -->
    <meta name="description" content="<?php echo $description; ?>">

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

    <header class="header">
        <!-- ヘッダーロゴ -->
        <!-- ↓PHPは未修整。2/27石田 -->
        <div class="header_logo">
            <h1 class="logo"><a href="<?php echo home_url(); ?>"><?php bloginfo('name'); ?><span><?php bloginfo('description'); ?></span></a></h1>
        </div>

        <div class="header_nav">
            <div class="header_menu js-menu-icon"><span></span></div>
            <div class="gnav js-menu">
                <!-- スラッグはとりあえずのネーミングです -->
                <ul class="">
                    <li><a href="<?php echo home_url('/?s=/'); ?>">イベントをさがす</a></li>
                    <li><a href="<?php echo home_url('/event/'); ?>">イベント一覧</a></li>
                    <li><a href="<?php echo home_url('/column/'); ?>">コラム一覧</a></li>
                    <li><a href="<?php echo home_url('/category/news/'); ?>">お知らせ一覧</a></li>
                    <li><a href="<?php echo home_url('/mypage/'); ?>">お気に入り</a></li>
                    <li><a href="<?php echo home_url('/faq/'); ?>">よくある質問</a></li>
                    <li><a href="<?php echo home_url('/organization/'); ?>">主催団体一覧</a></li>
                    <li><a href="<?php echo home_url('/about/'); ?>">当サイトについて</a></li>
                </ul>

                <?php
                // カスタムメニューを読み込む
                $args = [
                    'menu' => 'global-navigation',
                    'menu-class' => '',
                    'container' => false,
                ];
                wp_nav_menu($args);
                ?>

                <!-- 不要かな。
                    <div class="header_info">
                    <form class="header_search" action="<?php echo home_url(); ?>" method="get">

                        <input type="text" aria-label="Search" name="s" value="<?php the_search_query(); ?>">

                        <button type="submit"><i class="fas fa-search"></i></button>

                    </form>

                <div class="header_contact">
                    <div class="header_time">
                        <dl>
                            <dt>OPEN</dt>
                            <dd>09:00〜21:00</dd>
                        </dl>
                        <dl>
                            <dt>CLOSED</dt>
                            <dd>Tuesday</dd>
                        </dl>
                    </div>
                    <p>
                        <a href="<?php echo home_url('/contact/'); ?>"><i class="fa-solid fa-envelope"></i><span>ご予約・お問い合わせ</span></a>
                    </p>
                </div>-->
            </div>
        </div>
    </header>

    <!-- パンくずリスト -->
    <?php if (!is_home()) : ?>
    <?php get_template_part('template-parts/breadcrumb'); ?>
    <?php endif; ?>