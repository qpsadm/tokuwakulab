<?php get_header(); ?>

<main class="pc_space">
    <!-- ページタイトル -->
    <section class="page_top">
        <h2 class="page_title">主催団体詳細</h2>
    </section>
    <!-- パンくずリスト -->
    <?php get_template_part('template-parts/breadcrumb'); ?>

    <div class="inner">
        <?php if (have_posts()): ?>
            <?php while (have_posts()) : the_post(); ?>
                <section class="org_top">
                    <h2 class="org_name"><?php the_title(); ?></h2>
                    <!-- キービジュアル -->
                    <div class="top_kv_wrap">
                        <ul class="slider_kv">
                            <li><?php
                                $pic = get_field('image01');
                                $pic_url = $pic['url'];
                                ?>
                                <img src="<?php echo $pic_url; ?>" alt="キービジュアル">
                            </li>
                            <?php if (get_field('image02')): ?>
                                <li><?php
                                    $pic = get_field('image02');
                                    $pic_url = $pic['url'];
                                    ?>
                                    <img src="<?php echo $pic_url; ?>" alt="キービジュアル">
                                </li>
                            <?php endif; ?>
                            <?php if (get_field('image03')): ?>
                                <li><?php
                                    $pic = get_field('image03');
                                    $pic_url = $pic['url'];
                                    ?>
                                    <img src="<?php echo $pic_url; ?>" alt="キービジュアル">
                                </li>
                            <?php endif; ?>
                            <?php if (get_field('image04')): ?>
                                <li>
                                    <?php
                                    $pic = get_field('image04');
                                    $pic_url = $pic['url'];
                                    ?>
                                    <img src="<?php echo $pic_url; ?>" alt="キービジュアル">
                                </li><?php endif; ?>
                        </ul>
                    </div>

                    <!-- 団体紹介文 -->
                    <div class="org_description">
                        <p><?php the_field('info'); ?></p>
                    </div>
                </section>

                <div class="section_line"></div>
                <!-- 主催団体の基本情報 -->
                <section>
                    <h3 class="sub_title"><?php the_title(); ?>の基本情報</h3>
                    <table class="org_table">
                        <tr>
                            <th>団体名</th>
                            <td><?php the_title(); ?></td>
                        </tr>

                        <tr>
                            <th>代表者名</th>
                            <td><?php the_field('name'); ?></td>
                        </tr>

                        <tr>
                            <th>郵便番号</th>
                            <td><?php the_field('postcode'); ?></td>
                        </tr>
                        <tr>
                            <th>所在地</th>
                            <td><?php the_field('address'); ?></td>
                        </tr>
                        <tr>
                            <th>電話番号</th>
                            <td><?php the_field('tel'); ?></td>
                        </tr>
                        <tr>
                            <th>営業時間</th>
                            <td><?php the_field('hour'); ?></td>
                        </tr>
                        <tr>
                            <th>FAX</th>
                            <td><?php the_field('fax'); ?></td>
                        </tr>
                        <tr>
                            <th>メールアドレス</th>
                            <td><?php the_field('email'); ?></td>
                        </tr>
                        <tr>
                            <th>URL</th>
                            <td><a target="_brank" href="<?php the_field('url'); ?>"><?php the_field('url'); ?></a></td>
                        </tr>

                        <!-- SNSは入力がない場合は表示しない -->
                        <!-- インスタ -->
                        <?php if (get_field('instagram')): ?>
                            <tr>
                                <th>Instagram</th>
                                <td><a target="_brank" href="<?php the_field('instagram'); ?>"><?php the_field('instagram'); ?></a></td>
                            </tr>
                        <?php endif; ?>
                        <!-- X -->
                        <?php if (get_field('x')): ?>
                            <tr>
                                <th>X</th>
                                <td><a target="_brank" href="<?php the_field('x'); ?>"><?php the_field('x'); ?></a></td>
                            </tr>
                        <?php endif; ?>
                        <!-- facebook -->
                        <?php if (get_field('facebook')): ?>
                            <tr>
                                <th>facebook</th>
                                <td><a target="_brank" href="<?php the_field('facebook'); ?>"><?php the_field('facebook'); ?></a></td>
                            </tr>
                        <?php endif; ?>

                        <!-- Line -->
                        <?php if (get_field('line')): ?>
                            <tr>
                                <th>LINE</th>
                                <td><a target="_brank" href="<?php the_field('line'); ?>"><?php the_field('line'); ?></a></td>
                            </tr>
                        <?php endif; ?>

                        <!-- Youtube -->
                        <?php if (get_field('youtube')): ?>
                            <tr>
                                <th>Youtube</th>
                                <td><a target="_brank" href="<?php the_field('youtube'); ?>"><?php the_field('youtube'); ?></td>
                            </tr>
                        <?php endif; ?>
                        <tr>
                            <th>備考</th>
                            <td><?php the_field('remarks'); ?></td>
                        </tr>

                    </table>
                </section>
            <?php endwhile; ?>
        <?php endif; ?>

        <div class="section_line"></div>

        <!-- マップ -->
        <section>
            <h3 class="sub_title">所在地マップ</h3>
            <div class="map">
                <?php echo get_field('map'); ?>
            </div>
        </section>
        <div class="section_line"></div>

        <!-- 開催予定イベント３件表示 -->
        <section>
            <h3 class="sub_title">開催予定のイベント</h3>

            <?php

            // サブクエリ
            $args = [
                'post_type' => 'event',
                'posts_per_page' => 3,
                'meta_key'       => 'date_start', // ソート基準となるカスタムフィールド
                'orderby'        => 'meta_value', // カスタムフィールドの値で並び替え
                'order'          => 'DESC',    // 降順（新しい順）
            ];

            $the_query = new WP_Query($args);

            ?>
            <ul class="top_event_list">
                <!-- イベントループの開始 -->
                <?php if ($the_query->have_posts()) : ?>
                    <?php while ($the_query->have_posts()) : ?>
                        <?php $the_query->the_post(); ?>

                        <li>
                            <!-- テンプレートパーツloop-event.phpを読み込む -->
                            <?php get_template_part('template-parts/loop', 'event') ?>
                        </li>

                        <!-- WordPress ループの終了 -->
                    <?php endwhile; ?>

                    <?php wp_reset_postdata(); ?>
                <?php endif; ?>
            </ul>

            <div class="btnwrap_wrap">
                <a href="<?php echo home_url("/event/"); ?>" class="btn_wrap">イベント一覧へ</a>
            </div>
        </section>

        <div class="section_line"></div>

        <!-- 過去開催イベントのタイトル表示 -->
        <section class="column_content_wrap">
            <h3 class="sub_title"><?php the_title(); ?>の過去開催イベント</h3>
            <div class="column_recomend_list">
                <?php
                $today = date('Y-m-d'); // 今日の日付を取得

                // 現在の投稿の ID を取得
                $current_post_id = get_the_ID();

                $args = [
                    'post_type'      => 'event',
                    'posts_per_page' => 3, //3件表示
                    'meta_query'     => [
                        'relation' => 'AND',
                        [
                            'key'     => 'date_start',
                            'value'   => $today,
                            'compare' => '<', // 今日より前のデータのみ取得
                            'type'    => 'DATE' // 日付として比較
                        ],
                        [
                            'key'     => 'org_id', // org_id の一致条件
                            'value'   => $current_post_id,
                            'compare' => '='
                        ]
                    ],
                    'meta_key'  => 'date_start', // ソート基準となるカスタムフィールド
                    'orderby'   => 'meta_value', // カスタムフィールドの値で並び替え
                    'order'     => 'ASC' // 昇順（古い順）
                ];

                $related_post = new WP_Query($args);

                // 投稿があるかチェック
                if ($related_post->have_posts()) {
                    while ($related_post->have_posts()) {
                        $related_post->the_post(); ?>
                        <span><?php the_field("date_start"); ?></span>
                        <a href="<?php the_permalink(); ?>">
                            <span><?php the_title(); ?></span>
                        </a>
                <?php }
                } else {
                    // 関連投稿がない場合のメッセージ
                    echo '<p>過去開催イベントはありません。</p>';
                }

                // WP_Query のリセット
                wp_reset_postdata();
                ?>
            </div>
        </section>
        <div class="section_line"></div>

        <!-- 関連コラム記事３件タイトルのみ表示 -->
        <section class="column_content_wrap">

            <h3 class="sub_title">関連コラム記事</h3>
            <div class="column_recomend_list">
                <?php
                $args = [
                    "post_type" => "column", //コラム記事
                    'posts_per_archive_page' => 3, //3件表示
                    'orderby' => 'rand', //ランダム

                ];
                $the_query = new WP_Query($args);
                if ($the_query->have_posts()): ?>
                    <?php while ($the_query->have_posts()): ?>
                        <?php $the_query->the_post(); ?>
                        <span><time datetime="<?php the_time('Y/m/d'); ?>"><?php the_time('Y/m/d/(l)'); ?></time></span>
                        <a href="<?php the_permalink(); ?>">
                            <span><?php the_title(); ?></span></a>

                    <?php endwhile; ?>
                    <?php wp_reset_postdata(); ?>
                <?php endif; ?>
            </div>

        </section>

        <div class="btnwrap_wrap">
            <a href="<?php echo home_url("/column/"); ?>" class="btn_wrap">コラム一覧へ</a>
        </div>

        <div class="section_line"></div>

    </div>
</main>

<?php get_footer(); ?>
