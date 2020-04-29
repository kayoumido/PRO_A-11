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

export default {
  name: 'SideBar',
  data: () => ({
    routes: [
      {
        name: 'Mes presentations',
        icon: 'mdi-presentation-play',
        path: '/presentations',
      },
      {
        name: 'Créer presentation',
        icon: 'mdi-folder-plus-outline',
        path: '/presentations/nouveau',
      },
    ],
  }),
};
</script>

<style scoped>

</style>
