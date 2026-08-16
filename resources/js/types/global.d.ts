// This file must stay a module (not a global script) so the `declare module`
// blocks below AUGMENT those packages rather than replace their types.
import type { vReveal } from '@/directives/reveal';

export {};

// Extend ImportMeta interface for Vite...
declare module 'vite/client' {
    interface ImportMetaEnv {
        readonly VITE_APP_NAME: string;
        [key: string]: string | boolean | undefined;
    }

    interface ImportMeta {
        readonly env: ImportMetaEnv;
        readonly glob: <T>(pattern: string) => Record<string, () => Promise<T>>;
    }
}

declare module '@inertiajs/core' {
    export interface InertiaConfig {
        sharedPageProps: {
            name: string;
            contact: {
                location: string;
                email: string;
            };
            [key: string]: unknown;
        };
    }
}

declare module 'vue' {
    interface ComponentCustomProperties {
        $inertia: typeof Router;
        $page: Page;
        $headManager: ReturnType<typeof createHeadManager>;
    }

    // Makes `v-reveal` type-check in templates, since it is registered
    // globally in app.ts rather than imported per component.
    interface GlobalDirectives {
        vReveal: typeof vReveal;
    }
}
