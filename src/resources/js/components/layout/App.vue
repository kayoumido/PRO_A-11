<template>
    <v-app>
        <v-navigation-drawer
            app
            permanent
            expand-on-hover
            color="primary"
            dark
            mini-variant-width="80"
            class="elevation-10"
            @transitionend="updateAppName"
            v-if="authenticated"
        >
            <v-list-item>
                <v-list-item-content>
                    <v-list-item-title class="title text-center">
                        <CustomFont class="display-2">
                            {{appName}}
                        </CustomFont>
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
            <v-container>
                <router-view
                    v-on:error="handleAlert('error', $event)"
                    v-on:success="handleAlert('success', $event)"></router-view>
                <v-snackbar
                    v-model="snackbar"
                    :color="snackColor"
                >
                    {{ snackText }}
                    <v-btn
                        dark
                        icon
                        @click="snackbar = false"
                    >
                        <v-icon>mdi-close</v-icon>
                    </v-btn>
                </v-snackbar>
            </v-container>
        </v-content>
    </v-app>
</template>
<script>
import { mapActions, mapGetters } from 'vuex';
import SideBar from './SideBar';
import CustomFont from './CustomFont';

const appName = 'Paul.';
const shortAppName = 'P.';
export default {
  data() {
    return {
      routeName: '',
      appName: shortAppName,
      snackbar: false,
      snackText: '',
      snackColor: 'primary',
    };
  },
  computed: {
    ...mapGetters({
      authenticated: 'auth/authenticated',
    }),
  },
  components: {
    CustomFont,
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
      this.snackColor = color;
      this.snackText = message;
      this.snackbar = true;
    },
    updateAppName() {
      if (this.appName === appName) this.appName = shortAppName;
      else this.appName = appName;
    },
  },
};
</script>
