<script setup>
import Navbar from "./components/common/Navbar.vue";
</script>

<template>
    <Navbar />
    <router-view v-slot="{ Component, route }">
        <div :key="route.name">
            <Component :is="Component" />
        </div>
    </router-view>
</template>

