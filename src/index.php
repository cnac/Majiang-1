<?php
$appId = 'wx8e34afcb70db689f';
$appsecret = 'a9a38c91aa3bb4817a21569a8c8ae662';
$timestamp = time();
$jsapi_ticket = make_ticket($appId,$appsecret);
$nonceStr = make_nonceStr();
$url = 'http://rubbyjiang.daoapp.io/';
$signature = make_signature($nonceStr,$timestamp,$jsapi_ticket,$url);
function make_nonceStr()
{
	$codeSet = '1234567890abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	for ($i = 0; $i<16; $i++) {
		$codes[$i] = $codeSet[mt_rand(0, strlen($codeSet)-1)];
	}
	$nonceStr = implode($codes);
	return $nonceStr;
}
function make_signature($nonceStr,$timestamp,$jsapi_ticket,$url)
{
	$tmpArr = array(
	'noncestr' => $nonceStr,
	'timestamp' => $timestamp,
	'jsapi_ticket' => $jsapi_ticket,
	'url' => $url
	);
	ksort($tmpArr, SORT_STRING);
	$string1 = http_build_query( $tmpArr );
	$string1 = urldecode( $string1 );
	$signature = sha1( $string1 );
	return $signature;
}
function make_ticket($appId,$appsecret)
{
	// access_token 应该全局存储与更新，以下代码以写入到文件中做示例
	$data = json_decode(file_get_contents("./access_token.json"));
	if ($data->expire_time < time()) {
		$TOKEN_URL="https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=".$appId."&secret=".$appsecret;
		$json = file_get_contents($TOKEN_URL);
		$result = json_decode($json,true);
		$access_token = $result['access_token'];
		if ($access_token) {
			$data->expire_time = time() + 7000;
			$data->access_token = $access_token;
			$fp = fopen("access_token.json", "w");
			fwrite($fp, json_encode($data));
			fclose($fp);
		}
	}else{
		$access_token = $data->access_token;
	}
	// jsapi_ticket 应该全局存储与更新，以下代码以写入到文件中做示例
	$data = json_decode(file_get_contents("./jsapi_ticket.json"));
	if ($data->expire_time < time()) {
		$ticket_URL="https://api.weixin.qq.com/cgi-bin/ticket/getticket?access_token=".$access_token."&type=jsapi";
		$json = file_get_contents($ticket_URL);
		$result = json_decode($json,true);
		$ticket = $result['ticket'];
		if ($ticket) {
			$data->expire_time = time() + 7000;
			$data->jsapi_ticket = $ticket;
			$fp = fopen("jsapi_ticket.json", "w");
			fwrite($fp, json_encode($data));
			fclose($fp);
		}
	}else{
		$ticket = $data->jsapi_ticket;
	}
	return $ticket;
}
?>
<!DOCTYPE html>
<html>

	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1, user-scalable=no">
		<title>我要胡！</title>
		<script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
		<!-- 新 Bootstrap 核心 CSS 文件 -->
		<link rel="stylesheet" href="http://cdn.bootcss.com/bootstrap/3.3.0/css/bootstrap.min.css">

		<!-- jQuery文件。务必在bootstrap.min.js 之前引入 -->
		<script src="http://cdn.bootcss.com/jquery/1.11.1/jquery.min.js"></script>

		<!-- 最新的 Bootstrap 核心 JavaScript 文件 -->
		<script src="http://cdn.bootcss.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
		<script>
			wx.config({
				debug: true,
				appId: '<?=$appId?>',
				timestamp: <?=$timestamp?>,
				nonceStr: '<?=$nonceStr?>',
				signature: '<?=$signature?>',
				jsApiList: [
					'checkJsApi',
					'onMenuShareTimeline',
					'onMenuShareAppMessage'
				]
			});
	 
			wx.ready(function() {
				var shareData = {
					title: '我要胡！',
					desc: '答对了***题，看看你能超过我吗？',
					link: 'http://rubbyjiang.daoapp.io/',
					imgUrl: 'http://baidu.com/logo.jpg'
				};
				wx.onMenuShareAppMessage(shareData);
				wx.onMenuShareTimeline(shareData);
			});
			wx.error(function(res) {
				alert(res.errMsg+" "+'<?=$appId?>');

			});
		</script>

		<style>
			.img_mj {
				height: 70px;
				padding: 1px;
			}
			
			.img_mj_q {
				height: 70px;
				padding: 1px;
			}
			
			.img_mj_s {
				height: 30px;
			}
			
			.img_mj_s_select {
				border: 2px solid;
				border-color: #22FF22;
			}
			
			body {
				text-align: center;
				padding: 4px;
				background: radial-gradient(circle, #6A8472, #32463D);
				background: -ms-radial-gradient(circle, #6A8472, #32463D);
				background: -webkit-linear-gradient(circle, #6A8472, #32463D);
				background: -moz-linear-gradient(circle, #6A8472, #32463D);
			}
			
			.a_demo_one {
				background-color: #ba2323;
				padding: 10px;
				position: relative;
				font-family: 'Open Sans', sans-serif;
				font-size: 15px;
				text-decoration: none;
				color: #fff;
				border: solid 1px #831212;
				background-image: linear-gradient(bottom, rgb(171, 27, 27) 0%, rgb(212, 51, 51) 100%);
				border-radius: 5px;
			}
			
			.a_demo_one:active {
				padding-bottom: 9px;
				padding-left: 10px;
				padding-right: 10px;
				padding-top: 11px;
				top: 1px;
				background-image: linear-gradient(bottom, rgb(171, 27, 27) 100%, rgb(212, 51, 51) 0%);
			}
			
			.rel {
				margin-top: 15px;
				font-family: 'Open Sans', sans-serif;
				font-size: 20px;
				text-decoration: none;
				text-align: center;
				color: #fff;
			}
			
			.pai_rel {
				margin-top: 15px;
			}
			
			.btn_ctl {
				margin-top: 15px;
			}
		</style>

	</head>

	<body>
		<div class="containe">
			<div class="row">
				<img id="pai_1" src="img/11.png" class="img_mj" />
				<img id="pai_2" src="img/12.png" class="img_mj" />
				<img id="pai_3" src="img/13.png" class="img_mj" />
				<img id="pai_4" src="img/12.png" class="img_mj" />
				<img id="pai_5" src="img/13.png" class="img_mj" />

				<img id="pai_6" src="img/14.png" class="img_mj" />
				<img id="pai_7" src="img/15.png" class="img_mj" />
				<img id="pai_8" src="img/15.png" class="img_mj" />

				<img id="pai_9" src="img/15.png" class="img_mj" />
				<img id="pai_10" src="img/15.png" class="img_mj" />
				<img id="pai_11" src="img/16.png" class="img_mj" />
				<img id="pai_12" src="img/17.png" class="img_mj" />
				<img id="pai_13" src="img/18.png" class="img_mj" />
				<img src="img/question.png" class="img_mj_q" />
			</div>
			<!--		<a class="ui-btn" id="btn_refresh"> 发牌</a>-->
			<div class="row pai_rel">
				<div>
					<img num="11" src="img/11.png" class="img_mj_s" />
					<img num="12" src="img/12.png" class="img_mj_s" />
					<img num="13" src="img/13.png" class="img_mj_s" />
					<img num="14" src="img/14.png" class="img_mj_s" />
					<img num="15" src="img/15.png" class="img_mj_s" />
					<img num="16" src="img/16.png" class="img_mj_s" />
					<img num="17" src="img/17.png" class="img_mj_s" />
					<img num="18" src="img/18.png" class="img_mj_s" />
					<img num="19" src="img/19.png" class="img_mj_s" />
				</div>
				<div>
					<img num="21" src="img/21.png" class="img_mj_s" />
					<img num="22" src="img/22.png" class="img_mj_s" />
					<img num="23" src="img/23.png" class="img_mj_s" />
					<img num="24" src="img/24.png" class="img_mj_s" />
					<img num="25" src="img/25.png" class="img_mj_s" />
					<img num="26" src="img/26.png" class="img_mj_s" />
					<img num="27" src="img/27.png" class="img_mj_s" />
					<img num="28" src="img/28.png" class="img_mj_s" />
					<img num="29" src="img/29.png" class="img_mj_s" />
				</div>
				<div>
					<img num="31" src="img/31.png" class="img_mj_s" />
					<img num="32" src="img/32.png" class="img_mj_s" />
					<img num="33" src="img/33.png" class="img_mj_s" />
					<img num="34" src="img/34.png" class="img_mj_s" />
					<img num="35" src="img/35.png" class="img_mj_s" />
					<img num="36" src="img/36.png" class="img_mj_s" />
					<img num="37" src="img/37.png" class="img_mj_s" />
					<img num="38" src="img/38.png" class="img_mj_s" />
					<img num="39" src="img/39.png" class="img_mj_s" />
				</div>
			</div>
			<div class="btn_ctl row">
				<!--				<a class="a_demo_one" id="btn_share">分享</a>
-->
				<a class="a_demo_one" id="btn_help">帮助</a>
				<a class="a_demo_one" id="btn_ok">胡牌</a>

			</div>
			<div class="rel row">
				您已经答对<span id="ok_num">0</span>道题了！
			</div>
		</div>

		<div id="msg_modal" class="modal">
			<div class="modal-dialog">

				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
						<h4 class="modal-title" id="myModalLabel">我要胡！</h4>
					</div>
					<div class="modal-body">
						<p id="msg_content"></p>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">确定</button>
					</div>
				</div>
			</div>
		</div>

		<div id="help_modal" class="modal">
			<div class="modal-dialog">

				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
						<h4 class="modal-title" id="myModalLabel">我要胡！</h4>
					</div>
					<div class="modal-body" style="text-align: left;">
						<p>您已经听牌啦！赶快来找出所有能胡的牌吧! </p>
						<p>1.胡牌规则：一个对子(AA)+N个三个连牌(ABC)或三个同样的牌(AAA). </p>
						<p>2.有三次答错机会. </p>
						<p>3.选择所有可能会胡的牌，点击胡牌提交结果.</p>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">确定</button>
					</div>
				</div>
			</div>
		</div>

	</body>

	<script>
		var current_level = 0;
		var current_rel = [];
		var PAI = [11, 12, 13, 14, 15, 16, 17, 18, 19, 21, 22, 23, 24, 25, 26, 27, 28, 29, 31, 32, 33, 34, 35, 36, 37, 38, 39];

		var current_color = [];
		var current_rel = [];
		var life = 3;

		$(document).ready(function() {
			console.debug("ready");
			randomMajiang(3);
		});

		$(".img_mj_s").click(function() {
			$(this).toggleClass("img_mj_s_select");
		});

		$("#btn_refresh").click(function() {

		});

		$("#btn_share").click(function() {

			wx.onMenuShareTimeline({

				trigger: function(res) {
					// 不要尝试在trigger中使用ajax异步请求修改本次分享的内容，因为客户端分享操作是一个同步操作，这时候使用ajax的回包会还没有返回
					// alert('用户点击分享到朋友圈');
				},
				success: function(res) {
					// alert('已分享');
				},
				cancel: function(res) {
					// alert('已取消');
				},
				fail: function(res) {
					// alert(JSON.stringify(res));
				}
			});
		});

		$("#btn_help").click(function() {
			$('#help_modal').modal('show');

		});
		$("#btn_ok").click(function() {
			var user_rel = [];
			$(".img_mj_s").each(function() {
				if($(this).hasClass("img_mj_s_select")) {
					console.info($(this).attr("num"));
					user_rel.push($(this).attr("num"));

				}
			});
			if(user_rel.length == 0) {
				$("#msg_content").html("您没选择能胡的牌！");
				$('#msg_modal').modal('show');
				return;
			}
			user_rel.sort();
			var is_correct = 1;
			if(user_rel.length != current_rel.length) {
				console.info("error");
				is_correct = 0;
			} else {
				for(var i = 0; i < user_rel.length; i++) {
					if(user_rel[i] != current_rel[i]) {
						is_correct = 0;
					}
				}
			}
			if(is_correct == 0) {
				console.info("error");
				life--;
				if(life == 0) {
					$("#msg_content").html("游戏结束！您答对了" + current_level + "题！");
					$('#msg_modal').modal('show');
					init();
				} else {
					$("#msg_content").html("可惜不对啊,您还有" + life + "次机会，加油哦！");
					$('#msg_modal').modal('show');
				}

			} else {
				console.info("success");
				current_level++;
				refesh();
				$("#ok_num").html(current_level);
				$("#msg_content").html("您答对了！");
				$('#msg_modal').modal('show');
			}

		});

		var init = function() {
			life = 3;
			current_level = 1;
			$("#ok_num").html(0);
			refesh();
		}

		var refesh = function() {
			if(current_level < 2) {
				randomMajiang(3);
			} else if(current_level < 4) {
				randomMajiang(2);
			} else {
				randomMajiang(1);
			}

			$(".img_mj_s").removeClass("img_mj_s_select");
		}

		var randomMajiang = function(level) {
			current_rel = [];
			var offset = Math.floor(Math.random() * 333) % 3 * 9;
			var src_list = [];
			for(var i = 1; i <= level; i++) {
				for(var j = 0; j < 9; j++) {
					var idx = (offset + 9 * (i - 1) + j);
					if(idx >= 27) idx -= 27;
					src_list.push(PAI[idx]);
					src_list.push(PAI[idx]);
					src_list.push(PAI[idx]);
					src_list.push(PAI[idx]);
				}
			}
			console.log(src_list);

			var pai_list = [];
			var pai_map = {};
			//step 1 create 2
			var mod = src_list.length;

			var rd = Math.floor(Math.random() * 333) % mod;

			delFromSrcList(pai_list, src_list, [src_list[rd], src_list[rd]]);
			//step2 create 3
			for(var i = 0; i < 4; i++) {
				var find = findThree(src_list);
				delFromSrcList(pai_list, src_list, find)
			}
			console.log("pai_list");
			console.log(pai_list.sort());
			if(pai_list.length < 14) {
				console.error(pai_list);
				return;
			}

			var can_hu_idx = Math.floor(Math.random() * 100) % pai_list.length;
			var can_hu = pai_list[can_hu_idx];
			pai_list.splice(can_hu_idx, 1);

			//step 3 redraw
			createPic(pai_list);
			//step 4 left list
			var left_list = [];
			for(var i = 0; i < src_list.length; i++) //遍历当前数组
			{
				if(src_list[i] != can_hu && left_list.indexOf(src_list[i]) == -1) {
					left_list.push(src_list[i]);
				}
			}
			//step 5 hu list

			var hu_list = findHuList(pai_list, left_list);
			hu_list.push(can_hu);
			hu_list.sort();
			//			console.log("hu_list  " + hu_list);
			//			printPai(hu_list);
			current_rel = hu_list;
		}

		var findThree = function(src_list) {
			var find = [];
			var mod = src_list.length;
			var rd = Math.floor(Math.random() * 100) % mod;
			var rd_pai = src_list[rd];
			var retry = 100;
			while(--retry > 0) {
				var isThree = Math.floor(Math.random() * 100) % 8;
				//let 选择三个一样的
				if(isThree > 3) {
					var idx = src_list.indexOf(rd_pai);
					if(src_list[idx + 1] == rd_pai && src_list[idx + 2] == rd_pai) {
						find.push(rd_pai);
						find.push(rd_pai);
						find.push(rd_pai);
						return find;
					}
				}
				//能与后面连续
				if(src_list.indexOf(rd_pai + 1) > 0 && src_list.indexOf(rd_pai + 2) > 0) {
					find.push(rd_pai);
					find.push(rd_pai + 1);
					find.push(rd_pai + 2);
					return find;
				}
				//能与前后连续
				if(src_list.indexOf(rd_pai - 1) > 0 && src_list.indexOf(rd_pai + 1) > 0) {
					find.push(rd_pai - 1);
					find.push(rd_pai);
					find.push(rd_pai + 1);
					return find;
				}
				//能与前面连续
				if(src_list.indexOf(rd_pai - 2) > 0 && src_list.indexOf(rd_pai - 1) > 0) {
					find.push(rd_pai - 2);
					find.push(rd_pai - 1);
					find.push(rd_pai);
					return find;
				}
				//let 选择三个一样的
				var idx = src_list.indexOf(rd_pai);
				if(src_list[idx + 1] == rd_pai && src_list[idx + 2] == rd_pai) {
					find.push(rd_pai);
					find.push(rd_pai);
					find.push(rd_pai);
					return find;
				}
			}
		}

		var delFromSrcList = function(pai_list, src_list, find_list) {
			$.each(find_list, function(idx, item) {
				if(item > 0) {
					pai_list.push(item);
					src_list.splice(src_list.indexOf(item), 1);
				}
			});

		}

		var createPic = function(pai_list) {
			$.each(pai_list, function(idx, item) {
				$("#pai_" + (idx + 1)).attr("src", "img/" + item + ".png");
			});
		}

		var findHuList = function(pai_list, left_list) {

			var hu_list = [];
			$.each(left_list, function(idx, item) {
				var temp_list = copy_list(pai_list);
				temp_list.push(item);
				temp_list.sort();
				var rel = judge(temp_list);
				if(rel > 0) {
					if(hu_list.indexOf(item) < 0)
						hu_list.push(item);
				}
			});
			return hu_list;

		}

		var judge = function(pai_list) {
			for(var i = 0; i < 13; i++) {
				if(pai_list[i] == pai_list[i + 1]) {
					var temp_pai = pai_list[i];
					var temp_list = copy_list(pai_list);
					temp_list.splice(temp_list.indexOf(temp_pai), 2);
					if(judgeThree(temp_list) > 0)
						return 1;
				}
			}
			return 0;
		}

		var judgeThree = function(pai_list) {
			//			console.log(pai_list);
			var judge_list = [];
			if(pai_list.length % 3 != 0) {
				console.error(pai_list);
				return 0;
			}

			if(pai_list != null && pai_list.length == 0) {
				//				if(pai_list[0] == pai_list[1] == pai_list[2])
				//					return 1
				//				if(pai_list[0]+2 == pai_list[1]+1 == pai_list[0])
				//					return 1
				return 1;
			}
			var first = pai_list[0];
			if(pai_list.indexOf(first + 1) > 0 && pai_list.indexOf(first + 2) > 0) {
				var temp_list = copy_list(pai_list);
				temp_list.splice(temp_list.indexOf(first), 1);
				temp_list.splice(temp_list.indexOf(first + 1), 1);
				temp_list.splice(temp_list.indexOf(first + 2), 1);

				if(judgeThree(temp_list) > 0)
					return 1;
			}

			if(pai_list[1] == first && pai_list[2] == first) {
				var temp_list = copy_list(pai_list);
				temp_list.splice(temp_list.indexOf(first), 3);
				if(judgeThree(temp_list) > 0)
					return 1;
			}
			return 0;
		}

		var printPai = function(list) {
			var pai_names = [];
			$.each(list, function(idx, item) {
				var unit = Math.floor(item / 10);
				var num = item % 10;
				var name = "" + num;
				switch(unit) {
					case 1:
						name += "S";
						break;
					case 2:
						name += "W";
						break;
					case 3:
						name += "T";
						break;
				}
				pai_names.push(name);
			});
			console.log("HUHUHUHUHUHU");
			console.log(pai_names);
		}

		var copy_list = function(list) {
			var new_list = [];
			$.each(list, function(i, val) {
				if(val != undefined)
					new_list.push(val);
			});
			return new_list;
		}
	</script>

</html>