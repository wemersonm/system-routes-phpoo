<?php $this->layout('master', ['title' => $title]) ?>

<h1>User</h1>

<form action="/user/update" method="POST">
    First Name <br>
    <input type="text" name="firstName"  value="Wemerson"><br>
    Last Name <br>
    <input type="text" name="lastName"  value="Moura"><br>
    Email  <br>
    <input type="text" name="email"  value="wm@gmail.com"><br>
    Gender  <br>
    <select name="gender">
        <option value="">Select</option>
        <option value="Male" selected>Male</option>
        <option value="Female">Female</option>
    </select> <br>
    City <br>
    <input type="text" name="city"  value="Goiania"><br>
    Password <br>
    <input type="text" name="password" value="123" ><br>
    <?php echo getCsrf();?>
    <input type="submit" name="submit" value="Atualizar">

</form>