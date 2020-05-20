<template>
    <v-list
        nav
        dense
        v-if="isLoaded"
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
    routes: [],
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
        path: '/login',
        name: 'Connexion',
        icon: 'mdi-account-circle',
      },
      {
        path: '/creer-compte',
        name: 'Création de compte',
        icon: 'mdi-account-plus',
      },
      {
        path: '/reset',
        name: 'Mot de passe oublié',
        icon: 'mdi-account-question',
      },
      {
        path: '/reset-password/:token',
        name: 'Redéfinir mot de passe',
        icon: 'mdi-account-convert',
      },
    ],
    isLoaded: false,
    isLogged: false,
  }),
  beforeMount() {
    window.axios.get('/me')
      .then(() => {
        // handles success
        this.isLogged = true;
        this.routes = this.authRoutes;
      })
      .catch(() => {
        // handles error
        this.isLogged = false;
        this.routes = this.notAuthRoutes;
      })
      .then(() => {
        // always run
        this.isLoaded = true;
      });
  },
};
</script>

<style scoped>

</style>
