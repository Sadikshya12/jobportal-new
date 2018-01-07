<?php $this->render('includes/header') ?>

    <h1>My Account
        <div class="pull-right">

            <?php if ($user->user_type == "Job Poster"): ?>
                <a href="/poster/post_new" class="btn btn-success">Post New Job</a>
                <a href="/poster/posted" class="btn btn-info">View My Posted Jobs</a>
                <a href="/poster/applications" class="btn btn-warning">Received Applications</a>
            <?php endif; ?>

            <?php if ($user->user_type == "Job Seeker"): ?>
                <a href="/seeker/applied" class="btn btn-info">View My Applied Jobs</a>
            <?php endif; ?>

            <a href="/user/edit" class="btn btn-success">Edit Account Details</a>
            <a href="/user/password" class="btn btn-success">Change Password</a>
        </div>
    </h1>
<?php display_flash() ?>
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label>First name</label>
                <p class="form-control-static"><?= $user->first_name ?></p>
            </div>
            <div class="form-group">
                <label>Second name</label>
                <p class="form-control-static"><?= $user->second_name ?></p>
            </div>
            <div class="form-group">
                <label>Username</label>
                <p class="form-control-static"><?= $user->username ?></p>
            </div>
            <div class="form-group">
                <label>Email</label>
                <p class="form-control-static"><?= $user->email ?></p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label>Address</label>
                <p class="form-control-static"><?= $user->address ?></p>
            </div>
            <div class="form-group">
                <label>Country</label>
                <p class="form-control-static"><?= $user->country ?></p>
            </div>
            <div class="form-group">
                <label>User Type</label>
                <p class="form-control-static"><?= $user->user_type ?></p>
            </div>
            <div class="form-group">
                <label>Registered At</label>
                <p class="form-control-static"><?= $user->created_at ?></p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label>Photo</label>
                <?php if ($user->photo): ?>
                    <img src="/uploads/<?= $user->photo ?>" width="100%">
                <?php else: ?>
                    <span class="text-danger">- Photo not uploaded -</span>
                <?php endif; ?>
            </div>

        </div>
    </div>


<?php $this->render('includes/footer') ?>