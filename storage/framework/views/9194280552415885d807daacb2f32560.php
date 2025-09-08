

<?php $__env->startSection('content'); ?>
    <div id="main-content">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-md-6 col-sm-12">
                    <h2>Teacher Salaries</h2>
                </div>
                <div class="col-md-6 col-sm-12 text-right">
                    <a href="<?php echo e(route('teacher.balance')); ?>" class="btn btn-sm btn-primary" title="">Teacher Balances</a>
                </div>
            </div>
        </div>
        
        <?php if(session('paid')): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?php echo e(session('paid')); ?>

                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php endif; ?>
        
        <?php if(session('balance')): ?>
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <?php echo e(session('balance')); ?>

                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php endif; ?>
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="header">
                            <h2>Salary</h2>
                            <ul class="header-dropdown dropdown dropdown-animated scale-left">
                                <li> <a href="javascript:void(0);" data-toggle="cardloading" data-loading-effect="pulse"><i
                                            class="icon-refresh"></i></a></li>
                                <li><a href="javascript:void(0);" class="full-screen"><i
                                            class="icon-size-fullscreen"></i></a></li>
                            </ul>
                        </div>

                        <div class="body">
                            <form method="GET" action="<?php echo e(route('teacher-salary.index')); ?>" class="form-inline mb-3">
                                <div class="form-group mr-2">
                                    <label for="month">Month:</label>
                                    <select name="month" id="month" class="form-control ml-2">
                                        <option value="">All</option>
                                        <?php $__currentLoopData = range(1, 12); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $m): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($m); ?>"
                                                <?php echo e(request('month') == $m ? 'selected' : ''); ?>>
                                                <?php echo e(\Carbon\Carbon::create()->month($m)->format('F')); ?>

                                            </option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>

                                <div class="form-group mr-2">
                                    <label for="year">Year:</label>
                                    <select name="year" id="year" class="form-control ml-2">
                                        <option value="">All</option>
                                        <?php for($y = now()->year; $y >= 2020; $y--): ?>
                                            <option value="<?php echo e($y); ?>"
                                                <?php echo e(request('year') == $y ? 'selected' : ''); ?>>
                                                <?php echo e($y); ?></option>
                                        <?php endfor; ?>
                                    </select>
                                </div>

                                <button type="submit" class="btn btn-primary">Filter</button>
                            </form>

                            <div class="table-responsive">
                                <table class="table m-b-0">
                                    <thead class="">
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Month</th>
                                            <th>Students</th>
                                            <th>Collected</th>
                                            <th>% / Rate</th>
                                            <th>Salary</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__currentLoopData = $salaries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $salary): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td><?php echo e($loop->iteration); ?></td>
                                                <td><?php echo e($salary->teacher->name ?? 'N/A'); ?></td>
                                                    <td><?php echo e(\Carbon\Carbon::create()->month($salary->month)->format('F')); ?> <?php echo e($salary->year); ?></td>

                                                <td><?php echo e($salary->total_students); ?></td>
                                                <td><?php echo e(number_format($salary->total_fee_collected)); ?> PKR</td>
                                                <td><?php echo e($salary->percentage); ?>%</td>
                                                <td><strong><?php echo e(number_format($salary->salary_amount)); ?> PKR</strong></td>
                                                <td>
                                                    <span
                                                        class="badge 
                                                    <?php if($salary->status == 'paid'): ?> badge-success
                                                    <?php elseif($salary->status == 'balance'): ?> badge-info
                                                    <?php else: ?> badge-warning <?php endif; ?>">
                                                        <?php echo e(ucfirst($salary->status)); ?>

                                                    </span>
                                                </td>
                                                <td>
                                                    
                                                    <form method="POST"
                                                        action="<?php echo e(route('teacher-salary.status-paid', $salary->id)); ?>"
                                                        style="display:inline-block;">
                                                        <?php echo csrf_field(); ?> <?php echo method_field('PUT'); ?>
                                                        <button type="submit" class="btn btn-sm btn-success"
                                                            >
                                                            Paid
                                                        </button>
                                                    </form>

                                                    
                                                    <form method="POST"
                                                        action="<?php echo e(route('teacher-salary.status-balance', $salary->id)); ?>"
                                                        style="display:inline-block;">
                                                        <?php echo csrf_field(); ?> <?php echo method_field('PUT'); ?>
                                                        <button type="submit" class="btn btn-sm btn-warning"
                                                            >
                                                            Balance
                                                        </button>
                                                    </form>

                                                    
                                                    <a href="<?php echo e(route('teacher-salary.history', $salary->teacher_id)); ?>"
                                                        class="btn btn-sm btn-info">
                                                        History
                                                    </a>

                                                    
                                                    
                                                </td>

                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\projects\codezy\zain-changes\codezy\resources\views/admin/pages/dashboard/teacher/salary/salary.blade.php ENDPATH**/ ?>