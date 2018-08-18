<?php /*a:6:{s:60:"C:\xampp\htdocs\tp5\application\admin\view\article\edit.html";i:1534572283;s:61:"C:\xampp\htdocs\tp5\application\admin\view\public\layout.html";i:1534389138;s:61:"C:\xampp\htdocs\tp5\application\admin\view\public\header.html";i:1534218633;s:58:"C:\xampp\htdocs\tp5\application\admin\view\public\nav.html";i:1534567512;s:59:"C:\xampp\htdocs\tp5\application\admin\view\public\left.html";i:1534411970;s:61:"C:\xampp\htdocs\tp5\application\admin\view\public\footer.html";i:1534318060;}*/ ?>
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
                
<form class="" method="post" id="insert" action="<?php echo url('doEdit'); ?>" enctype="multipart/form-data" >
    <div class="form-group">
        <label for="title" class=" control-label">Title</label>
        <input type="text" name="title" class="form-control" id="title" placeholder="Title" value="<?php echo htmlentities($info->title); ?>" required>
    </div>
    <div class="form-group">
        <label for="cate_id" class=" control-label">Category</label>
        <select name="cate_id" id="cate_id" class="form-control" required>
            <?php if(is_array($cateList) || $cateList instanceof \think\Collection || $cateList instanceof \think\Paginator): $i = 0; $__LIST__ = $cateList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$cate): $mod = ($i % 2 );++$i;?>
            <option value="<?php echo htmlentities($cate['id']); ?>"><?php echo htmlentities($cate['name']); ?></option>
            <?php endforeach; endif; else: echo "" ;endif; ?>
        </select>
    </div>
    <div class="form-group">
        <label for="title_img" class=" control-label">Title Img</label>
        <div class="">
            <img src="/tp5/public/upload/<?php echo htmlentities($info->title_img); ?>" alt="..." class="img-rounded" width="140">
        </div>
            <input type="file" name="title_img" id="title_img" class="" required>
    </div>
    <div class="form-group">
        <label for="synopsis" class="control-label">Synopsis</label>
        <textarea name="synopsis" id="synopsis" cols="30" rows="3" class="form-control"><?php echo htmlentities($info->synopsis); ?></textarea>
    </div>
    <div class="form-group">
        <label for="container" class=" control-label">Content</label>
        <!-- 加载编辑器的容器 -->
        <script id="container" name="content" type="text/plain">
                
                <?php echo $info->content; ?>
            </script>
        <!-- 配置文件 -->
        <script type="text/javascript" src="/tp5/public/static/ueditor/ueditor.config.js"></script>
        <!-- 编辑器源码文件 -->
        <script type="text/javascript" src="/tp5/public/static/ueditor/ueditor.all.min.js"></script>
        <!-- 实例化编辑器 -->
        <script type="text/javascript">
            var ue = UE.getEditor('container');
        </script>
        <!--<textarea class="form-control" name="content" id="content" cols="30" rows="10"></textarea>-->
    </div>
    <div class="form-group">
        <!--<label for="action">Submit</label>-->
        <input type="hidden" name="id" value="<?php echo htmlentities($info->id); ?>">
        <button type="submit" id="action" class="btn btn-default">Submit</button>
    </div>
</form>

            </div>
        </div>
    </div>
</div>
<div style="height: 50px;"></div>
</body>
</html>