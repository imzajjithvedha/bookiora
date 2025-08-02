<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\User;
use App\Models\Warehouse;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $current_month = Carbon::now()->month;
        $current_year = Carbon::now()->year;
        $last_year = Carbon::now()->subYear();
        $last_month_date = Carbon::now()->subMonth();
        $last_month = $last_month_date->month;
        $last_month_year = $last_month_date->year;
        $months = range(1, 12);

        // Total customers
            $total_customers = User::where('role', 'customer')->count();

            $this_month_customers = User::where('role', 'customer')
                ->whereMonth('created_at', $current_month)
                ->whereYear('created_at', $current_year)
                ->count();

            $last_month_customers = User::where('role', 'customer')
                ->whereMonth('created_at', $last_month)
                ->whereYear('created_at', $last_month_year)
                ->count();

            if($last_month_customers == 0) {
                if($this_month_customers > 0) {
                    $customer_month_percentage = '<span class="green"><i class="bi bi-graph-up-arrow"></i>100.0%</span>up from last month</p>';
                }
                else {
                    $customer_month_percentage = '<span class="green"><i class="bi bi-graph-up-arrow"></i>0.0%</span>up from last month</p>';
                }
            }
            else {
                $change = (($this_month_customers - $last_month_customers) / $last_month_customers) * 100;

                if($change >= 0) {
                    $temp1 = '<span class="green"><i class="bi bi-graph-up-arrow"></i>';
                    $temp2 = '</span>up from last month</p>';
                }
                else {
                    $temp1 = '<span class="red"><i class="bi bi-graph-down-arrow"></i>';
                    $temp2 = '</span>down from last month</p>';
                }

                $customer_month_percentage = $temp1 . number_format($change, 1) . $temp2;
            }
        // Total customers

        // Total partners
            $total_partners = User::where('role', 'partner')->count();

            $this_month_partners = User::where('role', 'partner')
                ->whereMonth('created_at', $current_month)
                ->whereYear('created_at', $current_year)
                ->count();

            $last_month_partners = User::where('role', 'partner')
                ->whereMonth('created_at', $last_month)
                ->whereYear('created_at', $last_month_year)
                ->count();

            if($last_month_partners == 0) {
                if($this_month_partners > 0) {
                    $partner_month_percentage = '<span class="green"><i class="bi bi-graph-up-arrow"></i>100.0%</span>up from last month</p>';
                }
                else {
                    $partner_month_percentage = '<span class="green"><i class="bi bi-graph-up-arrow"></i>0.0%</span>up from last month</p>';
                }
            }
            else {
                $change = (($this_month_partners - $last_month_partners) / $last_month_partners) * 100;

                if($change >= 0) {
                    $temp1 = '<span class="green"><i class="bi bi-graph-up-arrow"></i>';
                    $temp2 = '</span>up from last month</p>';
                }
                else {
                    $temp1 = '<span class="red"><i class="bi bi-graph-down-arrow"></i>';
                    $temp2 = '</span>down from last month</p>';
                }

                $partner_month_percentage = $temp1 . number_format($change, 1) . $temp2;
            }
        // Total partners

        // Total stays
            $total_stays = Warehouse::count();

            $this_month_stays = Warehouse::whereMonth('created_at', $current_month)
                ->whereYear('created_at', $current_year)
                ->count();

            $last_month_stays = Warehouse::whereMonth('created_at', $last_month)
                ->whereYear('created_at', $last_month_year)
                ->count();

            if($last_month_stays == 0) {
                if($this_month_stays > 0) {
                    $stay_month_percentage = '<span class="green"><i class="bi bi-graph-up-arrow"></i>100.0%</span>up from last month</p>';
                }
                else {
                    $stay_month_percentage = '<span class="green"><i class="bi bi-graph-up-arrow"></i>0.0%</span>up from last month</p>';
                }
            }
            else {
                $change = (($this_month_stays - $last_month_stays) / $last_month_stays) * 100;

                if($change >= 0) {
                    $temp1 = '<span class="green"><i class="bi bi-graph-up-arrow"></i>';
                    $temp2 = '</span>up from last month</p>';
                }
                else {
                    $temp1 = '<span class="red"><i class="bi bi-graph-down-arrow"></i>';
                    $temp2 = '</span>down from last month</p>';
                }

                $stay_month_percentage = $temp1 . number_format($change, 1) . $temp2;
            }
        // Total stays

        // Total income
            $total_income = Booking::where('status', 1)->sum('total_rent');

            $this_month_income = Booking::where('status', 1)
                ->whereMonth('created_at', $current_month)
                ->whereYear('created_at', $current_year)
                ->sum('total_rent');

            $last_month_income = Booking::where('status', 1)
                ->whereMonth('created_at', $last_month)
                ->whereYear('created_at', $last_month_year)
                ->sum('total_rent');

            if($last_month_income == 0) {
                if($this_month_income > 0) {
                    $income_month_percentage = '<span class="green"><i class="bi bi-graph-up-arrow"></i>100.0%</span>up from last month</p>';
                }
                else {
                    $income_month_percentage = '<span class="green"><i class="bi bi-graph-up-arrow"></i>0.0%</span>up from last month</p>';
                }
            }
            else {
                $change = (($this_month_income - $last_month_income) / $last_month_income) * 100;

                if($change >= 0) {
                    $temp1 = '<span class="green"><i class="bi bi-graph-up-arrow"></i>';
                    $temp2 = '</span>up from last month</p>';
                }
                else {
                    $temp1 = '<span class="red"><i class="bi bi-graph-down-arrow"></i>';
                    $temp2 = '</span>down from last month</p>';
                }

                $income_month_percentage = $temp1 . number_format($change, 1) . $temp2;
            }
        // Total income

        // Revenue chart
            $current_year_income = Booking::selectRaw('MONTH(created_at) as month, SUM(total_rent) as total')
            ->where('status', 1)
            ->whereYear('created_at', $current_year)
            ->groupBy('month')
            ->pluck('total', 'month');

            $last_year_income = Booking::selectRaw('MONTH(created_at) as month, SUM(total_rent) as total')
            ->where('status', 1)
            ->whereYear('created_at', $last_year)
            ->groupBy('month')
            ->pluck('total', 'month');

            $current_year_income_data = [];
            $last_year_income_data = [];

            foreach($months as $month) {
                $current_year_income_data[] = $current_year_income[$month] ?? 0;
                $last_year_income_data[] = $last_year_income[$month] ?? 0;
            }
        // Revenue chart
        
        // Users chart
            $current_year_users = User::selectRaw('MONTH(created_at) as month, COUNT(id) as user_count')
            ->where('role', '!=', 'admin')
            ->whereYear('created_at', $current_year)
            ->groupBy('month')
            ->pluck('user_count', 'month');

            $last_year_users = User::selectRaw('MONTH(created_at) as month, COUNT(id) as user_count')
            ->where('role', '!=', 'admin')
            ->whereYear('created_at', $last_year)
            ->groupBy('month')
            ->pluck('user_count', 'month');

            $this_month_users = User::where('role', '!=', 'admin')
                ->whereMonth('created_at', $current_month)
                ->whereYear('created_at', $current_year)
                ->count();

            $last_month_users = User::where('role', '!=', 'admin')
                ->whereMonth('created_at', $last_month)
                ->whereYear('created_at', $last_month_year)
                ->count();

            if($last_month_users == 0) {
                if($this_month_users > 0) {
                    $user_month_percentage = '<span class="green"><i class="bi bi-graph-up-arrow"></i>100.0%</span>up from last month</p>';
                }
                else {
                    $user_month_percentage = '<span class="green"><i class="bi bi-graph-up-arrow"></i>0.0%</span>up from last month</p>';
                }
            }
            else {
                $change = (($this_month_users - $last_month_users) / $last_month_users) * 100;

                if($change >= 0) {
                    $temp1 = '<span class="green"><i class="bi bi-graph-up-arrow"></i>';
                    $temp2 = '</span>up from last month</p>';
                }
                else {
                    $temp1 = '<span class="red"><i class="bi bi-graph-down-arrow"></i>';
                    $temp2 = '</span>down from last month</p>';
                }

                $user_month_percentage = $temp1 . number_format($change, 1) . $temp2;
            }

            $current_year_user_data = [];
            $last_year_user_data = [];

            foreach($months as $month) {
                $current_year_user_data[] = $current_year_users[$month] ?? 0;
                $last_year_user_data[] = $last_year_users[$month] ?? 0;
            }
        // Users chart

        // Bookings chart
            $current_year_bookings = Booking::selectRaw('MONTH(created_at) as month, COUNT(id) as total')
            ->where('status', 1)
            ->whereYear('created_at', $current_year)
            ->groupBy('month')
            ->pluck('total', 'month');

            $last_year_bookings = Booking::selectRaw('MONTH(created_at) as month, COUNT(id) as total')
            ->where('status', 1)
            ->whereYear('created_at', $last_year)
            ->groupBy('month')
            ->pluck('total', 'month');

            $this_month_bookings = Booking::where('status', 1)
                ->whereMonth('created_at', $current_month)
                ->whereYear('created_at', $current_year)
                ->count();

            $last_month_bookings = Booking::where('status', 1)
                ->whereMonth('created_at', $last_month)
                ->whereYear('created_at', $last_month_year)
                ->count();

            if($last_month_bookings == 0) {
                if($this_month_bookings > 0) {
                    $booking_month_percentage = '<span class="green"><i class="bi bi-graph-up-arrow"></i>100.0%</span>up from last month</p>';
                }
                else {
                    $booking_month_percentage = '<span class="green"><i class="bi bi-graph-up-arrow"></i>0.0%</span>up from last month</p>';
                }
            }
            else {
                $change = (($this_month_bookings - $last_month_bookings) / $last_month_bookings) * 100;

                if($change >= 0) {
                    $temp1 = '<span class="green"><i class="bi bi-graph-up-arrow"></i>';
                    $temp2 = '</span>up from last month</p>';
                }
                else {
                    $temp1 = '<span class="red"><i class="bi bi-graph-down-arrow"></i>';
                    $temp2 = '</span>down from last month</p>';
                }

                $booking_month_percentage = $temp1 . number_format($change, 1) . $temp2;
            }

            $current_year_booking_data = [];
            $last_year_booking_data = [];

            foreach($months as $month) {
                $current_year_booking_data[] = $current_year_bookings[$month] ?? 0;
                $last_year_booking_data[] = $last_year_bookings[$month] ?? 0;
            }
        // Bookings chart

        return view('admin.dashboard', [
            'total_customers' => $total_customers,
            'customer_month_percentage' => $customer_month_percentage,

            'total_partners' => $total_partners,
            'partner_month_percentage' => $partner_month_percentage,

            'total_stays' => $total_stays,
            'stay_month_percentage' => $stay_month_percentage,

            'total_income' => $total_income,
            'income_month_percentage' => $income_month_percentage,

            'months' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],

            'current_year_income_data' => $current_year_income_data,
            'last_year_income_data' => $last_year_income_data,

            'current_year_user_data' => $current_year_user_data,
            'last_year_user_data' => $last_year_user_data,
            'user_month_percentage' => $user_month_percentage,

            'current_year_booking_data' => $current_year_booking_data,
            'last_year_booking_data' => $last_year_booking_data,
            'booking_month_percentage' => $booking_month_percentage
        ]);
    }
}