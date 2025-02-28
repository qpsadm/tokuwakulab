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
        <!-- <div class="kv_slider js-slider">
            <div class="kv_sliderItem" style="background-image: url('<?php echo get_template_directory_uri(); ?>/assets/img/AdobeStock_461039205.jpeg');"></div>
            <div class="kv_sliderItem" style="background-image: url('<?php echo get_template_directory_uri(); ?>/assets/img/AdobeStock_357399495.jpeg');"></div>
            <div class="kv_sliderItem" style="background-image: url('<?php echo get_template_directory_uri(); ?>/assets/img/AdobeStock_570522660.jpeg');"></div>
        </div> -->

        <!-- NEWS表示用、仮組み -->
        <div class="kv_news text_border">
            <p class="kv_news_text">
                <!--ここにPHPを設定-->
                <span>2025-03-17</span>
                <a class="news_link" href="https://tks-navi.com/2025-03-20/2038/">
                    ここにお知らせがある時にお知らせタイトルが入ります。</a>
            </p>
        </div>

    </section>

<?php endif; ?>

<!-- イベント新着セクション。横並びカード3件表示 -->

<section class="section section-concept" id="concept">
    <div class="section_inner">
        <div class="section_headerWrapper">
            <header class="section_header">
                <h2 class="heading heading-primary">イベント新着</h2>
            </header>
            <div class="section_pic">

                <?php
                $args = [
                    'post_type' => 'event',
                    'posts_per_page' => 3,
                ];
                $meta_query = ['relation' => 'AND'];
                $meta_query[] = [
                    'key' => 'date_start',
                    'type' => 'DATETIME',
                    'compare' => 'BETWEEN',
                    // ↓ここがこれから。
                    'value' => [$date1, $date2],
                ];


                $args['meta_query'] = $meta_query;

                $the_query = new WP_Query($args);

                ?>

                <ul class="foodList">

                    <!-- イベントループの開始 -->
                    <?php if ($the_query->have_posts()) : ?>
                        <?php while ($the_query->have_posts()) : ?>
                            <?php $the_query->the_post(); ?>

                            <li class="foodList_item">
                                <!-- テンプレートパーツloop-food.phpを読み込む -->
                                <?php get_template_part('template-parts/loop', 'event') ?>
                            </li>

                            <!-- WordPress ループの終了 -->
                        <?php endwhile; ?>

                        <?php wp_reset_postdata(); ?>
                    <?php endif; ?>
                </ul>

            </div>
        </div>
        <div class="section_body">
            <div class="section_btn">
                <a href="<?php echo get_permalink(31); ?>" class="btn btn-more">イベント一覧へ</a>
            </div>
        </div>
    </div>
</section>


<!-- コラム新着セクション。縦並びカード3件表示 -->
<section class="section section-concept" id="concept">
    <div class="section_inner">
        <div class="section_headerWrapper">
            <header class="section_header">
                <h2 class="heading heading-primary"><span>コンセプト</span>CONCEPT</h2>
            </header>
            <div class="section_pic">
                <div><img src="<?php echo get_template_directory_uri(); ?>/assets/img/home/concept_img01@2x.png" alt=""></div>
                <div><img src="<?php echo get_template_directory_uri(); ?>/assets/img/home/concept_img02@2x.png" alt=""></div>
                <div><img src="<?php echo get_template_directory_uri(); ?>/assets/img/home/concept_img03@2x.png" alt=""></div>
            </div>
        </div>
        <div class="section_body">
            <div class="section_btn">
                <a href="<?php echo get_permalink(31); ?>" class="btn btn-more">もっと見る</a>
            </div>
        </div>
    </div>
</section>

<!-- おすすめコラム記事。2件ランダム表示 -->
<section class="section section-concept" id="concept">
    <div class="section_inner">
        <div class="section_headerWrapper">
            <header class="section_header">
                <h2 class="heading heading-primary"><span>コンセプト</span>CONCEPT</h2>
            </header>
            <div class="section_pic">
                <div><img src="<?php echo get_template_directory_uri(); ?>/assets/img/home/concept_img01@2x.png" alt=""></div>
                <div><img src="<?php echo get_template_directory_uri(); ?>/assets/img/home/concept_img02@2x.png" alt=""></div>
                <div><img src="<?php echo get_template_directory_uri(); ?>/assets/img/home/concept_img03@2x.png" alt=""></div>
            </div>
        </div>
        <div class="section_body">
            <div class="section_btn">
                <a href="<?php echo get_permalink(31); ?>" class="btn btn-more">もっと見る</a>
            </div>
        </div>
    </div>
</section>

<!-- 主催団体の紹介セクション -->
<section class="section section-concept" id="concept">
    <div class="section_inner">
        <div class="section_headerWrapper">
            <header class="section_header">
                <h2 class="heading heading-primary"><span>コンセプト</span>CONCEPT</h2>
            </header>
            <div class="section_pic">
                <div><img src="<?php echo get_template_directory_uri(); ?>/assets/img/home/concept_img01@2x.png" alt=""></div>
                <div><img src="<?php echo get_template_directory_uri(); ?>/assets/img/home/concept_img02@2x.png" alt=""></div>
                <div><img src="<?php echo get_template_directory_uri(); ?>/assets/img/home/concept_img03@2x.png" alt=""></div>
            </div>
        </div>
        <div class="section_body">
            <div class="section_btn">
                <a href="<?php echo get_permalink(31); ?>" class="btn btn-more">もっと見る</a>
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
