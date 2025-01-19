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
            ->limit(1)
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
        // Get the total purchase for each member (personal + referral)
        $totalPurchases = DB::table('tblMembers')
             ->leftJoin('tblPurchases as personal', 'tblMembers.MemberID', '=', 'personal.MemberID')  // Personal purchases
             ->leftJoin('tblMembers as referral_member', 'tblMembers.MemberID', '=', 'referral_member.ParentID')  // To get ParentID for referral
             ->leftJoin('tblPurchases as referral_purchase', 'referral_member.MemberID', '=', 'referral_purchase.MemberID') // Referred purchases
             ->select(
                'tblMembers.MemberID',
                'tblMembers.Name',
                'tblMembers.TelM', 
                DB::raw('SUM(CASE WHEN personal.MemberID IS NOT NULL THEN personal.Amount ELSE 0 END) as total_personal_purchase'),
                DB::raw('SUM(CASE WHEN referral_purchase.MemberID IS NOT NULL THEN referral_purchase.Amount ELSE 0 END) as total_referral_purchase'),
                DB::raw('SUM(CASE WHEN personal.MemberID IS NOT NULL THEN personal.Amount ELSE 0 END) + SUM(CASE WHEN referral_purchase.MemberID IS NOT NULL THEN referral_purchase.Amount ELSE 0 END) as total_group_purchase')
            )
            ->groupBy('tblMembers.MemberID', 'tblMembers.Name', 'tblMembers.TelM')  // Group by member information
            ->get();
        
        return view('members/purchaseReferral', compact('totalPurchases'));
    }

    public function showFamilyTree()
    {
    //     // Get the member and their referred members (children)
    //     $member = Member::with('referredMembers.purchases', 'purchases')
    //         ->findOrFail($memberId);  // You can pass member ID to dynamically get the data

    //     // Calculate the personal sales (individual purchases)
    //     $personalSales = $member->purchases->sum('Amount');

    //     // Calculate the group sales (personal + referred members' purchases)
    //     $groupSales = $personalSales;

    //     // Sum the purchases for referred members
    //     foreach ($member->referredMembers as $referredMember) {
    //         $groupSales += $referredMember->purchases->sum('Amount');
    //     }

    //     // Pass data to view
    //     return view('members/familyTree', compact('member', 'personalSales', 'groupSales'));
    }
    
}
