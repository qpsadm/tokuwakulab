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
            <time datetime="<?php the_time('Y-m-d'); ?>"><?php the_time('Y年m月d日'); ?></time>





        </div>

    </a>

    <!-- タクソノミーを取得して表示 -->
    <br>

    <?php
    $terms = get_the_terms(get_the_ID(), 'column_type');
    if (!empty($terms) && !is_wp_error($terms)) {
        echo '<p class="column-taxonomy">';
        foreach ($terms as $term) {

            //タクソノミー一覧ページに飛ぶリンクを付ける
            echo '<a href="' . esc_url(get_term_link($term)) . '" class="taxonomy-badge">' . esc_html($term->name) . '</a> ';
        }
        echo '</p>';
    }
    ?>

</div>
