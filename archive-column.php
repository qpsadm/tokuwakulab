<!-- ヘッダーの読み込み -->
<?php get_header(); ?>

<p>ここにKVとタイトルが入る</p>

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
                <h2 class="heading heading-primary">コラム一覧</h2>
            </div>





            <ul class="">


                <!-- コラムループ -->
                <?php if (have_posts()): ?>
                <?php while (have_posts()): ?>
                <?php the_post(); ?>

                <li class="">

                    <!-- columnのカード型を読み込む -->
                    <?php get_template_part('template-parts/loop', 'column') ?>

                </li>

                <?php endwhile; ?>
                <!-- リセット -->
                <?php wp_reset_postdata(); ?>
                <?php endif; ?>

            </ul>
    </section>

    </div>
    </section>
</main>

<!-- フッターを読み込む -->
<?php get_footer(); ?>