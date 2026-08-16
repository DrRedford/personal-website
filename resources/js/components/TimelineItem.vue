<script setup lang="ts">
type Props = {
    /** Primary label for the entry, e.g. an employer or an institution. */
    title: string;
    /** Secondary label shown opposite the title, e.g. a location. */
    meta?: string;
    /** Position in the list, used to stagger the reveal. */
    index?: number;
    /**
     * Marks the entry as the current one. Only the accent node differs, so a
     * timeline never has more than one point of colour.
     */
    current?: boolean;
};

withDefaults(defineProps<Props>(), {
    index: 0,
    current: false,
});
</script>

<template>
    <li v-reveal="index" class="relative pl-7">
        <span
            aria-hidden="true"
            class="absolute top-2 -left-[4.5px] size-2 rounded-full ring-4 ring-background transition-colors"
            :class="current ? 'bg-brand' : 'bg-foreground/25'"
        />

        <div class="flex flex-wrap items-baseline justify-between gap-x-4">
            <h3 class="text-base font-semibold tracking-tight">
                {{ title }}
            </h3>
            <span v-if="meta" class="text-sm text-muted-foreground">
                {{ meta }}
            </span>
        </div>

        <slot />
    </li>
</template>
