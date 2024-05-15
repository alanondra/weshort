import path from 'path';
import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';

export default defineConfig({
	plugins: [
		laravel({
			input: ['resources/css/app.css', 'resources/js/app.js'],
			refresh: true,
		}),
		vue(),
	],
	resolve: {
		alias: {
			'~': path.resolve(__dirname, 'node_modules'),
			'$': path.resolve(__dirname, 'resources/js/templates'),
		},
	},
	build: {
		outDir: 'public/build'
	}
});
