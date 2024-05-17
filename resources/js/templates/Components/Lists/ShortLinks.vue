<script setup>
	import { ref, watch, onMounted } from 'vue';
	import { Head, Link } from '@inertiajs/vue3';
	import axios from 'axios';
	import moment from 'moment';
	import { range, debounce } from 'lodash-es';

	const props = defineProps({
		upload: {
			type: Object,
			required: true
		}
	});

	const count = ref(10);
	const page = ref(1);
	const pages = ref(0);
	const pageRange = ref([]);
	const total = ref(0);
	const items = ref([]);

	const pageNumbers = (currentPage, totalPages, pageSize) => {
		let startPage = Math.max(2, currentPage - Math.floor(pageSize / 2));
		let endPage = Math.min(totalPages - 1, startPage + pageSize - 1);

		if (currentPage > totalPages - Math.floor(pageSize / 2)) {
			startPage = Math.max(2, totalPages - pageSize + 1);
		}

		return range(startPage, endPage + 1);
	};

	const fetch = debounce(async (page, count) => {
		const query = new URLSearchParams({ page, count }).toString();

		try {
			const response = await axios.get(route('api.uploads.shortLinks.index', { upload: props.upload }) + `?${query}`);
			if (response.status >= 200 && response.status < 300) {
				const payload = response.data;

				pages.value = payload.last_page;
				total.value = payload.total;
				items.value = payload.data;
				pageRange.value = pageNumbers(page, pages.value, 5);
			} else {
				pages.value = 0;
				total.value = 0;
				items.value = [];
				pageRange.value = [];
			}
		} catch (error) {
			console.error('Error fetching data:', error);
			pages.value = 0;
			total.value = 0;
			items.value = [];
			pageRange.value = [];
		}
	}, 300);

	onMounted(() => {
		fetch(page.value, count.value);
	});

	watch(count, (newCount) => {
		page.value = 1;
	});

	watch(page, (newPage) => {
		fetch(newPage, count.value);
	});

	const prevPage = () => {
		if (page.value > 1) {
			page.value--;
		}
	};

	const nextPage = () => {
		if (page.value < pages.value) {
			page.value++;
		}
	};

	const goToPage = (p) => {
		page.value = p;
	};

	const formatDate = (date) => {
		return moment(date).format('LLLL');
	};
</script>

<template>
	<div class="card">
		<div class="card-body">
			<h3 class="card-title">ShortLinks</h3>
			<table class="table">
				<thead>
					<tr>
						<th scope="col">Shortened URL</th>
						<th scope="col">Original URL</th>
						<th scope="col">Created On</th>
						<th scope="col">Actions</th>
					</tr>
				</thead>
				<tbody>
					<tr v-for="(item, index) in items" :key="index">
						<td><Link :href="item.short_url">{{ item.short_url }}</Link></td>
						<td><Link :href="item.url">{{ item.url }}</Link></td>
						<td>{{ formatDate(item.created_at) }}</td>
						<td>
							<menu class="btn-group">
								<Link :href="route('shortLinks.show', {shortLink: item})" class="btn btn-primary" title="View Traffic"><i class="fa-solid fa-magnifying-glass-chart"></i></Link>
								<Link :href="route('shortLinks.destroy', {shortLink: item})" class="btn btn-danger" title="Delete"><i class="fa-solid fa-trash"></i></Link>
							</menu>
						</td>
					</tr>
				</tbody>
			</table>
			<nav v-if="pages > 1">
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
			</nav>
		</div>
	</div>
</template>
