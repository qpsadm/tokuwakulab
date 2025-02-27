<!-- header.phpを読み込む -->
<?php
get_header();
?>

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
                    <!-- これからのイベントを呼んでくる -->
                    <?php
                    $args = [
                        'post_type' => 'event',
                        'posts_per_page' => -1,
                    ];
                    $meta_query = ['relation' => 'AND'];
                    $meta_query[] = [
                        'key' => 'date_start',
                        'type' => 'DATETIME',
                        'compare' => '>=',
                        'value' => date('Y-m-d'),
                    ];


                    $args['meta_query'] = $meta_query;

                    $the_query = new WP_Query($args);
                    ?>

                    <a href="<?php echo home_url('/event/') . '?date=2025-03-01'; ?>">
                        <li>2025.03</li>
                    </a>
                    <a href="<?php echo home_url('/event/') . '?date=2025-04-01'; ?>">
                        <li>2025.04</li>
                    </a>
                    <a href="<?php echo home_url('/event/') . '?date=2025-05-01'; ?>">
                        <li>2025.05</li>
                    </a>
                    <a href="<?php echo home_url('/event/') . '?date=2025-06-01'; ?>">
                        <li>2025.06</li>
                    </a>
                </ul>
            </div>


            <?php
            // サブクエリ

            $args = [
                'post_type' => 'event',
                'posts_per_page' => -1,
            ];
            $meta_query = ['relation' => 'AND'];
            $meta_query[] = [
                'key' => 'date_start',
                'type' => 'DATETIME',
                'compare' => 'BETWEEN',
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
