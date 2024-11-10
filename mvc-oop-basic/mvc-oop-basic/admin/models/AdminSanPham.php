
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
    public function insertSanPham($ten_danh_muc, $mo_ta)
    {
        try {
            // Prepare SQL query with placeholders for data binding
            $sql = 'INSERT INTO san_phams (ten_danh_muc, mo_ta) VALUES (:ten_danh_muc, :mo_ta)';
            $stmt = $this->conn->prepare($sql);

            // Execute the statement with bound values
            $stmt->execute([
                ':ten_danh_muc' => $ten_danh_muc,
                ':mo_ta' => $mo_ta
            ]);

            // Return true if insertion is successful
            return true;
        } catch (Exception $e) {
            // Display error message if any exception occurs
            echo 'Lỗi: ' . $e->getMessage();
            return false;
        }
    }
    public function getDetailSanPham($id)
    {
        try {
            $sql = 'SELECT * FROM san_phams WHERE id = :id';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                ':id' => $id
            ]);
            return $stmt->fetch();
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
        }
    }

    public function updateSanPham($id, $ten_danh_muc, $mo_ta)
    {
        try {
            $sql = "UPDATE san_phams SET ten_danh_muc = :ten_danh_muc, mo_ta = :mo_ta WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                ':ten_danh_muc' => $ten_danh_muc,
                ':mo_ta' => $mo_ta,
                ':id' => $id
            ]);
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
        }
        return true;
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
