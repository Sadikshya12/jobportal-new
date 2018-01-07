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
            <th>Status</th>
            <th width="5%">Actions</th>
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
                        <?php if ($job->status == 'pending'): ?>
                            <span class="label label-warning">Pending</span>
                        <?php elseif ($job->status == 'cancelled'): ?>
                            <span class="label label-danger">Cancelled</span>
                            <br><strong>Reason:</strong>
                            <?= $job->cancel_reason ?>
                        <?php elseif ($job->status == 'accepted'): ?>
                            <span class="label label-green">Accepted</span>
                        <?php elseif ($job->status == 'rejected'): ?>
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
                                    <a href="/job/details/<?= $job->id ?>">View Details</a>
                                </li>
                                <li>
                                    <a href="/job/cancel/<?= $job->id ?>">Cancel Application</a>
                                </li>
                                <li>
                                    <a href="/user/review/<?= $job->user_id ?>">Review Job Poster</a>
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