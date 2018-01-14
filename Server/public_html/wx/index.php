<?php
	header("Content-type:text/html;charset=utf-8");

	$access_token = "./access_token.txt";
	$jsapi_ticket = "./jsapi_ticket.txt";
    require './autoload.php';



	$config = require("./config.php");
    $appId = $config["appId"];
    $appSecret = $config["appSecret"];
    $token = $config["token"];
    $encodingAESKey = $config["encodingAESKey"];
	
	$base_url = $config["base_url"];
	
	
	$wechat = new  \Gaoming13\WechatPhpSdk\Wechat(array(		
		'appId' => $appId,	
		'token' => 	$token,
		'encodingAESKey' =>	$encodingAESKey
	));

    $api = new \Gaoming13\WechatPhpSdk\Api(
        array(
            'appId' => $appId,
            'appSecret'	=> $appSecret,
            'get_access_token' => function() use($access_token) {
				$token = file_get_contents($access_token);
                return $token;
            },
            'save_access_token' => function($token) use($access_token) {
				file_put_contents($access_token,$token);
            },
			'get_jsapi_ticket' => function() use ($jsapi_ticket) {
				// 可选：用户需要自己实现jsapi_ticket的返回（若使用get_jsapi_config，则必须定义）
				return file_get_contents($jsapi_ticket);
			},
			'save_jsapi_ticket' => function($jsapi_ticket_text) use ($jsapi_ticket) {
				// 可选：用户需要自己实现jsapi_ticket的保存（若使用get_jsapi_config，则必须定义）
				file_put_contents($jsapi_ticket_text,$jsapi_ticket);
			}
        )
    );
	
	$wechat->serve();
	?>
