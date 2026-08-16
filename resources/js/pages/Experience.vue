<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import ExperienceTimeline from '@/components/ExperienceTimeline.vue';
import Heading from '@/components/Heading.vue';
import PageHeader from '@/components/PageHeader.vue';
import { Badge } from '@/components/ui/badge';
import type { Position, SkillGroup } from '@/types';

defineProps<{
    skills: SkillGroup[];
    positions: Position[];
    otherPositions: Position[];
}>();
</script>

<template>
    <Head title="Experience" />

    <div class="shell pt-16 pb-4 sm:pt-20">
        <PageHeader
            title="Experience"
            description="Full-stack development, technical leadership, and the systems built along the way."
        />

        <section class="mt-16">
            <Heading title="Skills" />

            <div class="space-y-6">
                <!--
                  The category sits in a fixed left column from `sm` up so the
                  chip groups all start on the same vertical line.
                -->
                <div
                    v-for="(group, index) in skills"
                    :key="group.category"
                    v-reveal="index"
                    class="grid gap-2 sm:grid-cols-[9rem_1fr] sm:gap-6"
                >
                    <h3
                        class="text-xs font-medium tracking-[0.08em] text-muted-foreground uppercase sm:pt-1.5"
                    >
                        {{ group.category }}
                    </h3>

                    <ul class="flex flex-wrap gap-1.5">
                        <li v-for="item in group.items" :key="item">
                            <Badge variant="outline" class="px-2.5 py-1">
                                {{ item }}
                            </Badge>
                        </li>
                    </ul>
                </div>
            </div>
        </section>

        <section class="mt-20">
            <Heading title="Work History" />

            <ExperienceTimeline :positions="positions" />
        </section>

        <section class="mt-20">
            <Heading
                title="Other Experience"
                description="Earlier work in live events and broadcast production."
            />

            <ExperienceTimeline :positions="otherPositions" muted />
        </section>
    </div>
</template>
