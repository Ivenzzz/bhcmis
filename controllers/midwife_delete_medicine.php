<?php
require '../partials/global_db_config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   if (isset($_POST['medicine_id'])) {
      $medicineId = $_POST['medicine_id'];

      // Update the 'isArchived' value to 1 (mark as archived)
      $sql = "UPDATE medicines SET isArchived = 1 WHERE medicine_id = ?";
      $stmt = $conn->prepare($sql);
      $stmt->bind_param("i", $medicineId);

      if ($stmt->execute()) {
         // Success
         echo json_encode(['status' => 'success']);
      } else {
         // Error
         echo json_encode(['status' => 'error']);
      }
      $stmt->close();
   }
}
?>
