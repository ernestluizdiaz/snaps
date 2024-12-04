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
  <div class="container mx-auto py-6">
    <h1 class="text-2xl font-semibold mb-4">Activity Log</h1>
    <table class="min-w-full bg-white border border-gray-300">
      <thead>
        <tr>
          <th class="py-2 px-4 border-b">Log ID</th>
          <th class="py-2 px-4 border-b">Username</th>
          <th class="py-2 px-4 border-b">Action</th>
          <th class="py-2 px-4 border-b">Record ID</th>
          <th class="py-2 px-4 border-b">Action Date</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($logs as $log): ?>
          <tr>
            <td class="py-2 px-4 border-b"><?php echo $log['log_id']; ?></td>
            <td class="py-2 px-4 border-b"><?php echo htmlspecialchars($log['username']); ?></td>
            <td class="py-2 px-4 border-b"><?php echo htmlspecialchars($log['action']); ?></td>
            <td class="py-2 px-4 border-b"><?php echo $log['record_id']; ?></td>
            <td class="py-2 px-4 border-b"><?php echo $log['action_date']; ?></td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</body>

</html>