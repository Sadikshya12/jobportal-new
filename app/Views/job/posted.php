<?php $this->render('includes/header') ?>
    <h1>Jobs | Posted
        <div class="pull-right">
            <a href="/poster/post_new" class="btn btn-success">Post New Job</a>
        </div>
    </h1>
<?php display_flash() ?>
    <table class="table">
        <thead>
        <tr>
            <th width="5%">#</th>
            <th>Title</th>
            <th width="15%">Posted At</th>
            <th width="5%">Actions</th>
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
                                    <a href="/poster/edit_job/<?= $job->id ?>">Edit</a>
                                </li>
                                <li>
                                    <a href="/poster/delete/<?= $job->id ?>"
                                       onclick="return confirm('Confirm delete?')">Delete</a>
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