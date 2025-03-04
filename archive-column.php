<!-- ヘッダーの読み込み -->
<?php get_header(); ?>


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
        <ul class="column_menu">
            <?php
            $all_link = home_url('/column');
            echo '<li class="column_btn"><a href="' . $all_link . '">All</a></li>';

            $terms = get_terms(array(
                'taxonomy' => 'column_type',
                'hide_empty' => false,
            ));
            if (!empty($terms) && !is_wp_error($terms)) {
                foreach ($terms as $term) {
                    echo '<li class="column_btn"><a href="' . esc_url(get_term_link($term)) . '">' . esc_html($term->name) . '</a></li>';
                }
            }
            ?>
        </ul>



        <!-- ここから検索結果 -->
        <div class="columnlist_wrap">


            <div class="column_result">
                <div>
                    <span>1-6</span><span>件を表示</span>
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
