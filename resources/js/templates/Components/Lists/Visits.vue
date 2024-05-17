
<script setup>
	import { ref, watch, onMounted } from 'vue';
	import axios from 'axios';
	import moment from 'moment';
	import { range, debounce } from 'lodash-es';

	const props = defineProps({
		shortLink: {
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
			const response = await axios.get(route('api.shortlinks.visits.index', { shortLink: props.shortLink }) + `?${query}`);
			if (response.status >= 200 && response.status < 300) {
				const payload = response.data;
				console.log(payload);

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
		fetch(page.value, newCount);
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
			<h3 class="card-title">Traffic</h3>
			<table class="table">
				<thead>
					<tr>
						<th scope="col">Created On</th>
						<th scope="col">IP Address</th>
						<th scope="col">Device Type</th>
						<th scope="col">Platform</th>
					</tr>
				</thead>
				<tbody>
					<tr v-for="(item, index) in items" :key="index">
						<td>{{ formatDate(item.created_at) }}</td>
						<td>{{ item.ip_address }}</td>
						<td>{{ item.device_type }}</td>
						<td>{{ item.platform }}</td>
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
