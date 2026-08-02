<script setup lang="ts">
import type { Position } from '@/types';

type Props = {
    positions: Position[];
    muted?: boolean;
};

withDefaults(defineProps<Props>(), {
    muted: false,
});
</script>

<template>
    <ol class="relative space-y-8 border-l border-border">
        <li
            v-for="position in positions"
            :key="position.company"
            class="relative pl-6"
        >
            <span
                class="absolute top-1.5 -left-[5px] size-2.5 rounded-full bg-primary ring-4 ring-background"
            />

            <div class="flex flex-wrap items-baseline justify-between gap-x-3">
                <h3 class="font-semibold">{{ position.company }}</h3>
                <span class="text-sm text-muted-foreground">
                    {{ position.location }}
                </span>
            </div>

            <div class="mt-1 space-y-0.5">
                <div
                    v-for="role in position.roles"
                    :key="role.title"
                    class="flex flex-wrap items-baseline justify-between gap-x-3 text-sm"
                >
                    <span class="font-medium">{{ role.title }}</span>
                    <span class="text-muted-foreground">{{ role.period }}</span>
                </div>
            </div>

            <ul
                class="mt-3 list-disc space-y-1.5 pl-4 text-sm"
                :class="muted ? 'text-muted-foreground' : 'text-foreground/80'"
            >
                <li v-for="highlight in position.highlights" :key="highlight">
                    {{ highlight }}
                </li>
            </ul>
        </li>
    </ol>
</template>
