<?php $__env->startSection('content'); ?>
    <div class="main-content">

        <!-- Section: inner-header -->
        <section class="inner-header divider parallax layer-overlay overlay-dark-5"
            data-bg-img="<?php echo e(asset('assets/website/images/bg/bg3.jpg')); ?>">
            <div class="container pt-70 pb-20">
                <div class="section-content">
                    <div class="row">
                        <div class="col-md-12">
                            <h2 class="title text-white">Interview Booking</h2>
                            <ol class="breadcrumb text-left text-black mt-10">
                                <li><a href="<?php echo e(route('home')); ?>">Home</a></li>
                                <li class="active text-gray-silver">Interview Booking</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <?php if($courses->count()): ?>
            <section class="bg-lighter">
                <div class="container pt-30 pb-10">
                    <div class="row">
                        <div class="col-md-12 text-center mb-20">
                            
                            <p class="text-muted">
                                Book your interview today and lock these special limited-time fees.
                            </p>

                            <p class="text-muted mt-5" style="font-size:14px;">
                                <span style="color:#ff5722; font-weight:600;">Sponsored by HMS Tech Solutions</span> —
                                Empowering Digital Skills & IT Education.
                            </p>
                        </div>

                    </div>

                    <div class="row">
                        <?php $__currentLoopData = $courses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $course): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                                $discAmount = $course->full_fee - $course->interview_discount_amount;
                            ?>

                            <div class="col-sm-6 col-md-4">
                                <div class="border-1px bg-white mb-20 p-15 course-discount-card"
                                    style="border-radius:6px; box-shadow:0 5px 15px rgba(0,0,0,0.05);">
                                    <h4 class="mt-0 mb-5"><?php echo e($course->title); ?></h4>

                                    <p class="mb-5 text-muted">
                                        <small>Standard Fee</small><br>
                                        <span style="text-decoration:line-through; color:#999;">
                                            Rs <?php echo e(number_format($course->full_fee)); ?>

                                        </span>
                                    </p>

                                    <p class="mb-5">
                                        <small>Interview Discount</small><br>

                                        <span class="badge" style="background:#ff9800; color:#fff;">
                                            <?php echo e(number_format($course->interview_discount_per)); ?>%
                                            OFF
                                        </span>

                                        <span class="text-theme-colored ml-5">
                                            – Rs <?php echo e(number_format($discAmount)); ?>

                                        </span>
                                    </p>

                                    <p class="mb-0">
                                        <small class="text-muted">Final Fee After Discount</small><br>
                                        <span class="font-20 text-theme-colored font-weight-700">
                                            Rs <?php echo e(number_format($course->interview_discount_amount)); ?>

                                        </span>
                                    </p>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </section>
        <?php endif; ?>

        <!-- Section: Booking Form -->
        <section class="divider">
            <div class="container">
                <div class="row pt-30">
                    <div class="col-md-12">

                        <h3 class="line-bottom mt-0 mb-20">Register for Interview & Unlock Your Discount</h3>
                        <p class="mb-20">
                            Fill out the form below to receive your interview date and time. Limited slots are available
                            each day, and if today is fully booked, you’ll be automatically scheduled for the next available
                            day.
                        </p>

                        
                        <?php if($errors->any()): ?>
                            <div class="alert alert-danger"
                                style="border-radius:6px; padding:15px 20px; font-size:15px; 
                background:#ffe5e5; border-left:5px solid #d9534f; color:#a94442;">
                                <strong style="font-size:16px;">⚠️ Please Note:</strong><br>

                                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <span style="display:block; margin-top:5px;"><?php echo e($error); ?></span>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        <?php endif; ?>

                        <form action="<?php echo e(route('test.booking.store')); ?>" method="POST">
                            <?php echo csrf_field(); ?>

                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <input type="text" name="name" class="form-control"
                                            placeholder="Enter Full Name" required>
                                    </div>
                                </div>

                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <input type="email" name="email" class="form-control"
                                            placeholder="Enter Email Address" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <input type="text" name="phone" class="form-control"
                                            placeholder="Enter Phone Number" required>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <select name="course_id" class="form-control" required>
                                            <option value="">Select Course</option>
                                            <?php $__currentLoopData = $courses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $course): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($course->id); ?>">
                                                    <?php echo e($course->title); ?>

                                                </option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Select Interview Date</label>
                                        <select id="test_date" class="form-control" required>
                                            <option value="">Select a date</option>

                                            <?php $__currentLoopData = $days; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $day): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($day->id); ?>">
                                                    <?php echo e(\Carbon\Carbon::parse($day->test_date)->format('d M Y')); ?>

                                                </option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-12" id="slot_container" style="display: none;">
                                    <div class="form-group">
                                        <label>Select Time Slot</label>
                                        <select name="slot" id="slot" class="form-control" required>
                                            <option value="">Select a date first</option>
                                        </select>

                                        <?php $__errorArgs = ['slot'];
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
                                </div>
                            </div>


                            <div class="form-group">
                                <textarea name="purpose" class="form-control required" rows="5"
                                    placeholder="Tell us why you want to join (optional)"></textarea>
                            </div>

                            <button type="submit"
                                class="btn btn-theme-colored btn-flat text-uppercase 
                                border-left-theme-color-2-4px">
                                Book My Test
                            </button>
                        </form>

                    </div>
                </div>
            </div>
        </section>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('additional-javascript'); ?>
    <script>
        // Cache to store pre-fetched slots with dates
        let slotsCache = {};
        let isLoadingSlots = false;

        // Store day IDs and their dates for quick lookup
        const dayDates = {
            <?php $__currentLoopData = $days; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $day): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php echo e($day->id); ?>: "<?php echo e($day->test_date); ?>"<?php echo e(!$loop->last ? ',' : ''); ?>

            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        };

        // Function to check if a slot time has passed
        function isSlotTimePassed(testDate, slotTime) {
            const now = new Date();
            const today = new Date(now.getFullYear(), now.getMonth(), now.getDate());
            
            // Parse the test date (format: YYYY-MM-DD)
            const [year, month, day] = testDate.split('-').map(Number);
            const slotDate = new Date(year, month - 1, day);
            
            // If the test date is in the future, slot hasn't passed
            if (slotDate > today) {
                return false;
            }
            
            // If the test date is today, check the time
            if (slotDate.getTime() === today.getTime()) {
                // Parse slot time (format: HH:MM)
                const [hours, minutes] = slotTime.split(':').map(Number);
                const slotDateTime = new Date(year, month - 1, day, hours, minutes);
                
                // Check if slot time has passed
                return slotDateTime < now;
            }
            
            // If the test date is in the past, slot has passed
            return true;
        }

        // Pre-fetch all slots when page loads
        document.addEventListener('DOMContentLoaded', function() {
            const dayIds = [
                <?php $__currentLoopData = $days; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $day): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php echo e($day->id); ?><?php echo e(!$loop->last ? ',' : ''); ?>

                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            ];

            // Fetch slots for all days in parallel
            if (dayIds.length > 0) {
                isLoadingSlots = true;
                const fetchPromises = dayIds.map(dayId => 
                    fetch("<?php echo e(url('/test/get-slots')); ?>/" + dayId)
                        .then(response => response.json())
                        .then(res => {
                            slotsCache[dayId] = {
                                date: res.date,
                                slots: res.slots
                            };
                        })
                        .catch(error => {
                            console.error('Error fetching slots for day ' + dayId + ':', error);
                            slotsCache[dayId] = {
                                date: dayDates[dayId] || '',
                                slots: []
                            };
                        })
                );

                Promise.all(fetchPromises).then(() => {
                    isLoadingSlots = false;
                });
            }
        });

        // Handle date selection change
        document.getElementById('test_date').addEventListener('change', function() {
            let dayId = this.value;
            let slotDropdown = document.getElementById('slot');
            let slotContainer = document.getElementById('slot_container');

            // Always hide first
            slotContainer.style.display = "none";
            slotDropdown.innerHTML = '<option>Loading...</option>';

            if (!dayId) {
                slotDropdown.innerHTML = '<option>Select a date first</option>';
                return;
            }

            // Get the selected date to check if it's today
            const selectedDate = dayDates[dayId];
            const today = new Date();
            const todayStr = today.getFullYear() + '-' + 
                           String(today.getMonth() + 1).padStart(2, '0') + '-' + 
                           String(today.getDate()).padStart(2, '0');
            const isToday = selectedDate === todayStr;

            // Always refresh slots for today's date to ensure we have latest data
            if (isToday) {
                fetchSlots(dayId, slotDropdown, slotContainer);
                return;
            }

            // Check if slots are cached
            if (slotsCache[dayId] !== undefined) {
                // Use cached slots immediately
                displaySlots(dayId, slotsCache[dayId].slots, slotsCache[dayId].date, slotDropdown, slotContainer);
            } else if (isLoadingSlots) {
                // If still loading, wait a bit and check again
                setTimeout(function() {
                    if (slotsCache[dayId] !== undefined) {
                        displaySlots(dayId, slotsCache[dayId].slots, slotsCache[dayId].date, slotDropdown, slotContainer);
                    } else {
                        // Fallback: fetch if not in cache
                        fetchSlots(dayId, slotDropdown, slotContainer);
                    }
                }, 100);
            } else {
                // Fallback: fetch if not in cache
                fetchSlots(dayId, slotDropdown, slotContainer);
            }
        });

        // Function to display slots (filtering out past slots)
        function displaySlots(dayId, slots, testDate, slotDropdown, slotContainer) {
            slotContainer.style.display = "block";
            slotDropdown.innerHTML = '';

            // Always filter past slots on frontend as well (double-check)
            const now = new Date();
            const today = new Date(now.getFullYear(), now.getMonth(), now.getDate());
            const [year, month, day] = testDate.split('-').map(Number);
            const slotDate = new Date(year, month - 1, day);
            const isToday = slotDate.getTime() === today.getTime();

            const availableSlots = slots.filter(slot => {
                // If not today, all slots are available
                if (!isToday) {
                    return true;
                }
                
                // If today, check if slot time has passed
                const [hours, minutes] = slot.time.split(':').map(Number);
                const slotDateTime = new Date(year, month - 1, day, hours, minutes);
                
                return slotDateTime >= now;
            });

            if (availableSlots.length === 0) {
                slotDropdown.innerHTML = '<option value="">No slots available</option>';
                return;
            }

            slotDropdown.innerHTML = `<option value="">Select Time Slot</option>`;

            availableSlots.forEach(slot => {
                // Use time_display (AM/PM format) if available, otherwise fallback to time
                const displayTime = slot.time_display || slot.time;
                slotDropdown.innerHTML += `
                    <option value="${dayId}|${slot.time}">
                        ${displayTime} (${slot.available} seats left)
                    </option>
                `;
            });
        }

        // Fallback function to fetch slots if not cached
        function fetchSlots(dayId, slotDropdown, slotContainer) {
            fetch("<?php echo e(url('/test/get-slots')); ?>/" + dayId)
                .then(response => response.json())
                .then(res => {
                    // Cache the result
                    slotsCache[dayId] = {
                        date: res.date,
                        slots: res.slots
                    };
                    displaySlots(dayId, res.slots, res.date, slotDropdown, slotContainer);
                })
                .catch(error => {
                    console.error('Error fetching slots:', error);
                    slotContainer.style.display = "block";
                    slotDropdown.innerHTML = '<option value="">Error loading slots</option>';
                });
        }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('website.layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\projects\codezy\zain-changes\codezy\resources\views/website/pages/test/booking.blade.php ENDPATH**/ ?>