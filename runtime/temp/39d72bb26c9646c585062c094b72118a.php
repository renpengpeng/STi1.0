<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:53:"D:\phpstudy1\WWW\blog\template\index\pages\index.html";i:1511874149;s:34:"../template/index/common/head.html";i:1512568770;s:37:"../template/index/common/sidebar.html";i:1511873995;s:36:"../template/index/common/footer.html";i:1512569067;}*/ ?>
 <!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewPort" content="width=device-width,initial-scale=1.0,maximum-scale=1,minimun-scale=1">
  <link rel="stylesheet" type="text/css" href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/static/index/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/static/index/css/style.css">
  <link rel="stylesheet" type="text/css" href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/static/index/css/font-awesome.min.css">
  <title><?php echo $web_title; ?></title>
  <meta name="keywords" content="<?php echo $web_keywords; ?>">
  <meta name="description" content="<?php echo $web_description; ?>">
</head>
<body>
<!--导航栏开始 -->
<div class="container-fuild navbar">
  <div class="container">
    <div class="logo">
      <a href="http://<?php echo $_SERVER['HTTP_HOST']; ?>"><?php echo $logo_name; ?></a>
    </div>
    <div class="menu-list">
      <?php echo $menuArr; ?>
    </div>
  </div>
</div>
<!-- 开始主体内容 -->
<div class="container">
  <!-- 文章展示部分 -->
  <div class=" col-md-9">
  <div class="pages" style="border: 1px solid #eee;">
    <!-- 页面标题 -->
    <div class="pages_title">
        <h3><?php echo $articlesArr['title']; ?></h3>
    </div>
    <!-- 页面内容 -->
    <div class="pages_content">
      <?php echo $articlesArr['content']; ?>

    </div>
  </div>
  </div>
  <!-- 开始侧边栏 -->
  <div class="sidebar col-md-3 hidden-sm hidden-xs">
    <div class="sidebar_me">
      博客已安全运行<?php echo $days; ?>天
    </div>
    <!-- 随机文章推荐 -->
    <div class="sidebar_suiji">
      <div class="sidebar_title">
        随机文章推荐
      </div>
      <div class="sidebar_list">
        <ul>
           <?php if(is_array($sidebarList) || $sidebarList instanceof \think\Collection || $sidebarList instanceof \think\Paginator): $i = 0; $__LIST__ = $sidebarList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$ids): $mod = ($i % 2 );++$i;?>
              <li><a href="<?php echo url('index/posts/index',['postId'=>$ids['id']]); ?>"><?php echo $ids['title']; ?></a></li>
           <?php endforeach; endif; else: echo "" ;endif; ?>
         
        </ul>
      </div>
      <!-- 友情链接 -->
      <div class="sidebar_title">
        友情链接
      </div>
      <div class="sidebar_links">
        <?php foreach($linkList as $link): ?>
          <a href="<?php echo $link['href']; ?>"><?php echo $link['name']; ?></a>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
   <div class="clearfix"></div>
  <!-- 底部 -->
  <div class="bottom">
  版权所有©<?php echo $logo_name; ?>
  </div>
</div>
 <!-- <script src="http://<?php echo $_SERVER['HTTP_HOST']; ?>/static/index/js/jquer.min.js"></script> -->
 <script src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>
 <script src="http://<?php echo $_SERVER['HTTP_HOST']; ?>/static/index/js/index.js"></script>
</body>
</html>