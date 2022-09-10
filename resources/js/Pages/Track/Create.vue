<script setup>
import DefaultLayout from "@/Layouts/Default.vue";
import { Inertia } from "@inertiajs/inertia";
import { usePage, useForm, Link, Head } from "@inertiajs/inertia-vue3";
import { Menu, MenuButton, MenuItem, MenuItems } from "@headlessui/vue";
import {
    ChevronRightIcon,
    ChevronDownIcon,
    LinkIcon,
    ExclamationCircleIcon,
} from "@heroicons/vue/20/solid";

const props = defineProps({
    tracks: Object,
});

const form = useForm({
    name: "",
    image: "",
    source: "",
});

const submit = () => {
    // https://inertiajs.com/manual-visits
    form.post(route("track.store"), {
        onSuccess: () => {
            form.reset();
        },
    });
};
</script>

<template>
    <Head title="Add a track" />

    <DefaultLayout>
        <template #headerName> Add track </template>

        <div class="bg-white">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <form
                    class="space-y-8 divide-y divide-gray-200"
                    @submit.prevent="submit"
                >
                    <div class="space-y-8 divide-y divide-gray-200">
                        <div>
                            <div>
                                <h3
                                    class="text-lg font-medium leading-6 text-gray-900"
                                >
                                    Track information
                                </h3>
                            </div>

                            <div
                                class="mt-6 grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6"
                            >
                                <div class="sm:col-span-4">
                                    <div class="flex justify-between">
                                        <label
                                            for="name"
                                            class="block text-sm font-medium text-gray-700"
                                            >Track name</label
                                        >
                                        <span
                                            class="text-sm text-gray-500"
                                            id="name-optional"
                                            >Required</span
                                        >
                                    </div>
                                    <div
                                        class="relative mt-1 rounded-md shadow-sm"
                                    >
                                        <input
                                            type="text"
                                            name="name"
                                            id="name"
                                            :class="[
                                                form.errors.name
                                                    ? 'border-red-300 text-red-900 placeholder-red-300 focus:outline-none focus:ring-red-500 focus:border-red-500'
                                                    : 'border-gray-300 focus:ring-purple-500 focus:border-purple-500',
                                                'block w-full shadow-sm sm:text-sm rounded-md pr-10',
                                            ]"
                                            placeholder="LA Canyons"
                                            aria-invalid="true"
                                            aria-describedby="name-error"
                                        />
                                        <div
                                            class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3"
                                        >
                                            <ExclamationCircleIcon
                                                v-if="form.errors.name"
                                                class="h-5 w-5 text-red-500"
                                                aria-hidden="true"
                                            />
                                        </div>
                                    </div>
                                    <p
                                        class="mt-2 text-sm text-red-600"
                                        id="name-error"
                                        v-if="form.errors.name"
                                    >
                                        {{ form.errors.name }}
                                    </p>
                                </div>
                            </div>

                            <div
                                class="mt-6 grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6"
                            >
                                <div class="sm:col-span-4">
                                    <div class="flex justify-between">
                                        <label
                                            for="source"
                                            class="block text-sm font-medium text-gray-700"
                                            >Track source</label
                                        >
                                        <span
                                            class="text-sm text-gray-500"
                                            id="source-optional"
                                            >Optional</span
                                        >
                                    </div>
                                    <div
                                        class="relative mt-1 rounded-md shadow-sm"
                                    >
                                        <input
                                            type="text"
                                            name="source"
                                            id="source"
                                            :class="[
                                                form.errors.source
                                                    ? 'border-red-300 text-red-900 placeholder-red-300 focus:outline-none focus:ring-red-500 focus:border-red-500'
                                                    : 'border-gray-300 focus:ring-purple-500 focus:border-purple-500',
                                                'block w-full shadow-sm sm:text-sm rounded-md pr-10',
                                            ]"
                                            placeholder="https://www.racedepartment.com/downloads/la-canyons.15067/"
                                            aria-invalid="true"
                                            aria-describedby="source-error"
                                        />
                                        <div
                                            class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3"
                                        >
                                            <ExclamationCircleIcon
                                                v-if="form.errors.source"
                                                class="h-5 w-5 text-red-500"
                                                aria-hidden="true"
                                            />
                                        </div>
                                    </div>
                                    <p
                                        class="mt-2 text-sm text-red-600"
                                        id="source-error"
                                        v-if="form.errors.source"
                                    >
                                        {{ form.errors.source }}
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- <div class="pt-8">
                        <div>
                            <h3
                                class="text-lg font-medium leading-6 text-gray-900"
                            >
                                Edit images
                            </h3>
                            <p class="mt-1 text-sm text-gray-500">
                                Edit ther images so they appear nicely on the
                                website
                            </p>
                        </div>
                        <div
                            class="mt-6 grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6"
                        >
                            <div class="sm:col-span-6">
                                <label
                                    for="cover-photo"
                                    class="block text-sm font-medium text-gray-700"
                                    >Images</label
                                >
                                <div
                                    class="mt-1 flex justify-center rounded-md border-2 border-dashed border-gray-300 px-6 pt-5 pb-6"
                                >
                                    <div class="space-y-1 text-center">
                                        <svg
                                            class="mx-auto h-12 w-12 text-gray-400"
                                            stroke="currentColor"
                                            fill="none"
                                            viewBox="0 0 48 48"
                                            aria-hidden="true"
                                        >
                                            <path
                                                d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02"
                                                stroke-width="2"
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                            />
                                        </svg>
                                        <div class="flex text-sm text-gray-600">
                                            <label
                                                for="file-upload"
                                                class="relative cursor-pointer rounded-md bg-white font-medium text-purple-600 focus-within:outline-none focus-within:ring-2 focus-within:ring-purple-500 focus-within:ring-offset-2 hover:text-purple-500"
                                            >
                                                <span>Upload a file</span>
                                                <input
                                                    id="file-upload"
                                                    name="file-upload"
                                                    type="file"
                                                    class="sr-only"
                                                />
                                            </label>
                                            <p class="pl-1">or drag and drop</p>
                                        </div>
                                        <p class="text-xs text-gray-500">
                                            PNG, JPG, GIF up to 10MB
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> -->
                    </div>

                    <div class="pt-5">
                        <div class="flex justify-end">
                            <button
                                type="button"
                                class="rounded-md border border-gray-300 bg-white py-2 px-4 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2"
                            >
                                Cancel
                            </button>
                            <button
                                type="submit"
                                class="ml-3 inline-flex justify-center rounded-md border border-transparent bg-purple-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2"
                            >
                                Save
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </DefaultLayout>
</template>
