<!-- header.phpを読み込む -->
<?php
get_header();
?>
<!-- KVが入るかも？ -->


<?php
//各タクソノミーのデータを取得
$data = [
    $area_terms = get_terms(['taxonomy' => 'area', 'orderby' => 'slug', 'hide_empty' => false]), //hide_empty 0件の項目を表示する場合は必要
    $event_type_terms = get_terms(['taxonomy' => 'event_type', 'orderby' => 'slug', 'hide_empty' => false]),
    $experience_terms = get_terms(['taxonomy' => 'experience', 'orderby' => 'slug', 'hide_empty' => false]),
    $other_terms = get_terms(['taxonomy' => 'other', 'orderby' => 'slug', 'hide_empty' => false]),
    $loc_type_terms = get_terms(['taxonomy' => 'loc_type', 'orderby' => 'slug', 'hide_empty' => false]),
    $age_terms = get_terms(['taxonomy' => 'age', 'orderby' => 'slug', 'hide_empty' => false]),
    $time_terms = get_terms(['taxonomy' => 'time', 'orderby' => 'slug', 'hide_empty' => false]),
    $vacation_terms = get_terms(['taxonomy' => 'vacation', 'orderby' => 'slug', 'hide_empty' => false]),
    $frequency_terms = get_terms(['taxonomy' => 'frequency', 'orderby' => 'slug', 'hide_empty' => false]),
];

foreach ($data as $value) {
    $taxonomy_name[] = $value[0]->taxonomy;
}
$count = 0; //タクソノミー名取得用
$count2 = 0;
?>

<?php
//選択項目の保持と選択項目の名前の取得
//各タクソノミーでループ 名前の取得まで
foreach ($data as $terms) {
    $term_name[$taxonomy_name[$count]] = '指定なし'; //よくわからない
    foreach ($terms as $value) {
        $checked["$taxonomy_name[$count]"][$value->slug] = "";
    }
    //複数選択されたタクソノミーを配列に取得
    $select = filter_input(INPUT_GET, "$taxonomy_name[$count]", FILTER_DEFAULT, FILTER_REQUIRE_ARRAY) ?: [];


    foreach ($select as $value) {
        $checked["$taxonomy_name[$count]"][$value] = "checked";
        foreach ($terms as $slug) {
            if ($value === "$slug->slug") {
                $term_name_array[$slug->taxonomy][] = "$slug->name";
            }
        }
    }

    if (!empty($term_name_array[$taxonomy_name[$count]])) {
        $term_name[$taxonomy_name[$count]] = implode(",", $term_name_array[$taxonomy_name[$count]]);
    }

    if (!empty($select)) {
        if ($count == 1) {
            foreach ($select as $value) {
                //各子ターム（ジャンル）に親ターム（ジャンルの系統）を追加
                $term = get_term_by('slug', $value, 'event_type');
                if ($term->parent) {
                    $parent_term = get_term_by('ID', $term->parent, 'event_type');
                    $parent_name[$parent_term->slug] = $parent_term->name;
                    $parent_slug[] = $parent_term->slug;
                    $event_type_data[$parent_term->slug][] = $term->name;
                }
            }
            foreach ($parent_slug as $value) {
                $aaa[$value] = "$parent_name[$value](" . implode(",", $event_type_data[$value]) . ")";
                // print_r($value);
            }
            if (!empty($aaa)) {
                $term_name[$taxonomy_name[$count]] = implode(",", $aaa);
            }
        }
    }
    $count++;
}
?>


