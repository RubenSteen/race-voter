<script setup>
import { usePage } from "@inertiajs/inertia-vue3";
import { computed, ref, watch } from "vue";
import {
    CheckCircleIcon,
    ExclamationIcon,
    ExclamationCircleIcon,
} from "@heroicons/vue/24/outline";
import { XIcon } from "@heroicons/vue/20/solid";

const page = usePage();

const showFlash = ref(false);

const flash = computed(function () {
    return page.props.value.flash;
});

watch(
    page.props,
    function (val) {
        if (val?.flash) {
            showFlash.value = true;
        }
    },
    {
        immediate: true,
        deep: true,
    }
);
</script>

<template>
    <div>
        <!-- Succes Message -->
        <div
            aria-live="assertive"
            class="fixed inset-0 flex items-end px-4 py-6 pointer-events-none sm:p-6 sm:items-start"
        >
            <div
                class="w-full flex flex-col items-center space-y-4 sm:items-end"
            >
                <transition
                    enter-active-class="transform ease-out duration-300 transition"
                    enter-from-class="translate-y-2 opacity-0 sm:translate-y-0 sm:translate-x-2"
                    enter-to-class="translate-y-0 opacity-100 sm:translate-x-0"
                    leave-active-class="transition ease-in duration-100"
                    leave-from-class="opacity-100"
                    leave-to-class="opacity-0"
                >
                    <div
                        v-if="showFlash && flash.success"
                        class="max-w-sm w-full bg-white shadow-lg rounded-lg pointer-events-auto ring-1 ring-black ring-opacity-5 overflow-hidden"
                    >
                        <div class="p-4">
                            <div class="flex items-start">
                                <div class="flex-shrink-0">
                                    <CheckCircleIcon
                                        class="h-6 w-6 text-green-400"
                                        aria-hidden="true"
                                    />
                                </div>
                                <div class="ml-3 w-0 flex-1 pt-0.5">
                                    <p
                                        v-if="flash.success.title"
                                        class="text-sm font-medium text-gray-900"
                                    >
                                        {{ flash.success.title }}
                                    </p>
                                    <p
                                        v-if="flash.success.message"
                                        class="mt-1 text-sm text-gray-500"
                                    >
                                        {{ flash.success.message }}
                                    </p>
                                    <p
                                        v-else
                                        class="text-sm font-medium text-gray-900"
                                    >
                                        {{ flash.success }}
                                    </p>
                                </div>
                                <div class="ml-4 flex-shrink-0 flex">
                                    <button
                                        type="button"
                                        @click="showFlash = false"
                                        class="bg-white rounded-md inline-flex text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-cyan-500"
                                    >
                                        <span class="sr-only">Close</span>
                                        <XIcon
                                            class="h-5 w-5"
                                            aria-hidden="true"
                                        />
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </transition>
            </div>
        </div>
        <!-- End Succes Message -->

        <!-- Warning Message -->
        <div
            aria-live="assertive"
            class="fixed inset-0 flex items-end px-4 py-6 pointer-events-none sm:p-6 sm:items-start"
        >
            <div
                class="w-full flex flex-col items-center space-y-4 sm:items-end"
            >
                <transition
                    enter-active-class="transform ease-out duration-300 transition"
                    enter-from-class="translate-y-2 opacity-0 sm:translate-y-0 sm:translate-x-2"
                    enter-to-class="translate-y-0 opacity-100 sm:translate-x-0"
                    leave-active-class="transition ease-in duration-100"
                    leave-from-class="opacity-100"
                    leave-to-class="opacity-0"
                >
                    <div
                        v-if="showFlash && flash.warning"
                        class="max-w-sm w-full bg-white shadow-lg rounded-lg pointer-events-auto ring-1 ring-black ring-opacity-5 overflow-hidden"
                    >
                        <div class="p-4">
                            <div class="flex items-start">
                                <div class="flex-shrink-0">
                                    <ExclamationIcon
                                        class="h-6 w-6 text-yellow-400"
                                        aria-hidden="true"
                                    />
                                </div>
                                <div class="ml-3 w-0 flex-1 pt-0.5">
                                    <p
                                        v-if="flash.warning.title"
                                        class="text-sm font-medium text-gray-900"
                                    >
                                        {{ flash.warning.title }}
                                    </p>
                                    <p
                                        v-if="flash.warning.message"
                                        class="mt-1 text-sm text-gray-500"
                                    >
                                        {{ flash.warning.message }}
                                    </p>
                                    <p
                                        v-else
                                        class="text-sm font-medium text-gray-900"
                                    >
                                        {{ flash.warning }}
                                    </p>
                                </div>
                                <div class="ml-4 flex-shrink-0 flex">
                                    <button
                                        type="button"
                                        @click="showFlash = false"
                                        class="bg-white rounded-md inline-flex text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-cyan-500"
                                    >
                                        <span class="sr-only">Close</span>
                                        <XIcon
                                            class="h-5 w-5"
                                            aria-hidden="true"
                                        />
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </transition>
            </div>
        </div>
        <!-- End Warning Message -->

        <!-- Error Message -->
        <div
            aria-live="assertive"
            class="fixed inset-0 flex items-end px-4 py-6 pointer-events-none sm:p-6 sm:items-start"
        >
            <div
                class="w-full flex flex-col items-center space-y-4 sm:items-end"
            >
                <transition
                    enter-active-class="transform ease-out duration-300 transition"
                    enter-from-class="translate-y-2 opacity-0 sm:translate-y-0 sm:translate-x-2"
                    enter-to-class="translate-y-0 opacity-100 sm:translate-x-0"
                    leave-active-class="transition ease-in duration-100"
                    leave-from-class="opacity-100"
                    leave-to-class="opacity-0"
                >
                    <div
                        v-if="showFlash && flash.error"
                        class="max-w-sm w-full bg-white shadow-lg rounded-lg pointer-events-auto ring-1 ring-black ring-opacity-5 overflow-hidden"
                    >
                        <div class="p-4">
                            <div class="flex items-start">
                                <div class="flex-shrink-0">
                                    <ExclamationCircleIcon
                                        class="h-6 w-6 text-red-400"
                                        aria-hidden="true"
                                    />
                                </div>
                                <div class="ml-3 w-0 flex-1 pt-0.5">
                                    <p
                                        v-if="flash.error.title"
                                        class="text-sm font-medium text-gray-900"
                                    >
                                        {{ flash.error.title }}
                                    </p>
                                    <p
                                        v-if="flash.error.message"
                                        class="mt-1 text-sm text-gray-500"
                                    >
                                        {{ flash.error.message }}
                                    </p>
                                    <p
                                        v-else
                                        class="text-sm font-medium text-gray-900"
                                    >
                                        {{ flash.error }}
                                    </p>
                                </div>
                                <div class="ml-4 flex-shrink-0 flex">
                                    <button
                                        type="button"
                                        @click="showFlash = false"
                                        class="bg-white rounded-md inline-flex text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-cyan-500"
                                    >
                                        <span class="sr-only">Close</span>
                                        <XIcon
                                            class="h-5 w-5"
                                            aria-hidden="true"
                                        />
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </transition>
            </div>
        </div>
        <!-- End Error Message -->

        <!-- Normal Message -->
        <div
            aria-live="assertive"
            class="fixed inset-0 flex items-end px-4 py-6 pointer-events-none sm:p-6 sm:items-start"
        >
            <div
                class="w-full flex flex-col items-center space-y-4 sm:items-end"
            >
                <transition
                    enter-active-class="transform ease-out duration-300 transition"
                    enter-from-class="translate-y-2 opacity-0 sm:translate-y-0 sm:translate-x-2"
                    enter-to-class="translate-y-0 opacity-100 sm:translate-x-0"
                    leave-active-class="transition ease-in duration-100"
                    leave-from-class="opacity-100"
                    leave-to-class="opacity-0"
                >
                    <div
                        v-if="showFlash && flash.message"
                        class="max-w-sm w-full bg-white shadow-lg rounded-lg pointer-events-auto ring-1 ring-black ring-opacity-5 overflow-hidden"
                    >
                        <div class="p-4">
                            <div class="flex items-start">
                                <div class="flex-shrink-0">
                                    <!-- <ChatIcon
                                        class="h-6 w-6 text-cyan-400"
                                        aria-hidden="true"
                                    /> -->
                                </div>
                                <div class="ml-3 w-0 flex-1 pt-0.5">
                                    <p
                                        v-if="flash.message.title"
                                        class="text-sm font-medium text-gray-900"
                                    >
                                        {{ flash.message.title }}
                                    </p>
                                    <p
                                        v-if="flash.message.message"
                                        class="mt-1 text-sm text-gray-500"
                                    >
                                        {{ flash.message.message }}
                                    </p>
                                    <p
                                        v-else
                                        class="text-sm font-medium text-gray-900"
                                    >
                                        {{ flash.message }}
                                    </p>
                                </div>
                                <div class="ml-4 flex-shrink-0 flex">
                                    <button
                                        type="button"
                                        @click="showFlash = false"
                                        class="bg-white rounded-md inline-flex text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-cyan-500"
                                    >
                                        <span class="sr-only">Close</span>
                                        <XIcon
                                            class="h-5 w-5"
                                            aria-hidden="true"
                                        />
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </transition>
            </div>
        </div>
        <!-- End Normal Message -->
    </div>
</template>
