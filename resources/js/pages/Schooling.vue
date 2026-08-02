<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import EducationTimeline from '@/components/EducationTimeline.vue';
import Heading from '@/components/Heading.vue';
import type { Education } from '@/types';

defineProps<{
    education: Education[];
}>();
</script>

<template>
    <Head title="Schooling" />

    <h1 class="text-2xl font-semibold">Schooling</h1>

    <section class="mt-10">
        <Heading title="Education" />

        <EducationTimeline :education="education" />
    </section>
</template>
