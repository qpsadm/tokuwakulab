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

                                <br>


                                <div class="food_content">

                                    <?php the_content(); ?>

                                </div>
                            </div>

                            <!-- <div class="food_pic"> -->


                            <!-- 写真 -->
                            <?php
                            //$pic = get_field('pic');

                            // print_r=($pic); ????

                            //$pic_url = $pic['sizes']['large']; //大サイズの画像のURL
                            ?>
                            <img src="<?php //echo $pic_url;
                                        ?>" alt="">


                            <!-- </div> -->

                        </div>

                        <ul class="food_list">
                            <li class="food_item">
                                <span class="food_itemLabel">関連リンク</span>
                                <a href="<?php the_field('url'); ?>"><span class="food_itemData"><?php the_field('url'); ?></span></a>
                            </li>

                        </ul>




                        




                    </div>

                </div>
            </section>

        <?php endwhile; ?>
    <?php endif; ?>








</main>











<!-- フッターを読み込む -->
<?php get_footer(); ?>
