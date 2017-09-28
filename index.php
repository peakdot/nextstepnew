<?php
session_start();

$userLogged = false;
if(!isset($_SESSION["usertype"]) || !isset($_SESSION["id"])) {
	$userLogged = false;
	session_unset();
} else {
	$userLogged = true;
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta name = "viewport" content = "width=device-width, initial-scale=1.0">
	<link type = "text/css" href = "css/nextstep.css" rel = "stylesheet">
	<link type = "text/css" href = "css/filter.css" rel = "stylesheet">
	<link rel = "icon" href = "nextstepg.png">
	<link href = "https://fonts.googleapis.com/icon?family=Material+Icons" rel = "stylesheet">
	<title>NextStep</title>
</head>
<body>

	<nav>
		<a href = "index.php" class = "title"><img src = "nextstepw.png" class = "logo"><span>Nextstep</span></a>
		<a href = "#menu" class = "nav-item r min menu"><?php echo $userLogged? '<div class="circle"><img src="imgs/'.$_SESSION["accpro"].'"/></div>':'<i class = "material-icons md-36">account_circle</i>' ?></a>
		<?php 
		if(!$userLogged) {
			echo '<a href = "#login" class = "nav-item r modal-trigger"><i class = "material-icons md-36">account_circle</i><span>Нэвтрэх</span></a>';
		} else {
			echo '<a href = "#menu" class = "nav-item r menu"><div id = "profile-pic" class = "circle"><img src="imgs/'.$_SESSION["accpro"].'"/></div><span>'.$_SESSION["fname"].'</span></a>';
		}
		?>
		<a href = <?php echo $userLogged?'"#insert-job"':'"#login"'?> class = "nav-item r modal-trigger"><i class = "material-icons md-36">add</i><span>Зар нэмэх</span></a>
		<a href = "#!" class = "nav-item r search-button"><i class = "material-icons md-36">search</i><span>Хайх</span></a>
		<a href = "#!" class = "nav-item l active" id = "list_button"><i class = "material-icons md-36">view_list</i><span>Жагсаалт</span></a>
		<a href = "#!" class = "nav-item l" id = "map_button"><i class = "material-icons md-36">gps_fixed</i><span>Газрын зураг</span></a>
	</nav>

	<a href = "#insert-job" class="button floating-buttons green modal-trigger" id = "doneButton" onclick="getLocationFromUser()"><i class="material-icons">done</i></a>

	<div class = "search-field">
		<div class = "close-search-field"><i class = "material-icons md-24">expand_less</i></div>
		<div class = "title">
			<span>Хайх</span>
		</div>

		<div class = "filter-add-field">
			<i class = "material-icons md-24">add</i>
			<input id = "input-requirement" type = "text-area" name = "username" list = "search-value-suggesstor" placeholder = "Зөөгч, цалин 50000-с дээш г.м" autocomplete = "off">
		</div>

		<div class = "filter-objs">
			<div class = "filter-obj">
				<div class = "remove-filter-obj">
					<i class = "material-icons md-24">cancel</i>
				</div>

				<div class = "filter-obj-icon">
					<i class = "material-icons md-24">school</i>
				</div>
				<span>Хохо</span>
			</div>
			<div class = "filter-obj">
				<div class = "remove-filter-obj">
					<i class = "material-icons md-24">cancel</i>
				</div>

				<div class = "filter-obj-icon">
					<i class = "material-icons md-24">school</i>
				</div>
				<span>Өдрийн цалин 10000-с дээш</span>
			</div>
			<div class = "filter-obj">
				<div class = "remove-filter-obj">
					<i class = "material-icons md-24">cancel</i>
				</div>

				<div class = "filter-obj-icon">
					<i class = "material-icons md-24">school</i>
				</div>
				<span>Даваа 10:00-13:20</span>
			</div>
			<div class = "filter-obj">
				<div class = "remove-filter-obj">
					<i class = "material-icons md-24">cancel</i>
				</div>

				<div class = "filter-obj-icon">
					<i class = "material-icons md-24">school</i>
				</div>
				<span>Ажлын өдрүүдэд 10:00-13:20</span>
			</div>
		</div>
		<button class = "button flat orange">
			<i class = "material-icons md-24">clear</i>
			<span>Арилгах</span>
		</button>
		<button class = "button raised">
			<i class = "material-icons md-24">search</i>
			<span>Хайх</span>
		</button>
	</div>

	<ul id = "menu" class = "menu-content">
		<?php 
		echo $userLogged?'<li><a href = "#userinfo" class = "modal-trigger"><i class = "material-icons md-36">settings</i>Тохиргоо</a></li>
		<li><a href = "#logout" class = "modal-trigger logout"><i class = "material-icons md-36">exit_to_app</i>Гарах</a></li>':'<li><a href = "#login" class = "modal-trigger"><i class = "material-icons md-36">person_outline</i>Нэвтрэх</a></li>
		<li><a href = "#signup" class = "modal-trigger"><i class = "material-icons md-36"><i class="material-icons">person_add</i></i>Бүртгүүлэх</a></li>';
		?>
	</ul>

	<div id = "floating-add-search" class = "floating-buttons">
		<a href = <?php echo $userLogged?'"#insert-job"':'"#login"'?> class = "red modal-trigger"><i class = "material-icons md-24">add</i></a>
		<a href = "#!" class = "search-button orange"><i class = "material-icons md-24">search</i></a>
	</div>


	<div id = "login" class = "modal">
		<div class = "close-modal-button"><i class = "material-icons md-24">close</i></div>
		<div class = "body">
			<div class = "header">
				<div id = "loginimg">
					<img src = "imgs/login.png">
				</div>	
			</div>
			<form id = "loginform">
				<input type = "hidden" name = "type" value = "0">
				<div class = "info">
					<div class = "title">Нэвтрэх</div>
					<div id = "loginerrormsg" class = "errormsg">
					</div>
					<div class = "info-item">
						<div class = "input-field col-12">
							<input type = "text" name = "email">
							<label for = "username">И-мэйл хаяг</label>
							<div class = "bot-line"></div>
						</div>
						<div class = "input-field col-12">
							<input type = "password" name = "password">
							<label for = "password">Нууц үг</label>
							<div class = "bot-line"></div>
						</div>
					</div>
					<div class = "info-item">
						<center>				
							<input type = "submit" value = "Нэвтрэх" class = "button raised">
							<a href = "#signup" class = "button flat modal-trigger">Бүртгүүлэх</a>
						</center>
					</div>
				</div>
			</form>
		</div>
	</div>

	<div id = "signup" class = "modal">
		<div class = "close-modal-button"><i class = "material-icons md-24">close</i></div>
		<div class = "body">
			<div class = "header">
				<div id = "loginimg">
					<img src = "imgs/login.png">
				</div>	
			</div>
			<div class = "info">
				<div class = "title">Бүртгүүлэх</div>
				<form id = "signupform">
					<input type = "hidden" name = "type" value = "1">
					<div id = "signuperrormsg" class = "errormsg">
					</div>
					<div class = "info-item">
						<div class = "input-field col-12">
							<input type = "text" name = "fname">
							<label for = "fname">Нэр</label>
							<div class = "bot-line"></div>
						</div>
						<div class = "input-field col-12">
							<input type = "text" name = "lname">
							<label for = "lname">Овог</label>
							<div class = "bot-line"></div>
						</div>
						<div class = "input-field col-12">
							<input type = "text" name = "email">
							<label for = "email">И-мэйл хаяг</label>
							<div class = "bot-line"></div>
						</div>
						<div class = "input-field col-12">
							<input type = "password" name = "password">
							<label for = "password">Нууц үг</label>
							<div class = "bot-line"></div>
						</div>
						<div class = "input-field col-12">
							<input type = "password" name = "repassword">
							<label for = "repassword">Нууц үгээ дахин оруулна уу</label>
							<div class = "bot-line"></div>
						</div>
					</div>
					<div class = "info-item">
						<center>				
							<input type = "submit" class = "button raised" value = "Бүртгүүлэх">
							<a href = "#login" class = "button flat modal-trigger">Буцах</a>
						</center>
					</div>
				</form>
			</div>
		</div>
	</div>

	<div id = "job-info" class = "modal">
		<div class = "head">
			<div class = "close-modal-button"><i class = "material-icons md-24">arrow_back</i></div>
		</div>
		<div class = "body">
			<div class = "header">
				<div class = "title"></div>	
				<div class = "headimg">
					<img id = "jinfo-orgLogo" src = "">
				</div>
			</div>
			<div class = "info">
				<div class = "subheader">
					<span>Ажлын нэр</span>
				</div>
				<div class = "info-item">
					<i class = "material-icons md-24">assignment</i><span id = "jinfo-orgName"></span>
				</div>
				<div class = "info-item">
					<i class = "material-icons md-24"></i><span id = "jinfo-jobName"></span>
				</div>
				<div class = "subheader">
					<span>Цалин</span>
				</div>
				<div class = "info-item">
					<i class = "material-icons md-24">account_balance_wallet</i><span id = "jinfo-salary"></span>
				</div>
				<div class = "subheader">
					<span>Холбоо барих</span>
				</div>
				<div class = "info-item">
					<i class = "material-icons md-24">phone</i><span id = "jinfo-phone1"></span>
				</div>
				<div class = "info-item">
					<i class = "material-icons md-24"></i><span id = "jinfo-phone2"></span>
				</div>
				<div class = "info-item">
					<i class = "material-icons md-24">email</i><span id = "jinfo-email"></span>
				</div>
				<div class = "subheader">
					<span>Шаардлагууд</span>
				</div>
				<div class = "info-item">
					<i class = "material-icons md-24">person_outline</i><span id = "jinfo-gender">Хүйс хамаагүй</span>
				</div>
				<div class = "info-item">
					<i class = "material-icons md-24">school</i><span id = "jinfo-edu">Дээд болон түүнээс дээш боловсролтой</span>
				</div>
				<div class = "info-item">
					<i class = "material-icons md-24">accessibility</i><span id = "jinfo-age">18-с дээш</span>
				</div>
				<div class = "subheader">
					<span>Ажиллах цагийн хуваарь</span>
				</div>
				<div class = "info-item">
					<ul class = "weekinfo" onclick = "">
						<li id = "jinfo-mon" class  =  "weekday unselectable">Да</li>
						<li id = "jinfo-tue" class  =  "weekday unselectable">Мя</li>
						<li id = "jinfo-wed" class  =  "weekday unselectable">Лха</li>
						<li id = "jinfo-thu" class  =  "weekday unselectable">Пү</li>
						<li id = "jinfo-fri" class  =  "weekday unselectable">Ба</li>
						<li id = "jinfo-sat" class  =  "weekday unselectable">Бя</li>
						<li id = "jinfo-sun" class  =  "weekday unselectable">Ня</li>
					</ul>
					<center>
						<div class = "timepicker">
							<div style  =  "background-color: #3f51b5; font-size: 36px; color: grey; margin-bottom: 10px;">
								<center>
									<span id = "info-time1" class = "selecteded">09:00</span><span> - </span><span id = "info-time2" class = "selecteded">18:00</span>
								</center>
							</div>
							<svg class = "timecircle" id = "info-timepicker">
								<circle cx = "150" cy = "150" r = "100" stroke = "#e0e0e0" stroke-width = "1" fill = "#e0e0e0" />
								<circle cx = "150" cy = "150" r = "2" fill = "#3f51b5"/>
								<line id = "info-timepin1" x1 = "150" y1 = "150" x2 = "150" y2 = "70" transform = "rotate(135 150 150)" style = "stroke:#3f51b5;stroke-width:2" />
								<text id = "info-detailstart" x = "130" y = "45" transform = "rotate(135 150 150)" fill = "#3f51b5">Эхлэх</text>
								<circle id = "info-timepincircle1" cx = "150" cy = "70" r = "15" fill = "#3f51b5" transform = "rotate(135 150 150)"/>
								<line id = "info-timepin2" x1 = "150" y1 = "150" x2 = "150" y2 = "70" transform = "rotate(270 150 150)" style = "stroke:#3f51b5;stroke-width:2" />
								<text id = "info-detailend" x = "120" y = "45" transform = "rotate(270 150 150)"  fill = "#3f51b5">Дуусах</text>
								<circle id = "info-timepincircle2" cx = "150" cy = "70" r = "15" fill = "#3f51b5" transform = "rotate(270 150 150)"/>
								<text x = "142" y = "75" id  =  'info-tp-24' fill = "black" class  =  "unselectable">24</text>
								<text x = "167" y = "77" id  =  'info-tp-1' fill = "#e0e0e0" class  =  "unselectable">1</text>
								<text x = "186" y = "85" id  =  'info-tp-2' fill = "black" class  =  "unselectable">2</text>
								<text x = "203" y = "98" id  =  'info-tp-3' fill = "#e0e0e0" class  =  "unselectable">3</text>
								<text x = "215" y = "115" id  =  'info-tp-4' fill = "black" class  =  "unselectable">4</text>
								<text x = "223" y = "134" id  =  'info-tp-5' fill = "#e0e0e0" class  =  "unselectable">5</text>
								<text x = "226" y = "155" id  =  'info-tp-6' fill = "black" class  =  "unselectable">6</text>
								<text x = "223" y = "176" id  =  'info-tp-7' fill = "#e0e0e0" class  =  "unselectable">7</text>
								<text x = "215" y = "195" id  =  'info-tp-8' fill = "black" class  =  "unselectable">8</text>
								<text x = "203" y = "212" id  =  'info-tp-9' fill = "white" class  =  "unselectable">9</text>
								<text x = "182" y = "224" id  =  'info-tp-10' fill = "black" class  =  "unselectable">10</text>
								<text x = "163" y = "232" id  =  'info-tp-11' fill = "#e0e0e0" class  =  "unselectable">11</text>
								<text x = "142" y = "235" id  =  'info-tp-12' fill = "black" class  =  "unselectable">12</text>
								<text x = "122" y = "232" id  =  'info-tp-13' fill = "#e0e0e0" class  =  "unselectable">13</text>
								<text x = "102" y = "224" id  =  'info-tp-14' fill = "black" class  =  "unselectable">14</text>
								<text x = "85" y = "212" id  =  'info-tp-15' fill = "#e0e0e0" class  =  "unselectable">15</text>
								<text x = "73" y = "195" id  =  'info-tp-16' fill = "black" class  =  "unselectable">16</text>
								<text x = "65" y = "176" id  =  'info-tp-17' fill = "#e0e0e0" class  =  "unselectable">17</text>
								<text x = "62" y = "155" id  =  'info-tp-18' fill = "white" class  =  "unselectable">18</text>
								<text x = "65" y = "134" id  =  'info-tp-19' fill = "#e0e0e0" class  =  "unselectable">19</text>
								<text x = "73" y = "115" id  =  'info-tp-20' fill = "black" class  =  "unselectable">20</text>
								<text x = "86" y = "98" id  =  'info-tp-21' fill = "#e0e0e0" class  =  "unselectable">21</text>
								<text x = "102" y = "85" id  =  'info-tp-22' fill = "black" class  =  "unselectable">22</text>
								<text x = "122" y = "77" id  =  'info-tp-23' fill = "#e0e0e0" class  =  "unselectable">23</text>
							</svg>
						</div>
					</center>
				</div>
			</div>
		</div>
	</div>

	<form id = "insert-job-form" method = "post" accept-charset="utf-8" enctype="multipart/form-data">
		<input type="hidden" name="type" value="0">
		<div id = "insert-job" class = "modal">
			<div class = "head">
				<div class = "title">Ажлын зар нэмэх</div>
				<div class = "close-modal-button close-modal"><i class = "material-icons md-24">close</i></div>
				<input class = "modal-button" type = "submit" value = "Хадгалах" />
			</div>
			<div class = "body">
				<div class = "header">
					<div class = "headimg">
						<img src = "">
						<div class = "img-upload-container">
							<div class = "img-upload-icon">
								<i class = "material-icons md-48">add</i>
								<p>Зураг нэмэх</p>
							</div>
							<input type = "hidden" name = "MAX_FILE_SIZE" value = "52428800" />
							<input class = "img-upload" type="file" name="coverimg">
						</div>
					</div>
				</div>
				<div class = "info">
					<div id = "insertjoberrormsg" class = "errormsg"></div>
					<div class = "subheader">
						<span>Ажлын тухай</span>
					</div>
					<div class = "info-item">
						<i class = "material-icons md-24 input-icon">assignment</i>
						<div class = "input-field col-s-12">
							<input type = "text" name = "orgName" required>
							<label for = "orgName">Ажиллах газрын нэр</label>
							<div class = "bot-line"></div>
						</div>
					</div>
					<div class = "info-item">
						<i class = "material-icons md-24 input-icon"></i>
						<div class = "input-field col-s-12">
							<input type = "text" name = "jobName" required>
							<label for = "jobName">Мэргэжил</label>
							<div class = "bot-line"></div>
						</div>
					</div>
					<div class = "subheader">
						<span>Цалин</span>
					</div>
					<div class = "info-item">
						<i class = "material-icons md-24 input-icon">account_balance_wallet</i>
						<div class = "input-field col-s-6">
							<select name = "salaryType">
								<option value = "0">Цагийн</option>
								<option value = "1">Өдрийн</option>
								<option value = "2">7 хоногоор</option>
								<option value = "3">Сараар</option>
							</select>
						</div>
						<div class = "input-field col-s-6">
							<input type = "number" name = "salary" step = "500" required>
							<label for = "salary">Мөнгөн дүн</label>
							<div class = "bot-line"></div>
						</div>
					</div>
					<div class = "subheader">
						<span>Холбоо барих</span>
					</div>
					<div class = "info-item">
						<i class = "material-icons md-24 input-icon">phone</i>
						<div class = "input-field col-s-12">
							<input type = "number" name = "phone1" required>
							<label for = "phone1">Утасны дугаар 1</label>
							<div class = "bot-line"></div>
						</div>
					</div>
					<div class = "info-item">
						<i class = "material-icons md-24 input-icon">phone</i>
						<div class = "input-field col-s-12">
							<input type = "number" name = "phone2">
							<label for = "phone2">Утасны дугаар 2</label>
							<div class = "bot-line"></div>
						</div>
					</div>
					<div class = "info-item">
						<i class = "material-icons md-24 input-icon">email</i>
						<div class = "input-field col-s-12">
							<input type = "text" name = "email">
							<label for = "email">И-мэйл</label>
							<div class = "bot-line"></div>
						</div>
					</div>
					<div class = "subheader">
						<span>Шаардлагууд</span>
					</div>
					<div class = "info-item">
						<i class = "material-icons md-24 input-icon">person_outline</i>
						<div class = "input-field col-s-12">
							<select name = "gender">
								<option value = "0">Хүйс хамаагүй</option>
								<option value = "1">Эрэгтэй</option>
								<option value = "2">Эмэгтэй</option>
							</select>
						</div>
					</div>
					<div class = "info-item">
						<i class = "material-icons md-24 input-icon">school</i>
						<div class = "input-field col-s-12">
							<select name = "edu">
								<option value = "0">Боловсрол хамаагүй</option>
								<option value = "1">Бүрэн дунд боловсролтой</option>
								<option value = "2">Дээд боловсролтой</option>
							</select>
						</div>
					</div>
					<div class = "info-item">
						<i class = "material-icons md-24 input-icon">accessibility</i>
						<div class = "input-field col-s-12">
							<select name = "age">
								<option value = "0">Нас хамаагүй</option>
								<option value = "1">18-с 25 настай</option>
								<option value = "2">25-с 35 настай</option>
								<option value = "3">35-с дээш</option>
							</select>
						</div>
					</div>
					<div class = "subheader">
						<span>Ажлын байрны байршил</span>
					</div>
					<div class = "info-item">
						<input type="button" name="insert-loc-butt" value = "Байршил оруулах" class = "button flat close-modal" onclick = "prepareTogetLocationFromUser()">
						<input type="hidden" name="coordx" id="coordx" required>
						<input type="hidden" name="coordy" id="coordy" required>
					</div>
					<div class="info-item">
						<i class = "material-icons md-24 input-icon">place</i>
						<span id = "locationNumber">Байршил ороогүй байна.</span>
					</div>
					<div class = "subheader">
						<span>Ажиллах цагийн хуваарь</span>
					</div>
					<div class = "info-item">
						<input type = "hidden" name = "mon" id = "mon" value="0">
						<input type = "hidden" name = "tue" id = "tue" value="0">
						<input type = "hidden" name = "wed" id = "wed" value="0">
						<input type = "hidden" name = "thu" id = "thu" value="0">
						<input type = "hidden" name = "fri" id = "fri" value="0">
						<input type = "hidden" name = "sat" id = "sat" value="0">
						<input type = "hidden" name = "sun" id = "sun" value="0">
						<ul id = "insert-job-weekinfo" class = "weekinfo selectable">
							<li class = "weekday selectable">Да</li>
							<li class = "weekday selectable">Мя</li>
							<li class = "weekday selectable">Лха</li>
							<li class = "weekday selectable">Пү</li>
							<li class = "weekday selectable">Ба</li>
							<li class = "weekday selectable">Бя</li>
							<li class = "weekday selectable">Ня</li>
						</ul>
						<center>
							<div class = "timepicker">
								<input type = "hidden" name = "startTime" id = "startTime" value = "9">
								<input type = "hidden" name = "endTime" id = "endTime" value = "18">
								<div style  =  "background-color: #3f51b5; font-size: 36px; color: grey; margin-bottom: 10px;">
									<center>
										<span id  =  "insert-job-tp-time1" class  =  "selecteded" style  =  "cursor: pointer" onclick  =  "activatetp(0,'insert-job')">09:00</span><span> - </span><span id  =  "insert-job-tp-time2" style  =  "cursor: pointer" class  =  "" onclick  =  "activatetp(1,'insert-job')">18:00</span>
									</center>
								</div>
								<svg class  =  "timecircle" id  =  "insert-job-timepicker">
									<circle cx = "150" cy = "150" r = "100" stroke = "#e0e0e0" stroke-width = "1" fill = "#e0e0e0" />
									<circle cx = "150" cy = "150" r = "2" fill = "#3f51b5"/>
									<line id  =  "insert-job-timepin1" x1 = "150" y1 = "150" x2 = "150" y2 = "70" transform = "rotate(135 150 150)" style = "stroke:#3f51b5;stroke-width:2" />
									<text id  =  "insert-job-detailstart" x = "130" y = "45" transform = "rotate(135 150 150)" fill = "#3f51b5">Эхлэх</text>
									<circle id  =  "insert-job-timepincircle1" cx = "150" cy = "70" r = "15" fill = "#3f51b5" transform = "rotate(135 150 150)"/>
									<line id  =  "insert-job-timepin2" x1 = "150" y1 = "150" x2 = "150" y2 = "70" transform = "rotate(270 150 150)" style = "stroke:#3f51b5;stroke-width:2" />
									<text id  =  "insert-job-detailend" x = "120" y = "45" transform = "rotate(270 150 150)"  fill = "#3f51b5">Дуусах</text>
									<circle id  =  "insert-job-timepincircle2" cx = "150" cy = "70" r = "15" fill = "#3f51b5" transform = "rotate(270 150 150)"/>
									<text x = "142" y = "75" id  =  'insert-job-tp-24' fill = "black" class  =  "unselectable" onclick = "setclock(24,'insert-job')">24</text>
									<text x = "167" y = "77" id  =  'insert-job-tp-1' fill = "#e0e0e0" class  =  "unselectable" onclick = "setclock(1,'insert-job')">1</text>
									<text x = "186" y = "85" id  =  'insert-job-tp-2' fill = "black" class  =  "unselectable" onclick = "setclock(2,'insert-job')">2</text>
									<text x = "203" y = "98" id  =  'insert-job-tp-3' fill = "#e0e0e0" class  =  "unselectable" onclick = "setclock(3,'insert-job')">3</text>
									<text x = "215" y = "115" id  =  'insert-job-tp-4' fill = "black" class  =  "unselectable" onclick = "setclock(4,'insert-job')">4</text>
									<text x = "223" y = "134" id  =  'insert-job-tp-5' fill = "#e0e0e0" class  =  "unselectable" onclick = "setclock(5,'insert-job')">5</text>
									<text x = "226" y = "155" id  =  'insert-job-tp-6' fill = "black" class  =  "unselectable" onclick = "setclock(6,'insert-job')">6</text>
									<text x = "223" y = "176" id  =  'insert-job-tp-7' fill = "#e0e0e0" class  =  "unselectable" onclick = "setclock(7,'insert-job')">7</text>
									<text x = "215" y = "195" id  =  'insert-job-tp-8' fill = "black" class  =  "unselectable" onclick = "setclock(8,'insert-job')">8</text>
									<text x = "203" y = "212" id  =  'insert-job-tp-9' fill = "white" class  =  "unselectable" onclick = "setclock(9,'insert-job')">9</text>
									<text x = "182" y = "224" id  =  'insert-job-tp-10' fill = "black" class  =  "unselectable" onclick = "setclock(10,'insert-job')">10</text>
									<text x = "163" y = "232" id  =  'insert-job-tp-11' fill = "#e0e0e0" class  =  "unselectable" onclick = "setclock(11,'insert-job')">11</text>
									<text x = "142" y = "235" id  =  'insert-job-tp-12' fill = "black" class  =  "unselectable" onclick = "setclock(12,'insert-job')">12</text>
									<text x = "122" y = "232" id  =  'insert-job-tp-13' fill = "#e0e0e0" class  =  "unselectable" onclick = "setclock(13,'insert-job')">13</text>
									<text x = "102" y = "224" id  =  'insert-job-tp-14' fill = "black" class  =  "unselectable" onclick = "setclock(14,'insert-job')">14</text>
									<text x = "85" y = "212" id  =  'insert-job-tp-15' fill = "#e0e0e0" class  =  "unselectable" onclick = "setclock(15,'insert-job')">15</text>
									<text x = "73" y = "195" id  =  'insert-job-tp-16' fill = "black" class  =  "unselectable" onclick = "setclock(16,'insert-job')">16</text>
									<text x = "65" y = "176" id  =  'insert-job-tp-17' fill = "#e0e0e0" class  =  "unselectable" onclick = "setclock(17,'insert-job')">17</text>
									<text x = "62" y = "155" id  =  'insert-job-tp-18' fill = "white" class  =  "unselectable" onclick = "setclock(18,'insert-job')">18</text>
									<text x = "65" y = "134" id  =  'insert-job-tp-19' fill = "#e0e0e0" class  =  "unselectable" onclick = "setclock(19,'insert-job')">19</text>
									<text x = "73" y = "115" id  =  'insert-job-tp-20' fill = "black" class  =  "unselectable" onclick = "setclock(20,'insert-job')">20</text>
									<text x = "86" y = "98" id  =  'insert-job-tp-21' fill = "#e0e0e0" class  =  "unselectable" onclick = "setclock(21,'insert-job')">21</text>
									<text x = "102" y = "85" id  =  'insert-job-tp-22' fill = "black" class  =  "unselectable" onclick = "setclock(22,'insert-job')">22</text>
									<text x = "122" y = "77" id  =  'insert-job-tp-23' fill = "#e0e0e0" class  =  "unselectable" onclick = "setclock(23,'insert-job')">23</text>
								</svg>
							</div>
						</center>
					</div>
				</div>
			</div>
		</div>
	</form>

	<div id = "overlay1" class = "overlay"></div>

	<div id = "main-content">
		<div id = "map"></div>

		<div id = "list" class = "active">
			<div class = "lists">
			<span><?php print_r($_SESSION);?></span>
			</div>
		</div>
	</div> 

	<script type  =  "text/javascript" src = "http://code.jquery.com/jquery-latest.min.js"></script>
	<script type  =  "text/javascript" src  =  "js/map.js"></script>
	<script type  =  "text/javascript" src  =  "js/ns_view.js"></script>
	<script type = "text/javascript" src = "js/filter.js"></script>
	<script type = "text/javascript">
		$(function(){
			initialize();
			getJobsBriefData(<?php if($userLogged) echo $_SESSION["isAdmin"];?>);
		});
	</script>

	<script async defer	src = "https://maps.googleapis.com/maps/api/js?key=AIzaSyDapiQf8_eNvGEudEZDZjnJ2H3hOSn8eWo"></script>

</body>
</html>