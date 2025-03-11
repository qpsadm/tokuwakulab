<?php
// お気に入りデータの取得処理

if (function_exists('get_user_favorites')) {
    // クッキー情報を取得
    $favorites = get_user_favorites();
    krsort($favorites); //連想配列をキーで昇順ソート

    // お気に入りデータを取得
    if ($favorites) {
        $args = [
            'post_type' => 'event', //イベント投稿
            'posts_per_page' => -1, //全部表示
            'ignore_sticky_posts' => true, //先頭固定表示の投稿を無視するためのパラメータ
            'post__in' => $favorites,
            'meta_key'       => 'date_start', // ソート基準となるカスタムフィールド
            'orderby'        => 'meta_value', // カスタムフィールドの値で並び替え
            'order'          => '',    // 昇順（古い順）
        ];
        // サブクエリ生成
        $the_query = new WP_Query($args);

        // サブクエリの件数
        $count = $the_query->found_posts;
    }
}
?>

<!-- header.phpを読み込む -->
<?php get_header(); ?>
<main class="pc_space">

    <section class="favorite_top">
        <h2 class="page_title">
            お気に入り一覧
        </h2>
    </section>

    <!-- パンくずリスト -->
    <?php get_template_part('template-parts/breadcrumb'); ?>

    <div class="inner">
        <!-- ブックマーク注意書き -->
        <div class="bookwarning_note">
            <p>ブックマークにはCookieを使用しています。<br>
                Cookieの削除に伴いブックマークした情報も削除されます。</p>
        </div>

        <?php if ($favorites): ?>
            <section>
                <div class="favorite_result">
                    <!-- 件数表示 -->
                    <div>
                        <span>お気に入り表示件数：<?php echo $count; ?></span>&nbsp;<span>件</span>
                    </div>

                    <!-- 表示順切り替え -->
                    <!-- <div>
                    <span>締め切り順</span>
                </div> -->
                </div>

                <!-- イベントカード型 -->
                <ul class="top_event_list">

                    <?php if ($the_query->have_posts()) : ?>
                        <?php while ($the_query->have_posts()) :  $the_query->the_post(); ?>

                            <li>

                                <!-- テンプレートパーツloop-event.phpを読み込む -->
                                <?php get_template_part('template-parts/loop', 'event') ?>

                            </li>
                        <?php endwhile;
                        wp_reset_postdata(); ?>
                    <?php endif; ?>

                </ul>
                <!-- 改訂ページネーション -->
                <div class="pagenation">

                    <div class="wp-pagenavi">
                        <?php if (function_exists('wp_pagenavi')): ?>

                            <?php wp_pagenavi(); ?>

                        <?php endif; ?>
                    </div>
                </div>

            </section>
        <?php else: ?>
            <section>
                <div class="favorite_result">
                    <p>ブックマークはありません。</p>
                </div>
            </section>
        <?php endif; ?>
    </div>

</main>
<!-- footer.phpを読み込む -->
<?php get_footer(); ?>
