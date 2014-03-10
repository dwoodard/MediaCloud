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


               <form class="sidebar-search" type="" action="" method="GET">
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


<!--             <li class="start {{(Request::is('admin') ? '' : '')}}">
               <a href="/admin/capture"> <i class="fa fa-video-camera"></i> <span class="title">Capture</span> <span class="selected"></span></a>
            </li> -->
            @section('sidebar')

            @show
      </ul>
         <!-- END SIDEBAR MENU -->
      </div>
  <!-- END SIDEBAR -->