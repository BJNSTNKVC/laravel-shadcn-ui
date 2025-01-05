/**
 * @typedef { 'show' | 'hide' } State
 * @typedef { 'idle' | 'loading' | 'loaded' | 'error' } Status
 */

/**
 * @typedef { Object } Config
 * @property { Number } delay
 */

/**
 * @param { Config } config
 */
export default (config) => ({
	/**
	 * Avatar element.
	 *
	 * @type { HTMLElement }
	 */
	$avatar: undefined,

	/**
	 * Avatar image.
	 *
	 * @type { HTMLImageElement }
	 */
	$image: undefined,

	/**
	 * Avatar fallback.
	 *
	 * @type { HTMLElement }
	 */
	$fallback: undefined,

	/**
	 * Avatar timeout ID.
	 *
	 * @type { Number }
	 */
	$timeout: undefined,

	/**
	 * Initialize the avatar.
	 *
	 * @return { void }
	 */
	init() {
		this.$avatar   = this.$el;
		this.$image    = this.$refs.image;
		this.$fallback = this.$refs.fallback;

		if (!this.$image) {
			return;
		}

		this.$image = this.mock();

		if (this.$image.src === '') {
			return this.dispatch('error');
		}

		if (this.isLoaded()) {
			return this.show();
		}

		this.dispatch('idle');

		if (config.delay > 0) {
			this.fallback('hide');

			this.$timeout = setTimeout(() => this.fallback('show'), config.delay);
		}

		this.dispatch('loading');

		this.$image.addEventListener('load', () => this.show());
		this.$image.addEventListener('error', () => this.hide());
	},

	/**
	 * Mock the avatar image.
	 *
	 * @return { HTMLImageElement }
	 */
	mock() {
		const image = new Image();

		image.src = this.$refs.image.src;

		return image;
	},

	/**
	 * Display the avatar image and hide the fallback if the image is successfully loaded.
	 *
	 * @return { void }
	 */
	show() {
		this.fallback('hide');
		this.image('show');

		clearTimeout(this.$timeout);

		this.dispatch('loaded');
	},

	/**
	 * Hide the avatar image and show the fallback if the image fails to load.
	 *
	 * @return { void }
	 */
	hide() {
		setTimeout(() => this.fallback('show'), config.delay);

		this.image('hide');

		clearTimeout(this.$timeout);

		this.dispatch('error');
	},

	/**
	 * Set the avatar image hidden state.
	 *
	 * @param {State } state
	 *
	 * @return { void }
	 */
	image(state) {
		this.$refs.image.hidden = state === 'hide';
	},

	/**
	 * Set the fallback state.
	 *
	 * @param { State } state
	 *
	 * @return { void }
	 */
	fallback(state) {
		if (!this.$fallback) {
			return;
		}

		if (state === 'show') {
			return this.$fallback.classList.remove('hidden');
		}

		return this.$fallback.classList.add('hidden');
	},

	/**
	 * Determine if the avatar image is loaded.
	 *
	 * @returns { Boolean }
	 */
	isLoaded() {
		if (!this.$image) {
			return false;
		}

		return this.$image.complete && this.$image.naturalWidth > 0;
	},

	/**
	 * Determine if the avatar image is not loaded.
	 *
	 * @returns { Boolean }
	 */
	isNotLoaded() {
		return !this.isLoaded();
	},

	/**
	 * Dispatch the loading status change event.
	 *
	 * @param { Status } status
	 * @param { Number } delay
	 */
	dispatch(status, delay = 0) {
		setTimeout(() => this.$refs.image.dispatchEvent(new LoadingStatusChange({ status: status })), delay);
	}
});

class LoadingStatusChange extends CustomEvent {
	/**
	 * Create a new Custom Event instance.
	 *
	 * @param { Object } detail
	 */
	constructor(detail) {
		super('loading-status-change', { detail: detail });
	}
}
