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
