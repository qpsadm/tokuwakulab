    <!-- 豆知識 -->
    <div class="pc_space">
        <div class="tips_wrap inner">
            <div class="tips_text">
                <span> <?php
                        // functions.php で定義した豆知識のランダム関数を呼び出す
                        if (function_exists('get_random_message')) {
                            get_random_message();
                        }
                        ?>
                </span>
            </div>
            <div class="tips_chara"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/f_img.png" alt="当サイトのキャラクター画像"></div>
        </div>
    </div>

    <footer>
        <ul>
            <li><a href="<?php echo home_url('/terms_of_service/'); ?>">利用規約</a></li>
            <li><a href="contact.html">主催団体様<br class="brpc_none">お問い合わせ</a></li>
            <li><a href="privacy-policy.html">プライバシーポリシー・<br class="brpc_none">免責事項</a></li>
        </ul>
        <small>copyright</small>
        <div class="f_img">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/img/f_img.png" alt="化石の画像">
        </div>
    </footer>

    <!-- <div class="pageTop js-toTop">
        <a href="#"><i class="fas fa-arrow-up"></i><span>TOP PAGE</span></a>
    </div> -->

    <?php
    wp_footer();
    ?>
    </body>

    </html>
