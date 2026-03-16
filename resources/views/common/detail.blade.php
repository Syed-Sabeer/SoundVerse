@extends('layouts.app.master')

@section('title', 'Dashboard')

@section('css')
@endsection

@section('content')



          <div class="container-fluid">
            <div class="page-title">
              <div class="row">
                <div class="col-sm-6">
                  <h3>User Profile</h3>
                </div>
                <div class="col-sm-6">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">                                       
                        <svg class="stroke-icon">
                          <use href="../assets/svg/icon-sprite.svg#stroke-home"></use>
                        </svg></a></li>
                    <li class="breadcrumb-item">Users</li>
                    <li class="breadcrumb-item active">User Profile</li>
                  </ol>
                </div>
              </div>
            </div>
          </div>
          <!-- Container-fluid starts-->
          <div class="container-fluid">
            <div class="user-profile">
              <div class="row">
                <!-- user profile first-style start-->
                <div class="col-sm-12">
                  <div class="card hovercard text-center common-user-image">
                    <div class="cardheader">
                      <div class="user-image">
                        <div class="avatar">
                          <div class="common-align">
                            <div><img id="output" src="../assets/images/dashboard-11/user/12.jpg" alt="Profile Image">
                              <input type="file" accept="image/*" onchange="loadFile(event)">
                              <div class="icon-wrapper" id="cancelButton"><i class="icofont icofont-error"></i></div>
                              <div class="icon-wrapper"><i class="icofont icofont-pencil-alt-5"></i></div>
                            </div>
                            <div class="user-designation"><a target="_blank" href="">William C. Jennings</a>
                              <div class="desc">Designer</div>
                            </div>
                          </div>
                          <div class="follow">
                            <div>
                              <div class="follow-num counter" data-target="258690">0</div><span>Follower</span>
                            </div>
                            <div>
                              <div class="follow-num counter" data-target="659887">0</div><span>Following</span>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- user profile first-style end-->
                <div class="col-12">
                  <div class="card user-bio"> 
                    <div class="card-body">
                      <div class="row g-3">
                        <div class="col-12">
                          <div class="ttl-info text-start">
                            <h6> <i class="fa-solid fa-user-tie pe-2"></i> Bio</h6><span class="mb-sm-3">Over five years of experience creating visually attractive and user-friendly websites has given me a passion for creating unique and creative websites. skilled in fusing cutting-edge online technologies with beautiful design concepts to create amazing user experiences. robust history in front-end development, UI/UX, and graphic design. highly skilled at solving problems, has a keen eye for detail, and can collaborate with others in a hectic setting.</span>
                          </div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-6">
                          <div class="ttl-info text-start">
                            <h6><i class="fa-solid fa-envelope pe-2"></i> Email</h6><span>william@jourrapide.com</span>
                          </div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-6">
                          <div class="ttl-info text-start">
                            <h6><i class="fa-solid fa-calendar-days pe-2"></i>Birthday Date</h6><span>02 January 2000</span>
                          </div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-6">
                          <div class="ttl-info text-start">
                            <h6><i class="fa-solid fa-phone pe-2"></i>Contact Us</h6><span>India +91 123-456-7890</span>
                          </div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-6">
                          <div class="ttl-info text-start pb-0">
                            <h6><i class="fa-solid fa-location-arrow pe-2"></i>Location</h6><span>B69 Libby Street Beverly Hills</span>
                          </div>
                        </div>
                        <div class="col-12">
                          <div class="common-flex justify-content-center">
                            <div class="social-media" data-intro="This is your social details">
                              <ul class="list-inline">
                                <li class="list-inline-item" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Facebook"><a href="https://www.facebook.com/" target="_blank"><i class="fa-brands fa-facebook-f"></i></a></li>
                                <li class="list-inline-item" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Google+"><a href="https://accounts.google.com/" target="_blank"><i class="fa-brands fa-google-plus-g"></i></a></li>
                                <li class="list-inline-item" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="X (Twitter)"><a href="https://twitter.com/" target="_blank"><i class="fa-brands fa-x-twitter"></i></a></li>
                                <li class="list-inline-item" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Instagram"><a href="https://www.instagram.com/" target="_blank"><i class="fa-brands fa-instagram"></i></a></li>
                                <li class="list-inline-item" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="RSS"><a href="https://rss.app/" target="_blank"><i class="fa-solid fa-share-nodes"></i></a></li>
                              </ul>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- user profile menu start-->
                <div class="col-12"> 
                  <div class="row scope-bottom-wrapper user-profile-wrapper">
                    <div class="col-xxl-3 user-xl-25 col-xl-4 box-col-4">
                      <div class="card"> 
                        <div class="card-body">
                          <ul class="sidebar-left-icons nav nav-pills" id="add-product-pills-tab" role="tablist">
                            <li class="nav-item"> <a class="nav-link active" id="target-project-tab" data-bs-toggle="pill" href="#target-project" role="tab" aria-controls="target-project" aria-selected="false"> 
                                <div class="nav-rounded">
                                  <div class="product-icons"><i class="fa-solid fa-timeline"></i></div>
                                </div>
                                <div class="product-tab-content">
                                  <h6>Recent Activity</h6>
                                </div></a></li>
                            <li class="nav-item"> <a class="nav-link" id="budget-project-tab" data-bs-toggle="pill" href="#budget-project" role="tab" aria-controls="budget-project" aria-selected="false"> 
                                <div class="nav-rounded">
                                  <div class="product-icons"><i class="fa-solid fa-list-check"></i></div>
                                </div>
                                <div class="product-tab-content">
                                  <h6>Tasks</h6>
                                </div></a></li>
                            <li class="nav-item"><a class="nav-link" id="team-project-tab" data-bs-toggle="pill" href="#team-project" role="tab" aria-controls="team-project" aria-selected="false"> 
                                <div class="nav-rounded">
                                  <div class="product-icons"><i class="fa-regular fa-bell"></i></div>
                                </div>
                                <div class="product-tab-content">
                                  <h6>Notifications</h6>
                                </div></a></li>
                            <li class="nav-item"><a class="nav-link" id="attachment-tab" data-bs-toggle="pill" href="#attachment" role="tab" aria-controls="attachment" aria-selected="false"> 
                                <div class="nav-rounded">
                                  <div class="product-icons"><i class="fa-solid fa-gears"></i></div>
                                </div>
                                <div class="product-tab-content">
                                  <h6>Settings</h6>
                                </div></a></li>
                          </ul>
                        </div>
                      </div>
                    </div>
                    <div class="col-xxl-9 user-xl-75 col-xl-8 box-col-8e">
                      <div class="row"> 
                        <div class="col-12"> 
                          <div class="tab-content" id="add-product-pills-tabContent">
                            <div class="tab-pane fade show active" id="target-project" role="tabpanel" aria-labelledby="target-project-tab">
                              <div class="notification">
                                <div class="card">
                                  <div class="card-header">
                                    <h5>Recent Activity</h5>
                                  </div>
                                  <div class="card-body dark-timeline">
                                    <ul> 
                                      <li class="d-flex">
                                        <div class="activity-dot-primary"></div>
                                        <div class="w-100 ms-3">
                                          <p class="d-flex justify-content-between mb-2"><span class="date-content light-background">12th Feb, 2024 </span><span>Today</span></p>
                                          <h6>Freelance Project Discussion<span class="dot-notification"></span></h6><span class="c-o-light">worked hard with the client to make sure the design reflects their objectives and brand identity.</span><span class="c-o-light">Optimised the website for quicker loads by implementing a responsive layout.</span>
                                        </div>
                                      </li>
                                      <li class="d-flex">
                                        <div class="activity-dot-warning"></div>
                                        <div class="w-100 ms-3">
                                          <p class="d-flex justify-content-between mb-2"><span class="date-content light-background">12th Feb, 2024 </span><span>02:00 PM</span></p>
                                          <h6>Brand Collaboration<span class="dot-notification"></span></h6><span class="c-o-light">improved the user experience by using a sleek, contemporary style that matches the brand's urban, smart look.</span><span class="c-o-light">Multimedia components, including infographic and films, were used to improve user interaction and communicate the campaign's impact.</span>
                                          <div class="recent-images"> 
                                            <ul> 
                                              <li> 
                                                <div class="recent-img-wrap"><img src="../assets/images/dashboard-2/order/sub-product/4.png" alt="chair"></div>
                                              </li>
                                              <li> 
                                                <div class="recent-img-wrap"><img src="../assets/images/dashboard-2/order/sub-product/8.png" alt="neckless"></div>
                                              </li>
                                              <li> 
                                                <div class="recent-img-wrap"><img src="../assets/images/dashboard-2/order/sub-product/11.png" alt="slipper"></div>
                                              </li>
                                              <li> 
                                                <div class="recent-img-wrap"><img src="../assets/images/dashboard-2/order/sub-product/7.png" alt="earings"></div>
                                              </li>
                                              <li> 
                                                <div class="recent-img-wrap"><img src="../assets/images/dashboard-2/order/sub-product/3.png" alt="men t-shirt"></div>
                                              </li>
                                              <li> 
                                                <div class="recent-img-wrap"><img src="../assets/images/dashboard-2/order/sub-product/9.png" alt="men shorts"></div>
                                              </li>
                                            </ul>
                                          </div>
                                        </div>
                                      </li>
                                      <li class="d-flex">
                                        <div class="activity-dot-primary"></div>
                                        <div class="w-100 ms-3">
                                          <p class="d-flex justify-content-between mb-2"><span class="date-content light-background">08th Feb, 2024 </span><span>5 days ago</span></p>
                                          <h6>Review of Project and Milestones<span class="dot-notification"></span></h6><span class="c-o-light">Having the objective of developing an aesthetically attractive and intuitive e-commerce platform for "Multikart and Fastkart."</span><span class="c-o-light">This entails being aware of the target market, the brand's goal, and the particular features that the website must have.</span>
                                        </div>
                                      </li>
                                      <li class="d-flex">
                                        <div class="activity-dot-warning"></div>
                                        <div class="w-100 ms-3">
                                          <p class="d-flex justify-content-between mb-2"><span class="date-content light-background">05th Feb, 2024 </span><span>8 days ago</span></p>
                                          <h6>Wireframing Designs<span class="dot-notification"></span></h6><span class="c-o-light mb-1">Any type of group project could have a central idea. Transfer information using the theme so that members of your team can comprehend it.</span>
                                          <div class="project-teammate">
                                            <ul class="common-f-start">
                                              <li data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Sarah Wilson"><img class="common-circle" src="../assets/images/dashboard-11/user/11.jpg" alt="user"></li>
                                              <li data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Richard Taylor"><img class="common-circle" src="../assets/images/dashboard-11/user/9.jpg" alt="user"></li>
                                              <li data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Manuel Gilmore"> 
                                                <div class="common-circle bg-lighter-secondary">M</div>
                                              </li>
                                              <li data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Jessica Anderson"><img class="common-circle" src="../assets/images/dashboard-11/user/3.jpg" alt="user"></li>
                                              <li data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="9+ More">
                                                <div class="common-circle bg-lighter-primary">9+</div>
                                              </li>
                                            </ul>
                                          </div>
                                        </div>
                                      </li>
                                    </ul>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="tab-pane fade" id="budget-project" role="tabpanel" aria-labelledby="budget-project-tab">
                              <div class="card">
                                <div class="card-header">
                                  <h5>Tasks</h5>
                                </div>
                                <div class="card-body projects-wrapper">
                                  <div class="row g-4">
                                    <div class="col-xxl-4 col-md-6 box-col-6 xl-50">
                                      <div class="progress-project-box">
                                        <div class="list-box title-line-primary">
                                          <div class="header-top"><span class="badge badge-light-primary">Pending</span>
                                            <p class="mb-0 c-o-light"> 
                                              <svg class="me-2"> 
                                                <use href="../assets/svg/icon-sprite.svg#vector-calendar"></use>
                                              </svg>06 Nov, 2024
                                            </p>
                                          </div>
                                          <div class="project-body">
                                            <div class="common-f-start"><img class="img-fluid" src="../assets/images/project/list/1.png" alt="dashboard">
                                              <div>
                                                <h6>CRM Dashboard</h6><span>Create a brand logo design for a mofi admin.</span>
                                              </div>
                                            </div>
                                            <div class="common-space">
                                              <p class="mb-0 c-o-light">Tasks</p><span>40%</span>
                                            </div>
                                            <div class="progress">
                                              <div class="progress-bar bg-primary" style="width: 40%"></div>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="col-xxl-4 col-md-6 box-col-6 xl-50">
                                      <div class="progress-project-box">
                                        <div class="list-box title-line-success">
                                          <div class="header-top"><span class="badge badge-light-success">Completed</span>
                                            <p class="mb-0 c-o-light"> 
                                              <svg class="me-2"> 
                                                <use href="../assets/svg/icon-sprite.svg#vector-calendar"></use>
                                              </svg>10 Mar, 2024
                                            </p>
                                          </div>
                                          <div class="project-body">
                                            <div class="common-f-start"><img class="img-fluid" src="../assets/images/project/list/2.png" alt="application">
                                              <div>
                                                <h6>Chat Application</h6><span>Create a chat application for business messaging needs.</span>
                                              </div>
                                            </div>
                                            <div class="common-space">
                                              <p class="mb-0 c-o-light">Tasks</p><span>100%</span>
                                            </div>
                                            <div class="progress">
                                              <div class="progress-bar bg-success" style="width: 100%"></div>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="col-xxl-4 col-md-6 box-col-6 xl-50">
                                      <div class="progress-project-box">
                                        <div class="list-box title-line-primary">
                                          <div class="header-top"><span class="badge badge-light-primary">Pending</span>
                                            <p class="mb-0 c-o-light"> 
                                              <svg class="me-2"> 
                                                <use href="../assets/svg/icon-sprite.svg#vector-calendar"></use>
                                              </svg>08 Nov, 2024
                                            </p>
                                          </div>
                                          <div class="project-body">
                                            <div class="common-f-start"><img class="img-fluid" src="../assets/images/project/list/8.png" alt="e-commerce web">
                                              <div>
                                                <h6>E-commerce Web</h6><span>E-commerce is focusing on optimizing.</span>
                                              </div>
                                            </div>
                                            <div class="common-space">
                                              <p class="mb-0 c-o-light">Tasks</p><span>25%</span>
                                            </div>
                                            <div class="progress">
                                              <div class="progress-bar bg-primary" style="width: 25%"></div>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="col-xxl-4 col-md-6 box-col-6 xl-50">
                                      <div class="progress-project-box">
                                        <div class="list-box title-line-success">
                                          <div class="header-top"><span class="badge badge-light-success">Completed</span>
                                            <p class="mb-0 c-o-light"> 
                                              <svg class="me-2"> 
                                                <use href="../assets/svg/icon-sprite.svg#vector-calendar"></use>
                                              </svg>03 Sep, 2024
                                            </p>
                                          </div>
                                          <div class="project-body">
                                            <div class="common-f-start"><img class="img-fluid" src="../assets/images/project/list/11.png" alt="application">
                                              <div>
                                                <h6>Nursery App</h6><span>Correspondence and monitor your child's development.</span>
                                              </div>
                                            </div>
                                            <div class="common-space">
                                              <p class="mb-0 c-o-light">Tasks</p><span>100%</span>
                                            </div>
                                            <div class="progress">
                                              <div class="progress-bar bg-success" style="width: 100%"></div>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="col-xxl-4 col-md-6 box-col-6 xl-50">
                                      <div class="progress-project-box">
                                        <div class="list-box title-line-warning">
                                          <div class="header-top"><span class="badge badge-light-warning">In Progress</span>
                                            <p class="mb-0 c-o-light"> 
                                              <svg class="me-2"> 
                                                <use href="../assets/svg/icon-sprite.svg#vector-calendar"></use>
                                              </svg>28 Nov, 2024
                                            </p>
                                          </div>
                                          <div class="project-body">
                                            <div class="common-f-start"><img class="img-fluid" src="../assets/images/project/list/12.png" alt="landing page">
                                              <div>
                                                <h6>Fish Mobile App</h6><span>Real-time tracking, and fishing advice.</span>
                                              </div>
                                            </div>
                                            <div class="common-space">
                                              <p class="mb-0 c-o-light">Tasks</p><span>87%</span>
                                            </div>
                                            <div class="progress">
                                              <div class="progress-bar bg-warning" style="width: 87%"></div>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="col-xxl-4 col-md-6 box-col-6 xl-50">
                                      <div class="progress-project-box">
                                        <div class="list-box title-line-success">
                                          <div class="header-top"><span class="badge badge-light-success">Completed</span>
                                            <p class="mb-0 c-o-light"> 
                                              <svg class="me-2"> 
                                                <use href="../assets/svg/icon-sprite.svg#vector-calendar"></use>
                                              </svg>28 Jan, 2024
                                            </p>
                                          </div>
                                          <div class="project-body">
                                            <div class="common-f-start"><img class="img-fluid" src="../assets/images/project/list/10.png" alt="application">
                                              <div>
                                                <h6>Sales Management </h6><span>Precise objectives and deliver exceptional performance</span>
                                              </div>
                                            </div>
                                            <div class="common-space">
                                              <p class="mb-0 c-o-light">Tasks</p><span>100%</span>
                                            </div>
                                            <div class="progress">
                                              <div class="progress-bar bg-success" style="width: 100%"></div>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="col-xxl-4 col-md-6 box-col-6 xl-50">
                                      <div class="progress-project-box">
                                        <div class="list-box title-line-warning">
                                          <div class="header-top"><span class="badge badge-light-warning">In Progress</span>
                                            <p class="mb-0 c-o-light"> 
                                              <svg class="me-2"> 
                                                <use href="../assets/svg/icon-sprite.svg#vector-calendar"></use>
                                              </svg>02 Feb, 2024
                                            </p>
                                          </div>
                                          <div class="project-body">
                                            <div class="common-f-start"><img class="img-fluid" src="../assets/images/project/list/9.png" alt="landing page">
                                              <div>
                                                <h6>NFT Website</h6><span>Explore our NFT marketplace to find digital assets.</span>
                                              </div>
                                            </div>
                                            <div class="common-space">
                                              <p class="mb-0 c-o-light">Tasks</p><span>75%</span>
                                            </div>
                                            <div class="progress">
                                              <div class="progress-bar bg-warning" style="width: 75%">   </div>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="col-xxl-4 col-md-6 box-col-6 xl-50">
                                      <div class="progress-project-box">
                                        <div class="list-box title-line-success">
                                          <div class="header-top"><span class="badge badge-light-success">Completed</span>
                                            <p class="mb-0 c-o-light"> 
                                              <svg class="me-2"> 
                                                <use href="../assets/svg/icon-sprite.svg#vector-calendar"></use>
                                              </svg>27 Oct, 2024
                                            </p>
                                          </div>
                                          <div class="project-body">
                                            <div class="common-f-start"><img class="img-fluid" src="../assets/images/project/list/7.png" alt="application">
                                              <div>
                                                <h6>Grocery App</h6><span>smooth purchasing journey and effective delivery options.</span>
                                              </div>
                                            </div>
                                            <div class="common-space">
                                              <p class="mb-0 c-o-light">Tasks</p><span>100%</span>
                                            </div>
                                            <div class="progress">
                                              <div class="progress-bar bg-success" style="width: 100%"></div>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="col-xxl-4 col-md-6 box-col-6 xl-50">
                                      <div class="progress-project-box">
                                        <div class="list-box title-line-primary">
                                          <div class="header-top"><span class="badge badge-light-primary">Pending</span>
                                            <p class="mb-0 c-o-light"> 
                                              <svg class="me-2"> 
                                                <use href="../assets/svg/icon-sprite.svg#vector-calendar"></use>
                                              </svg>14 May, 2024
                                            </p>
                                          </div>
                                          <div class="project-body">
                                            <div class="common-f-start"><img class="img-fluid" src="../assets/images/project/list/6.png" alt="project">
                                              <div>
                                                <h6>Sales Project</h6><span>Create a chat application for business messaging needs.</span>
                                              </div>
                                            </div>
                                            <div class="common-space">
                                              <p class="mb-0 c-o-light">Tasks</p><span>30%</span>
                                            </div>
                                            <div class="progress">
                                              <div class="progress-bar bg-primary" style="width: 30%"></div>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="tab-pane fade" id="team-project" role="tabpanel" aria-labelledby="team-project-tab">
                              <div class="card">
                                <div class="card-header">
                                  <h5>Notifications</h5>
                                </div>
                                <div class="card-body">
                                  <div class="user-notifications">
                                    <h6>Today </h6>
                                    <ul> 
                                      <li>
                                        <div> <img class="img-fluid" src="../assets/images/dashboard-11/user/12.jpg" alt="user">
                                          <div>
                                            <p>Weekly check-in session arranged<span class="ps-2">2h ago</span></p><span>August 30, 2024 at 10:00 AM has been set aside for the weekly check-in meeting.</span>
                                          </div>
                                        </div>
                                      </li>
                                      <li>
                                        <div> <img class="img-fluid" src="../assets/images/dashboard-11/user/1.jpg" alt="user">
                                          <div>
                                            <p>Finishing the wireframing phase<span class="ps-2">5h ago</span></p><span>High-fidelity mockups will be created by the design team.</span>
                                          </div>
                                        </div>
                                      </li>
                                      <li>
                                        <div> <img class="img-fluid" src="../assets/images/dashboard-11/user/5.jpg" alt="user">
                                          <div>
                                            <p>Customer input received<span class="ps-2">10h ago</span></p><span>Before august 25, 2024, the design team will deliver updated mockups.</span>
                                          </div>
                                        </div>
                                      </li>
                                    </ul>
                                    <h6>Yesterday</h6>
                                    <ul> 
                                      <li>
                                        <div> <img class="img-fluid" src="../assets/images/dashboard-11/user/2.jpg" alt="user">
                                          <div>
                                            <p>Scheduled usability testing<span class="ps-2">Yesterday</span></p><span>We will collect user input and fix any problems found during the testing process.</span>
                                          </div>
                                        </div>
                                      </li>
                                      <li>
                                        <div> <img class="img-fluid" src="../assets/images/dashboard-11/user/4.jpg" alt="user">
                                          <div>
                                            <p>Meeting for the final client review<span class="ps-2">Yesterday</span></p><span>Reviewing the finished website and making any final tweaks before its official debut is the aim of the meeting.</span>
                                          </div>
                                        </div>
                                      </li>
                                    </ul>
                                    <h6>18 Feb</h6>
                                    <ul>
                                      <li>
                                        <div> <img class="img-fluid" src="../assets/images/dashboard-11/user/7.jpg" alt="user">
                                          <div>
                                            <p>Confirmed date of website launch<span class="ps-2">18 Feb</span></p><span>Plans are in place to guarantee a successful and seamless launch.Keep checking back for further information.</span>
                                          </div>
                                        </div>
                                      </li>
                                    </ul>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="tab-pane fade" id="attachment" role="tabpanel" aria-labelledby="attachment-tab">
                              <div class="card">
                                <div class="card-header">
                                  <h5>Settings</h5>
                                </div>
                                <div class="card-body setting-wrapper">
                                  <div class="row g-md-3 g-2">
                                    <div class="col-md-3">
                                      <label class="form-label mb-0">Reminders</label>
                                    </div>
                                    <div class="col-sm-9">
                                      <div class="form-check form-switch form-check-inline">
                                        <input class="form-check-input switch-primary check-size" type="checkbox" role="switch" checked="">
                                        <p><i data-feather="info"></i>To stay on top of crucial tasks and deadlines, set up alerts and notifications.</p>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="row g-md-3 g-2">
                                    <div class="col-md-3">
                                      <label class="form-label mb-0">Select Language</label>
                                    </div>
                                    <div class="col-sm-9">
                                      <select class="form-select">
                                        <option selected="">Select your language</option>
                                        <option value="1">English</option>
                                        <option value="2">French</option>
                                        <option value="3">Gujarati</option>
                                        <option value="4">Hindi</option>
                                        <option value="5">Japanese</option>
                                        <option value="6">Marathi</option>
                                        <option value="7">Russian</option>
                                      </select>
                                    </div>
                                  </div>
                                  <div class="row g-md-3 g-2">
                                    <div class="col-md-3">
                                      <label class="form-label mb-0">Recent Activity </label>
                                    </div>
                                    <div class="col-md-9">
                                      <div class="form-check form-switch form-check-inline">
                                        <input class="form-check-input switch-primary check-size" type="checkbox" role="switch">
                                        <p><i data-feather="info"></i>See a history of your most recent platform interactions and actions.</p>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="row g-md-3 g-2">
                                    <div class="col-md-3">
                                      <label class="form-label mb-0">Two-factor Authentications</label>
                                    </div>
                                    <div class="col-md-9">
                                      <div class="form-check form-switch form-check-inline">
                                        <input class="form-check-input switch-primary check-size" type="checkbox" role="switch" checked="">
                                        <p><i data-feather="info"></i>By enabling an extra step of verification during login, you can improve account security.</p>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="row g-md-3 g-2">
                                    <div class="col-md-3">
                                      <label class="form-label mb-0">Post Notifications</label>
                                    </div>
                                    <div class="col-md-9">
                                      <div class="form-check form-switch form-check-inline">
                                        <input class="form-check-input switch-primary check-size" type="checkbox" role="switch" checked="">
                                        <p><i data-feather="info"></i>Control and personalise the platform's alerts for new content and updates.</p>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="row g-md-3 g-2">
                                    <div class="col-md-3">
                                      <label class="form-label mb-0">Remove Accounts</label>
                                    </div>
                                    <div class="col-md-9">
                                      <div class="form-check form-switch form-check-inline">
                                        <input class="form-check-input switch-primary check-size" type="checkbox" role="switch" checked="">
                                        <p><i data-feather="info"></i>Permanently remove your account and all related information from the platform.</p>
                                      </div>
                                      <div class="common-flex mt-3"><a class="btn button-light-danger disabled" href="#!" role="button">Disable Account</a><a class="btn btn-danger" href="#!" role="button">Delete Account</a></div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- user profile menu end-->
              </div>
            </div>
          </div>
          <!-- Container-fluid Ends-->
        


@endsection

@section('script')
@endsection