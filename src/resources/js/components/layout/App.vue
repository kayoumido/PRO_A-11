<template>
    <v-app>
        <v-navigation-drawer
            app
            permanent
            expand-on-hover
            color="primary"
            dark
            @transitionend="updateAppName"
            class="elevation-10"
            v-if="authenticated"
        >
            <v-list-item>
                <v-list-item-content>
                    <v-list-item-title class="title text-center font-weight-bold">
                        {{appName}}
                    </v-list-item-title>
                </v-list-item-content>
            </v-list-item>

            <v-divider></v-divider>

            <SideBar></SideBar>

            <template v-slot:append>
                <v-list-item @click="logOut">
                    <v-list-item-icon>
                        <v-icon>mdi-logout</v-icon>
                    </v-list-item-icon>
                    <v-list-item-content>
                        <v-list-item-title>Déconnexion</v-list-item-title>
                    </v-list-item-content>
                </v-list-item>
            </template>
        </v-navigation-drawer>

        <v-content>
                <AlertMessage ref="alert"></AlertMessage>
                <router-view
                    v-on:error="handleAlert('error', $event)"
                    v-on:success="handleAlert('success', $event)"></router-view>
        </v-content>
    </v-app>
</template>
<script>
import { mapActions, mapGetters } from 'vuex';
import SideBar from './SideBar';
import AlertMessage from './AlertMessage';

const appName = 'Paul';
const shortAppName = 'P.';
export default {
  data() {
    return {
      routeName: '',
      appName: shortAppName,
    };
  },
  computed: {
    ...mapGetters({
      authenticated: 'auth/authenticated',
    }),
  },
  components: {
    AlertMessage,
    SideBar,
  },
  methods: {
    ...mapActions({
      signOut: 'auth/signOut',
    }),
    logOut() {
      this.signOut()
        .then(() => {
          this.handleAlert('success', 'Déconnecté');
          this.$router.push({ name: 'Connexion' });
        })
        .catch(() => {
          this.handleAlert('error', 'Une erreur c\'est produite lors de la déconnexion');
        });
    },
    handleAlert(color, message) {
      this.$refs.alert.showMessage(color, message);
    },
    updateAppName() {
      if (this.appName === appName) this.appName = shortAppName;
      else this.appName = appName;
    },
  },
};
</script>
