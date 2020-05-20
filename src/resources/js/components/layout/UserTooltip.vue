<template>
<v-container>
    <v-btn
    icon
    v-if="isLoaded"
    @click="beheavior">
        <v-icon>{{icon}}</v-icon>
    </v-btn>
    </v-container>
</template>

<script>
let alert = {};
export default {
  props: ['parentRefs'],
  name: 'UserTooltip',

  data() {
    return {
      icon: '',
      isLoaded: false,
      isLogged: false,
    };
  },
  beforeMount() {
    alert = this.parentRefs.alert; // without this line, there are "uncaught exception: Object"
    this.refresh()
      .then(() => {
        // is always called
        // this is only usefull when beforeMount is called
        this.isLoaded = true;
      });
  },
  beforeUpdate() {
    alert = this.parentRefs.alert;
  },
  methods: {
    beheavior() {
      this.refresh()
        .then(() => {
          if (this.isLogged) {
            // important, if I did not remove the token from the axios header,
            // the post /logout would make that token unuseable which
            // makes that token as effective as no token at all
            // this logic technically also applies to the token in local storage
            // I still do it for the logout error case
            localStorage.removeItem('Authorization-token'); // delete token from local storage

            window.axios.post(
              '/logout',
            )
              .then(() => {
                // expected behavior
                alert.showMessage('success', 'Déconnecté');
              })
              .catch(() => {
                // when this happens, the user will still be logged out,
                // but it's token will still be valid (if it was valid in the first place)
                // if his token was invalid (and managed to be logged in?) he'll be logged out
                // this should never happen normally
                alert.showMessage('error', 'Echec déconnexion');
              });
            this.$router.go(0);
          } else {
            // the user is not logged in, he'll be redirected to login page
            alert.showMessage('success', 'Redirection pour login');
            this.$router.push({ name: 'Connexion' });
          }
        });
    },

    refresh() {
      return window.axios.get('/me')
        .then(() => {
          // handles success
          this.icon = 'mdi-account-arrow-right';
          this.isLogged = true;
        })
        .catch(() => {
          // handles error
          this.icon = 'mdi-account-circle-outline';
          this.isLogged = false;
        });
    },
  },
};
</script>
