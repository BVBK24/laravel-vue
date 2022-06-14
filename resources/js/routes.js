import indexPage from './components/indexPage.vue';
import updatePage from './components/updatePage.vue';
import createPage from './components/createPage.vue';
// import { component } from 'vue/types/umd';

export const routes=[{
    name:'indexPage',
    path:'/laravu',
    component:indexPage
},

{
    name:'createPage',
    path:'/laravu/create',
    component:createPage
},

{
    name:'updatePage',
    path:'/laravu/update/:cid',
    component:updatePage
}];