<?php

// 開発モードの切り替え
// 開発モードで公開するときは、trueにしてください。
define('IS_DEV', false);

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

    // １、外部のスタイルシート
    // FontAwesome CDN
    wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css');

    //noto sans jp
    wp_enqueue_style('noto-sans-jp', 'https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@100..900&display=swap');


    // GoogleFonts: Noto+Sans+JP,Noto+Serif+JP,Roboto+Slab,Roboto:ital
    // wp_enqueue_style(
    //     'google-fonts-css1',
    //     'https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@100..900&family=Noto+Serif+JP:wght@200..900&family=Roboto+Slab:wght@100..900&family=Roboto:ital,wdth,wght@0,75..100,100..900;1,75..100,100..900&display=swap'
    // );

    // // GoogleFonts: Zen Maru Gothic
    // wp_enqueue_style(
    //     'google-web-font2',
    //     'https://fonts.googleapis.com/css2?family=Zen+Maru+Gothic:wght@300;400;500;700;900&display=swap'
    // );

    // // GoogleFonts: Material+Icons
    // wp_enqueue_style(
    //     'google-web-font3',
    //     'https://fonts.googleapis.com/icon?family=Material+Icons'
    // );


    // ２、リセットCSS
    wp_enqueue_style(
        'my_destyle',
        get_template_directory_uri() . '/assets/css/destyle.css'
    );

    // ３、共通CSS
    // wp_enqueue_style(
    //     'my_foodscience',
    //     get_template_directory_uri() . '/assets/css/foodscience.css'
    // );
    wp_enqueue_style(
        'my_common',
        get_template_directory_uri() . '/assets/css/common.css'
    );
    wp_enqueue_style(
        'my_column-list',
        get_template_directory_uri() . '/assets/css/column-list.css'
    );
    wp_enqueue_style(
        'my_column',
        get_template_directory_uri() . '/assets/css/column.css'
    );
    wp_enqueue_style(
        'my_contact',
        get_template_directory_uri() . '/assets/css/contact.css'
    );
    wp_enqueue_style(
        'my_event-list',
        get_template_directory_uri() . '/assets/css/event-list.css'
    );
    wp_enqueue_style(
        'my_event',
        get_template_directory_uri() . '/assets/css/event.css'
    );
    wp_enqueue_style(
        'my_faq',
        get_template_directory_uri() . '/assets/css/faq.css'
    );
    wp_enqueue_style(
        'my_footer',
        get_template_directory_uri() . '/assets/css/footer.css'
    );
    wp_enqueue_style(
        'my_found',
        get_template_directory_uri() . '/assets/css/found.css'
    );
    wp_enqueue_style(
        'my_header',
        get_template_directory_uri() . '/assets/css/header.css'
    );
    wp_enqueue_style(
        'post-list',
        get_template_directory_uri() . '/assets/css/post-list.css'
    );
    wp_enqueue_style(
        'my_top',
        get_template_directory_uri() . '/assets/css/top.css'
    );






    // 共通のJSファイルを読み込む
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

    //  animation.js
    wp_enqueue_script(
        'my_animation_js',
        get_template_directory_uri() . '/assets/js/animation.js',
        array('jquery'),
        null,
        true
    );

    //                                                                            ★★★必要なら表示して修正（2/26石田）
    //  hamburger.js
    // wp_enqueue_script(
    //     'my_hamburger_js',
    //     get_template_directory_uri() . '/assets/js/hamburger.js',
    //     array('jquery'),
    //     null,
    //     true
    // );


    //  adobe-font.jsの読み込み
    wp_enqueue_script(
        'adobe_font_js',
        get_template_directory_uri() . '/assets/js/adobe-font.js',
        '',
        null,
        false
    );

    /**
     * 個々のページ
     *     //*                                                             ★★★トップページ作成時に確認。（2/26石田）
     */
    if (is_home()) {
        // wp_enqueue_style(
        //     'my_top',
        //     get_template_directory_uri() . '/assets/css/top.css'
        // );

        wp_enqueue_style('slick', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.css'); //slick
        wp_enqueue_style('slick-theme', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.min.css'); //slick-theme

        wp_enqueue_style(
            'my_column_slider',
            get_template_directory_uri() . '/assets/css/column_slider.css'
        );

        // // column_slider.js
        // wp_enqueue_script(
        //     'my_column_slider_js',
        //     get_template_directory_uri() . '/assets/js/column_slider.js',
        //     array('jquery'),,
        //     '',
        //     true
        // );
        wp_enqueue_script(
            'slick-js',
            'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js',
            array('jquery'),
            null,
            true
        );

        //search
        // wp_enqueue_script(
        //     'my_searchpopup_js',
        //     get_template_directory_uri() . '/assets/js/searchpopup.js',
        //     array('jquery'),
        //     null,
        //     true
        // );
        //*                                                                       ★★★404ページ作成時に確認。いったん非表示に。（2/26石田）
        // } elseif (is_404()) {
        // wp_enqueue_style(
        //     'my_error404',
        //     get_template_directory_uri() . '/assets/css/404.css'
        // );
        //*                                                                       ★★★検索ページ作成時に確認。（2/26石田）
    } elseif (is_search() || is_post_type_archive('dataset')) {
        //条件検索CSS
        // wp_enqueue_style('my_search', get_template_directory_uri() . '/assets/css/results.css');
        // wp_enqueue_style('my_searchpopup_css', get_template_directory_uri() . '/assets/css/searchpopup.css');

        // wp_enqueue_script(
        //     'my_searchpopup-js',
        //     get_template_directory_uri() . '/assets/js/searchpopup.js',
        //     '',
        //     '',
        //     true
        // );
        //*                                                                       ★★★イベント作成時に確認。（2/26石田）
    } elseif (is_singular('event')) {
        // wp_enqueue_style(
        //     'my_dataset_style',
        //     get_template_directory_uri() . '/assets/css/details.css',
        // );
        // wp_enqueue_style('class_slick_css', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.css'); //slick
        // wp_enqueue_style('class_slick-theme_css', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.min.css'); //slick-theme
        // wp_enqueue_script(
        //     'class_slick_js',
        //     'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js',
        //     ['jquery'],
        //     '',
        //     true
        // ); //slick.js スライダー用
        // wp_enqueue_script(
        //     'class_slick-carousel-js',
        //     'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js',
        //     array('jquery'),
        //     '1.9.0',
        //     true //footerに出力
        // );
        // wp_enqueue_script(
        //     'my_slider_js',
        //     get_template_directory_uri() . '/assets/js/slider.js',
        //     ['jquery'], // jQuery に依存
        //     '', // バージョン指定なし
        //     true // フッターに出力
        // );
        // wp_enqueue_script(
        //     'my_accordion_js',
        //     get_template_directory_uri() . '/assets/js/accordion.js',
        //     ['jquery'], // jQuery に依存
        //     '', // バージョン指定なし
        //     true // フッターに出力
        // );

        //お問い合わせページ関連。                                                      ★★★必要なら表示して修正（2/26石田）
        // } elseif (is_page('contact') || is_page('confirm') || is_page('thanks')) {
        //     wp_enqueue_style(
        //         'my_input',
        //         get_template_directory_uri() . '/assets/css/input.css',
        //     );
        //     wp_enqueue_script(
        //         'my_mail_js',
        //         get_template_directory_uri() . '/assets/js/mail_form.js',
        //         ['jquery'], // jQuery に依存
        //         '', // バージョン指定なし
        //         true // フッターに出力
        //     );

        // お気に入りリスト                                                            ★★★必要なら表示して修正（2/26石田）
        // } elseif (is_page('mypage')) {
        //     wp_enqueue_style(
        //         'my_favorite',
        //         get_template_directory_uri() . '/assets/css/favorite.css'
        //     );
        // ニュース一覧                                                        ★★★必要なら表示して修正（2/26石田）
        // } elseif (is_category(['news', 'info'])) {
        //     wp_enqueue_style(
        //         'my_news_list',
        //         get_template_directory_uri() . '/assets/css/news_list.css'
        //     );
        // ニュース詳細                                                        ★★★必要なら表示して修正（2/26石田）
        // } elseif (is_single()) {
        //     wp_enqueue_style(
        //         'my_news',
        //         get_template_directory_uri() . '/assets/css/news.css'
        //     );

        // プライバシーポリシー                                                     ★★★必要なら表示して修正（2/26石田）
        // } elseif (is_page('praivacy')) {
        // プライバシーポリシー
        // wp_enqueue_style(
        //     'my_praivacy',
        //     get_template_directory_uri() . '/assets/css/privacy.css'
        // );
    } elseif (is_post_type_archive('faq')) {
        wp_enqueue_style(
            'my_faq_style',
            get_template_directory_uri() . '/assets/css/faq.css',
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
        // unset($title['tagline']);
        // タイトルの中身を変更する
        $title['title'] = '条件検索';
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
    //★is_post_type_archiveが必要ないなら消す★
    if ($query->is_search() || is_post_type_archive('dataset')) {
        $query->set('post_type', 'event');
        $query->set('posts_per_page', 6);
        return;
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
function my_move_comment_field_to_bottom($fields)
{
    $comment_field = $fields['comment'];
    unset($fields['comment']);
    $fields['comment'] = $comment_field;

    return $fields;
}
add_filter(
    'comment_form_fields',
    'my_move_comment_field_to_bottom'
);

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

// /**
//  * contact Formのときには整形機能をOFFにする
//  */
// add_filter('wpcf7_autop_or_not', 'my_wpcf7_autop');
// function my_wpcf7_autop()
// {
//     return false;
// }


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