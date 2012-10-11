$(document).ready(function(){
	// proses form login pada halaman admin/index.php
	$("form#loginForm").bind("submit", function(e){
		$("#loginButton").hide();
		$("#loginNotif").slideUp("fast");
		$.ajax({
			type: "POST",
			url: "login.php",
			data: $("form#loginForm").serialize(),
			success: function(data) {
				$("#loginNotif").slideDown("slow").html(data);
				$("#loginButton").fadeIn("slow");
			},
			error: function(){
				$("#loginNotif").slideDown("slow").html('<div class="notification error"><span>Error with login form!</span></div>');
			}
		});
		$(":input","#loginForm").not(":button, :submit, :reset, :hidden").val('');
		e.preventDefault();
	});
	
	// aksi untuk memproses pada form yang ada
	$("form#ditatompel_form").bind("submit", function(e){
		$("#ditatompel_form_result, #ditatompel_form_buttonSubmit").hide();
		$.ajax({
			type: "POST",
			url: "action.php",
			data: $("form#ditatompel_form").serialize(),
			success: function(data){
				$("#ditatompel_form_result").fadeIn("slow").html(data);
			},
			error: function(){
				$("#ditatompel_form_result").fadeIn("slow").html('<div class="notification error"><span>Error with form!</span></div>');
			}
		});
		$("#ditatompel_form_buttonSubmit").fadeIn("slow");
		e.preventDefault();
	});
	
	
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
  
  
  