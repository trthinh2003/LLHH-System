<?php
    ob_start();
    session_start();
    include_once('../model/connectdb.php');
    include_once('../model/catalog.php');
    include_once('../model/getDateByWeekAndDate.php');
    $conn = connect();
    // $thongtinPH = layTTPhongHocXuLyTemp();
    $thongtinBuoiHocTuongUngLHP = layLHPVaBuoiTuongUngTrongTemp();
    // foreach ($thongtinPH as $row) {
        
    // }
    $count = count($thongtinBuoiHocTuongUngLHP);
    for ($i = 0; $i < $count; $i++) {
        $arrLHP = explode(",", $thongtinBuoiHocTuongUngLHP[$i]['LOPHOCPHAN']);
        $arrBuoi = explode(",", $thongtinBuoiHocTuongUngLHP[$i]['BUOI']);
        $mahocphan = "";
        $tennhom = "";
        $hocki = "";
        $namhoc = "";
        $ngayhoc = "";
        $siso = 0;
        $j = 0;
        foreach ($arrLHP as $item1) {
            $arrMHPVaNhom = explode("-", $item1);
            array_push($arrMHPVaNhom, $arrBuoi[1]);
            // $cnt_arrMHPVaNhom = count($arrMHPVaNhom);
            // echo $cnt_arrMHPVaNhom . " ";
            $k = 1;
            $maphonghoc = "";
            $mahocphan = $arrMHPVaNhom[0];
            $tennhom = $arrMHPVaNhom[1];
            $hocki = layHocKiTuLHP($mahocphan, $tennhom);
            $namhoc = layNamHocTuLHP($mahocphan, $tennhom);
            $siso = laySiSoTuLHP($mahocphan, $tennhom);
            $ngayhoc = $arrMHPVaNhom[2];
            $cacPhongHocTuongUng = layRaCacPhongHocThoaManPhanMemVaSiSo($mahocphan, $tennhom, $hocki, $namhoc, $siso);
            if ($cacPhongHocTuongUng == 0) {
                $maphonghoc1 = "P20" . $k;
                $k++;
                $maphonghoc2 = "P20" . $k;
                $conn->query("INSERT INTO LICHTHUCHANH(MAPHONGHOC ,MAHOCPHAN, HOCKI, NAMHOC, TENNHOM, NGAYHOC)
                        VALUES('".$maphonghoc1."', '".$mahocphan."', '".$hocki."', '".$namhoc."', '".$tennhom."', '".$ngayhoc."')");
                $conn->query("INSERT INTO LICHTHUCHANH(MAPHONGHOC ,MAHOCPHAN, HOCKI, NAMHOC, TENNHOM, NGAYHOC)
                        VALUES('".$maphonghoc2."', '".$mahocphan."', '".$hocki."', '".$namhoc."', '".$tennhom."', '".$ngayhoc."')");
            } else {
                $maphonghoc = $cacPhongHocTuongUng[$j]['MAPHONGHOC'];
                $conn->query("INSERT INTO LICHTHUCHANH(MAPHONGHOC ,MAHOCPHAN, HOCKI, NAMHOC, TENNHOM, NGAYHOC)
                        VALUES('".$maphonghoc."', '".$mahocphan."', '".$hocki."', '".$namhoc."', '".$tennhom."', '".$ngayhoc."')");
            }
            // echo $mahocphan . " " . $tennhom . " " . $hocki . " " . $namhoc . " " . $siso . " " . $ngayhoc . " ";
            $j++;
        }
        // foreach ($arrBuoi as $item3) {
        //     echo $item3 . " ";
        // }
    }
    $conn->query("DROP TABLE TEMP");
    $conn->query("DELETE FROM YEUCAU");
    $_SESSION['successApprove'] = "Duyệt thành công!";
    header("Location: ../index.php?pg=requirements_manage");
    $conn->close();
?>