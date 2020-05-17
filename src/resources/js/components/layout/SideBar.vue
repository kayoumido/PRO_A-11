<template>
    <v-list
        nav
        dense
        v-if="isLoaded"
    >
        <v-container
            v-if="isLogged"
        >
            <v-list-item
                v-for="(route, i) in authRoutes"
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
        </v-container>
        <v-container
            v-else
        >
            <v-list-item
                v-for="(route, i) in notAuthRoutes"
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
        </v-container>
    </v-list>
</template>

<script>

export default {
  name: 'SideBar',
  data: () => ({
    authRoutes: [
      {
        name: 'Mes presentations',
        icon: 'mdi-presentation-play',
        path: '/presentations',
      },
      {
        name: 'Créer presentation',
        icon: 'mdi-folder-plus-outline',
        path: '/presentation/creer',
      },
    ],
    notAuthRoutes: [
      {
        name: 'Connexion',
        icon: 'mdi-account-circle',
        path: '/login',
      },
    ],
    isLoaded: false,
    isLogged: false,
  }),
  beforeMount() {
    window.axios.get('/me')
    // i need a way to know it's a success, but I don't actually care about the response
    // eslint-disable-next-line no-unused-vars
      .then((response) => {
        // handles success
        this.isLogged = true;
      })
      .catch(() => {
        // handles error
        this.isLogged = false;
      })
      .then(() => {
        this.isLoaded = true;
      });
  },
};
</script>

<style scoped>

</style>
