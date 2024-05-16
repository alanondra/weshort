<script setup>
import { Head } from '@inertiajs/vue3';
import CreateShortLink from '$/Components/Forms/ShortLinks/Create.vue';
</script>

<template>
	<Head title="Home"/>
	<section class="container py-4">
		<h2>WeShort Link Shortener</h2>
		<div class="row">
			<div class="col-6">
				<CreateShortLink id="create"/>
			</div>
		</div>
	</section>
</template>
