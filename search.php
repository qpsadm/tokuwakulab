<!-- 検索フォームの呼び出し -->
<?php get_search_form() ?>

<section>
    <!-- ここから検索結果 -->
    <div class="search_result">

        <?php
        // メインクエリの結果を取得
        $all_num = get_query_var('all_num', 0);
        $start = get_query_var('start', 0);
        $end = get_query_var('end', 0);
        ?>

        <!-- フリーワード検索の結果 -->
        <?php if (!empty(get_search_query())): ?>
            <?php if ($all_num > 0) : ?>
                <div>
                    <h3>検索結果：<?php echo $all_num ?>件</h3>
                    <span><?php echo $start . ' - ' . $end  ?></span>
                    <span>件を表示</span>
                </div>
            <?php endif; ?>
            <?php if (have_posts()) : ?>
                <ul class="top_event_list">
                    <?php while (have_posts()) : the_post(); ?>
                        <li>
                            <?php get_template_part('template-parts/loop', 'event'); ?>
                        </li>
                    <?php endwhile; ?>
                </ul>
            <?php else: ?>
                <p>検索結果はありませんでした。</p>
            <?php endif; ?>
            <?php wp_reset_postdata(); ?>


        <?php else: ?>
            <!-- 絞り込み検索の結果 -->
            <!--条件検索のサブクエリ-->

            <?php
            // ページネーションの設定
            $paged = get_query_var('paged') ? get_query_var('paged') : 1;
            $posts_per_page = 6; // 1ページあたりの表示件数

            // 今日の日付
            $today = date('Y-m-d');

            // サブクエリ
            $args = [
                'paged' => $paged,
                'post_type' => 'event',
                'post_status' => 'publish', // 公開された投稿のみを表示
                'orderby' => 'meta_value', // 下のフィールドでソート
                'meta_key' => 'date_end', //フィールドを終了日に設定
                'order' => 'ASC', // 近い日付順
                'posts_per_page' => $posts_per_page, //1ページの表示件数
                'meta_query' => [
                    //終了していないものを取得
                    [
                        'key' => 'date_end',
                        'value' => $today,
                        'compare' => '>',
                        'type' => 'DATE'
                    ],
                ]
            ];

            // 絞り込み用のタクソノミーリスト
            $taxonomies = [
                'area',
                'age',
                'event_type',
                'experience',
                'time',
                'vacation',
                'other',
            ];

            foreach ($taxonomies as $taxonomy) {
                if (!empty($_GET[$taxonomy])) {
                    $args['tax_query'][] = [
                        'taxonomy' => $taxonomy,
                        'field'    => 'slug',
                        'terms'    => $_GET[$taxonomy],
                    ];
                }
            }
            // クエリを実行
            $the_query = new WP_Query($args);

            // 記事の総数を取得
            $all_num = $the_query->found_posts;

            // 現在のページで表示している投稿範囲を計算
            $start = ($paged - 1) * $posts_per_page + 1;
            $end = min($paged * $posts_per_page, $all_num);
            ?>

            <?php if ($the_query->have_posts()): ?>
                <?php if ($all_num > 0) : ?>
                    <div>
                        <h3>検索結果：<?php echo $all_num ?>件</h3>
                        <span><?php echo $start . ' - ' . $end  ?></span>
                        <span>件を表示</span>
                    </div>
                <?php endif; ?>
                <ul class="top_event_list">
                    <?php while ($the_query->have_posts()) : ?>
                        <?php $the_query->the_post(); ?>
                        <li>
                            <?php get_template_part('template-parts/loop', 'event'); ?>
                        </li>
                    <?php endwhile; ?>
                </ul>
            <?php else : ?>
                <p>検索結果はありませんでした。</p>
            <?php endif; ?>
            <?php wp_reset_postdata(); ?>

        <?php endif; ?>

        <!-- ページナビゲーション -->
        <div class="pagenation">
            <?php if (function_exists('wp_pagenavi')): ?>
                <div class="pagination">
                    <?php wp_pagenavi(['query' => $the_query]); ?>
                </div>
            <?php endif; ?>
        </div>

    </div>
</section>



</div>
</main>
<?php get_footer(); ?>
