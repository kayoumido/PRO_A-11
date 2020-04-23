<template>
  <v-container>
    <h2>Creation de presentation</h2>
    <v-form
      ref="form"
      v-model="valid"
      lazy-validation
    >
      <v-text-field
        v-model="name"
        :counter="5"
        :rules="nameRules"
        label="Name"
        required
      ></v-text-field>

      <v-menu
        v-model="dateMenu"
        :close-on-content-click="false"
        :nudge-right="40"
        transition="scale-transition"
        offset-y
        min-width="290px"
      >
        <template v-slot:activator="{ on }">
          <v-text-field
            v-model="date"
            label="Choose a date"
            :rules="dateRules"
            required
            readonly
            v-on="on"
          ></v-text-field>
        </template>
        <v-date-picker v-model="date" @input="menu = false" ></v-date-picker>
      </v-menu>

      <v-btn
        :disabled="!valid"
        color="success"
        class="mr-4"
        @click="validate"
      >
        Submit
      </v-btn>

      <v-btn
        color="error"
        class="mr-4"
        @click="reset"
      >
        Reset Form
      </v-btn>
    </v-form>
  </v-container>
</template>

<script>
export default {
  data: () => ({
    valid: true,
    name: '',
    nameRules: [
      (v) => !!v || 'Name is required',
      (v) => (v && v.length <= 10) || 'Name must be less than 10 characters',
    ],
    date: new Date().toISOString().substr(0, 10),
    dateMenu: false,
    dateRules: [
      (v) => !!v || 'Must specify a date',
      (v) => Date.parse(v) >= Date.now() || 'Must specify a valid date',
    ],

  }),

  methods: {
    validate() {
      this.$refs.form.validate();
    },
    reset() {
      this.$refs.form.reset();
    },
  },
};
</script>
<style>

</style>
