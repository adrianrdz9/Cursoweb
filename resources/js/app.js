
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

const files = require.context('./', true, /\.vue$/i);
files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

import { Datetime } from 'vue-datetime';
import 'vue-datetime/dist/vue-datetime.css'
import CKEditor from '@ckeditor/ckeditor5-vue';

Vue.component('datetime', Datetime);
Vue.use( CKEditor );

var moment = require('moment');
moment.locale('es_MX')

window.moment = moment;

import 'vue-event-calendar/dist/style.css'
import vueEventCalendar from 'vue-event-calendar'
Vue.use(vueEventCalendar, {locale: 'es'})

$(document).ready(()=>{

	var uploadUrl = "https://39866.cke-cs.com/easyimage/upload/";
	var tokenUrl = "https://39866.cke-cs.com/token/dev/WqT7oYJ8EhNCRBLGcxzB0cyE2hWkbebmuwtZptH845pyeADlm307ytkc75Ij";

    new Promise((res, rej)=>{
        while(!document.body){}
        
        if(document.querySelector( '#description' )) {
            ClassicEditor
                .create( 
                    document.querySelector( '#description' ),
                    {
                        cloudServices: {
                            uploadUrl,
                            tokenUrl
                        }
                    }
                )
        }

        if(document.querySelector( '#evaluation' )) {
            ClassicEditor
                .create( 
                    document.querySelector( '#evaluation' ),
                    {
                        cloudServices: {
                            uploadUrl,
                            tokenUrl
                        }
                    }
                )
        }

        if(document.querySelector( '#comment' )) {
            ClassicEditor
                .create( 
                    document.querySelector( '#comment' ),
                    {
                        cloudServices: {
                            uploadUrl,
                            tokenUrl
                        }
                    }
                )
        }
    });
});

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app'
});
