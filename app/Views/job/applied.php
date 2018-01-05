<?php $this->render('includes/header') ?>
    <h1>Jobs | Applied</h1>
    <?php display_flash() ?>
    <table class="table">
        <thead>
        <tr>
            <th width="5%">#</th>
            <th>Title</th>
            <th width="15%">Posted At</th>
            <th width="25%">Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php if ($jobs): ?>
            <?php foreach ($jobs as $index => $job): ?>
                <tr>
                    <td><?= ++$index ?></td>
                    <td><?= $job->title ?></td>
                    <td><?= $job->created_at ?></td>
                    <td>
                        <a href="/job/details/<?= $job->id ?>" class="btn btn-success">View Details</a>
                        <a href="/user/rate/<?= $job->user_id ?>" class="btn btn-danger">Rate Job Poster</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="4">No data</td>
            </tr>
        <?php endif; ?>
        </tbody>
    </table>
<?php $this->render('includes/footer') ?>