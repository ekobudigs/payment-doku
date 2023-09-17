<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Models\Administrator;
use App\Models\Customer;

class DashboardController extends Controller
{
    /**
     * Display cms dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function dashboard()
    {
        $data['title'] = 'Dashboard';
        $data['count'] = [
            'customers' => Customer::count(),
            'administrators' => Administrator::count(),
        ];

        return view('cms.dashboard', $data);
    }
}
