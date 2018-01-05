<?php $this->render('includes/header') ?>

<?php display_flash() ?>

    <h1><?= $job->title ?></h1>
<?= $job->description ?>

    <br>
    <a href="/job/apply/<?= $job->id ?>" class="btn btn-success">Apply this job</a>

<?php $this->render('includes/footer') ?>