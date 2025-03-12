<a class="orgcard_wrap" href="<?php the_permalink(); ?>">
    <div class="orgcard_inner">
        <div>
            <?php if (has_post_thumbnail()) : ?>
                <!-- アイキャッチ画像があった場合は、表示 -->
                <?php the_post_thumbnail('medium'); ?>
            <?php else : ?>
                <!-- アイキャッチ画像が設定していない場合は、noimage.pngを表示 -->
                <img src="<?php echo get_template_directory_uri(); ?>/assets/img/noimage.png" alt="">
            <?php endif; ?>
        </div>

        <div class="orgcard_text">
            <h3>
                <h3>
                    <!-- タイトルの表示を29文字に制限 -->
                    <?php if (mb_strlen($post->post_title) > 26) {
                        $title = mb_substr($post->post_title, 0, 26);
                        echo $title . '...';
                    } else {
                        echo $post->post_title;
                    } ?>
                </h3>
            </h3>
            <div class="orgcard_line">
            </div>
            <div>
                <span class="orgcard_subtitle">所在地</span>
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
            <span class="orgcard_subtitle">電話番号</span>
            <div>
                <span>
                    <?php the_field('tel'); ?>
                </span>
            </div>
            <!-- <?php if (get_field('hour')): ?> -->
            <div>
                <span class="orgcard_subtitle">営業時間</span>
                <div>
                    <span>
                        <?php
                        $age = get_field('hour'); // カスタムフィールドの値を取得
                        if ($age) { // 値が存在するかチェック
                            if (mb_strlen($age) > 29) {
                                echo mb_substr($age, 0, 29) . '...';
                            } else {
                                echo $age;
                            }
                        } ?>
                    </span>
                </div>
            </div>
            <!-- <?php endif; ?> -->
        </div>
    </div>
</a>
