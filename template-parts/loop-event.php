<div class="card_wrap">

    <!-- ブックマーク機能 -->
    <div class="card_bookmark"><?php echo get_favorites_button(get_the_ID());
                                ?></div>


    <!-- 「あと○日」 -->

    <?php
    // カスタムフィールド 'date_start' からイベント開催日を取得し、「$date_start_box」に格納
    $date_start_box = get_post_meta(get_the_ID(), 'date_start', true);

    // 開催日が設定されていれば実行
    if ($date_start_box) {
        // 今日の日付と開催日を DateTime で比較
        $today = new DateTime();                 // 今日の日付
        $date_start = new DateTime($date_start_box);  // 開催日を取得し、「DateTime」オブジェクトに変換
        $date_start->modify('-1 day');              // 開催日の一日前に変更する



        // 15日前～1日前までカウントダウンしたラベルを表示
        for ($i = 15; $i >= 1; $i--) {
            // 開催日から $i 日前の日付を計算

            $date_start_box_minus_i_days = new DateTime($date_start_box);
            $date_start_box_minus_i_days->modify('-' . $i . ' day');


            // 開催日の前日と今日が一致したら「残り一日」ラベルを表示
            if ($today->format('Y-m-d') === $date_start_box_minus_i_days->format('Y-m-d')) {
                echo '<div class="card_countdown">';
                echo '<span class="label-remaining-one-day">あと</span><span class="card_countdownno">' . $i . '</span><span class="label-remaining-one-day">日</span>';
                echo '</div>';
                break; // 一度表示したらループを終了
            }
        }
    }
    ?>


    <?php
    // カスタムフィールド 'date_start' からイベント開催日を取得し、「$date_start_box」に格納
    $date_end_box = get_post_meta(get_the_ID(), 'date_end', true);

    // 開催日が設定されていれば実行
    if ($date_end_box) {
        // 今日の日付と開催日を DateTime で比較
        $today = new DateTime();                        // 今日の日付
        $date_end = new DateTime($date_end_box);     // 開催日を DateTime オブジェクトに変換

        // 開催日が過ぎた場合は「終了」を表示
        if ($today > $date_end) {
            echo '<div class="card_past">';
            echo '<span class="label-ended">終了</span>';
            echo '</div>';
        }
    }
    ?>



    <!-- カード本体（aタグ） -->
    <a class="card_shape" href="<?php the_permalink(); ?>">
        <div class="card_inner">
            <div>
                <?php if (has_post_thumbnail()) : ?>
                    <!-- アイキャッチ画像があった場合は、表示 -->
                    <?php the_post_thumbnail('medium'); ?>
                <?php else : ?>
                    <!-- アイキャッチ画像が設定していない場合は、noimage.pngを表示 -->
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/common/noimage.png" alt="">
                <?php endif; ?>
            </div>


            <div class="card_text">
                <h3><?php the_title(); ?></h3>

                <div class="card_line"></div>
                <div class="card_linefeed">
                    <span class="card_subtitle">開催日</span>

                    <span><?php the_field('date_start'); ?></span>

                </div>

                <div class="card_linefeed">
                    <span class="card_subtitle">申込締切</span>

                    <span><?php the_field('closing'); ?></span>

                </div>


                <div class="card_linefeed">
                    <span class="card_subtitle">会場名</span>
                    <div>
                        <?php if (get_field('address')): ?>
                            <span><?php the_field('address') ?></span>
                        <?php else: ?>
                            <span>-</span>
                        <?php endif; ?>
                    </div>
                </div>


                <div class="card_linefeed">
                    <span class="card_subtitle">対象学年</span>
                    <div>
                        <span><?php the_field('age_text') ?></span>
                    </div>
                </div>


                <!-- 開催地域タクソノミーを取得して表示 -->
                <!-- <?php if (!is_search()): ?> -->
                    <!-- サーチ画面では除外 -->
                    <?php

                    // area情報を取得
                    $terms = get_the_terms(get_the_ID(), 'area');
                    // area情報があるか確認
                    if (!empty($terms) && !is_wp_error($terms)) {
                        foreach ($terms as $term) {
                            echo '<div class="card_tag">';
                            echo '<p class="event-taxonomy">';
                            echo '<span class="taxonomy-badge">#' . esc_html($term->name) . '</span>';
                            echo '</p>';
                            echo '</div>';
                        }
                    }
                    ?>
                <!-- <?php endif; ?> -->


                <!-- 開催時期タクソノミーを取得して表示 -->
                <!-- <?php if (!is_search()): ?> -->
                    <!-- サーチ画面では除外 -->
                    <?php
                    // area情報を取得
                    $terms = get_the_terms(get_the_ID(), 'vacation');
                    // area情報があるか確認
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
                    ?>
                <!-- <?php endif; ?> -->


            </div>
        </div>
    </a>
</div>
