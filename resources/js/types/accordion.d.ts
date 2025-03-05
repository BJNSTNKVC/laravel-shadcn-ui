export type Config = {
    type: 'single' | 'multiple';
    collapsible: boolean;
    direction: 'ltr' | 'rtl';
}

export type State = 'closed' | 'open';

export type Item = {
    id: string;
    value: string;
    container: HTMLDivElement | HTMLElement;
    title: HTMLHeadingElement | HTMLElement;
    button: HTMLButtonElement | HTMLElement;
    content: HTMLDivElement | HTMLElement;
    orientation: 'vertical' | 'horizontal';
    state: State;
}

