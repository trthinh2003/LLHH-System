<?php
    ob_start();
    session_start();
    include_once('../model/connectdb.php');
    include_once('../model/catalog.php');
    include_once('../model/getDateByWeekAndDate.php');
    include_once('../model/getWeekAndDateByDate.php');
    $conn = connect();
    $thongtinBuoiHocTuongUngLHP = layLHPVaBuoiTuongUngTrongTemp();
    $demYCDuocDuyet = 0;
    $demYCChuaDuyet = 0;
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
            $maphonghoc = "";
            $mahocphan = $arrMHPVaNhom[0];
            $tennhom = $arrMHPVaNhom[1];
            $hocki = layHocKiTuLHP($mahocphan, $tennhom);
            $namhoc = layNamHocTuLHP($mahocphan, $tennhom);
            $siso = laySiSoTuLHP($mahocphan, $tennhom);
            $ngayhoc = $arrMHPVaNhom[2];
            $ngaybatdau = layNgayBatDauCuaHK_NH($hocki, $namhoc);
            $tuanVaThu = getWeekAndDayByDate($ngaybatdau, $ngayhoc);
            $id_yeucau = layIDYeuCauTuLHPKemTuanVaHK_NHTuongUng($mahocphan, $tennhom, $hocki, $namhoc, $tuanVaThu['week']);
            $cacPhongHocTuongUng = layRaCacPhongHocThoaManPhanMemVaSiSo($mahocphan, $tennhom, $hocki, $namhoc, $siso);
            $soPHTuongUng = count($cacPhongHocTuongUng);
            if ($j > $soPHTuongUng - 1) {
                $demYCChuaDuyet++;
                //Đánh dấu trạng thái = "chưa duyệt" cho yêu cầu
                $conn->query("UPDATE YEUCAU SET TRANGTHAI = 'Chưa duyệt' WHERE YEUCAU_ID LIKE '".$id_yeucau."'");
            }
            else {
                if ($cacPhongHocTuongUng == 0) {
                    if ($siso > 50) {
                        $cacPhongHocTuongUng = layRaCacPhongHocThoaManPhanMemVaSiSo($mahocphan, $tennhom, $hocki, $namhoc, 40);
                        $maphonghoc = $cacPhongHocTuongUng[$j]['MAPHONGHOC'];
                        $conn->query("INSERT IGNORE INTO LICHTHUCHANH(MAPHONGHOC, MAHOCPHAN, HOCKI, NAMHOC, TENNHOM, NGAYHOC)
                                      VALUES('".$maphonghoc."', '".$mahocphan."', '".$hocki."', '".$namhoc."', '".$tennhom."', '".$ngayhoc."')");
                        $j++;
                        $demYCDuocDuyet++;
                        $maphonghoc = $cacPhongHocTuongUng[$j]['MAPHONGHOC'];
                        $conn->query("INSERT IGNORE INTO LICHTHUCHANH(MAPHONGHOC, MAHOCPHAN, HOCKI, NAMHOC, TENNHOM, NGAYHOC)
                                      VALUES('".$maphonghoc."', '".$mahocphan."', '".$hocki."', '".$namhoc."', '".$tennhom."', '".$ngayhoc."')");
                        $j++;
                        $demYCDuocDuyet++;
                        $conn->query("UPDATE YEUCAU SET TRANGTHAI = 'Đã duyệt' WHERE YEUCAU_ID LIKE '".$id_yeucau."'");
                    }    
                } else {
                    $maphonghoc = $cacPhongHocTuongUng[$j]['MAPHONGHOC'];
                    $conn->query("INSERT IGNORE INTO LICHTHUCHANH(MAPHONGHOC, MAHOCPHAN, HOCKI, NAMHOC, TENNHOM, NGAYHOC)
                                  VALUES('".$maphonghoc."', '".$mahocphan."', '".$hocki."', '".$namhoc."', '".$tennhom."', '".$ngayhoc."')");
                    $j++;
                    $demYCDuocDuyet++;
                    $conn->query("UPDATE YEUCAU SET TRANGTHAI = 'Đã duyệt' WHERE YEUCAU_ID LIKE '".$id_yeucau."'");
                }
            }
        }
    }
    $conn->query("DROP TABLE TEMP");
    $conn->query("DELETE FROM YEUCAU WHERE TRANGTHAI LIKE 'Đã duyệt'");
    $_SESSION['successApprove'] = "Duyệt thành công!";
    $_SESSION['analysisApprove'] = $demYCDuocDuyet . ' yêu cầu đã duyệt, ' . $demYCChuaDuyet . ' yêu cầu chưa duyệt';
    header("Location: ../index.php?pg=requirements_manage");
    $conn->close();
?>