<script setup>
import { Head, Link } from "@inertiajs/vue3";
// import Visits from '$/Components/Lists/Visits.vue';

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
		<div class="card">
			<div class="card-body">
				<h3 class="card-title">Traffic</h3>

				<ul v-if="model.visits.length != 0" class="list-group">
					<li :key="index" v-for="(visit, index) in model.visits" class="list-group-item d-flex justify-content-between align-items-center">
						<details>
							<summary>
								{{ visit.created_at }}
							</summary>
							<dl class="row mt-3">
								<dt class="col">Timestamp</dt>
								<dd class="col">{{ visit.created_at }}</dd>
								<dt class="col">IP Address</dt>
								<dd class="col">{{ visit.ip_address }}</dd>
								<dt class="col">Mobile</dt>
								<dd class="col">{{ visit.is_mobile ? 'Y' : 'N' }}</dd>
								<dt class="col">Platform</dt>
								<dd class="col">{{ visit.platform }}</dd>
								<dt class="col">Browser</dt>
								<dd class="col">{{ visit.browser }}</dd>
							</dl>
						</details>
					</li>
				</ul>

				<!-- <Visits :shortLink="model.id"/> -->
			</div>
		</div>
	</section>
</template>
