<template>
    <div>
        <v-row>
            <v-col col="10">
                <SearchBar></SearchBar>
            </v-col>
        </v-row>
        <v-divider></v-divider>
        <v-row>
            <v-col>
                <v-btn
                    class="float-right"
                    text
                    color="success"
                    small
                    href="/presentation/creer">
                    Nouvelle présentation
                </v-btn>
            </v-col>
        </v-row>
        <v-row>
            <v-col
                v-for="(presentation) in presentations"
                :key="presentation.id"
                cols="12">
                <v-card outlined>
                    <v-list-item two-line>
                        <v-list-item-content>
                            <v-list-item-title
                                class="title">
                                <CustomFont>
                                    {{presentation.title}}
                                </CustomFont>
                            </v-list-item-title>
                            <v-list-item-subtitle>{{presentation.date}}</v-list-item-subtitle>
                        </v-list-item-content>
                        <v-list-item-action v-if="presentation.auth_user_role === 'presenter'">
                            <v-btn
                                color="warning"
                                @click.prevent="goToPresentationEdit(presentation.id)">
                                Modifier
                            </v-btn>
                        </v-list-item-action>
                        <v-list-item-action>
                            <v-btn
                                color="secondary"
                                @click.prevent="goToPresentation(presentation.id)">
                                Voir
                            </v-btn>
                        </v-list-item-action>
                    </v-list-item>
                </v-card>
            </v-col>
        </v-row>
    </div>
</template>

<script>
import { mapGetters } from 'vuex';
import SearchBar from './layout/SearchBar';
import CustomFont from './layout/CustomFont';

export default {
  components: { CustomFont, SearchBar },
  data() {
    return {
      presentations: [],
    };
  },
  computed: {
    ...mapGetters({
      user: 'auth/user',
    }),
  },
  beforeMount() {
    const apiUrl = `/users/${this.user.id}/presentations`;

    window.axios
      .get(apiUrl)
      .then((responsePresentation) => {
        this.presentations = responsePresentation.data;

        if (this.presentationsIsEmpty()) {
          this.$emit('info', 'Vous ne vous êtes inscrit à aucune presentation');
        }
      })
      .catch(() => {
        this.$emit('error', 'La recupération des presentations a échoué');
      });
  },
  methods: {
    presentationsIsEmpty() {
      return (this.presentations.length === 0);
    },
    goToPresentation(id) {
      this.$router.push({
        name: 'Présentation',
        params: { idPresentation: id },
      });
    },
    goToPresentationEdit(id) {
      this.$router.push({
        name: 'Edition de présentation',
        params: { idPresentation: id },
      });
    },
  },
};

</script>
