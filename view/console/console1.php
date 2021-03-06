<?php
include_once '../../php/conn.php';
$sql = "SELECT tel,email FROM user WHERE user_id = '{$_SESSION['uid']}'";
$res = ($mySQLi->query($sql))->fetch_all(MYSQLI_ASSOC);

$sql1 = "SELECT SUM(quantity) AS num FROM book";
$res1 = ($mySQLi->query($sql1))->fetch_all(MYSQLI_ASSOC);;
$book_nums = $res1[0]['num'];

$sql2 = "SELECT COUNT(*) AS num FROM cate";
$res2 = ($mySQLi->query($sql2))->fetch_all(MYSQLI_ASSOC);;
$cate_nums = $res2[0]['num'];
?>

<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<title>首页</title>
	<meta name="renderer" content="webkit">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<link href="../../admin/css/pearCommon.css" rel="stylesheet" />
	<link rel="stylesheet" href="../../component/layui/css/layui.css" media="all">
	<style>
		.top-panel {
			border-radius: 4px;
			text-align: center;
		}

		.top-panel>.layui-card-body {
			height: 60px;
		}

		.top-panel-number {
			line-height: 60px;
			font-size: 20px;
			border-right: 1px solid #eceff9;
		}

		.top-panel-tips {
			padding-left: 8px;
			padding-top: 16px;
			line-height: 30px;
			font-size: 12px;
		}

		.pear-container {
			background-color: whitesmoke;
			margin: 10px;
		}

		.card {
			width: 100%;
			height: 160px;
			background-color: whitesmoke;
			border-radius: 4px;
		}

		.card .header .avatar {
			width: 28px;
			height: 28px;
			margin: 20px;
			border-radius: 50px;
		}

		.card .header {
			color: dimgray;
		}

		.card .body {
			color: gray;
		}

		.card .body {
			margin-left: 20px;
			margin-right: 20px;
		}

		.card .footer {
			margin-left: 20px;
			margin-right: 20px;
			margin-top: 20px;
			font-size: 13px;
			color: gray;
			position: absolute;
		}

		.list .list-item {
			height: 33px;
			line-height: 33px;
			color: gray;
			padding: 5px;
			padding-left: 15px;
			border-radius: 4px;
			margin-top: 5.2px;
			cursor: pointer;
		}

		.custom-tab .layui-tab-title {
			border-bottom-width: 0px;
			border-bottom-style: none;
		}

		.custom-tab .layui-tab-title li {
			margin-left: 10px;
		}

		.list .list-item:hover {
			background-color: whitesmoke;
		}

		.list .list-item .title {
			font-size: 13px;
			width: 100%;
		}

		.list .list-item .footer {
			position: absolute;
			right: 30px;
			font-size: 12px;
		}

		.top-panel-tips i {
			font-size: 33px;
		}

		.layuiadmin-card-status {
			padding: 0 10px 10px;
		}

		.layuiadmin-card-status dd {
			padding: 15px 0;
			border-bottom: 1px solid #EEE;
			display: -webkit-flex;
			display: flex;
		}

		.layuiadmin-card-status dd div.layui-status-img,
		.layuiadmin-card-team .layui-team-img {
			width: 32px;
			height: 32px;
			border-radius: 50%;
			background-color: #009688;
			margin-right: 15px;
		}

		.layuiadmin-card-status dd div.layui-status-img a {
			width: 100%;
			height: 100%;
			display: inline-block;
			text-align: center;
			line-height: 32px;
		}

		.layuiadmin-card-status dd div span {
			color: #BBB;
		}

		.layuiadmin-card-status dd div a {
			color: #01AAED;
		}

		.person h1 {
			text-align: center;
			font-weight: bold;
			margin-top: 30px;
			margin-bottom: 30px;
		}

		.person h2 {
			float: left;
			width: 100%;
			margin-top: 30px;
			margin-left: 20px;
		}
	</style>
</head>

