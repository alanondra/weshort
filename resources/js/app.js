import './bootstrap';

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import { ZiggyVue } from 'ziggy-js';
import { Ziggy } from './vendor/ziggy';
import DefaultLayout from './templates/Layouts/DefaultLayout.vue';

const appName = window.config.app.name || 'WeShort';

createInertiaApp({
	title: title => `${title} - ${appName}`,
	resolve: name => {
		const pages = import.meta.glob('./templates/Pages/**/*.vue', { eager: true });

		let page = pages[`./templates/Pages/${name}.vue`];

		page.default.layout ??= DefaultLayout;

		return page;
	},
	setup({ el, App, props, plugin }) {
		createApp({ render: () => h(App, props) })
			.use(plugin)
			.use(ZiggyVue, Ziggy)
			.mount(el);
	},
});
