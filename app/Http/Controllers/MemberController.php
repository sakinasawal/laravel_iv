<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Purchase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MemberController extends Controller
{
    public function fetchAllData()
    {
        $members = Member::all();
        $purchases = Purchase::all();

        return view('list', compact('members', 'purchases'));
    }

    public function filterByDate(){
        $startDate = '2024-01-01';
        $endDate = '2024-03-31';

        $members = Member::whereBetween('DateJoin', [$startDate, $endDate])
        ->select('MemberID', 'Name', 'DateJoin', 'TelM')
        ->get();

        return view('members/filter', compact('members'));
    }

    public function topMembersByPurchase()
    {
        $topMembers = DB::table('tblPurchases')
            ->join('tblMembers', 'tblPurchases.MemberID', '=', 'tblMembers.MemberID')
            ->whereBetween('tblPurchases.SalesDate', ['2024-03-01', '2024-03-31']) 
            ->select('tblMembers.MemberID', 'tblMembers.Name', DB::raw('SUM(tblPurchases.Amount) as total_purchase'))
            ->groupBy('tblMembers.MemberID', 'tblMembers.Name')
            ->orderByDesc('total_purchase')
            ->limit(10)
            ->get();

        return view('members/topPurchase', compact('topMembers'));
    }

    public function getReferralCounts()
    {
        $referralCounts = DB::table('tblMembers as parent') 
            ->leftJoin('tblMembers as child', 'parent.MemberID', '=', 'child.ParentID') 
            ->select('parent.MemberID', 'parent.Name', DB::raw('COUNT(child.MemberID) as referred_count'))
            ->groupBy('parent.MemberID', 'parent.Name') 
            ->get();

        return view('members/referral', compact('referralCounts'));
    }

    public function getTotalPurchaseWithReferral()
    {
        $personalPurchases = DB::table('tblPurchases')
        ->select('MemberID', DB::raw('SUM(Amount) as total_personal_purchase'))
        ->groupBy('MemberID');

        $referralPurchases = DB::table('tblPurchases')
        ->join('tblMembers', 'tblPurchases.MemberID', '=', 'tblMembers.MemberID') // To get ParentID
        ->select('tblMembers.ParentID', DB::raw('SUM(tblPurchases.Amount) as total_referral_purchase'))
        ->groupBy('tblMembers.ParentID');

        $totalPurchases = DB::table('tblMembers')
        ->leftJoinSub($personalPurchases, 'personal', 'tblMembers.MemberID', '=', 'personal.MemberID')
        ->leftJoinSub($referralPurchases, 'referral', 'tblMembers.MemberID', '=', 'referral.ParentID')
        ->select(
            'tblMembers.MemberID',
            'tblMembers.Name',
            'tblMembers.TelM',
            DB::raw('IFNULL(personal.total_personal_purchase, 0) as total_personal_purchase'),
            DB::raw('IFNULL(referral.total_referral_purchase, 0) as total_referral_purchase'),
            DB::raw('IFNULL(personal.total_personal_purchase, 0) + IFNULL(referral.total_referral_purchase, 0) as total_group_purchase')
        )
        ->get();

        // Get the total purchase for each member (personal + referral)
        // $totalPurchases = DB::table('tblMembers')
        //      ->leftJoin('tblPurchases as personal', 'tblMembers.MemberID', '=', 'personal.MemberID')  // Personal purchases
        //      ->leftJoin('tblMembers as referrals', 'tblMembers.MemberID', '=', 'referrals.ParentID')  // Referral members
        //      ->leftJoin('tblPurchases as referral_purchase', 'referrals.MemberID', '=', 'referral_purchase.MemberID') // Referral purchases
        //      ->select(
        //         'tblMembers.MemberID',
        //         'tblMembers.Name',
        //         'tblMembers.TelM', 
        //         DB::raw('SUM(personal.Amount) as total_personal_purchase'),
        //         DB::raw('SUM(referral_purchase.Amount) as total_referral_purchase'),
        //         DB::raw('SUM(personal.Amount) + SUM(referral_purchase.Amount) as total_group_purchase')
        //     )
        //     ->groupBy('tblMembers.MemberID', 'tblMembers.Name', 'tblMembers.TelM')
        //     ->get();
        
        return view('members/purchaseReferral', compact('totalPurchases'));
    }

}
