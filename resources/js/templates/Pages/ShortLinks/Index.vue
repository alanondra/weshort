<script setup>
	import { ref, watch, onMounted } from 'vue';
	import { Head, Link } from '@inertiajs/vue3';
	import moment from 'moment';

	defineProps({
		shortLinks: {
			type: Object
		}
	});

	const formatDate = (date) => {
		return moment(date).format('LLLL');
	};
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
		<table v-if="shortLinks.data.length != 0" class="table">
			<thead>
				<tr>
					<th scope="col">Shortened URL</th>
					<th scope="col">Original URL</th>
					<th scope="col">Created On</th>
					<th scope="col">Actions</th>
				</tr>
			</thead>
			<tbody>
				<tr :key="index" v-for="(shortLink, index) in shortLinks.data">
					<td><Link :href="shortLink.short_url">{{ shortLink.short_url }}</Link></td>
					<td><Link :href="shortLink.url">{{ shortLink.url }}</Link></td>
					<td>{{ formatDate(shortLink.created_at) }}</td>
					<td>
						<menu class="btn-group">
							<Link :href="route('shortLinks.show', {shortLink})" class="btn btn-primary" title="View Traffic"><i class="fa-solid fa-magnifying-glass-chart"></i></Link>
							<Link :href="route('shortLinks.destroy', {shortLink})" class="btn btn-danger" title="Delete"><i class="fa-solid fa-trash"></i></Link>
						</menu>
					</td>
				</tr>
			</tbody>
		</table>
		<!-- <nav v-if="pages > 1">
			<ul class="pagination">
				<li class="page-item" :class="{ active: page === 1 }">
					<a href="#" class="page-link" @click.prevent="goToPage(1)">1</a>
				</li>
				<li v-if="pageRange.length > 0 && pageRange[0] > 2" class="page-item">
					<a href="#" class="page-link" @click.prevent="prevPage()">...</a>
				</li>
				<li v-for="p in pageRange" :key="p" class="page-item" :class="{ active: page === p }">
					<a href="#" class="page-link" @click.prevent="goToPage(p)">{{ p }}</a>
				</li>
				<li v-if="pageRange.length > 0 && pageRange[pageRange.length - 1] < pages - 1" class="page-item">
					<a href="#" class="page-link" @click.prevent="nextPage()">...</a>
				</li>
				<li class="page-item" :class="{ active: page === pages }">
					<a href="#" class="page-link" @click.prevent="goToPage(pages)">{{ pages }}</a>
				</li>
			</ul>
		</nav> -->
	</section>
</template>
