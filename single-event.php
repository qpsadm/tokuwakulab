<!-- ヘッダーの読み込み -->
<?php get_header(); ?>

<main class="pc_space">




    <!-- ページタイトル -->
    <section class="page_top">
        <h2 class="page_title">イベント詳細</h2>
    </section>

    <!-- パンくずリスト -->
    <?php get_template_part('template-parts/breadcrumb'); ?>

    <div class="inner">


        <?php if (have_posts()): ?>
            <?php while (have_posts()): ?>
                <?php the_post(); ?>


                <section class="event_top">
                    <!-- イベントタイトル -->
                    <h2><?php the_title(); ?></h2>
                    <!-- 主催団体のページからidを使って主催団体の名前を表示する -->
                    <div class="orgbtn">
                        <h3>
                            <?php $id = get_field('org_id') ?>
                            <a href="<?php echo get_the_permalink($id) ?>">
                                <?php echo get_the_title($id) ?>
                            </a>
                        </h3>
                    </div>

                    <div class="event_action">
                        <!-- お気に入りボタン -->
                        <div class="event_bookmark">
                            <?php
                            global $wp_query;
                            $post_id = $wp_query->get_queried_object_id();
                            echo get_favorites_button($post_id);
                            ?>
                        </div>
                        <!-- いいねボタン -->
                        <div class="event_good">
                            <?php echo do_shortcode('[wp_ulike]'); ?>
                        </div>
                    </div>


                    <div class="event_kv_wrap">
                        <!-- キービジュアル -->
                        <ul class="slider_kv">

                            <!-- 写真 -->
                            <li>
                                <?php
                                $pic = get_field('image01');
                                //大サイズの画像のURL
                                $pic_url = $pic['sizes']['large'];
                                ?>
                                <img src="<?php echo $pic_url; ?>" alt="">
                            </li>
                            <!-- 「image02」「image03」「image04」は写真がある場合のみ表示 -->
                            <?php
                            $pic = get_field('image02');
                            if (!empty($pic)) {
                                //大サイズの画像のURL
                                $pic_url = $pic['sizes']['large'];

                                echo '<li><img src="' . esc_url($pic_url) . '" alt=""></li>';
                            }
                            ?>

                            <?php
                            $pic = get_field('image03');
                            if (!empty($pic)) {
                                //大サイズの画像のURL
                                $pic_url = $pic['sizes']['large'];

                                echo '<li><img src="' . esc_url($pic_url) . '" alt=""></li>';
                            }
                            ?>
                            <?php
                            $pic = get_field('image04');
                            if (!empty($pic)) {
                                //大サイズの画像のURL
                                $pic_url = $pic['sizes']['large'];

                                echo '<li><img src="' . esc_url($pic_url) . '" alt=""></li>';
                            }
                            ?>
                        </ul>


                    </div>

                    <div class="eve_taglist">
                        <!-- 開催時期タクソノミーを取得して表示 -->
                        <?php

                        // 表示したいタクソノミーのスラッグを配列で定義
                        $taxonomies = ['event_type', 'experience', 'vacation'];  // 追加したいタクソノミーをここに書く

                        // 各タクソノミーについて処理
                        foreach ($taxonomies as $taxonomy) {
                            // タクソノミーを取得
                            $terms = get_the_terms(get_the_ID(), $taxonomy);
                            // タクソノミーがあるか確認
                            // タクソノミーが無ければ非表示
                            if (!empty($terms) && !is_wp_error($terms)) {

                                foreach ($terms as $term) {

                                    echo '<div class="card_tag">';
                                    // area情報を表示
                                    echo '<p class="event-taxonomy">';
                                    echo '<span class="taxonomy-badge">#' . esc_html($term->name) . '</span> ';
                                    echo '</p>';
                                    echo '</div>';
                                }
                            }
                        }

                        ?>
                    </div>

                    <!-- イベント本文 -->
                    <div class="event_description">
                        <p>
                            <?php the_field('overview'); ?>
                        </p>
                    </div>
                </section>

                <section>
                    <h3 class="sub_title">
                        基本情報
                    </h3>

                    <table class="event_table">
                        <tr>
                            <th>
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/img/date.png" alt="">開催日時
                            </th>
                            <td>
                                <?php the_field('date_start'); ?>～<?php the_field('date_end'); ?>

                            </td>
                        </tr>

                        <tr>
                            <th>
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/img/days.png" alt="">開催詳細
                            </th>
                            <td>
                                <?php if (get_field('days')): ?><span><?php the_field('days') ?></span>
                                <?php else: ?>
                                    <span>-</span>
                                <?php endif; ?>
                            </td>
                        </tr>

                        <tr>
                            <th>
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/img/map.png" alt="">会場名
                            </th>
                            <td>
                                <?php if (get_field('address')): ?>
                                    <span><?php the_field('address') ?></span>
                                <?php else: ?>
                                    <span>-</span>
                                <?php endif; ?>

                            </td>
                        </tr>

                        <tr>
                            <th>
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/img/venue.png" alt="">会場住所
                            </th>
                            <td>
                                <?php the_field('venue'); ?>
                            </td>
                        </tr>

                        <tr>
                            <th>
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/img/nearest_station.png" alt="">最寄り駅
                            </th>
                            <td>
                                <?php the_field('nearest_station'); ?>
                            </td>
                        </tr>

                        <tr>
                            <th>
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/img/age.png" alt="">対象
                            </th>
                            <td>
                                <?php the_field('age_text'); ?></span><br>
                                <?php if (get_field('limit')): ?>
                                    <span class="food_itemData">
                                        【人数制限：<?php the_field('limit'); ?>】</span>
                                <?php endif; ?>
                            </td>
                        </tr>

                        <tr>
                            <th>
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/img/fare.png" alt="">参加費
                            </th>
                            <td>
                                <?php the_field('fare'); ?>
                            </td>
                        </tr>

                        <tr>
                            <th>
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/img/inquiry.png" alt="">問い合わせ
                            </th>
                            <td>
                                <?php if (get_field('inquiry')): ?><span><?php the_field('inquiry') ?></span>
                                <?php else: ?>
                                    <span>-</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <tr>
                            <?php if (get_field('toilet') || get_field('clothes') || get_field('bento') || get_field('eve_contactor') || get_field('eve_contact') || get_field('tel') || get_field('fax') || get_field('email') || get_field('remarks')): ?>

                                <th>
                                    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/remarks.png" alt="">その他
                                </th>
                                <td>
                                    <?php if (get_field('toilet')): ?>
                                        <span>トイレ▶&nbsp;<?php the_field('toilet'); ?></span><br>
                                    <?php endif; ?>


                                    <?php if (get_field('rental')): ?>
                                        <span>車椅子貸出▶&nbsp;<?php the_field('rental'); ?></span><br>
                                    <?php endif; ?>


                                    <?php if (get_field('clothes')): ?>
                                        <span>着替え▶&nbsp;<?php the_field('clothes'); ?></span><br>
                                    <?php endif; ?>


                                    <?php if (get_field('bento')): ?>
                                        <span>お弁当の用意▶&nbsp;<?php the_field('bento'); ?></span><br>
                                    <?php endif; ?>

                                </td>
                        </tr>


                        <tr>
                            <th>
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/img/other.png" alt="">特記事項
                            </th>
                            <td>
                                <?php if (get_field('remarks')): ?><span><?php the_field('remarks') ?></span>
                                <?php else: ?>
                                    <span>-</span>
                                <?php endif; ?>
                            </td>
                        </tr>

                        <tr>
                            <th>
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/img/management.png" alt="">運営管理
                            </th>
                            <td>
                                <?php if (get_field('management')): ?><span><?php the_field('management') ?></span>
                                <?php else: ?>
                                    <span>-</span>
                                <?php endif; ?>
                            </td>
                        </tr>

                    <?php endif; ?>
                    </table>


                    <!-- こだわりタクソノミーを取得して表示 -->
                    <ul class="event_icon_wrap">

                        <?php
                        $terms = get_the_terms(get_the_ID(), 'other');
                        if (!empty($terms) && !is_wp_error($terms)) {
                            // echo '<p class="event-taxonomy">';
                            foreach ($terms as $term) {

                                echo '<li class="event_icon_item ' . esc_attr($term->slug) . '">';

                                echo '<span >' . esc_html($term->name) . '</span>';
                                echo '</li> ';
                            }
                            // echo '</p>';
                            // print_r($term);
                        }
                        ?>

                    </ul>
                    <!-- イベントタイトルのチラシ 存在する時のみ表示 -->
                    <div class="event_pdf">
                        <span>イベントのチラシはこちら▶</span>
                        <a target="_blank" href="<?php the_field('flier01'); ?>">ダウンロード</a>
                    </div>

                </section>

                <!-- 会場マップ -->
                <section>
                    <h3 class="sub_title">会場マップ</h3>
                    <div class="map">
                        <?php echo get_field('map'); ?>
                    </div>
                </section>

                <!-- 参加者様からの感想 -->
                <section>
                    <!-- <h3 class="sub_title">参加者様からの感想</h3> -->

                    <!-- クチコミ投稿フォーム -->
                    <!-- <h3 class="sub_title">クチコミを投稿する</h3> -->

                    <?php comments_template(); ?>



                </section>




                <div class="event_entry_wrap">
                    <?php if (get_field('links')) : ?>
                        <a class="event_entry_btn" target="_blank" href="<?php the_field('links'); ?>"><span>お問い合わせ・<br>お申し込みはこちら</span></a>
                        <p><span>※イベントページに飛びます。</span></p>
                    <?php endif; ?>
                </div>
            <?php endwhile; ?>
        <?php endif; ?>


        <!-- 区切り線 -->
        <div class="section_line"></div>

        <section>

            <?php
            //おすすめイベントを表示する2.26作成中
            $args = [
                "post_type" => "event", //投稿記事だけを指定
                "posts_per_page" => 3, //最新記事を３件表示
                "post__not_in" => [get_the_ID()], //現在表示している記事のIDは表示しない

            ];
            $latest_query = new WP_Query($args);
            if ($latest_query->have_posts()):
            ?>

                <h3 class="sub_title">開催予定のイベント</h3>

                <div>
                    <ul class="top_event_list">

                        <!-- イベントカード型 -->
                        <?php while ($latest_query->have_posts()): ?>
                            <?php $latest_query->the_post(); ?>
                            <?php get_template_part("template-parts/loop", "event");
                            ?>
                        <?php endwhile; ?>
                        <?php wp_reset_postdata(); ?>

                    </ul>
                </div>
            <?php endif; ?>


            <!-- ボタン -->
            <div class="event_btn_wrap">
                <a class="event_btn" href="<?php echo home_url("column"); ?>">イベント一覧へ</a>
            </div>

        </section>


        <!-- 区切り線 -->
        <div class="section_line"></div>

        <section>

            <h3 class="sub_title">関連コラム記事</h3>
            <div class="event_column_list">

                <?php
                $args = [
                    "post_type" => "column",
                    "posts_per_page" => 3, //3つ表示

                ];

                $the_query = new WP_Query($args);
                if ($the_query->have_posts()): ?>
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
                <?php endif; ?>

        </section>

        <!-- 区切り線 -->
        <div class="section_line"></div>


        <div class="event_entry_wrap">
            <?php if (get_field('links')) : ?>
                <a class="event_entry_btn" target="_blank" href="<?php the_field('links'); ?>"><span>お問い合わせ・<br>お申し込みはこちら</span></a>
                <p><span>※イベントページに飛びます。</span></p>
            <?php endif; ?>
        </div>

    </div>


</main>


<!-- フッターを読み込む -->
<?php get_footer(); ?>
