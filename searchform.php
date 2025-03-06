<?php get_header(); ?>

<main class="pc_space">

    <section class="page_top">
        <h2 class="page_title">イベントをさがす</h2>
    </section>

    <!-- パンくずリスト -->
    <div class="breadcrumb">
        <span><a href="<?php if (!is_home()) : ?>">
                <?php get_template_part('template-parts/breadcrumb'); ?>
            <?php endif; ?></a>
        </span>
    </div>

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



                    <!-- 体験方法　タクソノミー -->
                    <div>
                        <?php
                        $taxonomy_obj = get_taxonomy('experience');   // タクソノミー名を指定
                        ?>

                        <?php
                        $terms = get_terms([       //タームの設定
                            'taxonomy' => 'experience',
                            'hide_empty' => false,
                            'orderby' => 'slug',
                            'order' => 'ASC',
                        ]);

                        // 受け取ったターム情報を配列にするため。要検討
                        $replace_array_terms = isset($_GET['experience']) ? (array) $_GET['experience'] : array();
                        ?>

                        <?php if (!empty($terms) && !is_wp_error($terms)): ?>
                            <h3><?php echo esc_html($taxonomy_obj->label); ?></h3>
                            <div>
                                <?php foreach ($terms as $term): ?>
                                    <label>
                                        <input type="checkbox" name="experience[]" value="<?= esc_attr($term->slug); ?>" <?php checked(in_array($term->slug, $replace_array_terms)); ?>>
                                        <?php echo esc_html($term->name); ?>
                                    </label>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                    </div>

                    <!-- 時間帯　タクソノミー -->
                    <div>
                        <?php
                        $taxonomy_obj = get_taxonomy('time');   // タクソノミー名を指定
                        ?>

                        <!-- 時間 親タームの設定 -->
                        <?php
                        $parent_terms = get_terms([       //タームの設定
                            'taxonomy' => 'time',
                            'hide_empty' => false,
                            'orderby' => 'term_order',
                            'order' => 'ASC',
                        ]);

                        // 受け取ったターム情報を配列にするため。要検討
                        $replace_array_terms = isset($_GET['time']) ? (array) $_GET['time'] : array();
                        ?>
                        <h3><?php echo esc_html($taxonomy_obj->label); ?></h3>

                        <?php if (!empty($parent_terms) && !is_wp_error($parent_terms)): ?>
                            <div>
                                <?php foreach ($parent_terms as $parent_term): ?>
                                    <?php if ($parent_term->parent == 0): ?>
                                        <!-- 時間 親タームのタイトル -->
                                        <h4><?php echo esc_html($parent_term->name); ?></h4>

                                        <!-- 時間 子タームリスト -->
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
                                                    <input type="checkbox" name="time[]" value="<?= esc_attr($child_term->slug); ?>" <?php checked(in_array($child_term->slug, $replace_array_terms)); ?>>
                                                    <?php echo esc_html($child_term->name); ?>
                                                </label>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                    </div>

                    <!-- 開催時期　タクソノミー -->
                    <div>
                        <?php
                        $taxonomy_obj = get_taxonomy('vacation');   // タクソノミー名を指定
                        ?>

                        <?php
                        $terms = get_terms([       //タームの設定
                            'taxonomy' => 'vacation',
                            'hide_empty' => false,
                            'orderby' => 'slug',
                            'order' => 'ASC',
                        ]);

                        // 受け取ったターム情報を配列にするため。要検討
                        $replace_array_terms = isset($_GET['vacation']) ? (array) $_GET['vacation'] : array();
                        ?>

                        <?php if (!empty($terms) && !is_wp_error($terms)): ?>
                            <h3><?php echo esc_html($taxonomy_obj->label); ?></h3>
                            <div>
                                <?php foreach ($terms as $term): ?>
                                    <label>
                                        <input type="checkbox" name="vacation[]" value="<?= esc_attr($term->slug); ?>" <?php checked(in_array($term->slug, $replace_array_terms)); ?>>
                                        <?php echo esc_html($term->name); ?>
                                    </label>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                    </div>

                    <!-- こだわり　タクソノミー -->
                    <div>
                        <?php
                        $taxonomy_obj = get_taxonomy('other');   // タクソノミー名を指定
                        ?>

                        <?php
                        $terms = get_terms([       //タームの設定
                            'taxonomy' => 'other',
                            'hide_empty' => false,
                            'orderby' => 'slug',
                            'order' => 'ASC',
                        ]);

                        // 受け取ったターム情報を配列にするため。要検討
                        $replace_array_terms = isset($_GET['other']) ? (array) $_GET['other'] : array();
                        ?>

                        <?php if (!empty($terms) && !is_wp_error($terms)): ?>
                            <h3><?php echo esc_html($taxonomy_obj->label); ?></h3>
                            <div>
                                <?php foreach ($terms as $term): ?>
                                    <label>
                                        <input type="checkbox" name="other[]" value="<?= esc_attr($term->slug); ?>" <?php checked(in_array($term->slug, $replace_array_terms)); ?>>
                                        <?php echo esc_html($term->name); ?>
                                    </label>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                    </div>

                    <div class="btn">
                        <!-- リセット -->
                        <label class="reset">
                            <button type="reset" onclick="resetForm('<?php echo home_url('/?s=1'); ?>')"><span>リセット</span>
                            </button>
                        </label>
                        <!-- 検索 -->
                        <label class="submit">
                            <button type="submit" id="searchsubmit">
                                <span><i class="fa-solid fa-magnifying-glass"></i>検索</span>
                            </button>
                        </label>
                    </div>
                </form>
            </div>
        </section>


        <div>
            <!-- フリーワード検索 -->
            <!-- function.phpでメインクエリをeventに変更した -->
            <form action="<?php echo home_url('/'); ?>" method="get">
                <div class="box__search">
                    <div class="inner__search-box">
                        <input class="window__search" type="search" name="s" value="<?php the_search_query(); ?>" placeholder="キーワードを入力してください">
                        <button class="btn__search" type="submit">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>


    </div>
