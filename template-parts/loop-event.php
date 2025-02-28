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

    <?php if(!is_search()): ?> <!-- サーチ画面では除外 -->
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
