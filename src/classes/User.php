<?php
namespace App;
use \PDO;

class User {

    private $db;
    private $conn;

    public function getUsers() {
        $this->db = Db::getInstance();
        $this->conn = $this->db->getConnection();

        $sql_query = "SELECT * FROM `users` WHERE 1 = 1 ";

        if($_GET) {
            if(array_key_exists('name', $_GET) || array_key_exists('email', $_GET) || array_key_exists('settings', $_GET)) {
                $name = $_GET['name'];
                $email = $_GET['email'];
                $settings = $_GET['settings'];

                if ($_GET && array_key_exists('name', $_GET) && $name) {
                    $sql_query .= " AND name LIKE '%$name%' ";
                }
                if ($_GET && array_key_exists('email', $_GET) && $email) {
                    $sql_query .= " AND email LIKE '%$email%' ";
                }

                $entries = ["likes_beer", "likes_juice", "likes_tea", "likes_coffee", "likes_coke"];

                if ($_GET && $settings) {
                    foreach ($entries as $entry) {
                        if (array_key_exists($entry, $settings)) {
                            $sql_query .= " AND json_contains(`settings`, '{\"$entry\":$settings[$entry]}') ";
                        }
                    }
                }
            }
        }

        $stmt = $this->conn->prepare($sql_query);
        $stmt->execute();

        $result = array();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            array_push($result, $row);
        }

        header('Content-Type: application/json');
        echo json_encode($result);

    }

}
