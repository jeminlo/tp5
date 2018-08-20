<?php /*a:6:{s:58:"C:\xampp\htdocs\tp5\application\index\view\user\login.html";i:1534218927;s:59:"C:\xampp\htdocs\tp5\application\index\view\public\base.html";i:1534325207;s:61:"C:\xampp\htdocs\tp5\application\index\view\public\header.html";i:1534218633;s:58:"C:\xampp\htdocs\tp5\application\index\view\public\nav.html";i:1534569982;s:60:"C:\xampp\htdocs\tp5\application\index\view\public\right.html";i:1534750757;s:61:"C:\xampp\htdocs\tp5\application\index\view\public\footer.html";i:1534318060;}*/ ?>
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
                
                <!-- 导航 -->
                <nav class="navbar navbar-default">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <a class="navbar-brand" href="<?php echo url('index'); ?>" ><?php echo htmlentities((isset($siteName) && ($siteName !== '')?$siteName:'社区问答')); ?></a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li <?php if(empty(app('request')->param('cate_id')) || ((app('request')->param('cate_id') instanceof \think\Collection || app('request')->param('cate_id') instanceof \think\Paginator ) && app('request')->param('cate_id')->isEmpty())): ?>class="active"<?php endif; ?>><a href="<?php echo url('index/index/index'); ?>">首页 <span class="sr-only">(current)</span></a></li>
                <?php if(is_array($cateList) || $cateList instanceof \think\Collection || $cateList instanceof \think\Paginator): $i = 0; $__LIST__ = $cateList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$cate): $mod = ($i % 2 );++$i;if(1 == $cate->getData('status')): ?>
                <li <?php if($cate['id'] == app('request')->param('cate_id')): ?> class="active" <?php endif; ?>><a href="<?php echo url('index/index', ['cate_id'=>$cate['id']]); ?>"><?php echo htmlentities($cate['name']); ?></a></li>
                <?php endif; endforeach; endif; else: echo "" ;endif; ?>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <form class="navbar-form navbar-left" action="<?php echo url('index/index/index'); ?>" method="post">
                    <div class="form-group">
                        <input type="text" name="search" class="form-control" placeholder="Search">
                    </div>
                    <button type="submit" class="btn btn-default glyphicon glyphicon-search"></button>
                </form>
                <?php if(app('session')->get('user_id')): ?>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                       aria-haspopup="true" aria-expanded="false"><?php echo htmlentities(app('session')->get('user_name')); ?> <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="<?php echo url('index/insert'); ?>">发布文章</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="<?php echo url('admin/index/index'); ?>">控制面板</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="<?php echo url('user/logout'); ?>">Logout</a></li>
                    </ul>
                </li>
                <?php else: ?>
                    <li><a href="<?php echo url('user/register'); ?>">注册</a></li>
                    <li><a href="<?php echo url('user/login'); ?>">登录</a></li>
                <?php endif; ?>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>
                
                <div class="col-md-8">
                    
<div class="page-header">
    <h2><?php echo htmlentities((isset($title) && ($title !== '')?$title:'')); ?></h2>
</div>
<form class="form-horizontal" method="post" id="login" >
    <div class="form-group">
        <label for="inputEmail" class="col-sm-2 control-label">Email</label>
        <div class="col-sm-10">
            <input type="text" name="email" class="form-control" id="inputEmail" placeholder="Email">
        </div>
    </div>
    <div class="form-group">
        <label for="inputPassword3" class="col-sm-2 control-label">Password</label>
        <div class="col-sm-10">
            <input type="password" name="password" class="form-control" id="inputPassword3" placeholder="Password">
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="button" id="action" class="btn btn-default">Login</button>
        </div>
    </div>
</form>
<script>
    $(function () {
        $("#action").on('click',function () {
            // alert($('#register').serialize())
            $.ajax({
                type:'post',
                url:"<?php echo url('loginCheck'); ?>",
                data: $('#login').serialize(),
                dataType:'json',
                success:function (data) {
                    if (data.status == 1){
                        alert(data.message);
                        window.location.href = "<?php echo url('index/index/index'); ?>";
                    } else {
                        alert(data.message);
                        // window.location.href="<?php echo url('register'); ?>";
                    }
                }
            })
        })
    })
</script>

                </div>
                <div class="col-md-4">
                     <div class="page-header">
    <h2>热门文章</h2>
</div>
<div class="list-group">
    <a href="#" class="list-group-item >热门文章</a>
    <?php if(is_array($hotList) || $hotList instanceof \think\Collection || $hotList instanceof \think\Paginator): $i = 0; $__LIST__ = $hotList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$host): $mod = ($i % 2 );++$i;?>
    <a href="<?php echo url('index/detail', ['id' => $host['id']]); ?>" target="_blank" class="list-group-item"><?php echo htmlentities(mb_substr($host['title'],0,25,'utf-8')); ?></a>
    <?php endforeach; endif; else: echo "" ;endif; ?>
</div>

                </div>
            </div>
        </div>
    </div>
    <div style="height: 50px;"></div>

</body>
</html>