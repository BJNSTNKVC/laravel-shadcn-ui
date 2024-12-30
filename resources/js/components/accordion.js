/**
 * @typedef { Object } Item
 * @property { String } id
 * @property { HTMLElement } container
 * @property { HTMLElement } title
 * @property { HTMLElement } button
 * @property { HTMLElement } content
 * @property { 'vertical' | 'horizontal '} orientation
 * @property { 'open' | 'closed' } state
 */

/**
 * @typedef { Object } Config
 * @property { 'single' | 'multiple' } type
 * @property { Boolean } collapsible
 * @property { 'ltr' | 'rtl' } direction
 */

/**
 * @param { Config } config
 */
export default (config) => ({
	/**
	 * Accordion element.
	 *
	 * @type { HTMLElement }
	 */
	$accordion: undefined,

	/**
	 * Accordion items.
	 *
	 * @type { Item[] }
	 */
	$items: [],

	/**
	 * Animation duration in milliseconds.
	 *
	 * @type { Number }
	 */
	$duration: 195,

	/**
	 * Initialize the accordion.
	 *
	 * @return { void }
	 */
	init() {
		this.$accordion = this.$el;
	},

	/**
	 * Add a new item to the accordion.
	 *
	 * @param { String } id
	 * @param { HTMLElement } item
	 *
	 * @return { Item }
	 */
	add(id, item) {
		/** @type { Item } */
		const $item = {
			id         : id,
			container  : item,
			title      : item.querySelector('h3'),
			button     : item.querySelector(`h3 > [id="${id}"]`),
			content    : item.querySelector(`:not(h3) > [id="${id}"]`),
			orientation: item.dataset.orientation,
			state      : item.dataset.state
		};

		this.$items.push($item);

		this.addEventListeners($item);

		this.dimensions($item);

		return $item;
	},

	/**
	 * Find an item by id.
	 *
	 * @param { String } id
	 *
	 * @return { Item }
	 */
	find(id) {
		return this.$items.find(item => item.id === id);
	},

	/**
	 * Open an item.
	 *
	 * @param { Item } item
	 *
	 * @return { void }
	 */
	open(item) {
		if (config.type === 'single') {
			this.active.forEach(active => this.close(active));
		}

		item.content.hidden = false;

		this.state(item, 'open');

		this.dimensions(item);
	},

	/**
	 * Close an item.
	 *
	 * @param { Item } item
	 *
	 * @return { void }
	 */
	close(item) {
		if (this.isNotCollapsible(item)) {
			return;
		}

		this.state(item, 'closed');

		this.dimensions(item);

		setTimeout(() => item.content.hidden = true, this.$duration);
	},

	/**
	 * Toggle an item.
	 *
	 * @param { String } id
	 *
	 * @return { void }
	 */
	toggle(id) {
		const item = this.find(id);

		item.state === 'closed' ? this.open(item) : this.close(item);

		let detail = config.type === 'single' ? this.active[0] : this.active;

		this.$accordion.dispatchEvent(new ValueChange(detail));
	},

	/**
	 * Set the state of an item.
	 *
	 * @param { Item } item
	 * @param { 'open' | 'closed' } state
	 *
	 * @return { void }
	 */
	state(item, state) {
		item.container.dataset.state = state;
		item.button.dataset.state    = state;
		item.button.ariaExpanded     = (state === 'open').toString();
		item.content.dataset.state   = state;
		item.state                   = state;
	},

	/**
	 * Set the height and width of an item.
	 *
	 * @param { Item } item
	 *
	 * @return { void }
	 */
	dimensions(item) {
		item.content.style.setProperty('--accordion-content-height', `${item.content.scrollHeight}px`);
		item.content.style.setProperty('--accordion-content-width', `${item.content.scrollWidth}px`);
	},

	/**
	 * Focus an item button.
	 *
	 * @param { Item } item
	 *
	 * @return { void }
	 */
	focus(item) {
		if (!item) {
			return;
		}

		item.button.focus();
	},

	/**
	 * Get the next item.
	 *
	 * @return { Item | null }
	 */
	next() {
		const item  = this.find(document.activeElement.id);
		const index = this.$items.indexOf(item);

		if (index < 0 || index >= this.$items.length - 1) {
			return null;
		}

		return this.$items[index + 1];
	},

	/**
	 * Get the previous item.
	 *
	 * @return { Item | null }
	 */
	prev() {
		const item  = this.find(document.activeElement.id);
		const index = this.$items.indexOf(item);

		if (index < 1 || index >= this.$items.length) {
			return null;
		}

		return this.$items[index - 1];
	},

	/**
	 * Determine if an item is config.collapsible.
	 *
	 * @param { Item } item
	 *
	 * @return { Boolean }
	 */
	isCollapsible(item) {
		return !this.isNotCollapsible(item);
	},

	/**
	 * Determine if an item is not config.collapsible.
	 *
	 * @param { Item } item
	 *
	 * @return { Boolean }
	 */
	isNotCollapsible(item) {
		return !config.collapsible && config.type === 'single' && this.$el.contains(item.button);
	},

	/**
	 * Add event listeners to an item.
	 *
	 * @param { Item } item
	 *
	 * @return { void }
	 */
	addEventListeners(item) {
		item.button.addEventListener('click', () => this.toggle(item.id));
		item.button.addEventListener('keydown', event => {
			switch (event.key) {
				// Moves focus to the next Accordion Trigger when orientation is vertical.
				case 'ArrowDown': {
					if (item.orientation !== 'vertical') {
						break;
					}

					this.focus(this.next());

					break;
				}
				// Moves focus to the previous Accordion Trigger when orientation is vertical.
				case 'ArrowUp': {
					if (item.orientation !== 'vertical') {
						break;
					}

					this.focus(this.prev());

					break;
				}
				// Moves focus to the next Accordion Trigger when orientation is horizontal.
				case 'ArrowRight': {
					if (item.orientation !== 'horizontal') {
						break;
					}

					if (config.direction === 'rtl') {
						this.focus(this.prev());
					} else {
						this.focus(this.next());
					}

					break;
				}
				// Moves focus to the previous Accordion Trigger when orientation is horizontal.
				case 'ArrowLeft': {
					if (item.orientation !== 'horizontal') {
						break;
					}

					if (config.direction === 'rtl') {
						this.focus(this.next());
					} else {
						this.focus(this.prev());
					}

					break;
				}
				// When focus is on an Accordion Trigger, moves focus to the first Accordion Trigger.
				case 'Home': {
					this.first.button.focus();

					break;
				}
				// When focus is on an Accordion Trigger, moves focus to the last Accordion Trigger.
				case 'End': {
					this.last.button.focus();

					break;
				}
				// When focus is on an Accordion Trigger of a collapsed section, expands the section.
				case 'Enter':
				case ' ': {
					event.preventDefault();

					this.toggle(item.id);

					break;
				}
			}
		});
	},

	/**
	 * Get the active items.
	 *
	 * @return { Item[] }
	 */
	get active() {
		return this.$items.filter(item => item.state === 'open');
	},

	/**
	 * Get the first item.
	 *
	 * @return { Item }
	 */
	get first() {
		return this.$items[0];
	},

	/**
	 * Get the last item.
	 *
	 * @return { Item }
	 */
	get last() {
		return this.$items[this.$items.length - 1];
	}
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
