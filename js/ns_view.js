function initialize(userType = 0) {
	//var jobinfo = [['Мэргэжил','Цалин','Ажиллах цаг','Хүйс','Нас','Боловсрол'], [['Үйлчилгээ'], ['Сарын','Өдрийн','Цагийн'], ['Ажлын өдрүүд','Бүх өдөр','Даваа','Мягмар','Лхагва','Пүрэв','Баасан','Бямба','Ням','Амралтын өдрүүд'], ['Эрэгтэй','Эмэгтэй'], ['18-25','25-30','30-с дээш'], ['Дээд','Дунд','Бага']], [[['Бармен','Цэвэрлэгч'], ['Зөөгч']], [], ['00','01','02','03','04','05','06','07','08','09','10','11','12','13','14','15','16','17','18','19','20','21','22','23']]]; 

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

	$('#map_button').click(function() {
		$(this).addClass('active');
		$('#map').addClass('active');

		$('#list_button').removeClass('active');
		$('#list').removeClass('active');

		if(!$('#map').hasClass('initd')){
			$('#map').addClass('initd');
			map_initialize(userType);
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

	//Styling ends here


	// Variable to hold request
	var login_request, signup_request, logout_request, insertjob_request, jobview_request;
	
	$("#loginform").submit(function(event){

        // Prevent default posting of form - put here to work in case of errors
        event.preventDefault();

        // Abort any pending request
        if (login_request) {
        	login_request.abort();
        }
        // setup some local variables
        var $form = $(this);

        // Let's select and cache all the fields
        var $inputs = $form.find("input, select, button, textarea");

        // Serialize the data in the form
        var serializedData = $form.serialize();

        // Let's disable the inputs for the duration of the Ajax request.
        // Note: we disable elements AFTER the form data has been serialized.
        // Disabled form elements will not be serialized.
        $inputs.prop("disabled", true);

        // Fire off the request to /form.php
        login_request = $.ajax({
        	url: "usermodel.php",
        	type: "post",
        	data: serializedData
        });

        // Callback handler that will be called on success
        login_request.done(function (response, textStatus, jqXHR){
        	if(response == "Login Successful"){
        		location.reload();
        	} else { 
        		$("#loginerrormsg").html(response);
        		$("#loginerrormsg").css("display", "block");
        	}
        });

        // Callback handler that will be called on failure
        login_request.fail(function (jqXHR, textStatus, errorThrown){
            // Log the error to the console
            console.error("Connection Failed");
        });

        // Callback handler that will be called regardless
        // if the request failed or succeeded
        login_request.always(function () {
            // Reenable the inputs
            $inputs.prop("disabled", false);
        });

    });

	$("#signupform").submit(function(event){

        // Prevent default posting of form - put here to work in case of errors
        event.preventDefault();

        // Abort any pending request
        if (signup_request) {
        	signup_request.abort();
        }
        // setup some local variables
        var $form = $(this);

        // Let's select and cache all the fields
        var $inputs = $form.find("input, select, button, textarea");

        // Serialize the data in the form
        var serializedData = $form.serialize();

        // Let's disable the inputs for the duration of the Ajax request.
        // Note: we disable elements AFTER the form data has been serialized.
        // Disabled form elements will not be serialized.
        $inputs.prop("disabled", true);

        // Fire off the request to /form.php
        signup_request = $.ajax({
        	url: "usermodel.php",
        	type: "post",
        	data: serializedData
        });

        // Callback handler that will be called on success
        signup_request.done(function (response, textStatus, jqXHR){
        	if(response == "Signed up Successful"){
        		location.reload();
        	} else { 
        		$("#signuperrormsg").html(response);
        		$("#signuperrormsg").css("display", "block");
        	}
        });

        // Callback handler that will be called on failure
        signup_request.fail(function (jqXHR, textStatus, errorThrown){
            // Log the error to the console
            console.error("Connection Failed");
        });

        // Callback handler that will be called regardless
        // if the request failed or succeeded
        signup_request.always(function () {
            // Reenable the inputs
            $inputs.prop("disabled", false);
        });

    });

	$(".logout").click(function() {

        // Prevent default posting of form - put here to work in case of errors
        event.preventDefault();

        // Abort any pending request
        if (logout_request) {
        	logout_request.abort();
        }

        // Fire off the request to /form.php
        logout_request = $.ajax({
        	url: "logout.php",
        	type: "post",
        	data: "0"
        });

        // Callback handler that will be called on success
        logout_request.done(function (response, textStatus, jqXHR){
        	location.reload();
        });

        // Callback handler that will be called on failure
        logout_request.fail(function (jqXHR, textStatus, errorThrown){
            // Log the error to the console
            console.error("Connection Failed");
        });
    });

	$("#insert-job-form").submit(function(event){

        // Prevent default posting of form - put here to work in case of errors
        event.preventDefault();

        // Abort any pending request
        if (insertjob_request) {
        	insertjob_request.abort();
        }

        var weeks = $('#insert-job-form .weekday');
        for (var i = 0; i < 7; i++) {
        	if (weeks[i].className.indexOf("active")!=-1){
        		switch(i){
        			case 0: $("#mon").val(1); break;
        			case 1: $("#tue").val(1); break;
        			case 2: $("#wed").val(1); break;
        			case 3: $("#thu").val(1); break;
        			case 4: $("#fri").val(1); break;
        			case 5: $("#sat").val(1); break;
        			case 6: $("#sun").val(1); break;
        		}
        	}
        }
        
        // setup some local variables
        var $form = $(this);

        var formData = new FormData(this);

        // Let's select and cache all the fields
        var $inputs = $form.find("input, select, button, textarea");

        // Let's disable the inputs for the duration of the Ajax request.
        // Note: we disable elements AFTER the form data has been serialized.
        // Disabled form elements will not be serialized.
        $inputs.prop("disabled", true);

        // Fire off the request to /form.php
        insertjob_request = $.ajax({
        	url: "jobmodel.php",
        	type: "post",
        	data: formData,
        	contentType: false,      
        	cache: false,           
        	processData:false
        });

        // Callback handler that will be called on success
        insertjob_request.done(function (response, textStatus, jqXHR){
        	if(response == "Insert Successful"){
        		location.reload();
        	} else { 
        		$("#insertjoberrormsg").html(response);
        		$("#insertjoberrormsg").css("display", "block");
        	}
        });

        // Callback handler that will be called on failure
        insertjob_request.fail(function (jqXHR, textStatus, errorThrown){
            // Log the error to the console
            console.error("Connection Failed");
        });

        // Callback handler that will be called regardless
        // if the request failed or succeeded
        insertjob_request.always(function () {
            // Reenable the inputs
            $inputs.prop("disabled", false);
        });

    });

}



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

function getJobsBriefData(userType = 0) {
	jobview_request = $.ajax({
		url: "jobviewmodel.php?t=0",
		type: "get",
		data: 0
	});

	// Callback handler that will be called on success
	jobview_request.done(function (response, textStatus, jqXHR){
		if(response != "" && response != null) {
			console.log(response);
			jobs = JSON.parse(response);
			loadList(jobs, userType);
		}
	});

	// Callback handler that will be called on failure
	jobview_request.fail(function (jqXHR, textStatus, errorThrown){
		// Log the error to the console
		console.error("Connection Failed");
	});
}

function loadList(job_big_array, userType){
	var list = $("#list .lists");
	var len = job_big_array.length;

	for(var i = 0; i < len; i++) {
		switch(job_big_array[i][4]){
			case '0': job_big_array[i][4] = "Цагийн"; break;
			case '1': job_big_array[i][4] = "Өдрийн"; break;
			case '2': job_big_array[i][4] = "7 хоногоор"; break;
			case '3': job_big_array[i][4] = "Сараар"; break;
		} 
		var job_part1 = '<div class = "list-item"><a href = "#!" class = "head"><div class = "imgcontainer"><img src = "imgs/' + job_big_array[i][3] + '"></div></a><div class = "body"><a href = "#!" class = "header">Ажлын нэр: ' + job_big_array[i][1] + '</a><p>Ажиллах газрын нэр: ' + job_big_array[i][2] + '</p><p>' + job_big_array[i][4] + " " + job_big_array[i][5] + "₮</p>"+'</div>';

		if(userType == 0) {
			var job_part2 = '<a href = "#!" class = "list-item-save" onclick = saveJob(' + job_big_array[i][0] + ')><span>Хадгалах</span><i class = "material-icons md-36">save</i></a><a href = "#!" class = "list-item-detail" onclick = "loadJob(' + job_big_array[i][0] + ')"><span>Дэлгэрэнгүй</span><i class = "material-icons md-36">fullscreen</i></a></div>';
		} else if(userType == 1) {
			var job_part2 = '<a href = "#!" class = "list-item-save" onclick = addJob(' + job_big_array[i][0] + ')><span>Хадгалах</span><i class = "material-icons md-36">save</i></a><a href = "#!" class = "list-item-detail" onclick = "loadJob(' + job_big_array[i][0] + ')"><span>Дэлгэрэнгүй</span><i class = "material-icons md-36">fullscreen</i></a><a href = "#!" class = "list-item-remove"  onclick = "removeJob(' + job_big_array[i][0] + ')"><span>Устгах</span><i class="material-icons md-36">delete_forever</i></a></div>';
		}

		list.prepend(job_part1 + job_part2);
	}
}

function loadJob(id) {
	jobview_request = $.ajax({
		url: "jobviewmodel.php?t=1&id="+id,
		type: "get",
		data: 0
	});

	// Callback handler that will be called on success
	jobview_request.done(function (response, textStatus, jqXHR){
		if(response != "" && response != null) {
			job = JSON.parse(response);
			feed_job_info_modal(job[0]);
		}
	});

	// Callback handler that will be called on failure
	jobview_request.fail(function (jqXHR, textStatus, errorThrown){
		// Log the error to the console
		console.error("Connection Failed");
	});
}

function addJob(id) {
	jobview_request = $.ajax({
		url: "jobviewmodel.php?t=4&id="+id,
		type: "get",
		data: 0
	});

	// Callback handler that will be called on success
	jobview_request.done(function (response, textStatus, jqXHR){
		if(response != "" && response != null) {
			console.log(response);
			//location.reload();
		}
	});

	// Callback handler that will be called on failure
	jobview_request.fail(function (jqXHR, textStatus, errorThrown){
		// Log the error to the console
		console.error("Connection Failed");
	});
}

function removeJob(id) {
	jobview_request = $.ajax({
		url: "jobviewmodel.php?t=5&id="+id,
		type: "get",
		data: 0
	});

	// Callback handler that will be called on success
	jobview_request.done(function (response, textStatus, jqXHR){
		if(response != "" && response != null) {
			console.log(response);
			location.reload();
		}
	});

	// Callback handler that will be called on failure
	jobview_request.fail(function (jqXHR, textStatus, errorThrown){
		// Log the error to the console
		console.error("Connection Failed");
	});
}

function feed_job_info_modal(job) {
	switch(job[4]){
		case 0: job[4] = "Цагийн"; break;
		case 1: job[4] = "Өдрийн"; break;
		case 2: job[4] = "7 хоногоор"; break;
		case 3: job[4] = "Сараар"; break;
	} 
	switch(job[12]){
		case 0: job[12] = "Хүйс хамаагүй"; break;
		case 1: job[12] = "Эрэгтэй"; break;
		case 2: job[12] = "Эмэгтэй"; break;
	} 
	switch(job[13]){
		case 0: job[13] = "Нас хамаагүй"; break;
		case 1: job[13] = "18-с 25 настай"; break;
		case 2: job[13] = "25-с 35 настай"; break;
		case 3: job[13] = "35-с дээш"; break;
	} 
	switch(job[14]){
		case 0: job[14] = "Боловсрол хамаагүй"; break;
		case 1: job[14] = "Бүрэн дунд боловсролтой"; break;
		case 2: job[14] = "Дээд боловсролтой"; break;
	} 
	jobinfo_modal = $("#job-info");
	jobinfo_modal.find("#jinfo-jobName").html(job[1]);
	jobinfo_modal.find("#jinfo-orgName").html(job[2]);
	jobinfo_modal.find("#jinfo-orgLogo").attr("src", "../../imgs/" + job[3]);
	jobinfo_modal.find("#jinfo-salary").html(job[4] + " " + job[5]);
	setclockstart(parseInt(job[6]), "info");
	setclockend(parseInt(job[7]), "info");
	setWeek(job[8],"jinfo");
	jobinfo_modal.find("#jinfo-email").html(job[9]);
	jobinfo_modal.find("#jinfo-phone1").html(job[10]);
	jobinfo_modal.find("#jinfo-phone2").html(job[11]);
	jobinfo_modal.find("#jinfo-gender").html(job[12]);
	jobinfo_modal.find("#jinfo-age").html(job[13]);
	jobinfo_modal.find("#jinfo-edu").html(job[14]);

	open_modal("#job-info");
}
