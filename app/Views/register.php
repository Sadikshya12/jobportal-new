<?php $this->render('includes/header') ?>
<div row="class">
    <form id="register" action="index.php?action=user_controller" method="post" >
        <h3>Registration</h3>

        <table align="center" width="30%" border="0">
            <tr>
                <td>First Name: </td>
                <td><input type="text" name="fname" placeholder="First Name" class="required"  /></td>
            </tr>
            <tr>
                <td>Second Name: </td>
                <td><input type="text" name="sname" placeholder="Second Name" class="required"  /></td>
            </tr>
            <tr>
                <td>Username: </td>
                <td><input type="text" name="username" placeholder="User Name" class="required"  /></td>
            </tr>
            <tr>
                <td>Password: </td>
                <td><input type="password" name="password" placeholder="Your Password" class="required"  /></td>
            </tr>
            <tr>
                <td>E-mail: </td>
                <td><input type="email" name="email" placeholder="Your Email" class="required"  /></td>
            </tr>
            <tr>
                <td>Address: </td>
                <td><input type="text" name="address" placeholder="Current Address" class="required"  /></td>
            </tr>
            <tr>
                <td>Country: </td>
                <td><input type="text" name="country" placeholder="Country" class="required"  /></td>
            </tr>
            <tr><td>User Type</td>
                <td>
                <div class="radio">
                  <label><input type="radio" name="user_type" value="Job Seeker"><b>Job Seeker</b></label>
                  <label><input type="radio" name="user_type" value="Job Poster"><b>Job Poster</b></label>
                </div>
                </td>
            </tr>
            
            <tr>
                <td><br><button type="submit" name="register" value="register" >Register</button></td>
            </tr>
            
        </table>
    </form>
</div>

<script>
    $(document).ready(function(){
        $("#register").validate();
    })
</script>
<?php $this->render('includes/footer') ?>