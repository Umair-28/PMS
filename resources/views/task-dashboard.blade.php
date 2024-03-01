<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin Dashboard</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<style>
  body {
    font-family: Arial, sans-serif;
    background-color: #f3f3f3;
    margin: 0;
    padding: 0;
  }

  .sidebar {
    width: 250px;
    background-color: #333;
    color: #fff;
    position: fixed;
    height: 100%;
    overflow: auto;
  }

  .sidebar a {
    padding: 15px;
    text-decoration: none;
    display: block;
    color: #fff;
    transition: background-color 0.3s;
  }

  .sidebar a:hover {
    background-color: #555;
  }

  .content {
    margin-left: 250px;
    padding: 20px;
  }

  .header {
    background-color: #555;
    color: #fff;
    padding: 15px;
    text-align: center;
  }

  table {
    width: 100%;
    border-collapse: collapse;
  }

  th, td {
    padding: 10px;
    text-align: left;
    border-bottom: 1px solid #ddd;
  }

  th {
    background-color: #f2f2f2;
    font-weight: bold;
  }

  tr:hover {
    background-color: #f9f9f9;
  }

  button {
    padding: 8px 12px;
    background-color: #007bff;
    color: #fff;
    border: none;
    border-radius: 4px;
    cursor: pointer;
  }

  button:hover {
    background-color: #0056b3;
  }
</style>
</head>
<body>


  <div class="sidebar">
  <div class="header">
    Admin Dashboard
  </div>
  <a href="#"><i class="fas fa-home"></i> Tasks</a>
  <a href="#"><i class="fas fa-users"></i> Users</a>
  <a href="#"><i class="fas fa-sign-out-alt"></i> Logout</a>
</div>

<div class="content">
    <table>
      <thead>
        <tr>
          <th>Description</th>
          <th>Assignee</th>
          <th>Assigned By</th>
          <th>Priority</th>
          <th>Status</th>
          <th>Due Date</th>
          <th>Action</th> <!-- New column for the "Update" button -->
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>Task 1</td>
          <td>John Doe</td>
          <td>Jane Smith</td>
          <td>High</td>
          <td>In Progress</td>
          <td>2024-03-15</td>
          <td><button onclick="updateTask(this)">Update</button></td>
        </tr>
        <tr>
          <td>Task 2</td>
          <td>Sarah Johnson</td>
          <td>David Brown</td>
          <td>Medium</td>
          <td>Not Started</td>
          <td>2024-04-01</td>
          <td><button onclick="updateTask(this)">Update</button></td>
        </tr>
        <!-- Add more rows as needed -->
      </tbody>
    </table>
  </div>
</body>
</html>
