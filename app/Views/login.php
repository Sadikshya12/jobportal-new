<?php $this->render('includes/header') ?>
<div class="row">
    <div class="col-md-4 col-md-offset-4">
       <fieldset>
        <legend>User Login</legend>
           <?php display_flash() ?>
        <form id="login" action="/index/login" method="post">
            <form>
                Username: <input type="text" name="username" />
                <br><br>
                Password: <input type="password" name="password" />
                <br><br>
                <input type="submit" name="login" value="Login" />
            </form>
        </form>
    </fieldset>
</div>
</div>
<?php $this->render('includes/footer') ?>