<div id="rightbar" class="rightbar">
    <ul class="nav nav-tabs-new">
        <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#setting">Settings</a></li>
        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#chat">Chat</a></li>
    </ul>
    {{-- <div class="tab-content">
        <div class="tab-pane active" id="setting">
            <div class="slim_scroll">
                <div class="card">
                    <h6>Choose Theme</h6>
                    <ul class="choose-skin list-unstyled mb-0">
                        <li data-theme="purple">
                            <div class="purple"></div>
                        </li>
                        <li data-theme="green">
                            <div class="green"></div>
                        </li>
                        <li data-theme="orange" class="active">
                            <div class="orange"></div>
                        </li>
                        <li data-theme="blue">
                            <div class="blue"></div>
                        </li>
                        <li data-theme="blush">
                            <div class="blush"></div>
                        </li>
                        <li data-theme="cyan">
                            <div class="cyan"></div>
                        </li>
                    </ul>
                </div>
                <div class="card">
                    <h6>General Settings</h6>
                    <ul class="setting-list list-unstyled mb-0">
                        <li>
                            <label class="fancy-checkbox">
                                <input type="checkbox" name="checkbox">
                                <span>Report Panel Usag</span>
                            </label>
                        </li>
                        <li>
                            <label class="fancy-checkbox">
                                <input type="checkbox" name="checkbox" checked>
                                <span>Email Redirect</span>
                            </label>
                        </li>
                        <li>
                            <label class="fancy-checkbox">
                                <input type="checkbox" name="checkbox" checked>
                                <span>Notifications</span>
                            </label>
                        </li>
                        <li>
                            <label class="fancy-checkbox">
                                <input type="checkbox" name="checkbox">
                                <span>Auto Updates</span>
                            </label>
                        </li>
                    </ul>
                </div>
                <div class="card">
                    <h6>Account Settings</h6>
                    <ul class="setting-list list-unstyled mb-0">
                        <li>
                            <label class="fancy-checkbox">
                                <input type="checkbox" name="checkbox">
                                <span>Offline</span>
                            </label>
                        </li>
                        <li>
                            <label class="fancy-checkbox">
                                <input type="checkbox" name="checkbox" checked>
                                <span>Location Permission</span>
                            </label>
                        </li>
                        <li>
                            <label class="fancy-checkbox">
                                <input type="checkbox" name="checkbox" checked>
                                <span>Notifications</span>
                            </label>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="tab-pane right_chat" id="chat">
            <div class="slim_scroll">
                <form>
                    <div class="input-group m-b-20">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="icon-magnifier"></i></span>
                        </div>
                        <input type="text" class="form-control" placeholder="Search...">
                    </div>
                </form>
                <div class="card">
                    <h6>Recent</h6>
                    <ul class="right_chat list-unstyled mb-0">
                        <li class="online">
                            <a href="javascript:void(0);">
                                <div class="media">
                                    <img class="media-object " src="{{ asset('assets/admin/images/xs/avatar4.jpg') }}"
                                        alt="">
                                    <div class="media-body">
                                        <span class="name">Ava Alexander <small class="float-right">Just
                                                now</small></span>
                                        <span class="message">Lorem ipsum Veniam aliquip culpa laboris minim
                                            tempor</span>
                                        <span class="badge badge-outline status"></span>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="online">
                            <a href="javascript:void(0);">
                                <div class="media">
                                    <img class="media-object " src="{{ asset('assets/images/xs/avatar5.jpg') }}"
                                        alt="">
                                    <div class="media-body">
                                        <span class="name">Debra Stewart <small class="float-right">38min
                                                ago</small></span>
                                        <span class="message">Many desktop publishing packages and web page
                                            editors</span>
                                        <span class="badge badge-outline status"></span>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="offline">
                            <a href="javascript:void(0);">
                                <div class="media">
                                    <img class="media-object " src="{{ asset('assets/admin/images/xs/avatar2.jpg') }}"
                                        alt="">
                                    <div class="media-body">
                                        <span class="name">Susie Willis <small class="float-right">2hr
                                                ago</small></span>
                                        <span class="message">Contrary to belief, Lorem Ipsum is not simply random
                                            text</span>
                                        <span class="badge badge-outline status"></span>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="offline">
                            <a href="javascript:void(0);">
                                <div class="media">
                                    <img class="media-object " src="{{ asset('assets/admin/images/xs/avatar1.jpg') }}"
                                        alt="">
                                    <div class="media-body">
                                        <span class="name">Folisise Chosielie <small class="float-right">2hr
                                                ago</small></span>
                                        <span class="message">There are many of passages of available, but the
                                            majority</span>
                                        <span class="badge badge-outline status"></span>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="online">
                            <a href="javascript:void(0);">
                                <div class="media">
                                    <img class="media-object " src="{{ asset('assets/admin/images/xs/avatar3.jpg') }}"
                                        alt="">
                                    <div class="media-body">
                                        <span class="name">Marshall Nichols <small class="float-right">1day
                                                ago</small></span>
                                        <span class="message">It is a long fact that a reader will be distracted</span>
                                        <span class="badge badge-outline status"></span>
                                    </div>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div> --}}
