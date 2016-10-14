<!DOCTYPE html>
<html>

	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1, user-scalable=no">
		<title></title>
		<script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
		<link href="//cdn.bootcss.com/jquery-mobile/1.4.5/jquery.mobile.css" rel="stylesheet">
		<script src="http://apps.bdimg.com/libs/jquery/1.10.2/jquery.min.js"></script>
		<script src="http://apps.bdimg.com/libs/jquerymobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>

		<style>
			.img_mj {
				height: 70px;
			}
			
			.img_mj_s {
				height: 30px;
				border:2px solid; border-color: #FFFFFF;
			}
			
			.img_mj_s_select{
				border:2px solid; border-color: #22FF22;
			}
			
			
		</style>

	</head>

	<body>

		<div>
			<img src="img/tiao_1.png" class="img_mj" />
			<img src="img/tiao_2.png" class="img_mj" />
			<img src="img/tiao_3.png" class="img_mj" />
			<img src="img/tiao_2.png" class="img_mj" />
			<img src="img/tiao_3.png" class="img_mj" />

			<img src="img/tiao_4.png" class="img_mj" />
			<img src="img/tiao_5.png" class="img_mj" />
			<img src="img/tiao_5.png" class="img_mj" />

			<img src="img/tiao_5.png" class="img_mj" />
			<img src="img/tiao_5.png" class="img_mj" />
			<img src="img/tiao_6.png" class="img_mj" />
			<img src="img/tiao_7.png" class="img_mj" />
			<img src="img/tiao_8.png" class="img_mj" />
		</div>
		<a class="ui-btn"> 发牌</a>

		<a class="ui-btn">确认</a>
		<div>
			<div>
				<img src="img/tiao_1.png" class="img_mj_s" />
				<img src="img/tiao_2.png" class="img_mj_s" />
				<img src="img/tiao_3.png" class="img_mj_s" /></div>
			<div><img src="img/tiao_4.png" class="img_mj_s" />
				<img src="img/tiao_5.png" class="img_mj_s" />

				<img src="img/tiao_6.png" class="img_mj_s" /></div>
			<div><img src="img/tiao_7.png" class="img_mj_s" />

				<img src="img/tiao_8.png" class="img_mj_s" />
				<img src="img/tiao_9.png" class="img_mj_s" /></div>
			<div>

	</body>

	<script>
		$(document).ready(function() {
			console.debug("ready");

		});

		$(".img_mj_s").click(function() {
			$(this).toggleClass("img_mj_s_select");
			
		});
		
		var current=[];
		var current_rel=[];
		
		var randomMajiang=function(){
			
		}
		
		var judge=function(){
			
		}
	</script>

</html>