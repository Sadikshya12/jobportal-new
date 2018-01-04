<?php $this->render('includes/header') ?>

    <h1>New Job Post</h1>
    <form action="/job/post_new" method="post">
        <div class="form-group">
            <label>Title</label>
            <input class="form-control" name="title" value="<?= input('title') ?>">
        </div>
        <div class="form-group">
            <label>Description</label>
            <textarea class="form-control" name="description" rows="4"><?= input('description') ?></textarea>
            <script>
            CKEDITOR.replace( 'description' );
        </script>
        </div>
        <div class="form-group">
            <label>Location</label>
            <input class="form-control" name="location" value="<?= input('location') ?>">
        </div>

        <button type="submit" class="btn btn-success">Save</button>
    </form>

<?php $this->render('includes/footer') ?>