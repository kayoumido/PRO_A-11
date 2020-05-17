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
  props: ['parentRefs'],
  data() {
    return {
      routes: [

        {
          path: '/login',
          name: 'Connexion',
          icon: 'mdi-account-circle-outline',
        },
        {
          path: '/creer-compte',
          name: 'Création de compte',
          icon: 'mdi-account-circle-outline',
        },
        {
          path: '/reset',
          name: 'Mot de passe oublié',
          icon: 'mdi-account-circle-outline',
        },
        {
          path: '/reset-password/:token',
          name: 'Redéfinir mot de passe',
          icon: 'mdi-account-circle-outline',
        },
      ],
    };
  },
  methods: {

  },
};
</script>
