

<?php $__env->startSection('content'); ?>
    <div id="main-content">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-md-6 col-sm-12">
                    <h2>Leads</h2>
                </div>
                <div class="col-md-6 col-sm-12 text-right">
                    <a href="<?php echo e(route('lead.create')); ?>" class="btn btn-sm btn-primary">Create New</a>
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
                            <h2>All Leads</h2>
                            <ul class="header-dropdown dropdown dropdown-animated scale-left">
                                <li><a href="javascript:void(0);" data-toggle="cardloading" data-loading-effect="pulse"><i
                                            class="icon-refresh"></i></a></li>
                                <li><a href="javascript:void(0);" class="full-screen"><i
                                            class="icon-size-fullscreen"></i></a></li>
                            </ul>
                        </div>

                        <div class="body">

                            
                            <form method="GET" action="<?php echo e(route('lead.index')); ?>" id="filterForm" class="mb-3">
                                <div class="input-group mb-2">
                                    <input type="text" name="search" value="<?php echo e(request('search')); ?>"
                                        class="form-control" placeholder="Search by name, phone, address..."
                                        autocomplete="off">
                                </div>

                                <div class="row" style="margin-top: 15px;">

                                    
                                    <div class="col-md-4 mb-2">
                                        <select name="course_id" class="form-control">
                                            <option value="">Filter by Course</option>
                                            <?php $__currentLoopData = $courses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $course): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($course->id); ?>"
                                                    <?php echo e((string) request('course_id') === (string) $course->id ? 'selected' : ''); ?>>
                                                    <?php echo e($course->title); ?>

                                                </option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>

                                    
                                    <div class="col-md-4 mb-2">
                                        <select name="referral_type" class="form-control">
                                            <option value="">All Referral Types</option>
                                            <option value="ads"
                                                <?php echo e(request('referral_type') === 'ads' ? 'selected' : ''); ?>>Ads</option>
                                            <option value="referral"
                                                <?php echo e(request('referral_type') === 'referral' ? 'selected' : ''); ?>>Referral
                                            </option>
                                            <option value="other"
                                                <?php echo e(request('referral_type') === 'other' ? 'selected' : ''); ?>>Other</option>
                                        </select>
                                    </div>

                                    
                                    <div class="col-md-4 mb-2">
                                        <select name="status" class="form-control">
                                            <option value="">All Status</option>
                                            <option value="new" <?php echo e(request('status') === 'new' ? 'selected' : ''); ?>>New
                                            </option>
                                            <option value="contacted"
                                                <?php echo e(request('status') === 'contacted' ? 'selected' : ''); ?>>Contacted
                                            </option>
                                            <option value="converted"
                                                <?php echo e(request('status') === 'converted' ? 'selected' : ''); ?>>Converted
                                            </option>
                                            <option value="lost" <?php echo e(request('status') === 'lost' ? 'selected' : ''); ?>>
                                                Lost</option>
                                            <option value="interested"
                                                <?php echo e(request('status') === 'interested' ? 'selected' : ''); ?>>Interested
                                            </option>
                                            <option value="not_interested"
                                                <?php echo e(request('status') === 'not_interested' ? 'selected' : ''); ?>>Not
                                                Interested</option>
                                        </select>
                                    </div>

                                    
                                    <div class="col-md-3 mb-2">
                                        <input type="date" name="from_date" class="form-control"
                                            value="<?php echo e(request('from_date')); ?>" placeholder="From Date">
                                    </div>

                                    <div class="col-md-3 mb-2">
                                        <input type="date" name="to_date" class="form-control"
                                            value="<?php echo e(request('to_date')); ?>" placeholder="To Date">
                                    </div>

                                    
                                    <div class="col-md-3 mb-2">
                                        <input type="month" name="month" class="form-control"
                                            value="<?php echo e(request('month')); ?>" placeholder="Select Month">
                                    </div>
                                    
                                    <div class="col-md-3 text-right mb-2 ml-auto">
                                        <a href="<?php echo e(route('lead.index')); ?>" class="btn btn-warning" style="width:220px;">
                                            Reset
                                        </a>
                                    </div>
                                </div>
                            </form>

                            
                            <div class="table-responsive">
                                <table class="table table-hover mb-0">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Course</th>
                                            <th>Phone</th>
                                            <th>Type</th>
                                            <th>Referral</th>
                                            <th>Status</th>
                                            <th>F/U</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__empty_1 = true; $__currentLoopData = $leads; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lead): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                            <tr>
                                                
                                                <td><?php echo e($loop->iteration + ($leads->currentPage() - 1) * $leads->perPage()); ?>

                                                </td>

                                                
                                                <td><?php echo e($lead->name); ?></td>
                                                <td><?php echo e($lead->course->title ?? '-'); ?></td>

                                                
                                                <td><?php echo e($lead->phone); ?></td>

                                                
                                                <td>
                                                    <span
                                                        class="badge badge-primary"><?php echo e(ucfirst($lead->lead_type ?? '-')); ?></span>
                                                </td>

                                                
                                                <td>
                                                    <span
                                                        class="badge badge-info"><?php echo e(ucfirst($lead->referral_type ?? '-')); ?></span>
                                                </td>

                                                
                                                <td>
                                                    <?php switch($lead->status):
                                                        case ('new'): ?>
                                                            <span class="badge badge-secondary">New</span>
                                                        <?php break; ?>

                                                        <?php case ('contacted'): ?>
                                                            <span class="badge badge-warning">Contacted</span>
                                                        <?php break; ?>

                                                        <?php case ('converted'): ?>
                                                            <span class="badge badge-success">Done</span>
                                                        <?php break; ?>

                                                        <?php case ('lost'): ?>
                                                            <span class="badge badge-danger">Lost</span>
                                                        <?php break; ?>

                                                        <?php case ('interested'): ?>
                                                            <span class="badge badge-info">Interested</span>
                                                        <?php break; ?>

                                                        <?php case ('not_interested'): ?>
                                                            <span class="badge badge-dark">No Int.</span>
                                                        <?php break; ?>

                                                        <?php default: ?>
                                                            <span class="badge badge-light">-</span>
                                                    <?php endswitch; ?>
                                                </td>

                                                
                                                <td>
                                                    <?php if($lead->follow_ups_count > 0): ?>
                                                        <span title="Follow-up Added"
                                                            style="height:10px;width:10px;background:#FEB800;border-radius:50%;display:inline-block;"></span>
                                                    <?php else: ?>
                                                        <span title="No Follow-up Yet"
                                                            style="height:10px;width:10px;background:#dc3545;border-radius:50%;display:inline-block;"></span>
                                                    <?php endif; ?>
                                                </td>

                                                
                                                <td class="text-nowrap">
                                                    <div class="d-flex align-items-center" style="column-gap: 5px;">
                                                        <a href="<?php echo e(route('lead-followups.index', $lead->id)); ?>"
                                                            class="btn btn-sm btn-icon btn-pure btn-info"
                                                            title="Follow-ups">
                                                            <i class="fas fa-comments"></i>
                                                        </a>

                                                        <a href="<?php echo e(route('admission.create', ['lead_id' => $lead->id])); ?>"
                                                            class="btn btn-sm btn-icon btn-pure btn-success"
                                                            title="Convert">
                                                            <i class="fas fa-user-plus"></i>
                                                        </a>

                                                        <a href="<?php echo e(route('lead.show', $lead->id)); ?>"
                                                            class="btn btn-sm btn-icon btn-pure btn-default"
                                                            title="View">
                                                            <i class="icon-eye"></i>
                                                        </a>

                                                        <a href="<?php echo e(route('lead.edit', $lead->id)); ?>"
                                                            class="btn btn-sm btn-icon btn-pure btn-default"
                                                            title="Edit">
                                                            <i class="icon-pencil"></i>
                                                        </a>

                                                        <form action="<?php echo e(route('lead.destroy', $lead->id)); ?>"
                                                            method="POST" onsubmit="return confirm('Are you sure?')"
                                                            style="display:inline;">
                                                            <?php echo csrf_field(); ?>
                                                            <?php echo method_field('DELETE'); ?>
                                                            <button type="submit"
                                                                class="btn btn-sm btn-icon btn-pure btn-default"
                                                                title="Delete">
                                                                <i class="icon-trash"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                                <tr>
                                                    <td colspan="9" class="text-center text-muted">No leads found.</td>
                                                </tr>
                                            <?php endif; ?>
                                        </tbody>
                                    </table>
                                </div>

                                
                                <div class="mt-3">
                                    <?php echo e($leads->links('pagination::bootstrap-4')); ?>

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
                const dateInputs = form.querySelectorAll('input[type="date"], input[type="month"]');

                // auto-submit on select change
                selects.forEach(sel => sel.addEventListener('change', () => form.submit()));

                // auto-submit on date/month change
                dateInputs.forEach(inp => {
                    inp.addEventListener('change', () => form.submit());
                    // (optional) agar browser 'change' late fire kare to blur pe bhi:
                    inp.addEventListener('blur', () => form.submit());
                });

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

<?php echo $__env->make('admin.layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\projects\codezy\zain-changes\codezy\resources\views/admin/pages/dashboard/lead/index.blade.php ENDPATH**/ ?>