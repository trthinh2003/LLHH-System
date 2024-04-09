<?php
    function connectdb(){
        $servername = "localhost";
        $username = "root";
        $password = "";

        try {
            $conn = new PDO("mysql:host=$servername;dbname=ql_lich_th", $username, $password);
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //echo "Kết nối thành công!";
        } catch(PDOException $e) {
            //echo "Connection failed: " . $e->getMessage();
        }
        return $conn;
    }

    function connect() {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "ql_lich_th";
    
        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
    
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        return $conn;
    }

    function get_all($sql) {
        $conn = connectdb();
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $arrproduct = $stmt->fetchAll();
        $conn = null;
        return $arrproduct;
    }

    function get_one($sql) {
        $conn = connectdb();
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $arrproduct = $stmt->fetch();
        $conn = null;
        return $arrproduct;
    }
?>