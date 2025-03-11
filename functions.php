<?php

// 開発モードの切り替え
// 開発モードで公開するときは、trueにしてください。
define('IS_DEV', true);

// 管理バーを非表示させたいときに、以下のフィルターフックを有効させてください。
// add_filter('show_admin_bar', '__return_false');


/**
 * WordPressの既成機能を有効させる
 */

function my_theme_setup()
{
    add_theme_support('title-tag');         //<title>タグを出力する
    add_theme_support('post-thumbnails');   //アイキャチ画像を使用可能にする
    // add_theme_support('menus');          //カスタムメニュー機能を使用可能にする
}
add_action('after_setup_theme', 'my_theme_setup');


/**
 * preconnect を追加する
 */
function my_add_preconnect_hints($urls, $relation_type)
{
    if ('preconnect' === $relation_type) {
        $urls[] = array(
            'href' => 'https://fonts.googleapis.com',
            'crossorigin' => true,
        );
        $urls[] = array(
            'href' => 'https://fonts.gstatic.com',
            'crossorigin' => true,
        );
    }
    return $urls;
}
add_filter('wp_resource_hints', 'my_add_preconnect_hints', 10, 2);

/**
 * スタイルシートとJavaScriptファイルを読み込む
 */
function my_add_scripts()
{
    // 本サイトの共通スタイルシート

    // １、外部ファイルの読み込み
    // FontAwesome CDN
    wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css');

    //noto sans jp
    wp_enqueue_style('noto-sans-jp', 'https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@100..900&display=swap');



    // ２、リセットCSS
    wp_enqueue_style(
        'my_destyle',
        get_template_directory_uri() . '/assets/css/destyle.css'
    );

    // ３、共通CSS
    wp_enqueue_style(
        'my_common',
        get_template_directory_uri() . '/assets/css/common.css'
    );


    // ３、共通JS
    // WordPressのjqueryを無効させる
    wp_deregister_script('jquery');

    // 指定jqueryを読み込む
    wp_enqueue_script(
        'jquery',
        'https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js',
        array(),
        null,
        false  //true：フッターに読み込むように
    );

    //  animation.jsの読み込み
    wp_enqueue_script(
        'my_animation',
        get_template_directory_uri() . '/assets/js/animation.js',
        array('jquery'),
        null,
        true
    );

    //  カスタムしたslick.jsの読み込み
    wp_enqueue_script(
        'my_slick',
        get_template_directory_uri() . '/assets/js/slick.js',
        array('jquery'),
        null,
        true
    );

    //slickの読み込み
    // slickCSSの読み込み
    wp_enqueue_style('slick', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css');
    wp_enqueue_style('slick-theme', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css');

    // slickJSの読み込み
    wp_enqueue_script(
        'slick-js',
        'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js',
        array('jquery'),
        null,
        true
    );

    //  adobe-font.jsの読み込み
    wp_enqueue_script(
        'adobe_font_js',
        get_template_directory_uri() . '/assets/js/adobe-font.js',
        '',
        null,
        true
    );

    /**
     * 個々のページ
     *     //*                                                             ★★★トップページ作成時に確認。（2/26石田）
     */
    if (is_home()) {
        // 個別cssの読み込み
        wp_enqueue_style(
            'my_top',
            get_template_directory_uri() . '/assets/css/top.css'
        );

        // // slickCSSの読み込み
        // wp_enqueue_style('slick', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css');
        // wp_enqueue_style('slick-theme', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css');

        // // slickJSの読み込み
        // wp_enqueue_script(
        //     'slick-js',
        //     'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js',
        //     array('jquery'),
        //     null,
        //     true
        // );
    }
    //イベント一覧or主催団体一覧(タクソノミーも)
    elseif (is_post_type_archive('event') || is_post_type_archive('organization') || is_tax('org_tax')) {
        wp_enqueue_style(
            'my_event_list_style',
            get_template_directory_uri() . '/assets/css/event-list.css',
        );
    }
    // イベント個別
    elseif (is_singular('event')) {
        wp_enqueue_style(
            'my_event_style',
            get_template_directory_uri() . '/assets/css/event.css',
        );

        // // slickCSSの読み込み
        // wp_enqueue_style('slick', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css');
        // wp_enqueue_style('slick-theme', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css');

        // // slickJSの読み込み
        // wp_enqueue_script(
        //     'slick-js',
        //     'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js',
        //     array('jquery'),
        //     null,
        //     true
        // );
    }
    // イベントを探す
    elseif (is_search()) {
        //条件検索CSS
        wp_enqueue_style('my_search', get_template_directory_uri() . '/assets/css/found.css');
    }
    // お知らせ一覧
    elseif (is_category('news')) {
        wp_enqueue_style(
            'my_news_list_style',
            get_template_directory_uri() . '/assets/css/post-list.css',
        );
    }
    // 主催団体個別
    elseif (is_singular('organization')) {
        wp_enqueue_style(
            'my_org_style',
            get_template_directory_uri() . '/assets/css/org.css',
        );

        // // slickCSSの読み込み
        // wp_enqueue_style('slick', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css');
        // wp_enqueue_style('slick-theme', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css');

        // // slickJSの読み込み
        // wp_enqueue_script(
        //     'slick-js',
        //     'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js',
        //     array('jquery'),
        //     null,
        //     true
        // );
    }
    //コラム一覧(タクソノミーページも)
    elseif (is_post_type_archive('column') || is_tax('column_type')) {
        wp_enqueue_style(
            'my_column_list_style',
            get_template_directory_uri() . '/assets/css/column-list.css',
        );
    }
    // コラム個別 お知らせ個別
    elseif (is_singular('column') || is_singular('post')) {
        wp_enqueue_style(
            'my_column_style',
            get_template_directory_uri() . '/assets/css/column.css',
        );
    }
    // お気に入りページ
    elseif (is_page('mypage')) {
        wp_enqueue_style(
            'my_mypage_style',
            get_template_directory_uri() . '/assets/css/favorite-list.css',
        );
    }
    //お問い合わせページ関連。
    elseif (is_page('contact') || is_page('confirm') || is_page('thanks')) {
        wp_enqueue_style(
            'my_contact_style',
            get_template_directory_uri() . '/assets/css/contact.css',
        );
    }
    // プライバシーポリシー
    elseif (is_page('privacy_policy')) {
        wp_enqueue_style(
            'my_privacy_policy_style',
            get_template_directory_uri() . '/assets/css/privacy.css'
        );
    }
    // 当サイトについて
    elseif (is_page('about')) {
        wp_enqueue_style(
            'my_about_style',
            get_template_directory_uri() . '/assets/css/about.css'
        );
    }
    // 利用規約
    elseif (is_page('terms_of_service')) {
        wp_enqueue_style(
            'my_terms_of_service_style',
            get_template_directory_uri() . '/assets/css/service.css'
        );
    }
    // faq
    elseif (is_post_type_archive('faq')) {
        wp_enqueue_style(
            'my_faq_style',
            get_template_directory_uri() . '/assets/css/faq.css',
        );
    }
    // 404
    elseif (is_404()) {
        wp_enqueue_style(
            'my_404_style',
            get_template_directory_uri() . '/assets/css/error.css',
        );
    }
}
add_action('wp_enqueue_scripts', 'my_add_scripts');

/**
 * タイトルを変更する
 */
function my_custom_title($title)
{
    if (is_search()) {
        // 条件検索ページの場合はタイトルを以下のように変更
        // tagline（キャッチフレーズ）を無くす
        unset($title['tagline']);
        // タイトルの中身を変更する
        $title['title'] = 'イベントを探す';
    }
    // 変更したタイトルを返す
    return $title;
}
// フィルターにフックを追加
add_filter('document_title_parts', 'my_custom_title');


/**
 * メインクエリを変更する
 */
function my_pre_get_posts($query)
{

    //管理画面、メインクエリ以外には設定しない
    if (is_admin() || !$query->is_main_query()) {
        return;
    }

    //トップページの場合
    if ($query->is_home()) {
        $query->set('posts_per_page', 3);
        return;
    }

    //投稿list画面
    if ($query->is_category()) {
        $query->set('posts_per_page', 5);
        return;
    }

    //search画面         -------投稿タイプをeventに変更済み(3/2 今野)
    if (!is_admin() && $query->is_main_query() && ($query->is_search() || $query->is_post_type_archive('event'))) {
        $today = date('Y-m-d');

        // メタクエリの条件（終了日が今日以降）
        $meta_query = [
            [
                'key'     => 'date_end',
                'value'   => $today,
                'compare' => '>',
                'type'    => 'DATE',
            ]
        ];

        // 既存の `meta_query` がある場合はマージ
        if ($query->get('meta_query')) {
            $existing_meta_query = array_merge($query->get('meta_query'), $meta_query);
        }

        // クエリの変更
        $query->set('post_type', 'event');
        $query->set('post_status', 'publish');
        $query->set('orderby', 'meta_value');
        $query->set('meta_key', 'date_end');
        $query->set('order', 'ASC');
        $query->set('meta_query', $meta_query);
        $query->set('posts_per_page', 6);
    }

    if ($query->is_post_type_archive('column') || $query->is_tax('column_type')) {
        $query->set('post_type', 'column');
        $query->set('posts_per_page', 6);
    }

    if ($query->is_tax('org_tax')) {
        $query->set('post_type', 'organization');
    }
}
add_action('pre_get_posts', 'my_pre_get_posts');

//search.phpのメインクエリで全件数、表示範囲を出力するための変数を渡す設定
function set_search_query_vars()
{
    if (is_search() || is_post_type_archive('event')) {
        global $wp_query;

        $posts_per_page = get_query_var('posts_per_page', 6);
        $current_page = max(1, get_query_var('paged'));

        // **全件数を取得（クエリ実行後）**
        $all_num = $wp_query->found_posts;
        $start = ($current_page - 1) * $posts_per_page + 1;
        $end = min($current_page * $posts_per_page, $all_num);

        // // **デバッグログ**
        // error_log("=== template_redirect デバッグ ===");
        // error_log("検索結果の件数 (all_num): " . $all_num);
        // error_log("表示範囲: " . $start . " - " . $end);

        // **テンプレートで取得できるようにセット**
        set_query_var('all_num', $all_num);
        set_query_var('start', $start);
        set_query_var('end', $end);
    }
}
add_action('template_redirect', 'set_search_query_vars');

// /*
// * 管理画面の投稿一覧に、タクソノミー分類を追加表示
// */
// function my_taxonomy_filter()
// {
//     global $typenow;
//     $post_type = 'dataset'; //slug
//     $taxonomy  = 'classtype'; //  taxonomy
//     if ($typenow == $post_type) {
//         $selected      = isset($_GET[$taxonomy]) ? $_GET[$taxonomy] : '';
//         $info_taxonomy = get_taxonomy($taxonomy);
//         wp_dropdown_categories(array(
//             'show_option_all' => sprintf(__('ALL %s', 'textdomain'), $info_taxonomy->label),
//             'taxonomy'        => $taxonomy,
//             'name'            => $taxonomy,
//             'orderby'         => 'name',
//             'selected'        => $selected,
//             'hierarchical'    => true,
//             'show_count'      => true,
//             'hide_empty'      => true,
//             'value_field'     => 'slug'
//         ));
//     };
// }
// add_action('restrict_manage_posts', 'my_taxonomy_filter');


// /**
//*                                       非表示にしました（2/26石田）
//
//  * 検索結果を公開して施設のみ対象にする
//  */
// function my_search_exclude($query)
// {
//     // 管理画面とメインクエリの場合は、対象外とする
//     if ($query->is_main_query() && is_admin()) {
//         return;
//     }

//     if ($query->is_search()) {
//         // 検索するカスタム投稿タイプと投稿状態
//         $query->set('post_type', 'dataset');
//         $query->set('post_status', 'publish');

//         // 文字列で検索で、検索文字列が空の場合
//         if (!isset($_GET['s']) || trim($_GET['s']) === '') {
//             // postのIDを0で指定して、検索結果を０件にする
//             $query->set('post__in', array(0));
//         }
//     }

//     return $query;
// }
// add_filter(
//     'pre_get_posts',
//     'my_search_exclude'
// );


/**
 * コメント入力欄の表示順を変更する                                           ★★★一応このままにします（2/26石田）
 *
 * @param array $fields array
 * @retuen array $fields array
 */
// function my_move_comment_field_to_bottom($fields)
// {
//     $comment_field = $fields['comment'];
//     unset($fields['comment']);
//     $fields['comment'] = $comment_field;

//     return $fields;
// }
// add_filter(
//     'comment_form_fields',
//     'my_move_comment_field_to_bottom'
// );

// /**
//*                                                                        ★★★非表示にしました（2/26石田）
//
//  * 「メールアドレスが公開されることはありません。 * が付いている欄は必須項目です」の文言を削除
//  *
//  * @param array $defaults array
//  * @retuen array $defaults array
//  */
// function my_comment_notes_before($defaults)
// {
//     $defaults['comment_notes_before'] = '';
//     return $defaults;
// }
// add_filter("comment_form_defaults", "my_comment_notes_before");

// /**
//  * 「コメントを残す」を削除
//  *
//  * @param array $defaults arg
//  * @return array $defaults arg
//  */
// function my_title_reply($defaults)
// {
//     $defaults['title_reply'] = '';
//     return $defaults;
// }
// add_filter('comment_form_defaults', 'my_title_reply');

/**
 * contact Formのときには整形機能をOFFにする
 */
add_filter('wpcf7_autop_or_not', 'my_wpcf7_autop');
function my_wpcf7_autop()
{
    return false;
}

// contact Formの<span>割り込みを解除
add_filter('wpcf7_form_elements', function ($content) {
    $content = preg_replace('/<(span).*?class="\s*(?:.*\s)?wpcf7-form-control-wrap(?:\s[^"]+)?\s*"[^\>]*>(.*)<\/\1>/i', '\2', $content);

    return $content;
});


/**
 *                                                                         ★★★ 非表示にしました（2/26石田）
 * ランキング用
 * ページ表示の連続更新による閲覧回数カウント制限、transient、1時間
 */
// 分類の表示回数を増やす関数
// function increment_term_view_count($term_id)
// {
//     $user_ip = $_SERVER['REMOTE_ADDR']; //get user IP
//     $transient_key = 'view_count_' . $term_id . '_' . md5($user_ip);

//     if (false === get_transient($transient_key)) {

//         $view_count = get_term_meta($term_id, 'view_count', true);
//         $view_count = $view_count ? intval($view_count) : 0;

//         update_term_meta($term_id, 'view_count', $view_count + 1);

//         set_transient($transient_key, 'viewed', 1); // transientを設定します。有効期限は1時間（3600秒）です。
//     }
// }

//豆知識投稿をランダム表示にする関数（0227石田作成）
function get_random_message()
{
    $args = array(
        'post_type'      => 'short', //  投稿タイプ'short'を対象に
        'posts_per_page' => 1,       //  一件にする
        'orderby'        => 'rand',  //  ランダムで取得
    );
    $query = new WP_Query($args);    // サブクエリを作成

    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();

            //タイトルを出す場合は以下を出力
            // $title = get_the_title(get_the_ID()); ////タイトルを取得
            // echo $title;

            $message = get_post_meta(get_the_ID(), 'text', true); // カスタムフィールド「text」を取得
            echo $message;
        }
        wp_reset_postdata(); // クエリをリセット（重要）
    }
}


