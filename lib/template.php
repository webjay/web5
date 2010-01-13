<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>">
	<title><?php if (is_single()) : wp_title(); ?> | <?php endif; ?><?php bloginfo('name'); ?></title>
	<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/blueprint/blueprint/screen.css" type="text/css" media="screen, projection">
	<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/blueprint/blueprint/print.css" type="text/css" media="print">
	<!--[if lt IE 8]><link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/blueprint/blueprint/ie.css" type="text/css" media="screen, projection"><![endif]-->
	<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen">
	<?php include(TEMPLATEPATH.'/lib/custom.php'); ?>
	<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>">
	<link rel="alternate" type="application/atom+xml" title="<?php bloginfo('name'); ?> Atom Feed" href="<?php bloginfo('atom_url'); ?>">
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
	<?php wp_head(); ?>
</head>
<body>
	<div class="main">
		<div class="container">
			
			<header>
				<div class="span-24 header">
					<div class="span-19">
						<hgroup>
							<h1 class="name"><a href="/"><?php bloginfo('name'); ?></a></h1>
							<h2 class="slogan"><?php bloginfo('description'); ?></h2>
						</hgroup>
					</div>
					<div id="headerimg" class="span-5 last"><?php
						$imageSrc = get_option(get_option('template').'_header_image_src');
						$imageLink = get_option(get_option('template').'_header_image_link');
						if ($imageSrc) {
							if ($imageLink) {
								echo('<a href="'.$imageLink.'" rel="me">');
							}
							echo('<figure><img src="'.$imageSrc.'" alt="" class="fr"></figure>');
							if ($imageLink) {
								echo('</a>');
							}
						}
					?></div>
				</div>
				<div id="topbar" class="span-24">
					<div class="span-24 menu">
						<nav>
							<ul>
								<li class="<?php if ( is_home() ) { ?>current_page_item<?php } ?>"><a href="<?php echo(get_option('home')); ?>/">Home</a></li>
								<?php wp_list_pages('sort_column=menu_order&depth=1&title_li='); ?>
							</ul>
						</nav>
					</div>
				</div>
				<div id="banner" class="span-24 banner">
					<div id="bannerbox">
						<div id="flicks"></div>
					</div>
					<div id="butbar" class="span-24"></div>
				</div>
			</header>
			<hr class="space">
			<div class="span-24 content">
				<div class="span-16 post-wrapper">
					<section>
						<header>
							<hgroup>
							<?php if (single_cat_title(null, false) != '') : ?>
							<h3><?php single_cat_title('&raquo; '); ?></h3>
							<?php 
							if (category_description() != '') {
								echo('<h4>'.category_description().'</h4>');
							}
							?>
							<?php endif; ?>
							</hgroup>
							<?php
							if (get_search_query() != '') {
								echo('<h3>');
								wp_title();
								echo('</h3>');
							}
							?>
						</header>
					</section>
					<section>
					<ul class="hfeed">
						<?php if (have_posts()) : ?>
							<?php $n = 0; ?>
							<?php while (have_posts()) : the_post(); $n++; ?>
								<?php if (get_post_type() == 'post') : ?>
						<li class="post">
							<article>
								<header>
								<div class="text-header">
									<?php edit_post_link('Edit', '<div class="edit fr">', '</div>'); ?>
									<h3 class="title"><a href="<?php the_permalink() ?>" class="entry-title"><?php the_title(); ?></a></h3>
								</div>
								<div class="clear quiet small">
									<em>
										<time pubdate><?php the_date() ?></time>
										by <span class="author vcard"><span class="fn"><?php the_author() ?></span></span>
										in <?php the_category(', ') ?> <?php the_tags('tagged ', ', '); ?>
									</em>
								</div>
								</header>
								<div class="entry-content">
								<?php 
								if (($n <= 3 || is_single()) && get_search_query() == '') {
									the_content('Read the rest of this entry &raquo;');
									if (!is_single()) {
										?><div class="quiet clear small"><a href="<?php comments_link(); ?>">Comments<?php //comments_number(); ?></a></div><?php
									}
								} else {
									echo('<p>'.the_excerpt().'</p>');
									echo('<p><a href="'.get_permalink().'">Read more</a></p>');
								}
								?>
								</div>
								<?php if (!is_single()) : ?>
								<div class="clear"></div>
								<div class="hr"><img src="<?php bloginfo('stylesheet_directory'); ?>/img/<?php echo($scissors); ?>" alt="scissors" /></div>
								<?php endif; ?>
							</article>
						</li>
								<?php elseif (get_post_type() == 'page') : ?>
						<li class="post">
							<article>
								<header>
								<div class="text-header">
									<?php edit_post_link('Edit', '<div class="edit fr">', '</div>'); ?>
									<h3 class="title"><?php the_title(); ?></h3>
									<div class="clear"></div>
								</div>
								</header>
								<?php the_content('Read the rest of this entry &raquo;'); ?>
								<footer>
									<?php the_tags('<span class="quiet">Tags: ', ', ', '</span>'); ?>
								</footer>
							</article>
						</li>
								<?php endif; ?>
							<?php endwhile; ?>
						<?php else : ?>
						<li>
							<article>
	                        <h2>Not Found</h2>
	                        <p>Sorry, but you are looking for something that isn't here.</p>
							</article>
						</li>
						<?php endif; ?>
						<?php if (get_post_type() == 'post' && !is_single()) : ?>
						<li class="post">
		                    <p class="alignleft"><?php next_posts_link('&laquo; Older Entries') ?></p>
		                    <p class="alignright"><?php previous_posts_link('Newer Entries &raquo;') ?></p>
		                </li>
						<?php endif; ?>
					</ul>
					</section>
					<?php if (comments_open()) : ?>
					<div class="clear">
						<section>
							<?php comments_template(); ?>
						</section>
					</div>
					<?php endif; ?>
				</div>
				<div class="span-8 last sidebar">
					<aside>
						<?php get_sidebar(); ?>
					</aside>
				</div>
			</div>
			<div class="span-24 footer quiet">
				<footer>
				<p class="fr small">
					<a href="<?php bloginfo('rss2_url'); ?>">RSS</a> |
					<a href="http://github.com/webjay/web5">GPL licensed template</a> |
					Customized by <a href="http://www.webcom.dk/">Webcom</a>
				</p>
				<p class="fl small">Powered by <a href="http://wordpress.org/">WordPress</a></p>
				</footer>
			</div>

		</div>
	</div>
	
<?php wp_footer(); ?>

</body>
</html>
