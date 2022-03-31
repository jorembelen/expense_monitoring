<?php

use App\Http\Controllers\CashReportController;
use App\Http\Controllers\ReportController;
use App\Http\Livewire\AddVoucher;
use App\Http\Livewire\CashAdvance\Approval;
use App\Http\Livewire\CashAdvance\Create;
use App\Http\Livewire\CashAdvance\Index;
use App\Http\Livewire\CashBooksList;
use App\Http\Livewire\CashReports;
use App\Http\Livewire\CodeLists;
use App\Http\Livewire\EmployeesList;
use App\Http\Livewire\ForApproval;
use App\Http\Livewire\ForApprovalList;
use App\Http\Livewire\ResetPassword;
use App\Http\Livewire\UnpaidCashReport;
use App\Http\Livewire\UsersList;
use App\Http\Livewire\VoucherReport;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Auth::routes();

Route::group(['middleware' => 'auth'], function () {

    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::get('reset-password', ResetPassword::class)->name('reset.pw');
    Route::get('employees', EmployeesList::class)->name('employees');
    Route::get('users', UsersList::class)->name('users');
    Route::get('cash-book', CashBooksList::class)->name('cash-book');
    Route::get('for-approval-list', ForApprovalList::class)->name('for-approval-list');
    Route::get('for-approval/{code}', ForApproval::class)->name('for-approval');
    Route::get('gl-code-lists', CodeLists::class)->name('gl-codes');
    Route::get('unpaid-cash-report', UnpaidCashReport::class)->name('unpaid-cash-report');
    Route::get('cash-reports', CashReports::class)->name('cash-report');
    Route::get('add-voucher/{code}', AddVoucher::class)->name('voucher.create');
    Route::get('voucher-report/{code}', VoucherReport::class)->name('voucher.report');
    Route::get('create-cash-report', [CashReportController::class, 'create'])->name('cash-report.create');
    Route::get('user-create-cash-report/{id}', [CashReportController::class, 'userCreate'])->name('user-cash-report.create');
    Route::post('store-cash-report', [CashReportController::class, 'store'])->name('report.store');

    // Create Cash Advance
    Route::get('create-cash-advance', Create::class)->name('ca.create');
    Route::get('cash-advance-lists', Index::class)->name('cash-advance');
    Route::get('cash-advance-for-approval', Approval::class)->name('ca-approval');

    // Reports
    Route::get('reports', [ReportController::class, 'index'])->name('reports');
    Route::get('filter', [ReportController::class, 'filter'])->name('filter.reports');
    Route::get('print-cash-report/{id}', [ReportController::class, 'printCashReport'])->name('print.reports');


});
