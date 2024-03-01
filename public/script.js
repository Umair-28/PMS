function showContent(content) {
    var contentDiv = document.getElementById('content');
    var tasksContent; // Declaring tasksContent variable outside switch statement
    var newUrl = '/';
    switch (content) {
        case 'home':
            newUrl += 'home';
            var homeContent = `
  <div class="greetings">
    <h1>Greetings, ${userName}</h1>
  </div>
  <div class="agenda">
    <h3>Agenda for Today</h3>
    <ul>
      <li>Meeting with stakeholders at 10:00 AM</li>
      <li>Review project progress at 2:00 PM</li>
      <li>Follow up with clients at 4:00 PM</li>
    </ul>
  </div>
`;
            contentDiv.innerHTML = homeContent;
            break;



        case 'tasks':
            newUrl += 'tasks';
            // Fetch tasks data from the server
            fetch('/tasks')
                .then(response => response.json())
                .then(tasks => {
                    // Check if tasks array is empty
                    if (tasks.length === 0) {
                        contentDiv.innerHTML = '<p style="text-align:center">No tasks available.</p>';
                    } else {
                        // Build HTML for table header
                        var tableHTML = '<h2>Tasks</h2><table>';

                        tableHTML +=
                            '<tr><th>Description</th><th>Assignee</th><th>Assigned By</th><th>Priority</th><th>Status</th><th>Due Date</th><th>Action</th></tr>';

                        // Iterate over tasks and build table rows
                        tasks.forEach(task => {
                            tableHTML += '<tr>' +
                                `<td>${task.description}</td>` +
                                `<td>${task.assignee}</td>` +
                                `<td>${task.assigned_by}</td>` +
                                `<td>${task.priority}</td>` +
                                `<td>${task.status}</td>` +
                                `<td>${task.due_date}</td>` +
                                '<td>';

                            // Check if the user is admin or leader
                            if (roleName === 'admin' || roleName === 'project-leader') {
                                // Display the Delete button
                                tableHTML += `<button onclick="deleteTask(${task.id})" style="background-color:red; margin-right:4px;">Delete</button>`;
                            }

                            // Display the Update button

                        });

                        // Close the table
                        tableHTML += '</table>';

                        // Display tasks table in contentDiv
                        contentDiv.innerHTML = tableHTML;
                    }
                })
                .catch(error => console.error('Error fetching tasks:', error));

            break;





        case 'users':
            newUrl += 'users';
            // Fetch users data from the server
            fetch('/users')
                .then(response => response.json())
                .then(users => {
                    // Check if users array is empty
                    if (users.length === 0) {
                        contentDiv.innerHTML = '<p style="text-align:center">No Users available.</p>';
                    } else {
                        // Build HTML for table header
                        var tableHTML = '<h2>Users</h2><table>';
                        tableHTML +=
                            '<tr><th>ID</th><th>Name</th><th>Email</th><th>Action</th></tr>';

                        // Iterate over users and build table rows
                        users.forEach(user => {
                            tableHTML += `<tr>
                              <td>${user.id}</td>           
                              <td>${user.name}</td>
                              <td>${user.email}</td>
                              <td><button onclick="updateTask(${user.id})">Update</button>
                              <button onclick="deleteUser(${user.id})" style="background-color:red">Delete</button>

                              </td>
                            </tr>`;
                        });

                        // Close the table
                        tableHTML += '</table>';

                        // Display users table in contentDiv
                        contentDiv.innerHTML = tableHTML;
                    }
                })
                .catch(error => console.error('Error fetching users:', error));
            break;
        default:
            var defaultContent = '<h2>Error: Invalid content type</h2>';
            contentDiv.innerHTML = defaultContent;
    }
    history.pushState(null, '', newUrl);
}

// Show home content by default when page loads
window.onload = function () {
    showContent('home');
};

// MODAL goes here

// Function to open the modal
function openModal() {
    var modal = document.getElementById('myModal');
    modal.style.display = 'block';
}

