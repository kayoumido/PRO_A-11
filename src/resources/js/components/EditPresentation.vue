<template>
    <v-form
        ref="form"
        v-model="valid"
        lazy-validation
    >
      <v-text-field
            v-model="updatePresentationInfo.title"
            :rules="titleRules"
            label="Titre"
      />

      <v-datetime-picker
        label="Date et Heure"
        v-model="updatePresentationInfo.date"
        clearText="annuler"
      >
        <template slot="dateIcon">
          <v-icon>mdi-calendar</v-icon>
        </template>
        <template slot="timeIcon">
          <v-icon>mdi-clock</v-icon>
        </template>
      </v-datetime-picker>

      <v-btn
            :disabled="!valid"
            color="success"
            class="mr-4"
            @click="submitChange"
            >
            Appliquer
      </v-btn>
    </v-form>
</template>

<script>
  let alert = {};
  export default {
    props: ['parentRefs'],
    data() {
      return {
        valid: true,
        titleRules: [
          (v) => v === '' || (v && v.length <= 20) || 'Le titre doit contenir moins de 20 caractères',
        ],
        updatePresentationInfo: {
          date: null,
          title: '',
       },
      };
    },
    beforeMount() {    
      alert = this.parentRefs.alert;
    },
    methods: {
      submitChange() {
        const data = this.updatePresentationInfo;
        const apiUrl = `presentations/${this.$route.params.idPresentation}`;

        // sends credentials to backend
        window.axios.put(apiUrl, data)
        .then((response) => {
          alert.showMessage('success', 'Les informations de la présentation ont été modifiées');
         })
        .catch((error) => {
        alert.showMessage('error', `Nous n'avons pas réussi à appliquer les changements`);
        });
      },
      isEmpty(textInput) {
        return (textInput === '');
      },
    },
  };
</script>
