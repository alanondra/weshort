<script setup>
import { Link } from '@inertiajs/vue3';
</script>

<template>
	<header>
		<section>
			<h1><a href="/">Home</a></h1>
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
