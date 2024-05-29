document.addEventListener("DOMContentLoaded", function() {
    const addSubjectBtn = document.getElementById("add-subject");
    const subjectsContainer = document.getElementById("subjects");

    addSubjectBtn.addEventListener("click", function() {
        const subjectName = document.getElementById("new-subject").value.trim();
        if (subjectName) {
            addSubject(subjectName);
            document.getElementById("new-subject").value = "";
        }
    });

    function addSubject(name) {
        const subjectDiv = document.createElement("div");
        subjectDiv.classList.add("subject");
        
        subjectDiv.innerHTML = `
            <h3>${name}</h3>
            <div class="tasks"></div>
            <input type="text" placeholder="Add a new task">
            <button class="add-task">Add Task</button>
            <span class="task-count">0 tasks pending</span>
        `;
        
        subjectsContainer.appendChild(subjectDiv);
        
        const addTaskBtn = subjectDiv.querySelector(".add-task");
        const tasksContainer = subjectDiv.querySelector(".tasks");
        const taskCount = subjectDiv.querySelector(".task-count");

        addTaskBtn.addEventListener("click", function() {
            const taskName = subjectDiv.querySelector("input[type=text]").value.trim();
            if (taskName) {
                addTask(taskName, tasksContainer, taskCount);
                subjectDiv.querySelector("input[type=text]").value = "";
            }
        });
    }

    function addTask(name, tasksContainer, taskCount) {
        const taskDiv = document.createElement("div");
        taskDiv.classList.add("task");
        taskDiv.textContent = name;

        tasksContainer.appendChild(taskDiv);
        
        updateTaskCount(taskCount, tasksContainer);
    }

    function updateTaskCount(taskCount, tasksContainer) {
        const pendingTasks = tasksContainer.querySelectorAll(".task").length;
        taskCount.textContent = `${pendingTasks} tasks pending`;
    }
});
