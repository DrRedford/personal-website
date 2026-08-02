<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Inertia\Response;

class HomeController extends Controller
{
    /**
     * Show the home page.
     */
    public function __invoke(): Response
    {
        return Inertia::render('Welcome', [
            'summary' => config('resume.summary'),
            'location' => config('resume.contact.location'),
            'currentRole' => $this->currentRole(),
            'resumeUrl' => asset(config('resume.pdf')),
        ]);
    }

    /**
     * The most recent role, derived from the resume so the headline never
     * drifts out of sync with the experience page.
     *
     * @return array{title: string, company: string}|null
     */
    private function currentRole(): ?array
    {
        $position = config('resume.experience')[0] ?? null;

        if ($position === null) {
            return null;
        }

        return [
            'title' => $position['roles'][0]['title'],
            'company' => $position['company'],
        ];
    }
}
