<script setup>
import { ref } from 'vue';
import { Link } from '@inertiajs/vue3';

const appName = ref(window.config.app.name || 'WeShort');
</script>

<template>
	<header>
		<nav class="navbar navbar-expand-lg navbar-dark bg-primary bg-gradient">
			<div class="container">
				<Link class="navbar-brand" :href="route('home')">{{ appName }}</Link>
				<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse" id="navbarSupportedContent">
					<ul class="navbar-nav me-auto mb-2 mb-lg-0">
						<li class="nav-item">
							<Link class="nav-link" :href="route('shortLinks.index')">ShortLinks</Link>
						</li>
					</ul>
				</div>
			</div>
		</nav>
	</header>
	<main>
		<slot/>
	</main>
</template>
