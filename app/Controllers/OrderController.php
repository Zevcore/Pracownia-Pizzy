<?php

namespace app\Controllers;
use app\Models\Order;
use app\Models\Menu;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class OrderController extends Order{
    public function setOrderData($data){
        if(sizeof($data) != 7) return;
    
        $data['orders'] = serialize($data['orders']);
        if(!$this->setOrder($data)){
            echo "Coś poszło nie tak.";
            return;
        }
        else {
            $_SESSION['order_redirect'] = true;
            header("Location: ".Route::homePage()."/status");
        }
    }

    public function getLastOrders(){
        $orders = $this->getNewestOrders();
        $menu = new Menu;
        if(!$orders) return;

        for($i = 0; $i < sizeof($orders); $i++){
            $orders[$i]['menu_ids'] = unserialize($orders[$i]['menu_ids']);

            for($j = 0; $j < sizeof($orders[$i]['menu_ids']); $j++){
                $orders[$i]['menu_ids'][$j] = $menu->getItemName($orders[$i]['menu_ids'][$j]);
            }
        }

        echo json_encode($orders);
    }

    public function getAllUnfinished(){
        $orders = $this->getUnfinishedOrders();
        $menu = new Menu;
        if(!$orders){
            echo "Brak zamówień do zrobienia.";
            return;
        }

        for($i = 0; $i < sizeof($orders); $i++){
            $orders[$i]['menu_ids'] = unserialize($orders[$i]['menu_ids']);
            $orders[$i]['menu_items'] = "";

            for($j = 0; $j < sizeof($orders[$i]['menu_ids']); $j++){
                $orders[$i]['menu_ids'][$j] = $menu->getItemName($orders[$i]['menu_ids'][$j]);
                $orders[$i]['menu_items'] .= "<li>{$orders[$i]['menu_ids'][$j]}</li>,";
            }
        }

        foreach($orders as $order){
            echo "<section class='order'>
                <ul class='pizza'>
                    {$order['menu_items']}
                </ul>
                <b class='price'>{$order['price']}PLN</b>
                <p class='address'>{$order['address']}</p>
                <p class='address'>{$order['phone']}</p>
                <div class='payment'>{$order['payment']}</div>
                <form method='POST' class='form{$order['id']}'>
                    <input type='submit' name='orderFinished' value='Ukończono'>
                    <input type='hidden' name='orderId' value='{$order['id']}'>
                </form>
            </section>";
        }
    }

    public function finishOrder($id){
        if(!isset($id)) return;

        $this->setOrderFinished($id);
    }

    public function acceptOrder($id){

        $order = $this->getOrder($id);
        foreach($order as $row) {
            $address = $row['address'];
            $phone = $row['phone'];
            $email = $row['email'];
            $payment = $row['payment'];
            $price = $row['price'];
        }

        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->charSet = "UTF-8";
        //$mail->SMTPDebug = SMTP::DEBUG_SERVER;
        $mail->Host = 'smtp.gmail.com';
        $mail->Port = 587;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->SMTPAuth = true;
        $mail->Username = 'pracowniapizzysobiekursk@gmail.com';
        $mail->Password = 'pracowniapizzy123';

        $mail->setFrom('pracowniapizzysobiekursk@gmail.com', 'Pracownia Pizzy');
        $mail->isHTML(true);
        $mail->addAddress('kontakt.zevstudio@gmail.com', '');
        $mail->Subject = 'Twoje zamówienie z Pracownia Pizzy!';
        $mail->Body    = 'Twoje zamówienie na adres'. $address . ' <b style="color:lime;">zostało zaakceptowane</b>!<br>
        Wybrana metoda płatności to: ' . $payment . ' <br>
        Numer kontaktowy: ' . $phone . '<br> 
        Kwota do zapłaty: ' . $price .' PLN <br> 
        Jeżeli, któreś z powyższych danych są nieprawidłowe, prosimy o kontakt na numer telefonu: xxx-xxx-xxx';
        

        if( $mail->send()) {
            echo "Zamówienie przyjęte!";
        }
        else {
            echo $mail->ErrorInfo;
        }

        if(!isset($id) || !isset($_SESSION['logged_in'])) return;

        $this->setAcceptOrder($id, $_SESSION['logged_in']);
    }

    public function declineOrder($id, $reason){
        if(!isset($id) || !isset($_SESSION['logged_in'])) return;
        
        $order = $this->getOrder($id);
        foreach($order as $row) {
            $email = $row['email'];
        }

        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->charSet = "UTF-8";
        //$mail->SMTPDebug = SMTP::DEBUG_SERVER;
        $mail->Host = 'smtp.gmail.com';
        $mail->Port = 587;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->SMTPAuth = true;
        $mail->Username = 'pracowniapizzysobiekursk@gmail.com';
        $mail->Password = 'pracowniapizzy123';

        $mail->setFrom('pracowniapizzysobiekursk@gmail.com', 'Pracownia Pizzy');
        $mail->isHTML(true);
        $mail->addAddress('kontakt.zevstudio@gmail.com', '');
        $mail->Subject = 'Twoje zamówienie z Pracownia Pizzy!';
        $mail->Body    = 'Twoje zamówienie <b style="color: red">zostało odrzucone!</b> <br> 
        Powód: ' . $reason . '<br> 
        Jeżeli nie jesteś usatysfakcjonowany/-a, prosimy o kontakt na numer telefonu: xxx-xxx-xxx';
        

        if( $mail->send()) {
            echo "Wysłano wiadomość!";
        }
        else {
            echo $mail->ErrorInfo;
        }

        $this->removeOrder($id);
    }
}