<div class="foodCard">
    <a href="<?php the_permalink(); ?>">


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
            <span>所在地</span><?php the_field('address'); ?>
            <br>
            <span>電話番号</span><?php the_field('tel'); ?>
            <br>
            <span>営業時間</span><?php the_field('hour') ?>
            <br>
        </div>
    </a>
</div>
