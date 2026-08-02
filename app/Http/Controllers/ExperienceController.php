<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Inertia\Response;

class ExperienceController extends Controller
{
    /**
     * Show the experience page.
     */
    public function __invoke(): Response
    {
        return Inertia::render('Experience', [
            'skills' => config('resume.skills'),
            'positions' => config('resume.experience'),
            'otherPositions' => config('resume.other_experience'),
        ]);
    }
}
