import './bootstrap';

import { createApp } from 'vue/dist/vue.esm-bundler.js';
import axios from 'axios';
import { Notyf } from 'notyf';
import {Tabs, Tab} from 'vue3-tabs-component';
import moment from 'moment';
import 'notyf/notyf.min.css';

// Lead Components
import Kanban from './components/kanban/Kanban.vue';
import AddNewStage from './components/kanban/AddNewStage.vue';
import FindLeadManager from './components/manager/FindLeadManager.vue';
import FindManager from './components/manager/FindManager.vue';
import FindTrip from './components/trip/FindTrip.vue';
import ProductList from './components/lead_products/ProductList.vue';
import ProgressBar from './components/progessbar/ProgressBar.vue';
import EmailTo from './components/lead_view/EmailTo.vue';
import Participants from './components/lead_view/Participants.vue';

//Quotation
import leadmanager from './components/quotation/leadmanager.vue';
import leadname from './components/quotation/leadname.vue';
import addressvue from './components/quotation/Address.vue'
import manager from './components/quotation/manager.vue'
import quotaionitem from './components/quotation/quotationitems.vue'
import subject from './components/quotation/Subject.vue'
import description from './components/quotation/Description.vue'

//settings => Roles =>Permission
import permission from './components/settings/Permissions/Permissions.vue'
import list from './components/settings/Permissions/permissionlist.vue';

//Users
import selectrole from './components/User/selectrole.vue';
import imageupload from './components/User/image.vue';
import UserManager from './components/User/manager.vue';

//Mail
import mailto from './components/Mails/EmailTo.vue';
import attachment from './components/Mails/attachment.vue';

const app = createApp({});

app.component('KanbanBoard', Kanban)
    .component('AddNewStage', AddNewStage)
    .component('FindLeadManager', FindLeadManager)
    .component('FindManager', FindManager)
    .component('FindTrip', FindTrip)
    .component('ProductList', ProductList)
    .component('Tabs', Tabs)
    .component('Tab', Tab)
    .component('ProgressBar', ProgressBar)
    .component('EmailTo', EmailTo)
    .component('Participants', Participants)
    .component('leadmanager',leadmanager)
    .component('leadname',leadname)
    .component('addressvue',addressvue)
    .component('manager',manager)
    .component('quotaionitem',quotaionitem)
    .component('subject',subject)
    .component('description',description)
    .component('permission',permission)
    .component('list',list)
    .component('selectrole',selectrole)
    .component('usermanager',UserManager)
    .component('mailto',mailto)
    .component('attachment',attachment)
    .component('imageupload',imageupload)
    .mount('#app');

app.config.globalProperties.$http = axios;
window.notyf = new Notyf();

window.app = app;

app.use(moment);
app.config.globalProperties.$filters = {
    format(date) {
        return moment(date).format('l')
    },
}