<script setup>
import DefaultLayout from "@/Layouts/Default.vue";
import { Inertia } from "@inertiajs/inertia";
import { usePage, Link, Head } from "@inertiajs/inertia-vue3";
import { Menu, MenuButton, MenuItem, MenuItems } from "@headlessui/vue";
import {
    ChevronRightIcon,
    ChevronDownIcon,
    LinkIcon,
} from "@heroicons/vue/20/solid";

const props = defineProps({
    tracks: Object,
});
</script>

<template>
    <Head title="Tracks" />

    <DefaultLayout>
        <template #headerName> Tracks </template>

        <template #headerButton>
            <span class="ml-3">
                <Link
                    :href="route('track.create')"
                    type="button"
                    class="inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2 focus:ring-offset-gray-50"
                >
                    <LinkIcon
                        class="-ml-1 mr-2 h-5 w-5 text-gray-400"
                        aria-hidden="true"
                    />
                    Add track
                </Link>
            </span>
        </template>
        <!-- Stacked list -->
        <div class="bg-white">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="space-y-12">
                    <ul
                        role="list"
                        class="space-y-12 sm:grid sm:grid-cols-2 sm:gap-x-6 sm:gap-y-12 sm:space-y-0 lg:grid-cols-3 lg:gap-x-8"
                    >
                        <li v-for="track in tracks" :key="track.id">
                            <div class="space-y-4">
                                <div class="aspect-w-3 aspect-h-2">
                                    <img
                                        class="rounded-lg object-cover shadow-lg"
                                        :src="track.image"
                                        alt=""
                                    />
                                </div>

                                <div class="space-y-2">
                                    <div
                                        class="space-y-1 text-lg font-medium leading-6"
                                    >
                                        <h3>{{ track.name }}</h3>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </DefaultLayout>
</template>
