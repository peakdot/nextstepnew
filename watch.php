<?php 
require("conn.php");
require("test_input.php");

function getFullJobInfo($id) {
	$res = getFromDBSecure("jobs", array("id", "_jobName", "_orgName", "_orgLogo", "_salaryType", "_salary", "_startTime", "_endTime", "_week", "_email", "_phone1", "_phone2", "_gender", "_age", "_edu", "_regEmployerId", "_regCompanyId", "_regType", "_regDate"), array("id"), "id=?", array($id));
	return $res;
}

$job = null;

if($_SERVER["REQUEST_METHOD"] == "GET") {
	$id = get_input_get("id", 0, true);
	if($id == null || $id == 0 || $id == '') {
		header('Location: index.php');
	}
	$job = getFullJobInfo($id);
	if(count($job) == 0) {
		header('Location: index.php');
	} 
} else {
	header('Location: index.php');
}
?>

<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link type="text/css" href="css/nswatch.css" rel="stylesheet">
	<link type="text/css" href="css/filter.css" rel="stylesheet">
	<link rel="icon" href="nextstepg.png">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<title>NextStep</title>
</head>
<body>
	<ul id="menu-nonuser" class="menu-content">
		<li><a href="#login" class="modal-trigger"><i class="material-icons md-36">person_outline</i>Нэвтрэх</a></li>
		<li><a href="#!" class=""><i class="material-icons md-36">info_outline</i>Тухай</a></li>
	</ul>

	<div id = "job-info" class = "modal active">
		<div class = "head">
			<a href = "index.php" class = "close-modal-button"><i class = "material-icons md-24">arrow_back</i></a>
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
				<div class = "info-item" id = "jinfo-contact">
					<i class = "material-icons md-24">phone</i><span id = "jinfo-phone1"></span>
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
	<div id="insert-job" class="modal">
		<div class="head">
			<div class="title">Ажлын зар нэмэх</div>
			<div class="close-modal-button close-modal"><i class="material-icons md-24">close</i></div>
			<div class="modal-button close-modal"><span>Хадгалах</span></div>
		</div>
		<div class="body">
			<div class="header">
				<div class="headimg">
					<img src="">
					<div class="img-upload-container">
						<div class="img-upload-icon">
							<i class="material-icons md-48">add</i>
							<p>Зураг нэмэх</p>
						</div>
						<input class="img-upload" type="file" name="coverimg">
					</div>
				</div>
			</div>
			<div class="info">
				<div class="subheader">
					<span>Ажлын тухай</span>
				</div>
				<div class="info-item">
					<i class="material-icons md-24 input-icon">assignment</i>
					<div class="input-field col-s-12">
						<input type="text" name="orgname">
						<label for="orgname">Ажиллах газрын нэр</label>
						<div class="bot-line"></div>
					</div>
				</div>
				<div class="info-item">
					<i class="material-icons md-24 input-icon"></i>
					<div class="input-field col-s-12">
						<input type="text" name="username">
						<label for="username">Мэргэжил</label>
						<div class="bot-line"></div>
					</div>
				</div>
				<div class="subheader">
					<span>Цалин</span>
				</div>
				<div class="info-item">
					<i class="material-icons md-24 input-icon">account_balance_wallet</i>
					<div class="input-field col-s-6">
						<select>
							<option>Цагийн</option>
							<option>Өдрийн</option>
							<option>7 хоногоор</option>
							<option>Сараар</option>
						</select>
					</div>
					<div class="input-field col-s-6">
						<input type="number" name="salary">
						<label for="salary">Мөнгөн дүн</label>
						<div class="bot-line"></div>
					</div>
				</div>
				<div class="subheader">
					<span>Холбоо барих</span>
				</div>
				<div class="info-item">
					<i class="material-icons md-24 input-icon">phone</i>
					<div class="input-field col-s-12">
						<input type="number" name="phone1">
						<label for="phone1">Утасны дугаар 1</label>
						<div class="bot-line"></div>
					</div>
				</div>
				<div class="info-item">
					<i class="material-icons md-24 input-icon">email</i>
					<div class="input-field col-s-12">
						<input type="text" name="email1">
						<label for="email1">И-мэйл 1</label>
						<div class="bot-line"></div>
					</div>
				</div>
				<div class="subheader">
					<span>Шаардлагууд</span>
				</div>
				<div class="info-item">
					<i class="material-icons md-24 input-icon">person_outline</i>
					<div class="input-field col-s-12">
						<select>
							<option>Хүйс хамаагүй</option>
							<option>Эрэгтэй</option>
							<option>Эмэгтэй</option>
						</select>
					</div>
				</div>
				<div class="info-item">
					<i class="material-icons md-24 input-icon">school</i>
					<div class="input-field col-s-12">
						<select>
							<option>Боловсрол хамаагүй</option>
							<option>Бүрэн дунд боловсролтой</option>
							<option>Дээд боловсролтой</option>
						</select>
					</div>
				</div>
				<div class="info-item">
					<i class="material-icons md-24 input-icon">accessibility</i>
					<div class="input-field col-s-12">
						<select>
							<option>Нас хамаагүй</option>
							<option>18-с 25 настай</option>
							<option>25-с 35 настай</option>
							<option>35-с дээш</option>
						</select>
					</div>
				</div>
				<div class="subheader">
					<span>Ажиллах цагийн хуваарь</span>
				</div>
				<div class="info-item">
					<ul id="insert-job-weekinfo" class="weekinfo selectable" onclick="">
						<li class = "weekday selectable">Да</li>
						<li class = "weekday active selectable">Мя</li>
						<li class = "weekday selectable">Лха</li>
						<li class = "weekday selectable">Пү</li>
						<li class = "weekday selectable">Ба</li>
						<li class = "weekday selectable">Бя</li>
						<li class = "weekday selectable">Ня</li>
					</ul>
					<center>
						<div class="timepicker">
							<div style = "background-color: #3f51b5; font-size: 36px; color: grey; margin-bottom: 10px;">
								<center>
									<span id = "insert-job-tp-time1" class = "selecteded" style = "cursor: pointer" onclick = "activatetp(0,'insert-job')">09:00</span><span> - </span><span id = "insert-job-tp-time2" style = "cursor: pointer" class = "" onclick = "activatetp(1,'insert-job')">18:00</span>
								</center>
							</div>
							<svg class = "timecircle" id = "insert-job-timepicker">
								<circle cx="150" cy="150" r="100" stroke="#e0e0e0" stroke-width="1" fill="#e0e0e0" />
								<circle cx="150" cy="150" r="2" fill="#3f51b5"/>
								<line id = "insert-job-timepin1" x1="150" y1="150" x2="150" y2="70" transform="rotate(135 150 150)" style="stroke:#3f51b5;stroke-width:2" />
								<text id = "insert-job-detailstart" x="130" y="45" transform="rotate(135 150 150)" fill="#3f51b5">Эхлэх</text>
								<circle id = "insert-job-timepincircle1" cx="150" cy="70" r="15" fill="#3f51b5" transform="rotate(135 150 150)"/>
								<line id = "insert-job-timepin2" x1="150" y1="150" x2="150" y2="70" transform="rotate(270 150 150)" style="stroke:#3f51b5;stroke-width:2" />
								<text id = "insert-job-detailend" x="120" y="45" transform="rotate(270 150 150)"  fill="#3f51b5">Дуусах</text>
								<circle id = "insert-job-timepincircle2" cx="150" cy="70" r="15" fill="#3f51b5" transform="rotate(270 150 150)"/>
								<text x="142" y="75" id = 'insert-job-tp-24' fill="black" class = "unselectable" onclick="setclock(24,'insert-job')">24</text>
								<text x="167" y="77" id = 'insert-job-tp-1' fill="#e0e0e0" class = "unselectable" onclick="setclock(1,'insert-job')">1</text>
								<text x="186" y="85" id = 'insert-job-tp-2' fill="black" class = "unselectable" onclick="setclock(2,'insert-job')">2</text>
								<text x="203" y="98" id = 'insert-job-tp-3' fill="#e0e0e0" class = "unselectable" onclick="setclock(3,'insert-job')">3</text>
								<text x="215" y="115" id = 'insert-job-tp-4' fill="black" class = "unselectable" onclick="setclock(4,'insert-job')">4</text>
								<text x="223" y="134" id = 'insert-job-tp-5' fill="#e0e0e0" class = "unselectable" onclick="setclock(5,'insert-job')">5</text>
								<text x="226" y="155" id = 'insert-job-tp-6' fill="black" class = "unselectable" onclick="setclock(6,'insert-job')">6</text>
								<text x="223" y="176" id = 'insert-job-tp-7' fill="#e0e0e0" class = "unselectable" onclick="setclock(7,'insert-job')">7</text>
								<text x="215" y="195" id = 'insert-job-tp-8' fill="black" class = "unselectable" onclick="setclock(8,'insert-job')">8</text>
								<text x="203" y="212" id = 'insert-job-tp-9' fill="white" class = "unselectable" onclick="setclock(9,'insert-job')">9</text>
								<text x="182" y="224" id = 'insert-job-tp-10' fill="black" class = "unselectable" onclick="setclock(10,'insert-job')">10</text>
								<text x="163" y="232" id = 'insert-job-tp-11' fill="#e0e0e0" class = "unselectable" onclick="setclock(11,'insert-job')">11</text>
								<text x="142" y="235" id = 'insert-job-tp-12' fill="black" class = "unselectable" onclick="setclock(12,'insert-job')">12</text>
								<text x="122" y="232" id = 'insert-job-tp-13' fill="#e0e0e0" class = "unselectable" onclick="setclock(13,'insert-job')">13</text>
								<text x="102" y="224" id = 'insert-job-tp-14' fill="black" class = "unselectable" onclick="setclock(14,'insert-job')">14</text>
								<text x="85" y="212" id = 'insert-job-tp-15' fill="#e0e0e0" class = "unselectable" onclick="setclock(15,'insert-job')">15</text>
								<text x="73" y="195" id = 'insert-job-tp-16' fill="black" class = "unselectable" onclick="setclock(16,'insert-job')">16</text>
								<text x="65" y="176" id = 'insert-job-tp-17' fill="#e0e0e0" class = "unselectable" onclick="setclock(17,'insert-job')">17</text>
								<text x="62" y="155" id = 'insert-job-tp-18' fill="white" class = "unselectable" onclick="setclock(18,'insert-job')">18</text>
								<text x="65" y="134" id = 'insert-job-tp-19' fill="#e0e0e0" class = "unselectable" onclick="setclock(19,'insert-job')">19</text>
								<text x="73" y="115" id = 'insert-job-tp-20' fill="black" class = "unselectable" onclick="setclock(20,'insert-job')">20</text>
								<text x="86" y="98" id = 'insert-job-tp-21' fill="#e0e0e0" class = "unselectable" onclick="setclock(21,'insert-job')">21</text>
								<text x="102" y="85" id = 'insert-job-tp-22' fill="black" class = "unselectable" onclick="setclock(22,'insert-job')">22</text>
								<text x="122" y="77" id = 'insert-job-tp-23' fill="#e0e0e0" class = "unselectable" onclick="setclock(23,'insert-job')">23</text>
							</svg>
						</div>
					</center>
				</div>
				<div class="subheader">
					<span>Ажлын байрны зургууд</span>
				</div>
			</div>
		</div>
	</div>

	<div id="overlay1" class="overlay"></div>

	<script type = "text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
	<script type = "text/javascript" src = "js/ns_view.js"></script>
	<script type="text/javascript" src="js/filter.js"></script>
	<script type="text/javascript">
		<?php echo "job = JSON.parse('".json_encode($job)."'); feed_job_info_watch(job[0]);"?>
		function feed_job_info_watch(job) {
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
			jobinfo_modal.find("#jinfo-orgLogo").attr("src", "imgs/" + job[3]);
			jobinfo_modal.find("#jinfo-salary").html(job[4] + " " + job[5]);
			setclockstart(parseInt(job[6]), "info");
			setclockend(parseInt(job[7]), "info");
			setWeek(job[8],"jinfo");
			jobinfo_modal.find("#jinfo-email").html(job[9]);
			jobinfo_modal.find("#jinfo-phone1").html(job[10]);
			jinfo_contact = jobinfo_modal.find("#jinfo-contact");
			if(job[11] != 0 && job[11] != null){
				jinfo_contact.append('<div class = "info-item"><i class = "material-icons md-24"></i><span id = "jinfo-phone2">'+job[11]+'</span></div>');
			}
			if(job[11] != 0 && job[11] != null){
				jinfo_contact.append('<div class = "info-item"><i class = "material-icons md-24">email</i><span id = "jinfo-email">'+job[12]+'</span></div>');
			}
			jobinfo_modal.find("#jinfo-age").html(job[13]);
			jobinfo_modal.find("#jinfo-edu").html(job[14]);
		}
	</script>

</body>
</html>