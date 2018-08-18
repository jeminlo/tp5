<?php /*a:6:{s:69:"C:\xampp\htdocs\tp5\application\admin\view\article_category\edit.html";i:1534406989;s:61:"C:\xampp\htdocs\tp5\application\admin\view\public\layout.html";i:1534389138;s:61:"C:\xampp\htdocs\tp5\application\admin\view\public\header.html";i:1534218633;s:58:"C:\xampp\htdocs\tp5\application\admin\view\public\nav.html";i:1534567512;s:59:"C:\xampp\htdocs\tp5\application\admin\view\public\left.html";i:1534411970;s:61:"C:\xampp\htdocs\tp5\application\admin\view\public\footer.html";i:1534318060;}*/ ?>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title><?php echo htmlentities((isset($title) && ($title !== '')?$title:'社区问答')); ?></title>
   <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo htmlentities((isset($title) && ($title !== '')?$title:'默认标题')); ?></title>
    <link rel="stylesheet" type="text/css" href="/tp5/public/static/css/bootstrap.min.css" />
    <script type="text/javascript" src="/tp5/public/static/js/jquery-3.3.1.min.js"></script>
    <script type="text/javascript" src="/tp5/public/static/js/bootstrap.min.js"></script>
</head>
<body>

</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-dm-12">
            <nav class="navbar navbar-default ">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?php echo url('admin/index/index'); ?>"><?php echo htmlentities((isset($siteName) && ($siteName !== '')?$siteName:'控制面板')); ?></a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                <li><a href="<?php echo url('index/index/index'); ?>">回到前台</a></li>

                <?php if(app('session')->get('admin_id')): ?>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                       aria-haspopup="true" aria-expanded="false"><?php echo htmlentities(app('session')->get('admin_name')); ?> <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <!--<li><a href="<?php echo url('index/insert'); ?>">管理中心</a></li>-->
                        <!--<li role="separator" class="divider"></li>-->
                        <li><a href="<?php echo url('user/logout'); ?>">Logout</a></li>
                    </ul>
                </li>
                <?php else: endif; ?>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>
            <div class="col-md-2">
                <?php if(app('session')->get('admin_level') == '1'): ?>
<ul class="nav nav-pills nav-stacked">
    <li class="nav-header h3">系统管理</li>
    <li><a href="#"><span class="glyphicon glyphicon-cog">&nbsp;网站管理</span></a></li>
</ul>
<?php endif; ?>
<ul class="nav nav-pills nav-stacked">
    <li class="nav-header h3">用户管理</li>
    <li><a href="<?php echo url('admin/user/userlist'); ?>"><span class="glyphicon glyphicon-user">&nbsp;用户</span></a></li>
</ul>
<ul class="nav nav-pills nav-stacked">
    <li class="nav-header h3">文章管理</li>
    <li><a href="<?php echo url('admin/articleCategory/CategoryList'); ?>"><span class="glyphicon glyphicon-list">&nbsp;分类管理</span></a></li>
    <li><a href="<?php echo url('admin/article/ArticleList'); ?>"><span class="glyphicon glyphicon-file">&nbsp;文章管理</span></a></li>
</ul>
            </div>
            <div class="col-md-10">
                
<h4 class="text-center text-primary">编辑分类信息</h4>
<form class="form-horizontal" action="<?php echo url('admin/ArticleCategory/update'); ?>" method="post">
    <div class="form-group">
        <label for="name" class="col-sm-2 control-label">名称</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name="name" id="name" value="<?php echo htmlentities($cateInfo['name']); ?>" required>
        </div>
    </div>
    <div class="form-group">
        <label for="sort" class="col-sm-2 control-label">排序</label>
        <div class="col-sm-10">
            <input type="number" step="1" class="form-control" name="sort" id="sort" value="<?php echo htmlentities($cateInfo['sort']); ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">状态</label>
        <div class="col-sm-10">
            <label class="radio-inline">
                <input type="radio" required name="status"  value="1"  <?php if(1 == $cateInfo->getData('status')): ?>checked<?php endif; ?>>显示
            </label>
            <label class="radio-inline">
                <input type="radio" required name="status" value="0" <?php if(0 == $cateInfo->getData('status')): ?>checked<?php endif; ?>>隐藏
            </label>
        </div>
    </div>
    <input type="hidden" name="id" value="<?php echo htmlentities($cateInfo['id']); ?>">
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-default">Submit</button>
        </div>
    </div>

</form>

            </div>
        </div>
    </div>
</div>
<div style="height: 50px;"></div>
</body>
</html>