// Kanban JS
(function () {
  var kanban1 = new jKanban({
    element: "#demo1",
    gutter: "15px",
    widthBoard: "450px",
    click: function (el) {
      console.log("Trigger on all items click!");
    },
    context: function (el, e) {
      console.log("Trigger on all items right-click!");
    },
    dropEl: function (el, target, source, sibling) {
      console.log(target.parentElement.getAttribute("data-id"));
      console.log(el, target, source, sibling);
    },
    buttonClick: function (el, boardId) {
      console.log(el);
      console.log(boardId);
      // create a form to enter element
      var formItem = document.createElement("form");
      formItem.setAttribute("class", "itemform");
      formItem.innerHTML = '<div class="form-group"><textarea class="form-control" rows="2" autofocus></textarea></div><div class="form-group"><button type="submit" class="btn btn-primary btn-sm me-2">Submit</button><button type="button" id="CancelBtn" class="btn button-light-primary btn-sm">Cancel</button></div>';

      kanban1.addForm(boardId, formItem);
      formItem.addEventListener("submit", function (e) {
        e.preventDefault();
        var text = e.target[0].value;
        kanban1.addElement(boardId, {
          title: text,
        });
        formItem.parentNode.removeChild(formItem);
      });
      document.getElementById("CancelBtn").onclick = function () {
        formItem.parentNode.removeChild(formItem);
      };
    },
    itemAddOptions: {
      enabled: true,
      content: "Add New Card",
      class: "btn",
      footer: true,
    },
    boards: [
      {
        id: "_in_review",
        title: "In Review",
        item: [
          {
            title: `
                                 <a class="kanban-box" href="#"><span class="date">23/02/24</span><span class="badge badge-success f-right">Low</span>
                                  <h6>CRUD Complete</h6>
                                  <div class="common-align"><img class="me-2 rounded-circle" src="../assets/images/dashboard/user/1.jpg">
                                    <div class="flex-grow-1">
                                      <p>Millie Valdez</p>
                                    </div>
                                  </div>
                                  <div class="d-flex mt-3">
                                    <ul class="list">
                                      <li data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Comments"><i class="fa-regular fa-comments"></i>4</li>
                                      <li data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Attachment"><i class="fa-solid fa-paperclip"></i>1</li>
                                      <li data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="View"><i class="fa-regular fa-eye"></i></i></li>
                                    </ul>
                                    <ul class="common-f-start">
                                    <li data-bs-toggle="tooltip" data-bs-placement="top"
                                      data-bs-title="Leia Holland"><img class="img-30 common-circle"
                                        src="../assets/images/user/3.png" alt="user"></li>
                                    <li data-bs-toggle="tooltip" data-bs-placement="top"
                                      data-bs-title="Keaton Farley"><img class="img-30 common-circle"
                                        src="../assets/images/user/12.png" alt="user"></li>
                                    <li data-bs-toggle="tooltip" data-bs-placement="top"
                                    data-bs-title="3+ More">
                                    <div class="common-circle bg-lighter-dark">3+</div>
                                  </ul>
                                  </div></a>
                              `,
          },
          {
            title: `
                                 <a class="kanban-box" href="#"><span class="date">05/04/24</span><span class="badge badge-danger f-right">Urgent</span>
                                  <h6>Managing CI/CD</h6>
                                  <div class="common-align"><img class="me-2 rounded-circle" src="../assets/images/dashboard/user/5.jpg">
                                    <div class="flex-grow-1">
                                      <p>Peregrine Huxley</p>
                                    </div>
                                  </div>
                                  <div class="d-flex mt-3">
                                    <ul class="list">
                                      <li data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Comments"><i class="fa-regular fa-comments"></i>9</li>
                                      <li data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Attachment"><i class="fa-solid fa-paperclip"></i>2</li>
                                      <li data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="View"><i class="fa-regular fa-eye"></i></i></li>
                                    </ul>
                                    <ul class="common-f-start">
                                    <li data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Kellen Munoz">
                                      <img class="img-30 common-circle" src="../assets/images/dashboard-11/user/4.jpg" alt="user">
                                    </li>
                                    <li data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Baylor Hancock">
                                      <img class="img-30 common-circle" src="../assets/images/dashboard-11/user/9.jpg"
                                        alt="user">
                                    </li>
                                        <li data-bs-toggle="tooltip" data-bs-placement="top"
                                        data-bs-title="Aleah Yang"><img class="img-30 common-circle"
                                          src="../assets/images/user/14.png" alt="user"></li>
                                    </li>
                                    <li data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="4+ More">
                                      <div class="common-circle bg-lighter-dark">4+</div>
                                    </li>
                                  </ul>
                                  </div></a>
                              `,
          },
        ],
      },
      {
        id: "_todo",
        title: "Pending",
        item: [
          {
            title: `
                                 <a class="kanban-box" href="#"><span class="date">23/07/24</span><span class="badge badge-primary f-right">Medium</span>
                                  <h6>Scheduled Calls</h6>
                                  <div class="common-align"><img class="me-2 rounded-circle" src="../assets/images/user/3.jpg" alt="" data-original-title="" title="">
                                    <div class="flex-grow-1">
                                      <p>Thaddeus Mercer</p>
                                    </div>
                                  </div>
                                  <div class="d-flex mt-3">
                                    <ul class="list">
                                      <li data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Comments"><i class="fa-regular fa-comments"></i>5</li>
                                      <li data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Attachment"><i class="fa-solid fa-paperclip"></i>8</li>
                                      <li data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="View"><i class="fa-regular fa-eye"></i></i></li>
                                    </ul>
                                    <ul class="common-f-start">
                                      <li data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Marley Ford"><img class="img-30 common-circle" src="../assets/images/dashboard-11/user/3.jpg" alt="user"></li>
                                      <li data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Sarah Wilson"><img class="img-30 common-circle" src="../assets/images/dashboard-11/user/7.jpg" alt="user"></li>
                                      <li data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Jessica Anderson"><img class="img-30 common-circle" src="../assets/images/dashboard-11/user/8.jpg" alt="user"></li>
                                      <li data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="8+ More"> 
                                        <div class="common-circle bg-lighter-dark">8+</div>
                                      </li>
                                     </ul>
                                  </div></a>
                              `,
          },
          {
            title: `
                                 <a class="kanban-box" href="#"><span class="date">12/05/24</span><span class="badge badge-danger f-right">Urgent</span>
                                  <h6>Upcoming Meetings</h6>
                                  <div class="common-align"><img class="me-2 rounded-circle" src="../assets/images/dashboard-9/user/4.png" alt="">
                                    <div class="flex-grow-1">
                                      <p>Aurora Sterling</p>
                                    </div>
                                  </div>
                                  <div class="d-flex mt-3">
                                    <ul class="list">
                                      <li data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Comments"><i class="fa-regular fa-comments"></i>2</li>
                                      <li data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Attachment"><i class="fa-solid fa-paperclip"></i>4</li>
                                      <li data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="View"><i class="fa-regular fa-eye"></i></i></li>
                                    </ul>
                                    <ul class="common-f-start">
                                      <li data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Ford Stoll"><img class="img-30 common-circle" src="../assets/images/dashboard-11/user/9.jpg" alt="user"></li>
                                      <li data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Davis Jone"><img class="img-30 common-circle" src="../assets/images/dashboard-11/user/1.jpg" alt="user"></li>
                                      <li data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="6+ More"> 
                                        <div class="common-circle bg-lighter-dark">6+</div>
                                      </li>
                                     </ul>
                                  </div></a>
                              `,
          },
        ],
      },
      {
        id: "_doing",
        title: "In Progress",
        item: [
          {
            title: `
                                 <a class="kanban-box" href="#"><span class="date">28/06/24</span><span class="badge badge-danger f-right">Urgent</span>
                                  <h6>Issues to Fix</h6>
                                  <div class="common-align"><img class="me-2 rounded-circle" src="../assets/images/dashboard/user/12.jpg" alt="">
                                    <div class="flex-grow-1">
                                      <p>Juniper Ashford</p>
                                    </div>
                                  </div>
                                  <div class="d-flex mt-3">
                                    <ul class="list">
                                      <li data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Comments"><i class="fa-regular fa-comments"></i>1</li>
                                      <li data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Attachment"><i class="fa-solid fa-paperclip"></i>3</li>
                                      <li data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="View"><i class="fa-regular fa-eye"></i></i></li>
                                    </ul>
                                    <ul class="common-f-start">
                                      <li data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Davis Jone"><img class="img-30 common-circle" src="../assets/images/dashboard-11/user/12.jpg" alt="user"></li>
                                      <li data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Dashiell Wolfe"><img class="img-30 common-circle" src="../assets/images/dashboard-9/user/5.png" alt="user"></li>
                                      <li data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="4+ More"> 
                                        <div class="common-circle bg-lighter-dark">4+</div>
                                    </ul>
                                  </div></a>
                              `,
          },
          {
            title: `
                                 <a class="kanban-box" href="#"><span class="date">08/08/24</span><span class="badge badge-success f-right">Low</span>
                                  <h6>Emails to Send</h6>
                                  <div class="common-align"><img class="me-2 rounded-circle" src="../assets/images/dashboard/user/11.jpg" alt="">
                                    <div class="flex-grow-1">
                                      <p>Elowen Hartley</p>
                                    </div>
                                  </div>
                                  <div class="d-flex mt-3">
                                    <ul class="list">
                                      <li data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Comments"><i class="fa-regular fa-comments"></i>8</li>
                                      <li data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Attachment"><i class="fa-solid fa-paperclip"></i>2</li>
                                      <li data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="View"><i class="fa-regular fa-eye"></i></i></li>
                                    </ul>
                                    <ul class="common-f-start">
                                      <li data-bs-toggle="tooltip" data-bs-placement="top"
                                        data-bs-title="Elizabeth Davis"><img class="img-30 common-circle"
                                          src="../assets/images/avtar/3.jpg" alt="user"></li>
                                      <li data-bs-toggle="tooltip" data-bs-placement="top"
                                      data-bs-title="Oceana Meridian"><img class="img-30 common-circle"
                                        src="../assets/images/user/2.jpg" alt="user"></li>
                                      <li data-bs-toggle="tooltip" data-bs-placement="top"
                                        data-bs-title="5+ More">
                                        <div class="common-circle bg-lighter-dark">5+</div>
                                      </li>
                                  </ul>
                                  </div></a>
                              `,
          },
        ],
      },
      {
        id: "_done",
        title: "Completed",
        item: [
          {
            title: `
                                 <a class="kanban-box" href="#"><span class="date">14/09/24</span><span class="badge badge-danger f-right">Urgent</span>
                                  <h6>Code Review</h6>
                                  <div class="common-align"><img class="me-2 rounded-circle" src="../assets/images/dashboard/user/13.jpg">
                                    <div class="flex-grow-1">
                                      <p>Evander Whitman</p>
                                    </div>
                                  </div>
                                  <div class="d-flex mt-3">
                                    <ul class="list">
                                      <li data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Comments"><i class="fa-regular fa-comments"></i>6</li>
                                      <li data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Attachment"><i class="fa-solid fa-paperclip"></i>5</li>
                                      <li data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="View"><i class="fa-regular fa-eye"></i></i></li>
                                    </ul>
                                    <ul class="common-f-start">
                                    <li data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Levine Raven">
                                      <img class="img-30 common-circle" src="../assets/images/dashboard-11/user/2.jpg"
                                        alt="user">
                                    </li>
                                    <li data-bs-toggle="tooltip" data-bs-placement="top"
                                      data-bs-title="Charles Rodriguez"><img class="img-30 common-circle"
                                        src="../assets/images/dashboard-11/user/5.jpg" alt="user"></li>
                                    <li data-bs-toggle="tooltip" data-bs-placement="top"
                                      data-bs-title="Jessica Anderson"><img class="img-30 common-circle"
                                        src="../assets/images/dashboard-9/user/2.png" alt="user"></li>
                                    <li data-bs-toggle="tooltip" data-bs-placement="top"
                                    data-bs-title="6+ More">
                                    <div class="common-circle bg-lighter-dark">6+</div>
                                  </ul>
                                  </div></a>
                              `,
          },
          {
            title: `
                                 <a class="kanban-box" href="#"><span class="date">12/10/24</span><span class="badge badge-primary f-right">Medium</span>
                                  <h6>Bug Tracking</h6>
                                  <div class="common-align"><img class="me-2 rounded-circle" src="../assets/images/dashboard/user/4.jpg">
                                    <div class="flex-grow-1">
                                      <p>Peregrine Huxley</p>
                                    </div>
                                  </div>
                                  <div class="d-flex mt-3">
                                    <ul class="list">
                                      <li data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Comments"><i class="fa-regular fa-comments"></i>5</li>
                                      <li data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Attachment"><i class="fa-solid fa-paperclip"></i>8</li>
                                      <li data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="View"><i class="fa-regular fa-eye"></i></i></li>
                                    </ul>
                                    <ul class="common-f-start">
                                    <li data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Cassian Lockwood">
                                      <img class="img-30 common-circle" src="../assets/images/user/12.png" alt="user">
                                    </li>
                                        <li data-bs-toggle="tooltip" data-bs-placement="top"
                                        data-bs-title="Marigold Winslow"><img class="img-30 common-circle"
                                          src="../assets/images/user/10.jpg" alt="user"></li>
                                    </li>
                                    <li data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="7+ More">
                                      <div class="common-circle bg-lighter-dark">7+</div>
                                    </li>
                                  </ul>
                                  </div></a>
                              `,
          },
        ],
      },
    ],
  });

  var kanban2 = new jKanban({
    element: "#demo2",
    gutter: "15px",
    widthBoard: "450px",
    click: function (el) {
      console.log("Trigger on all items click!");
    },
    context: function (el, e) {
      console.log("Trigger on all items right-click!");
    },
    dropEl: function (el, target, source, sibling) {
      console.log(target.parentElement.getAttribute("data-id"));
      console.log(el, target, source, sibling);
    },
    buttonClick: function (el, boardId) {
      console.log(el);
      console.log(boardId);
      // create a form to enter element
      var formItem = document.createElement("form");
      formItem.setAttribute("class", "itemform");
      formItem.innerHTML = '<div class="form-group"><textarea class="form-control" rows="2" autofocus></textarea></div><div class="form-group"><button type="submit" class="btn btn-primary btn-sm me-2">Submit</button><button type="button" id="CancelBtn" class="btn button-light-primary btn-sm">Cancel</button></div>';

      kanban2.addForm(boardId, formItem);
      formItem.addEventListener("submit", function (e) {
        e.preventDefault();
        var text = e.target[0].value;
        kanban2.addElement(boardId, {
          title: text,
        });
        formItem.parentNode.removeChild(formItem);
      });
      document.getElementById("CancelBtn").onclick = function () {
        formItem.parentNode.removeChild(formItem);
      };
    },
    itemAddOptions: {
      enabled: true,
      content: "Add New Card",
      class: "btn",
      footer: true,
    },
    boards: [
      {
        id: "_in_review",
        title: "In Review (Item Only in Working)",
        class: "bg-primary",
        dragTo: ["_working"],
        item: [
          {
            title: `
                                 <a class="kanban-box" href="#"><span class="date">02/02/24</span><span class="badge badge-info f-right">Medium</span>
                                  <h6>Ticket Resolution</h6>
                                  <div class="common-align"><img class="me-2 rounded-circle" src="../assets/images/dashboard/user/1.jpg" alt="">
                                    <div class="flex-grow-1">
                                      <p>Alia Bond</p>
                                    </div>
                                  </div>
                                  <div class="d-flex mt-3">
                                    <ul class="list">
                                      <li data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Comments"><i class="fa-regular fa-comments"></i>5</li>
                                      <li data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Attachment"><i class="fa-solid fa-paperclip"></i>2</li>
                                      <li data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="View"><i class="fa-regular fa-eye"></i></i></li>
                                    </ul>
                                    <ul class="common-f-start">
                                      <li data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Alexis Taylor">
                                        <img class="img-30 common-circle" src="../assets/images/dashboard/user/10.jpg"
                                          alt="user">
                                      </li>
                                      <li data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Andrew Price">
                                        <img class="img-30 common-circle" src="../assets/images/dashboard/user/11.jpg"
                                          alt="user">
                                      </li>
                                      <li data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Emily Park">
                                        <div class="common-circle bg-lighter-dark">E</div>
                                      </li>
                                  </ul>
                                  </div></a>
                              `,
          },
          {
            title: `
                                 <a class="kanban-box" href="#"><span class="date">10/03/24</span><span class="badge badge-success f-right">Low</span>
                                  <h6>Performance Tuning</h6>
                                  <div class="common-align"><img class="me-2 rounded-circle" src="../assets/images/dashboard/user/2.jpg" alt="">
                                    <div class="flex-grow-1">
                                      <p>Josie Coffey</p>
                                    </div>
                                  </div>
                                  <div class="d-flex mt-3">
                                    <ul class="list">
                                      <li data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Comments"><i class="fa-regular fa-comments"></i>2</li>
                                      <li data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Attachment"><i class="fa-solid fa-paperclip"></i>9</li>
                                      <li data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="View"><i class="fa-regular fa-eye"></i></i></li>
                                    </ul>
                                    <ul class="common-f-start">
                                      <li data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Caleb Rivera">
                                        <img class="img-30 common-circle" src="../assets/images/dashboard/user/12.jpg"
                                          alt="user">
                                      </li>
                                      <li data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Olivia Gor"><img
                                          class="img-30 common-circle" src="../assets/images/dashboard/user/13.jpg"
                                          alt="user"></li>
                                      <li data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Avery Walls">
                                      <div class="common-circle bg-lighter-dark">A</div>
                                    </li>
                                  </ul>
                                  </div></a>
                              `,
          },
        ],
      },
      {
        id: "_pending",
        title: "Pending",
        class: "bg-secondary",
        item: [
          {
            title: `
                                 <a class="kanban-box" href="#"><span class="date">08/04/24</span><span class="badge badge-danger f-right">Urgent</span>
                                  <h6>Log Analysis</h6>
                                  <div class="common-align"><img class="me-2 rounded-circle" src="../assets/images/dashboard/user/7.jpg" alt="">
                                    <div class="flex-grow-1">
                                      <p>Tobias Murray</p>
                                    </div>
                                  </div>
                                  <div class="d-flex mt-3">
                                    <ul class="list">
                                      <li data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Comments"><i class="fa-regular fa-comments"></i>1</li>
                                      <li data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Attachment"><i class="fa-solid fa-paperclip"></i>4</li>
                                      <li data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="View"><i class="fa-regular fa-eye"></i></i></li>
                                    </ul>
                                    <ul class="common-f-start">
                                    <li data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Levine Raven">
                                      <img class="img-30 common-circle" src="../assets/images/dashboard-11/user/2.jpg"
                                        alt="user">
                                    </li>
                                    <li data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Dashiell Wolfe">
                                      <img class="img-30 common-circle" src="../assets/images/dashboard-9/user/5.png"
                                        alt="user">
                                    </li>
                                    <li data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="7+ More">
                                      <div class="common-circle bg-lighter-dark">7+</div>
                                    </li>
                                  </ul>
                                  </div></a>
                              `,
          },
          {
            title: `
                                 <a class="kanban-box" href="#"><span class="date">15/05/24</span><span class="badge badge-success f-right">Low</span>
                                  <h6>Database Maintenance</h6>
                                  <div class="common-align"><img class="me-2 rounded-circle" src="../assets/images/user/14.png" alt="">
                                    <div class="flex-grow-1">
                                      <p>Zavier Walter</p>
                                    </div>
                                  </div>
                                  <div class="d-flex mt-3">
                                    <ul class="list">
                                      <li data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Comments"><i class="fa-regular fa-comments"></i>2</li>
                                      <li data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Attachment"><i class="fa-solid fa-paperclip"></i>1</li>
                                      <li data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="View"><i class="fa-regular fa-eye"></i></i></li>
                                    </ul>
                                    <ul class="common-f-start">
                                    <li data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Thomas Jones">
                                      <img class="img-30 rounded-circle" src="../assets/images/dashboard-9/user/1.png"
                                        alt="user">
                                    </li>
                                    <li data-bs-toggle="tooltip" data-bs-placement="top"
                                    data-bs-title="Elizabeth Williams"><img class="img-30 rounded-circle"
                                    src="../assets/images/dashboard-9/user/3.png" alt="user"></li>
                                    <li data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Karen Jones">
                                      <div class="common-circle bg-lighter-dark">K</div>
                                    </li>
                                  </ul>
                                  </div></a>
                              `,
          },
        ],
      },
      {
        id: "_progress",
        title: "In Progress (Item Only in Working)",
        class: "bg-warning",
        dragTo: ["_working"],
        item: [
          {
            title: `
                                 <a class="kanban-box" href="#"><span class="date">27/10/24</span><span class="badge badge-danger f-right">Urgent</span>
                                  <h6>User Support</h6>
                                  <div class="common-align"><img class="me-2 rounded-circle" src="../assets/images/user/6.jpg" alt="">
                                    <div class="flex-grow-1">
                                      <p>Morgan Mathews</p>
                                    </div>
                                  </div>
                                  <div class="d-flex mt-3">
                                    <ul class="list">
                                      <li data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Comments"><i class="fa-regular fa-comments"></i>7</li>
                                      <li data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Attachment"><i class="fa-solid fa-paperclip"></i>3</li>
                                      <li data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="View"><i class="fa-regular fa-eye"></i></i></li>
                                    </ul>
                                    <ul class="common-f-start">
                                      <li data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Richard Taylor">
                                        <img class="img-30 common-circle" src="../assets/images/dashboard-11/user/1.jpg"
                                          alt="user">
                                      </li>
                                      <li data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Linda Brown">
                                        <div class="common-circle bg-lighter-danger">L</div>
                                      </li>
                                      <li data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="4+ More">
                                        <div class="common-circle bg-lighter-dark">4+</div>
                                      </li>
                                  </ul>
                                  </div></a>
                              `,
          },
          {
            title: `
                                 <a class="kanban-box" href="#"><span class="date">17/11/24</span><span class="badge badge-success f-right">Low</span>
                                  <h6>Software Updates</h6>
                                  <div class="common-align"><img class="me-2 rounded-circle" src="../assets/images/user/3.png" alt="">
                                    <div class="flex-grow-1">
                                      <p>Kehlani Soto</p>
                                    </div>
                                  </div>
                                  <div class="d-flex mt-3">
                                    <ul class="list">
                                      <li data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Comments"><i class="fa-regular fa-comments"></i>9</li>
                                      <li data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Attachment"><i class="fa-solid fa-paperclip"></i>2</li>
                                      <li data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="View"><i class="fa-regular fa-eye"></i></i></li>
                                    </ul>
                                    <ul class="common-f-start">
                                      <li data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Marley Ford">
                                        <img class="img-30 common-circle" src="../assets/images/dashboard-11/user/10.jpg"
                                          alt="user">
                                      </li>
                                      <li data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Gray Curran">
                                        <img class="img-30 common-circle" src="../assets/images/dashboard-11/user/9.jpg"
                                          alt="user">
                                      </li>
                                      <li data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="5+ More">
                                        <div class="common-circle bg-lighter-dark">5+</div>
                                      </li>
                                  </ul>
                                  </div></a>
                              `,
          },
        ],
      },
      {
        id: "_completed",
        title: "Completed",
        class: "bg-success",
        dragTo: ["_working"],
        item: [
          {
            title: `
                                 <a class="kanban-box" href="#"><span class="date">02/05/24</span><span class="badge badge-info f-right">Medium</span>
                                  <h6>Installing Software</h6>
                                  <div class="common-align"><img class="me-2 rounded-circle" src="../assets/images/user/14.png" alt="">
                                    <div class="flex-grow-1">
                                      <p>Yusuf Houston</p>
                                    </div>
                                  </div>
                                  <div class="d-flex mt-3">
                                    <ul class="list">
                                      <li data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Comments"><i class="fa-regular fa-comments"></i>3</li>
                                      <li data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Attachment"><i class="fa-solid fa-paperclip"></i>1</li>
                                      <li data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="View"><i class="fa-regular fa-eye"></i></i></li>
                                    </ul>
                                    <ul class="common-f-start">
                                      <li data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Callie Khan">
                                          <div class="common-circle bg-lighter-warning">C</div>
                                      </li>
                                      <li data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Leif Hess">
                                        <img class="img-30 common-circle" src="../assets/images/user/common-user/3.png"
                                          alt="user">
                                      </li>
                                      <li data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="6+ More">
                                        <div class="common-circle bg-lighter-dark">6+</div>
                                      </li>
                                  </ul>
                                  </div></a>
                              `,
          },
          {
            title: `
                                 <a class="kanban-box" href="#"><span class="date">02/02/24</span><span class="badge badge-danger f-right">Urgent</span>
                                  <h6>Testing</h6>
                                  <div class="common-align"><img class="me-2 rounded-circle" src="../assets/images/dashboard-9/user/4.png" alt="">
                                    <div class="flex-grow-1">
                                      <p>Mia McKinney</p>
                                    </div>
                                  </div>
                                  <div class="d-flex mt-3">
                                    <ul class="list">
                                      <li data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Comments"><i class="fa-regular fa-comments"></i>7</li>
                                      <li data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Attachment"><i class="fa-solid fa-paperclip"></i>2</li>
                                      <li data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="View"><i class="fa-regular fa-eye"></i></i></li>
                                    </ul>
                                    <ul class="common-f-start">
                                      <li data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Elliott Reilly">
                                        <img class="img-30 common-circle" src="../assets/images/dashboard-9/user/1.png"
                                          alt="user">
                                      </li>
                                      <li data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Keira Blair">
                                        <img class="img-30 common-circle" src="../assets/images/dashboard-9/user/2.png"
                                          alt="user">
                                      </li>
                                      <li data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="5+ More">
                                        <div class="common-circle bg-lighter-dark">5+</div>
                                      </li>
                                  </ul>
                                  </div></a>
                              `,
          },
        ],
      },
    ],
  });

  var kanban3 = new jKanban({
    element: "#demo3",
    gutter: "15px",
    widthBoard: "450px",
    click: function (el) {
      console.log("Trigger on all items click!");
    },
    context: function (el, e) {
      console.log("Trigger on all items right-click!");
    },
    dropEl: function (el, target, source, sibling) {
      console.log(target.parentElement.getAttribute("data-id"));
      console.log(el, target, source, sibling);
    },
    buttonClick: function (el, boardId) {
      console.log(el);
      console.log(boardId);
      // create a form to enter element
      var formItem = document.createElement("form");
      formItem.setAttribute("class", "itemform");
      formItem.innerHTML = '<div class="form-group"><textarea class="form-control" rows="2" autofocus></textarea></div><div class="form-group"><button type="submit" class="btn btn-primary btn-sm me-2">Submit</button><button type="button" id="CancelBtn" class="btn button-light-primary btn-sm">Cancel</button></div>';

      kanban3.addForm(boardId, formItem);
      formItem.addEventListener("submit", function (e) {
        e.preventDefault();
        var text = e.target[0].value;
        kanban3.addElement(boardId, {
          title: text,
        });
        formItem.parentNode.removeChild(formItem);
      });
      document.getElementById("CancelBtn").onclick = function () {
        formItem.parentNode.removeChild(formItem);
      };
    },
    itemAddOptions: {
      enabled: true,
      content: "Add New Card",
      class: "btn",
      footer: true,
    },
    boards: [
      {
        id: "_review",
        title: "In Review",
        class: "info",
        item: [
          {
            id: "_test_delete",
            title: `
                                 <a class="kanban-box" href="#"><span class="date">30/01/24</span><span class="badge badge-danger f-right">Urgent</span>
                                  <h6>Configure VPN</h6>
                                  <div class="common-align"><img class="me-2 rounded-circle" src="../assets/images/dashboard-11/user/2.jpg" alt="">
                                    <div class="flex-grow-1">
                                      <p>Eva Duke</p>
                                    </div>
                                  </div>
                                  <div class="d-flex mt-3">
                                    <ul class="list">
                                      <li data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Comments"><i class="fa-regular fa-comments"></i>2</li>
                                      <li data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Attachment"><i class="fa-solid fa-paperclip"></i>7</li>
                                      <li data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="View"><i class="fa-regular fa-eye"></i></i></li>
                                    </ul>
                                    <ul class="common-f-start">
                                      <li data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Andrew Price">
                                        <img class="img-30 common-circle" src="../assets/images/user/common-user/1.png"
                                          alt="user">
                                      </li>
                                      <li data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Kye Davidson"><img
                                          class="img-30 common-circle" src="../assets/images/user/common-user/7.png"
                                          alt="user"></li>
                                      <li data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="3+ More">
                                        <div class="common-circle bg-lighter-dark">3+</div>
                                      </li>
                                  </ul>
                                  </div></a>
                              `,
          },
          {
            title: `
                                 <a class="kanban-box" href="#"><span class="date">18/07/24</span><span class="badge badge-danger f-right">Urgent</span>
                                  <h6>Docker Maintain</h6>
                                  <div class="common-align"><img class="me-2 rounded-circle" src="../assets/images/user/12.png" alt="">
                                    <div class="flex-grow-1">
                                      <p>Jaylen Michael</p>
                                    </div>
                                  </div>
                                  <div class="d-flex mt-3">
                                    <ul class="list">
                                      <li data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Comments"><i class="fa-regular fa-comments"></i>6</li>
                                      <li data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Attachment"><i class="fa-solid fa-paperclip"></i>9</li>
                                      <li data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="View"><i class="fa-regular fa-eye"></i></i></li>
                                    </ul>
                                    <ul class="common-f-start">
                                    <li data-bs-toggle="tooltip" data-bs-placement="top"
                                    data-bs-title="Walker Davis"><img class="img-30 common-circle"
                                    src="../assets/images/user/common-user/8.png" alt="user"></li>
                                    <li data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="4+ More">
                                      <div class="common-circle bg-lighter-dark">4+</div>
                                    </li>
                                  </ul>
                                  </div></a>
                              `,
          },
        ],
      },
      {
        id: "_pending",
        title: "Pending",
        class: "info",
        item: [
          {
            id: "_test_delete",
            title: `
                                 <a class="kanban-box" href="#"><span class="date">01/04/24</span><span class="badge badge-danger f-right">Urgent</span>
                                  <h6>User Support</h6>
                                  <div class="common-align"><img class="me-2 rounded-circle" src="../assets/images/dashboard-11/user/8.jpg" alt="">
                                    <div class="flex-grow-1">
                                      <p>Leila McDowell</p>
                                    </div>
                                  </div>
                                  <div class="d-flex mt-3">
                                    <ul class="list">
                                      <li data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Comments"><i class="fa-regular fa-comments"></i>5</li>
                                      <li data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Attachment"><i class="fa-solid fa-paperclip"></i>8</li>
                                      <li data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="View"><i class="fa-regular fa-eye"></i></i></li>
                                    </ul>
                                    <ul class="common-f-start">
                                      <li data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Jenny Wilson">
                                        <img class="img-30 common-circle" src="../assets/images/dashboard/user/3.jpg"
                                          alt="user">
                                      </li>
                                      <li data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Andrew Price">
                                        <img class="img-30 common-circle" src="../assets/images/dashboard/user/11.jpg"
                                          alt="user">
                                      </li>
                                      <li data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Kye Davidson                                    "><img
                                          class="img-30 common-circle" src="../assets/images/dashboard/user/13.jpg"
                                          alt="user"></li>
                                      <li data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="5+ More">
                                        <div class="common-circle bg-lighter-dark">5+</div>
                                      </li>
                                  </ul>
                                  </div></a>
                              `,
          },
          {
            title: `
                                 <a class="kanban-box" href="#"><span class="date">14/04/24</span><span class="badge badge-danger f-right">Urgent</span>
                                  <h6>Project Planning</h6>
                                  <div class="common-align"><img class="me-2 rounded-circle" src="../assets/images/dashboard-11/user/7.jpg" alt="" data-original-title="" title="">
                                    <div class="flex-grow-1">
                                      <p>Jeffery Hurley</p>
                                    </div>
                                  </div>
                                  <div class="d-flex mt-3">
                                    <ul class="list">
                                      <li data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Comments"><i class="fa-regular fa-comments"></i>5</li>
                                      <li data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Attachment"><i class="fa-solid fa-paperclip"></i>8</li>
                                      <li data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="View"><i class="fa-regular fa-eye"></i></i></li>
                                    </ul>
                                    <ul class="common-f-start">
                                    <li data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Sarah Wilson">
                                      <img class="img-30 common-circle" src="../assets/images/dashboard-11/user/2.jpg"
                                        alt="user">
                                    </li>
                                    <li data-bs-toggle="tooltip" data-bs-placement="top"
                                    data-bs-title="Jessica Anderson"><img class="img-30 common-circle"
                                    src="../assets/images/dashboard-11/user/8.jpg" alt="user"></li>
                                    <li data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="4+ More">
                                      <div class="common-circle bg-lighter-dark">4+</div>
                                    </li>
                                  </ul>
                                  </div></a>
                              `,
          },
        ],
      },
      {
        id: "_progress",
        title: "In Progress",
        class: "warning",
        item: [
          {
            title: `
                                 <a class="kanban-box" href="#"><span class="date">19/06/24</span><span class="badge badge-danger f-right">Urgent</span>
                                  <img class="mt-2 img-fluid" src="../assets/images/other-images/maintenance-bg.jpg" alt="" data-original-title="" title="">
                                  <h6>Security Check</h6>
                                  <div class="common-align"><img class="me-2 rounded-circle" src="../assets/images/dashboard-11/user/1.jpg" alt="">
                                    <div class="flex-grow-1">
                                      <p>Bobby Robertson</p>
                                    </div>
                                  </div>
                                  <div class="d-flex mt-3">
                                    <ul class="list">
                                      <li data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Comments"><i class="fa-regular fa-comments"></i>5</li>
                                      <li data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Attachment"><i class="fa-solid fa-paperclip"></i>8</li>
                                      <li data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="View"><i class="fa-regular fa-eye"></i></i></li>
                                    </ul>
                                    <ul class="common-f-start">
                                      <li data-bs-toggle="tooltip" data-bs-placement="top"
                                        data-bs-title="Seraphina Evergreen">
                                        <div class="common-circle bg-lighter-warning">S</div>
                                      </li>
                                      <li data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Calista Rivers">
                                        <img class="img-30 common-circle" src="../assets/images/dashboard/user/3.jpg"
                                          alt="user">
                                      </li>
                                      <li data-bs-toggle="tooltip" data-bs-placement="top"
                                        data-bs-title="7+ More">
                                        <div class="common-circle bg-lighter-dark">7+</div>
                                      </li>
                                  </ul>
                                  </div></a>
                              `,
          },
          {
            title: `
                                 <a class="kanban-box" href="#"><span class="date">27/07/24</span><span class="badge badge-danger f-right">Urgent</span>
                                  <h6>Email Management</h6>
                                  <div class="common-align"><img class="me-2 rounded-circle" src="../assets/images/dashboard-11/user/9.jpg" alt="">
                                    <div class="flex-grow-1">
                                      <p>Wren Morrison</p>
                                    </div>
                                  </div>
                                  <div class="d-flex mt-3">
                                    <ul class="list">
                                      <li data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Comments"><i class="fa-regular fa-comments"></i>5</li>
                                      <li data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Attachment"><i class="fa-solid fa-paperclip"></i>8</li>
                                      <li data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="View"><i class="fa-regular fa-eye"></i></i></li>
                                    </ul>
                                    <ul class="common-f-start">
                                      <li data-bs-toggle="tooltip" data-bs-placement="top"
                                        data-bs-title="Charles Rodriguez"><img class="img-30 common-circle"
                                          src="../assets/images/dashboard-11/user/5.jpg" alt="user"></li>
                                          <li data-bs-toggle="tooltip" data-bs-placement="top"
                                          data-bs-title="Sarah Hernandez"><img class="img-30 common-circle"
                                          src="../assets/images/dashboard-11/user/6.jpg" alt="user"></li>
                                          <li data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="3+ More">
                                            <div class="common-circle bg-lighter-dark">3+</div>
                                          </li>
                                  </ul>
                                  </div></a>
                              `,
          },
        ],
      },
      {
        id: "_completed",
        title: "Completed",
        class: "success",
        item: [
          {
            title: `
                                 <a class="kanban-box" href="#"><span class="date">18/08/24</span><span class="badge badge-danger f-right">Urgent</span>
                                  <h6>Capacity Planning</h6>
                                  <div class="common-align"><img class="me-2 rounded-circle" src="../assets/images/dashboard-11/user/11.jpg" alt="" data-original-title="" title="">
                                    <div class="flex-grow-1">
                                      <p>Maria Wheeler</p>
                                    </div>
                                  </div>
                                  <div class="d-flex mt-3">
                                    <ul class="list">
                                      <li data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Comments"><i class="fa-regular fa-comments"></i>5</li>
                                      <li data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Attachment"><i class="fa-solid fa-paperclip"></i>8</li>
                                      <li data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="View"><i class="fa-regular fa-eye"></i></i></li>
                                    </ul>
                                    <ul class="common-f-start">
                                      <li data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Joseph Garcia">
                                        <img class="img-30 common-circle" src="../assets/images/avtar/16.jpg" alt="user">
                                      </li>
                                      <li data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Karen Moore">
                                        <div class="common-circle bg-lighter-warning">K</div>
                                      </li>
                                      <li data-bs-toggle="tooltip" data-bs-placement="top"
                                        data-bs-title="Robert Williams">
                                        <div class="common-circle bg-lighter-danger">R</div>
                                      </li>
                                      <li data-bs-toggle="tooltip" data-bs-placement="top"
                                        data-bs-title="6+ More">
                                        <div class="common-circle bg-lighter-dark">6+</div>
                                      </li>
                                  </ul>
                                  </div></a>
                              `,
          },
          {
            title: `
                                 <a class="kanban-box" href="#"><span class="date">29/09/24</span><span class="badge badge-danger f-right">Urgent</span>
                                  <img class="mt-2 img-fluid" src="../assets/images/other-images/sidebar-bg.jpg" alt="" data-original-title="" title="">
                                  <h6>Minify Images</h6>
                                  <div class="common-align"><img class="me-2 rounded-circle" src="../assets/images/dashboard-11/user/3.jpg" alt="">
                                    <div class="flex-grow-1">
                                      <p>Regina Pratt</p>
                                    </div>
                                  </div>
                                  <div class="d-flex mt-3">
                                    <ul class="list">
                                      <li data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Comments"><i class="fa-regular fa-comments"></i>5</li>
                                      <li data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Attachment"><i class="fa-solid fa-paperclip"></i>8</li>
                                      <li data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="View"><i class="fa-regular fa-eye"></i></i></li>
                                    </ul>
                                    <ul class="common-f-start">
                                      <li data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Richard Taylor">
                                        <img class="img-30 common-circle" src="../assets/images/dashboard-11/user/1.jpg"
                                          alt="user">
                                      </li>
                                      <li data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Linda Brown">
                                        <div class="common-circle bg-lighter-info">L</div>
                                      </li>
                                      <li data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="6+ More">
                                        <div class="common-circle bg-lighter-dark">6+</div>
                                      </li>
                                  </ul>
                                  </div></a>
                              `,
          },
        ],
      },
    ],
  });

  var toDoButton = document.getElementById("addToDo");
  toDoButton.addEventListener("click", function () {
    kanban3.addElement("_review", {
      title: `
                                 <a class="kanban-box" href="#"><span class="date">14/05/24</span><span class="badge badge-danger f-right">Urgent</span>
                                  <img class="mt-2 img-fluid" src="../assets/images/other-images/mountain.jpg" alt="">
                                  <h6>Minify Images</h6>
                                  <div class="common-align"><img class="me-2 rounded-circle" src="../assets/images/dashboard-11/user/7.jpg" alt="">
                                    <div class="flex-grow-1">
                                      <p>Clayton Wilkins</p>
                                    </div>
                                  </div>
                                  <div class="d-flex mt-3">
                                    <ul class="list">
                                      <li data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Comments"><i class="fa-regular fa-comments"></i>5</li>
                                      <li data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Attachment"><i class="fa-solid fa-paperclip"></i>8</li>
                                      <li data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="View"><i class="fa-regular fa-eye"></i></i></li>
                                    </ul>
                                    <ul class="common-f-start">
                                      <li data-bs-toggle="tooltip" data-bs-placement="top"
                                        data-bs-title="Jasper Nightingale"><img class="img-30 common-circle"
                                          src="../assets/images/dashboard/user/4.jpg" alt="user"></li>
                                      <li data-bs-toggle="tooltip" data-bs-placement="top"
                                        data-bs-title="Oceana Meridian"><img class="img-30 common-circle"
                                          src="../assets/images/user/10.jpg" alt="user"></li>
                                      <li data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="3+ More">
                                        <div class="common-circle bg-lighter-dark">3+</div>
                                      </li>
                                  </ul>
                                  </div></a>
                              `,
    });
  });

  var addBoardDefault = document.getElementById("addDefault");
  addBoardDefault.addEventListener("click", function () {
    kanban3.addBoards([
      {
        id: "_default",
        title: "Kanban Default",
        item: [
          {
            title: `
                                 <a class="kanban-box" href="#"><span class="date">12/06/24</span><span class="badge badge-danger f-right">Urgent</span>
                                  <h6>VPN Setup</h6>
                                  <div class="common-align"><img class="me-2 rounded-circle" src="../assets/images/dashboard-11/user/10.jpg" alt="">
                                    <div class="flex-grow-1">
                                      <p>Max Melton</p>
                                    </div>
                                  </div>
                                  <div class="d-flex mt-3">
                                    <ul class="list">
                                      <li data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Comments"><i class="fa-regular fa-comments"></i>5</li>
                                      <li data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Attachment"><i class="fa-solid fa-paperclip"></i>8</li>
                                      <li data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="View"><i class="fa-regular fa-eye"></i></i></li>
                                    </ul>
                                    <ul class="common-f-start">
                                      <li data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Calista Rivers">
                                        <img class="img-30 common-circle" src="../assets/images/dashboard/user/3.jpg"
                                          alt="user">
                                      </li>
                                      <li data-bs-toggle="tooltip" data-bs-placement="top"
                                        data-bs-title="Jasper Nightingale"><img class="img-30 common-circle"
                                          src="../assets/images/dashboard/user/4.jpg" alt="user"></li>
                                      <li data-bs-toggle="tooltip" data-bs-placement="top"
                                        data-bs-title="Seraphina Evergreen">
                                        <div class="common-circle bg-lighter-primary">S</div>
                                      </li>
                                      <li data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Caspian Wilde">
                                        <img class="img-30 common-circle" src="../assets/images/dashboard/user/5.jpg"
                                          alt="user">
                                      </li>
                                  </ul>
                                  </div></a>
                              `,
          },

          {
            title: `
                                 <a class="kanban-box" href="#"><span class="date">20/08/24</span><span class="badge badge-danger f-right">Urgent</span>
                                  <img class="mt-2 img-fluid" src="../assets/images/other-images/maintenance-bg.jpg" alt="">
                                  <h6>Audits</h6>
                                  <div class="common-align"><img class="me-2 rounded-circle" src="../assets/images/dashboard-11/user/12.jpg" alt="">
                                    <div class="flex-grow-1">
                                      <p>Elliot Gallegos</p>
                                    </div>
                                  </div>
                                  <div class="d-flex mt-3">
                                    <ul class="list">
                                      <li data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Comments"><i class="fa-regular fa-comments"></i>5</li>
                                      <li data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Attachment"><i class="fa-solid fa-paperclip"></i>8</li>
                                      <li data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="View"><i class="fa-regular fa-eye"></i></i></li>
                                    </ul>
                                    <ul class="common-f-start">
                                      <li data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Andrew Price">
                                        <img class="img-30 common-circle" src="../assets/images/dashboard/user/11.jpg"
                                          alt="user">
                                      </li>
                                      <li data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Caryl Kauth">
                                        <img class="img-30 common-circle" src="../assets/images/dashboard/user/1.jpg"
                                          alt="user">
                                      </li>
                                      <li data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="4+ More">
                                        <div class="common-circle bg-lighter-dark">4+</div>
                                    </li>
                                  </ul>
                                  </div></a>
                              `,
          },
        ],
      },
    ]);
  });

  var toDoButtonAtPosition = document.getElementById("addToDoAtPosition");
  toDoButtonAtPosition.addEventListener("click", function () {
    kanban3.addElement(
      "_review",
      {
        title: `
        <a class="kanban-box" href="#"><span class="date">05/02/24</span><span class="badge badge-danger f-right">Urgent</span>
         <h6>User Support</h6>
         <div class="common-align"><img class="me-2 rounded-circle" src="../assets/images/dashboard/user/10.jpg" alt="">
           <div class="flex-grow-1">
             <p>Crystal Flores</p>
           </div>
         </div>
         <div class="d-flex mt-3">
           <ul class="list">
             <li data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Comments"><i class="fa-regular fa-comments"></i>5</li>
             <li data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Attachment"><i class="fa-solid fa-paperclip"></i>8</li>
             <li data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="View"><i class="fa-regular fa-eye"></i></i></li>
           </ul>
           <ul class="common-f-start">
            <li data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Emily Park">
              <div class="common-circle bg-lighter-warning">E</div>
            </li>
            <li data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Caryl Kauth">
              <img class="img-30 common-circle" src="../assets/images/dashboard/user/1.jpg"
                alt="user">
            </li>
            <li data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="4+ More">
            <div class="common-circle bg-lighter-dark">4+</div>
          </li>
          </ul>
         </div></a>
     `,
      },
      1
    );
  });

  var removeElement = document.getElementById("removeElement");
  removeElement.addEventListener("click", function () {
    kanban3.removeElement("_test_delete");
  });

  var removeBoard = document.getElementById("removeBoard");
  removeBoard.addEventListener("click", function () {
    kanban3.removeBoard("_progress");
  });

  var allEle = kanban3.getBoardElements("_review");
  allEle.forEach(function (item, index) {});
})();
