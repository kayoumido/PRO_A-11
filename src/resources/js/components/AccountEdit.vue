<template>

  <v-form
    ref="form"
    lazy-validation
  >
    <v-text-field
      v-model="form.fname"
      :counter="10"
      :rules="nameRules"
      label="Prenom"
    />

    <v-text-field
      v-model="form.lname"
      :counter="10"
      :rules="nameRules"
      label="Nom"
    />

    <v-text-field
      v-model="form.email"
      :rules="emailRules"
      label="E-mail"
    />

    <v-btn
      color="success"
      class="mr-4"
      @click="submitChange"
    >
      Appliquer
    </v-btn>

  </v-form>
</template>

<script>
import { mapActions, mapGetters } from 'vuex';

export default {
  data() {
    return {
      nameRules: [
        (v) => v === '' || v.length <= 10 || 'Le nom doit contenir moins de 10 caractères',
      ],
      emailRules: [
        (v) => v === '' || /^\w+([.-]?\w+)*@\w+([.-]?\w+)*(\.\w{2,})+$/.test(v) || 'l\'E-mail doit être valide',
      ],
      form: {
        fname: '',
        lname: '',
        email: '',
      },
      changed: {},
    };
  },
  computed: {
    ...mapGetters({
      user: 'auth/user',
    }),
  },
  mounted() {
    this.form = JSON.parse(JSON.stringify(this.user));
  },
  methods: {
    ...mapActions({
      updateUser: 'auth/updateUser',
    }),
    submitChange() {
      // eslint-disable-next-line no-console
      console.log('before: ', this.form, this.changed);
      this.prepareData();
      // eslint-disable-next-line no-console
      console.log('after: ', this.form, this.changed);
      this.updateUser(this.changed)
        .then(() => {
          this.$emit('success', 'Changement appliqué');
        })
        .catch(() => {
          this.$emit('error', 'Une erreur c\'est produite lors de l\'envois des données');
        })
        .then(() => {
          this.form = JSON.parse(JSON.stringify(this.user));
          this.changed = {};
        });
    },
    prepareData() {
      if (this.form.lname !== this.user.lname) this.changed.lname = this.form.lname;
      if (this.form.fname !== this.user.fname) this.changed.fname = this.form.fname;
      if (this.form.email !== this.user.email) this.changed.email = this.form.email;
    },
  },
};
</script>
