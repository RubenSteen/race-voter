<script setup>
import DefaultLayout from "@/Layouts/Default.vue";
import { Inertia } from "@inertiajs/inertia";
import { usePage, Link, Head } from "@inertiajs/inertia-vue3";
import { ChevronRightIcon } from "@heroicons/vue/20/solid";
import { MegaphoneIcon, XMarkIcon } from "@heroicons/vue/24/outline";

const props = defineProps({
    suggests: Object,
});
</script>

<template>
    <Head title="Suggestions" />

    <DefaultLayout>
        <template #headerName> Suggestions </template>

        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="bg-purple-600">
                <div class="mx-auto max-w-7xl py-3 px-3 sm:px-6 lg:px-8">
                    <div class="flex flex-wrap items-center justify-between">
                        <div class="flex w-0 flex-1 items-center">
                            <span class="flex rounded-lg bg-purple-800 p-2">
                                <MegaphoneIcon
                                    class="h-6 w-6 text-white"
                                    aria-hidden="true"
                                />
                            </span>
                            <p class="ml-3 font-medium text-white">
                                <span
                                    >You've already voted! you can still change
                                    your vote</span
                                >
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-8 flex flex-col">
                <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div
                        class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8"
                    >
                        <div
                            class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg"
                        >
                            <table class="min-w-full divide-y divide-gray-300">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th
                                            scope="col"
                                            class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6"
                                        >
                                            Car
                                        </th>
                                        <th
                                            scope="col"
                                            class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900"
                                        >
                                            Track
                                        </th>
                                        <th
                                            scope="col"
                                            class="relative py-3.5 pl-3 pr-4 sm:pr-6"
                                        >
                                            <span class="sr-only">Vote</span>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody
                                    class="divide-y divide-gray-200 bg-white"
                                >
                                    <tr
                                        v-for="suggest in suggests"
                                        :key="suggest.id"
                                    >
                                        <td
                                            class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6"
                                        >
                                            {{ suggest.car.name }}
                                        </td>
                                        <td
                                            class="whitespace-nowrap px-3 py-4 text-sm"
                                        >
                                            {{ suggest.track.name }}
                                        </td>
                                        <td
                                            class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6"
                                        >
                                            <Link
                                                href="#"
                                                class="text-indigo-600 hover:text-indigo-900"
                                                >Vote<span class="sr-only"
                                                    >, {{ suggest.id }}</span
                                                ></Link
                                            >
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </DefaultLayout>
</template>
