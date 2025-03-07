<?php get_header(); ?>

<main class="pc_space">

    <section class="page_top">
        <h2 class="page_title">主催団体様<br class="brpc_none">お問い合わせ完了</h2>
    </section>

    <!-- パンくずリスト -->
    <div class="breadcrumb">
        <span><a href="<?php if (!is_home()) : ?>">
                <?php get_template_part('template-parts/breadcrumb'); ?>
            <?php endif; ?></a>
        </span>
    </div>

    <div class="inner">
        <div class="contact_done">
            <div class="contact_samplewrap">
                お問い合わせの送信に成功しました。また、ご確認用のメールを記載いただいたアドレスに送信しております。
                ありがとうございました。
            </div>
        </div>
</main>

<!-- <?php get_footer(); ?> -->
