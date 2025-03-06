<!-- header.phpを読み込む -->
<?php
get_header();
?>

<main class="pc_space">

  <div class="inner">
    <div class="error_wrap">
      <p>お探しのページが見つかりませんでした。</p>
      <p>申し訳ございませんが、<a href="<?php echo home_url('/'); ?>">こちらのリンク</a>からトップページにお戻りください。</p>
    </div>
  </div>
</main>

<!-- footer.phpを読み込む -->
<?php
get_footer();
?>
