<script setup>
	import { useForm } from '@inertiajs/vue3'
	import { router } from '@inertiajs/vue3'

	const props = defineProps({
		id: {
			type: String,
			required: true
		}
	});

	const prefixed = (suffix) => {
		return `${props.id}-${suffix}`;
	};

	const form = useForm({
		url: null
	});
</script>

<template>
	<form :id="id" @submit.prevent="form.post(route('shortLinks.store'))">
		<h3>Create ShortLink</h3>
		<section class="mb-3">
			<label :for="prefixed('url')" class="form-label">URL</label>
			<div class="input-group">
				<span class="input-group-text"><i class="fa-solid fa-link"></i></span>
				<input required type="url" class="form-control" :id="prefixed('url')" v-model="form.url"/>
			</div>
			<div v-if="form.errors.url" class="text-danger">{{ form.errors.url }}</div>
		</section>
		<menu class="btn-group">
			<button type="submit" class="btn btn-primary" :disabled="form.processing">Create</button>
		</menu>
	</form>
</template>
