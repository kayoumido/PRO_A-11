<template>
  <div class="container">
     <div v-if="isError" class="error">
          <h3>{{ message }}</h3>
     </div>

     <h3>Presentation info</h3>
     <div>
          <h4>title : {{ presentation.title }} </h4>
          <p>created on : {{ formatDate(presentation.date) }} </p>
     </div>

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
      message: ''
    };
  },
  beforeMount() {

    const apiUrl = `api/v1/presentations/${idPresentationd}`;

    axios
      .get(apiUrl)
      .then((response) => {
        this.presentation = response.data.data;
      })
      .catch((error) => {
        this.isError = true;
        this.message = "an error has occured while sending the data";
      });
  },
  methods: {
    formatDate(dateString){
         /**
          * formatting date
          * https://codehandbook.org/javascript-date-format/
          */
         let currentDate = new Date(dateString);
         let formatted_date = currentDate.getFullYear() + "-" + (currentDate.getMonth() + 1) + "-" + currentDate.getDate();
         return formatted_date;
    }
  }
};
</script>