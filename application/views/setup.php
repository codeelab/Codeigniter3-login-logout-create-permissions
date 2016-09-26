<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <?php if (validation_errors()) : ?>
                <div class="col-md-12">
                    <div class="alert alert-danger" role="alert">
                        <?= validation_errors() ?>
                    </div>
                </div>
            <?php endif; ?>
            <?php if (isset($error)) : ?>
                <div class="col-md-12">
                    <div class="alert alert-danger" role="alert">
                        <?= $error ?>
                    </div>
                </div>
            <?php endif; ?>
            <div class="col-lg-12">
                <div class="page-header">
                    <h1>Create local admin</h1>
		</div>
		<?= form_open() ?>
                    <div class="form-group">
			<label for="username">Username</label>
                        <input type="text" class="form-control" id="username" name="username" placeholder="Enter a username" value="admin" readonly>
                        <input type="text" class="form-control" id="first_name" name="first_name" placeholder="Enter a username" value="Admin" readonly style="display: none;">
                        <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Enter a username" value="User" readonly style="display: none;">
                    </div>
                    <div class="form-group">
			<label for="email">Email</label>
			<input type="email" class="form-control" id="email" name="email" placeholder="Enter your email">
			<p class="help-block">A valid email address</p>
                    </div>
                    <div class="form-group">
			<label for="password">Password</label>
			<input type="password" class="form-control" id="password" name="password" placeholder="Enter a password">
			<p class="help-block">At least 6 characters</p>
                    </div>
                    <div class="form-group">
			<label for="password_confirm">Confirm password</label>
			<input type="password" class="form-control" id="password_confirm" name="password_confirm" placeholder="Confirm your password">
			<p class="help-block">Must match your password</p>
                    </div>
                    <div class="form-group">
			<input type="submit" class="btn btn-default" value="Register">
                    </div>
		</form>
            </div> <!-- END col-lg-12 -->
        </div> <!-- END row -->
    </div> <!-- END container-fluid -->
</div> <!-- END page-wrapper -->