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

<main>
    <section class="section">
        <div class="section_inner">

            <!-- ページのタイトル -->
            <div class="section_header">
                <h1 class="heading heading-primary"><span>最新情報</span><?php wp_title(''); ?><?php echo is_year() ? '年' : ''; ?></h1>
            </div>

            <div>
                <ul>
                    <!-- <p>地域別</p>
                    <?php
                    $all_link = home_url('/organization');
                    echo '<li><a href="' . $all_link . '">All</a></li>';
                    $terms = get_terms(array(
                        'taxonomy' => 'area',
                        'hide_empty' => false,
                    ));
                    if (!empty($terms) && !is_wp_error($terms)) {
                        foreach ($terms as $term) {
                            echo '<li><a href="' . esc_url(get_term_link($term)) . '">' . esc_html($term->name) . '</a></li>';
                        }
                    }
                    ?> -->

                    <!-- 主催団体別で絞り込み -->
                    <p>主催団体</p>
                    <?php
                    $all_link = home_url('/organization');
                    echo '<li><a href="' . $all_link . '">All</a></li>';
                    $terms = get_terms(array(
                        'taxonomy' => 'org_tax',
                        'hide_empty' => false,
                    ));
                    if (!empty($terms) && !is_wp_error($terms)) {
                        foreach ($terms as $term) {
                            echo '<li><a href="' . esc_url(get_term_link($term)) . '">' . esc_html($term->name) . '</a></li>';
                        }
                    }
                    ?>
                </ul>
            </div>

            <!-- 件数表示 -->
            <div>検索結果：<?php
                        $postnums = $count = 0 < get_query_var('posts_per_page') ? $wp_query->found_posts : $wp_query->post_count;
                        ?>
                <?php echo $postnums; ?>
                件
            </div>
            <div>
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
                echo '<div class="post-range">';
                echo $start . ' - ' . $end . ' 件を表示';
                echo '</div>';
                ?>
            </div>


            <div class="section_body">
                <div class="cardList">
                    <ul>
                        <!-- WordPress ループの開始 -->
                        <?php if (have_posts()) : ?>
                        <?php while (have_posts()) : ?>
                        <?php the_post(); ?>

                        <li class="foodList_item">
                            <!-- テンプレートパーツloop-news.phpを読み込む -->
                            <?php get_template_part('template-parts/loop', 'organization') ?>
                        </li>

                        <!-- WordPress ループの終了 -->
                        <?php endwhile; ?>
                        <?php endif; ?>
                    </ul>
                </div>

                <!-- ページナビゲーション -->
                <?php if (function_exists('wp_pagenavi')) : ?>
                <div class="pagenation">
                    <?php wp_pagenavi(); ?>
                </div>
                <?php endif; ?>
            </div>

        </div>
    </section>
</main>

<!-- footer.phpを読み込む -->
<?php
get_footer();
?>