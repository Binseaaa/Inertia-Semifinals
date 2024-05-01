<script setup>
    import MyLayout from '@/Layouts/MyLayout.vue';
    import { Link } from '@inertiajs/vue3';

    defineOptions({
        layout: MyLayout
    })
</script>
<template>
    <div class="m-12">
        <p class="text-5xl py-5">About Me</p>
        <hr class="h-0.5 my-8 border-0 dark:bg-black">
        <div class="text-left">
            <p class="text-2xl">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Molestias, dolore ullam et itaque impedit assumenda, aliquam atque eveniet corporis ut necessitatibus. Veritatis error, reiciendis dolor ea veniam debitis molestiae a!</p>
        </div>
        <div class="flex justify-evenly py-20">
            <button class="border border-black px-14 py-2 font-bold text-xl">Resume</button>
            <Link href="/portfolio" class="border border-black px-14 py-2 font-bold text-xl hover:text-white hover:border-white">Portfolio</Link>
        </div>
    </div>
</template>