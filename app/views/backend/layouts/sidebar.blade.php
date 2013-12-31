
  <!-- BEGIN SIDEBAR -->
      <div class="page-sidebar navbar-collapse collapse">
         <!-- BEGIN SIDEBAR MENU -->
         <ul class="page-sidebar-menu">
            <li>
               <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
               <div class="sidebar-toggler hidden-phone"></div>
               <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
            </li>
            <li>
               <!-- BEGIN RESPONSIVE QUICK SEARCH FORM -->
               <form class="sidebar-search" action="extra_search.html" method="POST">
                  <div class="form-container">
                     <div class="input-box">
                        <a href="javascript:;" class="remove"></a>
                        <input type="text" placeholder="Search..."/>
                        <input type="button" class="submit" value=""/>
                     </div>
                  </div>
               </form>
               <!-- END RESPONSIVE QUICK SEARCH FORM -->
            </li>

            <li class="start {{(Request::is('admin') ? ' active' : '')}}">
               <a href="/admin"> <i class="icon-home"></i> <span class="title">Dashboard</span> <span class="selected"></span> </a>
            </li>
            <li class="{{(Request::is('admin/assets') ? ' active' : '')}}">
               <a href="javascript:;"> <i class="icon-film"></i> <span class="title">Assets</span> <span class="selected"></span> </a>
               <ul class="sub-menu">
                  <li>
                     <a href="/admin/assets">
                     Assets</a>
                  </li>
                   <li>
                     <a href="/admin/collections">
                     Collections</a>
                  </li>
                   <li>
                     <a href="/admin/playlists">
                     Playlists</a>
                  </li>
               </ul>
            </li>
            <li class="{{(Request::is('admin/users') ? ' active' : '')}}">
               <a href="javascript:;">
               <i class="icon-user"></i>
               <span class="title">Users</span>
               <span class="arrow"></span>
               </a>
               <ul class="sub-menu">
                  <li>
                     <a href="/admin/users">
                     Users</a>
                  </li>
                   <li>
                     <a href="/admin/groups">
                     Groups</a>
                  </li>
               </ul>

               <!-- <a href="/admin/users"> <i class="icon-user"></i> <span class="title">Users</span> <span class="selected"></span> </a> -->
            </li>
            <li class="">
               <a href="javascript:;">
               <i class="icon-star-empty"></i>
               <span class="title">Layouts</span>
               <span class="arrow"></span>
               </a>
               <ul class="sub-menu">
                  <li>
                     <a href="layout_language_bar.html">
                     <span class="badge badge-roundless badge-important">new</span>Language Switch Bar</a>
                  </li>
                  <li>
                     <a href="layout_horizontal_sidebar_menu.html">Horizontal &amp; Sidebar Menu</a>
                  </li>
                  <li>
                     <a href="layout_horizontal_menu1.html">Horizontal Menu 1</a>
                  </li>
                  <li>
                     <a href="layout_horizontal_menu2.html">Horizontal Menu 2</a>
                  </li>
                  <li>
                     <a href="layout_sidebar_fixed.html">Sidebar Fixed Page</a>
                  </li>
                  <li>
                     <a href="layout_sidebar_closed.html">Sidebar Closed Page</a>
                  </li>
                  <li>
                     <a href="layout_blank_page.html">Blank Page</a>
                  </li>
                  <li>
                     <a href="layout_boxed_page.html">Boxed Page</a>
                  </li>
                  <li>
                     <a href="layout_boxed_not_responsive.html">Non-Responsive Boxed Layout</a>
                  </li>
                  <li>
                     <a href="layout_promo.html">Promo Page</a>
                  </li>
                  <li>
                     <a href="layout_email.html">Email Templates</a>
                  </li>
                  <li>
                     <a href="layout_ajax.html">Content Loading via Ajax</a>
                  </li>
               </ul>
            </li>
            <li class="start {{(Request::is('admin') ? '' : '')}}">
               <a href="/admin/queue"> <i class="fa fa-tasks"></i> <span class="title">Queue</span> <span class="selected"></span></a>
            </li>
            <li class="start {{(Request::is('admin') ? '' : '')}}">
               <a href="/admin/history"> <i class="fa fa-undo"></i> <span class="title">History</span> <span class="selected"></span></a>
            </li>
            <li class="start {{(Request::is('admin') ? '' : '')}}">
               <a href="/admin/capture"> <i class="fa fa-video-camera"></i> <span class="title">Capture</span> <span class="selected"></span></a>
            </li>
            <li class="start {{(Request::is('admin') ? '' : '')}}">
               <a href="/admin/reports"> <i class="fa fa-bar-chart-o"></i> <span class="title">Reports</span> <span class="selected"></span></a>
            </li>
            <li class="start {{(Request::is('admin') ? '' : '')}}">
               <a href="/admin/settings"> <i class="icon-gears"></i> <span class="title">Settings</span> <span class="selected"></span></a>
            </li>
            <li class="start {{(Request::is('admin') ? '' : '')}}">
               <a href="/admin/help"> <i class="icon-gears"></i> <span class="title">Help</span> <span class="selected"></span></a>
            </li>

<!--             <li class="start {{(Request::is('admin') ? '' : '')}}">
               <a href="/admin/capture"> <i class="fa fa-video-camera"></i> <span class="title">Capture</span> <span class="selected"></span></a>
            </li> -->
            @section('sidebar')

            @show
      </ul>
         <!-- END SIDEBAR MENU -->
      </div>
  <!-- END SIDEBAR -->
