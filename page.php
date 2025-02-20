<!-- header.phpを読み込む -->
<?php
get_header();
?>

<!-- WordPress ループの開始 -->
<?php if (have_posts()) : ?>
    <?php while (have_posts()) : ?>
        <?php the_post(); ?>

        <main>
            <section class="section">
                <div class="section_inner">
                    <div class="section_header">
                        <h2 class="heading heading-primary">
                            <span><?php the_title(); ?></span><?php echo strtoupper($post->post_name); ?>
                        </h2>
                    </div>

                    <div class="section_body">
                        <div class="content">

                            <!-- 固定ページの中身を読み込ンで出力 -->
                            <?php the_content(); ?>

                        </div>
                    </div>
                </div>
            </section>
        </main>

        <!-- WordPress ループの終了 -->
    <?php endwhile; ?>
<?php endif; ?>

<!-- footer.phpを読み込む -->
<?php
get_footer();
?>
