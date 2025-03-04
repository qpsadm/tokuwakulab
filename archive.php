<!-- header.phpを読み込む -->
<?php
get_header();
?>

<main class="pc_space">

    <!-- ページのタイトル -->
    <section class="page_top">
        <h2 class="page_title"><?php wp_title(''); ?>一覧</h2>
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
    <div class="breadcrumb">
        <?php if (!is_home()) : ?>
        <?php get_template_part('template-parts/breadcrumb'); ?>
        <?php endif; ?>
    </div>
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
            <?php if (function_exists('wp_pagenavi')): ?>
            <div class="pagination">
                <?php wp_pagenavi(); ?>
            </div>
            <?php endif; ?>
        </div>
        <!-- ページネーション -->
        <div class="pagenation">
            <div class="pagenation_nav left"></div>
            <div class="pagenation_number">1</div>
            <div class="pagenation_number">2</div>
            <div class="pagenation_number">3</div>
            <div class="pagenation_nav right"></div>
        </div>

</main>

<!-- footer.phpを読み込む -->
<?php get_footer();
?>