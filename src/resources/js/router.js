import Vue from 'vue';
import VueRouter from 'vue-router';

import Hello from './components/Hello';
import newPresentation from './components/CreatePresentation';
import ListPresentations from './components/ListPresentations';
import Presentation from './components/Presentation';
import Authentication from './components/Authentication';
import AccountEdition from './components/AccountEdit';
import AccountCreation from './components/AccountCreation';

Vue.use(VueRouter);

const router = new VueRouter({
  mode: 'history',
  routes: [
    {
      path: '/',
      name: 'Hello',
      component: Hello,
    },
    {
      path: '/presentation',
      name: 'presentation',
      component: Presentation,
    },
    {
      path: '/presentation/creer',
      icon: 'mdi-help-box',
      name: 'newPresentation',
      component: newPresentation,
    },
    {
      name: 'Lister les Presentation',
      icon: 'mdi-help-box',
      path: '/presentations',
      component: ListPresentations,
    },
    {
      path: '/presentation/:idPresentation',
      name: 'presentation',
      icon: 'mdi-help-box',
      component: Presentation,
    },
    {
      path: '/login',
      name: 'Authentication',
      icon: 'mdi-help-box',
      component: Authentication,
    },
    {
      path: '/mon-compte/modifier/',
      name: 'Edition de compte',
      component: AccountEdition,
    },
    {
      path: '/register',
      name: 'AccountCreation',
      icon: 'mdi-help-box',
      component: AccountCreation,
    },
  ],
});

export default router;
