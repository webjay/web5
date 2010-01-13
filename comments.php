<div class="com">

<?php // Do not delete these lines
	if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');

	if (!empty($post->post_password)) { // if there's a password
		if ($_COOKIE['wp-postpass_' . COOKIEHASH] != $post->post_password) {  // and it doesn't match the cookie
			?><p class="nocomments">This post is password protected. Enter the password to view comments.</p><?php
			return;
		}
	}

	/* This variable is for alternating comment background */
	$oddcomment = 'class="alt" ';
?>

<!-- You can start editing here. -->

<?php if ($comments) : ?>
	<h3 id="comments" class="block"><?php comments_number('No Responses', 'One Response', '% Responses' );?> to &#8220;<?php the_title(); ?>&#8221;</h3>
	<hr class="space">
	
	<ol class="commentlist">

	<?php foreach ($comments as $comment) : ?>

		<li <?php echo $oddcomment; ?>id="comment-<?php comment_ID() ?>">
			
			<article>
				<figure><div class="avatar"><?php echo get_avatar( $comment, 48); ?></div></figure>
				<div class="comment">
					<header>
						<div class="fr quiet small"><a href="#comment-<?php comment_ID() ?>"><time datetime="<?php comment_date('Y-m-d'); ?>" pubdate><?php comment_date() ?> at <?php comment_time() ?></time></a> <?php edit_comment_link('edit','&nbsp;&nbsp;',''); ?></div>
						<?php comment_author_link() ?>
		                <?php if ($comment->comment_approved == '0') : ?>
		                <em>Your comment is awaiting moderation.</em>
		                <?php endif; ?>
					</header>
					<?php comment_text() ?>
				</div>
				<hr>
			</article>
			
		</li>

	<?php
		/* Changes every other comment to a different class */
		$oddcomment = ( empty( $oddcomment ) ) ? 'class="alt" ' : '';
	?>

	<?php endforeach; /* end for each comment */ ?>

	</ol>

 <?php else : // this is displayed if there are no comments so far ?>

	<?php if ('open' == $post->comment_status) : ?>
		<!-- If comments are open, but there are no comments. -->

	 <?php else : // comments are closed ?>
		<!-- If comments are closed. -->
		<p class="nocomments">Comments are closed.</p>

	<?php endif; ?>
<?php endif; ?>
</div>

<div class="reply">

<?php if ('open' == $post->comment_status) : ?>

<h3 id="respond" class="title-2 block">Leave a Reply</h3>

<?php if ( get_option('comment_registration') && !$user_ID ) : ?>
<p>You must be <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?redirect_to=<?php echo urlencode(get_permalink()); ?>">logged in</a> to post a comment.</p>
<?php else : ?>

<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">

<?php if ( $user_ID ) : ?>

<p>Logged in as <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?action=logout" title="Log out of this account">Log out &raquo;</a></p>

<?php else : ?>

<p><input type="text" name="author" id="author" value="<?php echo $comment_author; ?>" size="40" tabindex="1" required="" placeholder="Name" />
<label for="author" class="author">Name <?php if ($req) echo "(required)"; ?></label></p>

<p><input type="email" name="email" id="email" value="<?php echo $comment_author_email; ?>" size="40" tabindex="2" required="" placeholder="Email" />
<label for="email" class="email">Mail (will not be published) <?php if ($req) echo "(required)"; ?></label></p>

<p><input type="url" name="url" id="url" value="<?php echo $comment_author_url; ?>" size="40" tabindex="3" placeholder="Website" />
<label for="url" class="website">Website</label></p>

<?php endif; ?>

<p><textarea name="comment" id="comment" rows="10" tabindex="4" required="" placeholder="Comment" cols="<?php if (get_option('tn_column_number') == '3 columns') { echo '70'; } else { echo '92'; }?>"></textarea></p>

<p><input name="submit" type="submit" id="submit" tabindex="5" value="Submit Comment" />
<input type="hidden" name="comment_post_ID" value="<?php echo $id; ?>" />
</p>
<?php do_action('comment_form', $post->ID); ?>

</form>

<?php endif; // If registration required and not logged in ?>

<?php endif; // if you delete this the sky will fall on your head ?>

</div>