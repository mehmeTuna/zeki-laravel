<?php

namespace Confirmation\Order\detail;

session_start();

require __DIR__ . '/../../database/connect.php';
require __DIR__ . "/../../private/Authority.php";

use Authority;
use DATABASE\Database;
use PDO;
use PDOException;

if (!isset($_SESSION["operator"])) {
    header("location: calisan");
    exit;
}

if ($_SESSION['operator']['authority'] == Authority::disabled) {
    echo json_encode(['status' => 'Yetkisiz İşlem!']);
    exit;
}

$details = new Database();

        $tip = strip_tags(trim($_GET['id']));

$waiting = "SELECT * from order_items where order_id = '{$tip}'  ORDER BY m_date ASC";
$kuryeData = "select firstname ,lastname  from kurye where id=(select kurye_id from kurye_takip where order_id='{$tip}')";
$order_wait = [];

try {
    $kuryeName = $details->conn->query($kuryeData, PDO::FETCH_ASSOC);

    if ($kuryeName->rowCount()) {
        foreach ($kuryeName as $val) {
            $kuryeName = $val["firstname"] . " " . $val["lastname"];
        }

    } else {
        $kuryeName = "Kuryeye Verilmedi";
    }

} catch (PDOException $e) {
    $kuryeName = "Kuryeye Verilmedi";
}

try {
    $orderQuery = $details->conn->query($waiting, PDO::FETCH_ASSOC);

    if ($orderQuery->rowCount()) {
        foreach ($orderQuery as $value) {

            $waiting = "SELECT * from users where id = '" . $value["user_id"] . "'";
            try {
                $UserQuery = $details->conn->query($waiting, PDO::FETCH_ASSOC);

                if ($UserQuery->rowCount()) {
                    foreach ($UserQuery as $user) {
                        $order_wait= array(
                            "orderType" => $value["order_status"],
                            "order_id" => $value["order_id"],
                            "username" => $user["firstname"] . " " . $user["lastname"],
                            "tutar" => $value["order_amount"],
                            "date" => date('H:i', $value["m_date"]),
                            "orders" => json_decode($value["orders"]),
                            "adres" => isset($user[$value["adress"]]) ? json_decode($user[$value["adress"]]) : json_decode($user["adress"]),
                            "phone" => $user["phone"],
                            "first_order" => $user["first_order"],
                            "kurye" => $kuryeName,
                            'content' => $value['icerik']
                        );
                    }
                }

            } catch (PDOException $e) {
                echo json_encode("denied", JSON_UNESCAPED_UNICODE);
                exit;
            }
        }

        echo json_encode($order_wait, JSON_UNESCAPED_UNICODE);
        exit;
    }
} catch (PDOException $e) {
    echo json_encode("denied", JSON_UNESCAPED_UNICODE);
    exit;
}