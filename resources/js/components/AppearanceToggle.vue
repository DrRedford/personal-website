<script setup lang="ts">
import { Monitor, Moon, Sun } from '@lucide/vue';
import type { Component } from 'vue';
import { computed } from 'vue';
import { useAppearance } from '@/composables/useAppearance';
import type { Appearance } from '@/types';

const { appearance, updateAppearance } = useAppearance();

type AppearanceOption = {
    value: Appearance;
    label: string;
    icon: Component;
};

const options: AppearanceOption[] = [
    { value: 'light', label: 'Light', icon: Sun },
    { value: 'dark', label: 'Dark', icon: Moon },
    { value: 'system', label: 'System', icon: Monitor },
];

const activeIndex = computed(() =>
    Math.max(
        0,
        options.findIndex((option) => option.value === appearance.value),
    ),
);

/*
 * A single indicator slides between the three slots rather than each button
 * fading its own background in and out, so the control reads as one object
 * moving instead of three states blinking.
 */
const indicatorStyle = computed(() => ({
    width: `calc((100% - 0.25rem) / ${options.length})`,
    transform: `translateX(${activeIndex.value * 100}%)`,
}));
</script>

<template>
    <div
        class="relative inline-flex items-center rounded-full border border-border bg-muted/60 p-0.5"
    >
        <span
            aria-hidden="true"
            class="absolute inset-y-0.5 left-0.5 rounded-full bg-background shadow-sm ring-1 ring-border/60 transition-transform duration-300 ease-out-expo"
            :style="indicatorStyle"
        />

        <button
            v-for="option in options"
            :key="option.value"
            type="button"
            :aria-label="`${option.label} theme`"
            :aria-pressed="appearance === option.value"
            class="relative z-10 grid size-7 place-items-center rounded-full transition-colors duration-200 ease-out-quart"
            :class="
                appearance === option.value
                    ? 'text-foreground'
                    : 'text-muted-foreground hover:text-foreground'
            "
            @click="updateAppearance(option.value)"
        >
            <component :is="option.icon" class="size-3.5" />
        </button>
    </div>
</template>
