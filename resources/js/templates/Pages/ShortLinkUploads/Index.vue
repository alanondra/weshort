<script setup>
	import { Head, Link } from '@inertiajs/vue3';
	import moment from 'moment';

	defineProps({
		uploads: {
			type: Object
		}
	});

	const formatDate = (date) => {
		return moment(date).format('LLLL');
	};
</script>

<template>
	<Head title="Uploads"/>
	<section class="container py-4">
		<h2>Uploads</h2>
		<div v-if="uploads.data.length == 0" class="alert alert-info d-flex align-items-center" role="alert">
			<div class="me-2"><i class="fa-solid fa-magnifying-glass"></i></div>
			<div>
				There are currently no bulk ShortLink uploads.
				You should <Link :href="route('home')" class="alert-link">create some</Link> to start tracking.
			</div>
		</div>
		<table v-if="uploads.data.length != 0" class="table">
			<thead>
				<tr>
					<th scope="col">Created On</th>
					<th scope="col">File Name</th>
					<th scope="col">File Type</th>
					<th scope="col">File Size</th>
					<th scope="col">Actions</th>
				</tr>
			</thead>
			<tbody>
				<tr :key="index" v-for="(upload, index) in uploads.data">
					<td>{{ formatDate(upload.created_at) }}</td>
					<td>{{ upload.filename }}</td>
					<td>{{ upload.type }}</td>
					<td>{{ upload.size }}</td>
					<td>
						<menu class="btn-group">
							<Link :href="route('uploads.show', {upload})" class="btn btn-primary" title="View Traffic"><i class="fa-solid fa-magnifying-glass-chart"></i></Link>
							<Link :href="route('uploads.show', {upload})" class="btn btn-danger" title="Delete"><i class="fa-solid fa-trash"></i></Link>
						</menu>
					</td>
				</tr>
			</tbody>
		</table>
	</section>
</template>
