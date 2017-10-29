<?php
namespace App;

require('../../vendor/autoload.php');

use tebazil\dbseeder\Seeder;
use \stdClass;

class Seed {

    public function seed()
    {
        $db = Db::getInstance();
        $pdo = $db->getConnection();

        $seeder = new Seeder($pdo);

        $settings = new stdClass();
        $settings->likes_beer = false;
        $settings->likes_juice = false;
        $settings->likes_tea = false;
        $settings->likes_coffee = false;
        $settings->likes_coke = false;

        $data = [
                [1, 'Jane', 'jane@jane.eu', $settings],
                [2, 'Peter', 'peter@gmail.com', $settings],
                [3, 'Ivan', 'ivan@ivan.com', $settings],
                [4, 'Petar', 'petar@mail.com', $settings],
                [5, 'Tom', 'tom@tom.eu', $settings],
                [6, 'Georgi', 'georgi@gmail.com', $settings],
                [7, 'Hristo', 'hristo@hristo.eu', $settings],
                [8, 'Konstantin', 'konstantin@gmail.com', $settings],
                [9, 'Dimitar', 'dimitar@gmail.com', $settings],
                [10, 'Elena', 'elena@gmail.com', $settings]
        ];
        $columnConfig = ['id', 'name', 'email', 'settings'];

        for ($i = 0; $i < count($data); $i++) {
            $data[$i][3]->likes_beer = (bool)random_int(0, 1);
            $data[$i][3]->likes_juice = (bool)random_int(0, 1);
            $data[$i][3]->likes_tea = (bool)random_int(0, 1);
            $data[$i][3]->likes_coffee = (bool)random_int(0, 1);
            $data[$i][3]->likes_coke = (bool)random_int(0, 1);
            $data[$i][3] = json_encode($data[$i][3]);
        }

        $seeder->table('users')->data($data, $columnConfig)->rowQuantity(10);
        $seeder->refill();
    }
}

$seed = new Seed();
$seed->seed();

