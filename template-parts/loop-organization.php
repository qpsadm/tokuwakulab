<div class="card_wrap">
    <a href="<?php the_permalink(); ?>">
        <div class="orgcard_shape">
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
                    <div class="orgcard_line">
                    </div>
                    <div>
                        <span class="card_subtitle">所在地</span>
                        <div><span><?php the_field('address'); ?></span>
                        </div>
                    </div>
                    <span class="card_subtitle">電話番号</span>
                    <div>
                        <span>
                            <?php the_field('tel'); ?>
                        </span>
                    </div>
                    <?php if (get_field('hour')): ?>
                    <div>
                        <span class="card_subtitle">営業時間</span>
                        <div>
                            <span>
                                <?php the_field('hour') ?>
                            </span>

                        </div>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </a>
</div>