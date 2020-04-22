<template>
  <div class="container">
    <div v-if="showMessage">
      <h3>{{ message }}</h3>
    </div>

    <div v-for="presentation in presentations.data" :key="presentation.id">
      <router-link
        :to="{ name : 'presentation',
              params : { idPresentation : presentation.id,
                         // will help generate url like /presentation/name
                         name : presentation.title,
                       }
              }"
        >
        {{ presentation.title }}
      </router-link>
    </div>

    <router-view></router-view>
  </div>
</template>

<script>

// eslint-disable-next-line import/no-extraneous-dependencies
import axios from 'axios';

export default {
  name: 'ListPresentations',
  props: ['parent'],
  data() {
    return {
      presentations: [],
      showMessage: false,
      message: '',
    };
  },
  beforeMount() {
    // const apiUrl = `/api/v1/users/${this.parent.loggedUser.id}/presentations`;
    const apiUrl = '/api/v1/users/1/presentations';


    axios
      .get(apiUrl)
      .then((response) => {
        this.presentations = response.data;
        if (this.presentationsIsEmpty()) {
          this.showMessage = true;
          this.message = 'you haven\'t subscribed to a presentation';
        }
      })
      .catch((error) => {
        this.showMessage = true;
        this.message = `error while sending data, code ${error.response.status}`;
      });
  },
  methods: {
    presentationsIsEmpty() {
      return (this.presentations.length === 0);
    },
  },
};

</script>
