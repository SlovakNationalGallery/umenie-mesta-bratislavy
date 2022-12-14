<template>
    <div>
        <button @click="onOpenedFilterChange(name)">{{ label }}</button>
        <div v-if="isFilterOpened" v-click-away="onClickAway">
            <div @click.stop @touchstart.stop v-for="option in options" :key="option.value">
                <input
                    type="checkbox"
                    :id="id + option.value"
                    :name="name"
                    :value="option.value"
                    @change="onCheckboxChange"
                    :checked="option.checked"
                />
                <label :for="id + option.value">
                    {{ option.label }}
                </label>
            </div>
        </div>
    </div>
</template>

<script setup>
import { defineProps } from 'vue';
const props = defineProps([
    'options',
    'id',
    'name',
    'label',
    'isFilterOpened',
    'onCheckboxChange',
    'onOpenedFilterChange',
]);

const onClickAway = (event) => {
    props.onOpenedFilterChange(event.name);
};
</script>
