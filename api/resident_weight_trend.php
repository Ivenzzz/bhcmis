<?php

require '../partials/global_db_config.php';

// Retrieve weight trend
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['resident_id'])) {
        $resident_id = intval($_GET['resident_id']);

        $query = "
            SELECT 
                weight_kg, 
                created_at
            FROM 
                consultations
            WHERE 
                resident_id = ? 
                AND weight_kg IS NOT NULL
            ORDER BY 
                created_at ASC;
        ";

        $stmt = $conn->prepare($query);
        if ($stmt) {
            $stmt->bind_param("i", $resident_id);
            $stmt->execute();
            $result = $stmt->get_result();

            $data = [];
            while ($row = $result->fetch_assoc()) {
                // Format created_at to "December 12, 2015"
                $formattedDate = (new DateTime($row['created_at']))->format('F j, Y');
                $data[] = [
                    'weight_kg' => $row['weight_kg'],
                    'created_at' => $formattedDate
                ];
            }

            $stmt->close();

            if (!empty($data)) {
                echo json_encode(["status" => "success", "data" => $data]);
            } else {
                echo json_encode(["status" => "success", "data" => [], "message" => "No weight data found for the given resident."]);
            }
        } else {
            echo json_encode(["status" => "error", "message" => "Failed to prepare the SQL statement."]);
        }
    } else {
        echo json_encode(["status" => "error", "message" => "Missing required parameter: resident_id"]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "Invalid request method. Use GET."]);
}

$conn->close();
?>
