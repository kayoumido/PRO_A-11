<template>
      <v-container
      v-if="isLoaded"
      >
      <v-row>
          <v-col>
              <h2>{{presentation.title}}</h2>
          </v-col>
      </v-row>
      <v-row>
          <v-col>
              <p>{{presentation.date}}</p>
          </v-col>
      </v-row>
      <v-row>
          <v-col>
            <v-btn
            v-if="isPresenter()"
            color="error"
            @click.prevent="delPresentation(presentation.id)">
              Supprimer
            </v-btn>
            <v-btn
                v-else-if="!isSubscribed"
                @click="subscribe"
                color="primary"
                >
                S'inscrire
            </v-btn>
            <v-btn
                v-else
                @click="unsubscribe"
                color="error">
                Se désincrire
            </v-btn>
          </v-col>
      </v-row>
      <Polls
        v-on:error="$emit('error', $event)"
        :user_id="user.id"
        :user_role="presentation.auth_user_role"
        :presentation_id="presentation.id"></Polls>

    </v-container>
</template>

<script>
import { mapGetters } from 'vuex';
import Polls from './Polls';

export default {
  components: { Polls },
  data() {
    return {
      isLoaded: false,
      isSubscribed: false,
      presentation: {},
      polls: [],
    };
  },
  watch: {
    /* For search presentation issue, watcher will look for route alteration
     * and launch code if there is. (eg. if we push the same route with other params)
     */
    $route() {
      this.getPresentation(this.$route.params.idPresentation);
    },
  },
  computed: {
    ...mapGetters({
      user: 'auth/user',
    }),
  },
  beforeMount() {
    this.getPresentation(this.$route.params.idPresentation);
    window.axios
      .get(`/users/${this.user.id}/presentations`)
      .then((subResponse) => {
        subResponse.data.forEach((pres) => {
          if (pres.id === this.presentation.id) {
            this.isSubscribed = true;
          }
        });
        this.isLoaded = true;
      });
  },
  methods: {
    subscribe() {
      window.axios
        .post(`/presentations/${this.presentation.id}/users/${this.user.id}`)
        .then(() => {
          this.$emit('success', 'Félicitations vous êtes maintenant inscrit à la présentation');
          this.isSubscribed = true;
        })
        .catch(() => {
          this.$emit('error', 'Oops une erreur c\'est produite lors de l\'inscription');
        });
    },
    unsubscribe() {
      window.axios
        .delete(`/presentations/${this.presentation.id}/users/${this.user.id}`)
        .then(() => {
          this.$emit('warning', 'Vous n\'êtes plus inscrit a cette présentation');
          this.isSubscribed = false;
        })
        .catch(() => {
          this.$emit('error', 'Oops une erreur c\'est produite lors de la désinscription');
        });
    },
    getPresentation(id) {
      const apiUrl = `/presentations/${id}`;
      window.axios
        .get(apiUrl)
        .then((presResponse) => {
          this.presentation = presResponse.data;
        })
        .catch(() => {
          this.$emit('error', 'Oops une erreur est survenue lors du traitement de votre demande');
        });
    },
    isPresenter() {
      return (this.presentation.auth_user_role === 'presenter');
    },
    delPresentation(id) {
      const apiUrl = `/presentations/${id}`;

      window.axios.delete(apiUrl)
        .then(() => {
          this.$emit('success', 'La presentation à été supprimé correctement');
          this.$router.push('/presentations');
        })
        .catch(() => {
          this.$emit('error', 'La tentative de suppression a échoué');
        });
    },
  },

};

</script>
