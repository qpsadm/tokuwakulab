<!-- ヘッダーの読み込み -->
<?php get_header(); ?>

<main>


    <?php if (have_posts()): ?>
        <?php while (have_posts()): ?>
            <?php the_post(); ?>

            <section class="section">
                <div class="section_inner">

                    <div class="food">
                        <div class="food_body">
                            <div class="food_text">
                                <h2 class="heading heading-primary"><?php the_title(); ?></h2>



                                <!-- 主催団体のページからidを使って主催団体の名前を表示する -->

                                <h3>

                                    <?php $id = get_field('org_id') ?>
                                    <a href="<?php echo get_the_permalink($id) ?>">
                                        <?php echo get_the_title($id) ?>
                                    </a>
                                </h3>

                                <br>




                                <div class="food_content">

                                    <?php the_content(); ?>

                                </div>
                            </div>

                            <!-- 写真 -->
                            <?php
                            $pic = get_field('image01');
                            //大サイズの画像のURL
                            $pic_url = $pic['sizes']['large'];
                            ?>
                            <img src="<?php echo $pic_url; ?>" alt="">

                            <!-- 「image02」「image03」「image04」は写真がある場合のみ表示 -->

                            <?php
                            $pic = get_field('image02');
                            if (!empty($pic)) {
                                //大サイズの画像のURL
                                $pic_url = $pic['sizes']['large'];

                                echo '<img src="' . esc_url($pic_url) . '" alt="">';
                            }
                            ?>

                            <?php
                            $pic = get_field('image03');
                            if (!empty($pic)) {
                                //大サイズの画像のURL
                                $pic_url = $pic['sizes']['large'];

                                echo '<img src="' . esc_url($pic_url) . '" alt="">';
                            }
                            ?>

                            <?php
                            $pic = get_field('image04');
                            if (!empty($pic)) {
                                //大サイズの画像のURL
                                $pic_url = $pic['sizes']['large'];

                                echo '<img src="' . esc_url($pic_url) . '" alt="">';
                            }
                            ?>

                        </div>

                        <!-- イベント本文 -->
                        <?php the_field('overview'); ?>

                        <h3>基本情報</h3>

                        <ul class="food_list">

                            <li class="food_item">
                                <span class="food_itemLabel">開催日時</span>
                                <span class="food_itemData"><?php the_field('date_start'); ?>～<?php the_field('date_end'); ?>
                                    <?php if (get_field('days')): ?>
                                        【<?php the_field('days'); ?>間】
                                    <?php endif; ?>
                                </span>
                            </li>


                            <li class="food_item">
                                <span class="food_itemLabel">会場名</span>
                                <span class="food_itemData"><?php the_field('address'); ?></span>
                                <?php if (get_field('nearest_station')): ?>
                                    <span class="food_itemData">
                                        【最寄り駅：<?php the_field('nearest_station'); ?>】
                                    </span>
                                <?php endif; ?>
                            </li>

                            <li class="food_item">
                                <span class="food_itemLabel">対象年齢</span>
                                <span class="food_itemData"><?php the_field('age_text'); ?></span>
                                <?php if (get_field('limit')): ?>
                                    <span class="food_itemData">
                                        【人数制限：<?php the_field('limit'); ?>】</span>
                                <?php endif; ?>
                            </li>

                            <li class="food_item">
                                <span class="food_itemLabel">参加費</span>
                                <span class="food_itemData"><?php the_field('fare'); ?></span>
                            </li>

                            <?php if (get_field('toilet') || get_field('clothes') || get_field('bento') || get_field('eve_contactor') || get_field('eve_contact') || get_field('tel') || get_field('fax') || get_field('email') || get_field('remarks')): ?>
                                <li class="food_item">
                                    <span class="food_itemLabel">その他</span>
                                    <br>

                                    <?php if (get_field('toilet')): ?>
                                        <span class="food_itemData">トイレ：<?php the_field('toilet'); ?></span><br>
                                    <?php endif; ?>


                                    <?php if (get_field('clothes')): ?>
                                        <span class="food_itemData">着替え：<?php the_field('clothes'); ?></span><br>
                                    <?php endif; ?>


                                    <?php if (get_field('bento')): ?>
                                        <span class="food_itemData">お弁当の用意：<?php the_field('bento'); ?></span><br>
                                    <?php endif; ?>


                                    <?php if (get_field('inquiry')): ?>
                                        <span class="food_itemData">申し込み・お問い合わせ方法：<br>
                                            <?php the_field('inquiry'); ?></span><br>
                                    <?php endif; ?>


                                    <?php if (get_field('remarks')): ?>
                                        <span class="food_itemData">備考：<?php the_field('remarks'); ?></span>
                                    <?php endif; ?>
                                </li>
                            <?php endif; ?>

                        </ul>

                        <!-- こだわりタクソノミーを取得して表示 -->
                        <br>

                        <?php
                        $terms = get_the_terms(get_the_ID(), 'other');
                        if (!empty($terms) && !is_wp_error($terms)) {
                            echo '<p class="event-taxonomy">';
                            foreach ($terms as $term) {

                                echo '<span class="taxonomy-badge">' . esc_html($term->name) . '</span> ';
                            }
                            echo '</p>';
                        }
                        ?>


                        <br>
                        <span class="food_itemLabel"><?php the_title(); ?>のチラシ</span>
                        <a target="_blank" href="<?php the_field('flier01'); ?>"><span class="food_itemData">【 ダウンロード 】</span></a>
                        <br>

                        <h3>会場マップ</h3>

                        <br>
                        <div>
                            <?php echo get_field('map'); ?></div>
                        <br>

                        <h3>参加者の声</h3>
                        <br>
                        <h3>クチコミを投稿する</h3>

                        <br>

                        <?php if (get_field('links')) : ?>
                            <a target="_blank" href="<?php the_field('links'); ?>"><span class="food_itemData">【 お申し込みはこちら > 】</span></a>
                            <span class="food_itemLabel">※イベントページに飛びます。</span>
                        <?php endif; ?>
                        <br>

                    </div>

                </div>
            </section>

        <?php endwhile; ?>
    <?php endif; ?>




    <?php
    //おすすめイベントを表示する2.26作成中
    $args = [
        "post_type" => "event", //投稿記事だけを指定
        "posts_per_page" => 3, //最新記事を３件表示
        "post__not_in" => [get_the_ID()], //現在表示している記事のIDは表示しない

    ];
    $latest_query = new WP_Query($args);
    if ($latest_query->have_posts()):
    ?>
        <section class="latest">

            <h2 class="heading heading-secondary">開催予定のイベント</h2>

            <div class="latest_body">
                <div class="cardList">
                    <?php while ($latest_query->have_posts()): ?>
                        <?php $latest_query->the_post(); ?>
                        <?php get_template_part("template-parts/loop", "news");
                        ?>
                    <?php endwhile; ?>
                    <?php wp_reset_postdata(); ?>

                </div>
                <a href="<?php echo home_url("column"); ?>">イベント一覧へ > </a>
            </div>
        </section>
    <?php endif; ?>
    <section>
        <div class="section_inner">
            <div class="section_header">
                <h2 class="heading heading-primary">関連コラム記事</h2>
            </div>
            <?php
            //関連記事作成中2.26(コラムに変更済2.27)
            //$faq_terms = get_terms(["taxonomy" => "faq_tax"]); //配列で取得する
            //if (!empty($faq_terms)): //空白でなければ
            ?>
            <?php //foreach ($faq_terms as $faq):
            ?>
            <section class="section_body">
                <h3 class="heading heading-secondary"><?php //echo $faq->name
                                                        ?></h3>
                <ul class="">
                    <?php
                    $args = [
                        "post_type" => "column",
                        "posts_per_page" => 3, //3つ表示

                    ];

                    $the_query = new WP_Query($args);
                    if ($the_query->have_posts()): ?>
                        <?php while ($the_query->have_posts()): ?>
                            <?php $the_query->the_post(); ?>
                            <li class="">

                                <h4 class="foodCard_title">
                                    <a href="<?php the_permalink(); ?>"><time datetime="<?php the_time('Y-m-d'); ?>"><?php the_time('Y-m-d'); ?>-</time><?php the_title(); ?></a>
                                </h4>


                            </li>
                        <?php endwhile; ?>
                        <?php wp_reset_postdata(); ?>
                    <?php endif; ?>
                </ul>
            </section>
            <?php //endforeach;
            ?>
            <?php //endif;
            ?>

            <br>
            <?php if (get_field('links')) : ?>
                <a target="_blank" href="<?php the_field('links'); ?>"><span class="food_itemData">【 お申し込みはこちら > 】</span></a>
                <span class="food_itemLabel">※イベントページに飛びます。</span>
            <?php endif; ?>
            <br>


</main>


<!-- フッターを読み込む -->
<?php get_footer(); ?>
