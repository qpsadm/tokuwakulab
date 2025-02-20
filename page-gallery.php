<?php
// CSSを読み込む
wp_enqueue_style('fotorama', 'https://cdnjs.cloudflare.com/ajax/libs/fotorama/4.6.4/fotorama.css');

// JSファイルを読み込む
wp_enqueue_script(
    'fotorama',
    'https://cdnjs.cloudflare.com/ajax/libs/fotorama/4.6.4/fotorama.js',
    ['jquery']
);
?>

<!-- header.phpを読み込む -->
<?php
get_header();
?>

<!-- WordPress ループの開始 -->
<?php if (have_posts()) : ?>
    <?php while (have_posts()) : ?>
        <?php the_post(); ?>

        <main>
            <section class="section is-black">
                <div class="section_inner">
                    <div class="section_header">
                        <h2 class="heading heading-primary"><span>ギャラリー</span>GALLERY</h2>
                    </div>
                    <div class="fotorama">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/gallery/1.jpg">
                        <img src="<?php echo
                                    get_template_directory_uri(); ?>/assets/img/gallery/2.jpg">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/gallery/3.jpg">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/gallery/4.jpg">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/gallery/5.jpg">
                        <img src="<?php echo get_template_directory_uri(); ?>./assets/img/gallery/6.jpg">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/gallery/7.jpg">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/gallery/8.jpg">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/gallery/9.jpg">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/gallery/10.jpg">
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
