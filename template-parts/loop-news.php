<section id="post-<?php the_ID(); ?>" <?php post_class('cardList_item'); ?>>
    <a href="<?php the_permalink(); ?>" class="card">
        <!-- カテゴリー設定 -->
        <?php $categories = get_the_category(); ?>
        <?php if ($categories) : ?>
            <div class="card_label">
                <?php foreach ($categories as $key => $category) : ?>
                    <span class="label label-black">
                        <!-- カテゴリー出力 -->
                        <?php echo $category->name; ?>
                    </span>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <div class="card_pic">
            <?php if (has_post_thumbnail()) : ?>
                <!-- アイキャッチ画像があった場合は、表示 -->
                <?php the_post_thumbnail('medium'); ?>
            <?php else : ?>
                <!-- アイキャッチ画像が設定していない場合は、noimage.pngを表示 -->
                <img src="<?php echo get_template_directory_uri(); ?>/assets/img/common/noimage.png" alt="">
            <?php endif; ?>

        </div>
        <div class="card_body">
            <h2 class="card_title"><?php the_title(); ?></h2>
            <time datetime="<?php the_time('Y-m-d') ?>">
                <?php the_time('Y年m月d日 H:i:s') ?>
            </time>
        </div>
    </a>
</section>
