<?php $this->layout('master', ["title" => $title]) ?>
<?php
echo getFlashMessage('sent_success', 'display:block;font-size:18px;color:green;border:1px solid green; padding:6px 2px');
echo getFlashMessage('sent_error', 'display:block;font-size:18px;color:red;border:1px solid red; padding:6px 2px');
?>
<h2>Contato</h2>
<form action="/contact" method="POST">
    Nome <br>
    <input type="text" name="name"> <br>
    <?php echo getFlashMessage('name', 'display:block;font-size:14px;color:red;'); ?>
    Email <br>
    <input type="text" name="email"> <br>
    <?php echo getFlashMessage('email', 'display:block;font-size:14px;color:red;'); ?>
    Assunto <br>
    <input type="text" name="subject"><br>
    <?php echo getFlashMessage('subject', 'display:block;font-size:14px;color:red;'); ?>
    Mensagem <br>
    <textarea name="message" cols="30" rows="10"></textarea><br>
    <?php echo getFlashMessage('message', 'display:block;font-size:14px;color:red;'); ?>
    <input type="submit" name="submit" value="Enviar"><br>
    <?php echo getCsrf(); ?>
</form>