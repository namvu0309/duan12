
<?php
class AdminDonHang
{
    public $conn;
    public function __construct()
    {
        $this->conn = connectDB();
    }
    public function getAllDonHang()
    {
        try {
            $sql = 'SELECT don_hangs.*, trang_thai_don_hangs.ten_trang_thai
                FROM don_hangs
                INNER JOIN trang_thai_don_hangs ON don_hangs.trang_thai_id =trang_thai_don_hangs.id';

            $stmt = $this->conn->prepare($sql);
            $stmt->execute();

            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo 'lỗi: ' . $e->getMessage();
        }
    }
    public function insertDonHang($ten_san_pham, $gia_san_pham, $gia_khuyen_mai, $so_luong, $ngay_nhap, $danh_muc_id, $trang_thai, $mo_ta, $hinh_anh)
    {
        try {
            // Chuẩn bị câu lệnh SQL với các placeholders cho dữ liệu
            $sql = 'INSERT INTO trang_thais (ten_san_pham, gia_san_pham, gia_khuyen_mai, so_luong, ngay_nhap, danh_muc_id, trang_thai, mo_ta, hinh_anh)
                VALUES (:ten_san_pham, :gia_san_pham, :gia_khuyen_mai, :so_luong, :ngay_nhap, :danh_muc_id, :trang_thai, :mo_ta, :hinh_anh)';

            // Chuẩn bị statement
            $stmt = $this->conn->prepare($sql);

            // Thực thi statement với các giá trị đã bind
            $stmt->execute([
                ':ten_san_pham' => $ten_san_pham,
                ':gia_san_pham' => $gia_san_pham,
                ':gia_khuyen_mai' => $gia_khuyen_mai,
                ':so_luong' => $so_luong,
                ':ngay_nhap' => $ngay_nhap,
                ':danh_muc_id' => $danh_muc_id,
                ':trang_thai' => $trang_thai,
                ':mo_ta' => $mo_ta,
                ':hinh_anh' => $hinh_anh,
            ]);

            // Trả về true nếu thêm thành công
            return $this->conn->lastInsertId();
        } catch (Exception $e) {
            // Hiển thị thông báo lỗi nếu có lỗi xảy ra
            echo 'Lỗi: ' . $e->getMessage();
            return false;
        }
    }

    public function insertAlbumAnhDonHang($san_pham_id, $link_hinh_anh)
    {
        try {
            // Chuẩn bị câu lệnh SQL với các placeholders cho dữ liệu
            $sql = 'INSERT INTO hinh_anh_trang_thais (san_pham_id,link_hinh_anh)
                VALUES (:san_pham_id, :link_hinh_anh)';

            // Chuẩn bị statement
            $stmt = $this->conn->prepare($sql);

            // Thực thi statement với các giá trị đã bind
            $stmt->execute([
                ':san_pham_id' => $san_pham_id,
                ':link_hinh_anh' => $link_hinh_anh
            ]);

            // Trả về true nếu thêm thành công
            return true;
        } catch (Exception $e) {
            // Hiển thị thông báo lỗi nếu có lỗi xảy ra
            echo 'Lỗi: ' . $e->getMessage();
            return false;
        }
    }

    public function getDetailDonHang($id)
    {
        try {
            $sql = 'SELECT trang_thais.*, danh_mucs.ten_danh_muc FROM trang_thais
                INNER JOIN danh_mucs ON trang_thais.danh_muc_id = danh_mucs.id
                WHERE trang_thais.id = :id';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(['id' => $id]);
            return $stmt->fetch();
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
        }
    }

    public function getListAnhDonHang($id)
    {
        try {
            $sql = 'SELECT *from  hinh_anh_trang_thais WHERE san_pham_id = :id';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                ':id' => $id
            ]);
            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
        }
    }

    public function updateDonHang($san_pham_id, $ten_san_pham, $gia_san_pham, $gia_khuyen_mai, $so_luong, $ngay_nhap, $danh_muc_id, $trang_thai, $mo_ta, $hinh_anh)
    {
        try {
            // Chuẩn bị câu lệnh SQL với các placeholders cho dữ liệu
            $sql = 'UPDATE trang_thais 
        SET ten_san_pham = :ten_san_pham, 
            gia_san_pham = :gia_san_pham, 
            gia_khuyen_mai = :gia_khuyen_mai, 
            so_luong = :so_luong, 
            ngay_nhap = :ngay_nhap, 
            danh_muc_id = :danh_muc_id, 
            trang_thai = :trang_thai, 
            mo_ta = :mo_ta, 
            hinh_anh = :hinh_anh 
        WHERE id = :id';
            // Chuẩn bị statement
            $stmt = $this->conn->prepare($sql);

            // Thực thi statement với các giá trị đã bind
            $stmt->execute([
                ':ten_san_pham' => $ten_san_pham,
                ':gia_san_pham' => $gia_san_pham,
                ':gia_khuyen_mai' => $gia_khuyen_mai,
                ':so_luong' => $so_luong,
                ':ngay_nhap' => $ngay_nhap,
                ':danh_muc_id' => $danh_muc_id,
                ':trang_thai' => $trang_thai,
                ':mo_ta' => $mo_ta,
                ':hinh_anh' => $hinh_anh,
                ':id' => $san_pham_id
            ]);

            // Trả về true nếu thêm thành công
            return true;
        } catch (Exception $e) {
            // Hiển thị thông báo lỗi nếu có lỗi xảy ra
            echo 'Lỗi: ' . $e->getMessage();
            return false;
        }
    }


    public function getDetailAnhDonHang($id)
    {
        try {
            $sql = 'SELECT *from hinh_anh_trang_thais WHERE id = :id';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                ':id' => $id
            ]);
            return $stmt->fetch();
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
        }
    }

    public function updateAnhDonHang($id, $new_file)
    {
        try {
            // Chuẩn bị câu lệnh SQL với các placeholders cho dữ liệu
            $sql = 'UPDATE hinh_anh_trang_thais
        SET link_hinh_anh=:new_file
        WHERE id = :id';
            // Chuẩn bị statement
            $stmt = $this->conn->prepare($sql);

            // Thực thi statement với các giá trị đã bind
            $stmt->execute([
                ':new_file' => $new_file,
                ':id' => $id,

            ]);

            // Trả về true nếu thêm thành công
            return true;
        } catch (Exception $e) {
            // Hiển thị thông báo lỗi nếu có lỗi xảy ra
            echo 'Lỗi: ' . $e->getMessage();
            return false;
        }
    }
    public function destroyAnhDonHang($id)
    {
        try {
            $sql = 'DELETE FROM hinh_anh_trang_thais WHERE id = :id';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([':id' => $id]);

            // Return true if a row was deleted, false otherwise
            return $stmt->rowCount() > 0;
        } catch (Exception $e) {
            // Log the error instead of displaying it
            error_log("Error deleting image with ID $id: " . $e->getMessage());
            return false;
        }
    }



    public function destroyDonHang($id)
    {
        try {
            $sql = 'DELETE FROM trang_thais WHERE id = :id';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                ':id' => $id
            ]);
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
        }
        return true;
    }
}
