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
                                <span class="food_itemLabel">その他</span>
                                <span class="food_itemData"></span>
                            </li>

                        </ul>

                        <!-- こだわりタクソノミーを取得して表示 -->
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
                        <span class="food_itemLabel"><?php the_title(); ?>のチラシ</span>
                        <a href="<?php the_field('pdf'); ?>"><span class="food_itemData">【 ダウンロード 】</span></a>
                        <br>

                        <h3>会場マップ</h3>

                        <?php the_field('map'); ?>


                    </div>

                </div>
            </section>

        <?php endwhile; ?>
    <?php endif; ?>



    <?php
    //おすすめイベントを表示する2.26作成中
    $args = [
        "post_type" => "event", //投稿記事だけを指定
        "posts_per_page" => 3, //最新記事を３件表示
        "post__not_in" => [get_the_ID()], //現在表示している記事のIDは表示しない

    ];
    $latest_query = new WP_Query($args);
    if ($latest_query->have_posts()):
    ?>
        <section class="latest">
            <header class="latest_header">
                <h2 class="heading-secondary">おすすめイベント</h2>
            </header>
            <div class="latest_body">
                <div class="cardList">
                    <?php while ($latest_query->have_posts()): ?>
                        <?php $latest_query->the_post(); ?>
                        <?php get_template_part("template-parts/loop", "news");
                        ?>
                    <?php endwhile; ?>
                    <?php wp_reset_postdata(); ?>

                </div>
            </div>
        </section>
    <?php endif; ?>
    <section>
        <div class="section_inner">
            <div class="section_header">
                <h2 class="heading heading-primary">関連記事</h2>
            </div>
            <?php
            //関連記事作成中2.26(コラムに変更済2.27)
            //$faq_terms = get_terms(["taxonomy" => "faq_tax"]); //配列で取得する
            //if (!empty($faq_terms)): //空白でなければ
            ?>
            <?php //foreach ($faq_terms as $faq):
            ?>
            <section class="section_body">
                <h3 class="heading heading-secondary"><?php //echo $faq->name
                                                        ?></h3>
                <ul class="">
                    <?php
                    $args = [
                        "post_type" => "column",
                        "posts_per_page" => 3, //3つ表示

                    ];
                    // $taxquerysp = ["relation" => "AND"];
                    // $taxquerysp[] = [
                    //     "taxonomy" => "faq_tax",
                    //     "terms" => "$faq->slug",
                    //     "field" => "slug",
                    // ];
                    // $args["tax_query"] = $taxquerysp;
                    $the_query = new WP_Query($args);
                    if ($the_query->have_posts()): ?>
                        <?php while ($the_query->have_posts()): ?>
                            <?php $the_query->the_post(); ?>
                            <li class="">
                                <div class="">
                                    <h4 class="foodCard_title"><?php the_title(); ?></h4>
                                    <p><?php //the_field("question");
                                        ?></p>
                                    <p><?php //the_field("answer");
                                        ?></p>
                                </div>
                            </li>
                        <?php endwhile; ?>
                        <?php wp_reset_postdata(); ?>
                    <?php endif; ?>
                </ul>
            </section>
            <?php //endforeach;
            ?>
            <?php //endif;
            ?>


</main>


<!-- フッターを読み込む -->
<?php get_footer(); ?>
