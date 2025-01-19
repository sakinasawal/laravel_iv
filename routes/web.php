<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MemberController;

Route::get('/', function () {
    return view('list');
});

Route::get('/', [MemberController::class, 'fetchAllData']);
Route::get('/members/filter', [MemberController::class, 'filterByDate']);
Route::get('/members/topPurchase', [MemberController::class, 'topMembersByPurchase']);
Route::get('/members/referral', [MemberController::class, 'getReferralCounts']);
Route::get('/members/purchaseReferral', [MemberController::class, 'getTotalPurchaseWithReferral']);
Route::get('/members/familyTree', [MemberController::class, 'showFamilyTree']);