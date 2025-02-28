<!-- header.phpを読み込む -->
<?php
get_header();
?>

<main>
    <section class="section">
        <div class="section_inner">

            <!-- ページのタイトル -->
            <div class="section_header">
                <h1 class="heading heading-primary"><span>最新情報</span><?php wp_title(''); ?><?php echo is_year() ? '年' : ''; ?></h1>
            </div>

            <div>
                <ul>
                    <!-- <p>地域別</p>
                    <?php
                    $all_link = home_url('/organization');
                    echo '<li><a href="' . $all_link . '">All</a></li>';
                    $terms = get_terms(array(
                        'taxonomy' => 'area',
                        'hide_empty' => false,
                    ));
                    if (!empty($terms) && !is_wp_error($terms)) {
                        foreach ($terms as $term) {
                            echo '<li><a href="' . esc_url(get_term_link($term)) . '">' . esc_html($term->name) . '</a></li>';
                        }
                    }
                    ?> -->

                    <!-- 主催団体別で絞り込み -->
                    <p>主催団体</p>
                    <?php
                    $all_link = home_url('/organization');
                    echo '<li><a href="' . $all_link . '">All</a></li>';
                    $terms = get_terms(array(
                        'taxonomy' => 'org_tax',
                        'hide_empty' => false,
                    ));
                    if (!empty($terms) && !is_wp_error($terms)) {
                        foreach ($terms as $term) {
                            echo '<li><a href="' . esc_url(get_term_link($term)) . '">' . esc_html($term->name) . '</a></li>';
                        }
                    }
                    ?>
                </ul>
            </div>

            <div class="section_body">
                <div class="cardList">
                    <ul class="foodList">
                        <!-- WordPress ループの開始 -->
                        <?php if (have_posts()) : ?>
                        <?php while (have_posts()) : ?>
                        <?php the_post(); ?>

                        <li class="foodList_item">
                            <!-- テンプレートパーツloop-news.phpを読み込む -->
                            <?php get_template_part('template-parts/loop', 'organization') ?>
                        </li>

                        <!-- WordPress ループの終了 -->
                        <?php endwhile; ?>
                        <?php endif; ?>
                    </ul>
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
