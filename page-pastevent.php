<!-- header.phpを読み込む -->
<?php
get_header();
?>


<!-- 終了したイベントのアーカイブページ -->

<?php

// 開催開始日（date_start）から年月を取得する
$dates = get_upcoming_event_months();

// URLのパラメータから検索する開催月を取得
$date1 = get_param_value('date');

// 初期状態で、開催月が指定されていないので、直近の月を代入する
if (is_null($date1)) {
    $date1 = $dates[0];
}

// 月末日を取得
$date2 = get_last_day_of_month($date1);

// 今日の日付を取得
$today = date('Y-m-d');

// サブクエリ
$args = [
    'paged' => $paged,
    'post_type' => 'event',
    'posts_per_page' => 6,
];

$meta_query = [
    'relation' => 'AND',
    // 終了日が今日以前のものだけを取得
    [
        'key' => 'date_end',
        'value' => $today,
        'type' => 'DATE',
        'compare' => '<=',
    ],
];

// 日付フィルターを適用
if ($date1) {
    $meta_query[] = [
        'key' => 'date_start',
        'type' => 'DATE',
        'compare' => 'BETWEEN',
        'value' => [$date1, $date2],
    ];
}

$args['meta_query'] = $meta_query;

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
                    foreach ($dates as $date) {
                        $formatted_date = date('Y.m', strtotime($date));
                        echo '<li><a href="' . home_url('/event/') . '?date=' . $date . '">' . $formatted_date . '</a></li>';
                    }
                    ?>
                </ul>
            </div>

            <br>

            <div class="section_header">
                <?php
                $one_week_later = date('Y年n月', strtotime($date1));
                ?>
                <h2 class="heading heading-primary">
                    <?php echo $one_week_later; ?>終了したイベント一覧 (<?php echo $the_query->found_posts; ?>)
                </h2>

                <br>

                <?php
                global $wp_query;
                $posts_per_page = get_query_var('posts_per_page');
                $current_page = max(1, get_query_var('paged'));
                $start = ($current_page - 1) * $posts_per_page + 1;
                $end = min($current_page * $posts_per_page, $the_query->found_posts);

                echo '<div class="post-range">';
                echo $start . ' - ' . $end . ' 件を表示';
                echo '</div>';
                ?>
            </div>

            <ul>
                <?php if ($the_query->have_posts()) : ?>
                    <?php while ($the_query->have_posts()) : ?>
                        <?php $the_query->the_post(); ?>
                        <li>
                            <?php get_template_part('template-parts/loop', 'event') ?>
                        </li>
                    <?php endwhile; ?>
                    <?php wp_reset_postdata(); ?>
                <?php else : ?>
                    <li>現在、表示できる終了したイベントはありません。</li>
                <?php endif; ?>
            </ul>
    </section>

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
//get_footer();
?>
