<?php get_header(); ?>

<main class="pc_space">

    <!-- ページタイトル -->
    <section class="faq_top">
        <h2 class="page_title">よくある質問</h2>
    </section>

    <!-- パンくずリスト -->
    <?php get_template_part('template-parts/breadcrumb'); ?>
    <div class="inner">
        <div class="faq_qasec">
            <?php
            $args = [
                "post_type" => "faq",
                "posts_per_page" => -1, //全部表示
            ];
            $the_query = new WP_Query($args);
            if ($the_query->have_posts()): ?>
                <?php while ($the_query->have_posts()): ?>
                    <?php $the_query->the_post(); ?>
                    <!-- １かたまりのQ&A -->
                    <div class="faq_qawrap">
                        <!-- Q -->
                        <div class="faq_questionwrap">
                            <span class="faq_q">Q</span>
                            <p><?php the_field("question"); ?></p>
                        </div>
                        <!-- A -->
                        <div class="faq_answerwrap">
                            <span class="faq_a">A</span>
                            <p><?php the_field("answer"); ?></p>
                        </div>
                    </div>
                <?php endwhile; ?>
                <?php wp_reset_postdata(); ?>
            <?php endif; ?>
        </div>

        <!-- 主催団体向けのフォーム -->
        <section class="faq_conformwrap">
            <div class="faq_consideration">
                <h3 class="faq_h3">イベント掲載をご検討中の主催団体様へ</h3>
                <p>下記お問い合わせフォームからお問い合わせください。<br>
                    確認後、ご連絡いたします。</p>
            </div>
            <div class="faq_organized">
                <h3 class="faq_h3">掲載中の主催団体様へ</h3>
                <p>お電話番号や住所など基本情報に変更がある場合は、<br>
                    下記お問い合わせフォームへお問い合わせください。<br>
                    確認後、ご連絡いたします。</p>
            </div>
        </section>
        <div class="faq_btn">
            <a class="btn_wrap" href="<?php echo home_url("/contact/"); ?>">お問い合わせへ</a>
        </div>
    </div>
</main>

<?php get_footer(); ?>
