export type Config = {
    loop: boolean;
}

export type State = 'checked' | 'unchecked' | 'indeterminate';

export type Visibility = 'show' | 'hide'

export type Item = {
    id: string;
    value: string;
    state: State;
    element: HTMLButtonElement | HTMLElement;
    indicator: HTMLSpanElement | HTMLElement;
    input: HTMLInputElement | undefined;
}

