<?php 
    use app\Controllers\MailController;
    require_once('app/Views/header.php');
?>

<section class="contact">
    <h1>Skontaktuj się z nami!</h1>

    <a href="mailto: pracowniapizzysobiekursk@gmail.com">pracowniapizzysobiekursk@gmail.com</a>
    <p class="phone">+48 213 123 123</p>

    <form method="POST" class='contactForm'>
        <input type="text" placeholder="Imię i nazwisko*" name="name">
        <input type="email" placeholder="E-mail*" name="email">
        <textarea name="content"></textarea>
        <input type="submit" name="sendMail" value="Wyślij">
    </form>
</section>

<?php
    if(isset($_POST['sendMail'])) {

        //Fatal error: Uncaught Error: Class 'app\Controllers\MailController' not found in D:\xampp\htdocs\PracowniaPizzy\app\Views\contact.php:23 Stack trace: #0 D:\xampp\htdocs\PracowniaPizzy\app\Controllers\Route.php(17): include_once() #1 D:\xampp\htdocs\PracowniaPizzy\index.php(6): app\Controllers\Route::loadView() #2 {main} thrown in D:\xampp\htdocs\PracowniaPizzy\app\Views\contact.php on line 23
        $mail = new MailController;
        $mail->sendMail($_POST['name'], $_POST['email'], $_POST['content']);
    }
?>

<?php require_once('app/Views/footer.php'); ?>