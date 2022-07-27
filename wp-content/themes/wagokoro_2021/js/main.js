$(function(){


    var ua = function(){
        if(navigator.userAgent.match(/(Android)/)){
            return "android";
        }
    };


    $(document).ready(function(){
        if($('#adoption').length == 0){
            $(".page #main > section").addClass("fadein");
            $(".news_feed").addClass("scrollin");
        }
        if($('#ir').length > 0){
            $(".page #main > section").addClass("fadein").addClass("scrollin");
        }


        //Add more item

        if($(window).width() < 750){
            $('.box-business-oem .item-business').each(function(i){
                if(i > 3){
                    var itemHide = $('.box-business-oem .item-business')[i];
                    $(itemHide).each(function(i, val){
                        $(val).hide();
                    });
                }
            });
        } else{
            $('.box-business-oem .item-business').each(function(i){
                if(i > 5){
                    var itemHide = $('.box-business-oem .item-business')[i];
                    $(itemHide).each(function(i, val){
                        $(val).hide();
                    });
                }
            });
        }


        $('.box-business-oem .add-more-item').click(function(){
            $('.box-business-oem .item-business').each(function(i, val){
                $(val).fadeIn();
            });
            $(this).hide();
        });

    });

    var topGimic = $("#link_gimic");

    if(!navigator.userAgent.match(/(iPhone|iPad|Android)/)){

    $("#links > section ul li a").mouseenter(function(){
        var cs = "_" + Math.floor(Math.random()*4);
        topGimic.addClass(cs).show();
    });
    $("#links > section ul li a").mouseleave(function(){
        topGimic.removeClass().fadeOut();
    });

    }

    var ww = $(window).width();
    var wrapSpace = 80;

    if(ww < 641){
        $("header").removeClass("static");
        var wrapSpace = 50;
    }

    $(window).resize(function(){
        var ww = $(window).width();
        if(ww < 641){
            $("header").removeClass("static");
            var wrapSpace = 50;
        }
    });

    var f_title = $("#flash_title");
    f_title.click(function(){
        $(this).fadeOut("slow");
    });

    $(".feed-select li a.tab").click(function(){
        var $this = $(this);
        var t = $this.attr("href");
        var _hash = t;
        $(".news_feed").removeClass("active");
        t = $(t == "#" || t == "" ? 'html' : t);
        t.addClass("active");
        $(".feed-select li.select").removeClass("select");
        $this.parent("li").addClass("select");
        var new_link = location.hostname + location.pathname+_hash;
        history.pushState(new_link, "", _hash);
        return false;
    });
    window.onpopstate = function(event) {
        if(location.hash == '')
            location.hash = '#all';
        loadtab(location.hash);
    };
    if(location.hash){
        console.log(location.hash);
        loadtab(location.hash);
    }
    function loadtab(_hash){
        var _class = _hash.replace("#", "");
        // console.log(_hash, _class);
        $(".select").removeClass("select");
        $(".active").removeClass("active");
        $(".feed-select li."+_class).addClass("select");
        // console.log(".feed-select li."+_class);
        $(_hash).addClass("active");

    }
    $('#sub_menu ul li a').click(function(){
        var href = $(this).attr("href");
        var target =$(href == "#" || href == "" ? 'html' : href);
        var targetOffset = target.offset().top;

        $('html,body').animate({
            scrollTop:targetOffset
        }, 500, 'swing');

        return false;
    });

    $("#wrapper .wrap-new-header > header h3").click(function(){
        $(this).parent().toggleClass("open");
        $(this).next("ul").slideToggle("slow");
    });

    var v = document.getElementById("video");
    if($("body").hasClass("home")){
        var flag = true;
    }else{
        var flag = false;
    }
    $(window).scroll(function(){
        var posY = $(window).scrollTop();
        var numHeight = $('.box-top-header').outerHeight();
        $('.fadein').each(function(){
            var elemPos = $(this).offset().top;
            var scroll = $(window).scrollTop();
            var windowHeight = $(window).height();
            if (scroll > elemPos - windowHeight + 150){
                $(this).addClass('scrollin');
            }
        });

        if(posY > numHeight){
            $("#wrapper .wrap-new-header > header").removeClass("static");
            $("#wrapper").css({paddingTop: wrapSpace});
            if(flag){
                setTimeout(function(){
                    f_title.fadeOut(2000);
                }, 3000);
                v.play();
                flag = false;
                setTimeout(function(){
                    f_title.fadeIn(500);
                }, 60000);
            }

        }else{
            if($("#wrapper .wrap-new-header > header").hasClass("static")){ return;}
            if(ww > 640){
                $("#wrapper .wrap-new-header > header").addClass("static");
                $("#wrapper").css({paddingTop: 0});
            }
        }


    });

    $("#introduction div a").hover(function(){
       var num = $(this).attr("data-bg");
       $("#int_bg").addClass(num).addClass("show");
    },function(){
       $("#int_bg").removeClass();
    });

    $("#recruit div a").hover(function(){
       var num = $(this).attr("data-bg");
       $("#rec_bg").addClass(num).addClass("show");
    },function(){
       $("#rec_bg").removeClass();
    });

    var modal = $("#modal").hide(),
        modalIn = $("#modal-main").css({opacity: 0});

    $(".btn-modal").click(function(){
        var url = $(this).attr("href");
        var iframe = '<iframe src="' + url + '" allowfullscreen="no"></iframe>'
        modalIn.append(iframe);
        modal.fadeIn();
        $("html").addClass("modal-on");
        setTimeout(function(){
                modalIn.animate({opacity: 1},1000);
        }, 1000);

        return false;
    });

    $.each(['modal-bg','modal-close'],function(){
        $('#' + this).click(function(){
            $("html").removeClass("modal-on");
            modalIn.animate({opacity:0},500).find("iframe").remove();
            modal.fadeOut("slow");
            return false;
        });
    });

    $(".voice-btn").click(function(){
        $("section.active").removeClass("active");
        $(this).parent("section").addClass("active");
        var targetOffset = $(this).parent("section").offset().top;

            $('html,body').animate({
                scrollTop:targetOffset -80
            }, 500, 'swing');
            return false;
    });


/*
    var trigar = $("#sub_menu").offset().top;

    $(window).scroll(function(){
        var posY = $(window).scrollTop();
        if(!(document.getElementById("sub_menu"))) return;
        console.log(posY);
        var wh = $(window).height();

        if(trigar < posY){
            var y = (posY - trigar);
            $("#sub_menu").css({top: posY - wh*0.8});
        }
    });
*/



});


