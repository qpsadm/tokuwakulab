<!-- header.phpを読み込む -->
<?php
get_header();
?>
<main class="pc_space">
    <!-- トップページ専用のKV -->
    <?php if (is_home()) : ?>
        <div class="top_kv_wrap">
            <ul class="slider_kv">
                <li><img src="<?php echo get_template_directory_uri(); ?>/assets/img/AdobeStock_537320558.jpeg" alt="キービジュアル"></li>
                <li><img src="<?php echo get_template_directory_uri(); ?>/assets/img/AdobeStock_461039205.jpeg" alt="キービジュアル"></li>
                <li><img src="<?php echo get_template_directory_uri(); ?>/assets/img/AdobeStock_411271448.jpeg" alt="キービジュアル"></li>
            </ul>
        </div>

        <!-- 中間発表用にコメントアウト 3/7 -->

        <!-- <div><img src="<?php echo get_template_directory_uri(); ?>/assets/img/catchcopy.svg" alt="見て触って体験する科学！"></div> -->


        <!-- NEWS表示用、仮組み3/5非表示 -->
        <!-- <div class="kv_news text_border">
        <p class="kv_news_text">
                ここにPHPを設定
                <span>2025-03-17</span>
                <a class="news_link" href="https://tks-navi.com/2025-03-20/2038/">
                    ここにお知らせがある時にお知らせタイトルが入ります。</a>
            </p>
    </div> -->
    <?php endif; ?>


    <div class="inner">
        <!-- イベント新着セクション。横並びカード3件表示 -->
        <section>
            <div class="top_event_ttl">
                <h2>もうすぐ開催のイベント</h2>
            </div>
            <div>
                <!-- ここにPHP挿入 -->
                <?php
                $dates = get_upcoming_event_months();
                // URLのパラメータから検索する開催月を取得
                $date1 = get_param_value('date');
                // 初期状態で、開催月が指定されていないので、直近の月を代入する
                if (is_null($date1)) {
                    $date1 = $dates[0];
                }
                $date2 = '2025-03-31';
                // echo $date1, '-', $date2;
                ?>

                <?php
                // $date1 = isset($_GET['date']) ? $_GET['date'] : null;
                // $date2 = $date1 ? date('Y-m-t', strtotime($date1)) : null; // 月末日を取得

                // サブクエリ
                // $args = [
                //     'post_type' => 'event',
                //     'posts_per_page' => 3,
                //     'orderby'        => 'date', // 投稿日時でソート
                // ];
                // $meta_query = ['relation' => 'AND'];

                // if ($date1) {
                //     $meta_query[] = [
                //         'key' => 'date_start',
                //         'type' => 'DATE',
                //         'compare' => 'BETWEEN',
                //         'value' => [$date1, $date2],
                //     ];
                // }
                // $args['meta_query'] = $meta_query;


                // 今日の日付
                $today = date('Y-m-d');

                $args = [
                    'post_type' => 'event',
                    'post_status' => 'publish', // 公開された投稿のみを表示
                    'orderby' => 'meta_value', // 下の内容でソート
                    'meta_key' => 'date_start', //開催日をソート対象に
                    'order' => 'ASC', // 近い日付順
                    'posts_per_page' => 3, //1ページの表示件数

                    //開催日が過ぎていないものをソート
                    'meta_query' => [
                        [
                            'key' => 'date_start',
                            'value' => $today,
                            'compare' => '>=',
                            'type' => 'DATE'
                        ],
                    ]
                ];

                $the_query = new WP_Query($args);

                ?>

                <ul class="top_event_list">
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

                <!-- もっと見るボタン -->

                <a class="btn_wrap top_btn" href="<?php echo home_url("/event/"); ?>">イベント一覧へ</a>
            </div>

        </section>
        <!-- コラム新着セクション。縦並びカード3件表示 -->
        <section>
            <!-- 見出し -->
            <div class="top_column_ttl">
                <h2>おすすめコラム記事</h2>
            </div>
            <div>
                <ul class="top_column_list">
                    <?php
                    // 最新3件のコラムを取得
                    $latest_columns = new WP_Query(array(
                        'post_type'      => 'column', // カスタム投稿タイプが「column」なら変更不要
                        'posts_per_page' => 4,       // 最新3件を取得
                        'orderby'        => 'date',  // 日付順
                        'order'          => 'DESC'   // 新しい順
                    ));

                    if ($latest_columns->have_posts()) :
                        while ($latest_columns->have_posts()) : $latest_columns->the_post();
                    ?>
                            <li>
                                <?php get_template_part('template-parts/loop', 'column'); ?>
                            </li>
                    <?php
                        endwhile;
                        wp_reset_postdata(); // クエリのリセット
                    endif;
                    ?>
                </ul>
            </div>
            <a class="btn_wrap  top_btn" href="<?php echo home_url('/column/'); ?>">
                コラム一覧へ
            </a>

        </section>

        <!-- お知らせ新着。3件表示  -->
        <section>
            <!-- 見出し -->
            <div class="top_news_ttl">
                <h2>お知らせ新着</h2>
            </div>
            <div class="top_news_list">

                <!-- WordPress ループの開始 -->
                <?php if (have_posts()) : ?>
                    <?php while (have_posts()) : ?>
                        <?php the_post(); ?>

                        <div class="top_news_item_wrap">
                            <span><?php the_time('Y年m月d日(l)') ?></span>
                            <a href="<?php the_permalink(); ?>">
                                <span class="top_news_item">お知らせが入ります。</span>
                            </a>
                        </div>

                        <!-- WordPress ループの終了 -->
                    <?php endwhile; ?>
                <?php endif; ?>
            </div>

            <a class="btn_wrap  top_btn" href="<?php echo home_url('/category/news/'); ?>">
                お知らせ一覧へ
            </a>
        </section>

        <!-- 主催団体の紹介セクション -->
        <section>
            <!-- 見出し -->
            <div class="top_org_ttl">
                <h2>主催団体様</h2>
            </div>
            <div class="top_org_txt">
                <p>イベントを主催している団体様を紹介します！</p>
            </div>
            <ul class="top_org_list slider_org">
                <!-- 主催団体カード型 -->
                <?php
                // ランダムに2件のコラムを取得
                $organization = new WP_Query(array(
                    'post_type'      => 'organization', // カスタム投稿タイプが「column」
                    'posts_per_page' => -1,       // 全件表示
                    'orderby'        => 'desc',
                    'post_status' => 'publish'
                ));

                if ($organization->have_posts()) :
                    while ($organization->have_posts()) : $organization->the_post();
                ?>
                        <li>
                            <?php get_template_part('template-parts/loop', 'organization'); ?>
                        </li>
                <?php
                    endwhile;
                    wp_reset_postdata(); // クエリのリセット
                endif;
                ?>
            </ul>
            <a class="btn_wrap  top_btn" href="<?php echo home_url('/organization/'); ?>">
                主催団体一覧へ
            </a>
        </section>

        <!-- インスタグラムセクション -->
        <section>
            <div class="top_instagram_wrap">
                <div class="top_instagram_bg">
                    <div class="top_instagram_ttl">
                        <h2>instagram</h2>
                    </div>
                    <div>
                        <?php echo do_shortcode('[instagram-feed=1]'); ?>
                    </div>
                </div>
            </div>
        </section>
    </div>
</main>

<!-- footer.phpを読み込む -->
<?php
get_footer();
?>
