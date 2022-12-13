<template>
    <div>
        <div v-for="option in options" :key="option.value">
            <input
                :id="props.id + option.value"
                type="checkbox"
                :name="props.name"
                :value="option.value"
                @change="props.onChange"
                :checked="options.checked"
            />
            <label :for="props.id + option.value">
                {{ option.label }}
            </label>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        options: {
            // shape label, value, selected
            type: Object,
        },
        id: {
            type: String,
            required: true,
        },
        onChange: {
            //  function
        },
    },
};
</script>
