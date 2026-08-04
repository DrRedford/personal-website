<script setup lang="ts">
type Props = {
    title: string;
    description?: string;
};

defineProps<Props>();
</script>

<template>
    <header class="mb-8">
        <div class="flex items-center gap-3">
            <!--
              The accent rule is the only place colour appears in a section
              header. It marks where a section starts without the heading
              itself having to compete with the page title for weight.
            -->
            <span aria-hidden="true" class="h-px w-6 flex-none bg-brand" />
            <h2
                class="text-xs font-semibold tracking-[0.14em] text-muted-foreground uppercase"
            >
                {{ title }}
            </h2>
        </div>

        <p v-if="description" class="mt-3 text-sm text-muted-foreground">
            {{ description }}
        </p>
    </header>
</template>
