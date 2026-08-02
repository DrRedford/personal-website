<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import ExperienceTimeline from '@/components/ExperienceTimeline.vue';
import Heading from '@/components/Heading.vue';
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

    <h1 class="text-2xl font-semibold">Experience</h1>

    <section class="mt-10">
        <Heading title="Skills" />

        <div class="space-y-4">
            <div v-for="group in skills" :key="group.category">
                <h3
                    class="text-xs font-medium tracking-wide text-muted-foreground uppercase"
                >
                    {{ group.category }}
                </h3>
                <ul class="mt-2 flex flex-wrap gap-1.5">
                    <li v-for="item in group.items" :key="item">
                        <Badge variant="secondary">{{ item }}</Badge>
                    </li>
                </ul>
            </div>
        </div>
    </section>

    <section class="mt-12">
        <Heading title="Work History" />

        <ExperienceTimeline :positions="positions" />
    </section>

    <section class="mt-12">
        <Heading
            title="Other Experience"
            description="Earlier work in live events and broadcast production."
        />

        <ExperienceTimeline :positions="otherPositions" muted />
    </section>
</template>
