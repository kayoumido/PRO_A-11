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

Vue.use(VueRouter);

const notAuthenticatedOnly = (to, from, next) => {
  window.axios.get('/me')
    .then(() => {
      // handles success
      next({ name: 'Lister les présentation' }); // don't go to next
    })
    .catch(() => {
      // handles error
      next(); // go next
    });
};

const authenticatedOnly = (to, from, next) => {
  window.axios.get('/me')
    .then(() => {
    // handles success
      next(); // go pres
    })
    .catch(() => {
    // handles error
      next({ name: 'Connexion' }); // go login
    });
};

const rootRule = (to, from, next) => {
  window.axios.get('/me')
    .then(() => {
    // handles success
      next({ name: 'Lister les présentation' }); // go pres
    })
    .catch(() => {
    // handles error
      next({ name: 'Connexion' }); // go login
    });
};


const router = new VueRouter({
  mode: 'history',
  routes: [
    {
      path: '/',
      name: 'root',
      beforeEnter: rootRule,
    },
    {
      path: '/presentation/creer',
      icon: 'mdi-help-box',
      name: 'Créer présentation',
      component: newPresentation,
      beforeEnter: authenticatedOnly,
    },
    {
      path: '/presentations',
      name: 'Lister les présentation',
      component: ListPresentations,
      beforeEnter: authenticatedOnly,
    },
    {
      path: '/presentation/:idPresentation',
      name: 'Présentation',
      component: Presentation,
      beforeEnter: authenticatedOnly,
    },
    {
      path: '/login',
      name: 'Connexion',
      component: Authentication,
      beforeEnter: notAuthenticatedOnly,
    },
    {
      path: '/mon-compte/modifier',
      name: 'Edition de compte',
      component: AccountEdition,
      beforeEnter: authenticatedOnly,
    },
    {
      path: '/creer-compte',
      name: 'Création de compte',
      component: AccountCreation,
      beforeEnter: notAuthenticatedOnly,
    },
    {
      path: '/reset',
      name: 'Mot de passe oublié',
      component: Reset,
      beforeEnter: notAuthenticatedOnly,
    },
    {
      path: '/reset-password/:token',
      name: 'Redéfinir mot de passe',
      component: ResetPassword,
      beforeEnter: notAuthenticatedOnly,
    },
  ],
});

export default router;
