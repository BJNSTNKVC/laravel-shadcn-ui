export type State = 'checked' | 'unchecked' | 'indeterminate';

export type Visibility = 'show' | 'hide'

export type Item = {
    id: string;
    value: string;
    container: HTMLElement;
    title: HTMLElement;
    button: HTMLButtonElement;
    content: HTMLElement;
    orientation: 'vertical' | 'horizontal';
    state: State;
}

