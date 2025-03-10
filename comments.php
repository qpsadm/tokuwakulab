<section class="comments">


	<!-- 3/9 作成中（峯村） -->

	<div class="event_review_wrap">
		<!-- コメントがある場合 -->
		<?php if (have_comments()) : ?>


	<h3 class="sub_title">参加者様からの感想</h3>


			<?php
			// コメントのリスト表示
			wp_list_comments([
				'avatar_size' => 50,
				'callback' => function ($comment, $args, $depth) {
					$GLOBALS['comment'] = $comment;
			?>
				<!-- 感想（1つ目） -->
				<div class="event_review">
					<p class="event_review_name"><?php echo get_comment_author(); ?>さん</p>
					<p class="event_review_comment"><?php echo get_comment_text(); ?></p>
				</div>
			<?php
				},
			]);
			?>
		<?php endif; ?>
	</div>

	<!-- コメントのページネーション -->
	<?php
	$paginate_comments_links_args = [
		'prev_text' => '←前のコメントページ',
		'next_text' => '←次のコメントページ',
	];
	paginate_comments_links($paginate_comments_links_args);
	?>


	<!-- クチコミ投稿フォーム -->
	<h3 class="sub_title">クチコミを投稿する</h3>


	<div class="event_review_form">
		<?php
		// コメントフォームのカスタムテンプレート
		$comment_form_args = [
			'title_reply' => '',  // デフォルトのタイトルを非表示
			'comment_notes_before' => '',  // 「メールアドレスが公開されることはありません」などの文言を非表示
			'comment_notes_after' => '',  // 送信後のメッセージを非表示
			'label_submit' => 'クチコミを送信',  // 送信ボタンのテキスト
			'fields' => [
				'author' => '<div class="event_review_item">
                        <span>お名前*</span>
                        <input type="text" name="author" required>
                    </div>',
				'email' => '<div class="event_review_item">
                        <span>メールアドレス*</span>
                        <input type="email" name="email" required>
                    </div>',
			],
			'comment_field' => '<div class="event_review_item">
                            <span>感想*</span>
                            <textarea name="comment" rows="4" cols="40" required></textarea>
                        </div>',
			'submit_button' => '',  // 送信ボタンのカスタマイズ
			'form_id' => 'commentform',  // フォームのIDを設定（必要なら）
			'form_class' => 'event_review_form',  // フォームのクラス名を設定
			'action' => site_url('/wp-comments-post.php'),  // デフォルトの送信先
		];

		// コメントフォームを表示
		comment_form($comment_form_args);
		?>

		<!-- クチコミ投稿についての利用規約リンク -->
		<a href="<?php echo home_url('/privacy_policy/'); ?>">クチコミ投稿についての利用規約</a>
	</div>

	<!-- 送信ボタンをフォーム外に配置 -->
	<div class="event_review_submit_btn">
		<form action="<?php echo site_url('/wp-comments-post.php'); ?>" method="post">
			<input class="event_review_btn" type="submit" value="クチコミを送信">
		</form>
	</div>

</section>
