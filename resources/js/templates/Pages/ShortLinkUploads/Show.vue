<script setup>
import { Head, Link } from '@inertiajs/vue3';
import ShortLinks from '$/Components/Lists/ShortLinks.vue';

defineProps({
	model: {
		type: Object
	}
});
</script>

<template>
	<Head title="Upload Details"></Head>
	<section class="container py-4">
		<h2>Upload</h2>
		<div class="row">
			<dl class="col">
				<dt>Filename</dt>
				<dd>{{ model.filename }}</dd>
			</dl>
			<dl class="col">
				<dt>Type</dt>
				<dd>{{ model.type }}</dd>
			</dl>
			<dl class="col">
				<dt>Size</dt>
				<dd>{{ model.size }}</dd>
			</dl>
		</div>
		<ShortLinks :upload="model"/>
	</section>
</template>
