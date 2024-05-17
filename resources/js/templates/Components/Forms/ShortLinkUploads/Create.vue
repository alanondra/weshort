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
		file: null
	});
</script>

<template>
	<form :id="id" @submit.prevent="form.post(route('uploads.store'))">
		<h3>Upload ShortLinks</h3>
		<section class="mb-3">
			<label :for="prefixed('file')" class="form-label">File</label>
			<div class="input-group">
				<input required @input="form.file = $event.target.files[0]" type="file" class="form-control" :id="prefixed('file')" :aria-describedby="prefixed('file-hint')" accept="text/csv,text/plain"/>
				<span class="input-group-text"><i class="fa-solid fa-paperclip"></i></span>
			</div>
			<div class="form-text" :id="prefixed('file-hint')">
				<strong>Accepted file types:</strong>
				*.csv and *.txt (1 mb max)
			</div>
			<div v-if="form.errors.file" class="text-danger">{{ form.errors.file }}</div>
		</section>
		<menu class="btn-group">
			<button type="submit" class="btn btn-primary">Upload</button>
		</menu>
	</form>
</template>