<main>

    <div>

        <!-- タクソノミー検索のフォーム -->
        <form action="<?php echo esc_url(home_url('/')); ?>" method="GET">

            <!-- urlにname属性、sを付けるため。これにより適切なURLが発行される -->
            <input type="hidden" name="s" value="">

            <!-- エリア　タクソノミー -->
            <div>
                <?php
                $taxonomy_obj = get_taxonomy('area');   // タクソノミー名を指定
                ?>
                <?php
                $terms = get_terms([       //タームの設定
                    'taxonomy' => 'area',
                    'hide_empty' => false,
                    'orderby' => 'slug',
                    'order' => 'ASC',
                ]);
                ?>
                <?php if (!empty($terms) && !is_wp_error($terms)): ?>
                    <h3><?php echo esc_html($taxonomy_obj->label); ?></h3>
                    <div class="area_list">
                        <?php foreach ($terms as $term): ?>
                            <label>
                                <input type="checkbox" name="area[]" value="<?= esc_attr($term->slug); ?>" <?= $checked['area']["$term->slug"] ?>>
                                <?php echo esc_html($term->name); ?>
                            </label>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>


            <!-- ジャンル　タクソノミー -->
            <div>
                <!-- ジャンル 親タームの設定 -->
                <?php
                $parent_terms = get_terms([
                    'taxonomy' => 'event_type',
                    'hide_empty' => false,
                    'orderby' => 'slug',
                    'order' => 'ASC',
                ]);
                ?>


                <?php
                $taxonomy_obj = get_taxonomy('event_type');       // タクソノミー名を指定
                ?>

                <h3><?php echo esc_html($taxonomy_obj->label); ?></h3>

                <?php if (!empty($parent_terms) && !is_wp_error($parent_terms)): ?>
                    <?php foreach ($parent_terms as $parent_term): ?>
                        <?php if ($parent_term->parent == 0): ?>


                            <!-- ジャンル 親タームのタイトル -->
                            <h4><?php echo esc_html($parent_term->name); ?></h4>

                            <!-- ジャンル 子タームリスト -->
                            <div id="<?php echo esc_attr($parent_term->slug); ?>_list" class="double_column">
                                <?php
                                $child_terms = get_terms([
                                    'taxonomy' => 'event_type',
                                    'parent' => $parent_term->term_id,
                                    'hide_empty' => false,
                                    'orderby' => 'slug',
                                    'order' => 'ASC',
                                ]);
                                ?>
                                <?php if (!empty($child_terms) && !is_wp_error($child_terms)): ?>
                                    <?php foreach ($child_terms as $child_term): ?>
                                        <label>
                                            <input type="checkbox" name="event_type[]" value="<?php echo esc_attr($child_term->slug); ?>" <?= $checked['event_type'][$child_term->slug] ?? ''; ?>>
                                            <?php echo esc_html($child_term->name); ?>
                                        </label>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>

            <!-- 体験　タクソノミー -->
            <div>
                <?php
                $taxonomy_obj = get_taxonomy('experience'); // タクソノミー名の設定
                $terms = get_terms([                        //タームの設定
                    'taxonomy' => 'experience',
                    'hide_empty' => false,
                    'orderby' => 'slug',
                    'order' => 'ASC',
                ]);
                ?>
                <?php if (!empty($terms) && !is_wp_error($terms)): ?>
                    <h3><?php echo esc_html($taxonomy_obj->label); ?></h3>
                    <div>
                        <?php foreach ($terms as $term): ?>
                            <label>
                                <input type="checkbox" name="experience[]" value="<?= esc_attr($term->slug); ?>" <?= $checked['experience']["$term->slug"] ?>>
                                <?php echo esc_html($term->name); ?>
                            </label>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>


            <!-- その他　タクソノミー -->
            <div>
                <?php
                $taxonomy_obj = get_taxonomy('other'); // タクソノミー名の設定
                $terms = get_terms([                        //タームの設定
                    'taxonomy' => 'other',
                    'hide_empty' => false,
                    'orderby' => 'slug',
                    'order' => 'ASC',
                ]);
                ?>
                <?php if (!empty($terms) && !is_wp_error($terms)): ?>
                    <h3><?php echo esc_html($taxonomy_obj->label); ?></h3>
                    <div>
                        <?php foreach ($terms as $term): ?>
                            <label>
                                <input type="checkbox" name="other[]" value="<?= esc_attr($term->slug); ?>" <?= $checked['other']["$term->slug"] ?>>
                                <?php echo esc_html($term->name); ?>
                            </label>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>

            <!-- 場所　タクソノミー -->
            <div>
                <?php
                $taxonomy_obj = get_taxonomy('loc_type'); // タクソノミー名の設定
                $terms = get_terms([                        //タームの設定
                    'taxonomy' => 'loc_type',
                    'hide_empty' => false,
                    'orderby' => 'slug',
                    'order' => 'ASC',
                ]);
                ?>
                <?php if (!empty($terms) && !is_wp_error($terms)): ?>
                    <h3><?php echo esc_html($taxonomy_obj->label); ?></h3>
                    <div>
                        <?php foreach ($terms as $term): ?>
                            <label>
                                <input type="checkbox" name="loc_type[]" value="<?= esc_attr($term->slug); ?>" <?= $checked['loc_type']["$term->slug"] ?>>
                                <?php echo esc_html($term->name); ?>
                            </label>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>

            <!-- 年齢　タクソノミー -->
            <div>
                <?php
                $taxonomy_obj = get_taxonomy('age'); // タクソノミー名の設定
                $terms = get_terms([                        //タームの設定
                    'taxonomy' => 'age',
                    'hide_empty' => false,
                    'orderby' => 'slug',
                    'order' => 'ASC',
                ]);
                ?>
                <?php if (!empty($terms) && !is_wp_error($terms)): ?>
                    <h3><?php echo esc_html($taxonomy_obj->label); ?></h3>
                    <div>
                        <?php foreach ($terms as $term): ?>
                            <label>
                                <input type="checkbox" name="age[]" value="<?= esc_attr($term->slug); ?>" <?= $checked['age']["$term->slug"] ?>>
                                <?php echo esc_html($term->name); ?>
                            </label>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>


            <!-- 時間　タクソノミー -->
            <div>
                <!-- ジャンル 親タームの設定 -->
                <?php
                $parent_terms = get_terms([
                    'taxonomy' => 'time',
                    'hide_empty' => false,
                    'orderby' => 'term_order',
                    'order' => 'ASC',
                ]);
                ?>


                <?php
                $taxonomy_obj = get_taxonomy('time');       // タクソノミー名を指定
                ?>

                <h3><?php echo esc_html($taxonomy_obj->label); ?></h3>

                <?php if (!empty($parent_terms) && !is_wp_error($parent_terms)): ?>
                    <?php foreach ($parent_terms as $parent_term): ?>
                        <?php if ($parent_term->parent == 0): ?>


                            <!-- ジャンル 親タームのタイトル -->
                            <h4><?php echo esc_html($parent_term->name); ?></h4>

                            <!-- ジャンル 子タームリスト -->
                            <div>
                                <?php
                                $child_terms = get_terms([
                                    'taxonomy' => 'time',
                                    'parent' => $parent_term->term_id,
                                    'hide_empty' => false,
                                    'orderby' => 'term_order',
                                    'order' => 'ASC',
                                ]);
                                ?>
                                <?php if (!empty($child_terms) && !is_wp_error($child_terms)): ?>
                                    <?php foreach ($child_terms as $child_term): ?>
                                        <label>
                                            <input type="checkbox" name="time[]" value="<?php echo esc_attr($child_term->slug); ?>" <?= $checked['event_type'][$child_term->slug] ?? ''; ?>>
                                            <?php echo esc_html($child_term->name); ?>
                                        </label>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>

            <!-- 期間、長期休み　タクソノミー -->
            <div>
                <?php
                $taxonomy_obj = get_taxonomy('vacation'); // タクソノミー名の設定
                $terms = get_terms([                        //タームの設定
                    'taxonomy' => 'vacation',
                    'hide_empty' => false,
                    'orderby' => 'slug',
                    'order' => 'ASC',
                ]);
                ?>
                <?php if (!empty($terms) && !is_wp_error($terms)): ?>
                    <h3><?php echo esc_html($taxonomy_obj->label); ?></h3>
                    <div>
                        <?php foreach ($terms as $term): ?>
                            <label>
                                <input type="checkbox" name="vacation[]" value="<?= esc_attr($term->slug); ?>" <?= $checked['vacation']["$term->slug"] ?>>
                                <?php echo esc_html($term->name); ?>
                            </label>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>

            <!-- 回数　タクソノミー -->
            <div>
                <?php
                $taxonomy_obj = get_taxonomy('frequency'); // タクソノミー名の設定
                $terms = get_terms([                        //タームの設定
                    'taxonomy' => 'frequency',
                    'hide_empty' => false,
                    'orderby' => 'slug',
                    'order' => 'ASC',
                ]);
                ?>
                <?php if (!empty($terms) && !is_wp_error($terms)): ?>
                    <h3><?php echo esc_html($taxonomy_obj->label); ?></h3>
                    <div>
                        <?php foreach ($terms as $term): ?>
                            <label>
                                <input type="checkbox" name="frequency[]" value="<?= esc_attr($term->slug); ?>" <?= $checked['frequency']["$term->slug"] ?>>
                                <?php echo esc_html($term->name); ?>
                            </label>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>

            <button type="submit">検索</button>
        </form>

        <!-- フリーワード検索 -->
        <form action="<?php echo home_url('/'); ?>" method="get">
            <div>
                <input type="search" name="s" value="<?php the_search_query(); ?>" placeholder="キーワードを入力してください">
                <button type="submit">検索</button>
            </div>
        </form>




        <!-- 検索結果表示場所 -->
        <div>
            <!-- WordPress ループの開始 -->
            <?php if (have_posts()) : ?>
                <?php while (have_posts()) : ?>
                    <?php the_post(); ?>

                    <!-- テンプレートパーツを読み込む -->
                    <?php get_template_part('template-parts/loop', 'event') ?>
                    <!-- WordPress ループの終了 -->
                <?php endwhile; ?>
            <?php else : ?>
                <div class="section_desc">
                    <!-- <p>検索結果はありませんでした。</p> -->
                </div>
            <?php endif; ?>
        </div>



        <!-- 検索結果一覧カード -->
        <!-- フリーワード検索の結果 -->
        <?php if (!empty(get_search_query())): ?>
            <h1 class="results_count">検索結果：<?php echo $wp_query->found_posts; ?>件</h1>

            <?php if (have_posts()) : ?>
                <div class="results_card">
                    <?php while (have_posts()) : the_post(); ?>
                        <?php get_template_part('template-parts/loop', 'event'); ?>
                    <?php endwhile; ?>
                </div>
            <?php else: ?>
                <h2 class="not__found">条件に合うイベントは見つかりませんでした。</h2>
            <?php endif; ?>
        <?php else: ?>
            <!--条件検索のサブクエリ-->
            <div>
                <?php
                $result = [
                    $area_slug = get_query_var('area'),
                    $event_type_slug = get_query_var('event_type'),
                    $experience_slug = get_query_var('experience'),
                    $other_slug = get_query_var('other'),
                    $loc_type_slug = get_query_var('loc_type'),
                    $age_slug = get_query_var('age'),
                    $time_slug = get_query_var('time'),
                    $vacation_slug = get_query_var('vacation'),
                    $frequency_slug = get_query_var('frequency'),
                ];
                $args = [
                    'post_type' => 'event', //カスタム投稿タイプを指定
                    'order' => 'ASC', // 昇順
                    'orderby' => 'ID', // 投稿ID順
                ];
                $taxquerysp = ['relation' => 'AND'];

                foreach ($result as $value) {
                    if (!empty($value)) {
                        $taxquerysp[] = [
                            'taxonomy' => "$taxonomy_name[$count2]", // タクソノミー名を動的に指定
                            'terms' => $value, // URL から取得したスラッグ
                            'field' => 'slug', // スラッグで検索
                            'operator' => 'IN', // 複数値対応
                        ];
                    }
                    $count2++;
                }
                // ページネーションの設定
                $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
                $args['posts_per_page'] = 6; //表示件数の指定
                $args['paged'] = $paged;

                $args['tax_query'] = $taxquerysp;
                $the_query = new WP_Query($args);
                ?>

                <!-- 条件検索の結果 -->
                <h1 class="results_count">検索結果：<?php echo $the_query->found_posts; ?>件</h1>
                <!-- （1-6件表示）仮でコメントアウト -->
                <?php if ($the_query->have_posts()): ?>
                    <div class="results_card">
                        <?php while ($the_query->have_posts()): $the_query->the_post(); ?>
                            <?php get_template_part('template-parts/loop', 'event'); ?>
                        <?php endwhile; ?>
                        <?php wp_reset_postdata(); ?>
                    </div>
                <?php else: ?>
                    <h2 class="not__found">条件に合うイベントは見つかりませんでした。</h2>
                <?php endif; ?>
            <?php endif; ?>
            </div>


            <!-- ページナビゲーション -->
            <?php if (function_exists('wp_pagenavi')) : ?>
                <div class="pagenation">
                    <?php wp_pagenavi(); ?>
                </div>
            <?php endif; ?>



    </div>

</main>

<!-- footer.phpを読み込む -->
<?php
get_footer();
?>
