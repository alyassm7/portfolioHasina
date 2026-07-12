<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Education;
use App\Models\Experience;
use App\Models\Message;
use App\Models\Project;
use App\Models\Setting;
use App\Models\Skill;
use App\Models\Testimonial;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        return view('admin.dashboard', [
            'siteName' => Setting::get('site_name', 'Portfolio'),
            'stats' => [
                'projects' => Project::count(),
                'skills' => Skill::count(),
                'experiences' => Experience::count(),
                'educations' => Education::count(),
                'testimonials' => Testimonial::count(),
                'messages_unread' => Message::where('is_read', false)->count(),
                'messages_total' => Message::count(),
            ],
            'recentMessages' => Message::latest()->limit(5)->get(),
        ]);
    }
}