<!DOCTYPE html>
<html>
	<head>
	<meta http-equiv="content-type" content="text/html;charset=utf-8">
		<title>一心铸服务,创新赢未来.</title>
	</head>
	<style>
		body,ol,ul,h1,h2,h3,h4,h5,h6,p,th,td,dl,dd,form,fieldset,legend,input,textarea,select{margin:0;padding:0} 
		body{background:#000;-webkit-text-size-adjust:100%;
			} 
		a{color:#2d374b;text-decoration:none} 
		a:hover{color:#cd0200;text-decoration:underline} 
		em{font-style:normal} 
		li{list-style:none} 
		img{border:0;vertical-align:middle} 
		table{border-collapse:collapse;border-spacing:0} 
		p{word-wrap:break-word}
		.main{
			background-image: url('img/bg.jpg');
			position: relative;
		}
		.mobile_bg{
			
			background-color: #000000;
			background-attachment: fixed;
			background-repeat: no-repeat;
			background-size:100% 100%;
			width:100%;
			
			height: 100%;
		}
		.div_loction{
			position: absolute;
		}
		.firster{
			left: 0;
			top: 0;
		}
		button {
		    border: none;
		    padding: 0.6em 1.2em;
		    background: #c0392b;
		    color: #fff;
		    font-family: 'Lato', Calibri, Arial, sans-serif;
		    font-size: 1em;
		    letter-spacing: 1px;
		    text-transform: uppercase;
		    cursor: pointer;
		    display: inline-block;
		    margin: 3px 2px;
		    border-radius: 2px;    
		    width: 80%;
		    left: 10%;
		    position: absolute;
		    height: 10%;
		    top:5%;
		    font-size: 40px;
		    z-index: 12;
		}
		.success{
			z-index: 10;
			background-image: url('img/success.jpg');
		}
		.fail{
			z-index: 9;
			background-image: url('img/fail.jpg');
		}
		.icons{
			left:10%;
			top:30%;
			position: relative;
			width: 80%;
			height: 300px;
		}
		.illum_ico{
			position: absolute;
			z-index: 6;
		}
		.illum_ico.icon1{    
			left: 0px;
		    top: 0;
		}
		.illum_ico.icon2{    
			right: 0px;
		    top: 0;
		}
		.illum_ico.icon3{    
			left: 0px;
		    bottom: 0;
		}
		.illum_ico.icon4{    
			right: 0px;
		    bottom: 0;
		}
		.illum_ico.bg{
			z-index: 5;
		}
		.already{
			background-color: #A5DE37;
		    border-color: #A5DE37;
		    color: #FFF;
	        z-index: 99;
		    position: absolute;
		    right: 5%;
		    bottom: 5%;

		    font-weight: 300;
		    font-size: 16px;
		    font-family: "Helvetica Neue Light", "Helvetica Neue", Helvetica, Arial, "Lucida Grande", sans-serif;
		    text-decoration: none;
		    text-align: center;
		    line-height: 40px;
		    height: 40px;
		    padding: 0 40px;
		    margin: 0;
		    display: inline-block;
		    appearance: none;
		    cursor: pointer;
		    border: none;
		    -webkit-box-sizing: border-box;
		    -moz-box-sizing: border-box;
		    box-sizing: border-box;
		    -webkit-transition-property: all;
		    transition-property: all;
		    -webkit-transition-duration: .3s;
		    transition-duration: .3s;
		}
	</style>
	<body class="">
		<div class="main div_loction mobile_bg" id="main">
<?php
    /**
     * demo_message.php
     * 主送发送客服消息 DEMO
     *
     * wechat-php-sdk DEMO
     *
     * @author 		gaoming13 <gaoming13@yeah.net>
     * @link 		https://github.com/gaoming13/wechat-php-sdk
     * @link 		http://me.diary8.com/
     */

	list($err, $user_info) = $api->get_userinfo_by_authorize('snsapi_base');
	
	if ($user_info !== null) {
		$openid = $user_info["openid"];
		$data_dir = "./data/";
		$data_text = $data_dir.$openid.".txt";

		$icon = @$_GET["icon"];
		if($icon=="")$icon=999;
		$icon = (INT)$icon;
		
		if(file_exists($data_text)){
			$data_text_c = file_get_contents($data_text);
			$userData = unserialize($data_text_c);
		}else{
			$userData = array(
				"icon1"=>0,
				"icon2"=>0,
				"icon3"=>0,
				"icon4"=>0,
			);
		}
		/*更新用户数据*/
		$Isscore = isset($userData["icon".$icon]) ? $userData["icon".$icon] : 1;
		$IsAdd = "";
		if( $Isscore == 0 ){
			/*扫中.*/
			$userData["icon".$icon] =1;
			$IsAdd = "+1 ";
			//
		}else{
			echo '<div class="fail mobile_bg div_loction firster" id="fail"></div>';
		}
		?>
		<div class="icons div_loction">
		<?php
		$count = 0;
		foreach ($userData as $key => $v) {
			if($v == 1){
				$bg = "";
				$count++;
			}else{
				$bg = "bg";
				//2_bg_ico
				//2_ico
			}
			$thisKey = substr($key,-1);
			echo '<div class="illum_ico icon'.$thisKey.' '.$bg.'"><img src="./img/'.$thisKey.$bg.'_ico.png"></div>';
		}
		?>
		</div>
		<?php
		switch ($count) {
			case 0:
				$buttonMes = "点亮数:".$count.",马上开始吧.";
				break;
			case 1:
				$buttonMes = "点亮数:".$count.",再接再利噢.";
				break;
			case 2:
				$buttonMes = "点亮数:".$count.",胜利就在眼前噢.";
				break;
			case 3:
				$buttonMes = "点亮数:".$count.",再加把劲您就是赢家.";
				break;
			
			default:
				$buttonMes = "点亮数:".$count.",您已全部点亮!";
				/*统计全部已经完成的用户*/

				$Cdata_text = $data_dir."count.txt";	
				if(file_exists($Cdata_text)){
					$Cdata_text_c = file_get_contents($Cdata_text);
					$CData = unserialize($Cdata_text_c);
				}else{
					$CData = array();
				}
				$CData = array_unique($CData);

				if(!in_array($openid,$CData)){
					array_push($CData, $openid);
				}
				file_put_contents($Cdata_text,serialize($CData));

				/*判断是否超出中奖用户*/
				$max_prize = (INT)$config["max_prize"];
				$count_CData = count($CData);
				if($count_CData <= $max_prize){
					echo '<div class="success div_loction firster mobile_bg" id="success"></div>';
				}else{

				}
			break;
		}
		echo '<button id="button_c" class="md-trigger" data-modal="modal-1">'.$IsAdd .$buttonMes.'</button>';
		file_put_contents($data_text,serialize($userData));
		echo '<a  class="already" > 完成人数:'.$count_CData.'</a>';

	} else {
		if(isset($_GET["create_code"])){
			$max_lighten = (INT)$config["max_lighten"]+1;
			include  './phpqrcode/phpqrcode.php'; 
			for($i=1;$i<$max_lighten;$i++){

				$errorCorrectionLevel = 'L';//容错级别 
				$matrixPointSize = 6;//生成图片大小 
				//生成二维码图片 
				//https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx71e286b8a90268fd&redirect_uri=http%3A%2F%2Fnh.wuhuhanji.com&icon=1&response_type=code&scope=snsapi_base&state=&connect_redirect=1#wechat_redirect
				$author_url = 'https://open.weixin.qq.com/connect/oauth2/authorize?appid='.$appId.'&redirect_uri=http%3A%2F%2F'.preg_replace("/^.+?\/\//", "", $base_url).'&icon='.$i.'&response_type=code&scope=snsapi_base&state=&connect_redirect=1#wechat_redirect';

				$QP = './code/'.$i.".png";
				QRcode::png($author_url, $QP, $errorCorrectionLevel, $matrixPointSize, 2); 
				$QR = imagecreatefromstring(file_get_contents($QP)); 
				imagepng($QR, $QP); 
			}
			echo "一共生成了".($max_lighten-1)."个二维码.";
		}else{
			echo '<button  class="md-trigger" data-modal="modal-1">微信身份验证失败.请联系技术人员.</button>';
			echo '<div class="icons div_loction">';
			echo '<div class="illum_ico icon1 bg"><img src="./img/1bg_ico.png"></div>';
			echo '<div class="illum_ico icon2 bg"><img src="./img/2bg_ico.png"></div>';
			echo '<div class="illum_ico icon3 bg"><img src="./img/3bg_ico.png"></div>';
			echo '<div class="illum_ico icon4 bg"><img src="./img/4bg_ico.png"></div>';
			echo '</div>';
			echo '<a  class="already" > 游戏暂停中...</a>';
		}
		//echo '<a style="font-size:40px" href="'.$author_url.'">点击跳转验证授权测试. '.$author_url.'</a>';
	}
?>

		</div>

	</body>
	<script>
		var main = document.getElementById('main')
		if(main){
			main.height=document.documentElement.clientHeight;
		}

		var fail = document.getElementById('fail')
		if(fail){
			fail.onclick=function(){
				this.style.display = 'none';
			}
		}
			
	</script>
</html>
