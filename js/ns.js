$(function(){
	var jobinfo = [['Мэргэжил','Цалин','Ажиллах цаг','Хүйс','Нас','Боловсрол'], [['Үйлчилгээ'], ['Сарын','Өдрийн','Цагийн'], ['Ажлын өдрүүд','Бүх өдөр','Даваа','Мягмар','Лхагва','Пүрэв','Баасан','Бямба','Ням','Амралтын өдрүүд'], ['Эрэгтэй','Эмэгтэй'], ['18-25','25-30','30-с дээш'], ['Дээд','Дунд','Бага']], [[['Бармен','Цэвэрлэгч'], ['Зөөгч']], [], ['00','01','02','03','04','05','06','07','08','09','10','11','12','13','14','15','16','17','18','19','20','21','22','23']]]; 



	$(".dropdown").click(function() {
		alert("asdf");
	});

	$('.search-button, .close-search-field').click(function() {
		var search_field = $('.search-field');
		if(search_field.hasClass('active')){
			search_field.removeClass('active');
		} else {
			search_field.addClass('active');
		}
	});

	$('#input-requirement').keyup(function() {
		var input = $(this);
		var input_text = input.val();
		var endPos = input.selectionEnd;
		var startPos = endPos;

		for(; startPos>=0; startPos--) {
			if(input_text.charAt(startPos)==','){
				break;
			}
		}
		startPos++;

		console.log(startPos);

		var input_texts = input_text.substr(startPos,endPos).split(' ');

		if(input_text.length);

	});

	$(".menu").click(function() {
		var clicked_obj = $(this);
		var href = $(this).attr('href');
		if(!$(href).hasClass("active")){
			open_menu(href, clicked_obj);
		} else {
			close_menu(href);
		} 
	});

	$('.menu-content li').click( function() {
		close_menu('#'+$(this).parent().attr('id'));
	});

	function open_menu(href, clicked_obj){
		var overlay = $("#overlay1");
		menu_content = $(href);
		overlay.addClass('active');
		overlay.click(function(){
			console.log(href);
			close_menu(href);
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

		menu_content.addClass("active");
	}

	function close_menu(href){
		var overlay = $("#overlay1");
		menu_content = $(href);
		overlay.removeClass('active');
		menu_content.removeClass('active');
	}

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
		var href = $(this).attr('href');
		if($(href).hasClass("active")){
			close_modal(href);
		} else {
			open_modal(href);
		}
	});

	function open_modal(href){
		var modal = $(href);
		var overlay = $("#overlay1");

		if(modal.hasClass("modal")){
			close_modals();

			$(".close-modal, .close-modal-button").on("click", function(){
				close_modal(href);
			});

			modal.addClass('active');
			overlay.addClass('active');
			overlay.click(function(){
				modal.removeClass('active');
				overlay.removeClass('active');
			});
		}
	}

	function close_modal(href){
		var modal = $(href);
		var overlay = $("#overlay1");
		if(modal.hasClass("active") && modal.hasClass("modal")){
			modal.removeClass('active');
			overlay.removeClass('active');
		}
	}

	function close_modals(){
		$(".modal.active").each(function(){
			var temp = $(this);
			temp.removeClass('active');		
		});
	}

	$('#map_button').click(function() {
		$(this).addClass('active');
		$('#map').addClass('active');

		$('#list_button').removeClass('active');
		$('#list').removeClass('active');

		if(!$('#map').hasClass('initd')){
			$('#map').addClass('initd');
			map_initialize();
		}
	});

	$('#list_button').click(function() {
		$('#map').removeClass('active');
		$('#map_button').removeClass('active');

		$(this).addClass('active');
		$('#list').addClass('active');		
	});

	$('.weekday.selectable').click(function() {
		if($(this).hasClass("active")){
			$(this).removeClass("active");
		} else {
			$(this).addClass("active");
		}
	});

	$("input").on("input", function() {
		var temp = $(this);
		if(temp.val()=="" && temp.hasClass("active")){
			temp.removeClass("active");
		} else if(temp.val()!=""){
			temp.addClass("active");
		}
	});

	function imagesPreview(input, parent2nd) {
		var reader = new FileReader();

		reader.onload = function(event) {
			var img = parent2nd.children('img');
			img.attr('src', event.target.result);
			var icon = parent2nd.children('.img-upload-container').children('.img-upload-icon')
			icon.children('i').html('edit');
			icon.children('p').html('Зургаа өөрчлөх');
			icon.addClass('active');
		}

		reader.readAsDataURL(input.files[0]);
	};

	$(".img-upload").on('change', function() {
		var changed_obj = $(this);
		imagesPreview(this, changed_obj.parent().parent());
	});

	$('.list-item-save').click(function() {
		var clicked_obj = $(this);
		if(clicked_obj.hasClass('active')){
			clicked_obj.removeClass('active');
			clicked_obj.children('span').html('Хадгалах');
		} else {
			clicked_obj.addClass('active');
			clicked_obj.children('span').html('Хадгалагдсан');			
		}
	});

	$(".dropdown").click(function() {
		alert("asdf");
	});
});