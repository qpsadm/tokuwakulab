<div class="card_wrap">

    <!-- ブックマーク機能 -->
    <div class="card_bookmark"></div>


    <!-- 「あと○日」 -->

    <?php
    // カスタムフィールド 'closing' から締め切り日を取得し、「$closing_date」に格納
    $closing_date = get_post_meta(get_the_ID(), 'closing', true);

    // 締め切り日が設定されていれば実行
    if ($closing_date) {
        // 今日の日付と締め切り日を DateTime で比較
        $today = new DateTime();                 // 今日の日付
        $closing = new DateTime($closing_date);  // 締め切りを取得し、「DateTime」オブジェクトに変換
        $closing->modify('-1 day');              // 締め切り日の一日前に変更する



        // 5日前～1日前までカウントダウンしたラベルを表示
        for ($i = 5; $i >= 1; $i--) {
            // 締め切り日から $i 日前の日付を計算

            $closing_date_minus_i_days = new DateTime($closing_date);
            $closing_date_minus_i_days->modify('-' . $i . ' day');


            // 締め切りの前日と今日が一致したら「残り一日」ラベルを表示
            if ($today->format('Y-m-d') === $closing_date_minus_i_days->format('Y-m-d')) {
                echo '<div class="card_countdown">';
                echo '<span class="label-remaining-one-day">残り</span><span class="card_countdownno">' . $i . '</span><span class="label-remaining-one-day">日</span>';
                echo '</div>';
                break; // 一度表示したらループを終了
            }
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
                    <div>
                        <span><?php the_field('date_start'); ?></span>
                    </div>
                </div>

                <div class="card_linefeed">
                    <span class="card_subtitle">申込締切</span>
                    <div>
                        <span><?php the_field('closing'); ?></span>
                    </div>
                </div>

                <div class="card_linefeed">
                    <span class="card_subtitle">会場名</span>
                    <div>
                        <span><?php the_field('address') ?></span>
                    </div>
                </div>

                <div class="card_linefeed">
                    <span class="card_subtitle">対象学年</span>
                    <div>
                        <span><?php the_field('age_text') ?></span>
                    </div>
                </div>

                <div class="card_tag">
                    <!-- タクソノミーを取得して表示 -->
                    <?php if (!is_search()): ?> <!-- サーチ画面では除外 -->
                        <?php
                        $terms = get_the_terms(get_the_ID(), 'area');
                        if (!empty($terms) && !is_wp_error($terms)) {
                            echo '<p class="event-taxonomy">';
                            foreach ($terms as $term) {

                                echo '<span class="taxonomy-badge">' . esc_html($term->name) . '</span> ';
                            }
                            echo '</p>';
                        }
                        ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </a>
</div>
