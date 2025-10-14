

<?php $__env->startSection('content'); ?>
    <div id="main-content">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-md-6 col-sm-12">
                    <h2>Fee Submission</h2>
                </div>
                <div class="col-md-6 col-sm-12 text-right">
                    <a href="<?php echo e(route('admission.index')); ?>" class="btn btn-sm btn-primary">All Admissions</a>
                </div>
            </div>
        </div>

        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="header">
                            <h2>Fee Submission</h2>
                            <ul class="header-dropdown dropdown dropdown-animated scale-left">
                                <li><a href="javascript:void(0);" data-toggle="cardloading" data-loading-effect="pulse">
                                        <i class="icon-refresh"></i></a></li>
                                <li><a href="javascript:void(0);" class="full-screen"><i
                                            class="icon-size-fullscreen"></i></a></li>
                            </ul>
                        </div>

                        <div class="body">
                            
                            <form method="GET" action="<?php echo e(route('fee-submission.index')); ?>" id="filterForm"
                                class="mb-3">
                                <div class="input-group mb-2">
                                    <input type="text" name="search" value="<?php echo e(request('search')); ?>"
                                        class="form-control" placeholder="Search student..." autocomplete="off">
                                </div>

                                <div class="row" style="margin-top: 15px">
                                    <div class="col-md-3 mb-2">
                                        <select name="course_id" id="filter-course" class="form-control">
                                            <option value="">Filter by Course</option>
                                            <?php $__currentLoopData = $courses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $course): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($course->id); ?>"
                                                    <?php echo e((string) request('course_id') === (string) $course->id ? 'selected' : ''); ?>>
                                                    <?php echo e($course->title); ?>

                                                </option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>

                                    <div class="col-md-3 mb-2">
                                        <select name="status" id="filter-status" class="form-control">
                                            <option value="all"
                                                <?php echo e(request('status', 'all') === 'all' ? 'selected' : ''); ?>>All Fees Status
                                            </option>
                                            <option value="complete"
                                                <?php echo e(request('status') === 'complete' ? 'selected' : ''); ?>>Completed</option>
                                            <option value="uncomplete"
                                                <?php echo e(request('status') === 'uncomplete' ? 'selected' : ''); ?>>Remaining
                                            </option>
                                            <option value="pending" <?php echo e(request('status') === 'pending' ? 'selected' : ''); ?>>
                                                Pending</option>
                                        </select>
                                    </div>

                                    <div class="col-md-3 mb-2">
                                        <select name="payment" id="filter-payment" class="form-control">
                                            <option value="" <?php echo e(request('payment') ? '' : 'selected'); ?>>All Payment
                                                Types</option>
                                            <option value="full_fee"
                                                <?php echo e(request('payment') === 'full_fee' ? 'selected' : ''); ?>>Full Payment
                                            </option>
                                            <option value="installment"
                                                <?php echo e(request('payment') === 'installment' ? 'selected' : ''); ?>>Installment
                                            </option>
                                        </select>
                                    </div>

                                    <div class="col-md-3 mb-2">
                                        <input type="month" name="month" value="<?php echo e(request('month')); ?>"
                                            class="form-control">
                                    </div>

                                </div>
                            </form>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <div class="alert alert-success mb-0">
                                        <strong>Total Collected Fee:</strong> ₨ <?php echo e(number_format($totalCollected)); ?>

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="alert alert-warning mb-0">
                                        <strong>Total Remaining Fee:</strong> ₨ <?php echo e(number_format($totalRemaining)); ?>

                                    </div>
                                </div>
                            </div>

                            
                            <div class="table-responsive">
                                <table class="table table-hover mb-0" id="feeTable">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Course</th>
                                            <th>Fee Type</th>
                                            <th>Status</th>
                                            <th>Options</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__currentLoopData = $admissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $admission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr data-status="<?php echo e(strtolower($admission->fee_status)); ?>"
                                                data-payment="<?php echo e(strtolower($admission->payment_type)); ?>"
                                                data-course="<?php echo e(strtolower($admission->course->title)); ?>">
                                                <td><?php echo e($loop->iteration + ($admissions->currentPage() - 1) * $admissions->perPage()); ?>

                                                </td>
                                                <td><?php echo e($admission->name); ?></td>
                                                <td><?php echo e($admission->course->title); ?></td>
                                                <td>
                                                    <span
                                                        class="badge badge-<?php echo e($admission->payment_type === 'full_fee' ? 'success' : 'warning'); ?>">
                                                        <?php echo e(ucfirst($admission->payment_type)); ?>

                                                    </span>
                                                </td>
                                                <td>
                                                    <span
                                                        class="badge badge-<?php echo e($admission->fee_status === 'complete' ? 'success' : ($admission->fee_status === 'pending' ? 'danger' : 'warning')); ?>">
                                                        <?php echo e(ucfirst($admission->fee_status)); ?>

                                                    </span>
                                                </td>
                                                <td>
                                                    
                                                    <?php if($admission->payment_type === 'installment'): ?>
                                                        <button class="btn btn-sm btn-info toggle-installments">
                                                            <i class="fas fa-plus"></i>
                                                        </button>
                                                    <?php endif; ?>

                                                    <?php echo $__env->make('admin.pages.dashboard.fee-submission.button', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                                </td>
                                            </tr>

                                            
                                            <?php if($admission->payment_type === 'installment'): ?>
                                                <?php
                                                    // Collect all submissions for this student
                                                    $paidInstallments = $admission->feeSubmissions
                                                        ->pluck('payment_type')
                                                        ->toArray();

                                                    // Installments list with label + amount
                                                    $installments = [];
                                                    if ($admission->installment_1 > 0) {
                                                        $installments[] = [
                                                            'label' => '1st Installment',
                                                            'amount' => $admission->installment_1,
                                                            'key' => 'installment_1',
                                                        ];
                                                    }
                                                    if ($admission->installment_2 > 0) {
                                                        $installments[] = [
                                                            'label' => '2nd Installment',
                                                            'amount' => $admission->installment_2,
                                                            'key' => 'installment_2',
                                                        ];
                                                    }
                                                    if ($admission->installment_3 > 0) {
                                                        $installments[] = [
                                                            'label' => '3rd Installment',
                                                            'amount' => $admission->installment_3,
                                                            'key' => 'installment_3',
                                                        ];
                                                    }
                                                    if (
                                                        property_exists($admission, 'installment_4') &&
                                                        $admission->installment_4 > 0
                                                    ) {
                                                        $installments[] = [
                                                            'label' => '4th Installment',
                                                            'amount' => $admission->installment_4,
                                                            'key' => 'installment_4',
                                                        ];
                                                    }
                                                ?>

                                                <tr class="installment-details d-none">
                                                    <td colspan="6">
                                                        <table class="table table-sm table-bordered mb-0">
                                                            <thead>
                                                                <tr>
                                                                    <th>Full Fee</th>
                                                                    <?php $__currentLoopData = $installments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $inst): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                        <th><?php echo e($inst['label']); ?></th>
                                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    
                                                                    <td>₨<?php echo e(number_format($admission->full_fee)); ?></td>

                                                                    
                                                                    <?php $__currentLoopData = $installments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $inst): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                        <td>
                                                                            ₨<?php echo e(number_format($inst['amount'])); ?>

                                                                            <br>
                                                                            <span
                                                                                class="badge badge-<?php echo e(in_array($inst['key'], $paidInstallments) ? 'success' : 'danger'); ?>">
                                                                                <?php echo e(in_array($inst['key'], $paidInstallments) ? 'Paid' : 'Unpaid'); ?>

                                                                            </span>
                                                                        </td>
                                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                            <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                            </div>

                            
                            <div class="mt-3">
                                <?php echo e($admissions->links('pagination::bootstrap-4')); ?>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('additional-javascript'); ?>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const tableRows = document.querySelectorAll("#feeTable tbody tr");

            const searchInput = document.querySelector("input[name='search']");
            const courseFilter = document.getElementById("filter-course");
            const statusFilter = document.getElementById("filter-status");
            const paymentFilter = document.getElementById("filter-payment");

            function applyFilters() {
                let search = searchInput ? searchInput.value.toLowerCase() : "";
                let course = courseFilter.value.toLowerCase();
                let status = statusFilter.value.toLowerCase();
                let payment = paymentFilter.value.toLowerCase();

                tableRows.forEach(function(row) {
                    let rowText = row.innerText.toLowerCase();
                    let courseCol = row.getAttribute("data-course");
                    let statusCol = row.getAttribute("data-status");
                    let paymentCol = row.getAttribute("data-payment");

                    let visible =
                        (!search || rowText.includes(search)) &&
                        (!course || courseCol.includes(course)) &&
                        (!status || statusCol === status) &&
                        (!payment || paymentCol === payment);

                    row.style.display = visible ? "" : "none";
                });
            }

            if (searchInput) searchInput.addEventListener("keyup", applyFilters);
            [courseFilter, statusFilter, paymentFilter].forEach(el => {
                el.addEventListener("change", applyFilters);
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('filterForm');
            const search = form.querySelector('input[name="search"]');
            const selects = form.querySelectorAll('select, input[type="month"]');

            // auto-submit on change (includes month input now)
            selects.forEach(el => el.addEventListener('change', () => form.submit()));

            // debounce search typing → submit after 500ms of inactivity
            let t;
            search && search.addEventListener('input', () => {
                clearTimeout(t);
                t = setTimeout(() => form.submit(), 500);
            });
        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.querySelectorAll(".toggle-installments").forEach(function(button) {
                button.addEventListener("click", function() {
                    const row = this.closest("tr");
                    const detailsRow = row.nextElementSibling;

                    if (detailsRow && detailsRow.classList.contains("installment-details")) {
                        detailsRow.classList.toggle("d-none");

                        // change icon
                        const icon = this.querySelector("i");
                        if (icon.classList.contains("fa-plus")) {
                            icon.classList.remove("fa-plus");
                            icon.classList.add("fa-minus");
                        } else {
                            icon.classList.remove("fa-minus");
                            icon.classList.add("fa-plus");
                        }
                    }
                });
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\projects\codezy\zain-changes\codezy\resources\views/admin/pages/dashboard/fee-submission/index.blade.php ENDPATH**/ ?>