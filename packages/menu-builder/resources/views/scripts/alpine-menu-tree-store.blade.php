<script data-navigate-once>
    (function () {
        if (window.__menuBuilderPageTreeAlpineRegistered) {
            return;
        }

        window.__menuBuilderPageTreeAlpineRegistered = true;

        document.addEventListener('alpine:init', () => {
            Alpine.store('menuBuilderPageTree', {
                open: {},
                branchIds: [],
                pathIds: [],
                configure(branchIds, pathIds) {
                    this.branchIds = Array.isArray(branchIds) ? branchIds : [];
                    this.pathIds = Array.isArray(pathIds) ? pathIds : [];
                    const allowed = new Set([...this.branchIds, ...this.pathIds]);

                    for (const id of this.pathIds) {
                        this.open[id] = true;
                    }

                    for (const key of Object.keys({ ...this.open })) {
                        const id = Number(key);

                        if (! allowed.has(id)) {
                            delete this.open[key];
                        }
                    }
                },
                toggle(menuItemId) {
                    this.open[menuItemId] = ! this.open[menuItemId];
                },
                expandAll() {
                    for (const id of this.branchIds) {
                        this.open[id] = true;
                    }
                },
                collapseAll() {
                    for (const key of Object.keys({ ...this.open })) {
                        delete this.open[key];
                    }

                    for (const id of this.pathIds) {
                        this.open[id] = true;
                    }
                },
            });
        });
    })();
</script>
