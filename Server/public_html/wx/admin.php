<!DOCTYPE html>
<html>
	<head>
		<meta charset="{CHARSET}">
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
		.input_ps{
		    width: 80%;
		    height: 80px;
		    font-size: 40px;
		    top: 20%;
		    left: 10%;
		}
		._submit{

		    top: 40%;
		}
	</style>
	<body class="">

		<div class="main div_loction mobile_bg" id="main">
			
				
				
			


<?php

function delFile($dirName){
    if(file_exists($dirName) && $handle=opendir($dirName)){
        while(false!==($item = readdir($handle))){
            if($item!= "." && $item != ".."){
                if(file_exists($dirName.'/'.$item) && is_dir($dirName.'/'.$item)){
                    delFile($dirName.'/'.$item);
                }else{
                    if(unlink($dirName.'/'.$item)){
                        return true;
                    }
                }
            }
        }
        closedir( $handle);
    }
}


	
	if(isset($_GET["clear_data"])){
		delFile("./data/");
		echo '<button type="button" id="out" class="md-trigger">已经全部清零数据,点击返回退出.</button>  ';
	}else{

		if(isset($_POST["pwd"])){
			$pwd = trim($_POST["pwd"]);
			if($pwd == "dddddd"){
				echo '<button type="button" id="clear_data" class="md-trigger">全部数据归零.</button>  ';
			}else{
				echo '<button type="button" class="md-trigger">密码错误,重新输入.</button>  ';
				echo '<form action="./admin.php" method="post" >';
				echo '<input name="pwd" class="already input_ps" value="" placeholder="输入管理员密码" />';
				echo '<button type="submit" class="md-trigger _submit">提交</button>  ';
				echo '</form>';
			}
		}else{
			echo '<form action="./admin.php" method="post" >';
			echo '<input name="pwd" class="already input_ps" value="" placeholder="输入管理员密码" />';
			echo '<button type="submit" class="md-trigger _submit">提交</button>  ';
			echo '</form>';
		}
	}
?>
		</div>
		<script type="text/javascript">
			var clear_data = document.getElementById('clear_data');
			if(clear_data){

				clear_data.onclick=function(){
					if(confirm("确定这样做?")){
						window.location.href = window.location.href+'?clear_data=true'
					}
				}
			}
			var out = document.getElementById('out');
			if(out){

				out.onclick=function(){
					var url = window.location.href.replace(/\?.+$/,'');
					console.log(url);
					window.location.href = window.location.href.replace(/\?.+$/,'');
				}
			}
		</script>
	</body>
</html>
