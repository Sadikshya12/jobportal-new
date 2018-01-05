<?php $this->render('includes/header') ?>
    <h1>Jobs | Applied</h1>
    <?php display_flash() ?>
    <table class="table">
        <thead>
        <tr>
            <th width="5%">#</th>
            <th width="15%">Applied Date</th>
            <th>Title</th>
            <th width="15%">Posted By</th>
            <th width="25%">Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php if ($jobs): ?>
            <?php foreach ($jobs as $index => $job): ?>
                <tr>
                    <td><?= ++$index ?></td>
                    <td><?= $job->a_created_at ?></td>
                    <td><?= $job->title ?></td>
                    <td>
                        <a href="/user/reviews/<?= $job->user_id ?>">
                            <?= $job->first_name . ' ' . $job->second_name ?>
                        </a>
                    </td>
                    <td>
                        <a href="/job/details/<?= $job->id ?>" class="btn btn-success">View Details</a>
                        <a href="/user/review/<?= $job->user_id ?>" class="btn btn-danger">Review Job Poster</a>
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