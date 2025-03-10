<!-- ヘッダーの読み込み -->
<?php get_header(); ?>

<main class="pc_space">
    <section class="page_top">
        <h2 class="page_title">
            コラム詳細</h2>
    </section>

    <!-- パンくずリスト -->
    <?php get_template_part('template-parts/breadcrumb'); ?>

    <div class="inner">

        <section class="column_content_wrap">

            <?php if (have_posts()): ?>
                <?php while (have_posts()): ?>
                    <?php the_post(); ?>

                    <!-- コラムタイトル -->


                    <div class="column_ttl_wrap">


                        <!-- タイトルの日付ボタン -->
                        <div class="column_date">
                            <span>
                                <time datetime="<?php the_time('Y-m-d'); ?>">
                                    <?php the_time('Y'); ?>
                                </time>
                            </span>
                            <span>
                                <time datetime="<?php the_time('Y-m-d'); ?>"><?php the_time('m/d(D)'); ?></time>
                            </span>
                        </div>

                        <!-- 記事のタイトル -->
                        <h2 class="column_ttl">
                            <?php the_title(); ?>
                        </h2>

                    </div>



                    <!-- コラムタクソノミーハッシュタグ -->

                    <span class="column_tag">
                        <?php
                        $terms = get_the_terms(get_the_ID(), 'column_type');
                        if (!empty($terms) && !is_wp_error($terms)) {

                            foreach ($terms as $term) {

                                echo '<span class="colmun_tag">#' . esc_html($term->name) . '</span>';
                            }
                        }
                        ?>
                    </span>

                    <br>

                    <!-- 記事の投稿内容 -->
                    <div class="column_item_wrap">
                        <div class="column_item">

                            <?php the_content(); ?>


                            <!-- フィールドに関連リンクがあれば飛ぶ -->
                            <?php if (get_field('url')): ?>

                                <p><a href="<?php the_field('url'); ?>" target="_blank">【関連リンク】<?php the_field('url'); ?></a>
                                </p>


                            <?php endif; ?>

                        </div>
                    </div>




                    <!-- ここいらないかも？ -->

                    <!-- <div class="post_footer"> -->
                    <!-- <?php $categories = get_the_category();
                            if ($categories):
                            ?>
                                <div class="category">
                                    <div class="category_list">
                                        <?php foreach ($categories as $category): ?>
                                            <div class="category_item"><a href="" class="btn btn-sm is-active"><?php echo $category->name; ?></a></div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            <?php endif; ?> -->


                    <br>
                    <!-- 記事送りボタン -->
                    <div class="flex">
                        <?php
                        $previous_post = get_previous_post();
                        if ($previous_post): ?>
                            <!-- <div class="prevNext_item prevNext_item-prev"> -->
                            <a class="prv_btn" href="<?php the_permalink($previous_post); ?>">
                                <!-- <svg width="20" height="38" viewBox="0 0 20 38">
                                                <path d="M0,0,19,19,0,38" transform="translate(20 38) rotate(180)" fill="none" stroke="#224163" stroke-width="1" />
                                            </svg> -->
                                <span>前の記事へ</span>
                            </a>
                            <!-- </div> -->
                        <?php endif; ?>

                        <?php
                        $next_post = get_next_post();
                        if ($next_post): ?>
                            <!-- <div class="prevNext_item prevNext_item-next"> -->
                            <a class="nxt_btn" href="<?php the_permalink($next_post); ?>">
                                <span>次の記事へ</span>
                                <!-- <svg width="20" height="38" viewBox="0 0 20 38">
                                            <path d="M1832,1515l19,19L1832,1553" transform="translate(-1832 -1514)" fill="none" stroke="#224163" stroke-width="1" />
                                        </svg> -->
                            </a>
                        <?php endif; ?>
                    </div>


                    <!-- コラム一覧ボタン -->
                    <a class="btn_wrap" href="<?php echo home_url("column"); ?>">コラム一覧へ</a>
                <?php endwhile; ?>
            <?php endif; ?>
        </section>


        <?php
        // フィールドから「投稿ID」を取得
        $post_id = get_field('org_id');


        $args = [
            'post_type' => 'organization',
            'posts_per_page' => 1,
            'post__in'=> [$post_id], // 取得したい投稿ID
        ];


        // サブクエリ取得
        $the_query = new WP_Query($args);
        ?>

        <?php if($the_query->have_posts()): ?>
<?php while ($the_query->have_posts()) : ?>
                        <?php $the_query->the_post(); ?>
            <div class="section_line"></div>


            <!-- 関連主催団体 -->
            <section class="column_content_wrap">
                <h3 class="sub_title">関連主催団体</h3>
                <div class="column_relationorg_card">

                    <!-- 主催団体カード型 -->
                            <a class="card_wrap" href="<?php the_permalink(); ?>">
                                <div class="orgcard_shape">
                                    <div class="card_inner">
                                        <div>
                                            <?php if ($the_query->has_post_thumbnail()) : ?>
                                                <!-- アイキャッチ画像があった場合は、表示 -->
                                                <?php the_post_thumbnail('medium'); ?>
                                            <?php else : ?>
                                                <!-- アイキャッチ画像が設定していない場合は、noimage.pngを表示 -->
                                                <img src="<?php echo get_template_directory_uri(); ?>/assets/img/noimage.png" alt="">
                                            <?php endif; ?>
                                        </div>

                                        <div class="card_text">
                                            <h3><?php the_title(); ?></h3>
                                            <div class="orgcard_line">
                                            </div>
                                            <div>
                                                <span class="card_subtitle">所在地</span>
                                                <div>
                                                    <span>
                                                        <?php if (mb_strlen(get_field('address')) > 20) {
                                                            $address = mb_substr(get_field('address'), 0, 20);
                                                            echo $address . '…';
                                                        } else {
                                                            echo get_field('address');
                                                        } ?>
                                                    </span>
                                                </div>
                                            </div>
                                            <span class="card_subtitle">電話番号</span>
                                            <div>
                                                <span>
                                                    <?php the_field('tel'); ?>
                                                </span>
                                            </div>
                                            <?php if (get_field('hour')): ?>
                                                <div>
                                                    <span class="card_subtitle">営業時間</span>
                                                    <div>
                                                        <span>
                                                            <?php the_field('hour') ?>
                                                        </span>

                                                    </div>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                                            </div>
            </section>

<?php endwhile; ?>
                    <?php endif; ?>
                    <?php wp_reset_postdata(); ?>
                <?php endif; ?>


                </div>
            </section>



            <div class="section_line"></div>


            <!-- おすすめコラム記事 -->
            <section class="column_content_wrap">
                <h3 class="sub_title">おすすめコラム記事</h3>
                <div class="column_recomend_list">


                    <?php
                    $args = [
                        "post_type" => "column", //コラム記事
                        'posts_per_archive_page' => 3, //3件表示
                    ];

                    $the_query = new WP_Query($args);
                    if ($the_query->have_posts()): ?>
                        <div class="column_recomend_list">
                            <?php while ($the_query->have_posts()): ?>
                                <?php $the_query->the_post(); ?>

                                <span>
                                    <time datetime="<?php the_time('Y-m-d'); ?>">
                                        <?php the_time('Y/m/d(D)'); ?>
                                    </time>
                                </span>
                                <a href="<?php the_permalink(); ?>">
                                    <span>
                                        <?php the_title(); ?>
                                    </span>
                                </a>

                            <?php endwhile; ?>
                            <?php wp_reset_postdata(); ?>
                        </div>
                    <?php endif; ?>

                </div>

            </section>

    </div>

</main>

<!-- フッターを読み込む -->
<?php get_footer(); ?>
