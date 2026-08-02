export type SkillGroup = {
    category: string;
    items: string[];
};

export type Role = {
    title: string;
    period: string;
};

export type Position = {
    company: string;
    location: string;
    roles: Role[];
    highlights: string[];
};

export type Education = {
    institution: string;
    location: string;
    program: string;
    period: string;
};
