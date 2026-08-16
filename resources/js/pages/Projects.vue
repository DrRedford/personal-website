<script setup lang="ts">
import { Head, Link, usePage } from '@inertiajs/vue3';
import { ArrowRight, FolderOpen, Mail } from '@lucide/vue';
import { computed } from 'vue';
import PageHeader from '@/components/PageHeader.vue';
import { Button } from '@/components/ui/button';
import { experience } from '@/routes';

const page = usePage();

const contact = computed(() => page.props.contact);
</script>

<template>
    <Head title="Projects" />

    <div class="shell pt-16 pb-4 sm:pt-20">
        <PageHeader
            title="Projects"
            description="Selected work, written up properly rather than listed in a hurry."
        />

        <!--
          An empty state that still offers a route forward. A dead end here
          would undo the rest of the site, so it points at the two things a
          visitor would want next.
        -->
        <section
            v-reveal
            class="mt-16 rounded-2xl border border-border bg-card px-6 py-14 text-center"
        >
            <span
                class="mx-auto grid size-11 place-items-center rounded-xl border border-border bg-muted/60"
                aria-hidden="true"
            >
                <FolderOpen class="size-5 text-muted-foreground" />
            </span>

            <h2 class="mt-5 text-lg font-semibold tracking-tight">
                Write-ups in progress
            </h2>

            <p
                class="mx-auto mt-2 max-w-sm text-sm leading-relaxed text-muted-foreground"
            >
                I would rather publish a handful of case studies worth reading
                than a wall of repository links. In the meantime, the work
                itself is on the experience page.
            </p>

            <div class="mt-7 flex flex-wrap items-center justify-center gap-3">
                <Button as-child>
                    <Link :href="experience()">
                        View my experience
                        <ArrowRight />
                    </Link>
                </Button>

                <Button as-child variant="outline">
                    <a :href="`mailto:${contact.email}`">
                        Get in touch
                        <Mail />
                    </a>
                </Button>
            </div>
        </section>
    </div>
</template>
