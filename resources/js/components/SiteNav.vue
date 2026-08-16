<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
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
    <ul class="flex items-center gap-1">
        <li v-for="item in navItems" :key="item.title">
            <Link
                :href="item.href"
                :aria-current="isCurrentUrl(item.href) ? 'page' : undefined"
                class="relative inline-flex items-center rounded-sm px-2.5 py-1.5 text-sm font-medium transition-colors duration-200 ease-out-quart"
                :class="
                    isCurrentUrl(item.href)
                        ? 'text-foreground'
                        : 'text-muted-foreground hover:text-foreground'
                "
            >
                {{ item.title }}

                <!--
                  The indicator is always rendered and scaled on the x-axis so
                  it wipes in from the left rather than popping into place.
                -->
                <span
                    aria-hidden="true"
                    class="absolute inset-x-2.5 -bottom-0.5 h-0.5 origin-left rounded-full bg-brand transition-transform duration-300 ease-out-expo"
                    :class="
                        isCurrentUrl(item.href) ? 'scale-x-100' : 'scale-x-0'
                    "
                />
            </Link>
        </li>
    </ul>
</template>
