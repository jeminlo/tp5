<?php /*a:6:{s:62:"C:\xampp\htdocs\tp5\application\admin\view\user\user_list.html";i:1534413587;s:61:"C:\xampp\htdocs\tp5\application\admin\view\public\layout.html";i:1534389138;s:61:"C:\xampp\htdocs\tp5\application\admin\view\public\header.html";i:1534218633;s:58:"C:\xampp\htdocs\tp5\application\admin\view\public\nav.html";i:1534567512;s:59:"C:\xampp\htdocs\tp5\application\admin\view\public\left.html";i:1534411970;s:61:"C:\xampp\htdocs\tp5\application\admin\view\public\footer.html";i:1534318060;}*/ ?>
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
                
<h4 class="text-center text-success">用户列表</h4>
<table class="table table-default table-hover text-center">
    <tr>
        <td>ID</td>
        <td>用户</td>
        <td>邮箱</td>
        <td>手机</td>
        <td>注册时间</td>
        <td>状态</td>
        <td>会员类型</td>
        <td>操作</td>
    </tr>
    <?php if(is_array($userList) || $userList instanceof \think\Collection || $userList instanceof \think\Paginator): $i = 0; $__LIST__ = $userList;if( count($__LIST__)==0 ) : echo "empty" ;else: foreach($__LIST__ as $key=>$user): $mod = ($i % 2 );++$i;?>
    <tr>
        <td><?php echo htmlentities($user->id); ?></td>
        <td><?php echo htmlentities($user->name); ?></td>
        <td><?php echo htmlentities($user->email); ?></td>
        <td><?php echo htmlentities($user->mobile); ?></td>
        <td><?php echo htmlentities($user->create_time); ?></td>
        <td><?php echo htmlentities($user->status); ?></td>
        <td><?php echo htmlentities($user->is_admin); ?></td>
        <td>
            <?php if($user->id == app('session')->get('admin_id')): ?>
            <a href="<?php echo url('admin/user/useredit', ['id' => $user['id']]); ?>">
                <button class="btn btn-xs btn-success">Edit</button>
            </a>
            <?php endif; if($user->id != app('session')->get('admin_id')): ?>
            <a href="<?php echo url('admin/user/userDelete', ['id' => $user->id]); ?>" onclick="return confirm('确认删除?')">
                <button class="btn btn-xs btn-danger">删除</button>
            </a>
            <?php endif; ?>
        </td>
    </tr>
    <?php endforeach; endif; else: echo "empty" ;endif; ?>
</table>
<div><?php echo $userList; ?></div>
            </div>
        </div>
    </div>
</div>
<div style="height: 50px;"></div>
</body>
</html>