<?php
wp_register_style('news-style-news-page', get_template_directory_uri() . '/style-news-page.css', array(), '202109091515');
wp_enqueue_style('news-style-news-page');
?>
<?php get_header('new'); ?>
<div id="fb-root"></div>
<script>(function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/ja_JP/sdk.js#xfbml=1&version=v2.0";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>

<script>
    window.twttr=(function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],t=window.twttr||{};if(d.getElementById(id))return;js=d.createElement(s);js.id=id;js.src="https://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);t._e=[];t.ready=function(f){t._e.push(f);};return t;}(document,"script","twitter-wjs"));
</script>

<script src="https://apis.google.com/js/platform.js" async defer>
    {lang: "ja"}
</script>


<div id="single">
    <article id="news" class="single">
        <?php if(have_posts()): while(have_posts()): the_post(); ?>
        <div class="heading">
            <div class="heading-wrap">
                <p class="heading-category category wagokoro">WAGOKORO</p>
                <h1 class="heading-title"><?php the_title(); ?></h1>
            </div>
            <div class="heading-date">投稿日: <?php the_date("y/m/d"); ?></div>
        </div>
        <div id="main">
            <section id="articlebody">
                <?php the_content(); ?>

                <div class="sns">
                    <ul>
                        <li><a class="twitter-share-button" href="https://twitter.com/share" data-dnt="true" data-text="<?php the_title(); ?>" data-url="<?php the_permalink() ?>">Tweet</a>
                        </li>
                        <li><div class="fb-like" data-href="https://developers.facebook.com/docs/plugins/" data-layout="button_count" data-action="like" data-show-faces="true" data-share="false"></div>
                        </li>
                        <li><div class="g-plus" data-action="share" data-annotation="bubble" data-href="https://plus.google.com/about?hl=ja"></div></li>
                    </ul>
                </div>
                <?php endwhile;endif; ?>

                <div class="back-to-news">
                    <span>&#8592;</span>
                    <a href="https://www.wagokoro.co.jp/news">お知らせ一覧へ 戻る</a>
                </div>
            </section>

            <aside style="display: none;">
                <h2>お知らせ</h2>

                <ul class="feed-select">
                    <li><a href="/news" class="tab">ALL</a></li>
                    <li class="select"><a href="<?php echo home_url();?>/news#wagokoro">WAGOKORO</a></li>
                    <li><a href="<?php echo home_url();?>/news#oem">OEM</a></li>
                    <li ><a href="<?php echo home_url();?>/news#shop">SHOP</a></li>
                    <li><a href="<?php echo home_url();?>/news#kimono">KIMONO</a></li>
                </ul>
                <section id="all" class="news_feed">
                    <h3>ALL</h3>
                    <?php //echo do_shortcode('[showrss_news]'); ?>
                </section>
                <section id="wagokoro" class="news_feed active">
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
                        <?php wp_reset_postdata();  ?>
                    </ul>
                    <div class="pager">
                        <?php  global $wp_rewrite;
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
                        ));  ?>
                    </div>
                </section>

                <section id="oem" class="news_feed">
                    <h3>OEM</h3>
                    <?php //echo do_shortcode('[showrss_oem]'); ?>
                </section>

                <section id="shop" class="news_feed">
                    <h3>SHOP</h3>
                    <ul><?php //do_shortcode('[showrss_shop_new]');?></ul>
                </section>

                <section id="kimono" class="news_feed">
                    <h3>KIMONO</h3>
                    <ul><?php //do_shortcode('[showrss_kyotokimono]');?></ul>
                </section>
            </aside>
        </div>
    </article>
</div>
<?php get_footer('new'); ?>

<style>
    @media screen and (min-width: 750px) {
        .header {
            height: 80.2031px;
        }
    }
</style>
