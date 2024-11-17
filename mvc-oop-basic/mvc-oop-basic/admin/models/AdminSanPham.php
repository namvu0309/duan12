
<?php
class AdminSanPham
{
    public $conn;
    public function __construct()
    {
        $this->conn = connectDB();
    }
    public function getAllSanPham()
    {
        try {
            $sql = 'SELECT san_phams.*, danh_mucs.ten_danh_muc
                FROM san_phams
                INNER JOIN danh_mucs ON san_phams.danh_muc_id = danh_mucs.id';

            $stmt = $this->conn->prepare($sql);
            $stmt->execute();

            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo 'lỗi: ' . $e->getMessage();
        }
    }
    public function insertSanPham($ten_san_pham, $gia_san_pham, $gia_khuyen_mai, $so_luong, $ngay_nhap, $danh_muc_id, $trang_thai, $mo_ta, $hinh_anh)
    {
        try {
            // Chuẩn bị câu lệnh SQL với các placeholders cho dữ liệu
            $sql = 'INSERT INTO san_phams (ten_san_pham, gia_san_pham, gia_khuyen_mai, so_luong, ngay_nhap, danh_muc_id, trang_thai, mo_ta, hinh_anh)
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

    public function insertAlbumAnhSanPham($san_pham_id, $link_hinh_anh)
    {
        try {
            // Chuẩn bị câu lệnh SQL với các placeholders cho dữ liệu
            $sql = 'INSERT INTO hinh_anh_san_phams (san_pham_id,link_hinh_anh)
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

    public function getDetailSanPham($id)
    {
        try {
            $sql = 'SELECT san_phams.*, danh_mucs.ten_danh_muc FROM san_phams
                INNER JOIN danh_mucs ON san_phams.danh_muc_id = danh_mucs.id
                WHERE san_phams.id = :id';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(['id' => $id]);
            return $stmt->fetch();
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
        }
    }

    public function getListAnhSanPham($id)
    {
        try {
            $sql = 'SELECT *from  hinh_anh_san_phams WHERE san_pham_id = :id';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                ':id' => $id
            ]);
            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
        }
    }

    public function updateSanPham($san_pham_id,$ten_san_pham, $gia_san_pham, $gia_khuyen_mai, $so_luong, $ngay_nhap, $danh_muc_id, $trang_thai, $mo_ta, $hinh_anh)
    {
        try {
            // Chuẩn bị câu lệnh SQL với các placeholders cho dữ liệu
            $sql = 'UPDATE san_phams 
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

    public function getBinhLuanFromKhachHang($id)
    {
        try {
            $sql = "SELECT binh_luans.*, san_phams.ten_san_pham FROM binh_luans
            INNER JOIN san_phams ON binh_luans.san_pham_id = san_phams.id
            WHERE binh_luans.tai_khoan_id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([':id' => $id]);

            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
        }
    }
    public function getDetailAnhSanPham($id)
    {
        try {
            $sql = 'SELECT *from hinh_anh_san_phams WHERE id = :id';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                ':id' => $id
            ]);
            return $stmt->fetch();
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
        }
    }

    public function updateAnhSanPham($id, $new_file)
    {
        try {
            // Chuẩn bị câu lệnh SQL với các placeholders cho dữ liệu
            $sql = 'UPDATE hinh_anh_san_phams
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
    public function destroyAnhSanPham($id)
    {
        try {
            $sql = 'DELETE FROM hinh_anh_san_phams WHERE id = :id';
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

    

    public function destroySanPham($id)
    {
        try {
            $sql = 'DELETE FROM san_phams WHERE id = :id';
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
