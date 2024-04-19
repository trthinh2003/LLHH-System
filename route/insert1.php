<?php
function layhp(){
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "ql_lich_th";
    $conn = new mysqli($servername, $username, $password, $dbname);
    
    // Kiểm tra kết nối
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $sql = "select MAPHONGHOC,count(MAPHONGHOC) as tong from lichthuchanh 
    WHERE YEAR(ngayhoc)=YEAR(CURDATE()) 
        and HOCKI=(SELECT MAX(CAST(hocki AS UNSIGNED)) AS max_hocki FROM lichthuchanh)
    group by (MAPHONGHOC)";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $data = array();
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        echo json_encode($data);
    } else {
        echo "0 results";
    }
    
    // Đóng kết nối
    $conn->close();
    }

    //function khác
    function tai(){
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "ql_lich_th";
        
        // Kết nối đến MySQL
        $conn = new mysqli($servername, $username, $password, $dbname);
        
        // Kiểm tra kết nối
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        
        // Lấy dữ liệu từ URL parameters
        $b = $_GET['b'];
        
        // Chèn dữ liệu vào cơ sở dữ liệu
        $sql = "SELECT MONTH(ngayhoc) as thang, COUNT(NGAYHOC) as tong FROM lichthuchanh 
        WHERE MAPHONGHOC='$b' and YEAR(ngayhoc)=YEAR(CURDATE()) 
        and HOCKI=(SELECT MAX(CAST(hocki AS UNSIGNED)) AS max_hocki FROM lichthuchanh) GROUP BY MONTH(ngayhoc);";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $data = array();
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
            echo json_encode($data);
        } else {
            echo "0 results";
        }
        
        // Đóng kết nối
        $conn->close();
    }
    
    function layh(){
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "ql_lich_th";
        $conn = new mysqli($servername, $username, $password, $dbname);
        
        // Kiểm tra kết nối
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        
        // Lấy dữ liệu từ yêu cầu POST
        $data = json_decode(file_get_contents('php://input'), true);
        $giangvien_id = $data['giangvien_id'];
        $b = $_GET['tt'];
        // Thực hiện truy vấn
        $sql = "SELECT MAHOCPHAN, TENNHOM, HOCKI, NAMHOC,TRANGTHAI, GROUP_CONCAT(TUANHOC ORDER BY TUANHOC) AS TUANHOC_LIST 
        FROM yeucau JOIN giangvien ON yeucau.GIANGVIEN_ID = giangvien.GIANGVIEN_ID 
        WHERE CAST(SUBSTRING_INDEX(REPLACE(NAMHOC, ' ', ''), '-', -1) AS UNSIGNED) 
        = (SELECT MAX(CAST(SUBSTRING_INDEX(REPLACE(NAMHOC, ' ', ''), '-', -1) AS UNSIGNED)) AS max_namhoc FROM yeucau) 
        AND yeucau.HOCKI = (SELECT MAX(CAST(yeucau.HOCKI AS UNSIGNED)) FROM yeucau) 
        AND yeucau.GIANGVIEN_ID = '$giangvien_id' 
        AND yeucau.TRANGTHAI = '$b' 
        GROUP BY MAHOCPHAN, TENNHOM, HOCKI, NAMHOC;";
        $result = $conn->query($sql);
        
        // Xử lý kết quả và trả về dưới dạng JSON
        if ($result->num_rows > 0) {
            $data = array();
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
            echo json_encode($data);
        } else {
            echo "0 results";
        }
        
        // Đóng kết nối
        $conn->close();
        }

        function liu(){
            session_start();
            if(isset($_SESSION['TeacherName']) && isset($_SESSION['TeacherID'])) {
                $sessionData = array(
                    'giangvien_id' => $_SESSION['TeacherID'], // Giả sử id là 123
                    'hotengiangvien' => $_SESSION['TeacherName'] // Tên là John
                );
                echo json_encode($sessionData) ;
            }
        }
        function xoa(){
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "ql_lich_th";
        $conn = new mysqli($servername, $username, $password, $dbname);
        
        // Kiểm tra kết nối
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        
        // Lấy dữ liệu từ yêu cầu POST
        $data = json_decode(file_get_contents('php://input'), true);
        // Thực hiện truy vấn
        $sql = "
        DELETE from yeucau where MAHOCPHAN='$data[mhp]' 
        and TENNHOM='$data[nhom]' 
        and HOCKI='$data[hocki]' 
        and NAMHOC='$data[namhoc]' 
        and TUANHOC='$data[tuan]';";
        $result = $conn->query($sql);
        
        $conn->close();
        }

    if($_GET['a']==3){
        layhp();
    }
    else if($_GET['a']==4){
        layh();
    }
    else if($_GET['a']==5){
        liu();
    }
    else if($_GET['a']==7){
        xoa();
    }
    else{
        tai();
    }

?>
