<?php get_header(); ?>
<main>
    <section class="section section-foodList">
        <div class="section_inner">
            <div class="section_header">
                <h2 class="heading heading-primary">よくある質問</h2>
            </div>
            <?php
            $faq_terms = get_terms(["taxonomy" => "faq_tax"]);//配列で取得する
            if (!empty($faq_terms))://空白でなければ ?>
            <?php foreach ($faq_terms as $faq): ?>
            <section class="section_body">
                <h3 class="heading heading-secondary"><?php echo $faq->name ?></h3>
                <ul class="">
                    <?php
                            $args = [
                                "post_type" => "faq",
                                "posts_per_page" => -1,//全部表示
                            ];
                            $taxquerysp = ["relation" => "AND"];
                            $taxquerysp[] = [
                                "taxonomy" => "faq_tax",
                                "terms" => "$faq->slug",
                                "field" => "slug",
                            ];
                            $args["tax_query"] = $taxquerysp;
                            $the_query = new WP_Query($args);
                            if ($the_query->have_posts()): ?>
                    <?php while ($the_query->have_posts()): ?>
                    <?php $the_query->the_post(); ?>
                    <li class="">
                        <div class="">
                            <h4 class="foodCard_title"><?php the_title(); ?></h4>
                            <p>質問：<?php the_field("question"); ?></p>
                            <p>回答：<?php the_field("answer"); ?></p>
                        </div>
                    </li>
                    <?php endwhile; ?>
                    <?php wp_reset_postdata(); ?>
                    <?php endif; ?>
                </ul>
            </section>
            <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </section>
</main>


<?php get_footer(); ?>