/**
 * 指定した月の初日 (YYYY-MM-01 形式) から、
 * その月の最終日 (YYYY-MM-DD 形式) を取得する
 *
 */
function get_last_day_of_month($first_day)
{
    return date('Y-m-t', strtotime($first_day));
}

/**
 * urlからパラメータの値を取得する
 *
 */
function get_param_value($key)
{
    $value =  null;
    if (isset($_GET[$key])) {
        $value = $_GET[$key];
    };
    return $value;
}

/**
 * 未来のイベントの開催月の初日を取得する(サブクエリ)
 *
 */
function get_upcoming_event_months()
{
    global $wpdb;

    // 今日の日付を取得（フォーマット: YYYY-MM-DD）
    $today = date('Y-m-d');

    // カスタムフィールド（開催日）の値を持つ未来の投稿を取得
    $query_args = [
        'post_type'      => 'event', // カスタム投稿タイプ（適宜変更）
        'posts_per_page' => -1,      // すべて取得
        'meta_key'       => 'date_start', // ソート基準となるカスタムフィールド
        'orderby'        => 'meta_value', // カスタムフィールドの値で並び替え
        'order'          => 'ASC',    // 昇順（古い順）
        'meta_query'     => [
            [
                'key'     => 'date_start',  // フィールド名（適宜変更）
                'value'   => $today,
                'compare' => '>=',  // 今日以降の開催日のみ
                'type'    => 'DATE'
            ]
        ]
    ];

    $query = new WP_Query($query_args);
    $months = [];

    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            $event_date = get_post_meta(get_the_ID(), 'date_start', true);
            if ($event_date) {
                $month = date('Y-m', strtotime($event_date)) . '-1'; // YYYY-MM 形式で取得
                $months[$month] = true; // 配列のキーとして保持（重複防止）
            }
        }
    }
    wp_reset_postdata();

    return array_keys($months); // ユニークな月リストを取得
}

