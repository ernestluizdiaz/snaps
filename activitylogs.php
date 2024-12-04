<?php
require_once 'core/dbConfig.php';

$userId = $_SESSION['user_id'] ?? null;

if (!$userId) {
  header("Location: login.php");
  exit();
}

// Fetch activity logs from the database
$query = "SELECT al.log_id, u.username, al.action, al.record_id, al.action_date 
          FROM activity_log al
          JOIN user u ON al.user_id = u.user_id
          ORDER BY al.action_date DESC";
$stmt = $pdo->prepare($query);
$stmt->execute();

$logs = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Activity Log</title>
  <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css" rel="stylesheet" />
</head>

<body>
  <?php include 'navbar.php' ?>
  <div class="container mx-auto py-6 px-4">
    <h1 class="text-3xl font-bold mb-6 text-gray-900">Activity Logs</h1>
    <div class="overflow-x-auto bg-white rounded-lg shadow-lg">
      <table class="w-full bg-white border-collapse border border-gray-300">
        <thead class="bg-gray-100">
          <tr>
            <th class="py-3 px-6 border-b text-left text-sm font-medium text-gray-700">Log ID</th>
            <th class="py-3 px-6 border-b text-left text-sm font-medium text-gray-700">Username</th>
            <th class="py-3 px-6 border-b text-left text-sm font-medium text-gray-700">Action</th>
            <th class="py-3 px-6 border-b text-left text-sm font-medium text-gray-700">Record ID</th>
            <th class="py-3 px-6 border-b text-left text-sm font-medium text-gray-700">Action Date</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($logs as $log): ?>
            <tr class="hover:bg-gray-50">
              <td class="py-3 px-6 border-b text-sm text-gray-800"><?php echo $log['log_id']; ?></td>
              <td class="py-3 px-6 border-b text-sm text-gray-800"><?php echo htmlspecialchars($log['username']); ?></td>
              <td class="py-3 px-6 border-b text-sm text-gray-800"><?php echo htmlspecialchars($log['action']); ?></td>
              <td class="py-3 px-6 border-b text-sm text-gray-800"><?php echo $log['record_id']; ?></td>
              <td class="py-3 px-6 border-b text-sm text-gray-800"><?php echo $log['action_date']; ?></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
</body>

</html>