<!-- header.phpを読み込む -->
<?php get_header(); ?>
<main>
    <div class="inner">
        <div class="">
            <h2>お気に入りイベント一覧</h2>
        </div>

        <div class="explanation_fv">
            <p>ブックマークにはCookieを使用しています。</p>
            <p>Cookieの削除に伴いブックマークした情報も削除されます。</p>
        </div>
        <section>
            <div class="">
                <h3>件数表示</h3>
            </div>
            <ul class="">
                <?php
                if (function_exists('get_user_favorites')) : //関数が存在するか否か確認する
                    $favorites = get_user_favorites();
                    krsort($favorites); //連想配列をキーで昇順ソート

                    //print_r($favorites);

                    if ($favorites) :
                        $the_query = new WP_Query([
                            'post_type' => 'event', //イベント投稿
                            'posts_per_page' => -1, //全部表示
                            'ignore_sticky_posts' => true, //先頭固定表示の投稿を無視するためのパラメータ
                            'post__in' => $favorites,
                            'orderby' => 'post__in', //配列で指定された記事IDの並び順を維持
                        ]); ?>


                <?php if ($the_query->have_posts()) : ?>
                <?php while ($the_query->have_posts()) :  $the_query->the_post(); ?>



                <li>

                    <!-- テンプレートパーツloop-food.phpを読み込む -->
                    <?php get_template_part('template-parts/loop', 'event') ?>

                </li>
                <?php endwhile;
                            wp_reset_postdata(); ?>
                <?php endif; ?>

                <?php endif; ?>
                <?php endif; ?>
            </ul>
        </section>
    </div>

</main>
<!-- footer.phpを読み込む -->
<?php get_footer(); ?>