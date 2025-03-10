<!-- header.phpを読み込む -->
<?php get_header(); ?>

<?php
// 開催開始日（date_start）から年月を取得する
$dates = get_upcoming_event_months();
// print_r($dates);

// URLのパラメータから検索する開催月を取得
$date1 = get_param_value('date');

// 初期状態で、開催月が指定されていないので、直近の月を代入する
if (is_null($date1)) {
    $date1 = $dates[0];
}

// 月末日を取得
$date2 = get_last_day_of_month($date1);

// サブクエリ
$args = [
    // 1ページに表示する記事数
    'paged' => $paged,
    'post_type' => 'event',
    'posts_per_page' => 6,

];

$meta_query = ['relation' => 'AND'];

// 日付フィルターを適用
if ($date1) {
    $meta_query[] = [
        'key' => 'date_start',
        'type' => 'DATE',
        'compare' => 'BETWEEN',
        'value' => [$date1, $date2],
    ];

    // 今日の日付
    $today = date('Y-m-d');

    //終了していないものを取得
    $meta_query[] = [
        'key' => 'date_end',
        'value' => $today,
        'compare' => '>',
        'type' => 'DATE'
    ];

    $args['meta_query'] = $meta_query;
}

// サブクエリ取得
$the_query = new WP_Query($args);
?>



<main class="pc_space">
    <!-- ページタイトル -->
    <section class="page_top">
        <h2 class="page_title">月別イベント一覧</h2>
    </section>

    <!-- パンくずリスト -->
    <?php get_template_part('template-parts/breadcrumb'); ?>


    <div class="inner">


        <!-- 開催月別のボタン -->
        <div class="tax_list">
            <ul>
                <?php
                // 現在のURLから 'date' パラメータを取得
                $current_date = isset($_GET['date']) ? $_GET['date'] : '';

                // デフォルトで最新の月を選択
                if (empty($current_date) && !empty($dates)) {
                    $current_date = $dates[0];  // 最新の日付をセット (配列の最初の要素)
                }

                // 取得した日付をボタン（リンク）として表示
                foreach ($dates as $date) {
                    $formatted_date = date('Y.m', strtotime($date)); // 表示形式 YYYY.MM

                    // 月初と月末の日付を取得
                    $month_start = date('Y-m-01', strtotime($date));
                    $month_end = date('Y-m-t', strtotime($date));

                    // 特定の月の記事数をカウント
                    $post_count = new WP_Query([
                        'post_type' => 'event',
                        'posts_per_page' => -1,
                        'meta_query' => [
                            'relation'=>'AND',
                            [
                                'key' => 'date_start',
                                'type' => 'DATE',
                                'compare' => 'BETWEEN',
                                'value' => [$month_start, $month_end],
                            ],

                            //終了していないものを取得
                            [
                                'key' => 'date_end',
                                'value' => $today,
                                'compare' => '>',
                                'type' => 'DATE'
                            ],
                        ],
                    ]);

                    // 'date' パラメータと一致する場合は 'active' クラスを付与
                    $active_class = ($current_date === $date) ? 'active' : '';

                    // 記事数をリンクに追加して表示
                    echo '<li><a href="' . home_url('/event/') . '?date=' . $date . '" class="' . $active_class . '">' . $formatted_date . '&nbsp;(' . $post_count->found_posts . ')</a></li>';

                    wp_reset_postdata();  // クエリをリセット
                }
                ?>
            </ul>
        </div>


        <!-- ここから検索結果 -->
        <div class="exp_result">

            <?php
            $one_week_later = date('Y年n月', strtotime($date1));
            ?>
            <h3>

                <?php echo $one_week_later; ?>のイベント&nbsp;<?php echo $the_query->found_posts; ?>件
            </h3>


            <span>
                <?php
                // グローバル変数を取得
                global $wp_query;

                // 1ページに表示する記事数
                $posts_per_page = get_query_var('posts_per_page');

                // 現在のページ番号（1から始まる）
                $current_page = max(1, get_query_var('paged'));

                // 表示中の記事の開始番号
                $start = ($current_page - 1) * $posts_per_page + 1;

                // 表示中の記事の終了番号
                $end = min($current_page * $posts_per_page, $the_query->found_posts);

                // 「何件から何件を表示しているか」を表示
                echo '<div class="post-range">';
                echo $start . ' - ' . $end . ' 件を表示';
                echo '</div>';
                ?>
            </span>

        </div>


        <ul class="top_event_list">

            <!-- イベントループの開始 -->
            <?php if ($the_query->have_posts()) : ?>
                <?php while ($the_query->have_posts()) : ?>
                    <?php $the_query->the_post(); ?>

                    <li>
                        <!-- テンプレートパーツloop-food.phpを読み込む -->
                        <?php get_template_part('template-parts/loop', 'event') ?>
                    </li>

                    <!-- WordPress ループの終了 -->
                <?php endwhile; ?>

                <?php wp_reset_postdata(); ?>
            <?php endif; ?>
        </ul>



        <!-- ページナビゲーション -->
        <div class="pagenation">
            <?php if (function_exists('wp_pagenavi')): ?>
                <div class="pagination">
                    <?php wp_pagenavi(); ?>
                </div>
            <?php endif; ?>
        </div>


        <!-- 未制作のためコメントアウト3/7 -->
        <!-- 過去一覧へボタン -->
        <!-- <div class="eventlist_more">
            <a class="eventlist_btn_wrap" href="<?php echo home_url("pastevent"); ?>">過去イベント一覧へ</a>
        </div> -->

</main>

<!-- footer.phpを読み込む -->
<?php get_footer(); ?>