</div>

<div id="left-sidebar" class="sidebar">
    <div class="navbar-brand d-flex align-items-center justify-content-between">
        <a href="{{ route('admin') }}">
            <img src="{{ asset('assets/website/images/logo/white-logo.png') }}" alt="SkillVerse Logo"
                class="img-fluid logo" style="max-height:45px;">
        </a>

        <button type="button" class="btn btn-sm btn-toggle-offcanvas" title="Hide Sidebar">
            <i class="fa-solid fa-chevron-left"></i>
        </button>
    </div>

    <div class="sidebar-scroll">
        <div class="user-account">
            <div class="user_div">
                <img src="{{ Auth::user()->image ? asset(Auth::user()->image) : asset('assets/admin/images/user.png') }}"
                    class="user-photo" alt="User Profile Picture">
            </div>

            <div class="dropdown">
                <span>Welcome,</span>
                <a href="javascript:void(0);" class="dropdown-toggle user-name"
                    data-toggle="dropdown"><strong>{{ Auth::user()->name }}</strong></a>
                <ul class="dropdown-menu dropdown-menu-right account">
                    <li><a href="{{ route('profile.index') }}"><i class="icon-user"></i>My Profile</a></li>
                    <li><a href="{{ route('message.index') }}"><i class="icon-envelope-open"></i>Messages</a></li>
                    <li class="divider"></li>
                    <li><a href="{{ route('auth.logout') }}"><i class="icon-power"></i>Logout</a></li>
                </ul>
            </div>
        </div>

        <nav id="left-sidebar-nav" class="sidebar-nav">
            <ul id="main-menu" class="metismenu">

                {{-- Admin Only --}}
                @auth
                    @if (Auth::user()->role === 'admin')
                        <li class=""><a href="{{ route('admin') }}"><i
                                    class="icon-home"></i><span>Dashboard</span></a> </li>
                        <li>
                            <a href="#uiElements" class="has-arrow"><i class="fas fa-user-tie"></i><span>Teachers</span></a>
                            <ul>
                                <li><a href="{{ route('teacher.index') }}">All Teacher</a></li>
                                <li><a href="{{ route('teacher.create') }}">Add New Teacher</a></li>
                                <li><a href="{{ route('teacher-salary.index') }}">Teachers Salary</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="#" class="has-arrow"><i class="fas fa-coins"></i><span>My Profits</span></a>
                            <ul>
                                <li><a href="{{ route('admin.partner_profits.index') }}">Partner Profits</a>
                                </li>
                                <li><a href="{{ route('admin.partner_profits.partner_balances.index') }}">My
                                        Balance</a></li>
                            </ul>
                        </li>

                        <li>
                            <a href="#" class="has-arrow text-nowrap">
                                <i class="fas fa-user-friends me-2"></i>
                                <span>Partners</span>
                            </a>
                            <ul>
                                <li><a href="{{ route('admin.partners.index') }}">All Partners</a></li>
                                <li><a href="{{ route('admin.partner_profits.index') }}">All Profits</a></li>
                                <li><a href="{{ route('admin.partner_profits.partner_balances.index') }}">All
                                        Balances</a></li>
                                <li><a href="{{ route('admin.partner_profits.full_history') }}">Profit History</a></li>
                            </ul>
                        </li>

                        <li>
                            <a href="#uiElements" class="has-arrow"><i class="fas fa-users"></i><span>Batches</span></a>
                            <ul>
                                <li><a href="{{ route('batch.index') }}">All Batches</a></li>
                                <li><a href="{{ route('batch.create') }}">Add New Batch</a></li>
                            </ul>
                        </li>

                        <li>
                            <a href="#uiElements" class="has-arrow"><i class="fas fa-user-plus"></i>
                                <span>Leads</span></a>
                            <ul>
                                <li><a href="{{ route('lead.index') }}">All Leads</a></li>
                                <li><a href="{{ route('lead.create') }}">Add New Lead</a></li>
                            </ul>
                        </li>

                        <li>
                            <a href="#uiElements" class="has-arrow"><i
                                    class="fas fa-file-signature"></i><span>Addmissions</span></a>
                            <ul>
                                <li><a href="{{ route('admission.index') }}">All Addmissions</a></li>
                                <li><a href="{{ route('admission.create') }}">Add New Addmission</a></li>
                            </ul>
                        </li>

                        <li>
                            <a href="#attendanceMenu" class="has-arrow">
                                <i class="fas fa-user-check"></i>
                                <span>Attendance</span>
                            </a>
                            <ul>
                                <li><a href="{{ route('student.attendance.index') }}">Student Attendance</a></li>
                                <li><a href="{{ route('teacher.attendance.index') }}">Teacher Attendance</a></li>
                            </ul>
                        </li>

                        <li><a href="{{ route('fee-submission.index') }}"><i class="fas fa-money-check-alt"></i><span>Fee
                                    Submission</span></a></li>

                        {{-- <li> <a href="{{ route('admin.profit.index') }}">
                                <i class="fas fa-chart-line"></i><span>Profit Calculation</span></a></li> --}}

                        <li> <a href="{{ route('referral-commission.index') }}">
                                <i class="fas fa-handshake"></i><span>Referral Commission</span></a></li>

                        <li>
                            <a href="#uiElements" class="has-arrow"><i
                                    class="fas fa-university"></i><span>Accounts</span></a>
                            <ul>
                                <li><a href="{{ route('account.index') }}">All Accounts</a></li>
                                <li><a href="{{ route('account.create') }}">Add New Account</a></li>
                            </ul>
                        </li>
                        <li> <a href="{{ route('fee-collector.index') }}">
                                <i class="fas fa-money-bill-wave"></i><span>Fee Collector</span></a></li>
                        <li>
                            <a href="#uiElements" class="has-arrow"><i class="fas fa-receipt"></i><span>Expenses</span></a>
                            <ul>
                                <li><a href="{{ route('expense.index') }}">All Expense</a></li>
                                <li><a href="{{ route('expense.create') }}">Add New Expense</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="#uiElements" class="has-arrow"><i
                                    class="icon-user-following"></i><span>Users</span></a>
                            <ul>
                                <li><a href="{{ route('user.index') }}">All Users</a></li>
                                <li><a href="{{ route('user.create') }}">Add New User</a></li>
                            </ul>
                        </li>
                        <li><a href="{{ route('message.index') }}"><i class="icon-bubbles"></i><span>Messages</span></a>
                        </li>


                        <li class="menu-title"
                            style="padding: 10px 0px; font-weight: bold; color: #6c757d; font-size: 14px;">
                            Websites Changes
                        </li>
                        <li>
                            <a href="#uiElements" class="has-arrow"><i class="bi bi-image"></i><span>Banner</span></a>
                            <ul>
                                <li><a href="{{ route('banner.index') }}">All Banner</a></li>
                                <li><a href="{{ route('banner.create') }}">Add New Banner</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="#uiElements" class="has-arrow"><i class="fas fa-layer-group"></i><span>Course
                                    Category</span></a>
                            <ul>
                                <li><a href="{{ route('course-category.index') }}">All Categories</a></li>
                                <li><a href="{{ route('course-category.create') }}">Add New Category</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="#uiElements" class="has-arrow"><i
                                    class="fas fa-chalkboard-teacher"></i><span>Courses</span></a>
                            <ul>
                                <li><a href="{{ route('course.index') }}">All Courses</a></li>
                                <li><a href="{{ route('course.create') }}">Add New Course</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="#uiElements" class="has-arrow"><i
                                    class="fas fa-calendar-alt"></i><span>Events</span></a>
                            <ul>
                                <li><a href="{{ route('event.index') }}">All Events</a></li>
                                <li><a href="{{ route('event.create') }}">Add New Event</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="#uiElements" class="has-arrow"><i class="fas fa-images"></i><span>Gallary
                                    Images</span></a>
                            <ul>
                                <li><a href="{{ route('gallary-category.index') }}">All Image Category</a></li>
                                <li><a href="{{ route('gallary-image.index') }}">All Images</a></li>
                                <li><a href="{{ route('gallary-image.create') }}">Add New Image</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="#uiElements" class="has-arrow"><i class="fas fa-chart-line"></i><span>Popular
                                    Courses</span></a>
                            <ul>
                                <a href="{{ route('popular-course.index') }}">All Popular Courses</a>
                                <a href="{{ route('popular-course.create') }}">Add New Popular Course</a>

                            </ul>
                        </li>
                        <li>
                            <a href="#uiElements" class="has-arrow"><i class="fas fa-project-diagram"></i><span>Recent
                                    Project</span></a>
                            <ul>
                                <li><a href="{{ route('project.index') }}">All Project</a></li>
                                <li><a href="{{ route('project.create') }}">Add New Project</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="#uiElements" class="has-arrow"><i class="fas fa-newspaper"></i><span>Blog</span></a>
                            <ul>
                                <li><a href="{{ route('blog.index') }}">All Blog</a></li>
                                <li><a href="{{ route('blog.create') }}">Add New Blog</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="#uiElements" class="has-arrow"><i
                                    class="fas fa-chart-bar"></i><span>Counter</span></a>
                            <ul>
                                <li><a href="{{ route('counter.index') }}">All Counters</a></li>
                                <li><a href="{{ route('counter.create') }}">Add New Counter</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="#uiElements" class="has-arrow"><i class="fas fa-comments"></i><span>Students
                                    Feedback</span></a>
                            <ul>
                                <li><a href="{{ route('testimonial.index') }}">All Feedback</a></li>
                                <li><a href="{{ route('testimonial.create') }}">Add New Feedback</a></li>
                            </ul>
                        </li>
                    @endif

                    {{-- Partner Only --}}
                    @if (Auth::user()->role === 'partner')
                        <li class=""><a href="{{ route('admin') }}"><i
                                    class="icon-home"></i><span>Dashboard</span></a> </li>
                        <li>
                        <li>
                            <a href="#" class="has-arrow"><i class="fas fa-coins"></i><span>My Profits</span></a>
                            <ul>
                                <li><a href="{{ route('admin.partner_profits.index') }}">Partner Profits</a></li>
                                <li><a href="{{ route('admin.partner_profits.partner_balances.index') }}">My Balance</a>
                                </li>
                                <li><a href="{{ route('admin.partner_profits.full_history') }}">Profit History</a></li>
                            </ul>
                        </li>
                        <li class=""><a href="{{ route('expense.index') }}"><i
                                    class="fas fa-receipt"></i><span>All Expenses</span></a> </li>
                        <li>
                        <li class=""><a href="{{ route('user.index') }}"><i
                                    class="icon-user-following"></i><span>User</span></a> </li>
                        <li>
                    @endif

                    {{-- Administrator Only --}}
                    @if (Auth::user()->role === 'administrator')
                        <li><a href="{{ route('admin') }}"><i class="icon-home"></i><span>Dashboard</span></a></li>
                        <li>
                            <a href="#" class="has-arrow"><i class="fas fa-user-tie"></i><span>Teachers</span></a>
                            <ul>
                                <li><a href="{{ route('teacher.index') }}">All Teacher</a></li>
                                <li><a href="{{ route('teacher.create') }}">Add New Teacher</a></li>
                                <li><a href="{{ route('teacher-salary.index') }}">Teachers Salary</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="#" class="has-arrow"><i class="fas fa-users"></i><span>Batches</span></a>
                            <ul>
                                <li><a href="{{ route('batch.index') }}">All Batches</a></li>
                                <li><a href="{{ route('batch.create') }}">Add New Batch</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="#" class="has-arrow"><i class="fas fa-user-plus"></i><span>Leads</span></a>
                            <ul>
                                <li><a href="{{ route('lead.index') }}">All Leads</a></li>
                                <li><a href="{{ route('lead.create') }}">Add New Lead</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="#" class="has-arrow"><i
                                    class="fas fa-file-signature"></i><span>Admissions</span></a>
                            <ul>
                                <li><a href="{{ route('admission.index') }}">All Admissions</a></li>
                                <li><a href="{{ route('admission.create') }}">Add New Admission</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="#attendanceMenu" class="has-arrow">
                                <i class="fas fa-user-check"></i>
                                <span>Attendance</span>
                            </a>
                            <ul>
                                <li><a href="{{ route('student.attendance.index') }}">Student Attendance</a></li>
                                <li><a href="{{ route('teacher.attendance.index') }}">Teacher Attendance</a></li>
                            </ul>
                        </li>
                        <li><a href="{{ route('fee-submission.index') }}"><i class="fas fa-money-check-alt"></i><span>Fee
                                    Submission</span></a></li>
                        <li><a href="{{ route('course.index') }}"><i
                                    class="fas fa-chalkboard-teacher"></i><span>Courses</span></a></li>
                        <li><a href="{{ route('message.index') }}"><i class="icon-bubbles"></i><span>Messages</span></a>
                        </li>
                        {{-- Website Changes --}}
                        {{-- <li class="menu-title">Websites Changes</li>
                        <li><a href="{{ route('banner.index') }}"><i class="bi bi-image"></i><span>Banners</span></a>
                        </li>
                        <li><a href="{{ route('course.index') }}"><i
                                    class="fas fa-chalkboard-teacher"></i><span>Courses</span></a></li>
                        <li><a href="{{ route('event.index') }}"><i
                                    class="fas fa-calendar-alt"></i><span>Events</span></a></li>
                        <li><a href="{{ route('gallary-image.index') }}"><i
                                    class="fas fa-images"></i><span>Gallery</span></a></li>
                        <li><a href="{{ route('blog.index') }}"><i class="fas fa-newspaper"></i><span>Blog</span></a>
                        </li>
                        <li><a href="{{ route('testimonial.index') }}"><i
                                    class="fas fa-comments"></i><span>Feedback</span></a></li> --}}
                    @endif


                    {{-- Common for all roles --}}
                    {{-- <li><a href="{{ route('profile') }}"><i class="icon-user"></i> Profile</a></li> --}}
                    {{-- <li><a href="{{ route('logout') }}"><i class="icon-logout"></i> Logout</a></li> --}}
                @endauth

            </ul>
        </nav>
    </div>
</div>
