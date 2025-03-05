<!-- ヘッダーの読み込み -->
<?php get_header(); ?>


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
    <!-- ページタイトル -->
    <section class="page_top">
        <h2 class="page_title">コラム一覧</h2>
    </section>

    <!-- パンくずリスト -->
    <div class="breadcrumb">
        <span><a href="<?php if (!is_home()) : ?>">
                <?php get_template_part('template-parts/breadcrumb'); ?>
            <?php endif; ?></a>
        </span>
    </div>


    <div class="inner">

        <!-- タクソノミーボタンの実装 -->
        <ul class="column_menu">

            <?php
            $all_link = home_url('/column');

            // $is_all_active = (is_post_type_archive('column')) ? 'active' : '';

            echo '<a href="' . $all_link . '"><li class="column_btn active">All</li></a>';

            $terms = get_terms(array(
                'taxonomy' => 'column_type',
                'hide_empty' => false,
            ));
            if (!empty($terms) && !is_wp_error($terms)) {
                foreach ($terms as $term) {
                    echo '<a href="' . esc_url(get_term_link($term)) . '"><li class="column_btn">' . esc_html($term->name) . '</li></a>';
                }
            }
            ?>
        </ul>



        <!-- ここから検索結果 -->
        <div class="columnlist_wrap">


            <div class="column_result">
                <div>
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
                        ////echo '<div class="post-range">';
                        echo $start . ' - ' . $end . ' 件を表示';
                        //echo '</div>';
                        ?>
                    </span>
                </div>
            </div>

            <!-- コラム検索結果カード -->
            <ul class="column_list">

                <!-- コラムループ -->
                <?php if (have_posts()): ?>
                    <?php while (have_posts()): ?>
                        <?php the_post(); ?>

                        <li>

                            <!-- columnのカード型を読み込む -->
                            <?php get_template_part('template-parts/loop', 'column') ?>

                        </li>

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

<!-- フッターを読み込む -->
<?php get_footer();
?>
