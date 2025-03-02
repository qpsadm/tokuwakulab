<!-- header.phpを読み込む -->
<?php
get_header();
?>


<?php

// 開催開始日（date_start）から年月を取得する
$dates = get_upcoming_event_months();

// フィルタリング
// $date1 = isset($_GET['date']) ? $_GET['date'] : null;

// URLのパラメータから検索する開催月を取得
$date1 = get_param_value('date');

// 初期状態で、開催月が指定されていないので、直近の月を代入する
if (is_null($date1)) {
    $date1 = $dates[0];
}

// 月末日を取得
// $date2 = $date1 ? date('Y-m-t', strtotime($date1)) : null;
$date2 = get_last_day_of_month($date1);

// サブクエリ
$args = [
    'post_type' => 'event',
    'posts_per_page' => -1,
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

<p>ここにKVとタイトルが入る</p>





<main>
    <section class="section section-foodList">
        <div class="section_inner">


            <div class="archive_yealy">
                <ul class="archive_list">
                    <?php
                    // 開催開始日（date_start）から年月を取得し、重複を削除
                    //             global $wpdb;
                    //             $dates = $wpdb->get_col("
                    //     SELECT DISTINCT DATE_FORMAT(meta_value, '%Y-%m-01')
                    //     FROM $wpdb->postmeta
                    //     WHERE meta_key = 'date_start'
                    //     ORDER BY meta_value ASC
                    // ");

                    // 取得した日付をボタン（リンク）として表示
                    foreach ($dates as $date) {
                        $formatted_date = date('Y.m', strtotime($date)); // 表示形式 YYYY.MM
                        echo '<li><a href="' . home_url('/event/') . '?date=' . $date . '">' . $formatted_date . '</a></li>';
                    }
                    ?>
                </ul>
            </div>


            <br>


            <div class="section_header">
                <!-- <h2 class="heading heading-primary"><span>イベント</span>月別イベント一覧 (<?php echo $the_query->found_posts; ?>)</h2> -->
                <?php
                $one_week_later = date('Y年n月', strtotime($date1));
                ?>
                <h2 class="heading heading-primary">

                    <?php echo $one_week_later; ?>イベント一覧 (<?php echo $the_query->found_posts; ?>)
                </h2>

                <br>


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
                $end = min($current_page * $posts_per_page, $wp_query->found_posts);

                // 「何件から何件を表示しているか」を表示
                echo '<div class="post-range">';
                echo $start . ' - ' . $end . ' 件を表示';
                echo '</div>';
                ?>


            </div>





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
    </section>


    <!-- ページナビゲーション -->
    <?php if (function_exists('wp_pagenavi')): ?>
        <div class="pagination">
            <?php wp_pagenavi(); ?>
        </div>
    <?php endif; ?>

    </div>
    </section>


</main>

<!-- footer.phpを読み込む -->
<?php
get_footer();
?>
