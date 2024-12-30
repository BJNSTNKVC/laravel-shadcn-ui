/** @type {import('tailwindcss').Config} */
export default {
    content : [
        './resources/**/*.blade.php',
        './resources/**/*.js',
    ],
    darkMode: 'selector',
    theme   : {
        extend: {
            animation: {
                'accordion-down': 'accordion-down 0.2s ease-out',
                'accordion-up'  : 'accordion-up 0.2s ease-out',
            },
            colors   : {
                background: {
                    DEFAULT   : 'hsl(var(--background))',
                },
                foreground: {
                    DEFAULT   : 'hsl(var(--foreground))',
                },
                card: {
                    DEFAULT   : 'hsl(var(--card))',
                    foreground: 'hsl(var(--card-foreground))',
                },
                popover: {
                    DEFAULT   : 'hsl(var(--popover))',
                    foreground: 'hsl(var(--popover-foreground))',
                },
                primary   : {
                    DEFAULT   : 'hsl(var(--primary))',
                    foreground: 'hsl(var(--primary-foreground))',
                },
                secondary: {
                    DEFAULT   : 'hsl(var(--secondary))',
                    foreground: 'hsl(var(--secondary-foreground))',
                },
                muted: {
                    DEFAULT   : 'hsl(var(--muted))',
                    foreground: 'hsl(var(--muted-foreground))',
                },
                accent: {
                    DEFAULT   : 'hsl(var(--accent))',
                    foreground: 'hsl(var(--accent-foreground))',
                },
                destructive: {
                    DEFAULT   : 'hsl(var(--destructive))',
                    foreground: 'hsl(var(--destructive-foreground))',
                },
                border: {
                    DEFAULT   : 'hsl(var(--border))',
                },
                input: {
                    DEFAULT   : 'hsl(var(--input))',
                    foreground: 'hsl(var(--input-foreground))',
                },
                ring: {
                    DEFAULT   : 'hsl(var(--ring))',
                    foreground: 'hsl(var(--ring-foreground))',
                },

            },
            keyframes: {
                'accordion-down': {
                    from: { height: '0' },
                    to  : { height: 'var(--accordion-content-height)' },
                },
                'accordion-up'  : {
                    from: { height: 'var(--accordion-content-height)' },
                    to  : { height: '0' },
                },
            },
        }
    },
    plugins : [],
};
