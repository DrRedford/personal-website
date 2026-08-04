<script setup lang="ts">
import Timeline from '@/components/Timeline.vue';
import TimelineItem from '@/components/TimelineItem.vue';
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
    <Timeline>
        <TimelineItem
            v-for="(position, index) in positions"
            :key="position.company"
            :title="position.company"
            :meta="position.location"
            :index="index"
            :current="!muted && index === 0"
        >
            <div class="mt-1.5 space-y-1">
                <div
                    v-for="role in position.roles"
                    :key="role.title"
                    class="flex flex-wrap items-baseline justify-between gap-x-4 text-sm"
                >
                    <span class="font-medium">{{ role.title }}</span>
                    <span class="tabular text-muted-foreground">
                        {{ role.period }}
                    </span>
                </div>
            </div>

            <ul
                class="mt-4 space-y-2 text-sm leading-relaxed"
                :class="muted ? 'text-muted-foreground' : 'text-foreground/75'"
            >
                <li
                    v-for="highlight in position.highlights"
                    :key="highlight"
                    class="relative pl-4"
                >
                    <!--
                      A hairline dash rather than a disc bullet: it sits on the
                      same visual weight as the timeline rule instead of adding
                      a second, heavier bullet shape to the page.
                    -->
                    <span
                        aria-hidden="true"
                        class="absolute top-[0.6875rem] left-0 h-px w-2 bg-border"
                    />
                    {{ highlight }}
                </li>
            </ul>
        </TimelineItem>
    </Timeline>
</template>
