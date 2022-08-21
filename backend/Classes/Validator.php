<?php
class Validator
{

    public static function sanitize(array $post)
    {
        $filter = array(
            'buyer_email' =>    array(
                'filter' => FILTER_SANITIZE_EMAIL,
                'flags' => FILTER_FLAG_STRIP_HIGH
            ),
            'note' =>    array(
                'filter' => FILTER_SANITIZE_SPECIAL_CHARS,
            ),
            'amount' =>    array(
                'filter' => FILTER_SANITIZE_NUMBER_INT,
                'flags' => FILTER_FLAG_STRIP_HIGH
            ),
            'entry_by' =>    array(
                'filter' => FILTER_SANITIZE_NUMBER_INT,
                'flags' => FILTER_FLAG_STRIP_HIGH
            ),
            'phone' =>    array(
                'filter' => FILTER_SANITIZE_NUMBER_INT,
                'flags' => FILTER_FLAG_STRIP_HIGH
            ),
            'entry_by' =>    array(
                'filter' => FILTER_SANITIZE_NUMBER_INT,
                'flags' => FILTER_FLAG_STRIP_HIGH
            ),
            'buyer' =>    array(
                'filter' => FILTER_SANITIZE_SPECIAL_CHARS,
                'flags' => FILTER_FLAG_STRIP_HIGH
            ),
            'items' =>    array(
                'filter' => FILTER_SANITIZE_SPECIAL_CHARS,
                'flags' => FILTER_FLAG_STRIP_HIGH
            ),
            'city' =>    array(
                'filter' => FILTER_SANITIZE_SPECIAL_CHARS,
                'flags' => FILTER_FLAG_STRIP_HIGH
            ),
            'receipt_id' =>    array(
                'filter' => FILTER_SANITIZE_SPECIAL_CHARS,
                'flags' => FILTER_FLAG_STRIP_HIGH
            ),

        );
        return filter_var_array($post, $filter);
    }
    public static function validate($param)
    {
        $error = [];
        $validData = [];
        $validData['amount'] = filter_var($param['amount'], FILTER_VALIDATE_INT);
        $validData['entry_by'] = filter_var($param['entry_by'], FILTER_VALIDATE_INT);
        $validData['buyer_email'] = filter_var($param['buyer_email'], FILTER_VALIDATE_EMAIL);
        $validData['phone'] = filter_var(
            $param['phone'],
            FILTER_VALIDATE_REGEXP,
            array("options" => array("regexp" => "/^(?:\+?88|0088)?01[13-9]\d{8}$/"))
        );
        $validData['note'] = str_word_count($param['note']) <= 30 ? $param['note'] : "";
        $validData['items'] = strlen($param['items']) <= 20 ? self::text($param['items']) : '';
        $validData['receipt_id'] = strlen($param['receipt_id']) <= 20 ? self::text($param['receipt_id']) : '';
        $validData['buyer'] = count(str_split($param['buyer'])) <= 20 ? self::textSpaceNumber($param['buyer']) : '';
        $validData['city'] = count(str_split($param['city'])) <= 20 ? self::textSpace($param['city']) : '';

        foreach ($validData as $key => $val) {
            if (empty($val)) {
                $error["{$key}"] = '';
            }
        }
        return ($error);
    }
    public static function wordcount($word, $length)
    {
        preg_match_all('/[\S]+[\W]/', $word, $matches);
        if (count($matches) > $length) {
            return false;
        }
        return true;
    }
    public static function textSpace($val)
    {
        return filter_var($val, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^[a-zA-Z\s]*$/")));
    }
    public static function text($val)
    {
        return filter_var($val, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^[a-zA-Z]*$/")));
    }
    public static function textSpaceNumber($val)
    {
        return filter_var($val, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^[a-zA-Z 0-9\s]*$/")));
    }
}
