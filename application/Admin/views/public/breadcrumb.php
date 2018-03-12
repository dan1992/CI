<div class="breadcrumbs" id="breadcrumbs">
    <script type="text/javascript">
        try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
    </script>

    <ul class="breadcrumb">
        <li>
            <i class="icon-home home-icon"></i>
            <a href="<?php echo site_url();?>">首页</a>
        </li>
        <?php if ($breadcrumb && is_array($breadcrumb)) {
                    foreach ($breadcrumb as $key => $value) {
                        if ($value['url'] == $url) {
                            echo '<li class="active">'.$value['name'].'</li>';
                        } else {
        ?>
        <li>
            <a href="<?php if (strpos($value['url'], 'index') !== false) {echo site_url(str_replace('index', 'lists', $value['url']));} else {echo site_url($value['url']);} ?>">
                <?php echo $value['name'];?>
            </a>
        </li>
        <?php
                        }
                    }
                } else {
                    echo '<li class="active">控制台</li>';
                }
        ?>
    </ul><!-- .breadcrumb -->

    <div class="nav-search" id="nav-search">
        <form class="form-search">
            <span class="input-icon">
                <input type="text" placeholder="Search ..." class="nav-search-input" id="nav-search-input" autocomplete="off" />
                <i class="icon-search nav-search-icon"></i>
            </span>
        </form>
    </div><!-- #nav-search -->
</div>
