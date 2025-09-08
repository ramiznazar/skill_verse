
<?php $__env->startSection('content'); ?>
    <div id="main-content">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-md-6 col-sm-12">
                    <h2>Fee Management</h2>
                </div>
                <div class="col-md-6 col-sm-12 text-right">
                    <a href="javascript:void(0);" class="btn btn-sm btn-primary" title="">New</a>
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

                                <div class="form-group">
                                    <label><strong>Student Name:</strong> <?php echo e($admission->name); ?></label><br>
                                    <label><strong>Course:</strong> <?php echo e($admission->course->title); ?></label><br>
                                    <label><strong>Payment Type:</strong> <?php echo e(ucfirst($admission->payment_type)); ?></label>
                                </div>

                                
                                <div class="form-group">
                                    <label>Payment Method</label>
                                    <select name="payment_method" id="paymentMethod" class="form-control" required>
                                        <option value="">-- Select Method --</option>
                                        <option value="account">By Account</option>
                                        <option value="hand">By Hand</option>
                                    </select>
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

                                
                                <div class="form-group">
                                    <label><strong>Select Fee to Submit:</strong></label><br>

                                    <?php if($admission->payment_type === 'full_fee'): ?>
                                        <?php $submitted = in_array('full_fee', $submittedFees); ?>
                                        <label class="fancy-checkbox">
                                            <input type="checkbox" name="fees[]" value="full_fee"
                                                <?php echo e($submitted ? 'checked' : ''); ?>>
                                            <span>Full Fee - <?php echo e($admission->full_fee); ?> PKR
                                                <?php if($submitted): ?>
                                                    <small class="text-success">(Already Submitted)</small>
                                                <?php endif; ?>
                                            </span>
                                        </label>
                                    <?php else: ?>
                                        <?php $installments = ['installment_1', 'installment_2', 'installment_3']; ?>
                                        <?php $__currentLoopData = $installments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php if($admission->$key): ?>
                                                <?php $submitted = in_array($key, $submittedFees); ?>
                                                <label class="fancy-checkbox">
                                                    <input type="checkbox" name="fees[]" value="<?php echo e($key); ?>"
                                                        <?php echo e($submitted ? 'checked disabled' : ''); ?>>
                                                    <span><?php echo e(ucfirst(str_replace('_', ' ', $key))); ?> -
                                                        <?php echo e($admission->$key); ?> PKR
                                                        <?php if($submitted): ?>
                                                            <small class="text-success">(Already Submitted)</small>
                                                        <?php endif; ?>
                                                    </span>
                                                </label>
                                            <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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

            const loggedInUserId = <?php echo e(auth()->user()->id); ?>; // inject Laravel user ID

            methodSelect.addEventListener('change', function() {
                const method = this.value;

                if (method === 'hand') {
                    collectorIdField.value = loggedInUserId;
                    accountDiv.style.display = 'none';
                    accountInfo.style.display = 'none';
                } else if (method === 'account') {
                    collectorIdField.value = ''; // clear if account selected
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