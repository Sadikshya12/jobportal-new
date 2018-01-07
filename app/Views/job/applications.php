<?php $this->render('includes/header') ?>
    <h1>Job | Applications</h1>
<?php display_flash() ?>
    <table class="table">
        <thead>
        <tr>
            <th width="5%">#</th>
            <th width="15%">Applied Date</th>
            <th>Title</th>
            <th width="15%">Applied By</th>
            <th>Status</th>
            <th width="25%">Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php if ($applications): ?>
            <?php foreach ($applications as $index => $application): ?>
                <tr>
                    <td><?= ++$index ?></td>
                    <td><?= $application->created_at ?></td>
                    <td><?= $application->title ?></td>
                    <td>
                        <a href="/user/reviews/<?= $application->user_id ?>">
                            <?= $application->first_name . ' ' . $application->second_name ?>
                        </a>
                    </td>
                    <td>
                        <?php if ($application->status == 'pending'): ?>
                            <span class="label label-warning">Pending</span>
                        <?php elseif ($application->status == 'cancelled'): ?>
                            <span class="label label-danger">Cancelled</span>
                            <br><strong>Reason:</strong>
                            <?= $application->cancel_reason ?>
                        <?php elseif ($application->status == 'accepted'): ?>
                            <span class="label label-green">Accepted</span>
                        <?php elseif ($application->status == 'rejected'): ?>
                            <span class="label label-danger">Rejected</span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <a href="/user/review/<?= $application->user_id ?>" class="btn btn-danger">Review Job Seeker</a>
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