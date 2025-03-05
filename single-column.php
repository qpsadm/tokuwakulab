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





                    </div>

                </div>
            </section>

        <?php endwhile; ?>
    <?php endif; ?>


    <div class="post_footer">
        <?php $categories = get_the_category();
        if ($categories):
        ?>
            <div class="category">
                <div class="category_list">
                    <?php foreach ($categories as $category): ?>
                        <div class="category_item"><a href="" class="btn btn-sm is-active"><?php echo $category->name; ?></a></div>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endif; ?>

        <div class="prevNext">
            <?php
            $previous_post = get_previous_post();
            if ($previous_post): ?>
                <div class="prevNext_item prevNext_item-prev">
                    <a href="<?php the_permalink($previous_post); ?>">
                        <svg width="20" height="38" viewBox="0 0 20 38">
                            <path d="M0,0,19,19,0,38" transform="translate(20 38) rotate(180)" fill="none" stroke="#224163" stroke-width="1" />
                        </svg>
                        <span>前の記事へ</span>
                    </a>
                </div>
            <?php endif; ?>
            <?php
            $next_post = get_next_post();
            if ($next_post): ?>
                <div class="prevNext_item prevNext_item-next">
                    <a href="<?php the_permalink($next_post); ?>">
                        <span>次の記事へ</span>
                        <svg width="20" height="38" viewBox="0 0 20 38">
                            <path d="M1832,1515l19,19L1832,1553" transform="translate(-1832 -1514)" fill="none" stroke="#224163" stroke-width="1" />
                        </svg>
                    </a>
                </div>
            <?php endif; ?>

        </div>
        <a href="<?php echo home_url("column"); ?>">一覧へ</a>
    </div>



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

            <h2 class="heading heading-secondary">おすすめイベント</h2>

            <div class="latest_body">
                <div class="cardList">
                    <?php while ($latest_query->have_posts()): ?>
                        <?php $latest_query->the_post(); ?>
                        <?php get_template_part("template-parts/loop", "news");
                        ?>
                    <?php endwhile; ?>
                    <?php wp_reset_postdata(); ?>

                </div>
                <a href="<?php echo home_url("column"); ?>">イベント一覧へ > </a>
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
                        "post_type" => "column", //コラム記事
                        'posts_per_archive_page' => 3, //3件表示
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
                                    <h4 class="foodCard_title">
                                        <a href="<?php the_permalink(); ?>"><time datetime="<?php the_time('Y-m-d'); ?>"><?php the_time('Y-m-d'); ?>-</time><?php the_title(); ?></a>
                                    </h4>
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
