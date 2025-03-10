<!-- header.phpを読み込む -->
<?php
get_header();
?>

<?php

// サブクエリ
$args = [
    // 1ページに表示する記事数
    'paged' => $paged,
    'post_type' => 'organization',
    'posts_per_page' => 6,
];

$meta_query = ['relation' => 'AND'];

// サブクエリ取得
$the_query = new WP_Query($args);
?>

<main class="pc_space">

    <section class="page_top">
        <h2 class="page_title">
            主催団体一覧
        </h2>
    </section>

    <!-- パンくずリスト -->
    <?php get_template_part('template-parts/breadcrumb'); ?>


    <div class="inner">


        <!-- 主催団体別で絞り込み -->
        <!-- 主催団体のタクソノミーのボタン -->

        <div class="tax_list">
            <ul>

                <?php
                // 現在表示されているタームの情報を取得
                $current_term = get_queried_object();
                $current_term_id = isset($current_term->term_id) ? $current_term->term_id : '';
                $current_taxonomy = isset($current_term->taxonomy) ? $current_term->taxonomy : '';

                // 'All' ボタンのリンクとクラス付与
                $all_link = home_url('/organization');
                $active_class = ($current_taxonomy !== 'org_tax') ? 'active' : ''; // org_tax以外ならAllをアクティブに

                echo '<li><a href="' . $all_link . '" class="' . $active_class . '">All</a></li>';

                // 主催団体のタクソノミーを取得
                $terms = get_terms(array(
                    'taxonomy' => 'org_tax',
                    'hide_empty' => false,
                ));

                if (!empty($terms) && !is_wp_error($terms)) {
                    foreach ($terms as $term) {
                        // 現在のタームと一致する場合は 'active' クラスを付与
                        $active_class = ($term->term_id == $current_term_id) ? 'active' : '';

                        echo '<li><a href="' . esc_url(get_term_link($term)) . '" class="' . $active_class . '">' . esc_html($term->name) . '</a></li>';
                    }
                }
                ?>
            </ul>
        </div>

        <!-- 件数表示 -->
        <div class="exp_result">

            <h3>検索結果：<?php
                        $postnums = $count = 0 < get_query_var('posts_per_page') ? $wp_query->found_posts : $wp_query->post_count;
                        ?>
                <?php echo $postnums; ?>
                件
            </h3>

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



        <ul class="top_event_list">
            <!-- WordPress ループの開始 -->
            <?php if (have_posts()) : ?>
                <?php while (have_posts()) : ?>
                    <?php the_post(); ?>

                    <li>
                        <!-- テンプレートパーツloop-news.phpを読み込む -->
                        <?php get_template_part('template-parts/loop', 'organization') ?>
                    </li>

                    <!-- WordPress ループの終了 -->
                <?php endwhile; ?>
            <?php endif; ?>
        </ul>


        <!-- ページナビゲーション -->
        <?php if (function_exists('wp_pagenavi')) : ?>
            <div class="pagenation">
                <?php wp_pagenavi(); ?>
            </div>
        <?php endif; ?>

    </div>
</main>

<!-- footer.phpを読み込む -->
<?php
get_footer();
?>
