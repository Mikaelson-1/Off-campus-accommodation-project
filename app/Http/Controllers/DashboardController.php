<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Admin dashboard.
     */
    public function admin()
    {
        return view('dashboard.admin');
    }

    /**
     * Student dashboard.
     */
    public function student()
    {
        return view('dashboard.student');
    }

    /**
     * Landlord dashboard.
     */
    public function landlord()
    {
        return view('dashboard.landlord');
    }
}
