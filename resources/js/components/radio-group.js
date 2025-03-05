/**
 * @param { import('bjnstnkvc/shadcn-ui/radio').Config } config
 */
export default (config) => ({
    /**
     * Radio group element.
     *
     * @type { HTMLDivElement | HTMLElement }
     */
    $group: undefined,

    /**
     * Radio group items.
     *
     * @type { import('bjnstnkvc/shadcn-ui/radio').Item[] }
     */
    $items: [],

    /**
     * Initialize the radio group.
     *
     * @return { void }
     */
    init() {
        this.$group = this.$el;
        this.$items = this.items();

        this.addEventListeners();
    },

    /**
     * Get the radio items.
     *
     * @return { import('bjnstnkvc/shadcn-ui/radio').Item[] }
     */
    items() {
        return [...this.$group.querySelectorAll('[x-ref="radio"]')].map((radio) => {
            /** @type { import('bjnstnkvc/shadcn-ui/radio').Item } */
            const item = {
                id       : radio.id,
                value    : radio.value,
                state    : radio.dataset.state,
                element  : radio,
                indicator: radio.querySelector('[x-ref="indicator"]'),
            };

            if (this.isInForm) {
                item.input = this.input(item);
            }

            return item;
        });
    },

    /**
     * Check the radio item.
     *
     * @param { import('bjnstnkvc/shadcn-ui/radio').Item } item
     *
     * @return { void }
     */
    check(item) {
        this.state(item, 'checked');
        this.indicator(item, 'show');

        this.$group.dispatchEvent(new ValueChange({ value: item.value }));
    },

    /**
     * Uncheck the radio item.
     *
     * @param { import('bjnstnkvc/shadcn-ui/radio').Item } item
     *
     * @return { void }
     */
    uncheck(item) {
        this.state(item, 'unchecked');
        this.indicator(item, 'hide');
    },

    /**
     * Toggle the radio item.
     *
     * @param { import('bjnstnkvc/shadcn-ui/radio').Item } item
     *
     * @return { void }
     */
    toggle(item) {
        if (item.state === 'checked') {
            return;
        }

        if (this.active) {
            this.uncheck(this.active);
        }

        this.check(item);
    },

    /**
     * Set the state of the radio item.
     *
     * @param { import('bjnstnkvc/shadcn-ui/radio').Item } item
     * @param { import('bjnstnkvc/shadcn-ui/radio').State } state
     *
     * @return { void }
     */
    state(item, state) {
        item.state                 = state;
        item.element.dataset.state = state;
        item.element.ariaChecked   = (state === 'checked').toString();

        if (item.input) {
            item.input.checked = state === 'checked';
            item.input.toggleAttribute('checked', item.state === 'checked');
        }
    },

    /**
     * Set the visibility of the indicator.
     *
     * @param { import('bjnstnkvc/shadcn-ui/radio').Item } item
     * @param { import('bjnstnkvc/shadcn-ui/radio').Visibility } visibility
     *
     * @return { void }
     */
    indicator(item, visibility) {
        if (!item.indicator) {
            return;
        }

        item.indicator.dataset.state = item.state;

        return visibility === 'show'
            ? item.indicator.classList.remove('hidden')
            : item.indicator.classList.add('hidden');
    },

    /**
     * Create an input element for the radio item if it is inside a form.
     *
     * @param { import('bjnstnkvc/shadcn-ui/radio').Item } item
     *
     * @returns { HTMLInputElement | undefined }
     */
    input(item) {
        const input = document.createElement('input');

        input.type = 'radio';

        input.id         = item.element.id;
        input.name       = item.element.name || item.element.id;
        input.required   = item.element.ariaRequired === 'true';
        input.disabled   = item.element.disabled;
        input.ariaHidden = 'true';
        input.tabIndex   = -1;
        input.value      = item.element.value;

        input.toggleAttribute('required', input.required);
        input.toggleAttribute('disabled', input.disabled);
        input.toggleAttribute('data-disabled', input.disabled);

        input.style.transform     = 'translateX(-100%)';
        input.style.position      = 'absolute';
        input.style.pointerEvents = 'none';
        input.style.opacity       = '0';
        input.style.marginLeft    = '16px';
        input.style.width         = '16px';
        input.style.height        = '16px';

        item.element.insertAdjacentElement('afterend', input);

        return input;
    },

    /**
     * Find a radio item by id.
     *
     * @param { HTMLElement } element
     *
     * @return { import('bjnstnkvc/shadcn-ui/radio').Item }
     */
    find(element) {
        return this.$items.find(item => item.element === element);
    },

    /**
     * Focus a radio item.
     *
     * @param { import('bjnstnkvc/shadcn-ui/radio').Item } item
     *
     * @return { void }
     */
    focus(item) {
        if (!item) {
            return;
        }

        item.element.focus();
    },

    /**
     * Get the next radio item.
     *
     * @return { import('bjnstnkvc/shadcn-ui/radio').Item | null }
     */
    next() {
        const item  = this.find(document.activeElement);
        const index = this.$items.indexOf(item);

        if (index < 0 || index >= this.$items.length - 1) {
            return null;
        }

        return this.$items[index + 1];
    },

    /**
     * Get the previous radio item.
     *
     * @return { import('bjnstnkvc/shadcn-ui/radio').Item | null }
     */
    prev() {
        const item  = this.find(document.activeElement);
        const index = this.$items.indexOf(item);

        if (index < 1 || index >= this.$items.length) {
            return null;
        }

        return this.$items[index - 1];
    },

    /**
     * Add event listeners to the radio group.
     *
     * @return { void }
     */
    addEventListeners() {
        this.$items.forEach((item) => item.element.addEventListener('click', () => this.toggle(item)));
        this.$group.addEventListener('keydown', event => {
            switch (event.key) {
                // Moves focus to either the checked radio item or the first radio item in the group.
                case 'Tab': {
                    event.preventDefault();

                    this.focus(this.active || this.first);

                    break;
                }

                // When focus is on an unchecked radio item, checks it.
                case ' ': {
                    event.preventDefault();

                    const item = this.find(event.target);

                    this.toggle(item);

                    break;
                }

                // Moves focus and checks the next radio item in the group.
                case 'ArrowDown':
                case 'ArrowRight': {
                    event.preventDefault();

                    const item = this.next() ?? (config.loop ? this.first : null);

                    if (!item) {
                        break;
                    }

                    this.focus(item);
                    this.toggle(item);

                    break;
                }

                // Moves focus to the previous radio item in the group.
                case 'ArrowUp':
                case 'ArrowLeft': {
                    event.preventDefault();

                    const item = this.prev() || (config.loop ? this.last : null);

                    if (!item) {
                        break;
                    }

                    this.focus(item);
                    this.toggle(item);

                    break;
                }

                // As per WAI ARIA, checkboxes don't activate on enter keypress.
                case 'Enter': {
                    event.preventDefault();

                    break;
                }
            }
        });
    },

    /**
     * Get the active radio item.
     *
     * @return { import('bjnstnkvc/shadcn-ui/radio').Item }
     */
    get active() {
        return this.$items.find(item => item.state === 'checked');
    },

    /**
     * Get the first radio item.
     *
     * @return { import('bjnstnkvc/shadcn-ui/radio').Item }
     */
    get first() {
        return this.$items.at(0);
    },

    /**
     * Get the last radio item.
     *
     * @return { import('bjnstnkvc/shadcn-ui/radio').Item }
     */
    get last() {
        return this.$items.at(-1);
    },

    /**
     * Determine if the radio is inside a form.
     *
     * @return { Boolean }
     */
    get isInForm() {
        return this.$group.closest('form') !== null;
    },

    /**
     * Determine if the radio is not inside a form.
     *
     * @return { Boolean }
     */
    get isNotInForm() {
        return !this.isInForm;
    },
});

class ValueChange extends CustomEvent {
    /**
     * Create a new Custom Event instance.
     *
     * @param { Object } detail
     */
    constructor(detail) {
        super('value-change', { detail: detail });
    }
}
