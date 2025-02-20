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
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, user-scalable=no">

    <!-- デliスクリプション変数を出力する -->
    <meta name="description" content="<?php echo $description; ?>">

    <?php
    wp_head();
    ?>
</head>

<body <?php body_class(); ?>>

    <?php
    wp_body_open();
    ?>

    <header class="header">
        <div class="header_logo">
            <h1 class="logo"><a href="<?php echo home_url(); ?>"><?php bloginfo('name'); ?><span><?php bloginfo('description'); ?></span></a></h1>
        </div>

        <div class="header_nav">
            <div class="header_menu js-menu-icon"><span></span></div>
            <div class="gnav js-menu">
                <!-- <ul class="">
                    <li><a href="<?php echo home_url('/concept/'); ?>">コンセプト</a></li>
                    <li><a href="food.html">メニュー</a></li>
                    <li><a href="<?php echo home_url('/access/'); ?>">アクセス</a></li>
                    <li><a href="<?php echo home_url('/category/news/'); ?>">最新情報</a></li>
                </ul> -->

                <?php
                // カスタムメニューを読み込む
                $args = [
                    'menu' => 'global-navigation',
                    'menu-class' => '',
                    'container' => false,
                ];
                wp_nav_menu($args);
                ?>

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
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- パンくずリスト -->
    <?php if (!is_home()) : ?>
        <?php get_template_part('template-parts/breadcrumb'); ?>
    <?php endif; ?>
