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
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/noimage.png" alt="">
                <?php endif; ?>
            </div>


            <div class="card_text">
                <h3>
                    <!-- タイトルの表示を29文字に制限 -->
                    <?php if (mb_strlen($post->post_title) > 29) {
                        $title = mb_substr($post->post_title, 0, 29);
                        echo $title . '...';
                    } else {
                        echo $post->post_title;
                    } ?>
                </h3>
                <div class="card_line"></div>


                <div class="card_linefeed">
                    <span class="card_subtitle">開催日</span>
                    <?php $date_str = get_field('date_start');  ?>
                    <?php $formatted_date = str_replace(
                        ['日曜日', '月曜日', '火曜日', '水曜日', '木曜日', '金曜日', '土曜日'],
                        ['日', '月', '火', '水', '木', '金', '土'],
                        $date_str
                    );
                    echo '<span>' . $formatted_date . '</span>';
                    ?>
                </div>



                <div class="card_linefeed">
                    <span class="card_subtitle">申込締切</span>
                    <?php $date_str = get_field('closing');  ?>
                    <?php $formatted_date = str_replace(
                        ['日曜日', '月曜日', '火曜日', '水曜日', '木曜日', '金曜日', '土曜日'],
                        ['日', '月', '火', '水', '木', '金', '土'],
                        $date_str
                    );
                    echo '<span>' . $formatted_date . '</span>';
                    ?>
                </div>


                <div class="card_linefeed">
                    <span class="card_subtitle">対象学年
                    </span>
                    <span>
                        <?php
                        $age = get_field('age_text'); // カスタムフィールドの値を取得
                        if ($age) { // 値が存在するかチェック
                            if (mb_strlen($age) > 14) {
                                echo mb_substr($age, 0, 14) . '...';
                            } else {
                                echo $age;
                            }
                        } ?>
                        <?php //the_field('age_text');
                        ?>
                    </span>
                </div>

                <div class="card_linefeed">
                    <span class="card_hallname">会場名
                    </span>

                    <span class="card_halltext">
                        <?php
                        $address = get_field('address'); // カスタムフィールドの値を取得
                        if ($address) { // 値が存在するかチェック
                            if (mb_strlen($address) > 29) {
                                echo mb_substr($address, 0, 29) . '...';
                            } else {
                                echo $address;
                            }
                        } ?>
                        <?php //the_field('address');
                        ?>
                    </span>
                </div>

                <div class="card_tag_wrap">

                    <!-- 開催地域タクソノミーを取得して表示 -->
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


                    <!-- 開催時期タクソノミーを取得して表示 -->
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
                </div>

            </div>
        </div>
    </a>
</div>
