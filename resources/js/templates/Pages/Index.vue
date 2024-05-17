<script setup>
import { Head } from '@inertiajs/vue3';
import CreateShortLink from '$/Components/Forms/ShortLinks/Create.vue';
import UploadShortLinks from '$/Components/Forms/ShortLinkUploads/Create.vue';
</script>

<template>
	<Head title="Home"/>
	<section class="container py-4">
		<h2>WeShort Link Shortener</h2>
		<div class="row">
			<div class="col-6">
				<CreateShortLink id="create"/>
			</div>
			<div class="col-6">
				<UploadShortLinks id="upload"/>
			</div>
		</div>
	</section>
</template>
