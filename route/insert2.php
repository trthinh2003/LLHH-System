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
    $sql = "select MAPHONGHOC,count(MAPHONGHOC) as tong from lichthuchanh lt join HOCKI hk on lt.HOCKI=hk.HOCKI and lt.NAMHOC=hk.NAMHOC WHERE hk.NGAYBATDAU = (SELECT max(NGAYBATDAU) FROM hocki) group by (MAPHONGHOC);
    ";
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
    function layhpkk() {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "ql_lich_th";
        $conn = new mysqli($servername, $username, $password, $dbname);
        
        // Kiểm tra kết nối
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        
        $sql = "SELECT COUNT(MAPHONGHOC) AS tong FROM lichthuchanh lt JOIN HOCKI hk ON lt.HOCKI = hk.HOCKI AND lt.NAMHOC = hk.NAMHOC WHERE hk.NGAYBATDAU = (SELECT MAX(NGAYBATDAU) FROM hocki);";
        
        $result = $conn->query($sql);
        
        if ($result) {
            // Lấy dòng dữ liệu đầu tiên từ kết quả
            $row = $result->fetch_assoc();
            
            // Trả về dữ liệu dưới dạng JSON
            echo json_encode($row);
        } else {
            // Trường hợp truy vấn không thành công
            echo json_encode(array("error" => "Truy vấn không thành công"));
        }
        
        // Đóng kết nối
        $conn->close();
    }
    function layhpkkk() {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "ql_lich_th";
        $conn = new mysqli($servername, $username, $password, $dbname);
        
        // Kiểm tra kết nối
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        
        $sql = "select * from HOCKI where NGAYBATDAU =(SELECT MAX(NGAYBATDAU) FROM hocki);";
        
        $result = $conn->query($sql);
        
        if ($result) {
            // Lấy dòng dữ liệu đầu tiên từ kết quả
            $row = $result->fetch_assoc();
            
            // Trả về dữ liệu dưới dạng JSON
            echo json_encode($row);
        } else {
            // Trường hợp truy vấn không thành công
            echo json_encode(array("error" => "Truy vấn không thành công"));
        }
        
        // Đóng kết nối
        $conn->close();
    }
    
    function layhp2(){
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "ql_lich_th";
        $conn = new mysqli($servername, $username, $password, $dbname);
        
        // Kiểm tra kết nối
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $sql = "SELECT g.MAKHOA as khoa, count(g.MAKHOA) as soluong FROM lophocphan l JOIN giangvien g ON l.GIANGVIEN_ID = g.GIANGVIEN_ID JOIN lichthuchanh lt ON lt.MAHOCPHAN = l.MAHOCPHAN JOIN hocki hk ON lt.NAMHOC = hk.NAMHOC AND lt.HOCKI = hk.HOCKI WHERE hk.NGAYBATDAU = (SELECT max(NGAYBATDAU) FROM hocki) GROUP BY g.MAKHOA;
        ";
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
        $sql = "SELECT MONTH(lt.ngayhoc) as thang, COUNT(lt.NGAYHOC) as tong FROM lichthuchanh lt JOIN HOCKI hk ON lt.HOCKI = hk.HOCKI AND lt.NAMHOC = hk.NAMHOC WHERE hk.NGAYBATDAU = (SELECT max(NGAYBATDAU) FROM hocki) AND lt.MAPHONGHOC = '$b' GROUP BY MONTH(lt.ngayhoc);";
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
    
    function tai2(){
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
        
        
        // Chèn dữ liệu vào cơ sở dữ liệu
        $sql = "SELECT MONTH(lt.NGAYHOC) AS thang, COUNT(*) AS tong FROM lichthuchanh lt 
        JOIN ( SELECT MAX(NAMHOC) AS MAX_NAMHOC, MAX(HOCKI) AS MAX_HOCKI FROM lichthuchanh ) AS max_values 
        ON lt.NAMHOC = max_values.MAX_NAMHOC 
        AND lt.HOCKI = max_values.MAX_HOCKI GROUP BY MONTH(lt.NGAYHOC);";
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
            if(isset($_SESSION['ten'])) {
                echo json_encode($_SESSION['ten']) ;
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
    else if($_GET['a']==55){
        layhpkk();
    }
    else if($_GET['a']==555){
        layhpkkk();
    }
    else if($_GET['a']==7){
        xoa();
    }
    else if($_GET['a']==12){
        tai2();
    }
    else if($_GET['a']==33){
        layhp2();
    }
    else{
        tai();
    }

?>
