$(function () {
			
  var index = 0;
  
  $('.tab li').click(function() {
    if (index != $('.tab li').index(this)) {
      index = $('.tab li').index(this);
      // タブの内容
      $('.content li').hide().eq(index).fadeIn('fast');
      // タブ
      $('.tab li').removeClass('select').eq(index).addClass('select');     
    }
  });
  
});

$(function () {
	
	//ページナビ
	$(".page #sub_menu .navittl").click(function(){

		$(".page #sub_menu ul").slideToggle("fast");
		$(".page #sub_menu .navittl").toggleClass("active");
		
	}).css("cursor","pointer");
	
});