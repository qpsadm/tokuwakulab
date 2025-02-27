<?php get_header(); ?>

<main>
    <div class="section">
        <div class="section_inner">
            <?php if (have_posts()): ?>
            <?php while (have_posts()): ?>
            <?php the_post(); ?>

            <article id="post-<?php the_ID(); ?>" <?php post_class("post"); ?>>
                <header class="section_header">
                    <h1 class="heading heading-primary"><?php the_title(); ?></h1>
                </header>
                <div class="post_content">
                    <p><time datetime="<?php the_time("Y-m-d"); ?>">更新日：<?php the_time("Y年n月d日(l)"); ?> </time></p>
                    <div class="content">
                        <?php the_content(); ?>
                    </div>
                    <?php //comments_template();
                            ?>
                </div>
                <footer class="post_footer">
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
                                <span><?php echo get_the_title($previous_post); ?>前の記事へ</span>
                            </a>
                        </div>
                        <?php endif; ?>
                        <?php
                                $next_post = get_next_post();
                                if ($next_post): ?>
                        <div class="prevNext_item prevNext_item-next">
                            <a href="<?php the_permalink($next_post); ?>">
                                <span><?php echo get_the_title($next_post); ?>次の記事へ</span>
                                <svg width="20" height="38" viewBox="0 0 20 38">
                                    <path d="M1832,1515l19,19L1832,1553" transform="translate(-1832 -1514)" fill="none" stroke="#224163" stroke-width="1" />
                                </svg>
                            </a>
                        </div>
                        <?php endif; ?>

                    </div><a href="<?php echo home_url(""); ?>">一覧へ</a>
                </footer>
            </article>
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
                </div>
            </section>
        </div>
    </div>
</main>

<?php get_footer(); ?>
