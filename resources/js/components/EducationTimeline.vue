<script setup lang="ts">
import Timeline from '@/components/Timeline.vue';
import TimelineItem from '@/components/TimelineItem.vue';
import type { Education } from '@/types';

defineProps<{
    education: Education[];
}>();
</script>

<template>
    <Timeline>
        <!-- Keyed on program, not institution: the same school appears twice. -->
        <TimelineItem
            v-for="(entry, index) in education"
            :key="entry.program"
            :title="entry.institution"
            :meta="entry.location"
            :index="index"
        >
            <div
                class="mt-1.5 flex flex-wrap items-baseline justify-between gap-x-4 text-sm"
            >
                <span class="font-medium">{{ entry.program }}</span>
                <span class="tabular text-muted-foreground">
                    {{ entry.period }}
                </span>
            </div>
        </TimelineItem>
    </Timeline>
</template>
