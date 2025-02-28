<!-- header.phpを読み込む -->
<?php
get_header();
?>

<!-- この条件に当てはまらない場合全てを選択する -->
<?php
$date1 = isset($_GET['date']) ? $_GET['date'] : 'ALL';
$date2 = '2025-03-31';
echo $date1, '-', $date2;

?>

<p>ここにKVとタイトルが入る</p>

<main>
    <section class="section section-foodList">
        <div class="section_inner">
            <div class="section_header">
                <h2 class="heading heading-primary"><span>イベント</span>月別イベント一覧</h2>
            </div>


            <div class="archive_yealy">
                <ul class="archive_list">
                    <?php
                    // 開催開始日（date_start）から年月を取得し、重複を削除
                    global $wpdb;
                    $dates = $wpdb->get_col("
            SELECT DISTINCT DATE_FORMAT(meta_value, '%Y-%m-01')
            FROM $wpdb->postmeta
            WHERE meta_key = 'date_start'
            ORDER BY meta_value ASC
        ");

                    // 取得した日付をボタン（リンク）として表示
                    foreach ($dates as $date) {
                        $formatted_date = date('Y.m', strtotime($date)); // 表示形式 YYYY.MM
                        echo '<li><a href="' . home_url('/event/') . '?date=' . $date . '">' . $formatted_date . '</a></li>';
                    }
                    ?>
                </ul>
            </div>

            <?php
            // フィルタリング
            $date1 = isset($_GET['date']) ? $_GET['date'] : null;
            $date2 = $date1 ? date('Y-m-t', strtotime($date1)) : null; // 月末日を取得

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
            }

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
