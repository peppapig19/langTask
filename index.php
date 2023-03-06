<?php
session_start();
include('config.php');
require('functions.php');

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_SESSION['colored_string'])) {
        $colored_string = $_SESSION['colored_string'];
        unset($_SESSION['colored_string']);
    } else $colored_string = '';

    $model = $conn->query('SELECT * FROM history')->fetchAll();
    require('index.view.php');
} else {
    $data = json_decode(file_get_contents('php://input'), true);

    if (isset($data['string'])) {
        $string = strip_tags($data['string']);
        $colored_string = color_foreign($string);

        date_default_timezone_set('Europe/Moscow');
        $stmt = $conn->prepare('INSERT INTO history (string, markup, time_checked) VALUES (?, ?, ?)');
        $stmt->execute([$string, $colored_string, date('Y-m-d H:i:s')]);

        $_SESSION['colored_string'] = $colored_string;
    }

    if (isset($data['auto_string'])) {
        $string = strip_tags($data['auto_string']);

        if (foreign_positions($string)) {
            $colored_string = color_foreign($string);

            $data = array('string' => $colored_string);
            echo json_encode($data);
        } else {
            $data = array('string' => $string, 'message' => 'Строка не требует исправлений');
            echo json_encode($data);
        }
    }
}