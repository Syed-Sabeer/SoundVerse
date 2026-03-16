// File manager JS

let fileSystemTree = [
  {
    isDirectory: true,
    name: "Test folder",
    child: [
      {
        isDirectory: false,
        name: "Text.txt",
      },
    ],
  },
  {
    isDirectory: false,
    name: "index.html",
  },
  {
    isDirectory: true,
    name: "Folder A",
    child: [
      {
        isDirectory: false,
        name: "FileA1.txt",
      },
      {
        isDirectory: false,
        name: "FileA2.js",
      },
      {
        isDirectory: true,
        name: "Subfolder A",
        child: [
          {
            isDirectory: false,
            name: "FileA3.css",
          },
        ],
      },
    ],
  },
  {
    isDirectory: false,
    name: "index.php",
  },
  {
    isDirectory: false,
    name: "Textfile.txt",
  },
  {
    isDirectory: false,
    name: "Changelog.exe",
  },
  {
    isDirectory: true,
    name: "Folder B",
    child: [
      {
        isDirectory: false,
        name: "Dropdown.php",
      },
    ],
  },
  {
    isDirectory: false,
    name: "Mofi.html",
  },

  {
    isDirectory: false,
    name: "Logo.psd",
  },
  {
    isDirectory: true,
    name: "Images",
    child: [
      {
        isDirectory: false,
        name: "1.png",
      },
      {
        isDirectory: false,
        name: "2.png",
      },
      {
        isDirectory: false,
        name: "3.png",
      },
      {
        isDirectory: false,
        name: "4.png",
      },
      {
        isDirectory: false,
        name: "5.png",
      },
      {
        isDirectory: false,
        name: "6.png",
      },
      {
        isDirectory: false,
        name: "7.png",
      },
      {
        isDirectory: false,
        name: "8.png",
      },
    ],
  },
  {
    isDirectory: true,
    name: "Applications",
    child: [
      {
        isDirectory: false,
        name: "Resign_letter.txt",
      },
      {
        isDirectory: false,
        name: "Offer_letter.txt",
      },
      {
        isDirectory: false,
        name: "Resume.txt",
      },
    ],
  },

  {
    isDirectory: false,
    name: "Project.zip",
  },
  {
    isDirectory: false,
    name: "essay.txt",
  },
  {
    isDirectory: true,
    name: "Start-up",
    child: [
      {
        isDirectory: false,
        name: "algorithms.php",
      },
      {
        isDirectory: false,
        name: "flowchart.rar",
      },
    ],
  },
  {
    isDirectory: false,
    name: "file.unknown",
  },
  {
    isDirectory: false,
    name: "timer.svg",
  },
  {
    isDirectory: true,
    name: "Resumes",
    child: [
      {
        isDirectory: false,
        name: "Jacob_Jones.exe",
      },
      {
        isDirectory: false,
        name: "Jams_Bone.txt",
      },
      {
        isDirectory: false,
        name: "Mili_Pais.txt",
      },
    ],
  },
  {
    isDirectory: true,
    name: "Demo_files",
    child: [
      {
        isDirectory: false,
        name: "C_pro.net",
      },
    ],
  },

  {
    isDirectory: true,
    name: ".net_pra",
    child: [
      {
        isDirectory: false,
        name: "Practical_3.net",
      },
      {
        isDirectory: false,
        name: "Practical_6.net",
      },
    ],
  },
  {
    isDirectory: false,
    name: "audiobook.m4b",
  },
  {
    isDirectory: true,
    name: "Portfolio",
    child: [
      {
        isDirectory: false,
        name: "ux_design.rar",
      },
      {
        isDirectory: false,
        name: "practical.rar",
      },
    ],
  },
  {
    isDirectory: false,
    name: "song.m4v",
  },
  {
    isDirectory: false,
    name: "product_list.xml",
  },
  {
    isDirectory: false,
    name: "birds_sound.aiff",
  },
  {
    isDirectory: true,
    name: "Themes",
    child: [
      {
        isDirectory: false,
        name: "mofi.php",
      },
      {
        isDirectory: false,
        name: "riho.php",
      },
      {
        isDirectory: false,
        name: "koho.php",
      },
    ],
  },
  {
    isDirectory: false,
    name: "presentation.wmv",
  },
  {
    isDirectory: false,
    name: "conference.mp4",
  },
];
class HistoryStack {
  #items;
  constructor() {
    this.#items = [];
  }
  push(item) {
    this.#items.push(item);
  }
  pop() {
    return this.#items.pop();
  }
  peek() {
    return this.#items[this.#items.length - 1];
  }
  isEmpty() {
    return this.#items.length === 0;
  }
  size() {
    return this.#items.length;
  }
  print() {
    console.log(this.#items.join(", "));
  }
}

let prePaths = new HistoryStack();
let forPaths = new HistoryStack();
let fileSystem = fileSystemTree;
let selected_item = {
  item: {},
  index: 0,
};

initFileManager("root/");
function initFileManager(path, config = { keepHistory: true }) {
  document.querySelector(".folder-path-input").value = path;
  if (config.keepHistory) prePaths.push(path);
  let fileSys = JSON.parse(JSON.stringify(fileSystem));
  let pathArr = path.split("/");
  if (pathArr[0] != "root") return newToast("error", "404 | Path doesn't exist!", (close) => setTimeout(() => close(), 5000));
  let flag = 0;
  for (let i = 1; i < pathArr.length; i++) {
    if (pathArr[i]) {
      for (const folder in fileSys) {
        if (fileSys[folder].name == pathArr[i]) {
          fileSys = fileSys[folder].child;
          flag++;
          break;
        }
      }
    }
  }
  if (pathArr.length - (pathArr[pathArr.length - 1] ? 1 : 2) != flag) return newToast("error", "404 | Path doesn't exist!", (close) => setTimeout(() => close(), 5000));
  document.querySelector(".folderEmpty").style.display = fileSys.length ? "none" : "block";
  setupFilemanager(fileSys);
  if (config.callback) config.callback();
}

function newItem(config = { isDirectory: true, name: "unknown" }) {
  let path = document.querySelector(".folder-path-input").value;
  if (!(path && config.name)) return newToast("error", "Please fill out the name field!", (close) => setTimeout(() => close(), 5000));
  let fileSys = fileSystem;
  let pathArr = path.split("/");
  for (let i = 1; i < pathArr.length; i++) {
    if (pathArr[i]) {
      for (const folder in fileSys) {
        if (fileSys[folder].name == pathArr[i]) {
          fileSys = fileSys[folder].child;
          break;
        }
      }
    }
  }
  if (config.isDirectory) {
    fileSys.push({
      isDirectory: true,
      name: config.name,
      child: [],
    });
  } else {
    fileSys.push({
      isDirectory: false,
      name: config.name,
    });
  }
  initFileManager(path, { keepHistory: false });
  newToast("success", "Saved new " + (config.isDirectory ? "folder" : "file") + ' "' + config.name + '"!', (close) => setTimeout(() => close(), 5000));
}

function renameItem(newName) {
  if (selected_item.item?.name) {
    let path = document.querySelector(".folder-path-input").value;
    let pathArr = path.split("/");
    let fileSys = fileSystem;
    for (let i = 1; i < pathArr.length; i++) {
      if (pathArr[i]) {
        for (const folder in fileSys) {
          if (fileSys[folder].name == pathArr[i]) {
            fileSys = fileSys[folder].child;
            break;
          }
        }
      }
    }
    fileSys[selected_item.index].name = newName;
    newToast("success", "Changed file name into " + selected_item.item.name + "!", (remove) => {
      setTimeout(() => {
        remove();
      }, 2000);
    });
    initFileManager(path, { keepHistory: false });
  }
}

function deleteItem() {
  if (selected_item.item?.name) {
    let path = document.querySelector(".folder-path-input").value;
    let pathArr = path.split("/");
    let fileSys = fileSystem;
    for (let i = 1; i < pathArr.length; i++) {
      if (pathArr[i]) {
        for (const folder in fileSys) {
          if (fileSys[folder].name == pathArr[i]) {
            fileSys = fileSys[folder].child;
            break;
          }
        }
      }
    }
    newToast("success", `Deleted ${selected_item.item.isDirectory ? "folder" : "file"} "${selected_item.item.name}"!`, (remove) => {
      setTimeout(() => {
        remove();
      }, 2000);
    });
    fileSys.splice(selected_item.index, 1);
    initFileManager(path, { keepHistory: false });
  }
}

function setupFilemanager(fileSystem) {
  filesContainer = document.querySelector(".file-manager-grid");
  filesContainer.innerHTML = "";
  resetHistoryBtn();
  for (const fileItem in fileSystem) {
    let div = document.createElement("div");
    div.setAttribute("title", fileSystem[fileItem].name);
    if (fileSystem[fileItem].isDirectory) {
      div.classList.add("folder");
      div.addEventListener("dblclick", (e) => {
        let toPath = document.querySelector(".folder-path-input").value + fileSystem[fileItem].name;
        initFileManager(toPath + "/");
      });
      div.innerHTML += `
            <div class="folder-icon-container">
            <div class="folder-icon"></div>
            </div>
            <p class="folder-name">${fileSystem[fileItem].name}</p>
            `;
    } else {
      div.classList.add("file");
      let fileIcon = getFileIconMeta(fileSystem[fileItem]);
      div.innerHTML += `
                    <div class="doc-icon-container">
                        <div class="doc-icon" style="--icon-color: ${fileIcon.color};"><p>${fileIcon.ext}</p></div>
                    </div>
                    <p class="file-name">${fileSystem[fileItem].name}</p>
            `;
    }
    filesContainer.appendChild(div);
    div.addEventListener("click", (e) => {
      selected_item.index = fileItem;
      selected_item.item = fileSystem[fileItem];
      document.querySelector(".item-selected")?.classList.remove("item-selected");
      div.classList.add("item-selected");
    });
  }
}

function getFileIconMeta(file) {
  let ext = file.name.split(".")[file.name.split(".").length - 1];
  let color = "116, 116, 116";
  switch (ext) {
    case "txt":
      color = "36, 230, 149";
      break;

    case "html":
      color = "36, 230, 149";
      break;

    case "php":
      color = "108, 74, 201";
      break;

    case "zip":
      color = "190, 173, 16";
      break;

    case "svg":
      color = "36, 230, 149";
      break;
    case "png":
      color = "36, 230, 149";
      break;

    default:
      ext = ".?";
      break;
  }
  return { ext: ext.toUpperCase(), color };
}

function backward() {
  if (!prePaths.isEmpty()) {
    let currPath = prePaths.pop();
    forPaths.push(currPath);
    initFileManager(prePaths.peek(), { keepHistory: false });
  }
}

function forward() {
  if (!forPaths.isEmpty()) {
    let currPath = forPaths.pop();
    prePaths.push(currPath);
    initFileManager(currPath, { keepHistory: false });
  }
}

function resetHistoryBtn() {
  if (prePaths.size() - 1 == 0) {
    document.getElementById("backwardBtn").setAttribute("disabled", true);
  } else {
    document.getElementById("backwardBtn").removeAttribute("disabled");
  }
  if (forPaths.isEmpty()) {
    document.getElementById("forwardBtn").setAttribute("disabled", true);
  } else {
    document.getElementById("forwardBtn").removeAttribute("disabled");
  }
}

function openModel(modelFor) {
  //'newFile'
  document.querySelector(".popup").style.display = "flex";
  document.querySelector(".popup >.popup-bg").addEventListener("click", () => (document.querySelector(".popup").style.display = "none"));
  if (modelFor == "newFile") {
    document.querySelector(".popup h5").innerHTML = "New File";
    let input = document.createElement("input");
    input.setAttribute("type", "text");
    input.setAttribute("placeholder", "Filename");
    let saveButton = document.createElement("button");
    saveButton.style = "background-color: #7366FF;";
    saveButton.innerHTML = "Save";
    document.querySelector(".popup form").innerHTML = "";
    document.querySelector(".popup form").appendChild(input);
    document.querySelector(".popup form").appendChild(saveButton);
    saveButton.addEventListener("click", () => {
      newItem((config = { isDirectory: false, name: input.value }));
      document.querySelector(".popup").style.display = "none";
    });
  }
  if (modelFor == "newFolder") {
    document.querySelector(".popup h5").innerHTML = "New Folder";
    let input = document.createElement("input");
    input.setAttribute("type", "text");
    input.setAttribute("placeholder", "Foldername");
    let saveButton = document.createElement("button");
    saveButton.style = "background-color: #7366FF;";
    saveButton.innerHTML = "Save";
    document.querySelector(".popup form").innerHTML = "";
    document.querySelector(".popup form").appendChild(input);
    document.querySelector(".popup form").appendChild(saveButton);
    saveButton.addEventListener("click", () => {
      newItem((config = { isDirectory: true, name: input.value }));
      document.querySelector(".popup").style.display = "none";
    });
  }
  if (modelFor == "rename") {
    if (selected_item.item?.name) {
      document.querySelector(".popup h5").innerHTML = "Rename";
      let input = document.createElement("input");
      input.setAttribute("type", "text");
      input.setAttribute("placeholder", (selected_item.item.isDirectory ? "Folder" : "File") + " name (" + selected_item.item.name + ")");
      input.value = selected_item.item.name;
      let saveButton = document.createElement("button");
      saveButton.style = "background-color: #7366FF;";
      saveButton.innerHTML = "Save";
      document.querySelector(".popup form").innerHTML = "";
      document.querySelector(".popup form").appendChild(input);
      document.querySelector(".popup form").appendChild(saveButton);
      saveButton.addEventListener("click", () => {
        renameItem(input.value);
        document.querySelector(".popup").style.display = "none";
      });
    } else {
      document.querySelector(".popup").style.display = "none";
      newToast("error", "Kindly choose a file or folder that you like to change its name!", (remove) => {
        setTimeout(() => {
          remove();
        }, 2000);
      });
    }
  }
  if (modelFor == "delete") {
    if (selected_item.item?.name) {
      document.querySelector(".popup h5").innerHTML = "Please confirm if you would like to delete the file.";
      let saveButton = document.createElement("button");
      let cancelButton = document.createElement("button");
      saveButton.style = "background-color: #7366FF;";
      saveButton.innerHTML = "Yes";
      cancelButton.innerHTML = "Cancel";
      document.querySelector(".popup form").innerHTML = "";
      document.querySelector(".popup form").appendChild(saveButton);
      document.querySelector(".popup form").appendChild(cancelButton);
      saveButton.focus();
      saveButton.addEventListener("click", () => {
        deleteItem();
        document.querySelector(".popup").style.display = "none";
      });
      cancelButton.addEventListener("click", () => {
        document.querySelector(".popup").style.display = "none";
      });
    } else {
      document.querySelector(".popup").style.display = "none";
      newToast("error", "Please select a file or folder which you want to delete!", (remove) => {
        setTimeout(() => {
          remove();
        }, 2000);
      });
    }
  }
}

function newToast(sts, message, cb) {
  sts = sts == "success" ? "toast-success" : sts == "error" ? "toast-danger" : "toast-inf";
  let tContainer = document.querySelector(".toast-messages");
  let c = document.createElement("div");
  let bc = document.createElement("div");
  let p = document.createElement("p");
  let b = document.createElement("button");
  c.classList.add("toast-container", sts);
  p.innerText = message;
  b.innerHTML = '<i class="fa-solid fa-xmark"></i>';
  b.addEventListener("click", removeToast);
  c.appendChild(p);
  bc.appendChild(b);
  c.appendChild(bc);
  tContainer.prepend(c);
  setTimeout(() => {
    c.style.opacity = "1";
  }, 300);
  function removeToast() {
    c.style = `
            opacity:0;
        `;
    setTimeout(() => {
      c.remove();
    }, 500000);
  }
  if (cb) cb(removeToast);
}
