<?php get_header(); ?>

<main class="pc_space">

    <section class="page_top">
        <h2 class="page_title">主催団体様<br class="brpc_none">お問い合わせ</h2>
    </section>

    <!-- パンくずリスト -->
    <div class="breadcrumb">
        <span><a href="<?php if (!is_home()) : ?>">
                <?php get_template_part('template-parts/breadcrumb'); ?>
                <?php endif; ?></a>
        </span>
    </div>

    <div class="inner">

        <div class="contact_samplewrap">
            <div class="contact_font">お問い合わせ例</div>
            <div class="contact_samplelist">
                <div>主催団体の情報を新たに掲載してほしいです。</div>
                <div>主催団体の情報を更新または変更してほしいです。</div>
                <div>イベントの掲載をしてほしいです。</div>
                <div>主催団体やイベントの情報を削除してほしいです。</div>
            </div>
            <div class="contact_font">※返信にはお時間をいただく場合がございます。あらかじめご了承ください。</div>
        </div>

        <div class="contact_form_wrap">
            <?php
            if (have_posts()) :
                while (have_posts()) : the_post();
                    the_content();
                endwhile;
            endif;
            ?>
        </div>
</main>

<?php get_footer(); ?>
