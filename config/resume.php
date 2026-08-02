<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Resume Content
    |--------------------------------------------------------------------------
    |
    | The content of the site's resume pages, kept here so it can be edited in
    | one place without touching any markup. Mirrors the structure of the
    | resume.md file at the project root.
    |
    */

    'contact' => [
        'location' => 'Beamsville, Ontario',
        'phone' => '289.219.0567',
        'email' => 'drewjredford@gmail.com',
    ],

    /**
     * Path to the downloadable resume, relative to the public directory.
     */
    'pdf' => 'resume/drew-redford-resume.pdf',

    'summary' => 'Highly motivated and results-oriented software professional with a proven track record in full-stack development, technical leadership, and process optimization. Adept at transforming support operations, enhancing team efficiency, and delivering impactful technical solutions for complex business challenges. Seeking to leverage advanced development, and a problem-solving mindset to drive significant value in a challenging role.',

    'skills' => [
        [
            'category' => 'Programming & Scripting',
            'items' => ['PHP', 'Laravel', 'Vue', 'Zoho Deluge', 'JavaScript', 'Python', 'Java', '.NET', 'C#'],
        ],
        [
            'category' => 'Web Technologies',
            'items' => ['HTML', 'CSS', 'Bootstrap'],
        ],
        [
            'category' => 'Database',
            'items' => ['SQL', 'Zoho proprietary SQL', 'Complex querying'],
        ],
        [
            'category' => 'APIs & Integrations',
            'items' => ['REST API', 'Zoho', 'Zoom', 'FreshByte', 'Slybroadcast', 'Custom APIs'],
        ],
        [
            'category' => 'Cloud Platforms',
            'items' => ['AWS Fargate', 'Docker'],
        ],
        [
            'category' => 'Soft Skills',
            'items' => ['Leadership', 'Team Management', 'Mentoring', 'Process Improvement', 'Problem Solving', 'Client Relationship Management', 'Solution Architecture', 'Adaptability', 'Communication'],
        ],
    ],

    'experience' => [
        [
            'company' => 'Vehikl',
            'location' => 'Waterloo',
            'roles' => [
                ['title' => 'Software Developer', 'period' => 'June 2026 – Present'],
            ],
            'highlights' => [
                'Develop and maintain features for client web applications in Laravel and PHP, working within an established codebase and delivery process from ticket through to production.',
                "Practice test-driven development and daily pairing/mobbing alongside senior developers, writing tests ahead of implementation and participating in code review to meet the team's clean-code standards.",
                "Embed with the client's engineering team as an extension of their staff, joining planning and standups to scope requirements into deliverable technical work.",
            ],
        ],
        [
            'company' => 'Hero Technical Solutions',
            'location' => 'Remote',
            'roles' => [
                ['title' => 'Senior Developer & Customer Support Lead', 'period' => 'September 2023 – June 2026'],
                ['title' => 'Developer', 'period' => '2022 – September 2023'],
                ['title' => 'Co-op Student', 'period' => '2022'],
            ],
            'highlights' => [
                'Promoted to Senior Developer and Customer Support Lead, leading a ten person team and overseeing critical support operations for diverse clients.',
                'Transformed support ticket management, significantly reducing reply times and improving SLA adherence by implementing proactive monitoring and developer accountability measures.',
                'Successfully reduced the backlog of open tickets, improving overall client satisfaction and operational efficiency.',
                'Mentored and guided new co-op students from onboarding to independent task completion, resulting in one student winning the Provincial Co-op Student of the Year award. Provided focused troubleshooting assistance and code review for junior developers.',
                "Spearheaded development initiatives using Zoho's Deluge, Javascript/HTML/CSS and Python to create and enhance custom applications.",
                'Led client meetings to gather requirements, scope solutions, and present technical implementations, significantly improving user experience and reporting capabilities.',
                'Implemented numerous integrations between Zoho and third-party systems (e.g., invoicing, quoting, project stages, meetings, data collection), streamlining critical business processes.',
            ],
        ],
    ],

    'other_experience' => [
        [
            'company' => 'Maple Leaf Sports & Entertainment',
            'location' => 'Toronto, ON',
            'roles' => [
                ['title' => 'Technician', 'period' => '2019 – 2020'],
                ['title' => 'Internship', 'period' => '2018'],
            ],
            'highlights' => [
                'Managed the setup, strike (take down), maintenance, and repair of in-house presentation equipment for major sporting events (Raptors, Leafs, Rock) and concerts.',
                'Gained hands-on experience with venue technology, including EVS machines for live sports broadcasts.',
            ],
        ],
        [
            'company' => 'Freelance',
            'location' => 'Ontario',
            'roles' => [
                ['title' => 'Various Roles (Utility, Camera Work, Junior Tech, Switcher Operator)', 'period' => '2018 – 2020'],
            ],
            'highlights' => [
                'Contributed to various productions, including live events, television broadcasts, and concerts, demonstrating adaptability and diverse technical skills.',
            ],
        ],
    ],

    'projects' => [
        [
            'title' => 'Custom Speed-Dating Algorithm Development',
            'description' => "Designed and implemented a complex Python-based algorithm for a client's multi-industry \"speed dating\" platform. Solution dynamically prioritized company rankings, prevented duplicate meetings, allowed for variable table allocations, and optimized meeting scheduling within tight timeframes.",
        ],
        [
            'title' => 'Machine Learning (ML) Margin Optimization & Cloud Deployment',
            'description' => "Developed a Neural Network component for a client's ML project aimed at optimizing project margins by predicting win probabilities. Deployed the solution on AWS Fargate.",
        ],
        [
            'title' => 'Third-Party API Integration & Solution Design',
            'description' => 'Consistently delivered solutions involving poorly documented and unique third-party APIs (e.g., Hivebrite, JobTread, Zoom), often requiring independent problem-solving and custom solution design to achieve client requirements.',
        ],
    ],

    'education' => [
        [
            'institution' => 'Mohawk College',
            'location' => 'Hamilton, ON',
            'program' => 'Computer Systems Technician, Software Support',
            'period' => '2021 – 2023',
        ],
        [
            'institution' => 'Mohawk College',
            'location' => 'Hamilton, ON',
            'program' => 'Broadcasting, Television and Communications Media, Diploma',
            'period' => '2016 – 2019',
        ],
    ],

];
