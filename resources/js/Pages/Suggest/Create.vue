<script setup>
import DefaultLayout from "@/Layouts/Default.vue";
import { computed, ref } from "vue";
import { Inertia } from "@inertiajs/inertia";
import { usePage, useForm, Link, Head } from "@inertiajs/inertia-vue3";
import {
    Combobox,
    ComboboxButton,
    ComboboxInput,
    ComboboxLabel,
    ComboboxOption,
    ComboboxOptions,
} from "@headlessui/vue";
import {
    ChevronRightIcon,
    ChevronDownIcon,
    LinkIcon,
    ExclamationCircleIcon,
    CheckIcon,
    ChevronUpDownIcon,
} from "@heroicons/vue/20/solid";

const props = defineProps({
    cars: Object,
    tracks: Object,
});

const carQuery = ref("");
const filteredCar = computed(() =>
    carQuery.value === ""
        ? props.cars
        : props.cars.filter((car) => {
              return car.name
                  .toLowerCase()
                  .includes(carQuery.value.toLowerCase());
          })
);

const trackQuery = ref("");
const filteredTrack = computed(() =>
    trackQuery.value === ""
        ? props.tracks
        : props.tracks.filter((track) => {
              return track.name
                  .toLowerCase()
                  .includes(carQuery.value.toLowerCase());
          })
);

const form = useForm({
    car: "",
    track: "",
});

const submit = () => {
    // https://inertiajs.com/manual-visits
    form.post(route("suggest.store"), {
        onSuccess: () => {
            form.reset();
        },
    });
};
</script>

