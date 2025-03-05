export default () => ({
    /**
     * Checkbox element.
     *
     * @type { HTMLButtonElement | HTMLElement }
     */
    $checkbox: undefined,

    /**
     * Checkbox indicator.
     *
     * @type { HTMLSpanElement | HTMLElement }
     */
    $indicator: undefined,

    /**
     * Input element.
     *
     * @type { HTMLInputElement | undefined }
     */
    $input: undefined,

    /**
     * Initialize the checkbox.
     *
     * @return { void }
     */
    init() {
        this.$checkbox  = this.$el;
        this.$indicator = this.$refs.indicator;
        this.$input     = this.input();

        this.state(this.$checkbox.dataset.state);

        this.addEventListeners();
    },

    /**
     * Toggle the checkbox.
     *
     * @return { void }
     */
    toggle() {
        this.isNotChecked ? this.check() : this.uncheck();

        this.$checkbox.dispatchEvent(new CheckChange({ 'checked': this.isChecked }));
    },

    /**
     * Check the checkbox.
     *
     * @return { void }
     */
    check() {
        this.state('checked');
        this.indicator('show');
    },

    /**
     * Uncheck the checkbox.
     *
     * @return { void }
     */
    uncheck() {
        this.state('unchecked');
        this.indicator('hide');
    },

    /**
     * Set the state of the checkbox.
     *
     * @param { import('bjnstnkvc/shadcn-ui/checkbox').State } state
     *
     * @return { void }
     */
    state(state) {
        this.$checkbox.dataset.state = state;
        this.$checkbox.ariaChecked   = (state === 'checked').toString();

        if (this.$input) {
            this.$input.checked = state === 'checked';
            this.$input.toggleAttribute('checked', this.isChecked);
        }
    },

    /**
     * Set the visibility of the indicator.
     *
     * @param { import('bjnstnkvc/shadcn-ui/checkbox').Visibility } visibility
     *
     * @return { void }
     */
    indicator(visibility) {
        if (!this.$indicator) {
            return;
        }

        this.$indicator.dataset.state = this.$checkbox.dataset.state;

        return visibility === 'show'
            ? this.$indicator.classList.remove('hidden')
            : this.$indicator.classList.add('hidden');
    },

    /**
     * Create an input element for the checkbox if it is inside a form.
     *
     * @returns { HTMLInputElement | undefined }
     */
    input() {
        if (this.isNotInForm) {
            return undefined;
        }

        const input = document.createElement('input');

        input.type       = 'checkbox';
        input.id         = this.$checkbox.id;
        input.name       = this.$checkbox.name || this.$checkbox.id;
        input.required   = this.$checkbox.ariaRequired === 'true';
        input.disabled   = this.$checkbox.disabled;
        input.ariaHidden = 'true';
        input.tabIndex   = -1;
        input.value      = this.$checkbox.value;

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

        this.$checkbox.insertAdjacentElement('afterend', input);

        return input;
    },

    /**
     * Add event listeners to the checkbox.
     *
     * @return { void }
     */
    addEventListeners() {
        this.$checkbox.addEventListener('click', () => this.toggle());
        this.$checkbox.addEventListener('keydown', event => {
            switch (event.key) {
                case ' ': {
                    event.preventDefault();

                    this.toggle();

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
     * Determine if the checkbox is checked.
     *
     * @return { Boolean }
     */
    get isChecked() {
        return this.$checkbox.ariaChecked === 'true';
    },

    /**
     * Determine if the checkbox is not checked.
     *
     * @return { Boolean }
     */
    get isNotChecked() {
        return !this.isChecked;
    },

    /**
     * Determine if the checkbox is inside a form.
     *
     * @return { Boolean }
     */
    get isInForm() {
        return this.$checkbox.closest('form') !== null;
    },

    /**
     * Determine if the checkbox is not inside a form.
     *
     * @return { Boolean }
     */
    get isNotInForm() {
        return !this.isInForm;
    }
});

class CheckChange extends CustomEvent {
    /**
     * Create a new Custom Event instance.
     *
     * @param { Object } detail
     */
    constructor(detail) {
        super('check-change', { detail: detail });
    }
}
