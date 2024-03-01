<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="styles.css">
    <style>

    </style>
</head>

<body>


    <div class="sidebar">
        <div class="header">
            @if ($role_name === 'admin')
                Admin Dashboard
            @elseif($role_name === 'project-leader')
                Leader Dashboard
            @else
                Developer Dashboard
            @endif
        </div>
        <a href="#" onclick="showContent('home')"><i class="fas fa-home"></i> Home</a>
            @if($role_name === 'project-leader')
            <a href="#" onclick="showContent('projects')"><i class="fas fa-projects"></i> Projects</a>
            @endif
        <a href="#" onclick="showContent('tasks')"><i class="fas fa-tasks"></i> Tasks</a>
        <a href="#" onclick=""><i class="fas fa-tasks"></i> Boards</a>
        @if ($role_name === 'admin')
            <a href="#" onclick="showContent('users')"><i class="fas fa-users"></i> Users</a>
            <a href="#" onclick="showContent('projects')"><i class="fas fa-projects"></i> Projects</a>
        @else
        @endif
        <a href="#" onclick="logout()"><i class="fas fa-sign-out-alt"></i> Logout</a>

    </div>

    <div class="content" id="content">

    </div>
    @if ($role_name === 'admin' || $role_name === 'project-leader')
        <button onclick="openModal()" class="create-task-button">Create Task</button>
        <button style="margin-right:130px" class="create-task-button" onclick="openProjectModal()">Create Project</button>

    @else
    @endif


    <div id="myModal" class="modal">
        <!-- Modal content -->
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>

            <form id="taskForm">
                @csrf
                <label for="description">Task Description:</label>
                <input type="text" id="description" name="description">

                <label for="assignee">Assignee:</label>
                <input type="text" id="assignee" name="assignee">

                <label for="status">Status:</label>
                <select id="status" name="status">
                    <option value="Back Log">Back Log</option>
                    <option value="In Progress">In Progress</option>
                    <option value="In Review">In Review</option>
                    <option value="Closed">Closed</option>
                </select>

                <label for="priority">Priority:</label>
                <select id="priority" name="priority">
                    <option value="Normal">Normal</option>
                    <option value="High">High</option>
                    <option value="Urgent">Urgent</option>

                </select>

                <label for="dueDate">Due Date:</label>
                <input type="date" id="dueDate" name="dueDate">

                <button type="submit">Submit</button>
            </form>

        </div>
    </div>

    <!-- HTML for the modal -->
    {{-- <div id="updateTaskModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeUpdateTaskModal()">&times;</span>
            <form id="updateTaskForm">
                @csrf
                <input type="hidden" id="taskId" name="taskId">
                <label for="description">Task Description:</label>
                <input type="text" id="description" name="description">

                <label for="assignee">Assignee:</label>
                <input type="text" id="assignee" name="assignee">

                <label for="status">Status:</label>
                <select id="status" name="status">
                    <option value="Back Log">Back Log</option>
                    <option value="In Progress">In Progress</option>
                    <option value="In Review">In Review</option>
                    <option value="Closed">Closed</option>
                </select>

                <label for="dueDate">Due Date:</label>
                <input type="date" id="dueDate" name="dueDate">

                <button type="submit">Submit</button>
            </form>
        </div>
    </div> --}}


    {{-- dragable task --}}

    {{-- <div class="board" id="board">
        <div id="backlog" class="column" ondrop="drop(event, 'Backlog')" ondragover="allowDrop(event)">
            <h3>Backlog</h3>
            @foreach ($tasks as $task)
                @if ($task->status === 'Backlog')
                    <div class="task" draggable="true" ondragstart="drag(event)">{{ $task->description }}</div>
                @endif
            @endforeach
        </div>
        <div id="in-progress" class="column" ondrop="drop(event, 'In Progress')" ondragover="allowDrop(event)">
            <h3>In Progress</h3>
            @foreach ($tasks as $task)
                @if ($task->status === 'In Progress')
                    <div class="task" draggable="true" ondragstart="drag(event)">{{ $task->description }}</div>
                @endif
            @endforeach
        </div>
        <div id="in-review" class="column" ondrop="drop(event, 'In Review')" ondragover="allowDrop(event)">
            <h3>In Review</h3>
            @foreach ($tasks as $task)
                @if ($task->status === 'In Review')
                    <div class="task" draggable="true" ondragstart="drag(event)">{{ $task->description }}</div>
                @endif
            @endforeach
        </div>
        <div id="closed" class="column" ondrop="drop(event, 'Closed')" ondragover="allowDrop(event)">
            <h3>Closed</h3>
            @foreach ($tasks as $task)
                @if ($task->status === 'Closed')
                    <div class="task" draggable="true" ondragstart="drag(event)">{{ $task->description }}</div>
                @endif
            @endforeach
        </div>
    </div> --}}

    <div id="projectModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeProjectModal()">&times;</span>
            <form id="projectForm">
                @csrf
                <label for="projectName">Project Name:</label>
                <input type="text" id="projectName" name="name" required>

                <label for="projectDescription">Description:</label>
                <input type="text" id="projectDescription" name="description" required>

                <label for="projectLeader">Project Leader:</label>
                <input type="text" id="projectLeader" name="project_leader" required>

                <label for="Projectstatus">Status:</label>
                <select id="Projectstatus" name="Projectstatus">
                    <option value="Planning">Planning</option>
                    <option value="In Progress">In Progress</option>
                    <option value="On Hold">On Hold</option>
                    <option value="Completed">Completed</option>
                </select>

                <label for="Projectpriority">Priority:</label>
                <select id="Projectpriority" name="Projectpriority">
                    <option value="Normal">Normal</option>
                    <option value="High">High</option>
                    <option value="Urgent">Urgent</option>

                </select>

                <label for="startDate">Start Date:</label>
                <input type="date" id="startDate" name="start_date">

                <label for="endDate">End Date:</label>
                <input type="date" id="endDate" name="end_date">
                <!-- Add other input fields as needed -->
    
                <button type="submit">Create Project</button>
            </form>
        </div>
    </div>


    <script>
        var userName = @json($user_name);
        var roleName = @json($role_name);
    </script>
    <script src="script.js"></script>

</body>

</html>
