<!-- header.phpを読み込む -->
<?php
get_header();
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
                $menu_slug = get_query_var('menu');
                // 取得したクエリ変数から、タクソノミータームの情報を取得
                $menu = get_term_by('slug', $menu_slug, 'menu');
                ?>

                <h3 class="heading heading-secondary"><?php single_term_title(''); ?><span><?php echo strtoupper($menu->slug); ?></span></h3>

                <ul class="foodList">
                    <!-- <li class="foodList_item">
                        <div class="foodCard">
                            <a href="#">
                                <span class="foodCard_label">オススメ</span>
                                <div class="foodCard_pic">
                                    <img src="assets/img/food/food_img01@2x.png" alt="">
                                </div>
                                <div class="foodCard_body">
                                    <h4 class="foodCard_title">タコス</h4>
                                    <p class="foodCard_price">¥650</p>
                                </div>
                            </a>
                        </div>
                    </li> -->
                    <!-- WordPress ループの開始 -->
                    <?php if (have_posts()) : ?>
                        <?php while (have_posts()) : ?>
                            <?php the_post(); ?>

                            <li class="foodList_item">
                                <!-- テンプレートパーツloop-food.phpを読み込む -->
                                <?php get_template_part('template-parts/loop', 'food') ?>
                            </li>

                            <!-- WordPress ループの終了 -->
                        <?php endwhile; ?>
                    <?php endif; ?>
                </ul>
            </section>
        </div>
    </section>
</main>

<!-- footer.phpを読み込む -->
<?php
get_footer();
?>
