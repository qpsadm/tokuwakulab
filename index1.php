<!-- header.phpを読み込む -->
<?php
get_header();
?>

<!-- トップページ専用のKV -->
<?php if (is_home()) : ?>

<section class="kv">
    <div class="kv_inner">
        <h1 class="kv_title">FOOD SCIENCE<br>TOKYO</h1>
        <p class="kv_subtitle">FROM JAPAN</p>
    </div>

    <div class="kv_slider js-slider">
        <div class="kv_sliderItem" style="background-image: url('<?php echo get_template_directory_uri(); ?>/assets/img/home/kv-01@2x.jpg');"></div>
        <div class="kv_sliderItem" style="background-image: url('<?php echo get_template_directory_uri(); ?>/assets/img/home/kv-02@2x.jpg');"></div>
        <div class="kv_sliderItem" style="background-image: url('<?php echo get_template_directory_uri(); ?>/assets/img/home/kv-03@2x.jpg');"></div>
    </div>
    <div class="kv_overlay"></div>

    <div class="kv_scroll">
        <a href="#concept" class="kv_scrollLink">
            <p>SCROLL DOWN</p>
            <div class="kv_scrollIcon"><i class="fa-solid fa-chevron-down"></i></div>
        </a>
    </div>
</section>

<?php endif; ?>

<section class="section section-concept" id="concept">
    <div class="section_inner">
        <div class="section_headerWrapper">
            <header class="section_header">
                <h2 class="heading heading-primary"><span>コンセプト</span>CONCEPT</h2>
            </header>
            <div class="section_pic">
                <div><img src="<?php echo get_template_directory_uri(); ?>/assets/img/home/concept_img01@2x.png" alt=""></div>
                <div><img src="<?php echo get_template_directory_uri(); ?>/assets/img/home/concept_img02@2x.png" alt=""></div>
                <div><img src="<?php echo get_template_directory_uri(); ?>/assets/img/home/concept_img03@2x.png" alt=""></div>
            </div>
        </div>
        <div class="section_body">
            <p>
                ご提供するメキシコ料理は、当店の店主が修行したローカルフードを中心にした、ご家族でも楽しめる、美味しいメキシカンです。<br>
                スパイシーでヘルシーな本場の味をお楽しみ下さい。
            </p>
            <div class="section_btn">
                <a href="" class="btn btn-more">もっと見る</a>
            </div>
        </div>
    </div>
</section>

<section class="section">
    <div class="section_inner">
        <header class="section_header">
            <h2 class="heading heading-primary"><span>最新情報</span>NEWS</h2>
            <div class="section_headerBtn"><a href="" class="btn btn-more">もっと見る</a></div>
        </header>
        <div class="section_body">
            <div class="cardList cardList-1row">

                <!-- WordPress ループの開始 -->
                <?php if (have_posts()) : ?>
                <?php while (have_posts()) : ?>
                <?php the_post(); ?>

                <section id="post-<?php the_ID(); ?>" <?php post_class('cardList_item'); ?>>
                    <a href="<?php the_permalink(); ?>" class="card">
                        <!-- カテゴリー設定 -->
                        <?php $categories = get_the_category(); ?>
                        <?php if ($categories) : ?>
                        <div class="card_label">
                            <?php foreach ($categories as $key => $category) : ?>
                            <span class="label label-black">
                                <!-- カテゴリー出力 -->
                                <?php echo $category->name; ?>
                            </span>
                            <?php endforeach; ?>
                        </div>
                        <?php endif; ?>

                        <div class="card_pic">
                            <?php if (has_post_thumbnail()) : ?>
                            <!-- アイキャッチ画像があった場合は、表示 -->
                            <?php the_post_thumbnail('medium'); ?>
                            <?php else : ?>
                            <!-- アイキャッチ画像が設定していない場合は、noimage.pngを表示 -->
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/img/common/noimage.png" alt="">
                            <?php endif; ?>

                        </div>
                        <div class="card_body">
                            <h2 class="card_title"><?php the_title(); ?></h2>
                            <time datetime="<?php the_time('Y-m-d') ?>">
                                <?php the_time('Y年m月d日 H:i:s') ?>
                            </time>
                        </div>
                    </a>
                </section>

                <!-- WordPress ループの終了 -->
                <?php endwhile; ?>
                <?php endif; ?>

            </div>
        </div>
    </div>
</section>


<section class="section section-info">
    <div class="section_inner">
        <div class="section_content">
            <header>
                <h2 class="heading heading-primary"><span>インフォメーション</span>INFORMATION</h2>
            </header>

            <ul class="infoList">
                <li class="infoList_item">
                    <span class="infoList_prepend">営業時間</span>
                    <span class="infoList_num">09:00〜21:00</span><span class="infoList_time">(LO 20:00)</span>
                    <span class="infoList_append">店休日：火曜日</span>
                </li>
                <li class="infoList_item">
                    <span class="infoList_prepend">お電話でのお問い合わせ</span>
                    <span class="infoList_num">03-0000-0123</span>
                </li>
                <li class="infoList_item">
                    <span class="infoList_prepend">メールでのお問い合わせ</span>
                    <div class="infoList_btn">
                        <a href="" class="btn btn-primary">お問い合わせ</a>
                    </div>
                </li>
            </ul>
        </div>

        <div class="section_pic">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/img/home/info_img01@2x.png" alt="">
        </div>
    </div>
</section>


<section class="section section-access">
    <div class="section_inner">
        <div class="section_content">
            <header class="section_header">
                <h2 class="heading heading-secondary">アクセス</h2>
            </header>
            <div class="section_body">
                <p>〒162-0846 東京都新宿区市谷左内町21-13</p>
                <div class="section_btn">
                    <a href="#" class="btn btn-primary">アクセスはこちら</a>
                </div>
            </div>
        </div>
        <div class="section_pic">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/img/home/access_img01@2x.png" alt="">
        </div>
    </div>
</section>

<!-- footer.phpを読み込む -->
<?php
get_footer();
?>
