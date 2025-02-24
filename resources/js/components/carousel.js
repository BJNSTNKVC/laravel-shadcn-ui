import EmblaCarousel from 'embla-carousel';
import EmblaCarouselAutoplay from 'embla-carousel-autoplay';

/**
 * @typedef { Object } Alpine
 * @property { { content: HTMLElement, prev: HTMLElement | HTMLButtonElement, next: HTMLElement | HTMLButtonElement } } $refs
 */

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
     * The Embla HTML element.
     *
     * @type { HTMLElement }
     */
    $embla: undefined,

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
        this.$embla   = this.$refs.content;
        this.$options = this.options(config);
        this.$plugins = this.plugins(plugins);
        this.$api     = EmblaCarousel(this.$embla, this.$options, this.$plugins);

        this.$refs.prev.disabled = !this.$api.canScrollPrev();
        this.$refs.next.disabled = !this.$api.canScrollNext();

        this.addEventListeners();
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

    /**
     * Add event listeners to the Carousel and its elements.
     *
     * @return { void }
     */
    addEventListeners() {
        this.$api.on('select', () => {
            this.$refs.prev.disabled = !this.$api.canScrollPrev();
            this.$refs.next.disabled = !this.$api.canScrollNext();
        });

        this.$refs.prev.addEventListener('click', () => this.$api.scrollPrev());
        this.$refs.next.addEventListener('click', () => this.$api.scrollNext());

        [this.$refs.prev, this.$refs.next].forEach((button) => {
            button.addEventListener('keydown', (event) => {
                switch (event.key) {
                    case 'ArrowRight': {
                        event.preventDefault();

                        this.$api.scrollNext();

                        break;
                    }

                    case 'ArrowLeft': {
                        event.preventDefault();

                        this.$api.scrollPrev();

                        break;
                    }
                }
            });
        });
    }
});
