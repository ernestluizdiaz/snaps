<?php
require_once 'core/dbConfig.php'; // Include your database connection

// Get the search query if set
$search = isset($_GET['search']) ? $_GET['search'] : '';

// Modify the query to filter by student name or course name
$query = "SELECT * FROM collage_records WHERE student_name LIKE :search OR course_name LIKE :search";
$stmt = $pdo->prepare($query);

// Bind the search parameter with wildcard for LIKE search
$stmt->execute(['search' => "%" . $search . "%"]);
$records = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Collage Records</title>
  <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css" rel="stylesheet" />
</head>

<body>
  <?php include 'navbar.php'; ?>

  <div class="container mx-auto py-6 px-4">
    <h1 class="text-3xl font-bold mb-6 text-gray-900">Collage Grade Records</h1>

    <div class="overflow-x-auto bg-white rounded-lg shadow-lg">
      <table class="w-full bg-white border-collapse border border-gray-300">
        <thead class="bg-gray-100">
          <tr>
            <th class="py-3 px-6 border-b text-left text-sm font-medium text-gray-700">Record ID</th>
            <th class="py-3 px-6 border-b text-left text-sm font-medium text-gray-700">Student ID</th>
            <th class="py-3 px-6 border-b text-left text-sm font-medium text-gray-700">Student Name</th>
            <th class="py-3 px-6 border-b text-left text-sm font-medium text-gray-700">Course Name</th>
            <th class="py-3 px-6 border-b text-left text-sm font-medium text-gray-700">Date of Enrollment</th>
            <th class="py-3 px-6 border-b text-left text-sm font-medium text-gray-700">Grade</th>
            <th class="py-3 px-6 border-b text-left text-sm font-medium text-gray-700">Status</th>
            <th class="py-3 px-6 border-b text-left text-sm font-medium text-gray-700">Created At</th>
            <th class="py-3 px-6 border-b text-left text-sm font-medium text-gray-700">Updated At</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($records as $record): ?>
            <tr class="hover:bg-gray-50">
              <td class="py-3 px-6 border-b text-sm text-gray-800"><?php echo $record['record_id']; ?></td>
              <td class="py-3 px-6 border-b text-sm text-gray-800"><?php echo $record['student_id']; ?></td>
              <td class="py-3 px-6 border-b text-sm text-gray-800">
                <?php echo htmlspecialchars($record['student_name']); ?>
              </td>
              <td class="py-3 px-6 border-b text-sm text-gray-800"><?php echo htmlspecialchars($record['course_name']); ?>
              </td>
              <td class="py-3 px-6 border-b text-sm text-gray-800"><?php echo $record['date_of_enrollment']; ?></td>
              <td class="py-3 px-6 border-b text-sm text-gray-800"><?php echo $record['grade']; ?></td>
              <td class="py-3 px-6 border-b text-sm text-gray-800"><?php echo $record['status']; ?></td>
              <td class="py-3 px-6 border-b text-sm text-gray-800"><?php echo $record['created_at']; ?></td>
              <td class="py-3 px-6 border-b text-sm text-gray-800"><?php echo $record['updated_at']; ?></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
</body>

</html>