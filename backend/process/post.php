<?php
require_once "../config.php";

$db = new Database();

if ('POST' === $_SERVER['REQUEST_METHOD']) {

    if (isset($_POST) && $_POST['submit'] == 'save') {
        $result = [];
        $result['error'] = Validator::validate($_POST);
        if (count($result['error']) > 0) {
            echo json_encode($result, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
            exit;
        } else {
            $sanizedData = Validator::sanitize($_POST);
            $result['saved'] = $db->insert($sanizedData);
        }
        echo json_encode($result, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        exit;
    }


    if (isset($_POST) && $_POST['submit'] == 'update') {
        
        $result = [];
        $result['error'] = Validator::validate($_POST);
        if (count($result['error']) > 0) {
            echo json_encode($result, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
            exit;
        } else {
            $id =  filter_input(INPUT_POST, $_POST['id'], FILTER_VALIDATE_INT);
            $id = $_POST['id'];
            $sanizedData = Validator::sanitize($_POST);
            $result['saved'] = $db->update($sanizedData, $id);
        }
        echo json_encode($result, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        exit;
    }
}
