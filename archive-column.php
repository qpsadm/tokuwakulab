<!-- ヘッダーの読み込み -->
<?php get_header(); ?>

<p>KVとタイトルが入る</p>

<main>
    <section class="section section-foodList">
        <div class="section_inner">
            <div class="section_header">
                <h2 class="heading heading-primary"><span>特集記事投稿</span>コラム</h2>
            </div>

            <?php
            //タクソノミーmenuのターム「$menu_terms」を取得
            $args = [
                'taxonomy' => 'menu',
            ];
            $menu_terms = get_terms($args);
            ?>

            <?php if (!empty($menu_terms)): ?>

                <!-- タクソノミーmenuのタームごとに一覧を作成 -->
                <?php foreach ($menu_terms as $menu): ?>


                    <section class="section_body">

                        <!-- タイトルを動的に切り替えるように -->
                        <h3 class="heading heading-secondary">

                            <!-- 分類ごとのタイトルを表示 -->
                            <a href="<?php echo get_term_link($menu); ?>"><?php echo $menu->name; ?></a>
                            <span><?php echo strtoupper($menu->slug); ?></span>
                        </h3>

                        <ul class="foodList">

                            <?php
                            //メニューの投稿タイプ
                            $args = [
                                'post_type' => 'food',
                                'posts_per_page' => -1,
                            ];

                            //メニューの種類で絞り込む
                            $taxquerysp = [
                                'relation' => 'AND'
                            ];
                            //メニューの絞り込む条件
                            $taxquerysp[] = [
                                'taxonomy' => 'menu',
                                'terms' => $menu, //↑18列あたりの「foreach」のとこ
                                'field' => 'slug',
                            ];
                            $args['tax_query'] = $taxquerysp;
                            // クエリのオブジェクトを生成
                            $the_query = new WP_Query($args);

                            ?>

                            <!-- ループ -->
                            <?php if ($the_query->have_posts()): ?>
                                <?php while ($the_query->have_posts()): ?>
                                    <?php $the_query->the_post(); ?>

                                    <li class="foodList_item">

                                        <!-- foodのカード型を読み込む -->
                                        <?php get_template_part('template-parts/loop', 'food') ?>

                                    </li>

                                <?php endwhile; ?>
                                <!-- リセット -->
                                <?php wp_reset_postdata(); ?>
                            <?php endif; ?>

                        </ul>
                    </section>

                <?php endforeach; ?>
            <?php endif; ?>

        </div>
    </section>
</main>

<!-- フッターを読み込む -->
<?php get_footer(); ?>
