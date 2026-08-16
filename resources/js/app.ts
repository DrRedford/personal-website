import { createInertiaApp } from '@inertiajs/vue3';
import { initializeTheme } from '@/composables/useAppearance';
import { vReveal } from '@/directives/reveal';
import PublicLayout from '@/layouts/PublicLayout.vue';

const appName = import.meta.env.VITE_APP_NAME || 'Drew Redford';

createInertiaApp({
    title: (title) => (title ? `${title} - ${appName}` : appName),
    layout: () => PublicLayout,
    /*
     * `withApp` hooks into the app instance without replacing `setup`, which
     * would otherwise opt us out of the Vite plugin's page resolution and SSR
     * handling.
     */
    withApp(app) {
        app.directive('reveal', vReveal);
    },
    progress: {
        color: 'hsl(38 92% 50%)',
    },
});

// This will set light / dark mode on page load...
initializeTheme();
