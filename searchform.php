<?php get_header(); ?>

<main class="pc_space">

    <section class="page_top">
        <h2 class="page_title">イベントをさがす</h2>
    </section>

    <!-- パンくずリスト -->
    <?php get_template_part('template-parts/breadcrumb'); ?>

    <div class="inner">

        <!-- 検索ボックス -->
        <section>
            <h3 class="search_title">詳細検索する</h3>
            <div class="search_wrap">

                <!-- 絞り込み検索フォーム -->
                <form method="get" action="<?php echo home_url('/'); ?>" class="search_content">
                    <input type="hidden" name="s">

                    <!-- エリア -->
                    <?php
                    // タクソノミー名を指定
                    $taxonomy_obj = get_taxonomy('area');
                    //タームの設定
                    $terms = get_terms([
                        'taxonomy' => 'area',
                        'hide_empty' => false,
                        'orderby' => 'slug',
                        'order' => 'ASC',
                    ]);

                    // 受け取ったターム情報を配列にするため。要検討
                    $replace_array_terms = isset($_GET['area']) ? (array) $_GET['area'] : array();
                    ?>

                    <?php if (!empty($terms) && !is_wp_error($terms)): ?>
                        <h3 class="sub_title"><?php echo esc_html($taxonomy_obj->label); ?></h3>
                        <details open class="search_accordion">
                            <summary class="search_item_title">エリアを選択する</summary>
                            <?php foreach ($terms as $term): ?>
                                <label>
                                    <input type="checkbox" name="area[]" value="<?= esc_attr($term->slug); ?>" <?php checked(in_array($term->slug, $replace_array_terms)); ?>>
                                    <?php echo esc_html($term->name); ?>
                                </label>
                            <?php endforeach; ?>
                        </details>
                    <?php endif; ?>


                    <!-- 年齢-->
                    <?php
                    // タクソノミー名を指定
                    $taxonomy_obj = get_taxonomy('age');
                    //タームの設定
                    $terms = get_terms([
                        'taxonomy' => 'age',
                        'hide_empty' => false,
                        'orderby' => 'slug',
                        'order' => 'ASC',
                    ]);

                    // 受け取ったターム情報を配列にするため。要検討
                    $replace_array_terms = isset($_GET['age']) ? (array) $_GET['age'] : array();
                    ?>

                    <?php if (!empty($terms) && !is_wp_error($terms)): ?>
                        <h3 class="sub_title"><?php echo esc_html($taxonomy_obj->label); ?></h3>
                        <details open class="search_accordion">
                            <summary class="search_item_title">年齢を選択する</summary>
                            <?php foreach ($terms as $term): ?>
                                <label>
                                    <input type="checkbox" name="age[]" value="<?= esc_attr($term->slug); ?>" <?php checked(in_array($term->slug, $replace_array_terms)); ?>>
                                    <?php echo esc_html($term->name); ?>
                                </label>
                            <?php endforeach; ?>
                        </details>
                    <?php endif; ?>


                    <!-- ジャンル -->
                    <?php
                    // タクソノミー名を指定
                    $taxonomy_obj = get_taxonomy('event_type');
                    // 親タームの設定
                    $parent_terms = get_terms([
                        'taxonomy' => 'event_type',
                        'hide_empty' => false,
                        'orderby' => 'term_order',
                        'order' => 'ASC',
                    ]);

                    // 受け取ったターム情報を配列にするため。要検討
                    $replace_array_terms = isset($_GET['event_type']) ? (array) $_GET['event_type'] : array();
                    ?>
                    <h3 class="sub_title"><?php echo esc_html($taxonomy_obj->label); ?></h3>

                    <?php if (!empty($parent_terms) && !is_wp_error($parent_terms)): ?>
                        <?php foreach ($parent_terms as $parent_term): ?>
                            <?php if ($parent_term->parent == 0): ?>
                                <details class="search_accordion">
                                    <!-- 親タームのタイトル -->
                                    <summary class="search_item_title"><?php echo esc_html($parent_term->name); ?></summary>

                                    <!-- 子タームリスト -->
                                    <?php
                                    // 子タームの設定
                                    $child_terms = get_terms([
                                        'taxonomy' => 'event_type',
                                        'parent' => $parent_term->term_id,
                                        'hide_empty' => false,
                                        'orderby' => 'term_order',
                                        'order' => 'ASC',
                                    ]);
                                    ?>
                                    <?php if (!empty($child_terms) && !is_wp_error($child_terms)): ?>
                                        <?php foreach ($child_terms as $child_term): ?>
                                            <label>
                                                <input type="checkbox" name="event_type[]" value="<?= esc_attr($child_term->slug); ?>" <?php checked(in_array($child_term->slug, $replace_array_terms)); ?>>
                                                <?php echo esc_html($child_term->name); ?>
                                            </label>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </details>
                            <?php endif; ?>
                        <?php endforeach; ?>

                    <?php endif; ?>



                    <!-- 体験方法 -->
                    <?php
                    // タクソノミー名を指定
                    $taxonomy_obj = get_taxonomy('experience');
                    //タームの設定
                    $terms = get_terms([
                        'taxonomy' => 'experience',
                        'hide_empty' => false,
                        'orderby' => 'slug',
                        'order' => 'ASC',
                    ]);

                    // 受け取ったターム情報を配列にするため。要検討
                    $replace_array_terms = isset($_GET['experience']) ? (array) $_GET['experience'] : array();
                    ?>

                    <?php if (!empty($terms) && !is_wp_error($terms)): ?>
                        <h3 class="sub_title"><?php echo esc_html($taxonomy_obj->label); ?></h3>
                        <details open class="search_accordion">
                            <summary class="search_item_title">体験方法を選択する</summary>
                            <?php foreach ($terms as $term): ?>
                                <label>
                                    <input type="checkbox" name="experience[]" value="<?= esc_attr($term->slug); ?>" <?php checked(in_array($term->slug, $replace_array_terms)); ?>>
                                    <?php echo esc_html($term->name); ?>
                                </label>
                            <?php endforeach; ?>
                        </details>
                    <?php endif; ?>




                    <!-- 時間帯　タクソノミー -->
                    <?php
                    // タクソノミー名を指定
                    $taxonomy_obj = get_taxonomy('time');
                    // 親タームの設定
                    $parent_terms = get_terms([
                        'taxonomy' => 'time',
                        'hide_empty' => false,
                        'orderby' => 'term_order',
                        'order' => 'ASC',
                    ]);

                    // 受け取ったターム情報を配列にするため。要検討
                    $replace_array_terms = isset($_GET['time']) ? (array) $_GET['time'] : array();
                    ?>
                    <h3 class="sub_title"><?php echo esc_html($taxonomy_obj->label); ?></h3>

                    <?php if (!empty($parent_terms) && !is_wp_error($parent_terms)): ?>
                        <?php foreach ($parent_terms as $parent_term): ?>
                            <?php if ($parent_term->parent == 0): ?>
                                <details class="search_accordion">
                                    <!-- 親タームのタイトル -->
                                    <summary class="search_item_title"><?php echo esc_html($parent_term->name); ?></summary>

                                    <!-- 子タームリスト -->
                                    <?php
                                    // 子タームの設定
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
                                                <input type="checkbox" name="time[]" value="<?= esc_attr($child_term->slug); ?>" <?php checked(in_array($child_term->slug, $replace_array_terms)); ?>>
                                                <?php echo esc_html($child_term->name); ?>
                                            </label>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </details>
                            <?php endif; ?>
                        <?php endforeach; ?>

                    <?php endif; ?>


                    <!-- 開催時期　タクソノミー -->
                    <?php
                    // タクソノミー名を指定
                    $taxonomy_obj = get_taxonomy('vacation');
                    //タームの設定
                    $terms = get_terms([
                        'taxonomy' => 'vacation',
                        'hide_empty' => false,
                        'orderby' => 'slug',
                        'order' => 'ASC',
                    ]);

                    // 受け取ったターム情報を配列にするため。要検討
                    $replace_array_terms = isset($_GET['vacation']) ? (array) $_GET['vacation'] : array();
                    ?>

                    <?php if (!empty($terms) && !is_wp_error($terms)): ?>
                        <h3 class="sub_title"><?php echo esc_html($taxonomy_obj->label); ?></h3>
                        <details open class="search_accordion">
                            <summary class="search_item_title">開催時期を選択する</summary>
                            <?php foreach ($terms as $term): ?>
                                <label>
                                    <input type="checkbox" name="vacation[]" value="<?= esc_attr($term->slug); ?>" <?php checked(in_array($term->slug, $replace_array_terms)); ?>>
                                    <?php echo esc_html($term->name); ?>
                                </label>
                            <?php endforeach; ?>
                        </details>
                    <?php endif; ?>


                    <!-- こだわり　タクソノミー -->
                    <?php
                    // タクソノミー名を指定
                    $taxonomy_obj = get_taxonomy('other');
                    //タームの設定
                    $terms = get_terms([
                        'taxonomy' => 'other',
                        'hide_empty' => false,
                        'orderby' => 'slug',
                        'order' => 'ASC',
                    ]);

                    // 受け取ったターム情報を配列にするため。要検討
                    $replace_array_terms = isset($_GET['other']) ? (array) $_GET['other'] : array();
                    ?>

                    <?php if (!empty($terms) && !is_wp_error($terms)): ?>
                        <h3 class="sub_title"><?php echo esc_html($taxonomy_obj->label); ?></h3>
                        <details open class="search_accordion">
                            <summary class="search_item_title">体験方法を選択する</summary>
                            <?php foreach ($terms as $term): ?>
                                <label>
                                    <input type="checkbox" name="other[]" value="<?= esc_attr($term->slug); ?>" <?php checked(in_array($term->slug, $replace_array_terms)); ?>>
                                    <?php echo esc_html($term->name); ?>
                                </label>
                            <?php endforeach; ?>
                        </details>
                    <?php endif; ?>


                    <div class="search_btn">
                        <!-- リセットボタン -->
                        <input type="reset" value="クリア" class="search_prv_btn" onclick="resetForm()">
                        <!-- イベントをさがすボタン -->
                        <input type="submit" value="さがす" class="search_nxt_btn">
                    </div>
                </form>
            </div>
        </section>


        <!-- フリーワード -->
        <section>
            <h3 class="search_title">フリーワードで検索する</h3>
            <!-- function.phpでメインクエリをeventに変更した -->
            <form action="<?php echo home_url('/'); ?>" method="get">
                <h3 class="sub_title">フリーワード検索</h3>
                <div class="search_box_wrap">
                    <div class="search_box_inner">
                        <input class="search_box_content" type="search" name="s" value="<?php the_search_query(); ?>" placeholder="フリーワードを入れてください">
                        <button class="search_word_btn" type="submit" aria-label="検索">
                        </button>
                    </div>
                </div>
            </form>
        </section>


        <script>
            function resetForm() {
                window.location.href = "<?php echo home_url('/?s='); ?>"; // ホームにリダイレクト（クエリ削除）
            }
        </script>
