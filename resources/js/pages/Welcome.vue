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

    <section class="py-4">
        <h1 class="text-4xl font-semibold tracking-tight sm:text-5xl">
            Drew Redford
        </h1>

        <p v-if="currentRole" class="mt-3 text-lg text-muted-foreground">
            {{ currentRole.title }} at
            <span class="font-medium text-foreground">
                {{ currentRole.company }}
            </span>
        </p>

        <p class="mt-2 flex items-center gap-1.5 text-sm text-muted-foreground">
            <MapPin class="size-4" />
            {{ location }}
        </p>

        <p class="mt-6 max-w-2xl leading-relaxed text-foreground/80">
            {{ summary }}
        </p>

        <div class="mt-8 flex flex-wrap items-center gap-3">
            <Dialog>
                <DialogTrigger as-child>
                    <Button>
                        View resume
                        <FileText />
                    </Button>
                </DialogTrigger>

                <DialogContent
                    class="grid-rows-[auto_minmax(0,1fr)] gap-0 p-0 sm:max-w-4xl"
                >
                    <DialogHeader class="border-b border-border p-4 pr-12">
                        <DialogTitle>Resume</DialogTitle>
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

            <Button as-child variant="outline">
                <a :href="resumeUrl" download>
                    Download resume
                    <Download />
                </a>
            </Button>

            <Link
                :href="experience()"
                class="inline-flex items-center gap-1.5 text-sm font-medium text-muted-foreground underline-offset-4 hover:text-foreground hover:underline"
            >
                View my experience
                <ArrowRight class="size-4" />
            </Link>
        </div>
    </section>
</template>
