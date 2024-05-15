<script setup>
import { Link } from '@inertiajs/vue3';
</script>

<template>
	<header>
		<section>
			<h1><Link :href="route('home')">WeShort</Link></h1>
			<nav>
				<ul>
					<li><Link href="#">Shorten</Link></li>
					<li><Link href="#">Analytics</Link></li>
				</ul>
			</nav>
		</section>
	</header>
	<main>
		<slot/>
	</main>
</template>
