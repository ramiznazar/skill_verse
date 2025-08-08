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
<script src="{{ asset('assets/admin/vendor/bootstrap-multiselect/bootstrap-multiselect.js')}}"></script>
<script src="{{ asset('assets/admin/vendor/parsleyjs/js/parsley.min.js')}}"></script>

{{-- jQuery --}}
<script src="{{ asset('assets/admin/bundles/datatablescripts.bundle.js') }}"></script>
<script src="{{ asset('assets/admin/vendor/jquery-datatable/buttons/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('assets/admin/vendor/jquery-datatable/buttons/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/admin/vendor/jquery-datatable/buttons/buttons.colVis.min.js') }}"></script>
<script src="{{ asset('assets/admin/vendor/jquery-datatable/buttons/buttons.html5.min.js') }}"></script>
<script src="{{ asset('assets/admin/vendor/jquery-datatable/buttons/buttons.print.min.js') }}"></script>
<script src="{{ asset('assets/admin/vendor/sweetalert/sweetalert.min.js') }}"></script><!-- SweetAlert Plugin Js --> 
<script src="{{ asset('assets/admin/bundles/mainscripts.bundle.js') }}"></script>
<script src="{{ asset('assets/admin/js/pages/tables/jquery-datatable.js') }}"></script>


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
</body>
</html>