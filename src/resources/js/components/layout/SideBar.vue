<template>
    <v-list
        nav
        dense>>
        <template v-if="authenticated">
            <v-list-item href="/presentations">
                <v-list-item-icon>
                    <v-icon>mdi-presentation-play</v-icon>
                </v-list-item-icon>
                <v-list-item-content>
                    <v-list-item-title>Mes presentations</v-list-item-title>
                </v-list-item-content>
            </v-list-item>
            <v-list-item href="/presentation/creer">
                <v-list-item-icon>
                    <v-icon>mdi-folder-plus-outline</v-icon>
                </v-list-item-icon>
                <v-list-item-content>
                    <v-list-item-title>Créer presentation</v-list-item-title>
                </v-list-item-content>
            </v-list-item>
        </template>
        <template v-else>
            <v-list-item href="/login">
                <v-list-item-icon>
                    <v-icon>mdi-account-circle</v-icon>
                </v-list-item-icon>
                <v-list-item-content>
                    <v-list-item-title>Connexion</v-list-item-title>
                </v-list-item-content>
            </v-list-item>
            <v-list-item href="/creer-compte">
                <v-list-item-icon>
                    <v-icon>mdi-account-plus</v-icon>
                </v-list-item-icon>
                <v-list-item-content>
                    <v-list-item-title>Création de compte</v-list-item-title>
                </v-list-item-content>
            </v-list-item>
            <v-list-item href="/reset">
                <v-list-item-icon>
                    <v-icon>mdi-account-question</v-icon>
                </v-list-item-icon>
                <v-list-item-content>
                    <v-list-item-title>Mot de passe oublié</v-list-item-title>
                </v-list-item-content>
            </v-list-item>
        </template>
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