/**
 * 未来のイベントの開催月の初日を取得する（SQL）
 *
 */
function get_upcoming_event_months1($post_type = 'event')
{
    global $wpdb;

    // 今日の日付を取得（フォーマット: YYYY-MM-DD）
    $today = date('Y-m-d');

    // データベースから開催日を取得（未来のものだけ）
    $results = $wpdb->get_col(
        $wpdb->prepare(
            "SELECT DISTINCT pm.meta_value
            FROM {$wpdb->postmeta} pm
            INNER JOIN {$wpdb->posts} p ON pm.post_id = p.ID
            WHERE pm.meta_key = %s
            AND CAST(pm.meta_value AS DATE) >= %s
            AND p.post_type = %s
            AND p.post_status = 'publish'
            ORDER BY CAST(pm.meta_value AS DATE) ASC",
            'date_start', // カスタムフィールド名
            $today,       // 今日以降
            $post_type    // 指定された投稿タイプ
        )
    );

    $months = [];

    // 月のリストを抽出（YYYY-MM 形式）
    if (!empty($results)) {
        foreach ($results as $event_date) {
            $month = date('Y-m', strtotime($event_date)) . '-01';
            $months[$month] = true; // 重複排除
        }
    }

    return array_keys($months); // ユニークな月のリストを取得
}



