<script setup lang="ts">
type Props = {
    title: string;
    description?: string;
};

defineProps<Props>();
</script>

<template>
    <header v-reveal class="border-b border-border pb-10">
        <h1 class="text-4xl font-semibold tracking-[-0.02em] sm:text-5xl">
            {{ title }}
        </h1>

        <p
            v-if="description"
            class="mt-4 max-w-xl text-base leading-relaxed text-muted-foreground sm:text-lg"
        >
            {{ description }}
        </p>
    </header>
</template>
