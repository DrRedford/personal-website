<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import EducationTimeline from '@/components/EducationTimeline.vue';
import Heading from '@/components/Heading.vue';
import PageHeader from '@/components/PageHeader.vue';
import type { Education } from '@/types';

defineProps<{
    education: Education[];
}>();
</script>

<template>
    <Head title="Schooling" />

    <div class="shell pt-16 pb-4 sm:pt-20">
        <PageHeader
            title="Schooling"
            description="Where the technical foundation was built, most recent first."
        />

        <section class="mt-16">
            <Heading title="Education" />

            <EducationTimeline :education="education" />
        </section>
    </div>
</template>
