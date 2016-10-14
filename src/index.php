<!DOCTYPE html>
<html>

	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1, user-scalable=no">
		<title></title>
		<script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
		<script type="text/javascript">
//			//通过config接口注入权限验证配置
//			wx.config({
//				debug: true, // 开启调试模式,调用的所有api的返回值会在客户端alert出来，若要查看传入的参数，可以在pc端打开，参数信息会通过log打出，仅在pc端时才会打印。
//				appId: 'wx8e34afcb70db689f', // 必填，公众号的唯一标识
//				timestamp: '<?php echo time();?>', // 必填，生成签名的时间戳
//				nonceStr: '<?php echo $nonceStr;?>', // 必填，生成签名的随机串
//				signature: '<?php echo $signature;?>', // 必填，签名
//				jsApiList: [] // 必填，需要使用的JS接口列表
//			});
			//通过ready接口处理成功验证
			wx.ready(function() {
				// config信息验证后会执行ready方法，所有接口调用都必须在config接口获得结果之后
			});
			wx.hideOptionMenu();
		</script>
		<style>
			.img_mj {
				height: 70px;
			}
			
			.img_mj_s {
				height: 30px;
			}
		</style>
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
		<button>发牌</button>

		<button>确认</button>
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
	</head>

	<body>
	</body>

</html>