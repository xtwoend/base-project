/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import './bootstrap';
import { createApp } from 'vue';

const app = createApp({});

import VueSweetalert2 from 'vue-sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';
app.use(VueSweetalert2);

import ExampleComponent from './components/ExampleComponent.vue';
app.component('example-component', ExampleComponent);

import Workbench from './components/workbench.vue';
app.component('workbench', Workbench);

import BtnDelete from './components/Del.vue';
app.component('btn-remove', BtnDelete);

import IconSelect from './components/UI/IconSelect.vue';
app.component('icon-select', IconSelect);

app.mount('#app');
