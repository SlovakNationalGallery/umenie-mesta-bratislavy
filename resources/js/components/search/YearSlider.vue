<template>
    <div>
        <Slider
            :min="min"
            :max="max"
            v-model="value"
            :classes="sliderClasses"
            :tooltips="false"
        />
        <div class="flex justify-between pt-5">
            <input
                pattern="[-]?[0-9]{1,4}"
                class="text-xs [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none w-12"
                type="number"
                :value="value[0]"
                @input="(event) => (value[0] = event.target.value)"
            />
            <input
                pattern="[-]?[0-9]{1,4}"
                class="text-xs [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none w-12"
                type="number"
                :value="value[1]"
                @input="(event) => (value[1] = event.target.value)"
            />
        </div>
        <button
            @click="() => (value = [min, max])"
            class="underline pt-4 text-xs"
        >
            Resetovať hodnoty
        </button>
    </div>
</template>

<script>
import Slider from '@vueform/slider';

export default {
    props: ['min', 'max', 'defaultFrom', 'defaultTo'],
    components: {
        Slider,
    },
    emits: ['change'],
    data() {
        return {
            value: [this.min, this.max],
            sliderClasses: {
                target: 'relative box-border select-none touch-none tap-highlight-transparent touch-callout-none disabled:cursor-not-allowed',
                focused: 'slider-focused',
                tooltipFocus: 'slider-tooltip-focus',
                tooltipDrag: 'slider-tooltip-drag',
                ltr: 'slider-ltr',
                rtl: 'slider-rtl',
                horizontal: 'slider-horizontal h-0.5',
                vertical: 'slider-vertical w-1.5 h-80',
                textDirectionRtl: 'slider-txt-rtl',
                textDirectionLtr: 'slider-txt-ltr',
                base: 'w-full h-full relative z-1 bg-gray-300 rounded',
                connects: 'w-full h-full relative overflow-hidden z-0 rounded',
                connect:
                    'absolute z-1 top-0 right-0 transform-origin-0 transform-style-flat h-full w-full bg-red-500 cursor-pointer tap:duration-300 tap:transition-transform disabled:bg-gray-400 disabled:cursor-not-allowed',
                origin: 'slider-origin absolute z-1 top-0 right-0 transform-origin-0 transform-style-flat h-full w-full h:h-0 v:-top-full txt-rtl-h:left-0 txt-rtl-h:right-auto v:w-0 tap:duration-300 tap:transition-transform',
                handle: 'absolute bg-[url(../img/paralel-lines.svg)] rounded-full bg-red-500 border-0 cursor-grab focus:outline-none h:w-6 h:h-6 h:-top-2.5 h:-right-2 txt-rtl-h:-left-2 txt-rtl-h:right-auto v:w-6 v:h-6 v:-top-2 v:-right-1.25 disabled:cursor-not-allowed focus:ring focus:ring-green-500 focus:ring-opacity-30',
                handleLower: 'slider-hande-lower',
                handleUpper: 'slider-hande-upper',
                touchArea: 'h-full w-full',
                tooltip:
                    'absolute block text-sm font-semibold whitespace-nowrap py-1 px-1.5 min-w-5 text-center text-white rounded border border-green-500 bg-green-500 transform h:-translate-x-1/2 h:left-1/2 v:-translate-y-1/2 v:top-1/2 disabled:bg-gray-400 disabled:border-gray-400 merge-h:translate-x-1/2 merge-h:left-auto merge-v:-translate-x-4 merge-v:top-auto tt-focus:hidden tt-focused:block tt-drag:hidden tt-dragging:block',
                tooltipTop: 'bottom-6 h:arrow-bottom merge-h:bottom-3.5',
                tooltipBottom: 'top-6 h:arrow-top merge-h:top-5',
                tooltipLeft: 'right-6 v:arrow-right merge-v:right-1',
                tooltipRight: 'left-6 v:arrow-left merge-v:left-7',
                tooltipHidden: 'slider-tooltip-hidden',
                active: 'slider-active-active cursor-grabbing',
                draggable: 'cursor-ew-resize v:cursor-ns-resize',
                tap: 'slider-state-tap',
                drag: 'slider-state-drag',
            },
        };
    },
    watch: {
        defaultFrom(newDefaultFrom) {
            this.value[0] = newDefaultFrom
        },
        defaultTo(newDefaultTo) {
            this.value[1] = newDefaultTo
        },
        value(newValue) {
            this.$emit('change', newValue);
        },
        deep: true,
    },
};
</script>
