export default () => ({
    /**
     * Collapsible element.
     *
     * @type { HTMLDivElement | HTMLElement }
     */
    $collapsible: undefined,

    /**
     * Collapsible trigger element.
     *
     * @type { HTMLButtonElement | HTMLElement }
     */
    $trigger: undefined,

    /**
     * Collapsible content element.
     *
     * @type { HTMLDivElement | HTMLElement }
     */
    $content: undefined,

    /**
     * Initialize the collapsible.
     *
     * @return { void }
     */
    init() {
        this.$collapsible = this.$el;
        this.$trigger     = this.$refs.trigger;
        this.$content     = this.$refs.content;

        this.addEventListeners();
    },

    /**
     * Add event listeners to the collapsible element.
     *
     * @return { void }
     */
    addEventListeners() {
        this.$trigger.addEventListener('click', () => this.toggle());
        this.$trigger.addEventListener('keydown', event => {
            switch (event.key) {
                // When focus is on a Collapsible Trigger, toggle the collapsible element.
                case 'Enter':
                case ' ': {
                    event.preventDefault();

                    this.toggle();

                    break;
                }
            }
        });
    },

    /**
     * Open the collapsible element.
     *
     * @return { void }
     */
    open() {
        this.state('open');
    },

    /**
     * Close the collapsible element.
     *
     * @return { void }
     */
    close() {
        this.state('closed');
    },

    /**
     * Toggle the collapsible element.
     *
     * @return { void }
     */
    toggle() {
        this.isClosed ? this.open() : this.close();

        this.$collapsible.dispatchEvent(new OpenChange({ 'open': this.isOpen }));
    },

    /**
     * Set the state of the collapsible element.
     *
     * @param { import('bjnstnkvc/shadcn-ui/collapsible').State } state
     *
     * @return { void }
     */
    state(state) {
        this.$collapsible.dataset.state = state;
        this.$trigger.dataset.state     = state;
        this.$trigger.ariaExpanded      = (state === 'open').toString();
        this.$content.dataset.state     = state;
        this.$content.hidden            = state === 'closed';

        this.dimensions();
    },

    /**
     * Set the height and width of the collapsible element.
     *
     * @return { void }
     */
    dimensions() {
        this.$content.style.setProperty('--collapsible-content-height', `${this.$content.scrollHeight}px`);
        this.$content.style.setProperty('--collapsible-content-width', `${this.$content.scrollWidth}px`);
    },

    /**
     * Determine if the collapsible element is open.
     *
     * @return { Boolean }
     */
    get isOpen() {
        return this.$collapsible.dataset.state === 'open';
    },

    /**
     * Determine if the collapsible element is closed.
     *
     * @return { Boolean }
     */
    get isClosed() {
        return !this.isOpen;
    },
});

class OpenChange extends CustomEvent {
    /**
     * Create a new Custom Event instance.
     *
     * @param { Object } detail
     */
    constructor(detail) {
        super('open-change', { detail: detail });
    }
}
