</div>

<!-- Javascript -->
<script src="<?php echo e(asset('assets/admin/bundles/libscripts.bundle.js')); ?>"></script>
<script src="<?php echo e(asset('assets/admin/bundles/vendorscripts.bundle.js')); ?>"></script>
<script src="<?php echo e(asset('assets/admin/bundles/c3.bundle.js')); ?>"></script>
<script src="<?php echo e(asset('assets/admin/bundles/chartist.bundle.js')); ?>"></script>
<script src="<?php echo e(asset('assets/admin/vendor/toastr/toastr.js')); ?>"></script>
<script src="<?php echo e(asset('assets/admin/bundles/mainscripts.bundle.js')); ?>"></script>
<script src="<?php echo e(asset('assets/admin/js/index.js')); ?>"></script>


<script src="<?php echo e(asset('assets/admin/vendor/bootstrap-multiselect/bootstrap-multiselect.js')); ?>"></script>
<script src="<?php echo e(asset('assets/admin/vendor/parsleyjs/js/parsley.min.js')); ?>"></script>


<script src="<?php echo e(asset('assets/admin/bundles/datatablescripts.bundle.js')); ?>"></script>
<script src="<?php echo e(asset('assets/admin/vendor/jquery-datatable/buttons/dataTables.buttons.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/admin/vendor/jquery-datatable/buttons/buttons.bootstrap4.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/admin/vendor/jquery-datatable/buttons/buttons.colVis.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/admin/vendor/jquery-datatable/buttons/buttons.html5.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/admin/vendor/jquery-datatable/buttons/buttons.print.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/admin/vendor/sweetalert/sweetalert.min.js')); ?>"></script><!-- SweetAlert Plugin Js -->
<script src="<?php echo e(asset('assets/admin/bundles/mainscripts.bundle.js')); ?>"></script>
<script src="<?php echo e(asset('assets/admin/js/pages/tables/jquery-datatable.js')); ?>"></script>


<script>
    document.addEventListener("DOMContentLoaded", function() {
        let currentUrl = window.location.href;
        let menuItems = document.querySelectorAll("#main-menu a");

        menuItems.forEach(item => {
            if (item.href === currentUrl) {
                item.classList.add("active");
                let parentLi = item.closest("li");
                if (parentLi) {
                    parentLi.classList.add("active");
                }
                let parentUl = item.closest("ul");
                if (parentUl && parentUl.parentElement.tagName === "LI") {
                    parentUl.parentElement.classList.add("active");
                }
            }
        });
    });
</script>

<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

<script>
    // Format date as Today / Yesterday / d M Y + time
    function formatDate(dateString) {
        const date = new Date(dateString);
        const today = new Date();
        const yesterday = new Date();
        yesterday.setDate(today.getDate() - 1);

        const options = {
            hour: '2-digit',
            minute: '2-digit',
            hour12: true
        };

        const isToday = date.toDateString() === today.toDateString();
        const isYesterday = date.toDateString() === yesterday.toDateString();

        if (isToday) return "Today at " + date.toLocaleTimeString('en-US', options);
        if (isYesterday) return "Yesterday at " + date.toLocaleTimeString('en-US', options);

        return date.toLocaleDateString('en-GB', {
                day: '2-digit',
                month: 'short',
                year: 'numeric'
            }) +
            " at " + date.toLocaleTimeString('en-US', options);
    }

    // Load all unread notifications into dropdown
    function loadNotifications() {
        fetch("<?php echo e(route('notifications.index')); ?>")
            .then(res => res.json())
            .then(data => {
                let list = document.getElementById('notificationList');
                let dot = document.getElementById('notificationDot');

                // Show dot only if unread notifications exist
                dot.style.display = (data.length > 0) ? "inline-block" : "none";

                let html = '<li class="header">You have ' + data.length + ' new Notifications</li>';

                if (data.length === 0) {
                    html += `<li class="text-center p-2">No new notifications</li>`;
                } else {
                    data.forEach(n => {
                        html += `
                            <li id="notif-${n.id}" 
                                style="border-bottom:1px solid #f1f1f1; padding:6px 10px; display:flex; align-items:center; justify-content:space-between;">
                                
                                <div style="flex:1; padding-right:8px;">
                                    <div class="feeds-left"><i class="${n.icon ?? 'fa fa-bell'}"></i></div>
                                    <div class="feeds-body">
                                        <h4 class="title mb-0">${n.title}</h4>
                                        <small class="text-muted">${n.message ?? ''}</small><br>
                                        <small class="text-secondary">${formatDate(n.created_at)}</small>
                                    </div>
                                </div>

                                <input type="checkbox" onchange="markRead(${n.id})" title="Mark as read">
                            </li>
                        `;
                    });

                    // Footer link: mark all as read
                    html += `
                        <li class="footer text-center">
                            <a href="javascript:void(0);" onclick="markAllRead()">Mark all as read</a>
                        </li>
                    `;
                }

                list.innerHTML = html;
            })
            .catch(err => console.error("Error loading notifications:", err));
    }

    // Mark single notification as read
    function markRead(id) {
        fetch("<?php echo e(url('admin/notifications')); ?>/" + id + "/read", {
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content"),
                    "Content-Type": "application/json",
                    "Accept": "application/json"
                },
                body: JSON.stringify({})
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    document.getElementById("notif-" + id).remove();
                    loadNotifications();
                }
            })
            .catch(err => console.error("Error marking notification:", err));
    }

    // Mark all notifications as read
    function markAllRead() {
        fetch("<?php echo e(route('notifications.readAll')); ?>", {
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content"),
                    "Content-Type": "application/json",
                    "Accept": "application/json"
                }
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    loadNotifications();
                }
            })
            .catch(err => console.error("Error marking all notifications:", err));
    }

    // Auto-load notifications when page is ready
    document.addEventListener("DOMContentLoaded", loadNotifications);
</script>

</body>

</html>
<?php /**PATH E:\projects\codezy\zain-changes\codezy\resources\views/admin/layouts/script.blade.php ENDPATH**/ ?>