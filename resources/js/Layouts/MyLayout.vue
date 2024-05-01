<script setup>
    
</script>

<template>
    <div class="flex">
        <div class="h-screen min-w-[200px]">
            <div class="w-[35vw]">
                <img src="https://uploads.dailydot.com/2018/10/olli-the-polite-cat.jpg?auto=compress&fm=pjpg" alt="">
            </div>
            <div class="px-10 py-5">
                <p class="text-5xl py-2">Vince Deguma</p>
                <p class="text-5xl">(she/her)</p>
                <p class="text-3xl py-10 mb-32">Web Developer</p>
                <a href="/" class="bg-black text-white px-20 py-3 hover:bg-gray-500 shadow-lg shadow-gray-800/50 hover:bg-gray-800">EMAIL ME</a>        
            </div>
        </div> 
        <div class="flex flex-col flex-1 bg-blue-300">
            <div class="flex-1">
                <slot/>
            </div>
            <footer class="text-gray-500 text-center">
                Copyright &copy; 2024. Vince Softwares, Inc.
            </footer>
        </div>
    </div>
</template>