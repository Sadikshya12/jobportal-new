<?php $this->render('includes/header') ?>

    <h1>My Account <span>Change Password</span></h1>
    <?php display_flash() ?>

    <form action="/user/password" method="post">
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label>Old Password</label>
                    <input class="form-control" type="password"
                           name="old_password">
                </div>
                <div class="form-group">
                    <label>New Password</label>
                    <input class="form-control" type="password"
                           name="new_password">
                </div>
                <div class="form-group">
                    <label>Confirm New Password</label>
                    <input class="form-control" type="password"
                           name="new_password_confirmation">
                </div>
                <button class="btn btn-success">Save</button>
            </div>
        </div>
    </form>

<?php $this->render('includes/footer') ?>