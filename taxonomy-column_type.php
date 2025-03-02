<!-- header.phpを読み込む -->
<?php
get_header();
?>

<main>
    <section class="section section-foodList">
        <div class="section_inner">


            <div>
                <ul>
                    <?php
                    $all_link = home_url('/column');
                    echo '<li><a href="' . $all_link . '">All</a></li>';

                    $terms = get_terms(array(
                        'taxonomy' => 'column_type',
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



            <div class="section_header">
                <h2 class="heading heading-primary">コラム</h2>
            </div>

            <section class="section_body">
                <?php
                // タクソノミー名でクエリ変数を取得
                $column_type_slug = get_query_var('column_type');
                // 取得したクエリ変数から、タクソノミータームの情報を取得
                $column_type = get_term_by('slug', $column_type_slug, 'column_type');
                ?>

                <h3 class="heading heading-secondary"><?php single_term_title(''); ?></h3>

                <ul class="foodList">

                    <!-- WordPress ループの開始 -->
                    <?php if (have_posts()) : ?>
                        <?php while (have_posts()) : ?>
                            <?php the_post(); ?>

                            <li class="foodList_item">
                                <!-- テンプレートパーツloop-food.phpを読み込む -->
                                <?php get_template_part('template-parts/loop', 'column') ?>
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
