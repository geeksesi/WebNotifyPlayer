<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-rtl/3.4.0/css/bootstrap-rtl.min.css">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="assets/css/calendar.css">
    <script src="assets/js/jalali.js"></script>
    <script src="assets/js/hijri.js"></script>
  <style>
  	body , html
  	{
  		direction: rtl;
  		font-family: 'Shabnam';
  	}
    /* Set height of the grid so .sidenav can be 100% (adjust as needed) */
    /*.row.content {height: 900px}*/
    
    /* Set gray background color and 100% height */
    .sidenav {
      background-color: #f1f1f1;
      height: 100%;
    }
        
    /* On small screens, set height to 'auto' for the grid */
    @media screen and (max-width: 767px) {
      .row.content {height: auto;} 
    }
  </style>
  <script type="text/javascript">
	function log_out() 
	{
		    $.ajax(
		    {
			  url: "?logout",
			}
			).done(function(data) 
			{
				if (data == "Ok") 
				{
					window.location = "login";
				}
				else
				{
					alert(data);
				}
			}
			);

	}


  </script>
</head>
<body>

<nav class="navbar navbar-inverse visible">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="#">Logo</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li class="active"><a href="#">داشبورد</a></li>
        <li><a href="#" onclick="log_out()">خروج</a></li>
      </ul>
    </div>
  </div>
</nav>

