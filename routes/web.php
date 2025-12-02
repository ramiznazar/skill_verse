<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;

use App\Http\Controllers\Website\{
    HomeController,
    BlogController,
    AboutController,
    FaqController,
    EventController,
    CourseController,
    ContactController,
    TestBookingController,
    CourseDetailController,
    EventDetailController,
    UserMessageController as FrontUserMessageController
};
use App\Http\Controllers\Admin\Dashboard\{
    AuthController,
    UserController,
    ProfileController,
    LeadController,
    LeadFollowUpController,
    PartnerController,
    PartnerProfitController,
    NotificationController,
    NotificationTableController,
    PartnerBalanceController,
    BatchController,
    AccountController,
    ExpenseController,
    TeacherController,
    AdmissionController,
    CourseFeeController,
    FeeCollectorController,
    FeeSubmissionController,
    TeacherSalaryController,
    TeacherBalanceController,
    ProfitCalculationController,
    StudentAttendanceController,
    TeacherAttendanceController,
    ReferralCommissionController,
    TestDayController,
    TestSettingController,
    TestBookingController as AdminTestBookingController
};
use App\Http\Controllers\Admin\Website\{
    BannerController,
    CounterController,
    ProjectController,
    TestimonialController,
    PopularCourseController,
    CourseCategoryController,
    CourseLmsController,
    CourseLanguageController,
    CourseOutlineController,
    BlogController as AdminBlogController,
    EventController as AdminEventController,
    CourseController as AdminCourseController,
    UserMessageController as AdminUserMessageController,
    EventLinkController,
    EventParticipantController,
    GallaryCategoryController,
    GallaryImageController
};
use App\Http\Controllers\Admin\HomeController as AdminHomeController;

/*
|--------------------------------------------------------------------------
| Website Routes (Public)
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'home'])->name('home');
Route::get('/courses', [CourseController::class, 'course'])->name('course');
Route::get('/course/{slug}', [CourseController::class, 'courseDetail'])->name('course.detail');
Route::get('/our-events', [EventController::class, 'event'])->name('event');
Route::get('/event/{id}', [EventController::class, 'eventDetail'])->name('event.detail');
Route::get('/about-us', [AboutController::class, 'about'])->name('about');
Route::get('/blog', [BlogController::class, 'blog'])->name('blog');
Route::get('/faq', [FaqController::class, 'faq'])->name('faq');
Route::get('/contact', [ContactController::class, 'contact'])->name('contact');
Route::post('/user/message', [ContactController::class, 'userMessage'])->name('user.message.store');
Route::get('/book-interview', [TestBookingController::class, 'create'])->name('test.booking');
Route::post('/book-interview', [TestBookingController::class, 'store'])->name('test.booking.store');
Route::get('/test-booking-summary/{id}', [TestBookingController::class, 'summary'])->name('test.booking.summary');
Route::get('/test/get-slots/{dayId}', [TestBookingController::class, 'getSlots'])->name('test.get.slots');



/*
|--------------------------------------------------------------------------
| Admin Panel Routes (No Middleware / No Auth)
|--------------------------------------------------------------------------
*/
Route::get('/register-2468', [AuthController::class, 'register'])->name('auth.register');
Route::post('/register/store', [AuthController::class, 'registerStore'])->name('auth.register.store');
Route::get('/login', [AuthController::class, 'login'])->name('auth.login');
Route::post('/login/store', [AuthController::class, 'loginStore'])->name('auth.login.store');
Route::get('/logout', [AuthController::class, 'logout'])->name('auth.logout');

