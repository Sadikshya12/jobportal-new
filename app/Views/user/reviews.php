<?php $this->render('includes/header') ?>
    <div class="form-group">
        <label>Name</label>
        <p class="form-control-static"><?= $user->first_name . ' ' . $user->second_name ?></p>
    </div>
<h3>Reviews</h3>
<?php display_flash() ?>
<table class="table">
    <thead>
    <tr>
        <th width="5%">#</th>
        <th width="15%">Given By</th>
        <th>Review</th>
    </tr>
    </thead>

    <tbody>
    <?php if($reviews):
    foreach($reviews as $index => $review): ?>
    <tr>
        <td><?= ++$index ?></td>
        <td>
            <?= $review->first_name.' '.$review->second_name ?>
            <br><?= $review->created_at ?>
        </td>
        <td>
            <?= $review->review_text ?>
        </td>
    </tr>
        <?php endforeach; endif; ?>
    </tbody>
</table>

<?php $this->render('includes/footer') ?>