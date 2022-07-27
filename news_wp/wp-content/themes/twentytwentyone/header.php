<!DOCTYPE html>
<html lang='ja'>
<head>
    <title><?php
        if ( is_single() ) {
            echo the_title(); echo "｜";
        }else if (is_page()){
            echo the_title(); echo"｜";
        }
        ?>株式会社　和心 - 日本のカルチャーを世界へ</title>
    <link rel="canonical" href="http://www.wagokoro.co.jp/"/>
    <meta charset='UTF-8' >
    <meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1' >
    <meta name='description' content='「和のカルチャーを世界へ」。古くて新しい和の心をTotal Creative Produceすることを目指し世界に誇るべき日本の伝統文化の楽しい発信基地となります' >
    <meta name='keywords' content='' >
    <meta name='robots' content='index,follow' >
    <meta name='googlebot' content='index,follow,archive' >
    <?php
    if ( is_single() ) {
        if(have_posts()): while(have_posts()): the_post();
            $trimmed = wp_trim_words( get_the_content(), 64, '' );
            echo '<meta name="description" content="'. $trimmed .'">';echo "\n";
            echo '<meta property="og:title" content="'; the_title(); echo '">';echo "\n";
            echo '<meta property="og:description" content="'. $trimmed .'">';echo "\n";
            echo '<meta property="og:og:site_name" content="'; bloginfo('name'); echo '">';echo "\n";
            echo '<meta property="og:url" content="'; the_permalink(); echo '">';echo "\n";
        endwhile;endif;
    } else {
        echo '<meta name="description" content="'; bloginfo('description'); echo '"> ';echo "\n";
        echo '<meta property="og:title" content="'; bloginfo('name'); echo '">';echo "\n";
        echo '<meta property="og:description" content="'; bloginfo('description'); echo '">';echo "\n";
        echo '<meta property="og:og:site_name" content="'; bloginfo('name'); echo '">';echo "\n";
        echo '<meta property="og:url" content="'; bloginfo('url'); echo '">';echo "\n";
    }
    ?>
    <?php
    $str = $post->post_content;
    $searchPattern = '/<img.*?src=(["\'])(.+?)\1.*?>/i';
    if (is_single()){
        if (has_post_thumbnail()){
            $image_id = get_post_thumbnail_id();
            $image = wp_get_attachment_image_src( $image_id, 'full');
            echo '<meta property="og:image" content="'.$image[0].'">';echo "\n";
        } else if ( preg_match( $searchPattern, $str, $imgurl ) && !is_archive()) {
            echo '<meta property="og:image" content="'.$imgurl[2].'">';echo "\n";
        } else {
            echo '<meta property="og:image" content="">';echo "\n";
        }
    } else {
        echo '<meta property="og:image" content="">';echo "\n";
    }
    ?>
    <!--<link href='--><?php //echo get_template_directory_uri(); ?><!--/img/favicon.gif' rel='shortcut icon'>-->
    <link href='<?php echo get_template_directory_uri(); ?>/img/favicon.ico' rel='shortcut icon'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" >
    <meta name="viewport" content="width=device-width,initial-scale=1.0, minimum-scale=1, maximum-scale=1, user-scalable=no">
    <link href='<?php echo get_template_directory_uri(); ?>/css/reset-new.css' media='all' rel="stylesheet" type='text/css' />
    <link href='<?php echo get_template_directory_uri(); ?>/css/slick.css' media='all' rel="stylesheet" type='text/css' />
    <link href='<?php echo get_template_directory_uri(); ?>/css/slick-theme.css' media='all' rel="stylesheet" type='text/css' />
    <link href='<?php echo get_template_directory_uri(); ?>/css/common.css' media='all' rel="stylesheet" type='text/css' />
    <link href='<?php echo get_template_directory_uri(); ?>/css/header.css' media='all' rel="stylesheet" type='text/css' />
    <link href='<?php echo get_template_directory_uri(); ?>/css/top.css' media='all' rel="stylesheet" type='text/css' />
    <link href='<?php echo get_template_directory_uri(); ?>/css/footer.css' media='all' rel="stylesheet" type='text/css' />
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@400;500&display=swap" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="//ie9-js.googlecode.com/svn/version/2.1(beta4)/IE9.js"></script>
    <script src="<?php echo get_template_directory_uri(); ?>/js/html5shiv.js"></script>
    <![endif]-->
    <?php /*<script>
    if(window.location.hostname == 'wagokoro.co.jp') window.location.href = window.location.href.replace('wagokoro.co.jp', 'www.wagokoro.co.jp');
</script>*/?>
    <script type="application/ld+json">
{
  "@context" : "http://schema.org",
  "@type" : "Organization",
  "url" : "https://www.wagokoro.co.jp/",
  "logo" : "https://www.wagokoro.co.jp/wp-content/themes/wagokoronew/img/logo_co.png",
  "sameAs" : "https://www.facebook.com/wagokoro.co.jp/",
  "contactPoint": [{
    "@type": "ContactPoint",
    "telephone": "(+81) 03-5785-0556",
    "contactType": "customer service"
  }]
}
</script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" charset="UTF-8"></script>

    <?php wp_head(); ?>
