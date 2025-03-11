<!-- header.phpを読み込む -->
<?php
get_header();
?>

<main class="pc_space">

    <!-- ページのタイトル -->
    <section class="post_list_top">
        <h2 class="page_title"><?php wp_title(''); ?></h2>
    </section>

    <!-- 切り替え、絞り込むボタン
            <div class="archive">
                <div class="archive_category">
                    <h2 class="archive_title">カテゴリー</h2>
                    <ul class="archive_list">
                        <?php
                        $args = [
                            'title_li' => '',     //見出しを削除
                            'show_count' => false,
                            'orderby' => 'date',
                            'order' => 'DESC',
                            'hide_empty' => true, //空のカテゴリーを非表示
                        ];
                        // カテゴリー別リンク一覧を作成・出力
                        wp_list_categories($args);
                        ?>
                    </ul>
                </div>

                <div class="archive_yealy">
                    <h2 class="archive_title">年別</h2>
                    <ul class="archive_list">
                        <?php
                        $args = [
                            'type' => 'yearly',     //アーカイブ種別指定
                        ];
                        // アーカイブ別リンク一覧を作成・出力
                        wp_get_archives($args);
                        ?>
                    </ul>
                </div>
            </div> -->
    <!-- パンくずリスト -->
    <?php get_template_part('template-parts/breadcrumb'); ?>
    <div class="inner">

        <!-- お知らせ一覧 -->
        <div class="post_list">
            <?php
            global $wp_query;
            $post_id = $wp_query->get_queried_object_id();
            //echo get_favorites_button($post_id);
            ?>

            <!-- WordPress ループの開始 -->
            <?php if (have_posts()) : ?>
                <?php while (have_posts()) : ?>
                    <?php the_post(); ?>

                    <!-- テンプレートパーツloop-news.phpを読み込む -->
                    <?php get_template_part('template-parts/loop', 'news') ?>

                    <!-- WordPress ループの終了 -->
                <?php endwhile; ?>
            <?php endif; ?>

        </div>

        <!-- ページナビゲーション -->
        <div class="pagenation">
            <div class="wp-pagenavi">

                <?php if (function_exists('wp_pagenavi')): ?>
                    <div class="">
                        <?php wp_pagenavi(); ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
</main>

<!-- footer.phpを読み込む -->
<?php get_footer();
?>
