<?php $this->render('includes/header') ?>
<h1>Jobs | Latest</h1>
<table class="table">
	<thead>
	<tr>
		<th>#</th>
		<th>Title</th>
		<th>Posted At</th>
		<th>Actions</th>
	</tr>
</thead>
<tbody>
	<?php foreach($jobs as $index => $job): ?>
	<tr>
		<td><?= ++$index ?></td>
		<td><?= $job->title ?></td>
		<td><?= $job->created_at ?></td>
		<td><a href="/job/jobdescription/<?= $job->id ?>">View Details</a></td>
	</tr>
<?php endforeach; ?>
	</tbody>
</table>
<?php $this->render('includes/footer') ?>