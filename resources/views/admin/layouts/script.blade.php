</div>
<!-- Javascript -->
<script src="{{ asset('assets/admin/bundles/libscripts.bundle.js') }}"></script>
<script src="{{ asset('assets/admin/bundles/vendorscripts.bundle.js') }}"></script>
<script src="{{ asset('assets/admin/bundles/c3.bundle.js') }}"></script>
<script src="{{ asset('assets/admin/bundles/chartist.bundle.js') }}"></script>
<script src="{{ asset('assets/admin/vendor/toastr/toastr.js') }}"></script>
<script src="{{ asset('assets/admin/bundles/mainscripts.bundle.js') }}"></script>
<script src="{{ asset('assets/admin/js/index.js') }}"></script>

{{-- forms --}}
<script src="{{ asset('assets/admin/vendor/bootstrap-multiselect/bootstrap-multiselect.js') }}"></script>
<script src="{{ asset('assets/admin/vendor/parsleyjs/js/parsley.min.js') }}"></script>

{{-- jQuery --}}
<script src="{{ asset('assets/admin/bundles/datatablescripts.bundle.js') }}"></script>
<script src="{{ asset('assets/admin/vendor/jquery-datatable/buttons/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('assets/admin/vendor/jquery-datatable/buttons/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/admin/vendor/jquery-datatable/buttons/buttons.colVis.min.js') }}"></script>
<script src="{{ asset('assets/admin/vendor/jquery-datatable/buttons/buttons.html5.min.js') }}"></script>
<script src="{{ asset('assets/admin/vendor/jquery-datatable/buttons/buttons.print.min.js') }}"></script>
<script src="{{ asset('assets/admin/vendor/sweetalert/sweetalert.min.js') }}"></script>
<script src="{{ asset('assets/admin/bundles/mainscripts.bundle.js') }}"></script>
<script src="{{ asset('assets/admin/js/pages/tables/jquery-datatable.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        const toggleBtn = document.querySelector('.btn-toggle-offcanvas');
        if (toggleBtn) {
            toggleBtn.addEventListener('click', function() {
                document.body.classList.toggle('offcanvas-active');
            });
        }
    });
</script>

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
{{-- // Notification Bell Icon  --}}
<meta name="csrf-token" content="{{ csrf_token() }}">

<!-- Script -->
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
        fetch("{{ route('notifications.index') }}")
            .then(res => res.json())
            .then(data => {
                let list = document.getElementById('notificationList');
                let dot = document.getElementById('notificationDot');

                // Show dot only if unread notifications exist
                dot.style.display = (data.length > 0) ? "inline-block" : "none";

                let html = '';

                if (data.length === 0) {
                    // Clean empty state
                    html += `
                        <li class="header">Notifications</li>
                        <li style="padding: 30px 20px; text-align: center; color: #6c757d;">
                            <i class="fa fa-bell-slash" style="font-size: 24px; margin-bottom: 10px; display: block; opacity: 0.5;"></i>
                            <span style="font-size: 14px;">No new notifications</span>
                        </li>
                    `;
                } else {
                    html += '<li class="header">You have ' + data.length + ' new Notification' + (data.length > 1 ? 's' : '') + '</li>';

                    data.forEach(n => {
                        html += `
                            <li id="notif-${n.id}">
                                <div class="feeds-left"><i class="${n.icon ?? 'fa fa-bell'}"></i></div>
                                <div class="feeds-body">
                                    <h4 class="title">${n.title}</h4>
                                    ${n.message ? `<small>${n.message}</small>` : ''}
                                    <small>${formatDate(n.created_at)}</small>
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
        fetch("{{ url('admin/notifications') }}/" + id + "/read", {
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
        fetch("{{ route('notifications.readAll') }}", {
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

{{-- // Message Icon (Contact & Booking) --}}
<script>
    // Format date as Today / Yesterday / d M Y + time
    function formatMessageDate(dateString) {
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


    // Load all unread messages into dropdown
    function loadMessages() {
        fetch("{{ route('messages.index') }}")
            .then(res => res.json())
            .then(data => {
                let list = document.getElementById('messageList');
                let dot = document.getElementById('messageDot');

                // Show dot only if unread messages exist
                dot.style.display = (data.length > 0) ? "inline-block" : "none";

                let html = '';

                if (data.length === 0) {
                    // Clean empty state
                    html += `
                        <li class="header">Messages</li>
                        <li class="text-center p-3 text-muted" style="font-style:italic;">
                            <i class="fa fa-envelope-open" style="font-size:16px; margin-right:5px;"></i>
                            No new messages
                        </li>
                    `;
                } else {
                    html += '<li class="header">You have ' + data.length + ' new Message' + (data.length > 1 ? 's' : '') + '</li>';

                    data.forEach(m => {
                        const icon = m.type === 'contact' ? 'fa fa-envelope' : 'fa fa-calendar-check';
                        const timeAgo = formatMessageDate(m.created_at);
                        const title = m.type === 'contact' ? `Contact: ${m.name || 'Unknown'}` : `Booking: ${m.name || 'Unknown'}`;
                        const messageText = m.message || (m.type === 'booking' ? `Interview booking for ${m.course || 'course'}` : 'No message');
                        const phoneInfo = m.phone ? ` | Phone: ${m.phone}` : '';

                        html += `
                            <li id="msg-${m.id}">
                                <div class="feeds-left"><i class="${icon}"></i></div>
                                <div class="feeds-body">
                                    <h4 class="title">${title}</h4>
                                    <small>${messageText}${phoneInfo}</small>
                                    <small>${timeAgo}</small>
                                </div>
                                <input type="checkbox" onchange="markMessageRead('${m.id}')" title="Mark as read">
                            </li>
                        `;
                    });

                    // Footer link: mark all as read
                    html += `
                        <li class="footer text-center">
                            <a href="javascript:void(0);" onclick="markAllMessagesRead()">Mark all as read</a>
                        </li>
                    `;
                }

                list.innerHTML = html;
            })
            .catch(err => console.error("Error loading messages:", err));
    }

    // Mark single message as read
    function markMessageRead(id) {
        fetch("{{ url('admin/messages') }}/" + id + "/read", {
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
                    document.getElementById("msg-" + id)?.remove();
                    loadMessages();
                }
            })
            .catch(err => console.error("Error marking message:", err));
    }

    // Mark all messages as read
    function markAllMessagesRead() {
        fetch("{{ route('messages.readAll') }}", {
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
                    loadMessages();
                }
            })
            .catch(err => console.error("Error marking all messages:", err));
    }

    // Auto-load messages when page is ready
    document.addEventListener("DOMContentLoaded", loadMessages);
</script>

</body>
</html>