// Function to close the modal
function closeModal() {
    var modal = document.getElementById('myModal');
    modal.style.display = 'none';
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function (event) {
    var modal = document.getElementById('myModal');
    if (event.target == modal) {
        modal.style.display = 'none';
    }
}
// Function to handle form submission
document.getElementById('taskForm').addEventListener('submit', function (event) {
    event.preventDefault(); // Prevent default form submission

    // Construct task object from form data
    var task = {
        description: document.getElementById('description').value,
        assignee: document.getElementById('assignee').value,
        status: document.getElementById('status').value,
        priority: document.getElementById('priority').value,
        dueDate: document.getElementById('dueDate').value
    };
    var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    // Send POST request to create-task endpoint
    fetch('http://127.0.0.1:8000/task', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken
        },
        body: JSON.stringify(task)
    })
        .then(response => {
            if (response.ok) {
                // Task created successfully, close modal
                closeModal();

                // Fetch tasks again to update the task list
                // return fetch('/tasks');
                showContent('tasks');
            } else {
                throw new Error('Failed to create task');
            }
        })
        .then(response => response.json())
        .then(tasks => {
            // Update the task list
            updateTaskList(tasks);
        })
        .catch(error => {
            console.error('Error creating task:', error);
            // Handle error, such as displaying an error message to the user
        });
});

// Function to update the task list
function updateTaskList(tasks) {
    var contentDiv = document.getElementById('content');
    if (tasks.length === 0) {
        contentDiv.innerHTML = '<p style="text-align:center">No tasks available.</p>';
    } else {
        // Build HTML for table header
        var tableHTML = '<h2>Tasks</h2><table>';
        tableHTML +=
            '<tr><th>Description</th><th>Assignee</th><th>Assigned By</th><th>Priority</th><th>Due Date</th><th>Action</th></tr>';

        // Iterate over tasks and build table rows
        tasks.forEach(task => {
            tableHTML += '<tr>' +
                `<td>${task.description}</td>` +
                `<td>${task.assignee}</td>` +
                `<td>${task.assigned_by}</td>` +
                `<td>${task.priority}</td>` +
                `<td>${task.due_date}</td>` +
                '<td>';

            // Check if the user is admin or leader
            if (roleName === 'admin' || roleName === 'leader') {
                // Display the Delete button
                tableHTML += `<button style="background-color:red">Delete</button>`;
            }

            // Display the Update button

        });

        // Close the table
        tableHTML += '</table>';

        // Display tasks table in contentDiv
        contentDiv.innerHTML = tableHTML;
    }
}

// logout the current user
function logout() {
    fetch('/logout', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
        .then(response => {
            if (response.ok) {
                // Redirect the user to the login page or perform any other action after successful logout
                window.location.href = '/login';
            } else {
                throw new Error('Logout failed');
            }
        })
        .catch(error => {
            console.error('Error logging out:', error);
        });
}


// delete a Task
function deleteTask(taskId) {
    var confirmation = confirm("Are you sure you want to delete this task?");
    if (confirmation) {
        var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        // Send DELETE request to delete-task endpoint
        fetch(`http://127.0.0.1:8000/task/${taskId}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': csrfToken
            }
        })
            .then(response => {
                if (response.ok) {
                    // Task deleted successfully, reload the task section
                    showContent('tasks');
                } else {
                    throw new Error('Failed to delete task');
                }
            })
            .catch(error => {
                console.error('Error deleting task:', error);
                // Handle error, such as displaying an error message to the user
            });
    }
}

// delete User

function deleteUser(userId) {
    var confirmation = confirm("Are you sure you want to delete this user?");
    if (confirmation) {
        var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        // Send DELETE request to delete-user endpoint
        fetch(`http://127.0.0.1:8000/user/${userId}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': csrfToken
            }
        })
            .then(response => {
                if (response.ok) {
                    // User deleted successfully, reload the user section
                    showContent('users');
                } else {
                    throw new Error('Failed to delete user');
                }
            })
            .catch(error => {
                console.error('Error deleting user:', error);
                // Handle error, such as displaying an error message to the user
            });
    }
}

// Dragging the Tasks




function allowDrop(event) {
    event.preventDefault();
}

function drag(event) {
    event.dataTransfer.setData("text", event.target.id);
}

function drop(event, status) {
    event.preventDefault();
    var taskId = event.dataTransfer.getData("text");
    var task = document.getElementById(taskId);
    var column = event.target.closest('.column');
    column.appendChild(task);
    updateStatus(taskId, status);
}

function updateStatus(taskId, status) {
    // Here you can send an AJAX request to update the status of the task in your backend/database
    console.log("Task ID:", taskId, "Status:", status);
}


