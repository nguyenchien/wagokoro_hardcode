<?php
/**
 * Created by PhpStorm.
 * Date: 04/21/2021
 * Time: 1:45 PM
 */
?>
<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous"></script>
-->
<script src="<?php echo get_stylesheet_directory_uri()?>/js/slick.min.js"></script>

<script type="text/javascript">
    jQuery(document).ready(function() {
        $('#toggle-menu').click(function() {
            $(this).toggleClass('change');
            $('#menu-sp').toggleClass('active');
            if ($('#menu-sp').hasClass('active')) {
                $('html, body').css('overflow', 'hidden');
            } else {
                $('html, body').css('overflow', '');
            }
        });

        jQuery('#list-top-banner').slick({
            dots: true,
            arrows: false,
            draggable: false,
            rows: 0,
            responsive: [
                {
                    breakpoint: 768,
                    settings: {
                        draggable: true
                    }
                },
            ]
        });

        var headerPage = $('.header');
        var hd_h = headerPage.outerHeight();
        headerPage.css({'height':hd_h});

        jQuery(window).on('scroll', function(){
            if($(window).scrollTop() > $(window).outerHeight()/2 ){
                headerPage.addClass('fixed-header');
            } else {
                headerPage.removeClass('fixed-header');
            }
        });
    });
</script>
