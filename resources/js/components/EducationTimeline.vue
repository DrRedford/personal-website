<script setup lang="ts">
import type { Education } from '@/types';

defineProps<{
    education: Education[];
}>();
</script>

<template>
    <ol class="relative space-y-8 border-l border-border">
        <!-- Keyed on program, not institution: the same school appears twice. -->
        <li
            v-for="entry in education"
            :key="entry.program"
            class="relative pl-6"
        >
            <span
                class="absolute top-1.5 -left-[5px] size-2.5 rounded-full bg-primary ring-4 ring-background"
            />

            <div class="flex flex-wrap items-baseline justify-between gap-x-3">
                <h3 class="font-semibold">{{ entry.institution }}</h3>
                <span class="text-sm text-muted-foreground">
                    {{ entry.location }}
                </span>
            </div>

            <div
                class="mt-1 flex flex-wrap items-baseline justify-between gap-x-3 text-sm"
            >
                <span class="font-medium">{{ entry.program }}</span>
                <span class="text-muted-foreground">{{ entry.period }}</span>
            </div>
        </li>
    </ol>
</template>
