<?php

/* @var $this yii\web\View */

use yii\helpers\Url;

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="body-content">

        <div class="row">
            <div class="col-lg-4">
                <h2>Projects</h2>

                <p><a class="btn btn-default" href="<?= Url::to('admin/projects')?>"><i class="fa fa-sitemap" aria-hidden="true"></i> All projects</a></p>
            </div>
            <div class="col-lg-4">
                <h2>Tasks</h2>

                <p><a class="btn btn-default" href="<?= Url::to('admin/tasks')?>"><i class="fa fa-tasks" aria-hidden="true"></i> All tasks</a></p>
            </div>
            <div class="col-lg-4">
                <h2>Statuses</h2>

                <p><a class="btn btn-default" href="<?= Url::to('admin/statuses')?>"><i class="fa fa-flag" aria-hidden="true"></i> All task statuses</a></p>
            </div>
        </div>

    </div>
</div>
