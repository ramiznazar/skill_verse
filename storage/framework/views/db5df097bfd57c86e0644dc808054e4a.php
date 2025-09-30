

<?php $__env->startSection('content'); ?>
    <div id="main-content">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-md-6 col-sm-12">
                    <h2>Student Admissions</h2>
                </div>
                <div class="col-md-6 col-sm-12 text-right">
                    <a href="<?php echo e(route('admission.create')); ?>" class="btn btn-sm btn-primary">Create New</a>
                </div>
            </div>
        </div>

        
        <?php $__currentLoopData = ['store' => 'success', 'delete' => 'danger', 'update' => 'warning']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if(session($key)): ?>
                <div class="alert alert-<?php echo e($type); ?> alert-dismissible fade show" role="alert">
                    <?php echo e(session($key)); ?>

                    <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
                </div>
            <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="header">
                            <h2>All Admissions</h2>
                            <ul class="header-dropdown dropdown dropdown-animated scale-left">
                                <li><a href="javascript:void(0);" data-toggle="cardloading" data-loading-effect="pulse"><i
                                            class="icon-refresh"></i></a></li>
                                <li><a href="javascript:void(0);" class="full-screen"><i
                                            class="icon-size-fullscreen"></i></a></li>
                            </ul>
                        </div>

                        <div class="body">

                            
                            <form method="GET" action="<?php echo e(route('admission.index')); ?>" class="mb-3">
                                <div class="input-group">
                                    <input type="text" name="search" value="<?php echo e(request('search')); ?>"
                                        class="form-control" placeholder="Search student...">
                                    
                                </div>
                            </form>

                            
                            <div class="row mb-3">
                                <div class="col-md-3">
                                    <select id="filter-course" class="form-control">
                                        <option value="">Filter by Course</option>
                                        <?php $__currentLoopData = $courses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $course): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e(strtolower($course->title)); ?>"><?php echo e($course->title); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <select id="filter-batch" class="form-control">
                                        <option value="">Filter by Batch</option>
                                        <?php $__currentLoopData = $batches; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $batch): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e(strtolower($batch->title)); ?>"><?php echo e($batch->title); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <select id="filter-status" class="form-control">
                                        <option value="">Filter by Status</option>
                                        <option value="active">Active</option>
                                        <option value="unactive">Unactive</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <select id="filter-payment" class="form-control">
                                        <option value="">Filter by Payment Type</option>
                                        <option value="full_fee">Full Payment</option>
                                        <option value="installment">Installment</option>
                                    </select>
                                </div>
                            </div>

                            
                            <div class="table-responsive">
                                <table class="table table-hover mb-0" id="admissionTable">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Image</th>
                                            <th>Name</th>
                                            <th>Course</th>
                                            <th>Batch</th>
                                            <th>Payment</th>
                                            <th>Fee</th>
                                            <th>Status</th>
                                            <th>Options</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__empty_1 = true; $__currentLoopData = $admissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $admission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                            <tr data-status="<?php echo e(strtolower($admission->student_status)); ?>"
                                                data-payment="<?php echo e(strtolower($admission->payment_type)); ?>">
                                                <td><?php echo e($loop->iteration + ($admissions->currentPage() - 1) * $admissions->perPage()); ?>

                                                </td>
                                                <td><img src="<?php echo e(asset($admission->image ?? 'default-avatar.png')); ?>"
                                                        width="50" height="50"
                                                        style="border-radius:50%;object-fit:cover;"></td>
                                                <td><?php echo e($admission->name); ?></td>
                                                <td><?php echo e($admission->course->title ?? '-'); ?></td>
                                                <td><?php echo e($admission->batch->title ?? '-'); ?></td>
                                                <td>
                                                    <span
                                                        class="badge badge-<?php echo e($admission->payment_type === 'full_fee' ? 'success' : 'warning'); ?>">
                                                        <?php echo e(ucfirst($admission->payment_type)); ?>

                                                    </span>
                                                </td>
                                                <td>
                                                    <div>₨<?php echo e(number_format($admission->full_fee)); ?></div>
                                                    <?php if($admission->payment_type === 'installment'): ?>
                                                        <small class="text-muted">
                                                            <?php if($admission->installment_1 > 0): ?>
                                                                1st: <?php echo e($admission->installment_1); ?>

                                                            <?php endif; ?>

                                                            <?php if($admission->installment_2 > 0): ?>
                                                                | 2nd: <?php echo e($admission->installment_2); ?>

                                                            <?php endif; ?>

                                                            <?php if($admission->installment_3 > 0): ?>
                                                                | 3rd: <?php echo e($admission->installment_3); ?>

                                                            <?php endif; ?>
                                                        </small>
                                                    <?php endif; ?>
                                                </td>
                                                <td>
                                                    <span
                                                        class="badge badge-<?php echo e($admission->student_status === 'active' ? 'success' : 'secondary'); ?>">
                                                        <?php echo e(ucfirst($admission->student_status)); ?>

                                                    </span>
                                                </td>
                                                
                                                <td class="text-nowrap">
                                                    <div class="d-flex align-items-center" style="column-gap: 5px;">
                                                        
                                                        <a href="<?php echo e(route('fee-submission.create', $admission->id)); ?>"
                                                            class="btn btn-sm btn-icon btn-pure btn-default on-default button-view"
                                                            data-toggle="tooltip" data-original-title="Submit Fee">
                                                            <i class="fas fa-money-check-alt"></i>
                                                        </a>

                                                        <!-- View Button -->
                                                        <a href="<?php echo e(route('admission.show', $admission->id)); ?>"
                                                            class="btn btn-sm btn-icon btn-pure btn-default on-default button-view"
                                                            data-toggle="tooltip" data-original-title="View">
                                                            <i class="icon-eye" aria-hidden="true"></i>
                                                        </a>

                                                        <!-- Edit Button -->
                                                        <a href="<?php echo e(route('admission.edit', $admission->id)); ?>"
                                                            class="btn btn-sm btn-icon btn-pure btn-default on-default button-edit"
                                                            data-toggle="tooltip" data-original-title="Edit">
                                                            <i class="icon-pencil" aria-hidden="true"></i>
                                                        </a>

                                                        <!-- Delete Button -->
                                                        <form action="<?php echo e(route('admission.destroy', $admission->id)); ?>"
                                                            method="POST" onsubmit="return confirm('Are you sure?')">
                                                            <?php echo csrf_field(); ?>
                                                            <?php echo method_field('DELETE'); ?>
                                                            <button type="submit"
                                                                class="btn btn-sm btn-icon btn-pure btn-default on-default button-remove"
                                                                data-toggle="tooltip" data-original-title="Remove">
                                                                <i class="icon-trash" aria-hidden="true"></i>
                                                            </button>
                                                    </div>
                                                    </form>
                                                </td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                            <tr>
                                                <td colspan="9" class="text-center text-muted">No admissions found.
                                                </td>
                                            </tr>
                                        <?php endif; ?>
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
            const tableRows = document.querySelectorAll("#admissionTable tbody tr");

            const searchInput = document.querySelector("input[name='search']");
            const courseFilter = document.getElementById("filter-course");
            const batchFilter = document.getElementById("filter-batch");
            const statusFilter = document.getElementById("filter-status");
            const paymentFilter = document.getElementById("filter-payment");

            // 🔹 Main function to check visibility
            function applyFilters() {
                let search = searchInput ? searchInput.value.toLowerCase() : "";
                let course = courseFilter.value.toLowerCase();
                let batch = batchFilter.value.toLowerCase();
                let status = statusFilter.value.toLowerCase();
                let payment = paymentFilter.value.toLowerCase();

                tableRows.forEach(function(row) {
                    let rowText = row.innerText.toLowerCase();
                    let courseCol = row.cells[3].innerText.toLowerCase();
                    let batchCol = row.cells[4].innerText.toLowerCase();
                    let statusCol = row.getAttribute("data-status");
                    let paymentCol = row.getAttribute("data-payment");

                    let visible =
                        (!search || rowText.includes(search)) &&
                        (!course || courseCol.includes(course)) &&
                        (!batch || batchCol.includes(batch)) &&
                        (!status || statusCol === status) &&
                        (!payment || paymentCol === payment);

                    row.style.display = visible ? "" : "none";
                });
            }

            // 🔹 Attach events
            if (searchInput) searchInput.addEventListener("keyup", applyFilters);
            [courseFilter, batchFilter, statusFilter, paymentFilter].forEach(el => {
                el.addEventListener("change", applyFilters);
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\projects\codezy\zain-changes\codezy\resources\views/admin/pages/dashboard/admission/index.blade.php ENDPATH**/ ?>