<?php $this->render('includes/header') ?>
    <h3>Details</h3>
<?php display_flash() ?>

    <form action="/user/review/<?= $jobPoster->id ?>" method="post">
        <div class="form-group">
            <label>Name</label>
            <p class="form-control-static"><?= $jobPoster->first_name . ' ' . $jobPoster->second_name ?></p>
        </div>
        <div class="form-group">
            <label>Review Text</label>
            <textarea class="form-control"
                      name="review_text"></textarea>
        </div>

        <button type="submit" class="btn btn-success">Save</button>
    </form>
<?php $this->render('includes/footer') ?>