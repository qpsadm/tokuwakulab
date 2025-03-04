<div class="cardlist_wrap">
    <a href="<?php the_permalink(); ?>">
        <div class="cardlist_inner">
            <div class="cardlist_flex">
                <?php if (has_post_thumbnail()) : ?>
                <!-- アイキャッチ画像があった場合は、表示 -->
                <?php the_post_thumbnail('medium'); ?>
                <?php else : ?>
                <!-- アイキャッチ画像が設定していない場合は、noimage.pngを表示 -->
                <img src="<?php echo get_template_directory_uri(); ?>/assets/img/common/noimage.png" alt="">
                <?php endif; ?>
                <div class="cardlist_toptext">
                    <span><time datetime="<?php the_time('Y-m-d'); ?>"><?php the_time('Y年m月d日'); ?></time></span>
                    <h3>
                        <!-- タイトルの表示を10文字に制限 -->
                        <?php if (mb_strlen($post->post_title) > 10) {
                            $title = mb_substr($post->post_title, 0, 10);
                            echo $title . '...';
                        } else {
                            echo $post->post_title;
                        } ?>
                    </h3>

                    <div class="cardlist_line"></div>

                    <!-- タクソノミーを取得して表示 -->
                    <div class="">
                        <?php
                        $terms = get_the_terms(get_the_ID(), 'column_type');
                        if (!empty($terms) && !is_wp_error($terms)) {
                            echo '<p class="cardlist_tag">';
                            foreach ($terms as $term) {

                                //タクソノミー一覧ページに飛ぶリンクを付ける
                                echo '<a href="' . esc_url(get_term_link($term)) . '" class="taxonomy-badge">#' . esc_html($term->name) . '</a> ';
                            }
                            echo '</p>';
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </a>
</div>