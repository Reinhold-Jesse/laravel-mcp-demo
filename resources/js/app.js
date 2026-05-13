import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.data('reveal', () => ({
    shown: false,

    init() {
        const observer = new IntersectionObserver(
            ([entry]) => {
                if (entry.isIntersecting) {
                    this.shown = true;
                    observer.disconnect();
                }
            },
            { rootMargin: '0px 0px -12% 0px', threshold: 0.16 },
        );

        observer.observe(this.$el);
    },
}));

Alpine.data('counter', ({ to = 100, step = 1, delay = 25, suffix = '' } = {}) => ({
    value: 0,
    suffix,

    init() {
        const observer = new IntersectionObserver(
            ([entry]) => {
                if (! entry.isIntersecting) {
                    return;
                }

                observer.disconnect();

                const reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

                if (reduceMotion) {
                    this.value = to;

                    return;
                }

                const interval = setInterval(() => {
                    this.value = Math.min(this.value + step, to);

                    if (this.value >= to) {
                        clearInterval(interval);
                    }
                }, delay);
            },
            { rootMargin: '0px 0px -8% 0px', threshold: 0.2 },
        );

        observer.observe(this.$el);
    },
}));

Alpine.data('contactForm', () => ({
    shown: false,
    sent: false,
    sending: false,
    data: { name: '', email: '', company: '', budget: '', message: '' },

    init() {
        const observer = new IntersectionObserver(
            ([entry]) => {
                if (entry.isIntersecting) {
                    this.shown = true;
                    observer.disconnect();
                }
            },
            { rootMargin: '0px 0px -10% 0px', threshold: 0.12 },
        );

        observer.observe(this.$el);
    },

    submit() {
        this.sending = true;
        setTimeout(() => {
            this.sending = false;
            this.sent = true;
        }, 900);
    },
}));

Alpine.start();
