<!-- ヘッダーの読み込み -->
<?php get_header(); ?>

<main class="pc_space">
    <section class="page_top">
        <h2 class="page_title">
            コラム詳細</h2>
    </section>

    <!-- パンくずリスト -->
    <div class="breadcrumb">
        <span><a href="<?php if (!is_home()) : ?>">
                <?php get_template_part('template-parts/breadcrumb'); ?>
            <?php endif; ?></a>
        </span>
    </div>

    <div class="inner">

        <section class="column_content_wrap">

            <?php if (have_posts()): ?>
                <?php while (have_posts()): ?>
                    <?php the_post(); ?>

                    <!-- コラムタイトル -->


                    <div class="column_ttl_wrap">







                        <!-- CSSに足してもらう -->
                        <div class="column_header">
                            <style>
                                .column_header {
                                    display: flex;
                                    align-items: center;
                                    /* 縦の中央揃え */
                                    gap: 1.6rem;
                                    /* 要素間の隙間調整 */
                                }

                                .column_date,
                                .post_date {
                                    display: flex;
                                    flex-direction: column;
                                    /* 年と日付を縦並びに */
                                }

                                .column_ttl,
                                .post_ttl {
                                    font-size: 3.6rem;
                                    line-height: 1.2;
                                    font-weight: 500;
                                }
                            </style>






                            <!-- タイトルの日付ボタン -->
                            <div class="column_date post_date">
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
                            <h2 class="column_ttl post_ttl">
                                <?php the_title(); ?>
                            </h2>
                        </div>



                        <!-- コラムタクソノミーハッシュタグ -->

                        <span class="column_tag">
                            <?php
                            $terms = get_the_terms(get_the_ID(), 'column_type');
                            if (!empty($terms) && !is_wp_error($terms)) {
                                echo '<p class="column-taxonomy">';
                                foreach ($terms as $term) {


                                    //タクソノミー一覧ページに飛ぶリンクを付ける
                                    echo '<a href="' . esc_url(get_term_link($term)) . '" class="post_tag">#' . esc_html($term->name) . '</a> ';
                                }
                                echo '</p>';
                            }
                            ?>
                        </span>

                        <br>

                        <!-- 記事の投稿内容 -->
                        <div class="column_item_wrap">
                            <div class="column_item">

                                <?php the_content(); ?>

                                <br>


                                <!-- フィールドに関連リンクがあれば飛ぶ -->
                                <?php if (get_field('url')): ?>

                                    関連リンク：
                                    <a href="<?php the_field('url'); ?>" target="_blank"><?php the_field('url'); ?></span></a>

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


        <div class="section_line"></div>




        <!-- 関連主催団体 -->
        <section class="column_content_wrap">
            <h3 class="sub_title">関連主催団体</h3>
            <div class="column_relationorg_card">


                <?php
                // フィールドから「投稿ID」を取得
                $post_id = get_field('org_id');

                // もしIDが取得できていれば、そのIDを元に投稿を表示
                if ($post_id) :
                    $args = [
                        'post_type' => 'column',  // カスタム投稿タイプ
                        'p' => $post_id,         // フィールドで入力された投稿IDを指定
                    ];

                    $the_query = new WP_Query($args);
                    if ($the_query->have_posts()) :
                        while ($the_query->have_posts()) :
                            $the_query->the_post();
                ?>
                            <li>
                                <!-- 特定の投稿IDに対応するカード型を表示 -->
                                <?php get_template_part('template-parts/loop', 'organization') ?>
                            </li>
                        <?php endwhile; ?>
                        <?php wp_reset_postdata(); ?>
                    <?php endif; ?>
                <?php endif; ?>


            </div>
        </section>




        <div class="section_line"></div>


        <!-- おすすめコラム記事 -->
        <section class="column_content_wrap">
            <h3 class="sub_title">おすすめコラム記事</h3>
            <!-- <div class="column_recomend_list"> -->

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

                        <a href="<?php the_permalink(); ?>">
                            <span><time datetime="<?php the_time('Y-m-d'); ?>">
                                    <?php the_time('Y/m/d(D)'); ?>
                                </time></span>
                            <span><?php the_title(); ?></span>
                        </a>

                    <?php endwhile; ?>
                    <?php wp_reset_postdata(); ?>
                <?php endif; ?>

                </div>

        </section>

    </div>

</main>

<!-- フッターを読み込む -->
<?php get_footer(); ?>
