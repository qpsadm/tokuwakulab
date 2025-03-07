<section class="comments">
	<?php
	// コメントフォームの調整
	$comment_form_args = [
		'title_reply' => 'コメント投稿フォーム',
		'comment_notes_before' => '<span style="color:red;">※コメントを入力して、送信ボタンをおしてください。</span>',
		'comment_notes_after' => '<span style="color:red;">コメントありがとうございました。</span>',
		'label_submit' => 'コメント送信',
	];

	// コメントフォームを表示する
	comment_form($comment_form_args);
	?>

	// コメントのやり取りを表示する
	<?php if (have_comments()) : ?>
		<ol class="commentlist">
			<?php
			$wp_list_comments_args = [
				'avatar_size' => '50',
			];
			wp_list_comments($wp_list_comments_args);
			?>
		</ol>

		<?php
		// コメントのページネーション
		$paginate_comments_links_args = [
			'prev_text' => '←前のコメントページ',
			'next_text' => '←次のコメントページ',
		];
		paginate_comments_links($paginate_comments_links_args);
		?>

	<?php endif; ?>
</section>
