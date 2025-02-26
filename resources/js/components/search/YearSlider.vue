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
                type="text"
                pattern="[-]?[0-9]{1,4}"
                :value="immediateValue[0]"
                class="text-xs text-center w-14"
                @input="onMinInput"
                @change="onMinChange"
            />
            <input
                type="text"
                pattern="[-]?[0-9]{1,4}"
                :value="immediateValue[1]"
                class="text-xs text-center w-14"
                @input="onMinInput"
                @change="onMinChange"
            />
        </div>
        <button
            @click="resetValues"
            class="underline pt-4 text-xs"
        >
            Resetovať hodnoty
        </button>
    </div>
</template>

<script>
import Slider from '@vueform/slider';

export default {
    props: {
        min: Number,
        max: Number
    },
    components: {
        Slider,
    },
    emits: ['change', 'reset'],
    data() {
        return {
            value: [this.min, this.max],
            immediateValue: [this.min, this.max],
            sliderClasses: {
                target: 'relative box-border select-none touch-none tap-highlight-transparent touch-callout-none disabled:cursor-not-allowed',
                horizontal: 'slider-horizontal h-0.5',
                base: 'w-full h-full relative z-1 bg-gray-300 rounded',
                connect: 'absolute z-1 top-0 right-0 transform-origin-0 transform-style-flat h-full w-full bg-red-500 cursor-pointer',
                handle: 'absolute bg-red-500 rounded-full border-0 cursor-grab focus:outline-none w-6 h-6 -top-2.5 -right-2 focus:ring focus:ring-green-500 focus:ring-opacity-30',
                tooltipHidden: 'slider-tooltip-hidden',
                active: 'cursor-grabbing',
                draggable: 'cursor-ew-resize',
            },
        };
    },
    watch: {
        min(newMin) {
            this.value[0] = newMin;
            this.immediateValue[0] = newMin;
        },
        max(newMax) {
            this.value[1] = newMax;
            this.immediateValue[1] = newMax;
        },
        value: {
            handler(newValue) {
                this.immediateValue = newValue;
                this.$emit('change', newValue);
            },
            deep: true
        }
    },
    methods: {
        sanitizeInput(val) {
            const sanitized = val.replace(/[^-0-9]/g, '').replace(/(?!^)-/g, '');
            return sanitized !== '' && !isNaN(sanitized) ? Number(sanitized) : null;
        },
        onMinInput(e) {
            const sanitized = this.sanitizeInput(e.target.value);
            if (sanitized !== null) {
                this.immediateValue = [sanitized, this.immediateValue[1] ];
            }
        },
        onMaxInput(e) {
            const sanitized = this.sanitizeInput(e.target.value);
            if (sanitized !== null) {
                this.immediateValue[1] = sanitized;
            }
        },
        onMinChange(e) {
            const sanitized = this.sanitizeInput(e.target.value);
            if (sanitized === null || sanitized < this.min || sanitized > this.max) {
                this.value = [this.min, this.value[1]];
            } else {
                this.value = [sanitized, this.value[1]];
            }
        },
        onMaxChange(e) {
            const sanitized = this.sanitizeInput(e.target.value);
            if (sanitized === null || sanitized < this.min || sanitized > this.max) {
                this.value = [this.value[0], this.max];
            } else {
                this.value = [this.value[0], sanitized];
            }
        },
        resetValues() {
            this.value = [this.min, this.max];
            this.immediateValue = [this.min, this.max];
            this.$emit('reset');
        }
    }
};
</script>