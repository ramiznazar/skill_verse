                                                    @php
                                                        // get latest fee by submission_date if you store it, else by created_at
                                                        $latestFee =
                                                            $admission
                                                                ->feeSubmissions()
                                                                ->latest('submission_date')
                                                                ->first() ??
                                                            $admission->feeSubmissions()->latest()->first();
                                                    @endphp

                                                    {{-- Show Submit Fee button ONLY if not complete --}}
                                                    @if (strtolower($admission->fee_status) !== 'complete')
                                                        <a href="{{ route('fee-submission.create', $admission->id) }}"
                                                            class="btn btn-sm btn-default" data-toggle="tooltip"
                                                            title="Submit Fee">
                                                            <i class="fas fa-money-check-alt"></i>
                                                        </a>
                                                    @endif

                                                    {{-- View History --}}
                                                    <button type="button" class="btn btn-sm btn-secondary mt-1"
                                                        data-toggle="modal"
                                                        data-target="#historyModal{{ $admission->id }}"
                                                        title="View History">
                                                        <i class="fas fa-history"></i>
                                                    </button>

                                                    {{-- History Modal --}}
                                                    <div class="modal fade" id="historyModal{{ $admission->id }}"
                                                        tabindex="-1" role="dialog"
                                                        aria-labelledby="historyModalLabel{{ $admission->id }}"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog modal-lg" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header bg-dark text-white">
                                                                    <h5 class="modal-title"
                                                                        id="historyModalLabel{{ $admission->id }}">
                                                                        Fee Submission History - {{ $admission->name }}
                                                                    </h5>
                                                                    <button type="button" class="close text-white"
                                                                        data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>

                                                                <div class="modal-body">
                                                                    @php
                                                                        $history = $admission
                                                                            ->feeSubmissions()
                                                                            ->orderBy('submission_date', 'asc')
                                                                            ->get();
                                                                    @endphp

                                                                    @if ($history->isEmpty())
                                                                        <p>No fee submissions yet.</p>
                                                                    @else
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
                                                                                @foreach ($history as $h)
                                                                                    <tr>
                                                                                        <td>{{ $loop->iteration }}</td>
                                                                                        <td>{{ $h->admission->name }}
                                                                                        </td>
                                                                                        <td>{{ ucfirst(str_replace('_', ' ', $h->payment_type)) }}
                                                                                        </td>
                                                                                        <td>{{ number_format($h->amount) }}
                                                                                            PKR</td>
                                                                                        <td>
                                                                                            {{ ucfirst($h->payment_method) }}
                                                                                            @if ($h->payment_method === 'account' && $h->account)
                                                                                                <br>
                                                                                                <small
                                                                                                    class="text-muted">Acc
                                                                                                    #:
                                                                                                    {{ $h->account->number ?? 'N/A' }}</small>
                                                                                            @endif
                                                                                        </td>
                                                                                        <td>{{ $h->user->name ?? 'N/A' }}
                                                                                        </td>
                                                                                        <td>{{ \Carbon\Carbon::parse($h->submission_date ?? $h->created_at)->format('d M Y') }}
                                                                                        </td>
                                                                                    </tr>
                                                                                @endforeach
                                                                            </tbody>
                                                                        </table>
                                                                    @endif
                                                                </div>

                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-dismiss="modal">Close</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    {{-- Receipt --}}
                                                    @if ($latestFee)
                                                        <button type="button" class="btn btn-sm btn-info mt-1"
                                                            data-toggle="modal"
                                                            data-target="#receiptModal{{ $admission->id }}"
                                                            title="View Receipt">
                                                            <i class="fas fa-file-invoice"></i>
                                                        </button>

                                                        <div class="modal fade" id="receiptModal{{ $admission->id }}"
                                                            tabindex="-1" role="dialog"
                                                            aria-labelledby="receiptModalLabel{{ $admission->id }}"
                                                            aria-hidden="true">
                                                            <div class="modal-dialog modal-lg" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header bg-primary text-white">
                                                                        <h5 class="modal-title"
                                                                            id="receiptModalLabel{{ $admission->id }}">
                                                                            Receipt - #{{ $latestFee->receipt_no }}
                                                                        </h5>
                                                                        <button type="button" class="close text-white"
                                                                            data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <p><strong>Student:</strong>
                                                                            {{ $admission->name }}
                                                                        </p>
                                                                        <p><strong>Course:</strong>
                                                                            {{ $admission->course->title ?? 'N/A' }}
                                                                        </p>
                                                                        <p><strong>Fee Type:</strong>
                                                                            {{ ucfirst($latestFee->payment_type) }}</p>
                                                                        <p><strong>Amount Paid:</strong>
                                                                            {{ number_format($latestFee->amount) }} PKR
                                                                        </p>
                                                                        <p><strong>Payment Method:</strong>
                                                                            {{ ucfirst($latestFee->payment_method ?? 'N/A') }}
                                                                        </p>
                                                                        <p><strong>Date:</strong>
                                                                            {{ \Carbon\Carbon::parse($latestFee->submission_date ?? $latestFee->created_at)->format('d M Y') }}
                                                                        </p>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <a href="{{ route('fee-submission.download-receipt', $latestFee->id) }}"
                                                                            class="btn btn-primary">Download PDF</a>
                                                                        <button type="button" class="btn btn-secondary"
                                                                            data-dismiss="modal">Close</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
