<?php $this->render('includes/header') ?>

    <h1>My Account <span>Edit</span></h1>
    <?php display_flash() ?>

    <form action="/user/edit" method="post" enctype="multipart/form-data">
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label>First name</label>
                    <input class="form-control"
                           name="first_name"
                           value="<?= $user->first_name ?>">
                </div>
                <div class="form-group">
                    <label>Second name</label>
                    <input class="form-control"
                           name="second_name"
                           value="<?= $user->second_name ?>">
                </div>
                <div class="form-group">
                    <label>Username</label>
                    <input class="form-control"
                           name="username"
                           value="<?= $user->username ?>">
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input class="form-control"
                           name="email"
                           value="<?= $user->email ?>">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Address</label>
                    <input class="form-control"
                           name="address"
                           value="<?= $user->address ?>">
                </div>
                <div class="form-group">
                    <label>Country</label>
                    <input class="form-control"
                           name="country"
                           value="<?= $user->country ?>">
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
                    <input type="file" name="photo">
                    <?php if ($user->photo): ?>
                        <img src="/uploads/<?= $user->photo ?>" width="100%">
                    <?php else: ?>
                        <span class="text-danger">- Photo not uploaded -</span>
                    <?php endif; ?>
                </div>

            </div>
        </div>
        <button class="btn btn-success">Save</button>
    </form>

<?php $this->render('includes/footer') ?>