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
    <section class="page_top">
        <h2 class="page_title">コラム一覧</h2>
    </section>

    <!-- パンくずリスト -->
    <?php get_template_part('template-parts/breadcrumb'); ?>


    <div class="inner">

        <!-- タクソノミーボタンの実装 -->

        <ul class="column_menu">

            <?php
            $all_link = home_url('/column');
            $current_term = get_queried_object(); // 現在のタクソノミー情報を取得
            $is_all_active = (is_post_type_archive('column') || is_home()) ? 'active' : ''; // 「All」のときに active を付与

            echo '<li class="column_btn ' . $is_all_active . '"><a href="' . $all_link . '">All</a></li>';

            $terms = get_terms(array(
                'taxonomy' => 'column_type',
                'hide_empty' => false,
            ));
            if (!empty($terms) && !is_wp_error($terms)) {
                foreach ($terms as $term) {
                    $active_class = ($current_term->term_id == $term->term_id) ? 'active' : ''; // 現在のページと一致する場合に active クラスを付与
                    echo '<li class="column_btn ' . $active_class . '"><a href="' . esc_url(get_term_link($term)) . '">' . esc_html($term->name) . '</a></li>';
                }
            }
            ?>
        </ul>




        <!-- ここから検索結果 -->
        <div class="columnlist_wrap">


            <div class="column_result">
                <?php
                // タクソノミー名でクエリ変数を取得
                $column_type_slug = get_query_var('column_type');
                // 取得したクエリ変数から、タクソノミータームの情報を取得
                $column_type = get_term_by('slug', $column_type_slug, 'column_type');
                ?>

                <h3 class="heading heading-secondary"><?php single_term_title(''); ?></h3>


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
