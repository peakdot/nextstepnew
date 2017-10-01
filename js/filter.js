currtptimestart = 9;
currtptimeend = 18;
filterstatus = false;
filter = $("#filter");

function showFilter(){
	if(filterstatus==false){
		$('#filter').addClass('active');
		filterstatus = true;
	} else {
		$('#filter').removeClass('active');
		filterstatus = false;
	}
}

function setWeek(bindays, type) {
	if(bindays % 2 == 1) {
		$("#"+type+"-mon").addClass("active");
		bindays --;
	} else {
		$("#"+type+"-mon").removeClass("active");		
	}
	bindays = (bindays / 2);

	if(bindays % 2 == 1) {
		$("#"+type+"-tue").addClass("active");
		bindays --;
	} else {
		$("#"+type+"-tue").removeClass("active");		
	}
	bindays = (bindays / 2).toFixed(0);

	if(bindays % 2 == 1) {
		$("#"+type+"-wed").addClass("active");
		bindays --;
	} else {
		$("#"+type+"-wed").removeClass("active");		
	}
	bindays = (bindays / 2).toFixed(0);
	if(bindays % 2 == 1) {
		$("#"+type+"-thu").addClass("active");
		bindays --;
	} else {
		$("#"+type+"-thu").removeClass("active");		
	}
	bindays = (bindays / 2).toFixed(0);

	if(bindays % 2 == 1) {
		$("#"+type+"-fri").addClass("active");
		bindays --;
	} else {
		$("#"+type+"-fri").removeClass("active");		
	}
	bindays = (bindays / 2).toFixed(0);

	if(bindays % 2 == 1) {
		$("#"+type+"-sat").addClass("active");
		bindays --;
	} else {
		$("#"+type+"-sat").removeClass("active");		
	}
	bindays = (bindays / 2).toFixed(0);

	if(bindays % 2 == 1) {
		$("#"+type+"-sun").addClass("active");
		bindays --;
	} else {
		$("#"+type+"-sun").removeClass("active");		
	}
}

function activatetp(t, type){
	if(t==0){
		$('#'+type+'-tp-time1').addClass('selecteded');
		$('#'+type+'-tp-time2').removeClass('selecteded');					
	} else {
		$('#'+type+'-tp-time2').addClass('selecteded');
		$('#'+type+'-tp-time1').removeClass('selecteded');		
	}
}

function setclock(time, type){
	if ($('#'+type+'-tp-time1').hasClass('selecteded')){
		setclockstart(time, type);
	} else {
		setclockend(time, type);
	}
}

function setclockstart(time, type){
	$('#'+type+'-timepincircle1').attr('transform','rotate('+time*15+' 150 150)');
	$('#'+type+'-timepin1').attr('transform','rotate('+time*15+' 150 150)');
	$('#'+type+'-detailstart').attr('transform','rotate('+time*15+' 150 150)');
	if(currtptimestart%2==1)
		$('#'+type+'-tp-'+currtptimestart).attr('fill','#e0e0e0');
	else
		$('#'+type+'-tp-'+currtptimestart).attr('fill','black');
	$('#'+type+'-tp-'+time).attr('fill','white');
	currtptimestart = time
	$('#'+type+'-tp-time1').html(currtptimestart+':00');

	if(type == "insert-job") {
		$("#startTime").val(currtptimestart);
	}
}

function setclockend(time, type){
	$('#'+type+'-timepincircle2').attr('transform','rotate('+time*15+' 150 150)');
	$('#'+type+'-timepin2').attr('transform','rotate('+time*15+' 150 150)');
	$('#'+type+'-detailend').attr('transform','rotate('+time*15+' 150 150)');
	if(currtptimeend%2==1)
		$('#'+type+'-tp-'+currtptimeend).attr('fill','#e0e0e0');
	else
		$('#'+type+'-tp-'+currtptimeend).attr('fill','black');
	$('#'+type+'-tp-'+time).attr('fill','white');
	currtptimeend = time
	$('#'+type+'-tp-time2').html(currtptimeend+':00');

	if(type == "insert-job") {
		$("#endTime").val(currtptimeend);
	}
}

function getfilterparas(){
	var jwork = $('#fjobtype').val();
	var jsalarymin = $('#fsalarymin').val();
	var jsalarymax = $('#fsalarymax').val();
	var jweekinfo = [0,0,0,0,0,0,0];
	var result = {fwork:"", as:"500", color:"white"};
	var jweeks = $('.fweekday');
	for (var i = 0; i < 7; i++) {
		if (jweeks[i].className.indexOf("active")!=-1){
			switch(i){
				case 0: jweekinfo[0] = 1; break;
				case 1: jweekinfo[1] = 1; break;
				case 2: jweekinfo[2] = 1; break;
				case 3: jweekinfo[3] = 1; break;
				case 4: jweekinfo[4] = 1; break;
				case 5: jweekinfo[5] = 1; break;
				case 6: jweekinfo[6] = 1; break;
			}
		}
	}
	return {'fwork': jwork, 'fsalarymin': jsalarymin, 'fsalarymax': jsalarymax, 'fweeks': jweeks, 'ftimestart': currtptimestart, 'ftimeend': currtptimeend};
}