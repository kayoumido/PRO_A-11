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

                            <v-text-field
                                v-model="input.password"
                                :append-icon="showPassword ? 'mdi-eye' : 'mdi-eye-off'"
                                :type="showPassword ? 'text' : 'password'"
                                :rules="passwordRules"
                                @click:append="showPassword = !showPassword"
                                required
                                label="Nouveau mot de passe"
                            />
                        </v-form>
                    </v-card-text>
                    <v-card-actions>
                        <v-spacer></v-spacer>
                        <v-btn
                            color="success"
                            @click="resetPassword"
                        >
                            Modifier
                        </v-btn>
                    </v-card-actions>
                </v-card>
            </v-col>
        </v-row>
    </v-container>
</template>

<script>
export default {
  data() {
    return {
      token: null,
      // vuetify
      valid: true,
      emailRules: [
        (v) => (!!v && /^\w+([.-]?\w+)*@\w+([.-]?\w+)*(\.\w{2,})+$/.test(v)) || 'Adresse e-mail non valide',
      ],
      passwordRules: [
        (v) => !!v || 'Un mot de passe est nécessaire',
      ],
      showPassword: false,
      input: {
        email: '',
        password: '',
      },
    };
  },
  methods: {
    resetPassword() {
      window.axios.post(
        '/password/reset', {
          token: this.$route.params.token,
          email: this.input.email,
          password: this.input.password,
        },
      ).then(() => {
        this.$router.push({ name: 'Connexion' });
      })
        .catch(() => {
          this.$emit('error', 'Une erreur est survenue');
        });
    },
  },
};
</script>
