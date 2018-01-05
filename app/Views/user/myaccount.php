<?php $this->render('includes/header') ?>

    <h1>My Account

        <?php if ($user->user_type == "Job Poster"): ?>
            <div class="pull-right">
                <a href="/job/post_new" class="btn btn-success">Post New Job</a>
                <a href="/job/posted" class="btn btn-info">View My Posted Jobs</a>
            </div>
        <?php endif; ?>

    </h1>
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

<?php $this->render('includes/footer') ?>