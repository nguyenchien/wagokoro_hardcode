<?php /* Template Name: News Page Template */ ?>
<?php
wp_register_style('news-style-news-page', get_template_directory_uri() . '/style-news-page.css', array(), '20210705');
wp_enqueue_style('news-style-news-page');
?>
<?php get_header(); ?>

    <article id="news" class="archive">
        <h2>お知らせ一覧 1234</h2>
        
        <div id="main">
        <ul class="feed-select">
            <?php if ( is_paged() ) : ?>
            <li class="all"><a href="#all" class="tab">ALL</a></li>
            <li class="wagokoro select"><a href="#wagokoro" class="tab">WAGOKORO</a></li>
            <?php else: ?>
            <li class="all select"><a href="#all" class="tab">ALL</a></li>
            <li class="wagokoro"><a href="#wagokoro" class="tab">WAGOKORO</a></li>
            <?php endif; ?>
            <li class="oem"><a href="#oem" class="tab">OEM</a></li>
            <li class="shop"><a href="#shop" class="tab">SHOP</a></li>
            <li class="kimono"><a href="#kimono" class="tab">KIMONO</a></li>
        </ul>
        <section id="all" class="news_feed <?php if ( !(is_paged()) ) : echo("active"); endif;  ?>">
            <h3>ALL</h3>
            <?php echo do_shortcode('[showrss_news_new_design]');?>
        </section>

        <section id="wagokoro" class="news_feed <?php if ( is_paged() ) : echo("active"); endif;  ?>">
            <h3>WAGOKORO</h3>
            <ul>
                <?php
                $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
                
                $args = array(
                     'posts_per_page' => 6, // 表示するページ数
                     'paged' => $paged, // 表示するページ数
                ); ?>
                <?php $wp_query = new WP_Query( $args ); ?><!-- クエリの指定 -->
                <?php while ( $wp_query->have_posts() ) : $wp_query->the_post(); ?>
                    <li>
                        <a href="<?php the_permalink() ?>">
                        <p class="category wagokoro">WAGOKORO</p><p class="date"><?php echo get_the_date("m/d"); ?></p>
                        <h4><?php the_title(); ?></h4>
                    </a>
                </li>
                <?php endwhile; ?>
                <?php wp_reset_postdata(); ?>
            </ul>
            <div class="pager">
            	<?php global $wp_rewrite;
            	$paginate_base = get_pagenum_link(1);
            	if(strpos($paginate_base, '?') || ! $wp_rewrite->using_permalinks()){
            		$paginate_format = '';
            		$paginate_base = add_query_arg('paged','%#%');
            	}
            	else{
            		$paginate_format = (substr($paginate_base,-1,1) == '/' ? '' : '/') .
            		user_trailingslashit('page/%#%/','paged');;
            		$paginate_base .= '%_%';
            	}
            	echo paginate_links(array(
            		'base' => $paginate_base,
            		'format' => $paginate_format,
            		'total' => $wp_query->max_num_pages,
            		'mid_size' => 4,
            		'current' => ($paged ? $paged : 1),
            		'prev_text' => '«',
            		'next_text' => '»',
            	)); ?>
            </div>

        </section>

        <section id="oem" class="news_feed">
            <h3>OEM</h3>
            <ul><?php echo do_shortcode('[showrss_oem]'); ?></ul>
        </section>

        <section id="shop" class="news_feed">
            <h3>SHOP</h3>
            <ul><?php echo do_shortcode('[showrss_shop_new]');?></ul>
        </section>

        <section id="kimono" class="news_feed">
            <h3>KIMONO</h3>
            <ul><?php echo do_shortcode('[showrss_kyotokimono]');?></ul>
        </section>

        </div>
    </article>
<?php get_footer(); ?>
<script src="<?php bloginfo( 'stylesheet_directory' ); ?>/js/main.js" charset="UTF-8"></script>
