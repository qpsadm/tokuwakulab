<?php get_header(); ?>

<main class="pc_space">
    <div class="inner">
        <section class="page_top">
            <h2 class="page_title">主催団体様<br class="brpc_none">お問い合わせ確認</h2>
        </section>
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
