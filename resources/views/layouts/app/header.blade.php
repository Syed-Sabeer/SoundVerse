<!-- Page Header Start-->
<style>
  .admin-notification-wrap {
    position: relative;
  }
  .admin-notification-bell {
    position: relative;
    width: 36px;
    height: 36px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    border: 1px solid #e6e6ef;
    background: #ffffff;
  }
  .admin-notification-bell .badge-dot {
    position: absolute;
    top: -4px;
    right: -4px;
    min-width: 18px;
    height: 18px;
    border-radius: 999px;
    background: #ef4444;
    color: #fff;
    font-size: 10px;
    font-weight: 700;
    display: none;
    align-items: center;
    justify-content: center;
    padding: 0 5px;
  }
  .admin-quick-notifications {
    position: absolute;
    right: 0;
    top: calc(100% + 10px);
    width: 360px;
    max-height: 420px;
    overflow: hidden;
    background: #fff;
    border: 1px solid #ececf6;
    border-radius: 12px;
    box-shadow: 0 15px 45px rgba(21, 11, 45, 0.18);
    z-index: 1000;
    display: none;
  }
  .admin-quick-notifications.active {
    display: block;
  }
  .admin-qn-header {
    padding: 12px 14px;
    border-bottom: 1px solid #efeff7;
    display: flex;
    justify-content: space-between;
    align-items: center;
  }
  .admin-qn-list {
    max-height: 290px;
    overflow-y: auto;
  }
  .admin-qn-item {
    border-bottom: 1px solid #f3f3fa;
    padding: 10px 12px;
    cursor: pointer;
  }
  .admin-qn-item:last-child {
    border-bottom: none;
  }
  .admin-qn-item.unread {
    background: #f8f6ff;
  }
  .admin-qn-title {
    font-size: 13px;
    font-weight: 700;
    margin-bottom: 4px;
    color: #2b2e43;
  }
  .admin-qn-message {
    font-size: 12px;
    color: #676b83;
    margin-bottom: 3px;
  }
  .admin-qn-time {
    font-size: 11px;
    color: #8d92ab;
  }
  .admin-qn-footer {
    padding: 10px 12px;
    border-top: 1px solid #efeff7;
    display: flex;
    justify-content: space-between;
    gap: 8px;
  }
  .admin-full-notification-modal {
    position: fixed;
    inset: 0;
    background: rgba(17, 12, 38, 0.65);
    z-index: 1060;
    display: none;
    align-items: center;
    justify-content: center;
    padding: 18px;
  }
  .admin-full-notification-modal.active {
    display: flex;
  }
  .admin-full-notification-content {
    width: 100%;
    max-width: 760px;
    max-height: 86vh;
    background: #fff;
    border-radius: 14px;
    overflow: hidden;
    display: flex;
    flex-direction: column;
  }
  .admin-full-notification-head {
    padding: 14px 16px;
    border-bottom: 1px solid #efeff7;
    display: flex;
    justify-content: space-between;
    align-items: center;
  }
  .admin-full-notification-list {
    padding: 10px 14px 16px;
    overflow-y: auto;
  }
