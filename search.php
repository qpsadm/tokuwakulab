<!-- header.phpを読み込む -->
<?php
get_header();
?>

<main>
    <!-- パンくずリスト -->
    <?php get_template_part('template-parts/breadcrumb'); ?>

    <section class="section">
        <div class="section_inner">
            <div class="section_header">
                <h1 class="heading heading-primary"><span>サイト内検索</span>SEARCH</h1>
            </div>

            <div class="section_body">
                <div class="section_desc">
                    <p><i class="fas fa-search"></i> 検索ワード：<?php the_search_query(); ?></p>
                </div>

                <div class="cardList">

                    <!-- WordPress ループの開始 -->
                    <?php if (have_posts()) : ?>
                    <?php while (have_posts()) : ?>
                    <?php the_post(); ?>

                    <!-- テンプレートパーツを読み込む -->
                    <?php get_template_part('template-parts/loop', 'news') ?>

                    <!-- WordPress ループの終了 -->
                    <?php endwhile; ?>

                    <?php else : ?>
                    <div class="section_desc">
                        <p>検索結果はありませんでした。</p>
                    </div>
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
