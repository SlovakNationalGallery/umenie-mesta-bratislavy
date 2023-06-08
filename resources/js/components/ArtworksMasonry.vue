<template>
    <div>
        <div ref="container">
            <slot></slot>
        </div>
        <slot name="controls" :append="append" :reset="reset"></slot>
        <slot name="empty"></slot>
    </div>
</template>

<script>
//TODO empty view when changing query
// TODO put observer back
import Masonry from 'masonry-layout';

export default {
    props: {
        itemSelector: {
            type: String,
        },
    },
    methods: {
        addItemsFromHtmlString(htmlString) {
            const htmlDocument = document.createElement('html');
            htmlDocument.innerHTML = htmlString.replace(
                // Remove <template> tags because querySelectorAll doesn't work with them
                /<\/?template.*?>/g,
                ''
            );

            const items = htmlDocument.querySelectorAll(this.itemSelector);

            for (let item of items) {
                const img = item.querySelector('img');
                img.addEventListener('load', () => {
                    this.masonry.layout();
                });
                this.$refs.container.appendChild(item);
            }

            return items;
        },
        append(htmlString) {
            const items = this.addItemsFromHtmlString(htmlString);
            this.masonry.appended(items);
        },
        reset(htmlString) {
            this.$refs.container.innerHTML = '';
            const items = this.addItemsFromHtmlString(htmlString);
            this.masonry.prepended(items);
            this.masonry.layout();
        },
    },
    mounted() {
        this.masonry = new Masonry(this.$refs.container, {
            itemSelector: this.itemSelector,
        });

        for (let img of this.$refs.container.querySelectorAll('img')) {
            img.addEventListener('load', () => {
                this.masonry.layout();
            });
        }

        const containerResizeObserver = new ResizeObserver(() => this.masonry.layout())

        containerResizeObserver.observe(this.$refs.container)
    },
};
</script>
