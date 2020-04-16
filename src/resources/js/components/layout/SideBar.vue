<template>
    <v-list
        nav
        dense
    >
        <v-list-item
            v-for="(route, i) in routes"
            :key="i"
            :href="route.path"
        >
            <v-list-item-icon>
                <v-icon>{{ route.icon }}</v-icon>
            </v-list-item-icon>
            <v-list-item-content>
                <v-list-item-title v-text="route.name"></v-list-item-title>
            </v-list-item-content>
        </v-list-item>
    </v-list>
</template>

<script>
    import {router} from "../../router";

    export default {
        name: "SideBar",
        data: () => ({
            routes: router.options.routes,
        })
    }
</script>

<style scoped>

</style>
