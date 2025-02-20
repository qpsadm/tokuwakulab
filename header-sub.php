<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/css/app.css" type="text/css" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" type="text/css" />
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@400;700&display=swap" rel="stylesheet">
    <script type="text/JavaScript" src="https://code.jquery.com/jquery-3.6.3.min.js"></script>
    <script type="text/JavaScript" src="<?php echo get_template_directory_uri(); ?>/assets/js/main.js"></script>
    <title><?php bloginfo('name'); ?></title>
</head>

<body <?php body_class(); ?>>
    <header class="header">
        <div class="header_logo">
            <h1 class="logo"><a href="<?php echo home_url(); ?>"><?php bloginfo('name'); ?><span><?php bloginfo('description'); ?></span></a></h1>
        </div>

        <div class="header_nav">
            <div class="header_menu js-menu-icon"><span></span></div>
            <div class="gnav js-menu">
                <ul>
                    <li><a href="<?php echo home_url('concept'); ?>">コンセプト</a></li>
                    <li><a href="food.html">メニュー</a></li>
                    <li><a href="access.html">アクセス</a></li>
                    <li><a href="category.html">最新情報</a></li>
                </ul>

                <div class="header_info">
                    <form class="header_search">
                        <input type="text" aria-label="Search">
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
                            <a href="#"><i class="fa-solid fa-envelope"></i><span>ご予約・お問い合わせ</span></a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </header>
