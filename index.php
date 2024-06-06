<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To-Do List Mejorada</title>
    <style>
        body {
            background-color: black;
            color: white;
            display: flex;
            flex-direction: column;
            align-items: center;
            height: 100vh;
            font-family: Arial, sans-serif;
            text-align: center;
        }
        ul {
            list-style-type: none;
            padding: 0;
        }
        li {
            margin: 10px 0;
            display: flex;
            justify-content: space-between;
            width: 300px;
        }
        .completed {
            text-decoration: line-through;
        }
        button {
            margin-left: 5px;
        }
    </style>
</head>
<body>
    <h1>To-Do List Mejorada</h1>
    <input type="text" id="taskInput" placeholder="Nueva tarea">
    <button onclick="addTask()">Agregar</button>
    <ul id="taskList"></ul>

    <script>
        function loadTasks() {
            let tasks = JSON.parse(localStorage.getItem('tasks')) || [];
            let taskList = document.getElementById('taskList');
            taskList.innerHTML = '';
            tasks.forEach((task, index) => {
                let li = document.createElement('li');
                li.innerHTML = `<span class="${task.completed ? 'completed' : ''}">${task.name}</span>
                                <button onclick="toggleTask(${index})">${task.completed ? 'Desmarcar' : 'Completar'}</button>
                                <button onclick="editTask(${index})">Editar</button>
                                <button onclick="deleteTask(${index})">Eliminar</button>`;
                taskList.appendChild(li);
            });
        }

        function addTask() {
            let taskInput = document.getElementById('taskInput');
            let tasks = JSON.parse(localStorage.getItem('tasks')) || [];
            if (taskInput.value.trim() !== '') {
                tasks.push({ name: taskInput.value, completed: false });
                localStorage.setItem('tasks', JSON.stringify(tasks));
                taskInput.value = '';
                loadTasks();
            }
        }

        function toggleTask(index) {
            let tasks = JSON.parse(localStorage.getItem('tasks')) || [];
            tasks[index].completed = !tasks[index].completed;
            localStorage.setItem('tasks', JSON.stringify(tasks));
            loadTasks();
        }

        function editTask(index) {
            let tasks = JSON.parse(localStorage.getItem('tasks')) || [];
            let newTaskName = prompt('Editar tarea:', tasks[index].name);
            if (newTaskName !== null && newTaskName.trim() !== '') {
                tasks[index].name = newTaskName;
                localStorage.setItem('tasks', JSON.stringify(tasks));
                loadTasks();
            }
        }

        function deleteTask(index) {
            let tasks = JSON.parse(localStorage.getItem('tasks')) || [];
            tasks.splice(index, 1);
            localStorage.setItem('tasks', JSON.stringify(tasks));
            loadTasks();
        }

        window.onload = loadTasks;
    </script>
</body>
</html>
