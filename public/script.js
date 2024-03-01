function showContent(content) {
    var contentDiv = document.getElementById('content');
    var tasksContent; // Declaring tasksContent variable outside switch statement
    var newUrl = '/';
    switch (content) {

    case 'home':
        newUrl += 'home';
        var homeContent = `
<div class="welcome-section">
    <h1>Welcome, ${userName}!</h1>
    <p>Here's an overview of your day:</p>
</div>
<div class="agenda">
    <h2>Agenda for Today</h2>
    <ul>
        <li>
            <span class="time">10:00 AM</span>
            <span class="event">Meeting with stakeholders</span>
        </li>
        <li>
            <span class="time">2:00 PM</span>
            <span class="event">Review project progress</span>
        </li>
        <li>
            <span class="time">4:00 PM</span>
            <span class="event">Follow up with clients</span>
        </li>
    </ul>
</div>

<div class="statistics-section">
    <h2>Statistics</h2>
    <div class="statistics-container">
        <!-- Statistics charts/graphs will be dynamically added here -->
    </div>
</div>
`;
        contentDiv.innerHTML = homeContent;
        break;

            case 'projects':
                fetch('/projects')
                .then(response => response.json())
                .then(projects => {
                    // Check if tasks array is empty
                    if (projects.length === 0) {
                        contentDiv.innerHTML = '<p style="text-align:center">No Projects Yet...</p>';
                    } else {
                        // Build HTML for table header
                        var tableHTML = '<h2>Projects</h2><table>';

                        tableHTML +=
                            '<tr><th>Name</th><th>Description</th><th>Project Leader</th><th>Created By</th><th>Status</th><th>Priority</th><th>Start Date</th><th>Due Date</th><th>Action</th></tr>';

                        // Iterate over tasks and build table rows
                        projects.forEach(project => {
                            tableHTML += '<tr>' +
                                `<td>${project.name}</td>` +
                                `<td>${project.description}</td>` +
                                `<td>${project.project_leader}</td>` +
                                `<td>${project.created_by}</td>` +
                                `<td>${project.status}</td>` +
                                `<td>${project.priority}</td>` +
                                `<td>${project.start_date}</td>` +
                                `<td>${project.end_date}</td>` +
                                '<td>';


                                tableHTML += `<button onclick="deleteProject(${project.id})" style="background-color:red; margin-right:4px;">Delete</button>`;
                            

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
                
                                // Initialize table header HTML
                                var tableHeaderHTML = '<tr><th>Description</th><th>Assignee</th><th>Assigned By</th><th>Priority</th><th>Status</th><th>Due Date</th>';
                
                                // Check if the user is admin or leader
                                if (roleName === 'admin' || roleName === 'project-leader') {
                                    // Display the "Action" column heading
                                    tableHeaderHTML += '<th>Action</th>';
                                }
                
                                // Close the table row
                                tableHeaderHTML += '</tr>';
                
                                // Add table header HTML to tableHTML
                                tableHTML += tableHeaderHTML;
                
                                // Iterate over tasks and build table rows
                                tasks.forEach(task => {
                                    // Start building table row HTML
                                    tableHTML += '<tr>' +
                                        `<td>${task.description}</td>` +
                                        `<td>${task.assignee}</td>` +
                                        `<td>${task.assigned_by}</td>` +
                                        `<td>${task.priority}</td>` +
                                        `<td>${task.status}</td>` +
                                        `<td>${task.due_date}</td>`;
                
                                    // Check if the user is admin or leader
                                    if (roleName === 'admin' || roleName === 'project-leader') {
                                        // Display the Delete button
                                        tableHTML += `<td><button onclick="deleteTask(${task.id})" style="background-color:red; margin-right:4px;">Delete</button></td>`;
                                    }
                
                                    // Close the table row
                                    tableHTML += '</tr>';
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
// function updateTaskList(tasks) {
//     var contentDiv = document.getElementById('content');
//     if (tasks.length === 0) {
//         contentDiv.innerHTML = '<p style="text-align:center">No tasks available.</p>';
//     } else {
//         // Build HTML for table header
//         var tableHTML = '<h2>Tasks</h2><table>';
//         tableHTML +=
//             '<tr><th>Description</th><th>Assignee</th><th>Assigned By</th><th>Priority</th><th>Due Date</th><th>Action</th></tr>';

//         // Iterate over tasks and build table rows
//         tasks.forEach(task => {
//             tableHTML += '<tr>' +
//                 `<td>${task.description}</td>` +
//                 `<td>${task.assignee}</td>` +
//                 `<td>${task.assigned_by}</td>` +
//                 `<td>${task.priority}</td>` +
//                 `<td>${task.due_date}</td>` +
//                 '<td>';

//             // Check if the user is admin or leader
//             if (roleName === 'admin' || roleName === 'leader') {
//                 // Display the Delete button
//                 tableHTML += `<button style="background-color:red">Delete</button>`;
//             }

//             // Display the Update button

//         });

//         // Close the table
//         tableHTML += '</table>';

//         // Display tasks table in contentDiv
//         contentDiv.innerHTML = tableHTML;
//     }
// }

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

// Managing the project
// Function to open the modal
function openProjectModal() {
    document.getElementById('projectModal').style.display = 'block';
}

// Function to close the modal
function closeProjectModal() {
    document.getElementById('projectModal').style.display = 'none';
}


//PROJECT CRUD


// creating a  task
document.getElementById('projectForm').addEventListener('submit', function(event) {
    event.preventDefault(); // Prevent default form submission

    // Construct project object from form data
    var project = {
        name: document.getElementById('projectName').value,
        description: document.getElementById('projectDescription').value,
        project_leader: document.getElementById('projectLeader').value,
        status: document.getElementById('Projectstatus').value,
        priority: document.getElementById('Projectpriority').value,
        start_date: document.getElementById('startDate').value,
        end_date: document.getElementById('endDate').value
    };

    // Retrieve CSRF token from meta tag
    var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    // Send POST request to create-project endpoint
    fetch('/create-project', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken
        },
        body: JSON.stringify(project)
    })
    .then(response => {
        if (response.ok) {
            // Project created successfully, close modal
            closeProjectModal();
            showContent('projects');
            // Refresh project list or perform other actions as needed
        } else {
            throw new Error('Failed to create project');
        }
    })
    .catch(error => {
        console.error('Error creating project:', error);
        // Handle error, such as displaying an error message to the user
    });
});


// Delete a Project

function deleteProject(projectId) {
    var confirmation = confirm("Are you sure you want to delete this Project?");
    if (confirmation) {
        var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        // Send DELETE request to delete-task endpoint
        fetch(`http://127.0.0.1:8000/project/${projectId}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': csrfToken
            }
        })
            .then(response => {
                if (response.ok) {
                    // Task deleted successfully, reload the task section
                    showContent('projects');
                } else {
                    throw new Error('Failed to delete project');
                }
            })
            .catch(error => {
                console.error('Error deleting projct:', error);
                // Handle error, such as displaying an error message to the user
            });
    }
}




