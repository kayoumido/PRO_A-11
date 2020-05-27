<template>
<v-container>
    <v-btn
    icon
    @click="logOut">
        <v-icon>mdi-account-circle-outline</v-icon>
    </v-btn>
    </v-container>
</template>

<script>
import { mapActions, mapGetters } from 'vuex';

export default {
  name: 'UserTooltip',
  computed: {
    ...mapGetters({
      authenticated: 'auth/authenticated',
    }),
  },
  methods: {
    ...mapActions({
      signOut: 'auth/signOut',
    }),
    logOut() {
      this.signOut()
        .then(() => {
          this.$emit('success', 'Déconnecté');
          this.$router.replace({ name: 'Connexion' });
        })
        .catch(() => {
          this.$emit('error', 'Une erreur c\'est produite lors de la déconnexion');
        });
    },
  },
};
</script>
