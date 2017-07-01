<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link type="text/css" href="css/nextstep.css" rel="stylesheet">
	<link type="text/css" href="css/filter.css" rel="stylesheet">
	<link rel="icon" href="nextstepg.png">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<title>NextStep</title>
</head>
<body>
	<nav>
		<a href="index.php" class="title"><img src="nextstepw.png" class="logo"><span>Nextstep</span></a>
		<a href="#!" class="nav-item r min menu"><i class="material-icons md-36">more_vert</i></a>
		<a href="#login" class="nav-item r modal-trigger"><i class="material-icons md-36">account_circle</i><span>Нэвтрэх</span></a>
		<a href="#!" class="nav-item r"><i class="material-icons md-36">add</i><span>Зар нэмэх</span></a>
		<a href="#!" class="nav-item r"><i class="material-icons md-36">search</i><span>Хайх</span></a>
		<a href="#!" class="nav-item l"><i class="material-icons md-36">gps_fixed</i><span>Газрын зураг</span></a>
		<a href="#!" class="nav-item l"><i class="material-icons md-36">view_list</i><span>Жагсаалт</span></a>
	</nav>

	<ul id="menu-nonuser" class="menu-content">
		<li><a href="#!"><i class="material-icons md-36">person_outline</i>Нэвтрэх</a></li>
		<li><a href="#!"><i class="material-icons md-36">info_outline</i>Тухай</a></li>
	</ul>

	<div id="floating-add-search" class="floating-buttons">
		<a href="#!" class="red"><i class="material-icons md-24">add</i></a>
		<a href="#!" class="orange"><i class="material-icons md-24">search</i></a>
	</div>

	<div id="job-info" class="modal">
		<div class="header">
			<div class="headimg">
				<img src="imgs/1000000017/201703140858_1ko5ItS3gbd4mrxuhjKaEzZQfsCAJT.jpg">
			</div>
			<div class="maininfo">
				<div class="maininfo-item">
					Мэргэжил
				</div>
				<div class="maininfo-item">
					Цагийн 20000-40000₮
				</div>
			</div>
			<div id="floating-job-buttons" class="floating-buttons">
				<a href="#!" class="orange"><i class="material-icons md-24">share</i></a>
				<a href="#!" class="red"><i class="material-icons md-24">star</i></a>
			</div>
		</div>
		<div class="info">
			<div class="subheader">
				<span>Холбоо барих</span>
			</div>
			<div class="info-item">
				<i class="material-icons md-24">phone</i><span>95508419</span>
			</div>
			<div class="info-item">
				<i class="material-icons md-24">email</i><span>netro_97@gmail.com</span>
			</div>
			<div class="subheader">
				<span>Шаардлагууд</span>
			</div>
			<div class="info-item">
				<i class="material-icons md-24">person_outline</i><span>Хүйс хамаагүй</span>
			</div>
			<div class="info-item">
				<i class="material-icons md-24">school</i><span>Дээд болон түүнээс дээш боловсролтой</span>
			</div>
			<div class="info-item">
				<i class="material-icons md-24">accessibility</i><span>18-с дээш</span>
			</div>
			<div class="subheader">
				<span>Ажиллах цагийн хуваарь</span>
			</div>
			<div class="info-item">
				<ul class="weekinfo" onclick="">
					<li class = "weekday unselectable">Да</li>
					<li class = "weekday active unselectable">Мя</li>
					<li class = "weekday unselectable">Лха</li>
					<li class = "weekday unselectable">Пү</li>
					<li class = "weekday unselectable">Ба</li>
					<li class = "weekday unselectable">Бя</li>
					<li class = "weekday unselectable">Ня</li>
				</ul>
				<center>
					<div class="timepicker">
						<div style = "background-color: #3f51b5; font-size: 36px; color: grey; margin-bottom: 10px;">
							<center>
								<span id = "info-time1" class = "selecteded">09:00</span><span> - </span><span id = "info-time2" class = "selecteded">18:00</span>
							</center>
						</div>
						<svg class = "timecircle" id = "info-timepicker">
							<circle cx="150" cy="150" r="100" stroke="#e0e0e0" stroke-width="1" fill="#e0e0e0" />
							<circle cx="150" cy="150" r="2" fill="#3f51b5"/>
							<line id = "info-timepin1" x1="150" y1="150" x2="150" y2="70" transform="rotate(135 150 150)" style="stroke:#3f51b5;stroke-width:2" />
							<text id = "info-detailstart" x="130" y="45" transform="rotate(135 150 150)" fill="#3f51b5">Эхлэх</text>
							<circle id = "info-timepincircle1" cx="150" cy="70" r="15" fill="#3f51b5" transform="rotate(135 150 150)"/>
							<line id = "info-timepin2" x1="150" y1="150" x2="150" y2="70" transform="rotate(270 150 150)" style="stroke:#3f51b5;stroke-width:2" />
							<text id = "info-detailend" x="120" y="45" transform="rotate(270 150 150)"  fill="#3f51b5">Дуусах</text>
							<circle id = "info-timepincircle2" cx="150" cy="70" r="15" fill="#3f51b5" transform="rotate(270 150 150)"/>
							<text x="142" y="75" id = 'info-tp-24' fill="black" class = "unselectable">24</text>
							<text x="167" y="77" id = 'info-tp-1' fill="#e0e0e0" class = "unselectable">1</text>
							<text x="186" y="85" id = 'info-tp-2' fill="black" class = "unselectable">2</text>
							<text x="203" y="98" id = 'info-tp-3' fill="#e0e0e0" class = "unselectable">3</text>
							<text x="215" y="115" id = 'info-tp-4' fill="black" class = "unselectable">4</text>
							<text x="223" y="134" id = 'info-tp-5' fill="#e0e0e0" class = "unselectable">5</text>
							<text x="226" y="155" id = 'info-tp-6' fill="black" class = "unselectable">6</text>
							<text x="223" y="176" id = 'info-tp-7' fill="#e0e0e0" class = "unselectable">7</text>
							<text x="215" y="195" id = 'info-tp-8' fill="black" class = "unselectable">8</text>
							<text x="203" y="212" id = 'info-tp-9' fill="white" class = "unselectable">9</text>
							<text x="182" y="224" id = 'info-tp-10' fill="black" class = "unselectable">10</text>
							<text x="163" y="232" id = 'info-tp-11' fill="#e0e0e0" class = "unselectable">11</text>
							<text x="142" y="235" id = 'info-tp-12' fill="black" class = "unselectable">12</text>
							<text x="122" y="232" id = 'info-tp-13' fill="#e0e0e0" class = "unselectable">13</text>
							<text x="102" y="224" id = 'info-tp-14' fill="black" class = "unselectable">14</text>
							<text x="85" y="212" id = 'info-tp-15' fill="#e0e0e0" class = "unselectable">15</text>
							<text x="73" y="195" id = 'info-tp-16' fill="black" class = "unselectable">16</text>
							<text x="65" y="176" id = 'info-tp-17' fill="#e0e0e0" class = "unselectable">17</text>
							<text x="62" y="155" id = 'info-tp-18' fill="white" class = "unselectable">18</text>
							<text x="65" y="134" id = 'info-tp-19' fill="#e0e0e0" class = "unselectable">19</text>
							<text x="73" y="115" id = 'info-tp-20' fill="black" class = "unselectable">20</text>
							<text x="86" y="98" id = 'info-tp-21' fill="#e0e0e0" class = "unselectable">21</text>
							<text x="102" y="85" id = 'info-tp-22' fill="black" class = "unselectable">22</text>
							<text x="122" y="77" id = 'info-tp-23' fill="#e0e0e0" class = "unselectable">23</text>
						</svg>
					</div>
				</center>
			</div>
			<div class="subheader">
				<span>Ажлын байрны зургууд</span>
			</div>
			<div class="info-item">
				<div class="imgs-container">
					<div class="img-slide">
						<img src="imgs/1000000017/201703140858_1ko5ItS3gbd4mrxuhjKaEzZQfsCAJT.jpg">
					</div>
					<div class="img-slide">
						<img src="imgs/1000000017/201703140858_e7yU9nM3ZbIPk68hQV2Szgl0XcsCYD.jpg">
					</div>
					<div class="img-slide">
						<img src="imgs/1000000017/201703140858_1ko5ItS3gbd4mrxuhjKaEzZQfsCAJT.jpg">
					</div>
					<div class="img-slide">
						<img src="imgs/1000000017/201703140858_e7yU9nM3ZbIPk68hQV2Szgl0XcsCYD.jpg">
					</div>
					<div class="img-slide active">
						<img src="imgs/1000000017/201703140858_1ko5ItS3gbd4mrxuhjKaEzZQfsCAJT.jpg">
					</div>
					<div class="img-slide-ctrl l">
						<i class="material-icons md-48">chevron_left</i>
					</div>
					<div class="img-slide-ctrl r">
						<i class="material-icons md-48">chevron_right</i>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div id="login" class="modal">
		<div class="header">
			<div id="loginimg">
				<img src="imgs/login.png">
			</div>	
		</div>
		<div class="info">
			<div class="info-item">
				<div class="input-field">
					<input type="text" name="username">
					<label for="username">Хэрэглэгчийн нэр эсвэл и-мэйл хаяг</label>
					<div class="bot-line"></div>
				</div>
				<div class="input-field">
					<input type="text" name="password">
					<label for="password">Нууц үг</label>
					<div class="bot-line"></div>
				</div>
			</div>
			<div class="info-item">
				<center>				
					<a href="#!" class="raised">Нэвтрэх</a>
					<a href="#signin" class="flat modal-trigger">Бүртгүүлэх</a>
				</center>
			</div>
		</div>
	</div>

	<div id="signin" class="modal">
		<div class="header">
			<div id="loginimg">
				<img src="imgs/login.png">
			</div>	
		</div>
		<div class="info">
			<div class="info-item">
				<div class="input-field">
					<input type="text" name="fname">
					<label for="fname">Нэр</label>
					<div class="bot-line"></div>
				</div>
				<div class="input-field">
					<input type="text" name="lname">
					<label for="lname">Овог</label>
					<div class="bot-line"></div>
				</div>
				<div class="input-field">
					<input type="text" name="username">
					<label for="username">И-мэйл хаяг</label>
					<div class="bot-line"></div>
				</div>
				<div class="input-field">
					<input type="text" name="password">
					<label for="password">Нууц үг</label>
					<div class="bot-line"></div>
				</div>
				<div class="input-field">
					<input type="text" name="repassword">
					<label for="repassword">Нууц үгээ дахин оруулна уу</label>
					<div class="bot-line"></div>
				</div>
			</div>
			<div class="info-item">
				<center>				
					<button class="raised">Бүртгүүлэх</button>
					<button class="flat">Цуцлах</button>
				</center>
			</div>
		</div>
	</div>

	<div id="overlay1" class="overlay"></div>

	<div id="map"></div>

	<script type = "text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
	<script type = "text/javascript" src = "js/ns.js"></script>
	<script type = "text/javascript" src = "js/map.js"></script>
	<script type="text/javascript" src="js/filter.js"></script>

	<script async defer	src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDapiQf8_eNvGEudEZDZjnJ2H3hOSn8eWo&callback=initialize"></script>

</body>
</html>