</style>

      <div class="page-header">
        <div class="header-wrapper row m-0">
          <form class="form-inline search-full col" action="#" method="get">
            <div class="form-group w-100">
              <div class="Typeahead Typeahead--twitterUsers">
                <div class="u-posRelative">
                  <input class="demo-input Typeahead-input form-control-plaintext w-100" type="text" placeholder="Search Anything Here..." name="q" title="" autofocus>
                  <div class="spinner-border Typeahead-spinner" role="status"><span class="sr-only">Loading...</span></div><i class="close-search" data-feather="x"></i>
                </div>
                <div class="Typeahead-menu"></div>
              </div>
            </div>
          </form>
          <div class="header-logo-wrapper col-auto p-0">
            <div class="logo-wrapper"><a href="index.html"><img class="img-fluid for-light" src="{{asset('AdminAssets/images/logo/logo.png')}}" alt=""><img class="img-fluid for-dark" src="{{asset('AdminAssets/images/logo/logo_dark.png')}}" alt=""></a></div>
            <div class="toggle-sidebar"><i class="status_toggle middle sidebar-toggle" data-feather="align-center"></i></div>
          </div>
          {{-- <div class="left-header col-xxl-5 col-xl-6 col-lg-5 col-md-4 col-sm-3 p-0">
            <div class="notification-slider">
              <div class="d-flex h-100"> <img src="{{asset('AdminAssets/images/giftools.gif')}}" alt="gif">
                <h6 class="mb-0 f-w-400"><span class="font-primary">Don't Miss Out! </span><span class="f-light"> Our new update has been released.</span></h6><i class="icon-arrow-top-right f-light"></i>
              </div>
              <div class="d-flex h-100"><img src="{{asset('AdminAssets/images/giftools.gif')}}" alt="gif">
                <h6 class="mb-0 f-w-400"><span class="f-light">Something you love is now on sale! </span></h6><a class="ms-1" href="https://1.envato.market/3GVzd" target="_blank">Buy now !</a>
              </div>
            </div>
          </div> --}}
          <div class="nav-right col-xxl-7 col-xl-6 col-md-7 col-8 pull-right right-header p-0 ms-auto">
            <ul class="nav-menus">
              {{-- <li class="language-nav">
                <div class="translate_wrapper">
                  <div class="current_lang">
                    <div class="lang"><i class="flag-icon flag-icon-us"></i><span class="lang-txt">EN                               </span></div>
                  </div>
                  <div class="more_lang">
                    <div class="lang selected" data-value="en"><i class="flag-icon flag-icon-us"></i><span class="lang-txt">English<span> (US)</span></span></div>
                    <div class="lang" data-value="de"><i class="flag-icon flag-icon-de"></i><span class="lang-txt">Deutsch</span></div>
                    <div class="lang" data-value="es"><i class="flag-icon flag-icon-es"></i><span class="lang-txt">Español</span></div>
                    <div class="lang" data-value="fr"><i class="flag-icon flag-icon-fr"></i><span class="lang-txt">Français</span></div>
                    <div class="lang" data-value="pt"><i class="flag-icon flag-icon-pt"></i><span class="lang-txt">Português<span> (BR)</span></span></div>
                    <div class="lang" data-value="cn"><i class="flag-icon flag-icon-cn"></i><span class="lang-txt">简体中文</span></div>
                    <div class="lang" data-value="ae"><i class="flag-icon flag-icon-ae"></i><span class="lang-txt">لعربية <span> (ae)</span></span></div>
                  </div>
                </div>
              </li> --}}
              <li class="fullscreen-body">                       <span>
                  <svg id="maximize-screen">
                    <use href="{{asset('AdminAssets/svg/icon-sprite.svg#full-screen')}}"></use>
                  </svg></span></li>
              {{-- <li>                         <span class="header-search">
                  <svg>
                    <use href="{{asset('AdminAssets/svg/icon-sprite.svg#search')}}"></use>
                  </svg></span></li> --}}
              {{-- <li class="onhover-dropdown">
                <svg>
                  <use href="{{asset('AdminAssets/svg/icon-sprite.svg#star')}}"></use>
                </svg>
                <div class="onhover-show-div bookmark-flip">
                  <div class="flip-card">
                    <div class="flip-card-inner">
                      <div class="front">
                        <h6 class="f-18 mb-0 dropdown-title">Bookmark</h6>
                        <ul class="bookmark-dropdown">
                          <li>
                            <div class="row">
                              <div class="col-4 text-center">
                                <div class="bookmark-content">
                                  <div class="bookmark-icon"><i data-feather="file-text"></i></div><span>Forms</span>
                                </div>
                              </div>
                              <div class="col-4 text-center">
                                <div class="bookmark-content">
                                  <div class="bookmark-icon"><i data-feather="user"></i></div><span>Profile</span>
                                </div>
                              </div>
                              <div class="col-4 text-center">
                                <div class="bookmark-content">
                                  <div class="bookmark-icon"><i data-feather="server"></i></div><span>Tables</span>
                                </div>
                              </div>
                            </div>
                          </li>
                          <li class="text-center"><a class="flip-btn f-w-700 btn btn-primary w-100" id="flip-btn" href="#!">Add Bookmark</a></li>
                        </ul>
                      </div>
                      <div class="back">
                        <ul>
                          <li>
                            <div class="bookmark-dropdown flip-back-content">
                              <input type="text" placeholder="Search...">
                            </div>
                          </li>
                          <li><a class="f-w-700 d-block flip-back btn btn-primary w-100" id="flip-back" href="#!">Back</a></li>
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>
              </li> --}}
              <li>
                <div class="mode">
                  <svg>
                    <use href="{{asset('AdminAssets/svg/icon-sprite.svg#moon')}}"></use>
                  </svg>
                </div>
              </li>
              <li class="admin-notification-wrap">
                <button type="button" class="admin-notification-bell" id="adminNotificationBell" aria-label="Admin notifications">
                  <svg style="width:18px;height:18px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                  </svg>
                  <span class="badge-dot" id="adminNotificationBadge">0</span>
                </button>

                <div class="admin-quick-notifications" id="adminQuickNotifications">
                  <div class="admin-qn-header">
                    <strong>Notifications</strong>
                    <small id="adminHeaderBadge">0 New</small>
                  </div>
                  <div class="admin-qn-list" id="adminQuickNotificationList"></div>
                  <div class="admin-qn-footer">
                    <button type="button" class="btn btn-sm btn-primary" id="adminViewAllNotifications">View All</button>
                    <button type="button" class="btn btn-sm btn-outline-secondary" id="adminMarkAllRead">Mark all read</button>
                  </div>
                </div>
              </li>
              {{-- <li class="cart-nav onhover-dropdown">
                <div class="cart-box">
                  <svg>
                    <use href="{{asset('AdminAssets/svg/icon-sprite.svg#stroke-ecommerce')}}"></use>
                  </svg><span class="badge rounded-pill badge-danger">2</span>
                </div>
                <div class="cart-dropdown onhover-show-div">
                  <h6 class="f-18 mb-0 dropdown-title">Cart</h6>
                  <ul>
                    <li>
                      <div class="d-flex"><img class="img-fluid b-r-5 me-3 img-60" src="{{asset('AdminAssets/images/other-images/cart-img.jpg')}}" alt="">
                        <div class="flex-grow-1"><span>Furniture Chair for Home</span>
                          <div class="qty-box">
                            <div class="input-group"><span class="input-group-prepend">
                                <button class="btn quantity-left-minus" type="button" data-type="minus" data-field="">-</button></span>
                              <input class="form-control input-number" type="text" name="quantity" value="1"><span class="input-group-prepend">
                                <button class="btn quantity-right-plus" type="button" data-type="plus" data-field="">+</button></span>
                            </div>
                          </div>
                          <h6 class="font-primary">$12.45</h6>
                        </div>
                        <div class="close-circle"><a class="bg-danger" href="#"><i data-feather="x"></i></a></div>
                      </div>
                    </li>
                    <li>
                      <div class="d-flex"><img class="img-fluid b-r-5 me-3 img-60" src="{{asset('AdminAssets/images/other-images/cart-img1.jpg')}}" alt="">
                        <div class="flex-grow-1"><span>Rest Well Chair</span>
                          <div class="qty-box">
                            <div class="input-group"><span class="input-group-prepend">
                                <button class="btn quantity-left-minus" type="button" data-type="minus" data-field="">-</button></span>
                              <input class="form-control input-number" type="text" name="quantity" value="1"><span class="input-group-prepend">
                                <button class="btn quantity-right-plus" type="button" data-type="plus" data-field="">+</button></span>
                            </div>
                          </div>
                          <h6 class="font-primary">$49.00</h6>
                        </div>
                        <div class="close-circle"><a class="bg-danger" href="#"><i data-feather="x"></i></a></div>
                      </div>
                    </li>
                    <li class="total">
                      <h6 class="mb-0">Order Total : <span class="f-right">$1000.00</span></h6>
                    </li>
                    <li class="text-center"><a class="d-block view-cart f-w-700 btn btn-primary w-100" href="cart.html">View Cart</a><a class="btn btn-primary view-checkout btn btn-primary w-100 f-w-700" href="checkout.html">Checkout</a></li>
                  </ul>
                </div>
              </li> --}}
              {{-- <li class="onhover-dropdown">
                <div class="notification-box">
                  <svg>
                    <use href="{{asset('AdminAssets/svg/icon-sprite.svg#notification')}}"></use>
                  </svg><span class="badge rounded-pill badge-success">4 </span>
                </div>
                <div class="onhover-show-div notification-dropdown">
                  <h6 class="f-18 mb-0 dropdown-title">Notifications                               </h6>
                  <ul>
                    <li class="b-l-primary border-4 toast default-show-toast align-items-center text-light border-0 fade show" aria-live="assertive" aria-atomic="true" data-bs-autohide="false">
                      <div class="d-flex justify-content-between">
                        <div class="toast-body">
                          <p>Delivery processing</p>
                        </div>
                        <button class="btn-close btn-close-white me-2 m-auto" type="button" data-bs-dismiss="toast" aria-label="Close"></button>
                      </div>
                    </li>
                    <li class="b-l-success border-4 toast default-show-toast align-items-center text-light border-0 fade show" aria-live="assertive" aria-atomic="true" data-bs-autohide="false">
                      <div class="d-flex justify-content-between">
                        <div class="toast-body">
                          <p>Order Complete</p>
                        </div>
                        <button class="btn-close btn-close-white me-2 m-auto" type="button" data-bs-dismiss="toast" aria-label="Close"></button>
                      </div>
                    </li>
                    <li class="b-l-secondary border-4 toast default-show-toast align-items-center text-light border-0 fade show" aria-live="assertive" aria-atomic="true" data-bs-autohide="false">
                      <div class="d-flex justify-content-between">
                        <div class="toast-body">
                          <p>Tickets Generated</p>
                        </div>
                        <button class="btn-close btn-close-white me-2 m-auto" type="button" data-bs-dismiss="toast" aria-label="Close"></button>
                      </div>
                    </li>
                    <li class="b-l-warning border-4 toast default-show-toast align-items-center text-light border-0 fade show" aria-live="assertive" aria-atomic="true" data-bs-autohide="false">
                      <div class="d-flex justify-content-between">
                        <div class="toast-body">
                          <p>Delivery Complete</p>
                        </div>
                        <button class="btn-close btn-close-white me-2 m-auto" type="button" data-bs-dismiss="toast" aria-label="Close"></button>
                      </div>
                    </li>
                  </ul>
                </div>
              </li> --}}
              <li class="profile-nav onhover-dropdown pe-0 py-0">
                <div class="d-flex profile-media"><img class="b-r-10" src="{{asset('AdminAssets/images/dashboard/profile.png')}}" alt="">
                  <div class="flex-grow-1"> <span>{{ Auth::user()->username ?? 'Guest' }}</span>
                    <p class="mb-0">Admin <i class="middle fa-solid fa-angle-down"></i></p>
                  </div>
                </div>
                <ul class="profile-dropdown onhover-show-div">
                  {{-- <li><a href="sign-up.html"><i data-feather="user"></i><span>Account </span></a></li>
                  <li><a href="mail-box.html"><i data-feather="mail"></i><span>Inbox</span></a></li>
                  <li><a href="task.html"><i data-feather="file-text"></i><span>Taskboard</span></a></li>
                  <li><a href="add-user.html"><i data-feather="settings"></i><span>Settings</span></a></li> --}}
                  <li>
    <form method="POST" action="{{ route('logout') }}" id="logout-form">
        @csrf
        <button type="submit" style="background:none;border:none;padding:0;cursor:pointer;">
            <i data-feather="log-out"></i> <span>Log out</span>
        </button>
    </form>
