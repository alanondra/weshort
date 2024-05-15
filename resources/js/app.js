import './bootstrap';

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import DefaultLayout from './templates/Layouts/DefaultLayout.vue';

createInertiaApp({
	resolve: name => {
		const pages = import.meta.glob('./templates/Pages/**/*.vue', { eager: true });

		let page = pages[`./templates/Pages/${name}.vue`];

		page.default.layout ??= DefaultLayout;

		return page;
	},
	setup({ el, App, props, plugin }) {
		createApp({ render: () => h(App, props) })
			.use(plugin)
			.mount(el);
	},
});
