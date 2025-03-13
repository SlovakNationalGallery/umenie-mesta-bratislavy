<template>
    <transition
    enter-from-class="opacity-0"
    leave-to-class="opacity-0"
    enter-active-class="transition-all ease-out duration-100"
    leave-active-class="transition-all ease-out duration-100"
    >
        <slot />
    </transition>
</template>