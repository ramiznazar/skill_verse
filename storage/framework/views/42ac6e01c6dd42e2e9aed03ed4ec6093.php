                                                    <?php
                                                        // get latest fee by submission_date if you store it, else by created_at
                                                        $latestFee =
                                                            $admission
                                                                ->feeSubmissions()
                                                                ->latest('submission_date')
                                                                ->first() ??
                                                            $admission->feeSubmissions()->latest()->first();
                                                    ?>

                                                    
                                                    <?php if(strtolower($admission->fee_status) !== 'complete'): ?>
                                                        <a href="<?php echo e(route('fee-submission.create', $admission->id)); ?>"
                                                            class="btn btn-sm btn-default" data-toggle="tooltip"
                                                            title="Submit Fee">
                                                            <i class="fas fa-money-check-alt"></i>
                                                        </a>
                                                    <?php endif; ?>

                                                    
                                                    <button type="button" class="btn btn-sm btn-secondary mt-1"
                                                        data-toggle="modal"
                                                        data-target="#historyModal<?php echo e($admission->id); ?>"
                                                        title="View History">
                                                        <i class="fas fa-history"></i>
                                                    </button>

                                                    
                                                    <div class="modal fade" id="historyModal<?php echo e($admission->id); ?>"
                                                        tabindex="-1" role="dialog"
                                                        aria-labelledby="historyModalLabel<?php echo e($admission->id); ?>"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog modal-lg" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header bg-dark text-white">
                                                                    <h5 class="modal-title"
                                                                        id="historyModalLabel<?php echo e($admission->id); ?>">
                                                                        Fee Submission History - <?php echo e($admission->name); ?>

                                                                    </h5>
                                                                    <button type="button" class="close text-white"
                                                                        data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>

                                                                <div class="modal-body">
                                                                    <?php
                                                                        $history = $admission
                                                                            ->feeSubmissions()
                                                                            ->orderBy('submission_date', 'asc')
                                                                            ->get();
                                                                    ?>

                                                                    <?php if($history->isEmpty()): ?>
                                                                        <p>No fee submissions yet.</p>
                                                                    <?php else: ?>
                                                                        <table class="table table-bordered table-sm">
                                                                            <thead>
                                                                                <tr>
                                                                                    <th>#</th>
                                                                                    <th>Std Name</th>
                                                                                    <th>Fee Type</th>
                                                                                    <th>Amount</th>
                                                                                    <th>Method</th>
                                                                                    <th>Collector</th>
                                                                                    <th>Date</th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                                <?php $__currentLoopData = $history; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $h): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                                    <tr>
                                                                                        <td><?php echo e($loop->iteration); ?></td>
                                                                                        <td><?php echo e($h->admission->name); ?>

                                                                                        </td>
                                                                                        <td><?php echo e(ucfirst(str_replace('_', ' ', $h->payment_type))); ?>

                                                                                        </td>
                                                                                        <td><?php echo e(number_format($h->amount)); ?>

                                                                                            PKR</td>
                                                                                        <td>
                                                                                            <?php echo e(ucfirst($h->payment_method)); ?>

                                                                                            <?php if($h->payment_method === 'account' && $h->account): ?>
                                                                                                <br>
                                                                                                <small
                                                                                                    class="text-muted">Acc
                                                                                                    #:
                                                                                                    <?php echo e($h->account->number ?? 'N/A'); ?></small>
                                                                                            <?php endif; ?>
                                                                                        </td>
                                                                                        <td><?php echo e($h->user->name ?? 'N/A'); ?>

                                                                                        </td>
                                                                                        <td><?php echo e(\Carbon\Carbon::parse($h->submission_date ?? $h->created_at)->format('d M Y')); ?>

                                                                                        </td>
                                                                                    </tr>
                                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                            </tbody>
                                                                        </table>
                                                                    <?php endif; ?>
                                                                </div>

                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-dismiss="modal">Close</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    
                                                    <?php if($latestFee): ?>
                                                        <button type="button" class="btn btn-sm btn-info mt-1"
                                                            data-toggle="modal"
                                                            data-target="#receiptModal<?php echo e($admission->id); ?>"
                                                            title="View Receipt">
                                                            <i class="fas fa-file-invoice"></i>
                                                        </button>

                                                        <div class="modal fade" id="receiptModal<?php echo e($admission->id); ?>"
                                                            tabindex="-1" role="dialog"
                                                            aria-labelledby="receiptModalLabel<?php echo e($admission->id); ?>"
                                                            aria-hidden="true">
                                                            <div class="modal-dialog modal-lg" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header bg-primary text-white">
                                                                        <h5 class="modal-title"
                                                                            id="receiptModalLabel<?php echo e($admission->id); ?>">
                                                                            Receipt - #<?php echo e($latestFee->receipt_no); ?>

                                                                        </h5>
                                                                        <button type="button" class="close text-white"
                                                                            data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <p><strong>Student:</strong>
                                                                            <?php echo e($admission->name); ?>

                                                                        </p>
                                                                        <p><strong>Course:</strong>
                                                                            <?php echo e($admission->course->title ?? 'N/A'); ?>

                                                                        </p>
                                                                        <p><strong>Fee Type:</strong>
                                                                            <?php echo e(ucfirst($latestFee->payment_type)); ?></p>
                                                                        <p><strong>Amount Paid:</strong>
                                                                            <?php echo e(number_format($latestFee->amount)); ?> PKR
                                                                        </p>
                                                                        <p><strong>Payment Method:</strong>
                                                                            <?php echo e(ucfirst($latestFee->payment_method ?? 'N/A')); ?>

                                                                        </p>
                                                                        <p><strong>Date:</strong>
                                                                            <?php echo e(\Carbon\Carbon::parse($latestFee->submission_date ?? $latestFee->created_at)->format('d M Y')); ?>

                                                                        </p>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <a href="<?php echo e(route('fee-submission.download-receipt', $latestFee->id)); ?>"
                                                                            class="btn btn-primary">Download PDF</a>
                                                                        <button type="button" class="btn btn-secondary"
                                                                            data-dismiss="modal">Close</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <?php endif; ?>
<?php /**PATH E:\projects\codezy\zain-changes\codezy\resources\views/admin/pages/dashboard/fee-submission/button.blade.php ENDPATH**/ ?>