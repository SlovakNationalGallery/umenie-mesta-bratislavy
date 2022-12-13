<template>
    <div>
        <button @click="onLabelClick(name)">{{ label }}</button>
        <div
            v-if="isFilterOpened"
            v-for="option in options"
            :key="option.value"
        >
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
    'onLabelClick',
]);
</script>
