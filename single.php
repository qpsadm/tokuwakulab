<!-- header.phpを読み込む -->
<?php
get_header();
?>

<main>
    <div class="section">
        <div class="section_inner">

            <!-- WordPress ループの開始 -->
            <?php if (have_posts()) : ?>
                <?php while (have_posts()) : ?>
                    <?php the_post(); ?>

                    <article id="post-<?php the_ID(); ?>" <?php post_class('post'); ?>>
                        <header class="section_header">
                            <h1 class="heading heading-primary"><?php the_title(); ?></h1>
                        </header>
                        <div class="post_content">
                            <time datetime="<?php the_time('Y-m-d') ?>"><?php the_time('Y年m月d日 H:i') ?></time>
                            <div class="content">
                                <!-- 投稿の中身を出力 -->
                                <?php the_content(); ?>
                            </div>

                            <!-- コメント -->
                            <?php
                            comments_template();
                            ?>
                        </div>

                        <footer class="post_footer">
                            <?php $categories = get_the_category(); ?>
                            <?php if ($categories) : ?>
                                <div class="category">
                                    <div class="category_list">
                                        <?php foreach ($categories as $key => $category) : ?>
                                            <div class="category_item">
                                                <!-- カテゴリーで絞り込むように -->
                                                <a href="<?php echo get_category_link($category); ?>" class="btn btn-sm is-active">
                                                    <?php echo $category->name; ?>
                                                </a>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <div class="prevNext">
                                <!-- 前の記事 -->
                                <?php $previous_post = get_previous_post(); ?>
                                <?php if ($previous_post) : ?>
                                    <div class="prevNext_item prevNext_item-prev">
                                        <a href="<?php the_permalink($previous_post); ?>">
                                            <svg width="20" height="38" viewBox="0 0 20 38">
                                                <path d="M0,0,19,19,0,38" transform="translate(20 38) rotate(180)" fill="none" stroke="#224163" stroke-width="1" />
                                            </svg>
                                            <span>
                                                <?php echo get_the_title($previous_post) ?>
                                            </span>
                                        </a>
                                    </div>
                                <?php endif; ?>

                                <!-- 次の記事 -->
                                <?php $next_post = get_next_post(); ?>
                                <?php if ($next_post) : ?>
                                    <div class="prevNext_item prevNext_item-next">
                                        <a href="<?php the_permalink($next_post) ?>">
                                            <span><?php echo get_the_title($next_post) ?></span>
                                            <svg width="20" height="38" viewBox="0 0 20 38">
                                                <path d="M1832,1515l19,19L1832,1553" transform="translate(-1832 -1514)" fill="none" stroke="#224163" stroke-width="1" />
                                            </svg>
                                        </a>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </footer>

                    </article>

                    <!-- WordPress ループの終了 -->
                <?php endwhile; ?>
            <?php endif; ?>

            <!-- 直近の3件の投稿を取得して出力 -->
            <?php
            // 検索条件を定義
            $args = [
                'post_type' => 'post',   //投稿
                'posts_per_page' => 3,   //ページごとに3件
                'post__not_in' => [get_the_ID()],  //自分以外の投稿ページ
                'post_status' => 'publish',      //公開中の投稿のみ
                // 'orderby' => 'date',
                // 'order'=>'DESC',
            ];

            // クエリを実行する
            $query = new WP_Query($args);
            ?>

            <!-- 取得した投稿を出力 -->
            <!-- WordPress ループの開始 -->
            <?php if ($query->have_posts()) : ?>
                <section class="latest">
                    <header class="latest_header">
                        <h2 class="heading heading-secondary">新着情報</h2>
                    </header>
                    <div class="latest_body">
                        <div class="cardList">
                            <?php while ($query->have_posts()) : ?>
                                <?php $query->the_post(); ?>

                                <!-- テンプレートパーツを読み込む -->
                                <?php get_template_part('template-parts/loop', 'news') ?>
                                <!-- WordPress ループの終了 -->
                            <?php endwhile; ?>
                            <!-- クエリリセット -->
                            <?php wp_reset_postdata(); ?>
                        </div>
                    </div>
                </section>
            <?php endif; ?>
        </div>
    </div>
</main>

<!-- footer.phpを読み込む -->
<?php
get_footer();
?>
