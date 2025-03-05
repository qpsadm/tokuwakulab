<?php get_header(); ?>

<main class="pc_space">
    <!-- ページタイトル -->
    <section class="page_top">
        <h2 class="page_title">主催団体詳細</h2>
    </section>
    <!-- パンくずリスト -->
    <div class="breadcrumb">
        <span><a href="<?php if (!is_home()) : ?>">
                <?php get_template_part('template-parts/breadcrumb'); ?>
                <?php endif; ?></a>
        </span>
    </div>

    <div class="inner">
        <?php if (have_posts()): ?>
        <?php while (have_posts()) : the_post(); ?>
        <section class="org_top">
            <h2 class="org_name">主催団体名</h2>
            <div class="top_kv_wrap">
                <!-- キービジュアル -->
                <ul class="slider_kv">
                    <li><?php
                                $pic = get_field('image01');
                                $pic_url = $pic['url'];
                                ?>
                        <img src="<?php echo $pic_url; ?>" alt="キービジュアル">
                    </li>
                    <li><?php
                                $pic = get_field('image02');
                                $pic_url = $pic['url'];
                                ?>
                        <img src="<?php echo $pic_url; ?>" alt="キービジュアル">
                    </li>
                    <li><?php
                                $pic = get_field('image03');
                                $pic_url = $pic['url'];
                                ?>
                        <img src="<?php echo $pic_url; ?>" alt="キービジュアル">
                    </li>
                    <li><?php
                                $pic = get_field('image04');
                                $pic_url = $pic['url'];
                                ?>
                        <img src="<?php echo $pic_url; ?>" alt="キービジュアル">
                    </li>
                </ul>
            </div>

            <div class="org_description">
                <!-- 団体紹介文 -->
                <p><?php the_field('info'); ?>
                        </p>
            </div>
        </section>
        <div class="section_line"></div>
        <section>
            <h3 class="sub_title">主催団体の基本情報</h3>
            <table class="org_table">
                <tr>
                    <th>団体名</th>
                    <td><?php the_title(); ?></td>
                </tr>

                <tr>
                    <th>代表者名</th>
                    <td><?php the_field('name'); ?></td>
                </tr>

                <tr>
                    <th>郵便番号</th>
                    <td><?php the_field('postcode'); ?></td>
                </tr>
                <tr>
                    <th>所在地</th>
                    <td><?php the_field('address'); ?></td>
                </tr>
                <tr>
                    <th>電話番号</th>
                    <td><?php the_field('tel'); ?></td>
                </tr>
                <tr>
                    <th>営業時間</th>
                    <td><?php the_field('hour'); ?></td>
                </tr>
                <tr>
                    <th>FAX</th>
                    <td><?php the_field('fax'); ?></td>
                </tr>
                <tr>
                    <th>メールアドレス</th>
                    <td><?php the_field('email'); ?></td>
                </tr>
                <tr>
                    <th>URL</th>
                    <td><?php the_field('url'); ?></td>
                </tr>
                <tr>
                    <th>Instagram</th>
                    <td><?php the_field('instagram'); ?></td>
                </tr>
                <tr>
                    <th>X</th>
                    <td><?php the_field('x'); ?></td>
                </tr>
                <tr>
                    <th>facebook</th>
                    <td><?php the_field('facebook'); ?></td>
                </tr>
                <tr>
                    <th>LINE</th>
                    <td><?php the_field('line'); ?></td>
                </tr>
                <tr>
                    <th>備考</th>
                    <td><?php the_field('remarks'); ?></td>
                </tr>

                <!-- <li>
                            <span>マップ</span>
                            <span>
                                <?php
                                $map = get_field('map');
                                echo $map
                                ?>
                            </span>
                        </li>

                        <li>
                            <span>Youtube</span>
                            <span><?php the_field('youtube'); ?></span>
                        </li> -->


            </table>
        </section>
        <div class="section_line"></div>




        <?php endwhile; ?>
        <?php endif; ?>
    </div>
</main>

<?php get_footer(); ?>