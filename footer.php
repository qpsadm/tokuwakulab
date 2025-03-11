<footer>
    <div class="inner">
        <nav class="footer_navwrap">

            <ul class="footer_navflex">
                <li class="footer_navitemwrap">
                    <p>イベント関連</p>
                    <ul class="footer_navitem">
                        <li><a class="footer_eventfound" href="<?php echo home_url('/?s='); ?>">イベントをさがす</a></li>
                        <li><a class="footer_eventlist" href=" <?php echo home_url('/event/'); ?>">イベント月別一覧</a></li>
                        <li><a class="footer_favorite" href="<?php echo home_url('/mypage/'); ?>">お気に入り</a></li>
                    </ul>
                </li>
                <li class="footer_navitemwrap">
                    <p>主催団体</p>
                    <ul class="footer_navitem">
                        <li><a class="footer_orglist" href="<?php echo home_url('/organization/'); ?>">主催団体一覧</a></li>
                        <li><a class="footer_contact" href="<?php echo home_url('/contact/'); ?>">主催団体様<br>お問い合わせ</a></li>
                    </ul>
                </li>
                <li class="footer_navitemwrap">
                    <p>記事</p>
                    <ul class="footer_navitem">
                        <li><a class="footer_postlist" href="<?php echo home_url('/category/news/'); ?>">お知らせ</a></li>
                        <li><a class="footer_columnlist" href="<?php echo home_url('/column/'); ?>">コラム</a></li>
                    </ul>
                </li>
                <li class="footer_navitemwrap">
                    <p>その他</p>
                    <ul class="footer_navitem">
                        <li><a class="footer_about" href="<?php echo home_url('/about/'); ?>">当サイトについて</a></li>
                        <li><a class="footer_service" href="<?php echo home_url('/terms_of_service/'); ?>">利用規約</a></li>
                        <li><a class="footer_faqlist" href="<?php echo home_url('/faq/'); ?>">よくある質問</a></li>
                        <li><a class="footer_privacylist" href="<?php echo home_url('/privacy_policy/'); ?>">プライバシーポリシー・<br>免責事項</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
        <div class="footer_instawrap">
            <a class="footer_instaicon" href="https://www.instagram.com/tokushima_ww_lab/?igsh=MXRvdnVwbXVnZWZodA%3D%3D&utm_source=qr#"><i class="fa-brands fa-instagram" style="color: #ffffff;"></i></a>
        </div>
    </div>
    <p class="copyright"><small>copyright© 徳島わくわくラボ All Rights Reserved.</small></p>
    <div class="f_img">
        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/f_img.png" alt="化石の画像">
    </div>
</footer>

<?php
wp_footer();
?>
</body>

</html>
