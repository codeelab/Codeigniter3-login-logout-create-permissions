<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Admin</h1>
                <?php var_dump($_SESSION['permissions']) ?>
                <?= var_dump($_SESSION['permissions'][0]['admin']) ?>
            </div> <!-- END col-lg-12 -->
        </div> <!-- END row -->
    </div> <!-- END container-fluid -->
</div> <!-- END page-wrapper -->