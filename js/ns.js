$(function(){
	$(".dropdown").click(function() {
		alert("asdf");
	});

	$(".menu").click(function() {
		var clicked_obj = $(this);
		var menu_content = $("#menu-nonuser");
		var overlay = $("#overlay1");
		if(!menu_content.hasClass("active")){
			open();
		} else {
			close();
		} 
		function open(){
			overlay.css("display","block")
			overlay.css("opacity","0.5")
			overlay.click(function(){
				close();
			});

			var offset = clicked_obj.offset();
			var offset_top = offset.top + clicked_obj.outerHeight()/2;
			var offset_left = offset.left + clicked_obj.outerWidth()/2;
			console.log(offset_left);
			console.log(offset_top);

			if(offset_left + menu_content.outerWidth() < $(window).width()){
				menu_content.css("right","");
				menu_content.css("left", offset_left);
			} else {
				menu_content.css("right", $(window).width() - offset_left);
				menu_content.css("left", "");
			}

			if(offset_top + menu_content.outerHeight() < $(window).height()){
				menu_content.css("bottom","");
				menu_content.css("top", offset_top);
			} else {
				menu_content.css("bottom", $(window).height() - offset_top);
				menu_content.css("top", "");
			}

			menu_content.css("opacity" ,"1");
			menu_content.addClass("active");
			menu_content.height(menu_content.children().length * 48);
		}
		function close(){
			overlay.css("opacity","0");

			menu_content.height(0);
			menu_content.css("opacity","0");
			menu_content.one("webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend",
				function(event) {
					console.log(menu_content.css("opacity"));
					if(menu_content.css("opacity") == "0"){
						menu_content.removeClass("active");
						overlay.css("display","none");
					}
				});			
		}
	});

	$(".img-slide-ctrl").click(function() {
		var clicked_obj = $(this);
		var images = clicked_obj.parent().children(".img-slide");
		var selected = clicked_obj.parent().children(".img-slide.active");
		var activeind = images.index(selected);
		console.log(activeind);
		if(clicked_obj.hasClass("r")){
			var next_img = $(images.get(activeind+1));
			next_img.css("left","");
		}
	});

	$(".modal-trigger").on("click", function(){
		var overlay = $("#overlay1");
		var href = $("a", this).attr('href');
		var modal = $(href);
		$(".modal.active").each(function(){
			var temp = $(this);
			temp.css("transform","scale(0.7)  translate(-50%, 0)");
			temp.css("opacity","0");
			temp.css("top","0");
			temp.one("webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend",
				function(event) {
					if(temp.css("opacity") == "0"){
						temp.removeClass("active");
					}
				});			
		});
		modal.addClass("active");
		modal.css("transform","scale(1)  translate(-50%, -50%)");
		modal.css("opacity","1");
		modal.css("top","50%");
		
		overlay.css("display","block")
		overlay.css("opacity","0.5")
		overlay.click(function(){
			close();
		});

		$(href).html("You clicked " + href + " !");
	});

	$(".dropdown").click(function() {
		alert("asdf");
	});


});