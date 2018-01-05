<?php $this->render('includes/header') ?>
<table class="table table-hover" style="margin-top: 30px">
    <thead>
    <tr>
        <th>S.No</th>
        <th>Job Role/Type</th>
        <th>Location</th>
        <th width=10%></th>
    </tr>
    </thead>
    <tbody>
    <?php if($jobs): ?>
        <?php foreach($jobs as $index => $job): ?>
            <tr>
                <td><?= ++$index ?></td>
                <td>
                    <a href="/job/details/<?= $job->id ?>">
                        <?= $job->title ?>
                    </a>
                </td>
                <td><?= $job->location ?></td>
                <td>
                    <a href="/job/details/<?= $job->id ?>" class="btn btn-success">View Details</a>
                </td>
            </tr>
        <?php endforeach; ?>
    <?php endif; ?>
    </tbody>
</table>
<?php $this->render('includes/footer') ?>