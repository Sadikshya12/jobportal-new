<?php $this->render('includes/header') ?>
    <div row="class">
        <form id="register" action="/index/register" method="post">
            <h3>Registration</h3>
            <?php display_flash() ?>
            <table align="center" width="30%" border="0">
                <tr>
                    <td>First Name:</td>
                    <td><input type="text" placeholder="First Name" class="required"
                               name="fname"
                               value="<?= input('fname') ?>"></td>
                </tr>
                <tr>
                    <td>Second Name:</td>
                    <td><input type="text" placeholder="Second Name" class="required"
                               name="sname"
                               value="<?= input('sname') ?>"></td>
                </tr>
                <tr>
                    <td>Username:</td>
                    <td><input type="text" name="username" placeholder="User Name" class="required"
                               value="<?= input('username') ?>"></td>
                </tr>
                <tr>
                    <td>Password:</td>
                    <td><input type="password" name="password" placeholder="Your Password" class="required"
                               value="<?= input('password') ?>"></td>
                </tr>
                <tr>
                    <td>E-mail:</td>
                    <td><input type="email" name="email" placeholder="Your Email" class="required"
                               value="<?= input('email') ?>"></td>
                </tr>
                <tr>
                    <td>Address:</td>
                    <td><input type="text" name="address" placeholder="Current Address" class="required"
                               value="<?= input('address') ?>"></td>
                </tr>
                <tr>
                    <td>Country:</td>
                    <td><input type="text" name="country" placeholder="Country" class="required"
                               value="<?= input('country') ?>"></td>
                </tr>
                <tr>
                    <td>User Type</td>
                    <td>
                        <div class="radio">
                            <label><input type="radio" name="user_type" value="Job Seeker"
                                    <?= input('user_type') == 'Job Seeker' ? 'checked' : '' ?> required><b>Job
                                    Seeker</b></label>
                            <label><input type="radio" name="user_type" value="Job Poster"
                                    <?= input('user_type') == 'Job Poster' ? 'checked' : '' ?>><b>Job Poster</b></label>
                        </div>
                    </td>
                </tr>

                <tr>
                    <td><br>
                        <button type="submit" name="register" value="register">Register</button>
                    </td>
                </tr>

            </table>
        </form>
    </div>

    <script>
        $(document).ready(function () {
            $("#register").validate();
        })
    </script>
<?php $this->render('includes/footer') ?>