<?php

require 'path/to/vendor/autoload.php';
\Stripe\Stripe::setApiKey("your test secret key");

$token = filter_input(INPUT_POST, 'stripeToken');
try {
    if(!is_string($token)){
        throw new Exception('文字列以外のトークンが指定されました');
    }
    $charge = \Stripe\Charge::create(array(
        "amount" => 51,
        "currency" => "jpy",
        "source" => $token,
        "description" => "sample01の課金処理"
    ));
} catch(\Stripe\Error\Card $e) {
    echo "ERORR:" . $e->getMessage();
    exit;
}
header("Content-type: text/html; charset=utf-8");
echo "決済が完了しました<br>";
echo "ID:" . $charge->id . "<br>";

?>
