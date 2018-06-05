<?php
return '<div class="rs-sidebars">
    <div class="rs-sidebar">
        <div class="rs-sidebar-title">
            关于我
        </div>
        <div class="rs-sidebar-content">
            ' . rsConfig::$config['AboutMe'] . '
        </div>
    </div>
    <div class="rs-sidebar">
        <div class="rs-sidebar-title">
            推荐站点
        </div>
        <div class="rs-sidebar-content">
            ' . rsConfig::$config['Friends'] . '
        </div>
    </div>
</div>';