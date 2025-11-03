
<?php $__env->startSection('content'); ?>
    <div id="main-content">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-md-6 col-sm-12">
                    <h2>Fee Management</h2>
                </div>
                <div class="col-md-6 col-sm-12 text-right">
                    <a href="<?php echo e(route('fee-submission.index')); ?>" class="btn btn-sm btn-primary" title="Back">Back</a>
                </div>
            </div>
        </div>

        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-md-12">
                    <div class="card">
                        <div class="header">
                            <h2>Add Fee</h2>
                        </div>
                        <div class="body">
                            <form id="basic-form" action="<?php echo e(route('fee-submission.store', $admission->id)); ?>"
                                method="POST" novalidate>
                                <?php echo csrf_field(); ?>

                                
                                <div class="form-group mb-3">
                                    <label><strong>Student Name:</strong> <?php echo e($admission->name); ?></label><br>
                                    <label><strong>Admission No:</strong> <?php echo e($admission->roll_no ?? '—'); ?></label>
                                </div>

                                
                                <div class="form-group">
                                    <label>Payment Method</label>
                                    <select name="payment_method" id="paymentMethod" class="form-control" required>
                                        <option value="">-- Select Method --</option>
                                        <option value="account">By Account</option>
                                        <option value="hand">By Hand</option>
                                    </select>
                                    <?php $__errorArgs = ['payment_method'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <small class="text-danger"><?php echo e($message); ?></small>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>

                                
                                <input type="hidden" name="collector_id" id="collectorIdField" value="">

                                
                                <div class="form-group" id="accountDiv" style="display: none;">
                                    <label>Select Account</label>
                                    <select name="account_id" id="accountSelect" class="form-control">
                                        <option value="">-- Select Account --</option>
                                        <?php $__currentLoopData = $accounts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $account): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($account->id); ?>" data-name="<?php echo e($account->name); ?>"
                                                data-number="<?php echo e($account->number); ?>">
                                                <?php echo e($account->type); ?> - <?php echo e($account->name); ?>

                                            </option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                    <?php $__errorArgs = ['account_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <small class="text-danger"><?php echo e($message); ?></small>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>

                                
                                <div id="accountInfo" style="display: none;">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Account Name</label>
                                                <input type="text" id="accountName" class="form-control" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Account Number</label>
                                                <input type="text" id="accountNumber" class="form-control" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                
                                <div class="form-group mt-4">
                                    <label><strong>Select Fee to Submit:</strong></label><br>

                                    <?php if($admission->courses->isNotEmpty()): ?>
                                        <?php $__currentLoopData = $admission->courses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $course): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <div class="border rounded p-3 mb-3">
                                                <h6 class="text-primary mb-1">
                                                    🎓 <?php echo e($course->title); ?>

                                                    <small
                                                        class="text-muted">(<?php echo e($course->pivot->batch->title ?? 'Batch'); ?>)</small>
                                                </h6>
                                                <p class="mb-2">Total Fee:
                                                    ₨<?php echo e(number_format($course->pivot->course_fee)); ?></p>

                                                <?php
                                                    $submitted = \App\Models\FeeSubmission::where(
                                                        'admission_id',
                                                        $admission->id,
                                                    )
                                                        ->where('course_id', $course->id)
                                                        ->pluck('payment_type')
                                                        ->toArray();
                                                ?>

                                                
                                                <?php
                                                    // $pivotPaymentType = $admission->payment_type;
                                                    // $pivotPaymentType =
                                                    //     $course->pivot->payment_type ?? $admission->payment_type;
                                                    $pivotPaymentType =
                                                        $course->pivot->payment_type ?:
                                                        $admission->payment_type ?? 'full_fee';

                                                ?>

                                                <?php if($pivotPaymentType === 'full_fee'): ?>
                                                    <?php $paid = in_array('full_fee', $submitted); ?>
                                                    <label class="fancy-checkbox d-block">
                                                        <input type="checkbox" name="fees[<?php echo e($course->id); ?>][]"
                                                            value="full_fee" <?php echo e($paid ? 'checked disabled' : ''); ?>>
                                                        <span>
                                                            Full Fee
                                                            —₨<?php echo e(number_format($course->pivot->course_fee ?: $admission->full_fee)); ?>


                                                            <?php if($paid): ?>
                                                                <small class="text-success">(Already Submitted)</small>
                                                            <?php endif; ?>
                                                        </span>
                                                    </label>
                                                <?php elseif($pivotPaymentType === 'installment'): ?>
                                                    <?php
                                                        $installments = [
                                                            'installment_1' =>
                                                                $course->pivot->installment_1 ??
                                                                ($admission->installment_1 ?? 0),
                                                            'installment_2' =>
                                                                $course->pivot->installment_2 ??
                                                                ($admission->installment_2 ?? 0),
                                                            'installment_3' =>
                                                                $course->pivot->installment_3 ??
                                                                ($admission->installment_3 ?? 0),
                                                        ];
                                                    ?>

                                                    <?php $__currentLoopData = $installments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $amount): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <?php if($amount > 0): ?>
                                                            <?php $paid = in_array($key, $submitted); ?>
                                                            <label class="fancy-checkbox d-block">
                                                                <input type="checkbox" name="fees[<?php echo e($course->id); ?>][]"
                                                                    value="<?php echo e($key); ?>"
                                                                    <?php echo e($paid ? 'checked disabled' : ''); ?>>
                                                                <span>
                                                                    <?php echo e(ucfirst(str_replace('_', ' ', $key))); ?> —
                                                                    ₨<?php echo e(number_format($amount)); ?>

                                                                    <?php if($paid): ?>
                                                                        <small class="text-success">(Already
                                                                            Submitted)</small>
                                                                    <?php endif; ?>
                                                                </span>
                                                            </label>
                                                        <?php endif; ?>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <?php endif; ?>

                                            </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php else: ?>
                                        
                                        <div class="border rounded p-3 mb-3">
                                            <h6 class="text-primary">🎓 <?php echo e($admission->course->title); ?></h6>
                                            <p>Full Fee: ₨<?php echo e(number_format($admission->full_fee)); ?></p>
                                        </div>
                                    <?php endif; ?>
                                </div>

                                <br>
                                <button type="submit" class="btn btn-primary">Submit Fee</button>
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
        document.addEventListener('DOMContentLoaded', function() {
            const methodSelect = document.getElementById('paymentMethod');
            const accountDiv = document.getElementById('accountDiv');
            const accountInfo = document.getElementById('accountInfo');
            const accountSelect = document.getElementById('accountSelect');
            const accountName = document.getElementById('accountName');
            const accountNumber = document.getElementById('accountNumber');
            const collectorIdField = document.getElementById('collectorIdField');
            const loggedInUserId = <?php echo e(auth()->user()->id); ?>;

            methodSelect.addEventListener('change', function() {
                const method = this.value;
                if (method === 'hand') {
                    collectorIdField.value = loggedInUserId;
                    accountDiv.style.display = 'none';
                    accountInfo.style.display = 'none';
                } else if (method === 'account') {
                    collectorIdField.value = '';
                    accountDiv.style.display = 'block';
                    accountInfo.style.display = 'block';
                } else {
                    collectorIdField.value = '';
                    accountDiv.style.display = 'none';
                    accountInfo.style.display = 'none';
                }
            });

            accountSelect.addEventListener('change', function() {
                const selected = this.options[this.selectedIndex];
                accountName.value = selected.getAttribute('data-name') || '';
                accountNumber.value = selected.getAttribute('data-number') || '';
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\projects\codezy\zain-changes\codezy\resources\views/admin/pages/dashboard/fee-submission/create.blade.php ENDPATH**/ ?>