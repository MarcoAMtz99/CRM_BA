
import './bootstrap';
import { createApp } from 'vue';

import DataTable from 'datatables.net-vue3'
import Select from 'datatables.net-select';

DataTable.use(Select);

const app = createApp({});

// COMPONENTES PARA IMPORTAR

import ConsultComponent from './components/ConsultComponent.vue';
import CampaignComponent from './components/CampaignComponent.vue';
import ExampleComponent from './components/ExampleComponent.vue';
import DetailComponent from './components/DetailComponent.vue';

// CARGARLOS EN LA APP

app.component('consult-component', ConsultComponent);
app.component('campaign-component', CampaignComponent);
app.component('example-component', ExampleComponent);
app.component('detail-component', DetailComponent);





app.mount('#app');
