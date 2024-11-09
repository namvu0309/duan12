<?php
class AdminDanhMuc
{
     public $conn;
     public function __construct()
     {
          $this->conn = connectDB();
     }
     public function getAllDanhMuc()
     {
          try {
               $sql = 'SELECT *FROM danh_mucs';
               $stmt = $this->conn->prepare($sql);
               $stmt->execute();
               return $stmt->fetchAll();
          } catch (Exception $e) {
               echo 'loi' . $e->getMessage();
          }
     }
     public function insertDanhMuc($ten_danh_muc, $mo_ta)
     {
          try {
               // Prepare SQL query with placeholders for data binding
               $sql = 'INSERT INTO danh_mucs (ten_danh_muc, mo_ta) VALUES (:ten_danh_muc, :mo_ta)';
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
     public function getDetailDanhMuc($id)
     {
          try {
               $sql = 'SELECT * FROM danh_mucs WHERE id = :id';
               $stmt = $this->conn->prepare($sql);
               $stmt->execute([
                    ':id' => $id
               ]);
               return $stmt->fetch();
          } catch (Exception $e) {
               echo "Lỗi: " . $e->getMessage();
          }
     }

     public function updateDanhMuc($id, $ten_danh_muc, $mo_ta)
     {
          try {
               $sql = "UPDATE danh_mucs SET ten_danh_muc = :ten_danh_muc, mo_ta = :mo_ta WHERE id = :id";
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
     public function destroyDanhMuc($id)
     {
          try {
               $sql = 'DELETE FROM danh_mucs WHERE id = :id';
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