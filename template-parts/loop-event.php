<div class="foodCard">
    <a href="<?php the_permalink(); ?>">


        <div class="foodCard_pic">




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
                        echo '<span class="label-remaining-one-day">残り' . $i . '日</span>';
                        break; // 一度表示したらループを終了
                    }
                }
            }
            ?>



            <?php if (has_post_thumbnail()) : ?>
                <!-- アイキャッチ画像があった場合は、表示 -->
                <?php the_post_thumbnail('medium'); ?>
            <?php else : ?>
                <!-- アイキャッチ画像が設定していない場合は、noimage.pngを表示 -->
                <img src="<?php echo get_template_directory_uri(); ?>/assets/img/common/noimage.png" alt="">
            <?php endif; ?>
        </div>

        <div class="foodCard_body">
            <h4 class="foodCard_title"><?php the_title(); ?></h4>

            <br>
            <span>開催日</span><?php the_field('date_start'); ?>
            <br>
            <span>申込締切</span><?php the_field('closing'); ?>
            <br>
            <span>会場名</span><?php the_field('address') ?>
            <br>
            <span>対象学年</span><?php the_field('age_text') ?>

        </div>

    </a>

    <!-- タクソノミーを取得して表示 -->
    <br>

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
