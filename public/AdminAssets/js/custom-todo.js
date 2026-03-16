// Custom todo JS

const taskList = document.querySelector("#task-list");
const newTaskInput = document.querySelector("#new-task-input");
const addTaskButton = document.querySelector("#add-task-button");

const tasks = [];

const app = {
  tasks,
  taskList,
  newTaskInput,
};

function createTask(title, isCompleted = false) {
  return {
    id: Date.now(),
    title,
    isCompleted,
    date: new Date().toLocaleDateString(),
  };
}

function addTaskToList(task, taskList) {
  if (!taskList) {
    console.error("Task list element not found.");
    return;
  }
  const taskElement = createTaskElement(task);
  taskList.appendChild(taskElement);
}

function addTask(app) {
  const newTaskTitle = app.newTaskInput.value;
  if (!newTaskTitle.trim()) return; // Avoid adding empty tasks
  const newTask = createTask(newTaskTitle);
  app.tasks.push(newTask);

  addTaskToList(newTask, app.taskList);
  saveTasksToLocalStorage(app.tasks);
  app.newTaskInput.value = "";
}

function createTaskElement(task) {
  const taskElement = document.createElement("li");

  const taskCheckBox = document.createElement("input");
  taskCheckBox.type = "checkbox";
  taskCheckBox.classList.add("form-check-input", "checkbox-primary");
  taskCheckBox.checked = task.isCompleted;

  taskCheckBox.addEventListener("change", () => {
    task.isCompleted = taskCheckBox.checked;
    taskText.classList.toggle("completed", task.isCompleted);
    saveTasksToLocalStorage(app.tasks);
  });

  const taskText = document.createElement("span");
  taskText.textContent = task.title;
  taskText.classList.toggle("completed", task.isCompleted);

  const actionContainer = document.createElement("div");
  actionContainer.classList.add("task-date");

  const dateSpan = document.createElement("span");
  dateSpan.classList.add("c-o-light");
  dateSpan.textContent = `${task.date}`;
  actionContainer.appendChild(dateSpan);

  const taskDeleteButton = document.createElement("button");
  taskDeleteButton.className = "delete-button";
  const trashIcon = document.createElement("i");
  trashIcon.className = "fa-solid fa-trash"; // FontAwesome icon class
  taskDeleteButton.appendChild(trashIcon);

  taskDeleteButton.addEventListener("click", () => {
    taskElement.remove();
    const taskIndex = app.tasks.indexOf(task);
    if (taskIndex > -1) {
      app.tasks.splice(taskIndex, 1);
    }
    saveTasksToLocalStorage(app.tasks);
  });

  actionContainer.appendChild(taskDeleteButton);

  taskElement.appendChild(taskCheckBox);
  taskElement.appendChild(taskText);
  taskElement.appendChild(actionContainer);

  return taskElement;
}

function saveTasksToLocalStorage(tasks) {
  localStorage.setItem("tasks", JSON.stringify(tasks));
}

// Load default tasks when the page loads
window.onload = () => {
  const defaultTasks = [createTask("Update all admin themes"), createTask("Prepare a summary presentation for the stakeholders and finish the in-depth analysis for the quarterly financial report."), createTask("Review project documentation"), createTask("Plan out and complete the weekend's events, including any planned excursions, get-togethers, and downtime.")];

  defaultTasks.forEach((task) => {
    app.tasks.push(task);
    addTaskToList(task, app.taskList);
  });
};

addTaskButton.addEventListener("click", () => {
  addTask(app);
});

newTaskInput.addEventListener("keydown", (event) => {
  if (event.key === "Enter") {
    addTask(app);
  }
});
