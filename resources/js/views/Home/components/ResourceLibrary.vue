<script setup>
import { ref, onBeforeMount, onMounted, onUnmounted, computed } from "vue";
import { storeToRefs } from "pinia";
import { useI18n } from "vue-i18n";
import { useLibraryStore } from "../../../store/library";
import useLibrary from "@/use/useLibrary";
import { Carousel, Navigation, Slide } from "vue3-carousel";
import "vue3-carousel/dist/carousel.css";
const itemsToShow = ref(3); // Default value

function updateItemsToShow() {
    const width = window.innerWidth;
    if (width >= 1280) {
        // Example breakpoint for "lg"
        itemsToShow.value = 3.5;
    } else {
        itemsToShow.value = 3;
    }
}

// Api composable
const { librarys, selectedLibrary, loading } = storeToRefs(useLibraryStore());
const libraryStore = useLibraryStore();
const { data, isLoading, isLoaded, errors, getApi } = useLibrary();

const loadInitialSettings = async () => {
    // Get initial settings.
    // Single request per page load, so no cache use needed.
    await getApi("library");

    if (data.value.loaded === true) {
        // Initial settings loaded successfully, store them
        // settingsStore.storeSettings(unref(data))
        console.log("success");
    }
};

// On App component mount load initial settings
onBeforeMount(() => {});
onMounted(() => {
    libraryStore.fetch();
    // loadInitialSettings();
    if (loading) {
        console.log("library123", librarys.value);
    }
    // setTimeout

    updateItemsToShow();
    window.addEventListener("resize", updateItemsToShow);
});

onUnmounted(() => {
    window.removeEventListener("resize", updateItemsToShow);
});
console.log("library123", librarys.value);
const slides = ref([
    {
        content: "Slide 1 Content",
        url: "/images/home/carousel1-1.svg",
        btn: "اللإطلاع على المدونة",
    },
    {
        content: "Slide 2 Content",
        url: "/images/home/carousel1-2.svg",
        btn: "اللإطلاع على المدونة",
    },
    {
        content: "Slide 3 Content",
        url: "/images/home/carousel1-3.svg",
        btn: "اللإطلاع على المدونة",
    },
]);
const slide = ref("");
const { t, locale } = useI18n();
const localizedContent = computed(() => {
    return slide.data[locale.value].content;
});
// console.log("librarys", librarys.value);
const localizedTitle = computed(() => {
    return slide.title[locale.value];
});
</script>
<template>
    <div class="max-w-[1440px] mx-auto px-16">
        <div class="pt-32">
            <div class="relative">
                <p
                    class="absolute ltr:left-8 rtl:right-8 top-[3px] text-2xl font-bold text-[#45315D] z-10"
                >
                    {{ t("resourceLibrary.title") }}
                </p>

                <div
                    :class="[
                        ' absolute top-0 w-20 h-10 z-0',
                        locale === 'en'
                            ? 'react-circle-l rounded-tl-full rounded-bl-full left-0 '
                            : 'react-circle-r rounded-tr-full rounded-br-full right-0 ',
                    ]"
                ></div>
            </div>
            <router-link to="/library">
                <p
                    class="text-[#45315D] font-semibold text-base text-end underline"
                >
                    {{ t("home.ourServices.viewAll") }}
                </p>
            </router-link>
        </div>
        <div class="pt-8" v-if="librarys">
            <Carousel :itemsToShow="itemsToShow" :wrapAround="true">
                <Slide v-for="(slide, index) in librarys" :key="index">
                    <div v-if="slide.title[locale]">
                        <div class="rounded-[10px] shadow-3xl">
                            <img
                                class="rounded-tr-[10px] rounded-tl-[10px] w-full"
                                :src="
                                    '/storage/' +
                                    slide.seo.image
                                "
                            />
                            <!-- <p>{{ Object.values(slide.data[locale].image)[0] }}</p> -->
                            <div class="text-start p-3">
                                <div
                                    class="flex rtl:flex-row-reverse gap-2 pb-3"
                                >
                                    <img src="/images/home/ellipse.svg" />
                                    <p>{{ slide.title[locale] }}</p>
                                </div>
                                <p  v-html="slide.data[locale].content" />
                                    <!-- {{ localizedContent }} -->
                                <!-- <p>{{ slide.content }}</p> -->
                            </div>
                            <router-link
                                :to="{
                                    name: 'Library',
                                    params: { slug: slide.slug },
                                }"
                            >
                                <button
                                    :class="[
                                        'w-4/5 h-12 rounded-lg mt-3 mb-4',
                                        locale === 'en'
                                            ? 'button-gradient-l'
                                            : 'button-gradient-r',
                                    ]"
                                >
                                    {{ t("resourceLibrary.btn") }}
                                </button>
                            </router-link>
                        </div>
                    </div>
                </Slide>
                <!-- <template #addons>
            <Navigation />
          </template> -->
                <template #addons>
                    <navigation>
                        <template #next>
                            <img src="/images/home/carousel-arrow-r.svg" />
                        </template>
                        <template #prev>
                            <img src="/images/home/carousel-arrow-l.svg" />
                        </template>
                    </navigation>
                </template>
            </Carousel>
        </div>
    </div>
</template>
<style>
.react-circle-l {
    background-image: linear-gradient(to right, #ff9280, #ff2400);
}
.react-circle-r {
    background-image: linear-gradient(to right, #ff2400, #ff9280);
}
.button-gradient-r {
    background-image: linear-gradient(
        to right,
        #fd3412,
        #fd563b,
        #fa7b66,
        #ff9280
    );
}
.button-gradient-l {
    background-image: linear-gradient(
        to right,
        #ff9280,
        #fa7b66,
        #fd563b,
        #fd3412
    );
}

.carousel__item {
    min-height: 200px;
    width: 100%;
    background-color: var(--vc-clr-primary);
    color: var(--vc-clr-red);
    font-size: 20px;
    border-radius: 8px;
    display: flex;
    justify-content: center;
    align-items: center;
}

.carousel__slide {
    padding: 10px;
}

.carousel__prev,
.carousel__next {
    padding: 20px;
    width: 80px;
    height: 80px;
}
</style>
