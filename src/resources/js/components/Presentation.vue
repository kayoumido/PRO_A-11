<template>

 <v-container>
     <v-alert
    v-model="message.show"
    :class="message.type"
    dismissible
    >
      {{ message.content }}
    </v-alert>

      <v-card
      class="mx-auto"
      max-width="344"
      >
      <v-list-item three-line>
        <v-list-item-content>
          <v-list-item-title class="headline mb-1">Titre</v-list-item-title>
          <v-list-item-subtitle>Sous-titre</v-list-item-subtitle>
        </v-list-item-content>

        <v-list-item-avatar
          tile
          size="80"
          color="grey"
        ></v-list-item-avatar>
      </v-list-item>

      <v-card-actions>
        <v-btn text>Button</v-btn>
        <v-btn text>Button</v-btn>
      </v-card-actions>
    </v-card>

    <!--div>
        <h4>title : {{ presentation.data.title }} </h4>
        <p>created on : {{ presentation.data.date }} </p>
    </div-->
  </v-container>
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
      // object for message management
      message: {
        show: false,
        content: '',
        type: '',
      },
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
