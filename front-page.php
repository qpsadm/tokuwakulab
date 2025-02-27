<!-- header.phpを読み込む -->
<?php
get_header();
?>

<!-- トップページ専用のKV -->
<?php if (is_home()) : ?>

    <section class="kv">
        <div class="kv_inner">
            <!-- ベタ打ち -->
            <h1 class="kv_title header">徳島わくわくラボ</h1>
        </div>

        <!-- slickの画像はあるものに差し替え -->
        <div class="kv_slider js-slider">
            <div class="kv_sliderItem" style="background-image: url('<?php echo get_template_directory_uri(); ?>/assets/img/AdobeStock_461039205.jpeg');"></div>
            <div class="kv_sliderItem" style="background-image: url('<?php echo get_template_directory_uri(); ?>/assets/img/AdobeStock_357399495.jpeg');"></div>
            <div class="kv_sliderItem" style="background-image: url('<?php echo get_template_directory_uri(); ?>/assets/img/AdobeStock_570522660.jpeg');"></div>
        </div>

        <!-- NEWS表示用、仮組み -->
        <div class="kv_news text_border">
            <p class="kv_news_text">
                <!--ここにPHPを設定-->
                <span>2025-03-17</span>
                <a class="news_link" href="https://tks-navi.com/2025-03-20/2038/">
                    ここにお知らせがある時にお知らせタイトルが入ります</a>
            </p>
        </div>

    </section>

<?php endif; ?>

<!-- イベント新着セクション。横並びカード3件表示 -->
<section class="section section-concept" id="concept">
    <div class="section_inner">
        <div class="section header">
            <h2 class="heading heading-primary">イベント新着</h2>
            <div class="section_pic">
                <div><img src="<?php echo get_template_directory_uri(); ?>/assets/img/AdobeStock_570522660.jpeg" alt=""></div>
                <div><img src="<?php echo get_template_directory_uri(); ?>/assets/img/AdobeStock_570522660.jpeg" alt=""></div>
                <div><img src="<?php echo get_template_directory_uri(); ?>/assets/img/AdobeStock_570522660.jpeg" alt=""></div>
            </div>
        </div>
        <div class="section_btn">
            <a href="<?php echo get_permalink(31); ?>" class="btn btn-more">イベント一覧へ</a>
        </div>
    </div>
</section>

<!-- コラム新着セクション。縦並びカード3件表示 -->
<section class="section">
    <div class="section_inner">
        <div class="section header">
            <h2 class="heading heading-primary">コラム新着</h2>
            <div class="section_headerBtn">
                <!-- ↓PHPは未修整。2/27石田 -->
                <?php
                $news = get_term_by('slug', 'news', 'category');
                $news_link = get_term_link($news, 'category');
                ?>
                <a href="<?php echo $news_link; ?>" class="btn btn-more">コラム記事一覧へ</a>
            </div>
        </div>
</section>

<!-- おすすめコラム記事。2件ランダム表示 -->
<section class="section">
    <div class="section_body">
        <div class="section header">
            <h2 class="heading heading-primary">おすすめコラム記事</h2>
            <div class="cardList cardList-1row">

                <!-- ↓PHPは未修整。2/27石田 -->

                <!-- WordPress ループの開始 -->
                <?php if (have_posts()) : ?>
                    <?php while (have_posts()) : ?>
                        <?php the_post(); ?>

                        <!-- テンプレートパーツを読み込む -->
                        <?php get_template_part('template-parts/loop', 'news') ?>

                        <!-- WordPress ループの終了 -->
                    <?php endwhile; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<!-- 主催団体の紹介セクション -->
<section class="section section-info">
    <div class="section_inner">
        <div class="section header">
            <div class="section_content">
                <h2 class="heading heading-primary">主催団体様</h2>

                <!-- ↓PHPは未修整。2/27石田 -->

                <div class="section_btn">
                    <a href="<?php echo get_permalink(31); ?>" class="btn btn-more">主催団体一覧へ</a>
                </div>
            </div>
        </div>
</section>

<!-- インスタグラムセクション -->
<section class="section">
    <!-- 後日調べます -->
</section>

<!-- footer.phpを読み込む -->
<?php
get_footer();
?>
