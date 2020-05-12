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

      <v-text-field
            v-model="updatePresentationInfo.date"
            label="Date"
      />

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
