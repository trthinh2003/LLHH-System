<?php
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

// Nhận dữ liệu từ request
$data = json_decode(file_get_contents('php://input'), true);

// Lấy dữ liệu từ đối tượng
$a = $data['MAHOCPHAN'];
$b = $data['HOCKI'];
$c = $data['NAMHOC'];
$d = $data['TENNHOM'];
$e = $data['PHANMEM_ID'];
$f = $data['TUANHOC'];
$k = $data['GIANGVIEN'];
// Chèn dữ liệu vào cơ sở dữ liệu
$sql = "INSERT INTO yeucau (MAHOCPHAN, HOCKI, NAMHOC, TENNHOM, PHANMEM_ID, TUANHOC,GIANGVIEN_ID) 
        VALUES ('$a', '$b', '$c', '$d', '$e', '$f','$k')";


if ($conn->query($sql) === TRUE) {
 
} else {
   echo json_encode(("fail"));
}

// Đóng kết nối
$conn->close();
}
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
    
    // Lấy dữ liệu từ yêu cầu POST
    $data = json_decode(file_get_contents('php://input'), true);
    $giangvien_id = $data['giangvien_id'];
    $hocky = $data['hocky'];
    $namhoc = $data['namhoc'];
    
    // Thực hiện truy vấn
    $sql = "SELECT mahocphan, tennhom FROM lophocphan l JOIN giangvien g ON l.GIANGVIEN_ID = g.GIANGVIEN_ID WHERE g.GIANGVIEN_ID = '$giangvien_id' AND l.HOCKI = '$hocky' AND l.NAMHOC = '$namhoc'";
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
    if($_GET['a']==3){
        layhp();
    }
    else if($_GET['a']==4){
        liu();
    }
    else{
        tai();
    }
?>
