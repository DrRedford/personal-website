<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import AppLogo from '@/components/AppLogo.vue';
import { useCurrentUrl } from '@/composables/useCurrentUrl';
import { experience, home, projects, schooling } from '@/routes';
import type { NavItem } from '@/types';

const { isCurrentUrl } = useCurrentUrl();

const navItems: NavItem[] = [
    { title: 'Home', href: home() },
    { title: 'Experience', href: experience() },
    { title: 'Schooling', href: schooling() },
    { title: 'Projects', href: projects() },
];
</script>

<template>
    <div class="min-h-screen bg-background text-foreground">
        <header class="border-b border-border">
            <nav
                class="mx-auto flex max-w-4xl flex-wrap items-center justify-between gap-4 p-4"
            >
                <Link :href="home()" class="flex items-center gap-2">
                    <AppLogo />
                </Link>

                <ul class="flex flex-wrap items-center gap-1">
                    <li v-for="item in navItems" :key="item.title">
                        <Link
                            :href="item.href"
                            class="rounded-md px-3 py-1.5 text-sm font-medium text-muted-foreground hover:bg-accent hover:text-accent-foreground"
                            :class="{
                                'bg-accent text-accent-foreground':
                                    isCurrentUrl(item.href),
                            }"
                        >
                            {{ item.title }}
                        </Link>
                    </li>
                </ul>
            </nav>
        </header>

        <main class="mx-auto max-w-4xl p-6">
            <slot />
        </main>
    </div>
</template>
