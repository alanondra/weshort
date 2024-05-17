<script setup>
import { Head, Link } from "@inertiajs/vue3";
import Visits from '$/Components/Lists/Visits.vue';

defineProps({
	model: {
		type: Object
	}
});
</script>

<template>
	<Head title="ShortLink Details"></Head>
	<section class="container py-4">
		<h2>ShortLink</h2>
		<dl class="row">
			<dt class="col-lg-1 col-md-3">Shortened</dt>
			<dd class="col-lg-4 col-md-9 mb-0"><Link :href="model.short_url">{{ model.short_url }}</Link></dd>
			<dt class="col-lg-1 col-md-3">Original</dt>
			<dd class="col-lg-6 col-md-9 mb-0"><Link :href="model.url">{{ model.url }}</Link></dd>
		</dl>
		<Visits :shortLink="model"/>
	</section>
</template>
