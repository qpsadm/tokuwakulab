<!-- 検索フォームの呼び出し -->
<?php get_search_form() ?>


<!-- フリーワード検索の結果 -->
<?php



// $all_num = $wp_query->found_posts; //記事の総数を取得

// // グローバル変数を取得
// global $wp_query;

// // 1ページに表示する記事数
// $posts_per_page = get_query_var('posts_per_page');

// // 現在のページ番号（1から始まる）
// $current_page = max(1, get_query_var('paged'));

// // 表示中の記事の開始番号
// $start = ($current_page - 1) * $posts_per_page + 1;

// // 表示中の記事の終了番号
// $end = min($current_page * $posts_per_page, $the_query->found_posts);
?>

<section>
    <!-- ここから検索結果 -->
    <div class="search_result">

        <!-- フリーワード検索の結果 -->
        <?php if (!empty(get_search_query())): ?>
            <!-- <?php if ($all_num > 0) : ?>
                <div>
                    <h3>検索結果：<?php echo $all_num ?>件</h3>
                    <span><?php echo $start . ' - ' . $end  ?></span>
                    <span>件を表示</span>
                </div>
            <?php endif; ?> -->
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


        <?php else: ?>
            <!-- 絞り込み検索の結果 -->
            <!--条件検索のサブクエリ-->

            <?php
            // ページネーションの設定
            // $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
            // $args['paged'] = $paged;

            // サブクエリ
            $args = [
                'paged' => $paged,
                'post_type' => 'event',
                'post_status' => 'publish', // 公開された投稿のみを表示
                'tax_query' => ['relation' => 'AND'],
                'order' => 'DESC', // 昇順
                'orderby' => 'ID', // 投稿ID順
                'posts_per_page' => 6, //1ページの表示件数
            ];



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

            $the_query = new WP_Query($args);


            $all_num = $the_query->found_posts; //記事の総数を取得

            ?>

            <?php if ($the_query->have_posts()): ?>
                <!-- <?php if ($all_num > 0) : ?>
                    <div>
                        <h3>検索結果：<?php echo $all_num ?>件</h3>
                        <span><?php echo $start . ' - ' . $end  ?></span>
                        <span>件を表示</span>
                    </div>
                <?php endif; ?> -->
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
                    <?php wp_pagenavi(); ?>
                </div>
            <?php endif; ?>
        </div>

    </div>
</section>



</div>
</main>
<?php get_footer(); ?>
