<script setup lang="ts">
import { Link, usePage } from '@inertiajs/vue3';
import { useWindowScroll } from '@vueuse/core';
import { computed } from 'vue';
import AppearanceToggle from '@/components/AppearanceToggle.vue';
import AppLogo from '@/components/AppLogo.vue';
import SiteNav from '@/components/SiteNav.vue';
import { home } from '@/routes';

const page = usePage();
const { y } = useWindowScroll();

/*
 * The header is invisible at rest and only materialises once content has
 * scrolled beneath it, so the hero meets the top of the viewport cleanly.
 */
const isScrolled = computed(() => y.value > 8);

const contact = computed(() => page.props.contact);
const currentYear = new Date().getFullYear();
</script>

<template>
    <div class="flex min-h-screen flex-col bg-background text-foreground">
        <a
            href="#main"
            class="sr-only z-100 rounded-md bg-foreground px-4 py-2 text-sm font-medium text-background focus-visible:not-sr-only focus-visible:fixed focus-visible:top-4 focus-visible:left-4"
        >
            Skip to content
        </a>

        <header
            class="sticky top-0 z-50 transition-colors duration-300 ease-out-quart"
            :class="
                isScrolled
                    ? 'border-b border-border bg-background/75 backdrop-blur-xl'
                    : 'border-b border-transparent'
            "
        >
            <div class="shell">
                <div
                    class="flex h-14 items-center justify-between gap-4 sm:h-16"
                >
                    <Link
                        :href="home()"
                        class="group -m-1 rounded-md p-1"
                        aria-label="Drew Redford, home"
                    >
                        <AppLogo />
                    </Link>

                    <div class="flex items-center gap-6">
                        <SiteNav class="hidden sm:flex" />
                        <AppearanceToggle />
                    </div>
                </div>

                <!--
                  Below `sm` the nav drops to its own row instead of collapsing
                  behind a menu button. Four destinations do not justify hiding
                  navigation behind an extra tap.
                -->
                <div class="-mx-2.5 pb-2.5 sm:hidden">
                    <SiteNav />
                </div>
            </div>
        </header>

        <main id="main" class="flex-1">
            <slot />
        </main>

        <footer class="mt-24 border-t border-border py-10">
            <div class="shell">
                <div
                    class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between"
                >
                    <p class="text-sm text-muted-foreground">
                        &copy; {{ currentYear }} {{ page.props.name }}
                        <span aria-hidden="true" class="mx-2 text-border"
                            >/</span
                        >
                        {{ contact.location }}
                    </p>

                    <a
                        :href="`mailto:${contact.email}`"
                        class="text-sm font-medium text-muted-foreground decoration-brand decoration-2 underline-offset-4 transition-colors duration-200 ease-out-quart hover:text-foreground hover:underline"
                    >
                        {{ contact.email }}
                    </a>
                </div>
            </div>
        </footer>
    </div>
</template>
