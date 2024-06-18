document.addEventListener('DOMContentLoaded', function() {
    fetchTasks();

    document.querySelector('form').addEventListener('submit', function(event) {
        event.preventDefault();
        addTask(new FormData(this));
    });

    document.getElementById('clear-completed').addEventListener('click', function() {
        clearCompletedTasks();
    });
});

function fetchTasks() {
    fetch('tasks.php')
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            console.log('Fetched tasks:', data); // Debug: Log fetched tasks
            const todoList = document.getElementById('todo-list');
            todoList.innerHTML = '';

            if (data.length === 0) {
                todoList.innerHTML = '<li>No tasks found.</li>';
            } else {
                data.forEach(task => {
                    const li = document.createElement('li');
                    li.innerHTML = `
                        <input type="checkbox" onchange="updateTaskStatus(${task.id}, this.checked)" ${task.status == 1 ? 'checked' : ''}>
                        <span>${task.subject} - ${task.task} (Deadline: ${task.deadline})</span>
                    `;
                    todoList.appendChild(li);
                });
            }
        })
        .catch(error => {
            console.error('Error fetching tasks:', error);
        });
}

function addTask(formData) {
    fetch('add_task.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(message => {
        console.log(message);
        fetchTasks(); // Refresh the task list
    });
}

function updateTaskStatus(taskId, status) {
    fetch('update_task.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({ id: taskId, status: status ? 1 : 0 })
    })
    .then(response => response.json())
    .then(data => {
        console.log(data.message);
    });
}

function clearCompletedTasks() {
    fetch('clear_completed_tasks.php')
        .then(response => response.json())
        .then(data => {
            console.log(data.message);
            fetchTasks(); // Refresh tasks after deletion
        });
}
