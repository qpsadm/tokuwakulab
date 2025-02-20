<div class="foodCard">
    <a href="<?php the_permalink(); ?>">

        <!-- オススメ -->
        <?php if (get_field('recommend')) : ?>
            <span class="foodCard_label">オススメ</span>
        <?php endif; ?>

        <div class="foodCard_pic">

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
            <p class="foodCard_price"><?php the_field('price'); ?></p>
        </div>
    </a>
</div>
