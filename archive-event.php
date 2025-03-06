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
    <div class="breadcrumb">
        <span><a href="<?php if (!is_home()) : ?>">
                <?php get_template_part('template-parts/breadcrumb'); ?>
            <?php endif; ?></a>
        </span>
    </div>


    <div class="inner">

        <!-- 月別ボタンの実装 -->
        <div class="tax_list">
            <ul>
                <?php
                // 取得した日付をボタン（リンク）として表示
                foreach ($dates as $date) {
                    $formatted_date = date('Y.m', strtotime($date)); // 表示形式 YYYY.MM
                    echo '<li><a href="' . home_url('/event/') . '?date=' . $date . '">' . $formatted_date . '</a></li>';
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

                <?php echo $one_week_later; ?>イベント&nbsp;&nbsp;<?php echo $the_query->found_posts; ?>件
            </h3>

            <br>

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

        <!-- 過去一覧へボタン -->
        <div class="eventlist_more">
            過去イベント一覧へ
        </div>

</main>

<!-- footer.phpを読み込む -->
<?php get_footer(); ?>
