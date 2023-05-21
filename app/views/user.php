<?php $this->layout('master', ['title' => $title]) ?>

<h1>User</h1>

<form action="/user/update/1533" method="POST">
    First Name <br>
    <input type="text" name="firstName"  value="Wemerson"><br>
    Last Name <br>
    <input type="text" name="lastName"  value="Moura"><br>
    Email  <br>
    <input type="text" name="email"  value="wm@gmail.com"><br>
    Password <br>
    <input type="text" name="password" value="123" ><br>

    <input type="submit" name="submit" value="Atualizar">

</form>