import Vue from 'vue';
import VueRouter from 'vue-router';

import newPresentation from './components/CreatePresentation';
import ListPresentations from './components/ListPresentations';
import Presentation from './components/Presentation';
import Authentication from './components/Authentication';
import AccountEdition from './components/AccountEdit';
import AccountCreation from './components/AccountCreation';
import Reset from './components/Reset';
import ResetPassword from './components/ResetPassword';
import EditPresentation from './components/EditPresentation';

Vue.use(VueRouter);

const router = new VueRouter({
  mode: 'history',
  routes: [
    {
      path: '/presentation/creer',
      icon: 'mdi-help-box',
      name: 'Créer présentation',
      component: newPresentation,
    },
    {
      path: '/presentations',
      name: 'Lister les présentation',
      component: ListPresentations,
    },
    {
      path: '/presentation/:idPresentation',
      name: 'Présentation',
      component: Presentation,
    },
    {
      path: '/login',
      name: 'Connexion',
      component: Authentication,
    },
    {
      path: '/mon-compte/modifier',
      name: 'Edition de compte',
      component: AccountEdition,
    },
    {
      path: '/creer-compte',
      name: 'Création de compte',
      component: AccountCreation,
    },
    {
      path: '/reset',
      name: 'Mot de passe oublié',
      component: Reset,
    },
    {
      path: '/reset-password/:token',
      name: 'Redéfinir mot de passe',
      component: ResetPassword,
    },
    {
      path: '/presentation/modifier/:idPresentation',
      name: 'Edition de présentation',
      component: EditPresentation,
    },
  ],
});

export default router;