</li>


                </ul>
              </li>
            </ul>
          </div>
          <script class="result-template" type="text/x-handlebars-template">
            <div class="ProfileCard u-cf">
            <div class="ProfileCard-avatar"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-airplay m-0"><path d="M5 17H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-1"></path><polygon points="12 15 17 21 7 21 12 15"></polygon></svg></div>
            <div class="ProfileCard-details">
            <div class="ProfileCard-realName">name</div>
            </div>
            </div>
          </script>
          <script class="empty-template" type="text/x-handlebars-template"><div class="EmptyMessage">Your search turned up 0 results. This most likely means the backend is down, yikes!</div></script>
        </div>
      </div>

      <div class="admin-full-notification-modal" id="adminFullNotificationModal">
        <div class="admin-full-notification-content">
          <div class="admin-full-notification-head">
            <h5 class="mb-0">All Notifications</h5>
            <button type="button" class="btn btn-sm btn-light" id="adminCloseNotificationModal">Close</button>
          </div>
          <div class="admin-full-notification-list" id="adminFullNotificationList"></div>
        </div>
      </div>

      <script>
        (function () {
          const csrfToken = '{{ csrf_token() }}';
          const bell = document.getElementById('adminNotificationBell');
          const quick = document.getElementById('adminQuickNotifications');
          const quickList = document.getElementById('adminQuickNotificationList');
          const fullModal = document.getElementById('adminFullNotificationModal');
          const fullList = document.getElementById('adminFullNotificationList');
          const badge = document.getElementById('adminNotificationBadge');
          const headerBadge = document.getElementById('adminHeaderBadge');
          const viewAllButton = document.getElementById('adminViewAllNotifications');
          const markAllButton = document.getElementById('adminMarkAllRead');
          const closeModalButton = document.getElementById('adminCloseNotificationModal');

          if (!bell || !quick || !quickList || !fullModal || !fullList || !badge || !headerBadge) {
            return;
          }

          let notifications = [];

          function escapeHtml(input) {
            return String(input || '')
              .replace(/&/g, '&amp;')
              .replace(/</g, '&lt;')
              .replace(/>/g, '&gt;')
              .replace(/"/g, '&quot;')
              .replace(/'/g, '&#039;');
          }

          function updateBadge() {
            const unreadCount = notifications.filter(item => item.unread).length;
            badge.textContent = unreadCount;
            badge.style.display = unreadCount > 0 ? 'flex' : 'none';
            headerBadge.textContent = unreadCount + ' New';
          }

          function renderQuick() {
            const items = notifications.slice(0, 5);
            if (!items.length) {
              quickList.innerHTML = '<div class="p-3 text-muted">No notifications yet.</div>';
              return;
            }

            quickList.innerHTML = items.map(item => {
              const title = escapeHtml(item.title || 'Notification');
              const message = escapeHtml(item.message || '');
              const createdAt = item.created_at ? new Date(item.created_at).toLocaleString() : '';
              return '<div class="admin-qn-item ' + (item.unread ? 'unread' : '') + '" data-id="' + item.id + '" data-url="' + escapeHtml(item.action_url || '') + '">' +
                '<div class="admin-qn-title">' + title + '</div>' +
                '<div class="admin-qn-message">' + message + '</div>' +
                '<div class="admin-qn-time">' + createdAt + '</div>' +
              '</div>';
            }).join('');
          }

          function renderFull() {
            if (!notifications.length) {
              fullList.innerHTML = '<div class="p-3 text-muted">No notifications yet.</div>';
              return;
            }

            fullList.innerHTML = notifications.map(item => {
              const title = escapeHtml(item.title || 'Notification');
              const message = escapeHtml(item.message || '');
              const createdAt = item.created_at ? new Date(item.created_at).toLocaleString() : '';
              return '<div class="admin-qn-item ' + (item.unread ? 'unread' : '') + '" data-id="' + item.id + '" data-url="' + escapeHtml(item.action_url || '') + '">' +
                '<div class="admin-qn-title">' + title + '</div>' +
                '<div class="admin-qn-message">' + message + '</div>' +
                '<div class="admin-qn-time">' + createdAt + '</div>' +
              '</div>';
            }).join('');
          }

          async function loadNotifications() {
            try {
              const response = await fetch('/api/notifications', { headers: { Accept: 'application/json' } });
              if (!response.ok) return;
              const payload = await response.json();
              if (!payload.success || !Array.isArray(payload.notifications)) return;

              notifications = payload.notifications.map(item => ({
                id: item.id,
                title: item.title,
                message: item.message,
                action_url: item.action_url,
                created_at: item.created_at,
                unread: !item.read_at && !item.is_read,
              }));

              updateBadge();
              renderQuick();
              renderFull();
            } catch (error) {
              // fail silently
            }
          }

          async function markAsRead(id) {
            const target = notifications.find(item => item.id === id);
            if (!target || !target.unread) return;

            target.unread = false;
            updateBadge();
            renderQuick();
            renderFull();

            try {
              await fetch('/api/notifications/' + id + '/read', {
                method: 'POST',
                headers: {
                  'X-CSRF-TOKEN': csrfToken,
                  Accept: 'application/json'
                }
              });
            } catch (error) {
              // fail silently
            }
          }

          async function markAllAsRead() {
            notifications = notifications.map(item => ({ ...item, unread: false }));
            updateBadge();
            renderQuick();
            renderFull();

            try {
              await fetch('/api/notifications/read-all', {
                method: 'POST',
                headers: {
                  'X-CSRF-TOKEN': csrfToken,
                  Accept: 'application/json'
                }
              });
            } catch (error) {
              // fail silently
            }
          }

          function openFullModal() {
            fullModal.classList.add('active');
            document.body.style.overflow = 'hidden';
          }

          function closeFullModal() {
            fullModal.classList.remove('active');
            document.body.style.overflow = '';
          }

          bell.addEventListener('click', function () {
            quick.classList.toggle('active');
          });

          viewAllButton.addEventListener('click', function () {
            quick.classList.remove('active');
            openFullModal();
          });

          closeModalButton.addEventListener('click', closeFullModal);

          markAllButton.addEventListener('click', function () {
            markAllAsRead();
          });

          function handleNotificationClick(event) {
            const item = event.target.closest('.admin-qn-item');
            if (!item) return;

            const id = Number(item.getAttribute('data-id'));
            const actionUrl = item.getAttribute('data-url');
            markAsRead(id);

            if (actionUrl) {
              window.location.href = actionUrl;
            }
          }

          quickList.addEventListener('click', handleNotificationClick);
          fullList.addEventListener('click', handleNotificationClick);

          document.addEventListener('click', function (event) {
            if (!quick.contains(event.target) && !bell.contains(event.target)) {
              quick.classList.remove('active');
            }
          });

          fullModal.addEventListener('click', function (event) {
            if (event.target === fullModal) {
              closeFullModal();
            }
          });

          loadNotifications();
        })();
      </script>
      <!-- Page Header Ends -->
