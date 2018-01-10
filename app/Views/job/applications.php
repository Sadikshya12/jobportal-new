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
            <th width="5%">Actions</th>
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
                        <a href="/index/user/<?= $application->user_id ?>">
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
                            <span class="label label-success">Accepted</span>
                        <?php elseif ($application->status == 'rejected'): ?>
                            <span class="label label-danger">Rejected</span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <div class="dropdown">
                            <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                Actions
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu1">
                                <li>
                                    <a href="/poster/accept_application/<?= $application->id ?>">Accept Application</a>
                                </li>
                                <li>
                                    <a href="/poster/reject_application/<?= $application->id ?>">Reject Application</a>
                                </li>
                                <li>
                                    <a href="/user/review/<?= $application->user_id ?>">Review Job Seeker</a>
                                </li>
                            </ul>
                        </div>
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