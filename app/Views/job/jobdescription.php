<?php $this->render('includes/header') ?>

<h1>Job Descripton</h1>

<p><b>Title: </b><?= $job->title ?></p>
<?= $job->description ?>

<?php $this->render('includes/footer') ?>