</head>
<body <?php body_class($post->post_name); ?>>
<header class="header">
    <div class="header-wrap">
        <div class="menu-sp" id="menu-sp">
            <ul class="wrap-menu flexbox">
                <li class="item">
                    <a href="http://localhost/wagokoro_hardcode/philosophy.html">経営理念</a>
                </li>
                <li class="item">
                    <a href="http://localhost/wagokoro_hardcode/company.html">会社概要</a>
                </li>
                <li class="item">
                    <a href="http://localhost/wagokoro_hardcode/business.html">事業内容</a>
                </li>
                <li class="item">
                    <a href="http://localhost/wagokoro_hardcode/recruitment.html" target="_blank">採用情報</a>
                </li>
                <li class="item">
                    <a href="http://localhost/wagokoro_hardcode/news_wp">お知らせ</a>
                </li>
                <li class="item">
                    <a href="http://localhost/wagokoro_hardcode/contact.html">お問い合わせ</a>
                </li>
                <li class="item">
                    <a href="http://localhost/wagokoro_hardcode/ir.html">投資家の皆さまへ</a>
                </li>
            </ul>
        </div>
        <div class="container">
            <div class="wrap-header flexbox">
                <a href="<?php echo home_url();?>" class="logo">
                    <img src="<?php echo get_template_directory_uri();?>/images/logo.png" alt="logo"/>
                </a>
                <div class="toggle-menu" id="toggle-menu">
                    <div class="bar1"></div>
                    <div class="bar2"></div>
                    <div class="bar3"></div>
                </div>
                <ul class="main-menu flexbox">
                    <li class="item">
                        <a href="http://localhost/wagokoro_hardcode/philosophy.html">経営理念</a>
                    </li>
                    <li class="item">
                        <a href="http://localhost/wagokoro_hardcode/company.html">会社概要</a>
                    </li>
                    <li class="item">
                        <a href="http://localhost/wagokoro_hardcode/business.html">事業内容</a>
                    </li>
                    <li class="item">
                        <a href="http://localhost/wagokoro_hardcode/recruitment.html" target="_blank">採用情報</a>
                    </li>
                    <li class="item">
                        <a href="http://localhost/wagokoro_hardcode/news_wp">お知らせ</a>
                    </li>
                    <li class="item">
                        <a href="http://localhost/wagokoro_hardcode/contact.html">お問い合わせ</a>
                    </li>
                    <li class="item">
                        <a href="http://localhost/wagokoro_hardcode/ir.html">投資家の皆さまへ</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</header>
<style>
    .fixed-header .header-wrap {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        z-index: 99;
        -webkit-animation: scrollDown 0.4s linear;
        animation: scrollDown 0.4s linear;
        background-color: #fff;
        -webkit-box-shadow: 0 4px 7px -2px #ccc;
        -moz-box-shadow: 0 4px 7px -2px #ccc;
        -o-box-shadow: 0 4px 7px -2px #ccc;
    }
    @keyframes scrollDown {
        from {
            top: -20px;
            opacity: 0;
        }
        to{
            top: 0;
            opacity: 1;
        }
    }
</style>
