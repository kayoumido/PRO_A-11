<template>
    <v-form
        ref="form"
        v-model="valid"
        lazy-validation
    >
      <v-text-field
            v-model="input.email"
            :rules="emailRules"
            required
            label="Adresse email"
      />

      <v-btn
            :disabled="!valid"
            color="success"
            class="mr-4"
            @click="reset"
            >
            Envoyer email
      </v-btn>
    </v-form>
</template>

<script>
export default {
  name: 'Reset',
  props: ['parentRefs'],
  data() {
    return {
      // vuetify
      valid: true,
      emailRules: [
        (v) => (!!v && /^\w+([.-]?\w+)*@\w+([.-]?\w+)*(\.\w{2,})+$/.test(v)) || 'Adresse e-mail non valide',
      ],
      input: {
        email: '',
      },
    };
  },
  methods: {
    reset() {
      window.axios.post(
        '/password/send-reset-email', {
          email: this.input.email,
        },
      ).then(() => {
        this.$emit('information', 'Un email vous a été envoyé avec les instructions nécessaires');
      })
        .catch((error) => {
          this.$emit('error', `Erreur de type : ${error}`);
        });
    },
  },
};
</script>
