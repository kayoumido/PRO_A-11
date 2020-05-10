<template>
    <v-btn icon
    @click="beheavior">
        <v-icon v-if="this.isLogged">mdi-account-circle</v-icon>
        <v-icon v-else>mdi-account-circle-outline</v-icon>
    </v-btn>
</template>

<script>
export default {
  props: ['parentRefs'],
  name: 'UserTooltip',

  data() {
    return {
      // isLogged: ${this.isLogged},
    };
  },
  beforeMount() {
    this.setLoggedUser();
  },
  beforeUpdate() {
    this.setLoggedUser();
  },
  methods: {
    beheavior() {
      if (this.isLogged) {
        localStorage.removeItem('Authorization-token');
        this.setLoggedUser(); // or any way to update the app as it doesn work
      } else {
        this.$router.replace({ name: 'Connexion' });
      }
    },

  },
};
</script>
