import EmblaCarousel from 'embla-carousel';
import EmblaCarouselAutoplay from 'embla-carousel-autoplay';

/**
 * @typedef { import('embla-carousel').EmblaOptionsType } Config
 * @property { 'horizontal' | 'vertical' } orientation
 */

/**
 * @typedef { Object } Plugins
 * @property { EmblaCarouselAutoplay } autoplay
 */

/**
 * @param { Config } config
 * @param { Plugins } plugins
 */
export default (config, plugins) => ({
    /**
     * Carousel content element.
     *
     * @type { Object }
     */
    content: {
        ['x-ref']: 'content',
    },

    /**
     * Carousel previous button.
     *
     * @type { Object }
     */
    prev: {
        ['x-ref']: 'prev',
        ['@click']() {
            this.$api.scrollPrev();
        },
        ...onKeyEvents,
    },

    /**
     * Carousel next button.
     *
     * @type { Object }
     */
    next: {
        ['x-ref']: 'next',
        ['@click']() {
            this.$api.scrollNext();
        },
        ...onKeyEvents,
    },

    /**
     * The Embla HTML element.
     *
     * @type { HTMLElement }
     */
    $embla: document.querySelector('[x-bind="content"]'),

    /**
     * The Embla buttons.
     *
     * @type { { prev: HTMLButtonElement, next: HTMLButtonElement } }
     */
    $buttons: {
        prev: document.querySelector('[x-bind="prev"]'),
        next: document.querySelector('[x-bind="next"]'),
    },

    /**
     * The Embla API.
     *
     * @type { import('embla-carousel').EmblaCarouselType | any }
     */
    $api: undefined,

    /**
     * The Embla options.
     *
     * @type { import('embla-carousel').EmblaOptionsType }
     */
    $options: undefined,

    /**
     * The Embla plugins.
     *
     * @type { Array }
     */
    $plugins: [],

    /**
     * The Carousel props.
     *
     * @type { Object }
     */
    $props: {},

    /**
     * Initialize the Carousel.
     *
     * @return { void }
     */
    init() {
        this.$options = this.options(config);
        this.$plugins = this.plugins(plugins);
        this.$api     = EmblaCarousel(this.$embla, this.$options, this.$plugins);

        this.$api.on('select', (api) => {
            this.$buttons.prev?.toggleAttribute('disabled', !api.canScrollPrev());
            this.$buttons.next?.toggleAttribute('disabled', !api.canScrollNext());
        });
    },

    /**
     * Set the Carousel options.
     *
     * @param { Config } config
     *
     * @return { import('embla-carousel').EmblaOptionsType }
     */
    options(config) {
        delete Object.assign(config, { ['axis']: config.orientation === 'vertical' ? 'y' : 'x' })['orientation'];

        this.$options = { ...this.$options, ...config };

        return this.$options;
    },

    /**
     * Set the Carousel plugins.
     *
     * @param { Plugins } plugins
     *
     * @return { Array }
     */
    plugins(plugins) {
        const data = [];

        for (const plugin in plugins) {
            if (plugin === 'autoplay') {
                data.push(new EmblaCarouselAutoplay({ ...plugins[plugin] }));
            }
        }

        return data;
    },
});

/**
 * Carousel Button Key events scaffolding.
 */
const onKeyEvents = {
    /**
     * Button Arrow Right event.
     *
     * @return { void }
     */
    ['@keydown.right']() {
        this.$api.scrollNext();
    },

    /**
     * Button Arrow Left event.
     *
     * @return { void }
     */
    ['@keydown.left']() {
        this.$api.scrollPrev();
    },
};
