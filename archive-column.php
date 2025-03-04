<!-- ヘッダーの読み込み -->
<?php get_header(); ?>


<main class="pc_space">
    <!-- ページタイトル -->
    <section class="page_top">
        <h2 class="page_title">コラム一覧</h2>
    </section>

    <!-- パンくずリスト -->
    <div class="breadcrumb">
        <?php if (!is_home()) : ?>
            <?php get_template_part('template-parts/breadcrumb'); ?>
        <?php endif; ?>
    </div>


    <div class="inner">
        <ul class="column_menu">
            <?php
            $all_link = home_url('/column');
            echo '<li class="column_btn"><a href="' . $all_link . '">All</a></li>';

            $terms = get_terms(array(
                'taxonomy' => 'column_type',
                'hide_empty' => false,
            ));
            if (!empty($terms) && !is_wp_error($terms)) {
                foreach ($terms as $term) {
                    echo '<li class="column_btn"><a href="' . esc_url(get_term_link($term)) . '">' . esc_html($term->name) . '</a></li>';
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
<?php//get_footer(); ?>