// スリックの画像をslick.jsに渡す設定
function my_enqueue_scripts()
{
    wp_enqueue_script(
        'slick-custom',
        get_template_directory_uri() . '/assets/js/slick.js',
        array('jquery'),
        null,
        true
    );

    // PHPの値をJavaScriptに渡す
    wp_localize_script(
        'slick-custom',
        'slickParams',
        array(
            'prevArrow' => '<button class="slick_prev_kv"><img src="' . get_template_directory_uri() . '/assets/img/slickarrow_left.png" alt="Previous"></button>',
            'nextArrow' => '<button class="slick_next_kv"><img src="' . get_template_directory_uri() . '/assets/img/slickarrow_right.png" alt="Next"></button>',
            'prevArrowOrg' => '<button class="slick_prev_org"><img src="' . get_template_directory_uri() . '/assets/img/slickarrow_left.png" alt="Previous"></button>',
            'nextArrowOrg' => '<button class="slick_next_org"><img src="' . get_template_directory_uri() . '/assets/img/slickarrow_right.png" alt="Next"></button>',

        )
    );
}
add_action('wp_enqueue_scripts', 'my_enqueue_scripts');

//コラム個ページの画像にdivを付ける設定
function wrap_images_with_div($block_content, $block)
{
    if (is_singular('column') && $block['blockName'] === 'core/image') {
        return '<div class="column_articleimg">' . $block_content . '</div>';
    }
    return $block_content;
}
add_filter('render_block', 'wrap_images_with_div', 10, 2);
