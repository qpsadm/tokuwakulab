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

            <!-- タクソノミーを取得して、動的グルーピング設定 -->
            <?php
            $args = [
                'taxonomy' => 'menu',
                'orderby' => 'slug',
                'order' => 'DESC',
            ];
            $menu_terms = get_terms($args);
            ?>

            <?php if (!empty($menu_terms)) : ?>
                <?php foreach ($menu_terms as $menu) : ?>

                    <section class="section_body">
                        <!-- タクソノミーのタームタイトル -->
                        <h3 class="heading heading-secondary">
                            <a href="<?php echo get_term_link($menu) ?>"><?php echo $menu->name; ?></a>
                            <span><?php echo strtoupper($menu->slug); ?></span>
                        </h3>

                        <ul class="foodList">

                            <!-- 指定タクソノミーでフードの投稿を取得するサブクエリを定義 -->
                            <?php
                            // メニューの投稿タイプ
                            $args = [
                                'post_type' => 'food',
                                'post_per_page' => -1,      //全部取得
                            ];

                            // メニューの種類で絞り込む
                            $taxquerysp = [
                                'relation' => 'AND',
                            ];
                            $taxquerysp[] = [
                                'taxonomy' => 'menu',
                                'terms' => $menu->slug,
                                'field' => 'slug',
                            ];
                            // 上記の条件を$argsに追加
                            $args['tax_query'] = $taxquerysp;

                            // WP_Queryに検索条件を代入して、実行する
                            $query = new WP_Query($args);
                            ?>

                            <!-- WordPress ループの開始 -->
                            <?php if ($query->have_posts()) : ?>
                                <?php while ($query->have_posts()) : ?>
                                    <?php $query->the_post(); ?>

                                    <li class="foodList_item">
                                        <!-- テンプレートパーツloop-food.phpを読み込む -->
                                        <?php get_template_part('template-parts/loop', 'food') ?>
                                    </li>

                                    <!-- WordPress ループの終了 -->
                                <?php endwhile; ?>

                                <!-- サブクエリをリセット -->
                                <?php wp_reset_postdata(); ?>

                            <?php endif; ?>
                        </ul>
                    </section>

                <?php endforeach; ?>
            <?php endif; ?>

        </div>
    </section>
</main>

<!-- footer.phpを読み込む -->
<?php
get_footer();
?>
