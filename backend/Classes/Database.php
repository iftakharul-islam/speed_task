<?php
class Database
{
    private $host = "127.0.0.1";
    private $port = "3306";
    private $dbname = "xspeed_task";
    private $user = "root";
    private $password = "";
    private $conn;




    public function __construct()
    {
        try {
            $this->conn = new PDO("mysql:host=$this->host;port=$this->port;dbname=$this->dbname", $this->user, $this->password, array(
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
            ));
        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }
    }


    public function insert($params)
    {
        extract($params);
        try {
          
            $stmt =  $this->conn->beginTransaction();
            $sql = "INSERT INTO `simple_table`(`amount`, `buyer`, `receipt_id`, `items`, `buyer_email`, `buyer_ip`, `note`, `city`, `phone`, `entry_at`, `entry_by`) VALUES 
            ('{$amount}','{$buyer}','{$receipt_id}','{$items}','{$buyer_email}','{$this->get_client_ip()}','{$note}','{$city}','{$phone}','".date('Y-m-d')."','{$entry_by}')";

            $stmt = $this->conn->prepare($sql);
            $stmt->execute();

            return $this->conn->commit();
        } catch (PDOException $e) {
            $this->conn->rollBack();

            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }
    }
    public function update($params,$id)
    {
        extract($params);
        try {
          
            $stmt =  $this->conn->beginTransaction();
            $sql = "UPDATE `simple_table` SET `amount` = '{$amount}',
                                            `buyer` ='{$buyer}',
                                            `receipt_id` = '{$receipt_id}',
                                            `items` = '{$items}',
                                            `buyer_email` ='{$buyer_email}',
                                            `buyer_ip` = '{$this->get_client_ip()}',
                                            `note` = '{$note}',
                                            `city` ='{$city}',
                                            `phone` = '{$phone}',
                                            `entry_by` = '{$entry_by}' WHERE id = {$id}";
                                        

            $stmt = $this->conn->prepare($sql);
            $stmt->execute();

            return $this->conn->commit();
        } catch (PDOException $e) {
            $this->conn->rollBack();

            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }
    }
    public function delete($id)
    {
        
        try {
          
            $stmt =  $this->conn->beginTransaction();
            $sql = "DELETE FROM `simple_table` WHERE id = {$id}";

            $stmt = $this->conn->prepare($sql);
            $stmt->execute();

            return $this->conn->commit();
        } catch (PDOException $e) {
            $this->conn->rollBack();

            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }
    }

    public function select($value = '', $field='')
    {
        $condition ="";
        $condition = $value != '' ? "WHERE $field = '{$value}'":'';
        if( $field == "id"){
            $condition = $value != '' ? "WHERE st.id = {$value}":'';
        }
        if( $field == "entry_by"){
            $condition = $value != '' ? "WHERE u.username LIKE '%{$value}%'":'';
        }

       

        $stmt = $this->conn->query('SELECT st.id as stid, st.amount, st.buyer, st.receipt_id, st.items, st.buyer_email, st.buyer_ip, st.note, st.city, st.phone, st.entry_at, DATE_FORMAT(entry_at, "%W, %d %M %Y") as entry_at, st.entry_by, u.username, u.id as user_id 
        FROM `simple_table` as st 
        INNER JOIN users as u
        ON st.entry_by = u.id '.$condition." order by st.id desc");
        return  json_encode($stmt->fetchAll(), JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    }
    public function paginatedResult($id = '', $field='')
    {
        $page_number = 1;
        $resultPerPage = 3;
        $offset = ($page_number - 1) * $resultPerPage;
        if(isset($_POST['page_number'])){
            $page_number = $_POST['page_number'];
        }
        

        $condition ="";
        if( $field == "entry_by"){
            $condition = $id != '' ? "WHERE entry_by = {$id}":'';
        }

        if( $field == "id"){
            $condition = $id != '' ? "WHERE st.id = {$id}":'';
        }

        $stmt = $this->conn->query('SELECT st.id as stid, st.amount, st.buyer, st.receipt_id, st.items, st.buyer_email, st.buyer_ip, st.note, st.city, st.phone, st.entry_at, DATE_FORMAT(entry_at, "%W, %d %M %Y") as entry_at, st.entry_by, u.username, u.id as user_id 
        FROM `simple_table` as st 
        INNER JOIN users as u
        ON st.entry_by = u.id '.$condition." order by st.id desc LIMIT $offset, $page_number ");
        return  json_encode($stmt->fetchAll(), JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    }

    public function selectUsers()
    {

        $stmt = $this->conn->query('SELECT * FROM users');
        return  json_encode($stmt->fetchAll(), JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    }
    private function get_client_ip()
    {
        $ipaddress = '';
        if (getenv('HTTP_CLIENT_IP'))
            $ipaddress = getenv('HTTP_CLIENT_IP');
        else if (getenv('HTTP_X_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
        else if (getenv('HTTP_X_FORWARDED'))
            $ipaddress = getenv('HTTP_X_FORWARDED');
        else if (getenv('HTTP_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_FORWARDED_FOR');
        else if (getenv('HTTP_FORWARDED'))
            $ipaddress = getenv('HTTP_FORWARDED');
        else if (getenv('REMOTE_ADDR'))
            $ipaddress = getenv('REMOTE_ADDR');
        else
            $ipaddress = 'UNKNOWN';
        return $ipaddress;
    }

    function __destruct()
    {
        $this->conn = null;
    }
}
