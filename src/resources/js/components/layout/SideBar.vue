<template>
    <v-list
        nav
        dense>
        <v-list-item href="/presentations">
            <v-list-item-icon>
                <v-icon>mdi-home</v-icon>
            </v-list-item-icon>
            <v-list-item-content>
                <v-list-item-title>Mes presentations</v-list-item-title>
            </v-list-item-content>
        </v-list-item>
        <v-list-item href="/mon-compte/modifier">
            <v-list-item-icon>
                <v-icon>mdi-account-outline</v-icon>
            </v-list-item-icon>
            <v-list-item-content>
                <v-list-item-title>Mon compte</v-list-item-title>
            </v-list-item-content>
        </v-list-item>
    </v-list>
</template>

<script>

import { mapGetters } from 'vuex';

export default {
  name: 'SideBar',
  computed: {
    ...mapGetters({
      authenticated: 'auth/authenticated',
    }),
  },
};
</script>
