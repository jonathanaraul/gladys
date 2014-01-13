$("document").ready(function() {
	$(".fade_switch img").each(function() {
		var img = new Image;
		img.src = this.src;
		var my_parent = $(this).parent(".fade_switch");
		
		var my_index = $(my_parent).children().index(this);
		
		var myself = $(this);
		
		var count = 0;
		
		$(img).load(function() {
			$(myself).data("start_w", img.width);
			$(myself).data("start_h", img.height);
			if (my_index == 0) {
				$(my_parent).css({"width":img.width, "height":img.height});
			} else {
				$(myself).hide();
			}
		});
		
		$(this).css({"position":"absolute", "top":"0px", "left":"0px"});
	});
	
	$(".fade_switch").click(function() {
		if (!$(this).is(':animated')) {
			var vis_img = $(this).children(":visible");
			var hid_img = $(this).children(":hidden");
			
			$(vis_img).css("z-Index", "100");
			
			var vis_width = $(vis_img).data("start_w");
			var vis_height = $(vis_img).data("start_h");
			
			var hid_width = $(hid_img).data("start_w");
			var hid_height = $(hid_img).data("start_h");
			
			$(hid_img).css({"z-Index":"1","width":vis_width,"height":vis_height}).show();
			
			
			
			$(vis_img).animate({
				"opacity" : "0",
				"width" : hid_width,
				"height" : hid_height
			}, function() {
				$(this).css("z-Index", "1").hide().css("opacity", "100");
			});	

			$(hid_img).animate({
				"width" : hid_width,
				"height" : hid_height
			}, function() {
				$(this).css("z-Index", "100");
			});
			
			$(this).animate({
				"width" : hid_width,
				"height" : hid_height
			});
		}
	});
});
