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
import NotAuthHome from './components/NotAuthHome';

Vue.use(VueRouter);

const notAuthenticatedOnly = (to, from, next) => {
  // eslint-disable-next-line no-console
  console.log('notAuthOnly');
  window.axios.get('/me')
    .then(() => {
      // handles success
      // this was supposed to bring the user back to its previous "page"
      // but our previous "page" is always just the root
      // this is not a problem
      next(false); // don't go to next
    })
    .catch(() => {
      // handles error
      next(); // go next
    });
};

const authenticatedOnly = (to, from, next) => {
  // eslint-disable-next-line no-console
  console.log('authOnly');
  window.axios.get('/me')
    .then(() => {
    // handles success
      next(); // go next
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
    {
      path: '/home',
      name: 'Accueil',
      component: NotAuthHome,
      beforeEnter: notAuthenticatedOnly,
    },
  ],
});

export default router;
