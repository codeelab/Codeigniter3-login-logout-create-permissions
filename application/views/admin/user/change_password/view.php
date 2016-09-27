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
                    <h1>Change Password</h1>
		</div>
		<?= form_open() ?>
                    <div class="form-group">
			<label for="password">Current password</label>
			<input type="password" class="form-control" id="password" name="password" placeholder="Enter your password">
                    </div><br>
                    <div class="form-group">
			<label for="password">New password</label>
			<input type="password" class="form-control" id="new_password" name="new_password" placeholder="Enter a password">
			<p class="help-block">At least 6 characters</p>
                    </div>
                    <div class="form-group">
			<label for="password_confirm">Confirm password</label>
			<input type="password" class="form-control" id="new_password_confirm" name="new_password_confirm" placeholder="Confirm the password">
			<p class="help-block">Must match your password</p>
                    </div>
                    <div class="form-group">
			<input type="submit" class="btn btn-default" value="Change">
                    </div>
		</form>
            </div> <!-- END col-lg-12 -->
        </div> <!-- END row -->
    </div> <!-- END container-fluid -->
</div> <!-- END page-wrapper -->