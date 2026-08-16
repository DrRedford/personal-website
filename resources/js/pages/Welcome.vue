<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import { ArrowRight, Download, FileText, MapPin } from '@lucide/vue';
import { computed } from 'vue';
import { Button } from '@/components/ui/button';
import {
    Dialog,
    DialogContent,
    DialogDescription,
    DialogHeader,
    DialogTitle,
    DialogTrigger,
} from '@/components/ui/dialog';
import { experience } from '@/routes';

const props = defineProps<{
    summary: string;
    location: string;
    currentRole: { title: string; company: string } | null;
    resumeUrl: string;
}>();

/**
 * Chromium reads these PDF viewer parameters from the URL fragment and hides
 * its own toolbar, so the preview shows just the document. Firefox and Safari
 * ignore them and keep their built-in controls.
 */
const previewUrl = computed(
    () => `${props.resumeUrl}#toolbar=0&navpanes=0&scrollbar=0&view=FitH`,
);
</script>

<template>
    <Head title="Home" />

    <div class="relative isolate">
        <!--
          The grid is masked to fade out, so it reads as depth behind the
          headline rather than as a texture applied to the whole site. It
          starts above the page so it runs behind the transparent header
          instead of beginning at a visible seam underneath it.
        -->
        <div
            aria-hidden="true"
            class="bg-grid pointer-events-none absolute inset-x-0 -top-24 -z-10 h-[30rem]"
        />

        <section class="shell pt-16 pb-4 sm:pt-24">
            <div
                v-if="currentRole"
                v-reveal
                class="inline-flex items-center gap-2 rounded-full border border-border bg-card px-3 py-1 text-xs font-medium shadow-sm"
            >
                <span class="relative flex size-1.5" aria-hidden="true">
                    <span
                        class="absolute inline-flex size-full animate-ping rounded-full bg-brand opacity-75"
                    />
                    <span
                        class="relative inline-flex size-1.5 rounded-full bg-brand"
                    />
                </span>
                {{ currentRole.title }}
                <span class="text-muted-foreground">at</span>
                {{ currentRole.company }}
            </div>

            <h1
                v-reveal="1"
                class="mt-6 text-5xl font-semibold tracking-[-0.03em] sm:text-6xl"
            >
                Drew Redford
            </h1>

            <p
                v-reveal="2"
                class="mt-4 flex items-center gap-1.5 text-sm text-muted-foreground"
            >
                <MapPin class="size-4 flex-none" aria-hidden="true" />
                {{ location }}
            </p>

            <p
                v-reveal="3"
                class="mt-8 max-w-2xl text-base leading-relaxed text-foreground/75 sm:text-lg sm:leading-relaxed"
            >
                {{ summary }}
            </p>

            <div v-reveal="4" class="mt-10 flex flex-wrap items-center gap-3">
                <Dialog>
                    <DialogTrigger as-child>
                        <Button size="lg">
                            View resume
                            <FileText />
                        </Button>
                    </DialogTrigger>

                    <DialogContent
                        class="grid-rows-[auto_minmax(0,1fr)] gap-0 p-0 sm:max-w-4xl"
                    >
                        <DialogHeader class="border-b border-border p-4 pr-12">
                            <DialogTitle class="text-base">Resume</DialogTitle>
                            <DialogDescription class="sr-only">
                                A preview of Drew Redford's resume.
                            </DialogDescription>
                        </DialogHeader>

                        <div class="h-[75vh]">
                            <iframe
                                :src="previewUrl"
                                title="Drew Redford resume"
                                class="hidden size-full rounded-b-lg sm:block"
                            />

                            <div
                                class="flex size-full flex-col items-center justify-center gap-4 p-6 text-center sm:hidden"
                            >
                                <p class="text-sm text-muted-foreground">
                                    Previews are not supported on small screens.
                                </p>
                                <Button as-child variant="outline">
                                    <a :href="resumeUrl" download>
                                        Download resume
                                        <Download />
                                    </a>
                                </Button>
                            </div>
                        </div>
                    </DialogContent>
                </Dialog>

                <Button as-child variant="outline" size="lg">
                    <a :href="resumeUrl" download>
                        Download resume
                        <Download />
                    </a>
                </Button>
            </div>
        </section>
    </div>

    <section class="shell mt-16">
        <Link
            v-reveal
            :href="experience()"
            class="group flex items-center justify-between gap-4 rounded-xl border border-border bg-card p-5 transition-all duration-300 ease-out-quart hover:-translate-y-0.5 hover:border-foreground/20 hover:shadow-lg hover:shadow-foreground/5"
        >
            <span>
                <span class="block text-sm font-semibold tracking-tight">
                    Experience
                </span>
                <span class="mt-0.5 block text-sm text-muted-foreground">
                    Where I have worked and what I have shipped.
                </span>
            </span>

            <ArrowRight
                class="size-4 flex-none text-muted-foreground transition-transform duration-300 ease-out-quart group-hover:translate-x-1 group-hover:text-foreground"
                aria-hidden="true"
            />
        </Link>
    </section>
</template>
