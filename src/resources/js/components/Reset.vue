<template>
    <v-container
        fluid>
        <v-row
            align="center"
            justify="center">
            <span class="text-center display-4" style="color: #5BDC8E">Paul</span>
        </v-row>
        <v-row
            align="center"
            justify="center"
            class="my-5"
        >
            <v-col
                cols="12"
                sm="8"
                md="4">
                <v-card
                    class="elevation-12 pa-4">
                    <v-toolbar
                        flat
                    >
                        <v-toolbar-title>Récupération de mot de passe</v-toolbar-title>
                    </v-toolbar>
                    <v-card-text>
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
                        </v-form>
                    </v-card-text>
                    <v-card-actions>
                        <v-btn
                            text
                            small
                            color="secondary"
                            href="/login"
                        >
                            Se connecter
                        </v-btn>
                        <v-spacer></v-spacer>
                        <v-btn
                            color="success"
                            @click="reset"
                        >
                            Envoyer email
                        </v-btn>
                    </v-card-actions>
                </v-card>
            </v-col>
        </v-row>
    </v-container>
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
      window.axios.post('/password/send-reset-email', this.input)
        .then(() => {
          this.$emit('success', 'Un email vous a été envoyé avec les instructions nécessaires');
          this.input.email = '';
        })
        .catch(() => {
          this.$emit('error', 'Une erreur est survenue');
        });
    },
  },
};
</script>
