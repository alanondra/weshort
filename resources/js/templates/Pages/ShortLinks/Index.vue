<script setup>
import { Head, Link } from '@inertiajs/vue3';

defineProps({
	shortLinks: {
		type: Object
	}
});
</script>

<template>
	<Head title="ShortLinks"/>
	<section class="container py-4">
		<h2>ShortLinks</h2>
		<div v-if="shortLinks.data.length == 0" class="alert alert-info d-flex align-items-center" role="alert">
			<div class="me-2"><i class="fa-solid fa-magnifying-glass"></i></div>
			<div>
				There are currently no shortlinks created.
				You should <Link :href="route('home')" class="alert-link">create some</Link> to start tracking.
			</div>
		</div>
		<ul v-if="shortLinks.data.length != 0" class="list-group">
			<li :key="index" v-for="(shortLink, index) in shortLinks.data" class="list-group-item d-flex justify-content-between align-items-center">
				<dl class="row mb-0">
					<dt class="col">Shortened</dt>
					<dd class="col mb-0"><Link :href="shortLink.short_url">{{ shortLink.short_url }}</Link></dd>
					<dt class="col">Original</dt>
					<dd class="col mb-0"><Link :href="shortLink.url">{{ shortLink.url }}</Link></dd>
				</dl>
				<menu class="btn-group">
					<Link :href="route('shortLinks.show', {shortLink})" class="btn btn-primary" title="View Traffic"><i class="fa-solid fa-magnifying-glass-chart"></i></Link>
					<Link :href="route('shortLinks.show', {shortLink})" class="btn btn-danger" title="Delete"><i class="fa-solid fa-trash"></i></Link>
				</menu>
			</li>
		</ul>
	</section>
</template>
