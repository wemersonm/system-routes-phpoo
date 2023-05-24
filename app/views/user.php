<?php $this->layout('master', ['title' => $title]) ?>

<h1>User</h1>

<form action="/user/update" method="POST">
    First Name <br>
    <input type="text" name="firstName"  value="Wemerson"><br>
    <?php echo getFlashMessage("firstName","color:red;font-size:14px;display:block;"); ?>
    Last Name <br>
    <input type="text" name="lastName"  value="Moura"><br>
    <?php echo getFlashMessage("lastName","color:red;font-size:14px;display:block;"); ?>
    Email  <br>
    <input type="text" name="email"  value="wm@gmail.com"><br>
    <?php echo getFlashMessage("email","color:red;font-size:14px;display:block;"); ?>
    Gender  <br>
    <select name="gender">
        <option value="">Select</option>
        <option value="Male" selected>Male</option>
        <option value="Female">Female</option>
    </select> <br>
    <?php echo getFlashMessage("gender","color:red;font-size:14px;display:block;"); ?>
    City <br>
    <input type="text" name="city"  value="Goiania"><br>
    <?php echo getFlashMessage("city","color:red;font-size:14px;display:block;"); ?>
    Password <br>
    <input type="text" name="password" value="123" ><br>
    <?php echo getFlashMessage("password","color:red;font-size:14px;display:block;"); ?>
    <input type="submit" name="submit" value="Atualizar">
    <?php echo getCsrf();?>
</form>