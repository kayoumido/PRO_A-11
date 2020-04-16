<template>
  <div class="container">
    <div v-if="isError" class="error">
      <h3>{{ message }}</h3>
    </div>

    <h3>Presentation info</h3>

    <div v-for="(value, name) in presentation" :key="name">{{ name }} : {{ value }}</div>
  </div>
</template>

<script>
import axios from "axios";

export default {
  name: "Presentation",
  props: ["idPresentation"], // we will send the id of the presentation through props
  data() {
    return {
      presentation: {},
      polls: [],
      isError: false,
      message: ""
    };
  },
  beforeMount() {
    this.getPresentationInfo();
  },
  methods: {
    getPresentationInfo() {
      //const id = idPresentation;
      const id = 1;
      const apiUrl = "api/v1/presentations/aaa" + id;

      axios
        .get(apiUrl)
        .then(response => {
          this.presentation = response.data.data;
        })
        .catch(error => {
          this.isError = true;
          this.message = "an error has occured while sending the data";
        });
    }
  }
};
</script>