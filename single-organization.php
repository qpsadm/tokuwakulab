<?php get_header(); ?>

<main>
    <?php if (have_posts()): ?>
    <?php while (have_posts()) : the_post(); ?>
    <section class="section">
        <div class="section_inner">
            <div class="food">
                <div class="food_body">
                    <div class="food_text">
                        <h2 class="heading heading-primary"><?php the_title(); ?></h2>
                        <div class="food_content">
                            <?php the_content(); ?>
                        </div>
                    </div>
                </div>

                <span>画像1</span>
                <span><?php
                                $pic = get_field('image01');
                                $pic_url = $pic['url'];
                                ?>
                    <img src="<?php echo $pic_url; ?>" alt="">
                </span>
                <span>画像2</span>
                <span><?php
                                $pic = get_field('image02');
                                $pic_url = $pic['url'];
                                ?>
                    <img src="<?php echo $pic_url; ?>" alt="">
                </span>
                <span>画像3</span>
                <span><?php
                                $pic = get_field('image03');
                                $pic_url = $pic['url'];
                                ?>
                    <img src="<?php echo $pic_url; ?>" alt="">
                </span>
                <span>画像4</span>
                <span><?php
                                $pic = get_field('image04');
                                $pic_url = $pic['url'];
                                ?>
                    <img src="<?php echo $pic_url; ?>" alt="">
                </span>
                <br>
                <!-- 団体紹介文 -->
                <span><?php the_field('info'); ?></span>

                <ul>
                    <li>
                        <span>代表者名</span>
                        <span><?php the_field('name'); ?></span>
                    </li>
                    <li>
                        <span>営業時間</span>
                        <span><?php the_field('hour'); ?></span>
                    </li>
                    <li>
                        <span>郵便番号</span>
                        <span><?php the_field('postcode'); ?></span>
                    </li>
                    <li>
                        <span>所在地</span>
                        <span><?php the_field('address'); ?></span>
                    </li>
                    <li>
                        <span>マップ</span>
                        <span>
                            <?php
                                    $map = get_field('map');
                                    echo $map
                                    ?>
                        </span>
                    </li>
                    <li>
                        <span>電話番号</span>
                        <span><?php the_field('tel'); ?></span>
                    </li>
                    <li>
                        <span>FAX</span>
                        <span><?php the_field('fax'); ?></span>
                    </li>
                    <li>
                        <span>メールアドレス</span>
                        <span><?php the_field('email'); ?></span>
                    </li>
                    <li>
                        <span>URL</span>
                        <span><?php the_field('url'); ?></span>
                    </li>
                    <li>
                        <span>Instagram</span>
                        <span><?php the_field('instagram'); ?></span>
                    </li>
                    <li>
                        <span>X</span>
                        <span><?php the_field('x'); ?></span>
                    </li>
                    <li>
                        <span>Facebook</span>
                        <span><?php the_field('facebook'); ?></span>
                    </li>
                    <li>
                        <span>LINE</span>
                        <span><?php the_field('line'); ?></span>
                    </li>
                    <li>
                        <span>Youtube</span>
                        <span><?php the_field('youtube'); ?></span>
                    </li>
                    <li>
                        <span>備考</span>
                        <span><?php the_field('remarks'); ?></span>
                    </li>
                </ul>
            </div>

        </div>
    </section>
    <?php endwhile; ?>
    <?php endif; ?>
</main>

<?php get_footer(); ?>