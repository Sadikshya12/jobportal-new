<?php $this->render('includes/header') ?>

    <h1>Cancel Application</h1>
    <form action="/seeker/cancel/<?= $job->id ?>" method="post">
        <div class="form-group">
            <label>Title</label>
            <p class="form-control-static"><?= $job->title ?></p>
        </div>
        <div class="form-group">
            <label>Cancel Reason</label>
            <textarea class="form-control" name="cancel_reason" rows="4"></textarea>
        </div>
        <button type="submit" class="btn btn-success">Confirm Cancel</button>
    </form>

<?php $this->render('includes/footer') ?>