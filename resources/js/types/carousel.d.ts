export type Config = import('embla-carousel').EmblaOptionsType & {
    orientation: 'horizontal' | 'vertical';
}

export type Plugins = {
    autoplay: import('embla-carousel-autoplay').AutoplayOptionsType | undefined;
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

