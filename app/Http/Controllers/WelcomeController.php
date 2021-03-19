<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Label;
use Illuminate\Contracts\View\View;

class WelcomeController extends Controller
{
    public function index(): View
    {
        return view('welcome', [
            'labels' => Label::whereEnabled(true)->get(),
        ]);
    }
}
