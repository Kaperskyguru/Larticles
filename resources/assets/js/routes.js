import Articles from "./components/Articles.vue";
import Single from './components/Single.vue';

export default[
    {path: '/', component: Articles},
    {path: '/blog/:id', component: Single, props: true}
]