<?php
    use App\Models\FeeSubmission;
?>

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
                            <form method="GET" action="<?php echo e(route('teacher-salary.index')); ?>" id="filterForm"
                                class="mb-3">

                                
                                <div class="input-group mb-2">
                                    <input type="text" name="search" value="<?php echo e(request('search')); ?>"
                                        class="form-control" placeholder="Search teacher..." autocomplete="off">
                                </div>

                                <div class="row" style="margin-top: 15px;">
                                    
                                    <div class="col-md-4 mb-2">
                                        <select name="month" class="form-control">
                                            <option value="">All Months</option>
                                            <?php $__currentLoopData = range(1, 12); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $m): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($m); ?>"
                                                    <?php echo e(request('month') == $m ? 'selected' : ''); ?>>
                                                    <?php echo e(\Carbon\Carbon::create()->month($m)->format('F')); ?>

                                                </option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>

                                    
                                    <div class="col-md-4 mb-2">
                                        <select name="year" class="form-control">
                                            <option value="">All Years</option>
                                            <?php for($y = now()->year; $y >= 2020; $y--): ?>
                                                <option value="<?php echo e($y); ?>"
                                                    <?php echo e(request('year') == $y ? 'selected' : ''); ?>>
                                                    <?php echo e($y); ?>

                                                </option>
                                            <?php endfor; ?>
                                        </select>
                                    </div>

                                    
                                    <div class="col-md-4 mb-2">
                                        <select name="status" class="form-control">
                                            <option value="all"
                                                <?php echo e(request('status', 'all') === 'all' ? 'selected' : ''); ?>>All Status
                                            </option>
                                            <option value="paid" <?php echo e(request('status') === 'paid' ? 'selected' : ''); ?>>
                                                Paid</option>
                                            <option value="balance"
                                                <?php echo e(request('status') === 'balance' ? 'selected' : ''); ?>>Balance</option>
                                            <option value="pending"
                                                <?php echo e(request('status') === 'pending' ? 'selected' : ''); ?>>Pending</option>
                                        </select>
                                    </div>
                                </div>
                            </form>


                            <div class="table-responsive">
                                <table class="table m-b-0">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Teacher</th>
                                            <th>Month</th>
                                            <th>Students</th>
                                            <th>Collected</th>
                                            <th>Pay Type</th>
                                            <th>Physical</th>
                                            <th>Online</th>
                                            <th>Total Payable</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php $__currentLoopData = $salaries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $salary): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php
                                                $teacher = $salary->teacher ?? null;
                                                $payType = $salary->pay_type ?? ($teacher->pay_type ?? 'percentage');
                                                $percent = (int) ($salary->percentage ?? 0);
                                                $fixedAmount =
                                                    (int) ($salary->computed_fixed_amount ??
                                                        ($teacher->fixed_salary ?? 0));

                                                // Accurate collected breakdown from FeeSubmission (gross physical + online)
                                                $physicalCollected = FeeSubmission::whereHas('admission', function (
                                                    $q,
                                                ) use ($salary) {
                                                    $q->where('mode', 'physical')->whereHas('batch', function ($b) use (
                                                        $salary,
                                                    ) {
                                                        $b->where('teacher_id', $salary->teacher_id);
                                                    });
                                                })
                                                    ->whereMonth('submission_date', $salary->month)
                                                    ->whereYear('submission_date', $salary->year)
                                                    ->sum('amount');

                                                $onlineCollected = FeeSubmission::whereHas('admission', function (
                                                    $q,
                                                ) use ($salary) {
                                                    $q->where('mode', 'online')->whereHas('batch', function ($b) use (
                                                        $salary,
                                                    ) {
                                                        $b->where('teacher_id', $salary->teacher_id);
                                                    });
                                                })
                                                    ->whereMonth('submission_date', $salary->month)
                                                    ->whereYear('submission_date', $salary->year)
                                                    ->sum('amount');

                                                // Gross total (for display)
                                                $collected = (int) ($physicalCollected + $onlineCollected);

                                                // Students
                                                $physicalStudents = (int) ($salary->total_students ?? 0);
                                                $onlineStudents = (int) ($salary->total_online_students ?? 0);
                                                $totalStudents = $physicalStudents + $onlineStudents;

                                                // Online bonus (teacher’s share)
                                                $onlineBonus = (int) ($salary->online_bonus ?? 0);

                                                // For percentage teachers → compute teacher’s share from physical only
                                                $physicalPercentAmount = (int) round(
                                                    $physicalCollected * ($percent / 100),
                                                );

                                                // Total payable to teacher (main + online)
                                                $totalPayable = (int) ($salary->salary_amount ?? 0) + $onlineBonus;
                                            ?>


                                            <tr>
                                                <td><?php echo e($loop->iteration); ?></td>
                                                <td><?php echo e($teacher->name ?? 'N/A'); ?></td>
                                                <td>
                                                    <?php echo e(\Carbon\Carbon::create()->month($salary->month)->format('F')); ?>

                                                    <?php echo e($salary->year); ?>

                                                </td>

                                                
                                                <td>
                                                    <?php echo e($totalStudents); ?>

                                                    <small class="text-muted d-block">
                                                        Phys: <?php echo e($physicalStudents); ?> | Online: <?php echo e($onlineStudents); ?>

                                                    </small>
                                                </td>

                                                
                                                <td>
                                                    ₨<?php echo e(number_format($collected)); ?>

                                                    <small class="text-muted d-block">
                                                        Phys: ₨<?php echo e(number_format($physicalCollected)); ?>, Online:
                                                        ₨<?php echo e(number_format($onlineCollected)); ?>

                                                    </small>
                                                </td>

                                                
                                                <td>
                                                    <span
                                                        class="badge badge-<?php echo e($payType === 'fixed' ? 'primary' : 'info'); ?>">
                                                        <?php echo e(ucfirst($payType)); ?>

                                                    </span>
                                                </td>

                                                
                                                <td>
                                                    <?php if($payType === 'fixed'): ?>
                                                        <span class="text-muted">Fixed
                                                            ₨<?php echo e(number_format($fixedAmount)); ?></span>
                                                    <?php else: ?>
                                                        <?php echo e($percent); ?>%
                                                        <small class="text-muted d-block">
                                                            ≈ ₨<?php echo e(number_format($physicalPercentAmount)); ?>

                                                        </small>
                                                    <?php endif; ?>
                                                </td>

                                                
                                                <td>
                                                    <?php if($onlineStudents > 0): ?>
                                                        <span class="text-success">
                                                            ₨<?php echo e(number_format($onlineBonus)); ?>

                                                        </span>
                                                        <?php if($payType === 'fixed'): ?>
                                                            <small class="text-muted d-block">
                                                                <?php echo e($percent); ?>%
                                                            </small>
                                                        <?php endif; ?>
                                                    <?php else: ?>
                                                        <span class="text-muted">—</span>
                                                    <?php endif; ?>
                                                </td>

                                                
                                                <td><strong>₨<?php echo e(number_format($totalPayable)); ?></strong></td>

                                                
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
                                                        <button type="submit" class="btn btn-sm btn-success">Paid</button>
                                                    </form>

                                                    <form method="POST"
                                                        action="<?php echo e(route('teacher-salary.status-balance', $salary->id)); ?>"
                                                        style="display:inline-block;">
                                                        <?php echo csrf_field(); ?> <?php echo method_field('PUT'); ?>
                                                        <button type="submit"
                                                            class="btn btn-sm btn-warning">Balance</button>
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
<?php $__env->startSection('additional-javascript'); ?>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('filterForm');
            const search = form.querySelector('input[name="search"]');
            const selects = form.querySelectorAll('select');

            // auto-submit on select change
            selects.forEach(sel => sel.addEventListener('change', () => form.submit()));

            // debounce search typing
            let t;
            if (search) {
                search.addEventListener('input', () => {
                    clearTimeout(t);
                    t = setTimeout(() => form.submit(), 500);
                });
            }
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\projects\codezy\zain-changes\codezy\resources\views/admin/pages/dashboard/teacher/salary/salary.blade.php ENDPATH**/ ?>