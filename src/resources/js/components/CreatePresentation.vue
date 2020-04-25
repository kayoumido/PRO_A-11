<template>
  <v-container>
    <v-alert
    v-model="message.show"
    :class="message.type"
    dismissible
    >
      {{ message.content }}
    </v-alert>

    <h2>Creation de presentation</h2>
    <v-form
      ref="form"
      v-model="valid"
      lazy-validation
    >
      <v-text-field
        v-model="dataForm.title"
        :counter="20"
        :rules="titleRules"
        label="title"
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
            v-model="dataForm.date"
            label="Choose a date"
            :rules="dateRules"
            required
            readonly
            v-on="on"
          ></v-text-field>
        </template>
        <v-date-picker v-model="dataForm.date" @input="menu = false" ></v-date-picker>
      </v-menu>

      <v-btn
        :disabled="!valid"
        color="success"
        class="mr-4"
        @click="createPresentation()"
      >
        Create
      </v-btn>

    </v-form>
  </v-container>
</template>

<script>
import axios from 'axios';

export default {
  data: () => ({
    valid: true,
    titleRules: [
      (v) => !!v || 'Title is required',
      (v) => (v && v.length <= 20) || 'Name must be less than 10 characters',
    ],
    dateMenu: false,
    dateRules: [
      (v) => !!v || 'Must specify a date',
      // (v) => Date.parse(v) >= Date.now() || 'Must specify a valid date',
    ],
    dataForm: {
      date: new Date().toISOString().substr(0, 10),
      title: '',
    },
    // object for message management
    message: {
      show: false,
      content: '',
      type: '',
    },

  }),

  methods: {
    createPresentation() {
      /* -------------------------------------------------------
      For testing purpose theses value are hardcoded here */
      const userID = 1;
      const apiUrl = `api/v1/users/${userID}/presentations`;
      // -------------------------------------------------------

      if (!this.$refs.form.validate()) {
        return;
      }

      // send http request with axios and catch response or error
      axios.post(apiUrl, this.dataForm)
        .then((response) => {
          const newdata = response.data;
          this.showMessage('success', `you successfuly create the presentation : ${newdata.data.toISOString}`);
          this.$refs.form.reset();
        })
        .catch((errorResponse) => {
          this.showMessage('error', `error while sending data ${errorResponse}`);
        });
    },
    showMessage(type, content) {
      this.message.show = true;
      this.message.content = content;
      this.message.type = type;
    },
  },
};
</script>
<style>

</style>
