export type Config = {
    delay: number;
    collapsible: boolean;
    direction: 'ltr' | 'rtl';
}

export type State = 'show' | 'hide';

export type Status = 'idle' | 'loading' | 'loaded' | 'error'

