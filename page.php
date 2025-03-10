<!-- header.phpを読み込む -->
<?php
get_header();
?>

<main class="pc_space">
    <!-- WordPress ループの開始 -->
    <?php if (have_posts()) : ?>
        <?php while (have_posts()) : ?>
            <?php the_post(); ?>

            <!-- ページタイトル -->
            <section class="
            <?php
            if (is_page('about')) {
                echo 'about_top';
            } elseif (is_page('service')) {
                echo 'service_top';
            } else {
                echo 'default_class';
            }
            ?>">
                <h2 class=" page_title"><?php the_title(); ?></h2>
            </section>

            <!-- パンくずリスト -->
            <?php get_template_part('template-parts/breadcrumb'); ?>

            <div class="inner">


                <!-- 固定ページの中身を読み込ンで出力 -->
                <?php the_content(); ?>


            </div>

            <!-- WordPress ループの終了 -->
        <?php endwhile; ?>
    <?php endif; ?>
</main>

<!-- footer.phpを読み込む -->
<?php
get_footer();
?>
