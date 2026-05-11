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

Alpine.start();
