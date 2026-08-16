<script setup lang="ts">
import { usePage } from '@inertiajs/vue3';
import { computed } from 'vue';

const page = usePage();

const name = computed(() => page.props.name);

/** Derives the monogram from the site name, e.g. "Drew Redford" -> "DR". */
const initials = computed(() =>
    name.value
        .split(' ')
        .map((part) => part.charAt(0))
        .join('')
        .slice(0, 2)
        .toUpperCase(),
);
</script>

<template>
    <span class="flex items-center gap-2.5">
        <span
            class="grid size-7 shrink-0 place-items-center rounded-md bg-foreground text-[11px] font-bold tracking-tight text-background transition-transform duration-300 ease-out-quart group-hover:scale-105"
            aria-hidden="true"
        >
            {{ initials }}
        </span>
        <span class="text-sm font-semibold tracking-tight">{{ name }}</span>
    </span>
</template>
