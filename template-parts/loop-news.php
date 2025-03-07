<!-- カテゴリー設定 -->
<!-- <?php $categories = get_the_category(); ?>
<?php if ($categories) : ?>
<div class="">
    <?php foreach ($categories as $key => $category) : ?>
    <span class="">
         カテゴリー出力
        <?php //echo $category->name;
        ?>
    </span>
    <?php endforeach; ?>
</div>
<?php endif; ?> -->

<!-- <div class="card_pic"> -->
<?php //if (has_post_thumbnail()) :
?>
<!-- アイキャッチ画像があった場合は、表示 -->
<?php //the_post_thumbnail('medium');
?>
<?php //else :
?>
<!-- アイキャッチ画像が設定していない場合は、noimage.pngを表示 -->
<!-- <img src="<?php //echo get_template_directory_uri();
                ?>/assets/img/common/noimage.png" alt=""> -->
<?php //endif;
?>


<div class="post_list_item_wrap">
    <span><?php the_time('Y年m月d日(l)') ?></span>
    <a href="<?php the_permalink(); ?>"><span class="post_list_item"><?php the_title(); ?></span></a>
</div>
