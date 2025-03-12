<a class="cardlist_wrap" href="<?php the_permalink(); ?>">
        <div class="cardlist_inner">
            <div class="cardlist_flex">
                <?php if (has_post_thumbnail()) : ?>
                    <!-- アイキャッチ画像があった場合は、表示 -->
                    <?php the_post_thumbnail('medium'); ?>
                <?php else : ?>
                    <!-- アイキャッチ画像が設定していない場合は、noimage.pngを表示 -->
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/noimage.png" alt="">
                <?php endif; ?>
                <div class="cardlist_toptext">
                    <span><time datetime="<?php the_time('Y-m-d'); ?>"><?php the_time('Y/m/d(D)'); ?></time></span>
                    <h3>
                        <!-- タイトルの表示を14文字に制限 -->
                        <?php if (mb_strlen($post->post_title) > 11) {
                            $title = mb_substr($post->post_title, 0, 11);
                            echo $title . '...';
                        } else {
                            echo $post->post_title;
                        } ?>
                    </h3>

                    <div class="cardlist_line"></div>

                    <!-- タクソノミーを取得して表示 -->
                    <div>
                        <?php
                        $terms = get_the_terms(get_the_ID(), 'column_type');
                        if (!empty($terms) && !is_wp_error($terms)) {
                            foreach ($terms as $term) {

                                //タクソノミー一覧ページに飛ぶリンクを付ける
                                echo '<div class="cardlist_tag">'. esc_html($term->name). '</div>';
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </a>
</a>
