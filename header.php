<?php
// 開発モードで公開の時は、管理画面へのログインが必要です。
if (!is_user_logged_in() && IS_DEV == true) {
    header('Location:' . home_url('/') . 'wp-admin');
    exit;
}
?>

<?php
$description = "徳島県内の科学技術イベント情報を一括検索！お気に入り登録や公式サイトへのアクセスも簡単。";


$keywords = '徳島,科学,イベント,体験,プログラミング,親子,ロボット,教育,学び,実験,理科,科学館,サイエンス,ものづくり,環境,化学,小学生,中学生,高校生,うずぽん,ウズポン,うずポン'
?>


<!DOCTYPE html>

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
                <li class="menu_item"><a class="header_eventlist" href="<?php echo home_url('/event/'); ?>" title="イベント一覧">イベント月別一覧</a></li>
                <li class="menu_item"><a class="header_eventfound" href="<?php echo home_url('/?s='); ?>" title="条件検索">イベントをさがす</a></li>
                <li class="menu_item"><a class="header_postlist" href="<?php echo home_url('/category/news/'); ?>" title="お知らせ">お知らせ</a></li>
                <li class="menu_item"><a class="header_orglist" href="<?php echo home_url('/organization/'); ?>" title="主催団体一覧">主催団体一覧</a></li>
                <li class="menu_item"><a class="header_column" href="<?php echo home_url('/column/'); ?>" title="コラム">コラム</a></li>
                <li class="menu_item"><a class="header_favoritelist" href="<?php echo home_url('/mypage/'); ?>" title="お気に入り">お気に入り</a></li>
                <li class="menu_item"><a class="header_contact" href="<?php echo home_url('/contact/'); ?>" title="お問い合わせ">主催団体様<br>
                        お問い合わせ</a></li>
            </ul>
        </nav>
        <nav class="sp_none">
            <ul>
                <li><a class="header_eventlist" href="<?php echo home_url('/event/'); ?>" title="イベント一覧">イベント月別一覧</a></li>
                <li><a class="header_eventfound" href="<?php echo home_url('/?s='); ?>" title="条件検索">イベントをさがす</a></li>
                <li><a class="header_postlist" href="<?php echo home_url('/category/news/'); ?>" title="お知らせ">お知らせ</a></li>
                <li><a class="header_orglist" href="<?php echo home_url('/organization/'); ?>" title="主催団体一覧">主催団体一覧</a></li>
                <li><a class="header_column" href="<?php echo home_url('/column/'); ?>" title="コラム">コラム</a></li>
                <li><a class="header_favoritelist" href="<?php echo home_url('/mypage/'); ?>" title="お気に入り">お気に入り</a></li>
                <li><a class="header_contact" href="<?php echo home_url('/contact/'); ?>" title="お問い合わせ">主催団体様<br>
                        お問い合わせ</a></li>
            </ul>
        </nav>



    </header>
