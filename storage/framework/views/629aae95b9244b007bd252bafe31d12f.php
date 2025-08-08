<div id="rightbar" class="rightbar">
    <ul class="nav nav-tabs-new">
        <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#setting">Settings</a></li>
        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#chat">Chat</a></li>
    </ul>
    <div class="tab-content">
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
                                    <img class="media-object " src="<?php echo e(asset('assets/admin/images/xs/avatar4.jpg')); ?>"
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
                                    <img class="media-object " src="<?php echo e(asset('assets/images/xs/avatar5.jpg')); ?>"
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
                                    <img class="media-object " src="<?php echo e(asset('assets/admin/images/xs/avatar2.jpg')); ?>"
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
                                    <img class="media-object " src="<?php echo e(asset('assets/admin/images/xs/avatar1.jpg')); ?>"
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
                                    <img class="media-object " src="<?php echo e(asset('assets/admin/images/xs/avatar3.jpg')); ?>"
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
    </div>
</div>

<div id="left-sidebar" class="sidebar">
    <div class="navbar-brand">
        <a href="index.html"><img src="<?php echo e(asset('assets/website/images/logo/white-logo.png')); ?>" alt="HexaBit Logo"
                class="img-fluid logo">
            
        </a>
        <button type="button" class="btn-toggle-offcanvas btn btn-sm btn-default float-right"><i
                class="lnr lnr-menu fa fa-chevron-circle-left"></i></button>
    </div>
    <div class="sidebar-scroll">
        <div class="user-account">
            <div class="user_div">
                <img src="<?php echo e(asset('assets/admin/images/user.png')); ?>" class="user-photo" alt="User Profile Picture">
            </div>
            <div class="dropdown">
                <span>Welcome,</span>
                <a href="javascript:void(0);" class="dropdown-toggle user-name"
                    data-toggle="dropdown"><strong><?php echo e(Auth::user()->name); ?></strong></a>
                <ul class="dropdown-menu dropdown-menu-right account">
                    <li><a href="page-profile.html"><i class="icon-user"></i>My Profile</a></li>
                    <li><a href="app-inbox.html"><i class="icon-envelope-open"></i>Messages</a></li>
                    <li><a href="javascript:void(0);"><i class="icon-settings"></i>Settings</a></li>
                    <li class="divider"></li>
                    <li><a href="<?php echo e(route('auth.logout')); ?>"><i class="icon-power"></i>Logout</a></li>
                </ul>
            </div>
        </div>

        <nav id="left-sidebar-nav" class="sidebar-nav">
            <ul id="main-menu" class="metismenu">

                
                <?php if(auth()->guard()->check()): ?>
                    <?php if(Auth::user()->role === 'admin'): ?>
                        <li class=""><a href="<?php echo e(route('admin')); ?>"><i
                                    class="icon-home"></i><span>Dashboard</span></a> </li>
                        <li>
                            <a href="#uiElements" class="has-arrow"><i
                                    class="fas fa-user-tie"></i><span>Teachers</span></a>
                            <ul>
                                <li><a href="<?php echo e(route('teacher.index')); ?>">All Teacher</a></li>
                                <li><a href="<?php echo e(route('teacher.create')); ?>">Add New Teacher</a></li>
                                <li><a href="<?php echo e(route('teacher-salary.index')); ?>">Teachers Salary</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="#" class="has-arrow"><i class="fas fa-coins"></i><span>My Profits</span></a>
                            <ul>
                                <li><a href="<?php echo e(route('admin.dashboard.partner_profits.index')); ?>">Partner Profits</a>
                                </li>
                                <li><a href="<?php echo e(route('admin.dashboard.partner_profits.partner_balances.index')); ?>">My
                                        Balance</a></li>
                            </ul>
                        </li>

                        <li>
                            <a href="#" class="has-arrow text-nowrap">
                                <i class="fas fa-user-friends me-2"></i>
                                <span>Partners</span>
                            </a>
                            <ul>
                                <li><a href="<?php echo e(route('admin.dashboard.partners.index')); ?>">All Partners</a></li>
                                <li><a href="<?php echo e(route('admin.dashboard.partner_profits.index')); ?>">All Profits</a></li>
                                <li><a href="<?php echo e(route('admin.dashboard.partner_profits.partner_balances.index')); ?>">All
                                        Balances</a></li>
                                <li><a href="<?php echo e(route('admin.dashboard.partner_profits.history', ['partner_id' => 1])); ?>">Profit
                                        History</a></li>
                            </ul>
                        </li>

                        <li>
                            <a href="#uiElements" class="has-arrow"><i class="fas fa-users"></i><span>Batches</span></a>
                            <ul>
                                <li><a href="<?php echo e(route('batch.index')); ?>">All Batches</a></li>
                                <li><a href="<?php echo e(route('batch.create')); ?>">Add New Batch</a></li>
                            </ul>
                        </li>

                        <li>
                            <a href="#uiElements" class="has-arrow"><i class="fas fa-user-plus"></i>
                                <span>Leads</span></a>
                            <ul>
                                <li><a href="<?php echo e(route('lead.index')); ?>">All Leads</a></li>
                                <li><a href="<?php echo e(route('lead.create')); ?>">Add New Lead</a></li>
                            </ul>
                        </li>

                        <li>
                            <a href="#uiElements" class="has-arrow"><i
                                    class="fas fa-file-signature"></i><span>Addmissions</span></a>
                            <ul>
                                <li><a href="<?php echo e(route('admission.index')); ?>">All Addmissions</a></li>
                                <li><a href="<?php echo e(route('admission.create')); ?>">Add New Addmission</a></li>
                            </ul>
                        </li>

                        <li><a href="<?php echo e(route('fee-submission.index')); ?>"><i class="fas fa-money-check-alt"></i><span>Fee
                                    Submission</span></a></li>

                        <li> <a href="<?php echo e(route('admin.dashboard.profit.index')); ?>">
                                <i class="fas fa-chart-line"></i><span>Profit Calculation</span></a></li>

                        <li> <a href="<?php echo e(route('admin.dashboard.referrals.index')); ?>">
                                <i class="fas fa-handshake"></i><span>Referral Commission</span></a></li>

                        <li>
                            <a href="#uiElements" class="has-arrow"><i
                                    class="fas fa-university"></i><span>Accounts</span></a>
                            <ul>
                                <li><a href="<?php echo e(route('account.index')); ?>">All Accounts</a></li>
                                <li><a href="<?php echo e(route('account.create')); ?>">Add New Account</a></li>
                            </ul>
                        </li>
                            <li> <a href="<?php echo e(route('fee-collector.index')); ?>">
                                <i class="fas fa-money-bill-wave"></i><span>Fee Collector</span></a></li>
                        <li>
                            <a href="#uiElements" class="has-arrow"><i
                                    class="fas fa-receipt"></i><span>Expenses</span></a>
                            <ul>
                                <li><a href="<?php echo e(route('expense.index')); ?>">All Expense</a></li>
                                <li><a href="<?php echo e(route('expense.create')); ?>">Add New Expense</a></li>
                            </ul>
                        </li>
                         <li>
                            <a href="#uiElements" class="has-arrow"><i class="icon-user-following"></i><span>Users</span></a>
                            <ul>
                                <li><a href="<?php echo e(route('user.index')); ?>">All Users</a></li>
                                <li><a href="<?php echo e(route('user.create')); ?>">Add New User</a></li>
                            </ul>
                        </li>
                        <li><a href="<?php echo e(route('message.index')); ?>"><i class="icon-bubbles"></i><span>Messages</span></a>
                        </li>


                        <li class="menu-title"
                            style="padding: 10px 0px; font-weight: bold; color: #6c757d; font-size: 14px;">
                            Websites Changes
                        </li>
                        <li>
                            <a href="#uiElements" class="has-arrow"><i class="bi bi-image"></i><span>Banner</span></a>
                            <ul>
                                <li><a href="<?php echo e(route('banner.index')); ?>">All Banner</a></li>
                                <li><a href="<?php echo e(route('banner.create')); ?>">Add New Banner</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="#uiElements" class="has-arrow"><i class="fas fa-layer-group"></i><span>Course
                                    Category</span></a>
                            <ul>
                                <li><a href="<?php echo e(route('course-category.index')); ?>">All Categories</a></li>
                                <li><a href="<?php echo e(route('course-category.create')); ?>">Add New Category</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="#uiElements" class="has-arrow"><i
                                    class="fas fa-chalkboard-teacher"></i><span>Courses</span></a>
                            <ul>
                                <li><a href="<?php echo e(route('course.index')); ?>">All Courses</a></li>
                                <li><a href="<?php echo e(route('course.create')); ?>">Add New Course</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="#uiElements" class="has-arrow"><i
                                    class="fas fa-calendar-alt"></i><span>Events</span></a>
                            <ul>
                                <li><a href="<?php echo e(route('event.index')); ?>">All Events</a></li>
                                <li><a href="<?php echo e(route('event.create')); ?>">Add New Event</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="#uiElements" class="has-arrow"><i class="fas fa-images"></i><span>Gallary Images</span></a>
                            <ul>
                                <li><a href="<?php echo e(route('gallary-category.index')); ?>">All Image Category</a></li>
                                <li><a href="<?php echo e(route('gallary-image.index')); ?>">All Images</a></li>
                                <li><a href="<?php echo e(route('gallary-image.create')); ?>">Add New Image</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="#uiElements" class="has-arrow"><i class="fas fa-chart-line"></i><span>Popular
                                    Courses</span></a>
                            <ul>
                                <a href="<?php echo e(route('popular-course.index')); ?>">All Popular Courses</a>
                                <a href="<?php echo e(route('popular-course.create')); ?>">Add New Popular Course</a>

                            </ul>
                        </li>
                        <li>
                            <a href="#uiElements" class="has-arrow"><i class="fas fa-project-diagram"></i><span>Recent
                                    Project</span></a>
                            <ul>
                                <li><a href="<?php echo e(route('project.index')); ?>">All Project</a></li>
                                <li><a href="<?php echo e(route('project.create')); ?>">Add New Project</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="#uiElements" class="has-arrow"><i class="fas fa-newspaper"></i><span>Blog</span></a>
                            <ul>
                                <li><a href="<?php echo e(route('blog.index')); ?>">All Blog</a></li>
                                <li><a href="<?php echo e(route('blog.create')); ?>">Add New Blog</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="#uiElements" class="has-arrow"><i
                                    class="fas fa-chart-bar"></i><span>Counter</span></a>
                            <ul>
                                <li><a href="<?php echo e(route('counter.index')); ?>">All Counters</a></li>
                                <li><a href="<?php echo e(route('counter.create')); ?>">Add New Counter</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="#uiElements" class="has-arrow"><i class="fas fa-comments"></i><span>Students
                                    Feedback</span></a>
                            <ul>
                                <li><a href="<?php echo e(route('testimonial.index')); ?>">All Feedback</a></li>
                                <li><a href="<?php echo e(route('testimonial.create')); ?>">Add New Feedback</a></li>
                            </ul>
                        </li>
                    <?php endif; ?>

                    
                    <?php if(Auth::user()->role === 'partner'): ?>
                    <?php endif; ?>

                    
                    <?php if(Auth::user()->role === 'administrator'): ?>
                    <?php endif; ?>

                    
                    
                    
                <?php endif; ?>

            </ul>
        </nav>
    </div>
</div>
<?php /**PATH E:\projects\codezy\zain-changes\codezy\resources\views/admin/layouts/sidebar.blade.php ENDPATH**/ ?>