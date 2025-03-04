<!-- 検索フォームの呼び出し -->
<?php get_search_form() ?>


<h3>検索結果</h3>


<!-- 検索結果一覧カード -->
<!-- フリーワード検索の結果 -->
<?php $get_num = $wp_query->post_count; //今表示する記事数を取得
$all_num = $wp_query->found_posts; //記事の総数を取得
?>
<?php if (!empty(get_search_query())): ?>
    <?php if ($all_num > 0) : ?>
        <p><?php echo "全" . $all_num . "件中、" . $get_num . "件を表示"; ?> </p>
    <?php endif; ?>
    <?php if (have_posts()) : ?>
        <div class="results_card">
            <?php while (have_posts()) : the_post(); ?>
                <?php get_template_part('template-parts/loop', 'event'); ?>
            <?php endwhile; ?>
        </div>
    <?php else: ?>
        <p>検索結果はありませんでした。</p>
    <?php endif; ?>
<?php else: ?>
    <!--条件検索のサブクエリ-->





    <?php
    // ページネーションの設定
    // $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
    // $args['paged'] = $paged;



    $args = [
        'post_type' => 'event',
        'post_status' => 'publish', // 公開された投稿のみを表示
        'tax_query' => array('relation' => 'AND'),
        'order' => 'ASC', // 昇順
        'orderby' => 'ID', // 投稿ID順
        // 'posts_per_page'=>1, //1ページの表示件数
    ];

    $taxonomies = ['area', 'event_type', 'experience', 'other', 'loc_type', 'age', 'time', 'vacation', 'frequency'];

    foreach ($taxonomies as $taxonomy) {
        if (!empty($_GET[$taxonomy])) {
            $args['tax_query'][] = [
                'taxonomy' => $taxonomy,
                'field'    => 'slug',
                'terms'    => $_GET[$taxonomy],
            ];
        }
    }

    $the_query = new WP_Query($args);
    $get_num = $the_query->post_count; //今表示する記事数を取得
    $all_num = $the_query->found_posts; //記事の総数を取得

    ?>

    <?php if ($the_query->have_posts()): ?>
        <?php if ($all_num > 0) : ?>
            <p><?php echo "全" . $all_num . "件中、" . $get_num . "件を表示"; ?> </p>
        <?php endif; ?>
        <div class="article_all">
            <?php while ($the_query->have_posts()) : ?>
                <?php $the_query->the_post(); ?>
                <article class="card_shape">
                    <a href="<?php the_permalink(); ?>">
                        <div class="foodCard_pic">
                            <?php if (has_post_thumbnail()) : ?>
                                <?php the_post_thumbnail('medium'); ?>
                            <?php else : ?>
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/img/common/noimage.png" alt="">
                            <?php endif; ?>
                        </div>
                        <div class="foodCard_body">
                            <h4 class="foodCard_title"><?php the_title(); ?></h4>

                            <br>
                            <span>開催日</span><?php the_field('date_start'); ?>
                            <br>
                            <span>申込締切</span><?php the_field('closing'); ?>
                            <br>
                            <span>会場名</span><?php the_field('address') ?>
                            <br>
                            <span>対象学年</span><?php the_field('age_text') ?>

                        </div>
                        <?php
                        $terms = get_the_terms(get_the_ID(), 'area');
                        if (!empty($terms) && !is_wp_error($terms)) {
                            echo '<p class="event-taxonomy">';
                            foreach ($terms as $term) {

                                echo '<span class="taxonomy-badge">' . esc_html($term->name) . '</span> ';
                            }
                            echo '</p>';
                        }
                        ?>
                    </a>
                </article>
            <?php endwhile; ?>
        </div>
    <?php else : ?>
        <p>検索結果はありませんでした。</p>
    <?php endif; ?>
    <?php wp_reset_postdata(); ?>

<?php endif; ?>

<!-- ページネーション -->

<?php if (function_exists('wp_pagenavi')): ?>
    <div class="pagenation">
        <?php wp_pagenavi(); ?>
    </div>
<?php endif; ?>


</div>
</main>
<?php get_footer();
?>
