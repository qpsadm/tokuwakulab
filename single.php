<?php get_header(); ?>

<main class="pc_space">
    <section class="page_top">
        <h2 class="page_title">お知らせ詳細</h2>
    </section>

    <!-- パンくずリスト -->
    <div class="breadcrumb">
        <span><a href="<?php if (!is_home()) : ?>">
                <?php get_template_part('template-parts/breadcrumb'); ?>
            <?php endif; ?></a>
        </span>
    </div>

    <div class="inner">
        <section class="post_content_wrap">
            <?php if (have_posts()): while (have_posts()): the_post(); ?>
                    <!-- postタイトル -->
                    <div class="post_ttl_wrap">
                        <div class="post_date">
                            <span><?php echo get_the_date('Y'); ?></span>
                            <span><?php echo get_the_date('m/d(D)'); ?></span>
                        </div>
                        <h2 class="post_ttl"><?php the_title(); ?></h2>
                    </div>

                    <!-- postカテゴリー表示 -->
                    <?php $categories = get_the_category(); ?>
                    <?php if (!empty($categories)): ?>
                        <div class="post_tag">#<?php echo esc_html($categories[0]->name); ?></div>
                    <?php endif; ?>

                    <!-- post写真 存在する時のみ表示 -->
                    <?php if (has_post_thumbnail()): ?>
                        <div class="post_img_wrap">
                            <?php the_post_thumbnail('full', ['class' => 'post_img']); ?>
                        </div>
                    <?php endif; ?>

                    <!-- post本文 -->
                    <div class="post_item_wrap">
                        <div class="post_item">
                            <h3 class="post_item_ttl">ここにコラムの見出し</h3>
                            <p><?php the_content(); ?></p>
                        </div>
                    </div>

                    <!-- 記事送りボタン -->
                    <div class="flex">
                        <?php if (get_previous_post()): ?>
                            <a class="prv_btn" href="<?php echo get_permalink(get_previous_post()); ?>">前の記事へ</a>
                        <?php endif; ?>
                        <?php if (get_next_post()): ?>
                            <a class="nxt_btn" href="<?php echo get_permalink(get_next_post()); ?>">次の記事へ</a>
                        <?php endif; ?>
                    </div>

                    <!-- もっと見るボタン -->
                    <a class="btn_wrap" href="<?php echo home_url('/news'); ?>">
                        お知らせ一覧へ
                    </a>
            <?php endwhile;
            endif; ?>
        </section>
    </div>
</main>


<?php get_footer(); ?>
