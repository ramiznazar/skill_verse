

<?php $__env->startSection('content'); ?>
<div id="main-content">
    <div class="block-header">
        <div class="row clearfix">
            <div class="col-md-6 col-sm-12">
                <h2>Leads • Edit Follow-up</h2>
            </div>
            <div class="col-md-6 col-sm-12 text-right">
                <a href="<?php echo e(route('lead-followups.index', $lead->id)); ?>" class="btn btn-sm btn-primary">All Follow-ups</a>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-md-12">
                <div class="card">
                    <div class="header">
                        <h2>Edit Follow-up</h2>
                    </div>
                    <div class="body">
                        <?php
                            $contactMethods = ['call','whatsapp','sms','in_person','email','other'];
                            $statuses = ['new','no_answer','interested','not_interested','admission_done','callback_requested','rescheduled'];
                        ?>

                        <form id="follow-up-form"
                              action="<?php echo e(route('lead-followups.update', ['lead' => $lead->id, 'followup' => $followup->id])); ?>"
                              method="POST" novalidate>
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('PUT'); ?>

                            <div class="row">
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Contact Method</label>
                                        <select name="contact_method" class="form-control">
                                            <option value="">Select</option>
                                            <?php $__currentLoopData = $contactMethods; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cm): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($cm); ?>"
                                                    <?php echo e(old('contact_method', $followup->contact_method) === $cm ? 'selected' : ''); ?>>
                                                    <?php echo e($cm === 'in_person' ? 'In-person' : ucfirst(str_replace('_',' ', $cm))); ?>

                                                </option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                        <?php $__errorArgs = ['contact_method'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <small class="text-danger"><?php echo e($message); ?></small> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                </div>

                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Status</label>
                                        <select name="status" class="form-control">
                                            <option value="">Select</option>
                                            <?php $__currentLoopData = $statuses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $st): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($st); ?>"
                                                    <?php echo e(old('status', $followup->status) === $st ? 'selected' : ''); ?>>
                                                    <?php echo e(ucwords(str_replace('_',' ', $st))); ?>

                                                </option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                        <?php $__errorArgs = ['status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <small class="text-danger"><?php echo e($message); ?></small> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Followed At</label>
                                        <input type="datetime-local" name="followed_at" class="form-control"
                                               value="<?php echo e(old('followed_at', optional($followup->followed_at)->format('Y-m-d\TH:i'))); ?>">
                                        <?php $__errorArgs = ['followed_at'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <small class="text-danger"><?php echo e($message); ?></small> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                </div>
                            </div>

                            
                            <div class="form-group">
                                <label>What did the student say?</label>
                                <textarea name="note" class="form-control" rows="4"
                                    placeholder="E.g., Asked to call next week, interested in weekend batch..."><?php echo e(old('note', $followup->note)); ?></textarea>
                                <?php $__errorArgs = ['note'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <small class="text-danger"><?php echo e($message); ?></small> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>

                            <button type="submit" class="btn btn-primary">Update Follow-up</button>
                            <a href="<?php echo e(route('lead-followups.index', $lead->id)); ?>" class="btn btn-light">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('additional-javascript'); ?>
<script>
document.addEventListener('DOMContentLoaded', function () {
    if (window.jQuery && $('#follow-up-form').length) {
        $('#follow-up-form').parsley && $('#follow-up-form').parsley();
    }
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\projects\codezy\zain-changes\codezy\resources\views/admin/pages/dashboard/lead/follow-up/update.blade.php ENDPATH**/ ?>