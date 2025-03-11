<!-- header.phpを読み込む -->
<?php
get_header();
?>


<?php
// サブクエリ
$args = [
    // 1ページに表示する記事数
    'paged' => $paged,
    'post_type' => 'column',
    'posts_per_page' => 6,
];

// サブクエリ取得
$the_query = new WP_Query($args);
?>



<main class="pc_space">
    <section class="column_list_top">
        <h2 class="page_title">コラム一覧</h2>
    </section>

    <!-- パンくずリスト -->
    <?php get_template_part('template-parts/breadcrumb'); ?>


    <div class="inner">

        <!-- タクソノミーボタンの実装 -->
        <ul class="column_menu">

            <?php
            // 現在表示されているタームの情報を取得
            $current_term = get_queried_object();
            $current_term_id = $current_term->term_id ?? ''; // 現在のタームIDを取得（なければ空に）

            // 'All' ボタン（タームが選択されていないときにアクティブ）
            echo '<li class="column_btn ' . (empty($current_term_id) ? 'active' : '') . '"><a href="' . home_url('/column') . '">All</a></li>';

            // 主催団体のタクソノミーを取得
            $terms = get_terms([
                'taxonomy' => 'column_type',
                'hide_empty' => false,
            ]);

            foreach ($terms as $term) {
                // 現在のタームと一致する場合は 'active' クラスを付与
                $is_active = ($term->term_id == $current_term_id) ? 'active' : '';
                echo '<li class="column_btn ' . $is_active . '"><a href="' . esc_url(get_term_link($term)) . '">' . esc_html($term->name) . '</a></li>';
            }
            ?>
        </ul>




        <!-- ここから検索結果 -->
        <div class="columnlist_wrap">


            <div class="column_result">
                <h3 class="heading heading-secondary">

                    <div>
                        <span>
                            <?php
                            // グローバル変数を取得
                            global $wp_query;

                            // 現在表示されているタームの情報を取得
                            $current_term = get_queried_object();
                            $total_posts = $wp_query->found_posts;  // 現在のクエリで取得した記事数

                            // 1ページに表示する記事数
                            $posts_per_page = get_query_var('posts_per_page');

                            // 現在のページ番号（1から始まる）
                            $current_page = max(1, get_query_var('paged'));

                            // 表示中の記事の開始番号
                            $start = ($current_page - 1) * $posts_per_page + 1;

                            // 表示中の記事の終了番号（最大値をタクソノミーで取得した件数に）
                            $end = min($current_page * $posts_per_page, $total_posts);

                            // 「何件から何件を表示しているか」を表示
                            echo '<div class="post-range">';
                            echo $start . ' - ' . $end . ' 件を表示';
                            echo '</div>';
                            ?>
                        </span>
                    </div>
                </h3>
            </div>



            <!-- コラム検索結果カード -->
            <ul class="column_list">

                <!-- コラムループの開始 -->
                <?php if (have_posts()) : ?>
                    <?php while (have_posts()) : ?>
                        <?php the_post(); ?>

                        <li>
                            <!-- テンプレートパーツloop-food.phpを読み込む -->
                            <?php get_template_part('template-parts/loop', 'column') ?>
                        </li>

                        <!-- WordPress ループの終了 -->
                    <?php endwhile; ?>
                    <!-- リセット -->
                    <?php wp_reset_postdata(); ?>
                <?php endif; ?>
            </ul>


            <!-- ページネーション -->

            <?php if (function_exists('wp_pagenavi')): ?>
                <div class="pagenation">
                    <?php wp_pagenavi(); ?>
                </div>
            <?php endif; ?>



        </div>
    </div>
</main>

<!-- footer.phpを読み込む -->
<?php
get_footer();
?>