<body class="pear-container">
	<div>
		<div class="layui-row layui-col-space10">
			<div class="layui-col-md4">
				<div class="layui-card">
					<div class="layui-card-body person">

						<h1>欢迎你！ <span style="color:#5FB878;"><?php echo $_SESSION['username']; ?></span></h1>
						<hr>
						<?php if ($_SESSION['access'] == 2) : ?>
							<h2>手机号：<?php echo $res[0]['tel']; ?></h2>
							<h2>邮&nbsp;&nbsp;&nbsp;箱：<?php echo $res[0]['email']; ?></h2>
							<div style="width: 100%; text-align:center;">
								<button type="" class="pear-btn pear-btn-primary modify-btn" style="margin:15px 0 15px 0">请在我的信息页修改信息</button>
							</div>
						<?php endif; ?>
					</div>

				</div>
				<div class="layui-card">
					<div class="layui-card-header">系统公告</div>
					<div class="layui-card-body">
						<ul class="list notice-list">
							<li class="list-item"><span class="title">优化代码格式</span><span class="footer">2020-06-04 11:28</span></li>
							<li class="list-item" style="text-align: center;"><span><a>查看更多公告</a></span></li>
						</ul>
					</div>
				</div>
			</div>
			<div class="layui-col-xs12 layui-col-md8 layui-col-space10">
				<div class="layui-carousel" id="test1">
					<div carousel-item>
						<div><img src="https://www.hnie.edu.cn/uploads/1584584374823.jpg" alt="" style="width:100%;height:100%"></div>
						<div><img src="https://www.hnie.edu.cn/uploads/1555580804545.jpg" alt="" style="width:100%;height:100%"></div>
						<div><img src="https://www.hnie.edu.cn/uploads/1555663028959.jpg" alt="" style="width:100%;height:100%"></div>
					</div>
				</div>
				<div class="layui-col-xs6 layui-col-md6">
					<div class="layui-card top-panel">
						<div class="layui-card-header">馆藏图书</div>
						<div class="layui-card-body">
							<div class="layui-row layui-col-space5">
								<div class="layui-col-xs8 layui-col-md8 top-panel-number">
									<?php echo $book_nums; ?>册
								</div>
								<div class="layui-col-xs4 layui-col-md4 top-panel-tips">
									<i class="layui-icon layui-icon-star" style="color: #DD4A68;"></i>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="layui-col-xs6 layui-col-md6">
					<div class="layui-card top-panel">
						<div class="layui-card-header">共有分类</div>
						<div class="layui-card-body">
							<div class="layui-row layui-col-space5">
								<div class="layui-col-xs8 layui-col-md8 top-panel-number">
									<?php echo $cate_nums; ?>种
								</div>
								<div class="layui-col-xs4 layui-col-md4  top-panel-tips">
									<i class="layui-icon layui-icon-template-1" style="color: #5FB878;"></i>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="layui-col-xs12 layui-col-md12">
					<div class="layui-card">
						<div class="layui-card-header">每日一句</div>
						<div class="layui-card-body daywords">
						</div>
					</div>
				</div>
			</div>
		</div>
		<div id='notice-box' style='display:none'>
			<div class="layui-card">
				<div class="layui-card-header">
					<div class='notice-box-title'>

					</div>
				</div>
				<div class="layui-card-body">内容：
					<div class='notice-box-content'>

					</div>
				</div>
				<div class="layui-card-body">发布时间：
					<div class='notice-box-time'>

					</div>
				</div>

			</div>

		</div>
		<!--</div>-->
		<script src="../../component/layui/layui.js" charset="utf-8"></script>
		<script type="text/javascript">
			layui.use(['layer', 'element', 'carousel', 'jquery'], function() {
				layer.ready(function(params) {
					let $ = layui.jquery,
						layer = layui.layer;
					let pearTab = layui.pearTab;
					let carousel = layui.carousel;
					carousel.render({
						elem: '#test1',
						width: '100%',
						arrow: 'hover', //始终显示箭头
						//,anim: 'updown' //切换动画方式
						height: '25rem'
						//height: (W / b).toString() + "px"
					});
					$.ajax({
						method: 'post',
						url: 'https://v1.alapi.cn/api/mingyan?typeid=22',
						success: function(data) {
							$('.daywords').text(data.data.content + '---' + data.data.author);
						}
					})

					$.ajax({
						method: 'post',
						url: '../../php/system.php?s=getNoticeList',
						success: function(res) {
							res = JSON.parse(res);
							data = res.data;
							let str = '';
							$('.notice-list').html('');
							for (var k in data) {
								$('.notice-list').append('<li class="list-item" notice-id = "' + data[k].id + '" content = "' + data[k].content + '"><span class="title">' + data[k].title + '</span><span class="footer">' + data[k].release_time + '</span></li>');
							}
						},
					}).done(function() {
						$('.list-item').each(function() {
							$(this).on('click', function() {
								// console.log($(this).attr('notice-id'));
								let content = $(this).attr('content');
								let title = $(this).children('.title').text();
								let time = $(this).children('.footer').text();
								layer.open({
									title: '公告',
									type: 1,
									area: ['300px', '350px'],
									content: $('#notice-box'),
									btn: ['确定'],
									success: function() {
										$('.notice-box-title').text(title);
										$('.notice-box-content').text(content);
										$('.notice-box-time').text(time);
									},

								})
							})
						})
						$('.notice-list').append('<li class = "list-item" style = "text-align: center;" > <span> <a> 查看更多公告 </a></span> </li>');
					})
				})
			});
			// window.onload = function() {
			// 	var bannerH = $('.carousel-item img')[0].height;
			// 	$('.layui-carousel').css('height', bannerH + 'px');

			// }
		</script>
</body>

</html>