$(document).ready(function(){
	$("#navigation li ul").hide();
	$("#navigation li a.current").parent().find("ul").slideToggle("slow");
	
	$("#navigation li a.navigation-parent").click(function () {
		$(this).parent().siblings().find("ul").slideUp("normal");
		$(this).next().slideToggle("normal");
		return false;
	});
	
	$("#navigation li a.no-submenu").click(function () {
		window.location.href=(this.href);
		return false;
	});
	
	$("#navigation li .navigation-parent").hover(function () {
		$(this).stop().animate({ paddingRight: "25px" }, 200);
	}, function () {
		$(this).stop().animate({ paddingRight: "15px" });
	});
	
	$(".closed-box .box-content").hide();
	$(".closed-box .box-tabs").hide();
	$(".box-title").click(function () {
		$(this).next().toggle();
		$(this).parent().toggleClass("closed-box");
	});
	$("tbody tr:even").addClass("alt-row");
	$('.check-all').click(function(){
		$(this).parent().parent().parent().parent().find("input[type='checkbox']").attr('checked', $(this).is(':checked'));   
	});
});
  
  
  