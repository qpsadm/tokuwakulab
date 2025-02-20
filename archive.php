<!-- header.phpを読み込む -->
<?php
get_header();
?>

<main>
    <section class="section">
        <div class="section_inner">

            <!-- ページのタイトル -->
            <div class="section_header">
                <h1 class="heading heading-primary"><span>最新情報</span>NEWS - <?php wp_title(''); ?><?php echo is_year() ? '年' : ''; ?></h1>
            </div>

            <!-- 切り替え、絞り込むボタン -->
            <div class="archive">
                <div class="archive_category">
                    <h2 class="archive_title">カテゴリー</h2>
                    <ul class="archive_list">
                        <?php
                        $args = [
                            'title_li' => '',     //見出しを削除
                            'show_count' => false,
                            'orderby' => 'slug',
                            'order' => 'asc',
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
            </div>

            <div class="section_body">
                <div class="cardList">

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
