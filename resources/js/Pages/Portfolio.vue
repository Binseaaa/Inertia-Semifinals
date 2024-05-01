<script setup>
    import { useForm } from '@inertiajs/vue3'
    import { ref } from 'vue';
    import MyLayout from '@/Layouts/MyLayout.vue';
    
    defineOptions({
        layout: MyLayout
    })

    const props = defineProps({
        portfolio: Array
    })

    const showCreateModal = ref(false); 
    const deletePortfolioId = ref(null);
    const showDeleteModal = ref(false); 

    const toggleDeleteModal = (show, portfolioId = null) => {
    showDeleteModal.value = show;
    if (show) {
        deletePortfolioId.value = portfolioId;
    } else {
        deletePortfolioId.value = null;
    }
    }

    const delPort = () => {
        const delForm = useForm({
            id: deletePortfolioId.value
        });
        delForm.submit('delete', `/portfolio/${deletePortfolioId.value}`, {
            preserveScroll: true
        });
        toggleDeleteModal(false);
    }

    const form = useForm({
        name: '',
        description: '',
        img: ''
    })

    const handleImageChange = (e) => {
    const file = e.target.files[0];

    const reader = new FileReader();
    reader.onload = () => {
        form.img = reader.result;
    };
    reader.readAsDataURL(file);
    };

    const toggleCreateModal = (show) => {
        showCreateModal.value = show;
        form.name = ''
        form.description = '',
        form.img = ''
    }

    const create = async () => {
    form.submit('post', '/portfolio', {
        preserveScroll: true
    })
    toggleCreateModal(false);
    }
</script>

<template>
    <div class="mx-20 my-10">
      <div class="flex justify-between">
        <p class="text-5xl">Portfolio</p>
        <button type="button" @click="toggleCreateModal(true)" class="rounded-full px-16 font-bold bg-gray-300 shadow-lg shadow-gray-300/50 hover:bg-gray-200">Add</button>
      </div>
      <hr class="h-0.5 my-3 border-0 dark:bg-black">
      <div class="overflow-y-auto max-h-[500px]">
            <div v-for="p in portfolio" :key="p.id" class="portfolio-item border border-black rounded-xl flex px-4 p-5 m-2 relative" style="background-color: #09c212;">
                <div class="absolute top-3 right-3">
                    <button class="hover:text-red-500" @click="() => toggleDeleteModal(true, p.id)">X</button>
                </div>
                <img :src="p.img ? p.img : 'https://uploads.dailydot.com/2018/10/olli-the-polite-cat.jpg?auto=compress&fm=pjpg'" alt="" class="w-[150px] h-[100px]">
                <div class="mx-5">
                    <p class="font-bold text-2xl">{{ p.name }}</p>
                    <p class="text-xl">{{ p.description }}</p>
                </div>
            </div>
        </div>
    </div>
    <div v-if="showDeleteModal" id="delete-modal" class="fixed top-0 left-0 flex items-center justify-center w-full h-full bg-black bg-opacity-50">
    <div class="dark:border-gray-700 bg-gray-900 p-8 rounded-lg shadow-lg">
        <h2 class="text-lg font-semibold mb-4 text-white">Confirm Deletion</h2>
        <p class="mb-4 text-white">Are you sure you want to delete this portfolio?</p>
        <div class="flex justify-end">
            <button @click="delPort" class="px-4 py-2 bg-red-600 text-white rounded-lg mr-2 hover:bg-red-900">Yes</button>
            <button @click="toggleDeleteModal(false)" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-400">No</button>
        </div>
    </div>
    </div>
  
    <!-- Main modal -->
    <div v-if="showCreateModal" id="crud-modal" tabindex="-1" aria-hidden="true" class="fixed z-50 inset-0 overflow-y-auto">
      <div class="flex items-center justify-center min-h-screen">
        <div class="bg-white rounded-lg overflow-hidden shadow-xl transform transition-all sm:max-w-lg w-full">
          <div class="bg-gray-50 px-4 py-3 border-b flex justify-between">
            <h3 class="text-lg font-semibold text-gray-900">Create New Product</h3>
            <button @click="toggleCreateModal(false)" type="button" class="text-gray-500 hover:text-gray-700 focus:outline-none focus:text-gray-700">
              <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
              </svg>
            </button>
          </div>
          <form class="p-4" @submit.prevent="create" enctype="multipart/form-data">
            <div class="space-y-4">
              <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                <input required type="text" v-model="form.name" id="name" name="name" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
              </div>
              <div>
                <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                <textarea required id="description" v-model="form.description" name="description" rows="3" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"></textarea>
              </div>
              <div>
                <label for="img" class="block text-sm font-medium text-gray-700">Image</label>
                <input type="file" @change="handleImageChange" id="img" name="img" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
              </div>
            </div>
            <div class="mt-4">
              <button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Create
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </template>