<template>
    <Head title="Create suggestion" />

    <DefaultLayout>
        <template #headerName> Create suggestion </template>

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
                                    Your suggestion
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
                                            >Car</label
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
                                        <!-- <input
                                            type="text"
                                            name="name"
                                            id="name"
                                            v-model="form.name"
                                            :class="[
                                                form.errors.name
                                                    ? 'border-red-300 text-red-900 placeholder-red-300 focus:outline-none focus:ring-red-500 focus:border-red-500'
                                                    : 'border-gray-300 focus:ring-purple-500 focus:border-purple-500',
                                                'block w-full shadow-sm sm:text-sm rounded-md pr-10',
                                            ]"
                                            placeholder="LA Canyons"
                                            aria-invalid="true"
                                            aria-describedby="name-error"
                                        /> -->
                                        <Combobox as="div" v-model="form.car">
                                            <div class="relative mt-1">
                                                <ComboboxInput
                                                    class="w-full rounded-md border border-gray-300 bg-white py-2 pl-3 pr-10 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-500 sm:text-sm"
                                                    @change="
                                                        carQuery =
                                                            $event.target.value
                                                    "
                                                    :display-value="
                                                        (car) => car?.name
                                                    "
                                                />
                                                <ComboboxButton
                                                    class="absolute inset-y-0 right-0 flex items-center rounded-r-md px-2 focus:outline-none"
                                                >
                                                    <ChevronUpDownIcon
                                                        class="h-5 w-5 text-gray-400"
                                                        aria-hidden="true"
                                                    />
                                                </ComboboxButton>

                                                <ComboboxOptions
                                                    v-if="
                                                        filteredCar.length > 0
                                                    "
                                                    class="absolute z-10 mt-1 max-h-60 w-full overflow-auto rounded-md bg-white py-1 text-base shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none sm:text-sm"
                                                >
                                                    <ComboboxOption
                                                        v-for="car in filteredCar"
                                                        :key="car.id"
                                                        :value="car"
                                                        as="template"
                                                        v-slot="{
                                                            active,
                                                            selected,
                                                        }"
                                                    >
                                                        <li
                                                            :class="[
                                                                'relative cursor-default select-none py-2 pl-3 pr-9',
                                                                active
                                                                    ? 'bg-indigo-600 text-white'
                                                                    : 'text-gray-900',
                                                            ]"
                                                        >
                                                            <span
                                                                :class="[
                                                                    'block truncate',
                                                                    selected &&
                                                                        'font-semibold',
                                                                ]"
                                                            >
                                                                {{ car.name }}
                                                            </span>

                                                            <span
                                                                v-if="selected"
                                                                :class="[
                                                                    'absolute inset-y-0 right-0 flex items-center pr-4',
                                                                    active
                                                                        ? 'text-white'
                                                                        : 'text-indigo-600',
                                                                ]"
                                                            >
                                                                <CheckIcon
                                                                    class="h-5 w-5"
                                                                    aria-hidden="true"
                                                                />
                                                            </span>
                                                        </li>
                                                    </ComboboxOption>
                                                </ComboboxOptions>
                                            </div>
                                        </Combobox>
                                        <div
                                            class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3"
                                        >
                                            <ExclamationCircleIcon
                                                v-if="form.errors.car"
                                                class="h-5 w-5 text-red-500"
                                                aria-hidden="true"
                                            />
                                        </div>
                                    </div>
                                    <p
                                        class="mt-2 text-sm text-red-600"
                                        id="name-error"
                                        v-if="form.errors.car"
                                    >
                                        {{ form.errors.car }}
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
                                            >Track</label
                                        >
                                        <span
                                            class="text-sm text-gray-500"
                                            id="source-optional"
                                            >Required</span
                                        >
                                    </div>
                                    <div
                                        class="relative mt-1 rounded-md shadow-sm"
                                    >
                                        <Combobox as="div" v-model="form.track">
                                            <div class="relative mt-1">
                                                <ComboboxInput
                                                    class="w-full rounded-md border border-gray-300 bg-white py-2 pl-3 pr-10 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-500 sm:text-sm"
                                                    @change="
                                                        trackQuery =
                                                            $event.target.value
                                                    "
                                                    :display-value="
                                                        (track) => track?.name
                                                    "
                                                />
                                                <ComboboxButton
                                                    class="absolute inset-y-0 right-0 flex items-center rounded-r-md px-2 focus:outline-none"
                                                >
                                                    <ChevronUpDownIcon
                                                        class="h-5 w-5 text-gray-400"
                                                        aria-hidden="true"
                                                    />
                                                </ComboboxButton>

                                                <ComboboxOptions
                                                    v-if="
                                                        filteredTrack.length > 0
                                                    "
                                                    class="absolute z-10 mt-1 max-h-60 w-full overflow-auto rounded-md bg-white py-1 text-base shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none sm:text-sm"
                                                >
                                                    <ComboboxOption
                                                        v-for="track in filteredTrack"
                                                        :key="track.id"
                                                        :value="track"
                                                        as="template"
                                                        v-slot="{
                                                            active,
                                                            selected,
                                                        }"
                                                    >
                                                        <li
                                                            :class="[
                                                                'relative cursor-default select-none py-2 pl-3 pr-9',
                                                                active
                                                                    ? 'bg-indigo-600 text-white'
                                                                    : 'text-gray-900',
                                                            ]"
                                                        >
                                                            <span
                                                                :class="[
                                                                    'block truncate',
                                                                    selected &&
                                                                        'font-semibold',
                                                                ]"
                                                            >
                                                                {{ track.name }}
                                                            </span>

                                                            <span
                                                                v-if="selected"
                                                                :class="[
                                                                    'absolute inset-y-0 right-0 flex items-center pr-4',
                                                                    active
                                                                        ? 'text-white'
                                                                        : 'text-indigo-600',
                                                                ]"
                                                            >
                                                                <CheckIcon
                                                                    class="h-5 w-5"
                                                                    aria-hidden="true"
                                                                />
                                                            </span>
                                                        </li>
                                                    </ComboboxOption>
                                                </ComboboxOptions>
                                            </div>
                                        </Combobox>
                                        <div
                                            class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3"
                                        >
                                            <ExclamationCircleIcon
                                                v-if="form.errors.track"
                                                class="h-5 w-5 text-red-500"
                                                aria-hidden="true"
                                            />
                                        </div>
                                    </div>
                                    <p
                                        class="mt-2 text-sm text-red-600"
                                        id="track-error"
                                        v-if="form.errors.track"
                                    >
                                        {{ form.errors.track }}
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
                            <Link
                                :href="route('track.index')"
                                as="button"
                                type="button"
                                class="rounded-md border border-gray-300 bg-white py-2 px-4 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2"
                            >
                                Cancel
                            </Link>
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
