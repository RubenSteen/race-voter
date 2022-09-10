<script setup>
import DefaultLayout from "@/Layouts/Default.vue";
import { Inertia } from "@inertiajs/inertia";
import { usePage, Link, Head } from "@inertiajs/inertia-vue3";
import { ChevronRightIcon } from "@heroicons/vue/20/solid";

const props = defineProps({
    suggests: Object,
});
</script>

<template>
    <Head title="Suggestions" />

    <DefaultLayout>
        <template #headerName> Votes </template>

        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="px-4 sm:px-0">
                <h2 class="text-lg font-medium text-gray-900">
                    People have voted for...
                </h2>
            </div>

            <!-- Stacked list -->
            <ul
                role="list"
                class="mt-5 divide-y divide-gray-200 border-t border-gray-200 sm:mt-0 sm:border-t-0"
            >
                <li v-for="suggest in suggests" :key="suggest.email">
                    <a href="#" class="group block">
                        <div
                            class="flex items-center py-5 px-4 sm:py-6 sm:px-0"
                        >
                            <div class="flex min-w-0 flex-1 px-4">
                                <div class="flex-shrink-0 flex flex-col">
                                    <img
                                        class="h-auto w-32 lg:w-64 group-hover:opacity-75"
                                        :src="suggest.car.image"
                                        alt=""
                                    />
                                    <div>
                                        <p
                                            class="truncate text-sm font-medium text-purple-600 text-base"
                                        >
                                            {{ suggest.car.name }}
                                        </p>
                                    </div>
                                </div>
                                <div
                                    class="min-w-0 flex-1 px-4 md:grid md:grid-cols-2 md:gap-4"
                                >
                                    <div class="flex flex-col">
                                        <div class="flex-shrink-0">
                                            <img
                                                class="h-auto w-32 lg:w-64 group-hover:opacity-75"
                                                :src="suggest.track.image"
                                                alt=""
                                            />
                                        </div>
                                        <div>
                                            <p
                                                class="text-sm font-medium text-purple-600 text-base"
                                            >
                                                {{ suggest.track.name }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <ChevronRightIcon
                                    class="h-5 w-5 text-gray-400 group-hover:text-gray-700"
                                    aria-hidden="true"
                                />
                            </div>
                        </div>
                    </a>
                </li>
            </ul>
        </div>
    </DefaultLayout>
</template>
