<template>
<v-container>
    <v-btn icon
    @click="beheavior">
        <v-icon>{{yes}}</v-icon>
    </v-btn>
    <v-btn icon
    @click="update">
        <v-icon>mdi-menu</v-icon>
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
      // isLogged: ${this.isLogged},
      yes: '',
    };
  },
  beforeMount() {
    alert = this.parentRefs.alert;
    this.setLoggedUser(); // doesnt do this before this.update why?
    this.update();
    // eslint-disable-next-line no-console
    console.log('BeforeMount');
  },
  beforeUpdate() {
    alert = this.parentRefs.alert;
    this.setLoggedUser();
    this.update();
    // eslint-disable-next-line no-console
    console.log('BeforeUpdate');
  },
  methods: {
    beheavior() {
      // eslint-disable-next-line no-console
      console.log('update info to determine behavior');
      this.setLoggedUser();
      if (this.isLogged) {
        localStorage.removeItem('Authorization-token');

        window.axios.post(
          '/logout',
        )
          .then(() => {
            alert.showMessage('success', 'Déconnecté');
          })
          .catch(() => {
            alert.showMessage('error', 'Echec déconnexion');
          });

        // eslint-disable-next-line no-console
        console.log('update info to determine new icon');

        this.setLoggedUser(); // or any way to update the app as it doesn work

        this.update();
      } else {
        // eslint-disable-next-line no-console
        console.log('redirection');
        alert.showMessage('success', 'redirection pour login');
        this.update();
        this.$router.replace({ name: 'Connexion' });
      }
    },
    update() {
      if (this.isLogged) {
        this.yes = 'mdi-account-circle';
      } else {
        this.yes = 'mdi-account-circle-outline';
      }
      // eslint-disable-next-line no-console
      console.log('update (icon should have changed)');
    },

  },
};
</script>
