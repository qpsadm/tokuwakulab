<!-- ヘッダーの読み込み -->
<?php get_header(); ?>

<main>


    <?php if (have_posts()): ?>
        <?php while (have_posts()): ?>
            <?php the_post(); ?>

            <section class="section">
                <div class="section_inner">

                    <div class="food">
                        <div class="food_body">
                            <div class="food_text">
                                <h2 class="heading heading-primary"><?php the_title(); ?></h2>


                                <!-- 主催団体タクソノミーを取得して表示 -->
                                <br>

                                <?php
                                $terms = get_the_terms(get_the_ID(), 'org_tax');
                                if (!empty($terms) && !is_wp_error($terms)) {
                                    echo '<p class="event-taxonomy">';
                                    foreach ($terms as $term) {

                                        echo '<span class="taxonomy-badge">' . esc_html($term->name) . '</span> ';
                                    }
                                    echo '</p>';
                                }
                                ?>

                                <br>




                                <div class="food_content">

                                    <?php the_content(); ?>

                                </div>
                            </div>

                            <!-- 写真 -->
                            <?php
                            $pic = get_field('image01');
                            //大サイズの画像のURL
                            $pic_url = $pic['sizes']['large'];
                            ?>
                            <img src="<?php echo $pic_url; ?>" alt="">

                            <!-- 「image02」「image03」「image04」は写真がある場合のみ表示 -->

                            <?php
                            $pic = get_field('image02');
                            if (!empty($pic)) {
                                //大サイズの画像のURL
                                $pic_url = $pic['sizes']['large'];

                                echo '<img src="' . esc_url($pic_url) . '" alt="">';
                            }
                            ?>

                            <?php
                            $pic = get_field('image03');
                            if (!empty($pic)) {
                                //大サイズの画像のURL
                                $pic_url = $pic['sizes']['large'];

                                echo '<img src="' . esc_url($pic_url) . '" alt="">';
                            }
                            ?>

                            <?php
                            $pic = get_field('image04');
                            if (!empty($pic)) {
                                //大サイズの画像のURL
                                $pic_url = $pic['sizes']['large'];

                                echo '<img src="' . esc_url($pic_url) . '" alt="">';
                            }
                            ?>

                        </div>

                        <!-- イベント本文 -->
                        <?php the_field('overview'); ?>

                        <h3>基本情報</h3>

                        <ul class="food_list">
                            <li class="food_item">
                                <span class="food_itemLabel">開催日時</span>
                                <span class="food_itemData"><?php the_field('date_start'); ?>～<?php the_field('date_end'); ?></span>
                            </li>

                            <li class="food_item">
                                <span class="food_itemLabel">会場名</span>
                                <span class="food_itemData"><?php the_field('address'); ?></span>
                            </li>

                            <li class="food_item">
                                <span class="food_itemLabel">対象年齢</span>
                                <span class="food_itemData"><?php the_field('age_text'); ?></span>
                            </li>

                            <li class="food_item">
                                <span class="food_itemLabel">参加費</span>
                                <span class="food_itemData"><?php the_field('fare'); ?></span>
                            </li>

                            <li class="food_item">
                                <span class="food_itemLabel">会場名</span>
                                <span class="food_itemData"><?php the_field('address'); ?></span>
                            </li>

                        </ul>










                        <!-- タクソノミーを取得して表示 -->
                        <br>

                        <?php
                        $terms = get_the_terms(get_the_ID(), 'other');
                        if (!empty($terms) && !is_wp_error($terms)) {
                            echo '<p class="event-taxonomy">';
                            foreach ($terms as $term) {

                                echo '<span class="taxonomy-badge">' . esc_html($term->name) . '</span> ';
                            }
                            echo '</p>';
                        }
                        ?>

                        <br>






                    </div>

                </div>
            </section>

        <?php endwhile; ?>
    <?php endif; ?>



</main>


<!-- フッターを読み込む -->
<?php get_footer(); ?>
