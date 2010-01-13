<style type="text/css">
	div.main {
		background: <?php echo(myOption('main_color')); ?> url(<?php bloginfo('stylesheet_directory'); ?>/img/bg/<?php echo(myOption('background')); ?>) repeat scroll 0 0;
	}
	.header .name, .header .name a {
		color: <?php echo(myOption('main_color')); ?>;
		margin-bottom: 0 !important;
	}
	#topbar {
		border-top: solid 3px <?php echo(myOption('main_color')); ?>;
	}
	.menu .current_page_item, .menu li a:hover {
		background: <?php echo(myOption('main_color')); ?>;
	}
	div.banner {
		border-bottom: 3px solid <?php echo(myOption('main_color')); ?>;
	}
	.post blockquote p {
		border: 1px dashed <?php echo(myOption('main_color')); ?>;
	}
	.post p, .post a, .post li {
		font-size: <?php echo(myOption('font_size')); ?>;
	}
	.post a:hover {
		background-color: <?php echo(myOption('second_color')); ?>;
	}
	.post .title a {
		background-color: <?php echo(myOption('main_color')); ?>;
	}
	.post h2 a:hover {
		background-color: <?php echo(myOption('second_color')); ?>;
	}
	.post span.no {
		background-color: <?php echo(myOption('main_color')); ?>;
	}
	.hr {
		background: url(<?php bloginfo('stylesheet_directory'); ?>/img/<?php echo($sep); ?>) repeat-x 0 9px;
		!background: url(<?php bloginfo('stylesheet_directory'); ?>/img/<?php echo($sep); ?>) repeat-x 0 4px;
	}
	.sidebar div a:hover {
		background-color: <?php echo(myOption('second_color')); ?>;
	}
	.sidebar div.pink a:hover {
		background-color: <?php echo(myOption('second_color')); ?>;
	}
	.sidebar div.cleanbox {
		background-color: <?php echo(myOption('cleanbox_bgcolor')); ?>;
	}
	div.footer {
		border-top: 3px solid <?php echo(myOption('main_color')); ?>;
		font-size: <?php echo(myOption('font_size')); ?> !important;
	}
</style>
<script>
var flickrss = '<?php echo(myOption('flickrss_link', '')); ?>';
</script>
