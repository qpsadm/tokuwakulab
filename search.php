<!-- header.phpを読み込む -->
<!-- <?php
        get_header();
        ?> -->
<!-- KVが入るかも？ -->


<main>
    <!-- パンくずリスト -->
    <?php get_template_part('template-parts/breadcrumb'); ?>


    <section class="section">
        <div>
            <form action="<?php echo home_url('/'); ?>" method="GET">
                <!-- タクソノミー検索 -->

                <?php
                $taxonomies = [
                    'area',
                    'event_type',
                    'experience',
                    'other',
                    'loc_type',
                    'age',
                    'time',
                    'vacation',
                    'frequency',
                ];
                ?>

                <?php foreach ($taxonomies as $taxonomy) : ?>
                    <?php $taxonomy_obj = get_taxonomy($taxonomy); ?><!-- タクソノミーのオブジェクトを取得 -->
                    <?php if($taxonomy=== 'event_type'): ?>
                        <?php $terms = get_terms(['taxonomy' => $taxonomy]); ?>
                    <?php $terms = get_terms(['taxonomy' => $taxonomy]); ?> <!-- タームの取得 -->

                    <?php if (!empty($terms)) : ?>
                        <p><?php echo $taxonomy_obj->label; ?></p> <!-- タクソノミー名を表示 -->
                        <ul>
                            <?php foreach ($terms as $term) : ?>
                                <li>
                                    <label>
                                        <input type="checkbox" name="cate[]" value="<?php echo $term->slug; ?>">
                                        <?php echo $term->name; ?> <!-- タームを表示 -->
                                    </label>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                <?php endforeach; ?>


                <!-- フリーワード検索 -->
                <div>
                    <p>フリーワード：<?php the_search_query(); ?></p>
                </div>


                <!-- イベントを探すボタン -->

            </form>



            <!-- 検索結果表示場所 -->
            <div>
                <!-- WordPress ループの開始 -->
                <?php if (have_posts()) : ?>
                    <?php while (have_posts()) : ?>
                        <?php the_post(); ?>

                        <!-- テンプレートパーツを読み込む -->
                        <?php get_template_part('template-parts/loop', 'news') ?>
                        <!-- WordPress ループの終了 -->
                    <?php endwhile; ?>
                <?php else : ?>
                    <div class="section_desc">
                        <!-- <p>検索結果はありませんでした。</p> -->
                    </div>
                <?php endif; ?>
            </div>


            <!-- ページナビゲーション -->
            <?php if (function_exists('wp_pagenavi')) : ?>
                <div class="pagenation">
                    <?php wp_pagenavi(); ?>
                </div>
            <?php endif; ?>



        </div>
    </section>
</main>

<!-- footer.phpを読み込む -->
<!-- <?php
        get_footer();
        ?> -->