Route::middleware(['auth', 'validuser'])->prefix('admin')->group(function () {
    // Dashboard (No auth)
    Route::get('/', [AdminHomeController::class, 'home'])->name('admin');

    Route::get('/chart-data/weekly', [AdminHomeController::class, 'getWeeklyData'])->name('chart.weekly');
    Route::get('/chart-data/monthly', [AdminHomeController::class, 'getMonthlyData'])->name('chart.monthly');
    Route::get('/chart-data/yearly', [AdminHomeController::class, 'getYearlyData'])->name('chart.yearly');

    Route::get('/user/index', [UserController::class, 'index'])->name('user.index');
    Route::get('/user/create', [UserController::class, 'create'])->name('user.create');
    Route::post('/user/store', [UserController::class, 'store'])->name('user.store');
    Route::get('/user/edit/{id}', [UserController::class, 'edit'])->name('user.edit');
    Route::put('/user/update/{id}', [UserController::class, 'update'])->name('user.update');
    Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('user.destroy');
    //Profile
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/update/', [ProfileController::class, 'update'])->name('profile.update');

    Route::get('notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::post('notifications/{id}/read', [NotificationController::class, 'markAsRead']);
    Route::post('notifications/read-all', [NotificationController::class, 'markAllAsRead'])->name('notifications.readAll');
    //Notification Table
    Route::get('notifications/all', [NotificationTableController::class, 'index'])->name('admin.notifications.table');
    Route::get('notifications/{notification}', [NotificationTableController::class, 'show'])->name('admin.notifications.show');
    // (optional) bulk actions
    Route::post('notifications/bulk/status', [NotificationTableController::class, 'bulkStatus'])->name('admin.notifications.bulkStatus');

    //Student Attendance
    Route::get('/student-attendance', [StudentAttendanceController::class, 'index'])->name('student.attendance.index');
    Route::get('/student-attendance/history/{admission}', [StudentAttendanceController::class, 'history'])
        ->name('student.attendance.history');
    // Quick actions (single student)
    Route::post('/student-attendance/mark-present', [StudentAttendanceController::class, 'markPresent'])->name('student.attendance.markPresent');
    Route::post('/student-attendance/mark-absent', [StudentAttendanceController::class, 'markAbsent'])->name('student.attendance.markAbsent');
    Route::post('/student-attendance/mark-leave', [StudentAttendanceController::class, 'markLeave'])->name('student.attendance.markLeave');
    Route::post('/student-attendance/mark-late', [StudentAttendanceController::class, 'markLate'])->name('student.attendance.markLate');
    // Bulk action for all filtered students
    Route::post('/student-attendance/bulk-present', [StudentAttendanceController::class, 'bulkMarkPresent'])->name('student.attendance.bulkPresent');

    //Teacher Attendance
    Route::get('/teacher-attendance', [TeacherAttendanceController::class, 'index'])->name('teacher.attendance.index');
    Route::get('/teacher-attendance/history/{teacher}', [TeacherAttendanceController::class, 'history'])->name('teacher.attendance.history');

    Route::post('/teacher-attendance/mark-present', [TeacherAttendanceController::class, 'markPresent'])->name('teacher.attendance.markPresent');
    Route::post('/teacher-attendance/mark-absent', [TeacherAttendanceController::class, 'markAbsent'])->name('teacher.attendance.markAbsent');
    Route::post('/teacher-attendance/mark-leave', [TeacherAttendanceController::class, 'markLeave'])->name('teacher.attendance.markLeave');
    Route::post('/teacher-attendance/mark-late', [TeacherAttendanceController::class, 'markLate'])->name('teacher.attendance.markLate');
    Route::post('/teacher-attendance/bulk-present', [TeacherAttendanceController::class, 'bulkMarkPresent'])->name('teacher.attendance.bulkPresent');

    // Admin Resources
    Route::prefix('dashboard')->name('admin.')->group(function () {
        Route::resource('partners', PartnerController::class);

        Route::prefix('partner_profits')->name('partner_profits.')->group(function () {
            Route::get('/', [PartnerProfitController::class, 'index'])->name('index');
            Route::post('/generate', [PartnerProfitController::class, 'generateMonthlyProfit'])->name('generate_monthly');
            Route::put('/{id}/paid', [PartnerProfitController::class, 'markAsPaid'])->name('mark_as_paid');
            Route::put('/{id}/balance', [PartnerProfitController::class, 'moveToBalance'])->name('move_to_balance');
            Route::get('/full-history', [PartnerProfitController::class, 'fullHistory'])->name('full_history');
            Route::get('/history/{partner_id}', [PartnerProfitController::class, 'history'])->name('history');
            Route::get('/balances', [PartnerProfitController::class, 'balanceIndex'])->name('partner_balances.index');
            // routes/web.php
            Route::put('/partner-balances/{id}/status-paid', [PartnerBalanceController::class, 'statusPaid'])
                ->name('partner_balances.status_paid');
        });
    });
    Route::get('/referral-commission', [ReferralCommissionController::class, 'index'])->name('referral-commission.index');
    Route::put('/referral-commission/paid', [ReferralCommissionController::class, 'paid'])->name('referral-commission.paid');
    Route::get('/referral-commission/history/{name}/{contact?}', [ReferralCommissionController::class, 'history'])->name('referral-commission.history');

    Route::prefix('test')->group(function () {

        // Global settings
        Route::get('/settings', [TestSettingController::class, 'index'])->name('test.settings');
        Route::post('/settings/update', [TestSettingController::class, 'update'])->name('test.settings.update');

        // Daily limits CRUD
        Route::get('/days', [TestDayController::class, 'index'])->name('test.days');
        Route::get('/days/create', [TestDayController::class, 'create'])->name('test.days.create');
        Route::post('/days/store', [TestDayController::class, 'store'])->name('test.days.store');
        Route::get('/days/{id}/edit', [TestDayController::class, 'edit'])->name('test.days.edit');
        Route::post('/days/{id}/update', [TestDayController::class, 'update'])->name('test.days.update');
        Route::delete('/days/{id}/delete', [TestDayController::class, 'destroy'])->name('test.days.delete');

        // Bookings
        Route::get('/bookings', [AdminTestBookingController::class, 'index'])->name('test.bookings.index');
        Route::get('/bookings/{id}/show', [AdminTestBookingController::class, 'show'])->name('test.bookings.show');
        Route::delete('/bookings/{id}/delete', [AdminTestBookingController::class, 'destroy'])->name('test.bookings.delete');
        Route::post('/bookings/attendance', [AdminTestBookingController::class, 'markAttendance'])->name('test.booking.attendance');
        Route::post('/bookings/result', [AdminTestBookingController::class, 'markResult'])->name('test.booking.result');
        // Load batches for modal
        Route::get('/test-booking/load-batches', [AdminTestBookingController::class, 'loadBatches'])
            ->name('test.booking.loadBatches');

        // Confirm pass with batch select
        Route::post('/test-booking/confirm-pass', [AdminTestBookingController::class, 'confirmPass'])
            ->name('test.booking.confirmPass');
    });

    // All Admin Resource Controllers
    Route::resources([
        'banner' => BannerController::class,
        'course-category' => CourseCategoryController::class,
        'course' => AdminCourseController::class,
        'project' => ProjectController::class,
        'testimonial' => TestimonialController::class,
        'blog' => AdminBlogController::class,
        'counter' => CounterController::class,
        'user/message' => AdminUserMessageController::class,
        'event' => AdminEventController::class,
        'course-fee' => CourseFeeController::class,
        'teacher' => TeacherController::class,
        'batch' => BatchController::class,
        'lead' => LeadController::class,
        // 'follow-up' => LeadFollowUpController::class,
        'admission' => AdmissionController::class,
        'account' => AccountController::class,
        'expense' => ExpenseController::class,
    ]);
    Route::get('admission/{admission}/add-course', [AdmissionController::class, 'addCourseForm'])->name('admission.addCourse');
    Route::post('admission/{admission}/add-course', [AdmissionController::class, 'storeNewCourse'])->name('admission.storeNewCourse');
    Route::get('admin/admission/{admission}/course/{course}/edit', [AdmissionController::class, 'editCourse'])
        ->name('admission.editCourse');
    Route::put('admin/admission/{admission}/course/{course}', [AdmissionController::class, 'updateCourse'])
        ->name('admission.updateCourse');


    // Popular Course
    Route::resource('popular-course', PopularCourseController::class);

    // Teacher Salary
    Route::get('/teacher-salary', [TeacherSalaryController::class, 'index'])->name('teacher-salary.index');
    Route::put('/teacher-salary/{id}/paid', [TeacherSalaryController::class, 'StatusPaid'])->name('teacher-salary.status-paid');
    Route::put('/teacher-salary/{id}/balance', [TeacherSalaryController::class, 'StatusBalance'])->name('teacher-salary.status-balance');
    Route::get('/teacher-balance', [TeacherBalanceController::class, 'balance'])->name('teacher.balance');
    Route::put('/teacher-balance/{id}/paid', [TeacherBalanceController::class, 'StatusPaid'])->name('teacher-balance.status-paid');
    Route::get('/teacher/{teacherId}/salary-history', [TeacherSalaryController::class, 'historyByTeacher'])->name('teacher-salary.history');
    // Fee Submission
    Route::get('/fee-submission', [FeeSubmissionController::class, 'index'])->name('fee-submission.index');
    Route::get('/fee-submission/{id}', [FeeSubmissionController::class, 'create'])->name('fee-submission.create');
    Route::post('/fee-submission/store/{id}', [FeeSubmissionController::class, 'store'])->name('fee-submission.store');
    Route::get('/fee-submissions/{id}/receipt', [FeeSubmissionController::class, 'receipt'])->name('fee-submissions.receipt');
    Route::get('/fee-submissions/{id}/download-pdf', [FeeSubmissionController::class, 'downloadReceipt'])->name('fee-submission.download-receipt');
    // Lead Follow Up
    Route::get('/lead-followups/{lead}', [LeadFollowUpController::class, 'index'])->name('lead-followups.index');
    Route::get('/lead-followups/{lead}/create', [LeadFollowUpController::class, 'create'])->name('lead-followups.create');
    Route::post('/lead-followups/{lead}/store', [LeadFollowUpController::class, 'store'])->name('lead-followups.store');
    Route::get('/lead-followups/{lead}/{followup}/edit', [LeadFollowUpController::class, 'edit'])->name('lead-followups.edit');
    Route::put('/lead-followups/{lead}/{followup}', [LeadFollowUpController::class, 'update'])->name('lead-followups.update');
    Route::delete('/lead-followups/{lead}/{followUp}', [LeadFollowUpController::class, 'destroy'])->name('lead-followups.destroy');
    //Fee Collector
    Route::get('/fee-collector', [FeeCollectorController::class, 'index'])->name('fee-collector.index');
    Route::get('/collector-history/{user}', [FeeCollectorController::class, 'collectorHistory'])->name('collector.history');
    Route::get('/account-history/{account}', [FeeCollectorController::class, 'accountHistory'])->name('account.history');

    // Course Outlines
    Route::prefix('admin')->name('course-outline.')->group(function () {
        Route::get('courses/{course}/outlines', [CourseOutlineController::class, 'index'])->name('index');
        Route::get('courses/{course}/outlines/create', [CourseOutlineController::class, 'create'])->name('create');
        Route::post('courses/{course}/outlines', [CourseOutlineController::class, 'store'])->name('store');
        Route::get('courses/{course}/outlines/{id}/edit', [CourseOutlineController::class, 'edit'])->name('edit');
        Route::put('courses/{course}/outlines/{id}', [CourseOutlineController::class, 'update'])->name('update');
        Route::delete('outlines/{id}', [CourseOutlineController::class, 'destroy'])->name('destroy');
    });


    // Course LMS
    Route::prefix('course-lms')->name('course-lms.')->group(function () {
        Route::get('/{course_id}', [CourseLmsController::class, 'index'])->name('index');
        Route::get('/create/{course_id}', [CourseLmsController::class, 'create'])->name('create');
        Route::post('/store/{course_id}', [CourseLmsController::class, 'store'])->name('store');
        Route::get('/{course_id}/edit/{id}', [CourseLmsController::class, 'edit'])->name('edit');
        Route::put('/{course_id}/update/{id}', [CourseLmsController::class, 'update'])->name('update');
        Route::delete('/{id}', [CourseLmsController::class, 'destroy'])->name('destroy');
    });

    // Event Discussion
    Route::prefix('event-link')->name('event-link.')->group(function () {
        Route::get('/{event_id}', [EventLinkController::class, 'index'])->name('index');
        Route::get('/create/{event_id}', [EventLinkController::class, 'create'])->name('create');
        Route::post('/store/{event_id}', [EventLinkController::class, 'store'])->name('store');
        Route::get('/{event_id}/edit/{id}', [EventLinkController::class, 'edit'])->name('edit');
        Route::put('/{event_id}/update/{id}', [EventLinkController::class, 'update'])->name('update');
        Route::delete('/{id}', [EventLinkController::class, 'destroy'])->name('destroy');
    });

    // Event Participant
    Route::prefix('event-participant')->name('event-participant.')->group(function () {
        Route::get('/{event_id}', [EventParticipantController::class, 'index'])->name('index');
        Route::get('/create/{event_id}', [EventParticipantController::class, 'create'])->name('create');
        Route::post('/store/{event_id}', [EventParticipantController::class, 'store'])->name('store');
        Route::get('/{event_id}/edit/{id}', [EventParticipantController::class, 'edit'])->name('edit');
        Route::put('/{event_id}/update/{id}', [EventParticipantController::class, 'update'])->name('update');
        Route::delete('/{id}', [EventParticipantController::class, 'destroy'])->name('destroy');
    });

    // Get batches by course
    Route::get('admission/get-batches/{courseId}', [BatchController::class, 'getByCourse'])->name('get-batches');

    //Gallary Image
    Route::resource('gallary-category', GallaryCategoryController::class);
    Route::resource('gallary-image', GallaryImageController::class);
});

Route::get('/optimize-app', function () {
    Artisan::call('optimize:clear');
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('route:clear');
    Artisan::call('view:clear');
    Artisan::call('config:cache');
    Artisan::call('route:cache');
    Artisan::call('view:cache');
    Artisan::call('optimize');

    return "Application optimized and caches cleared successfully!";
});
Route::get('/migrate', function () {
    Artisan::call('migrate');
    return response()->json(['message' => 'Migration successful'], 200);
});
Route::get('/migrate/rollback', function () {
    Artisan::call('migrate:rollback');
    return response()->json(['message' => 'Migration rollback successfully'], 200);
});
