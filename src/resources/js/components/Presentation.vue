<template>
  <!--v-container-->
  <div class="container">
     <div v-if="isError" class="error">
          <h3>{{ message }}</h3>
     </div>

     <h3>Presentation info</h3>
     <div>
          <h4>title : {{ presentation.data.title }} </h4>
          <p>created on : {{ presentation.data.date }} </p>
     </div>
  </div>
  <!--/v-container-->
</template>

<script>
import axios from 'axios';

export default {
  name: 'Presentation',
  props: ['idPresentation'], // we will send the id of the presentation through props
  data() {
    return {
      presentation: {},
      polls: [],
      isError: false,
      message: '',
    };
  },
  beforeMount() {
    // const apiUrl = `api/v1/presentations/${idPresentation}`;
    const apiUrl = 'api/v1/presentations/1';

    axios
      .get(apiUrl)
      .then((response) => {
        this.presentation = response.data;
      })
      .catch((error) => {
        this.isError = true;
        this.message = `an error has occured while sending the data ${error}`;
      });
  },
};

</script>
