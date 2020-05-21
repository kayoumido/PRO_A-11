<template>
    <v-form
      ref="form"
      v-model="valid"
      lazy-validation
    >
      <v-text-field
        v-model="dataForm.title"
        :counter="20"
        :rules="titleRules"
        label="Titre"
        required
      />

      <v-datetime-picker
        label="Date et Heure"
        v-model="dataForm.date"
        :rules="dateRules"
        clearText="annuler"
      >
        <template slot="dateIcon">
          <v-icon>mdi-calendar</v-icon>
        </template>
        <template slot="timeIcon">
          <v-icon>mdi-clock</v-icon>
        </template>
      </v-datetime-picker>

      <v-btn
        :disabled="!valid"
        color="success"
        class="mr-4"
        @click="createPresentation()"
      >
        Créer la présentation
      </v-btn>

    </v-form>
</template>

<script>
import dateFormat from 'dateformat';

export default {
  data() {
    return {
      valid: true,
      titleRules: [
        (v) => !!v || 'Vous devez renseigner un titre',
        (v) => (v && v.length <= 20) || 'Le Nom doit contenir moins de 20 caractères',
      ],
      dateRules: [
        (v) => !!v || 'Vous devez renseigner une date',
      ],
      dataForm: {
        date: new Date(),
        title: '',
      },
    };
  },
  beforeMount() {
    this.setLoggedUser();
  },
  methods: {
    createPresentation() {
      const apiUrl = `/users/${this.loggedUser.id}/presentations`;

      // force date validation
      if (!this.$refs.form.validate()) {
        return;
      }

      // send http request with axios and catch response or error
      window.axios.post(apiUrl, {
        title: this.dataForm.title,
        date: dateFormat(this.dataForm.date, 'yyyy-mm-dd HH:MM'),
      })
        .then((response) => {
          this.$emit('success', `La présentation ${response.data.title} a été correctement créée`);
          this.$refs.form.reset();
        })
        .catch((errorResponse) => {
          this.$emit('error', `erreur lors de l'envoie des données ${errorResponse}`);
        });
    },
  },
};
</script>