<div class="container-fluid">
  <div class="row content">
    <br>
	<div class="col-md-12 col-lg-12 col-sm-12">
		<div class="well">
			<p>


				<h1>راهنما</h1>
				<p>ما از انواع رویداد/هشدار ها پشتیبانی می کنیم</p>
				<ul>
				<li>فقط یکبار</li>
				<li>هر سال یکبار</li>
				<li>هر ماه یکبار</li>
				<li>رویداد های هفتگی (یک یا چند روز در هفته)</li>
				<li>رویداد های روزانه</li>
				<li>اوقات شرعی و مناجات</li>
				</ul>
				<hr />
				<p>برای اضافه کردن یک رویداد/هشدار برای یکبار می توانید بر روی تاریخ مورد نظر در تقویم کلیک نموده و سپس ساعت رویداد را تعیین کنید.</p>
				<p>اگر مایل بودید که این رویداد هر سال در همان تاریخ و ساعت تکرار شود گزینه <code>تکرار سالیانه</code> را فعال کنید</p>
				<hr />
				<p>برای افزودن یک رویداد با تکرار ماهانه می توانید گزینه ماهانه را در پایین فعال کنید و گزینه های خواسته شده را با دقت پر کنید</p>
				<p>برای افزودن رویداد های دیگر نیز به همین طریق کافیست گزینه مورد نظر را فعال نموده و موارد مورد نیاز را با دقت پر کنید ( فعلا امکان تغییر رویداد ها وجود ندارد در صورت تمایل به تغییر یک رویداد باما تماس بگیرید)</p>
				<hr />
				<p>برای فعال کردن اوقات شرعی و مناجات گزینه های خواسته شده را فعال کنید ( به صورت پیشفرض غیرفعال می‌باشد)</p>
				<h2>تذکرات</h2>
				<ul>
				<li>از اضافه کردن و تغییرات جمعی بپرهیزید بعد از تغییر دادن/ اضافه کردن هر رویداد یک بار گزینه ثبت مربوط به آن رویداد را بفشارید.</li>
				<li>در اضافه کردن رویداد ها دقت کنید زیرا فعلا امکان تغییر و ویرایش رویداد ها وجود ندارد</li>
				<li>در حفظ رمز عبور خود کوشا باشید زیرا فعلا امکان بازیابی رمز عبور وجود ندارد ( برای بازیابی تماس بگیرید)</li>
				<li>تاریخ ها را به <code>میلادی</code> وارد کنید (در صورت وارد کردن تاریخ به شمسی یا قمری هیچ اخطاری دریافت نمی کنید ولی اعلان شما غیرفعال می شود)</li>
				<li>در قسمت اوقات شرعی برای بدست اوردن طول و عرض جغرافیایی به سایت :&nbsp;&nbsp; <a href="https://www.latlong.net/">latlong.net</a>&nbsp;&nbsp;مراجعه کنید</li>
				<li>در قسمت اوقات شرعی برای بدست اوردن منطقه زمانی به سایت &nbsp;&nbsp; <a href="http://php.net/manual/en/timezones.php">php.net/manual/en/timezones.php</a>&nbsp;&nbsp;مراجعه کنید</li>
				<li>لطفا نام کشور را در بخش اوقات شرعی به انگلیسی وارد کنید مثال : iran</li>
				<li>منطقه زمانی پیشفرض ما &nbsp;<code>تهران</code>&nbsp;می باشد اگر مایل به وارد کردن ساعت ها در منطقه زمانی دیگری می باشید ابتدا در بخش اوقات شرعی منطقه زمانی خود را تعیین کنید.</li>
				</ul>
				<h2>تماس باما</h2>
				<p>در صورت وجود هرگونه اشکال, درخواست , نظر و پیشنهاد می توانید از راه های زیر باما تماس بگیرید</p>
				<ul style="text-align: left; direction: ltr">
				<li>Email 		: <code>geeksesi@gmail.com</code></li>
				<li>Phone 		: <code>09100101543</code></li>
				<li>Telegram 	: <code>@geeksesi_xyz</code></li>
				<li>Igap 		: <code>@geeksesi</code></li>
				<li>Github 		: <code>github.com/geeksesi</code></li>
				</ul>


			</p>	
		</div>
	</div>

    <div class="col-md-12 col-lg-7 col-sm-12">
      <div class="well">
		<main>
            <table id="cal1" class="fc-table">
                <caption>
                    <label for="fc-year">سال:</label>
                    <select name="fc-year" class="fc-year">                               
                        <option value="1391">1391</option>
                        <option value="1392">1392</option>
                        <option value="1393">1393</option>
                        <option value="1394">1394</option>
                        <option value="1395">1395</option>
                        <option value="1396">1396</option>
                        <option value="1397">1397</option>
                        <option value="1398">1398</option>
                        <option value="1399">1399</option>
                        <option value="1400">1400</option>
                        <option value="1401">1401</option>
                    </select>

                    <label for="fc-month">ماه:</label>
                    <select name="fc-month" class="fc-month">
	                    <option value="0">فروردین</option>
	                    <option value="1">اردیبهشت</option>
	                    <option value="2">خرداد</option>
	                    <option value="3">تیر</option>
	                    <option value="4">مرداد</option>
	                    <option value="5">شهریور</option>
	                    <option value="6">مهر</option>
	                    <option value="7">آبان</option>
	                    <option value="8">آذر</option>
	                    <option value="9">دی</option>
	                    <option value="10">بهمن</option>
	                    <option value="11">اسفند</option>
	                </select>
                </caption>
                <tr>
                    <th>شنبه</th>
                    <th>یکشنبه</th>
                    <th>دوشنبه</th>
                    <th>سه شنبه</th>
                    <th>چهارشنبه</th>
                    <th>پنچشنبه</th>
                    <th>جمعه</th>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            </table>

        </main>
        <br>
        <br>
      </div>
    </div>
	<div class="col-md-12 col-lg-5 col-sm-12">
		<h3>هشدار سالانه</h3>
		<div class="well">
			<form id="calendar_form">
				<fieldset>
					<div class="row">
						<span class="col-xs-4">  <label style="width: 30%"> سال </label><input style="width: 70%" id="calendar_year" type="number" name="year" readonly></span>
						<span class="col-xs-4">  <label style="width: 30%">	ماه	</label><input style="width: 70%" id="calendar_month" type="number" name="month" readonly></span>
						<span class="col-xs-4">  <label style="width: 30%"> روز </label><input style="width: 70%" id="calendar_day" type="number" name="day" readonly></span>
					</div>
					<br>
					<div class="row">
						<span class="col-xs-4">  <label style="width: 70%"> تکرار سالانه </label><input style="width: 30%" id="calendar_repeat" type="checkbox" name="repeat" onchange="calendar_checked(this)"></span>
						<span class="col-xs-4">  <label style="width: 30%"> ساعت </label><input style="width: 70%" id="calendar_hour" type="number" name="hour"></span>
						<span class="col-xs-4">  <label style="width: 30%"> دقیقه </label><input style="width: 70%" id="calendar_minute" type="number" name="minute"></span>
					</div>
					<br>
					<div class="row">
						<div class="col-xs-6">
							<span class="row">  <label style="width: 100%"> آلارم خود را بارگزاری کنید </label><input style="width: 100%" id="calendar_alarm" type="file" name="alarm"></span>
							<!-- <br> -->
							<span class="row">  <label style="width: 40%"> سال انقضاء </label><input style="width: 60%" id="calendar_exp" type="number" name="exp" disabled></span>
						</div>
						<div class="col-xs-6">
							<span class="row"><input style="width: 100%;height: 115px" id="calendar_submite" type="button" name="submite" value="ثبت هشدار" onclick="calendar_form()"></span>
						</div>
					</div>
				</fieldset>
			</form>
		</div>
	</div>
	<div class="col-md-12 col-lg-5 col-sm-12">
			<h3>هشدار ماهانه</h3>
		<div class="well">
			<form id="monthly_form">
				<fieldset>
					<div class="row">
						<span class="col-xs-4">  <label style="width: 30%"> روز </label><input style="width: 70%" id="monthly_day" type="number" name="day"></span>
						<span class="col-xs-4">  <label style="width: 30%"> ساعت </label><input style="width: 70%" id="monthly_hour" type="number" name="hour"></span>
						<span class="col-xs-4">  <label style="width: 30%"> دقیقه </label><input style="width: 70%" id="monthly_minute" type="number" name="minute"></span>  
					</div>
					<br>
					<div class="row">
						<span class="col-xs-6">  <label style="width: 40%"> سال انقضاء </label><input style="width: 60%" id="monthly_exp_year" type="number" name="exp_year"></span>
						<span class="col-xs-6">  <label style="width: 40%"> ماه انقضاء </label><input style="width: 60%" id="monthly_exp_month" type="number" name="exp_month"></span>
					</div>
					<br>
					<div class="row">
						<div class="col-xs-6">
							<!-- <br> -->
							<span class="row">  <label style="width: 100%"> آلارم خود را بارگزاری کنید </label><input style="width: 100%" id="monthly_alarm" type="file" name="alarm"></span>
						</div>
						<div class="col-xs-6">
							<span class="row"><input style="width: 100%;height: 65px" id="monthly_submite" type="button" name="submite" value="ثبت هشدار" onclick="monthly_form()"></span>
						</div>
					</div>
				</fieldset>
			</form>
		</div>
	</div>
  </div>

	<div class="row">
		
		<div class="col-md-12 col-lg-7 col-sm-12">
				<h3>هشدار هفتگی</h3>
			<div class="well">
				<form id="week_form">
					<fieldset>
						<div class="row">
							<span class="col-xs-6">  <label style="width: 30%"> ساعت </label><input style="width: 70%" id="week_hour" type="number" name="hour"></span>
							<span class="col-xs-6">  <label style="width: 30%"> دقیقه </label><input style="width: 70%" id="week_minute" type="number" name="minute"></span>  
						</div>
						<br>
						<div class="row">
							<span class="col-xs-3">  <label style="width: 40%"> شنبه </label><input style="width: 60%" id="week_sat" type="checkbox" name="sat"></span>
							<span class="col-xs-3">  <label style="width: 40%"> یک‌شنبه</label><input style="width: 60%" id="week_sun" type="checkbox" name="sun"></span>
							<span class="col-xs-3">  <label style="width: 40%"> دوشنبه </label><input style="width: 60%" id="week_mon" type="checkbox" name="mon"></span>
							<span class="col-xs-3">  <label style="width: 40%"> سه‌شنبه</label><input style="width: 60%" id="week_tue" type="checkbox" name="tue"></span>
							<span class="col-xs-3">  <label style="width: 40%"> چهارشنبه </label><input style="width: 60%" id="week_wed" type="checkbox" name="wed"></span>
							<span class="col-xs-3">  <label style="width: 40%"> پنج‌شنبه </label><input style="width: 60%" id="week_thu" type="checkbox" name="thu"></span>
							<span class="col-xs-3">  <label style="width: 40%"> جمعه </label><input style="width: 60%" id="week_fri" type="checkbox" name="fri"></span>
						</div>
						<br>
						<div class="row">
							<span class="col-xs-4">  <label style="width: 40%"> سال انقضاء </label><input style="width: 60%" id="week_exp_year" type="number" name="exp_year"></span>
							<span class="col-xs-4">  <label style="width: 40%"> ماه انقضاء </label><input style="width: 60%" id="week_exp_month" type="number" name="exp_month"></span>
							<span class="col-xs-4">  <label style="width: 40%"> روز انقضاء </label><input style="width: 60%" id="week_exp_day" type="number" name="exp_day"></span>
						</div>
						<br>
						<div class="row">
							<div class="col-xs-6">
								<!-- <br> -->
								<span class="row">  <label style="width: 100%"> آلارم خود را بارگزاری کنید </label><input style="width: 100%" id="week_alarm" type="file" name="alarm"></span>
							</div>
							<div class="col-xs-6">
								<span class="row"><input style="width: 100%;height: 65px" id="week_submite" type="button" name="submite" value="ثبت هشدار" onclick="week_form()"></span>
							</div>
						</div>
					</fieldset>
				</form>
			</div>
		</div>
		<div class="col-md-12 col-lg-5 col-sm-12">
				<h3>اوقات شرعی</h3>
			<div class="well">
				<br>
				<form id="adhan_form">
					<fieldset>
						<div class="row">
							<span class="col-xs-12">  <label style="width: 70%"> پخش اذان </label><input style="width: 30%" id="adhan_adhan" type="checkbox" name="adhan"></span>
							<span class="col-xs-12">  <label style="width: 70%"> پخش مناجات قبل از اذان </label><input style="width: 30%" id="adhan_monajat" type="checkbox" name="monajat"></span>
						</div>
						<br>
						<div class="row">
							<span class="col-xs-12"><h4>لطفا طول و عرض جغرافیایی محل زندگی خود را وارد کنید</h4></span>
							<span class="col-xs-6">  <label style="width: 45%"> عرض جغرافیایی </label><input style="width: 55%" id="adhan_latitude" type="text" name="latitude"></span>
							<span class="col-xs-6">  <label style="width: 45%"> طول جغرافیایی </label><input style="width: 55%" id="adhan_longitude" type="text" name="longitude"></span>
						</div>
						<br>
						<div class="row">
							<span class="col-xs-6">  <label style="width: 45%"> کشور </label><input style="width: 55%" id="adhan_country" type="text" name="country"></span>
							<span class="col-xs-6">  <label style="width: 45%"> منطقه زمانی </label><input style="width: 55%" id="adhan_time_zone" type="text" name="time_zone"></span>
						</div>
						<br>
						<div class="row">
							<div class="col-xs-3"></div>
							<div class="col-xs-6">
								<span class="row"><input style="width: 100%;height: 65px" id="adhan_submite" type="button" name="submite" value="ثبت تغییرات" onclick="adhan_form()"></span>
							</div>
						</div>
					</fieldset>
				</form>
			</div>
		</div>
	</div>
	
	<div class="row">
		<div class="well">
			<br>
			<h2 class="text-center">لینک کاربری شما &nbsp;:&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo $user_url; ?>"><code><?php echo $user_url_show; ?></code></a></h2>
			<br>			
		</div>
	</div>

</div>
<br><br><br><br><br>
<center><a href="https://github.com/geeksesi">ساخته شده توسط محمد جواد قاسمی</a></center>
</body>
</html>
<script src="assets/js/calendar.js"></script>