<?php get_header(); ?>

<main class="pc_space">
    <!-- ページタイトル -->
    <section class="page_top">
        <h2 class="page_title">主催団体詳細</h2>
    </section>
    <!-- パンくずリスト -->
    <div class="breadcrumb">
        <span><a href="<?php if (!is_home()) : ?>">
                <?php get_template_part('template-parts/breadcrumb'); ?>
                <?php endif; ?></a>
        </span>
    </div>

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
                    <li><?php
                                $pic = get_field('image02');
                                $pic_url = $pic['url'];
                                ?>
                        <img src="<?php echo $pic_url; ?>" alt="キービジュアル">
                    </li>
                    <li><?php
                                $pic = get_field('image03');
                                $pic_url = $pic['url'];
                                ?>
                        <img src="<?php echo $pic_url; ?>" alt="キービジュアル">
                    </li>
                    <li><?php
                                $pic = get_field('image04');
                                $pic_url = $pic['url'];
                                ?>
                        <img src="<?php echo $pic_url; ?>" alt="キービジュアル">
                    </li>
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
            <h3 class="sub_title">主催団体の基本情報</h3>
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
                    <td><?php the_field('url'); ?></td>
                </tr>
                <tr>
                    <th>Instagram</th>
                    <td><?php the_field('instagram'); ?></td>
                </tr>
                <tr>
                    <th>X</th>
                    <td><?php the_field('x'); ?></td>
                </tr>
                <tr>
                    <th>facebook</th>
                    <td><?php the_field('facebook'); ?></td>
                </tr>
                <tr>
                    <th>LINE</th>
                    <td><?php the_field('line'); ?></td>
                </tr>
                <tr>
                    <th>Youtube</th>
                    <td><?php the_field('Youtube'); ?></td>
                </tr>
                <tr>
                    <th>備考</th>
                    <td><?php the_field('remarks'); ?></td>
                </tr>

                <!-- <li>htmlになかった項目
                            <span>マップ</span>
                            <span>
                                <?php
                                $map = get_field('map');
                                echo $map
                                ?>
                            </span>
                        </li>

                        <li>
                            <span>Youtube</span>
                            <span><?php the_field('youtube'); ?></span>
                        </li> -->


            </table>
        </section>
        <?php endwhile; ?>
        <?php endif; ?>

        <div class="section_line"></div>
        <!-- マップを入れる予定 -->
        <p>map</p>
        <div class="section_line"></div>

        <!-- 開催予定イベント３件表示 -->
        <section>
            <h3 class="sub_title">開催予定のイベント</h3>
            <?php
            $dates = get_upcoming_event_months();
            // URLのパラメータから検索する開催月を取得
            $date1 = get_param_value('date');
            // 初期状態で、開催月が指定されていないので、直近の月を代入する
            if (is_null($date1)) {
                $date1 = $dates[0];
            }
            $date2 = '2025-03-31';
            //echo $date1, '-', $date2;
            ?>

            <?php
            $date1 = isset($_GET['date']) ? $_GET['date'] : null;
            $date2 = $date1 ? date('Y-m-t', strtotime($date1)) : null; // 月末日を取得

            // サブクエリ
            $args = [
                'post_type' => 'event',
                'posts_per_page' => 3,
                'orderby'        => 'date', // 投稿日時でソート
            ];
            $meta_query = ['relation' => 'AND'];

            if ($date1) {
                $meta_query[] = [
                    'key' => 'date_start',
                    'type' => 'DATE',
                    'compare' => 'BETWEEN',
                    'value' => [$date1, $date2],
                ];
            }
            $args['meta_query'] = $meta_query;

            $the_query = new WP_Query($args);

            ?>
            <ul class="top_event_list">
                <!-- イベントループの開始 -->
                <?php if ($the_query->have_posts()) : ?>
                <?php while ($the_query->have_posts()) : ?>
                <?php $the_query->the_post(); ?>

                <li>
                    <!-- テンプレートパーツloop-food.phpを読み込む -->
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
            <h3 class="sub_title">過去開催イベント</h3>
            <div class="column_recomend_list">
                <?php
                $args = [
                    "post_type" => "event", //イベント
                    'posts_per_archive_page' => 3, //3件表示
                ];
                $the_query = new WP_Query($args);
                if ($the_query->have_posts()): ?>
                <?php while ($the_query->have_posts()): ?>
                <?php $the_query->the_post(); ?>
                <span><time datetime="<?php the_time('Y/n/d'); ?>"><?php the_time('Y/n/d/(l)'); ?></time></span>
                <a href="<?php the_permalink(); ?>">
                    <span><?php the_title(); ?></span></a>

                <?php endwhile; ?>
                <?php wp_reset_postdata(); ?>
                <?php endif; ?>
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
                ];
                $the_query = new WP_Query($args);
                if ($the_query->have_posts()): ?>
                <?php while ($the_query->have_posts()): ?>
                <?php $the_query->the_post(); ?>
                <span><time datetime="<?php the_time('Y/n/d'); ?>"><?php the_time('Y/n/d/(l)'); ?></time></span>
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
