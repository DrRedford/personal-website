<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Inertia\Response;

class SchoolingController extends Controller
{
    /**
     * Show the schooling page.
     */
    public function __invoke(): Response
    {
        return Inertia::render('Schooling', [
            'education' => config('resume.education'),
        ]);
    }
}
