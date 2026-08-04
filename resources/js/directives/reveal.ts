import type { Directive, DirectiveBinding } from 'vue';

/**
 * `v-reveal` fades and lifts an element into place the first time it scrolls
 * into view.
 *
 * A single shared IntersectionObserver handles every element on the page
 * rather than one observer per element, and each element is unobserved as
 * soon as it has revealed, so the cost stays flat as pages grow.
 *
 * Pass an index to stagger a list:
 *
 *     <li v-for="(item, i) in items" v-reveal="i">
 */

const REVEAL_CLASS = 'reveal';
const REVEALED_ATTRIBUTE = 'data-revealed';

/**
 * How long, in milliseconds, the element at `index` waits before it reveals.
 */
export function staggerDelay(index: number): number {
    // TODO(human): decide how a list should cascade into view.
    //
    // Returning `index` is a 1ms step, which is effectively no stagger. It is
    // a deliberate placeholder so reveals still work before this is tuned.
    return index * 50;
}

const prefersReducedMotion = (): boolean =>
    typeof window !== 'undefined' &&
    window.matchMedia('(prefers-reduced-motion: reduce)').matches;

let observer: IntersectionObserver | null = null;

const getObserver = (): IntersectionObserver => {
    if (observer !== null) {
        return observer;
    }

    observer = new IntersectionObserver(
        (entries) => {
            for (const entry of entries) {
                if (!entry.isIntersecting) {
                    continue;
                }

                entry.target.setAttribute(REVEALED_ATTRIBUTE, '');
                observer?.unobserve(entry.target);
            }
        },
        {
            /*
             * Reveal once the element is a little way past the bottom edge
             * rather than the instant it clips the viewport, so content is
             * already settled by the time it is comfortably readable.
             */
            rootMargin: '0px 0px -10% 0px',
            /*
             * Zero, not a fraction. A threshold is a proportion of the element,
             * so on an entry taller than the viewport a fraction would delay
             * the reveal until well after it is already on screen.
             */
            threshold: 0,
        },
    );

    return observer;
};

export const vReveal: Directive<HTMLElement, number | undefined> = {
    mounted(el: HTMLElement, binding: DirectiveBinding<number | undefined>) {
        /*
         * Reduced-motion users get the content immediately and are never
         * observed, so nothing depends on a scroll event to become visible.
         */
        if (prefersReducedMotion()) {
            return;
        }

        el.classList.add(REVEAL_CLASS);
        el.style.setProperty(
            '--reveal-delay',
            `${staggerDelay(binding.value ?? 0)}ms`,
        );

        /*
         * Everything goes through the observer, including content that is
         * already on screen. Measuring position here instead would be
         * unreliable: directive `mounted` hooks fire as the component tree is
         * built, before the elements below have been laid out, so an entry
         * near the bottom of a long page can still report itself as on screen.
         */
        getObserver().observe(el);
    },

    unmounted(el: HTMLElement) {
        observer?.unobserve(el);
    },
};
