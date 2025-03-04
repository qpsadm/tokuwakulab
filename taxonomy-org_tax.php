<!-- header.phpを読み込む -->
<?php
get_header();
?>

<?php
// サブクエリ
$args = [
    // 1ページに表示する記事数
    'paged' => $paged,
    'post_type' => 'event',
    'posts_per_page' => 6,
];
?>

<main>
    <section class="section section-foodList">
        <div class="section_inner">
            <div class="section_header">
                <h2 class="heading heading-primary"><span>フード紹介</span>FOOD</h2>
            </div>

            <section class="section_body">
                <?php
                // タクソノミー名でクエリ変数を取得
                $menu_slug = get_query_var('area');

                $taxonomy_slug = get_query_var('taxonomy');
                // 取得したクエリ変数から、タクソノミータームの情報を取得
                $menu = get_term_by('slug', $menu_slug, $taxonomy_slug);
                ?>

                <h3 class="heading heading-secondary"><?php single_term_title(''); ?>
                    <span><?php echo strtoupper($menu->slug); ?></span>
                </h3>
                <!-- 団体絞り込みの際にエラー発生 -->
                <!-- 件数表示 -->
                <div>検索結果：<?php
                            $postnums = $count = 0 < get_query_var('posts_per_page') ? $wp_query->found_posts : $wp_query->post_count;
                            ?>
                    <?php echo $postnums; ?>
                    件
                </div>
                <ul>
                    <li class="foodList_item">
                        <!-- WordPress ループの開始 -->
                        <?php if (have_posts()) : ?>
                        <?php while (have_posts()) : ?>
                        <?php the_post(); ?>
                    </li>
                    <li class="foodList_item">
                        <!-- テンプレートパーツloop-organization.phpを読み込む -->
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
            </section>
        </div>
    </section>
</main>

<!-- footer.phpを読み込む -->
<!-- <?php
        get_footer();
        ?> -->