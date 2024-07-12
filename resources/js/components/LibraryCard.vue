<script setup>
import { useI18n } from "vue-i18n";
import { useDetailStore } from "../store/detail";
import router from "../router";
import { storeToRefs } from "pinia";
const { t, locale } = useI18n();
const libraryStore = useDetailStore();
const { librarys, selectedLibrary, loading } = storeToRefs(useDetailStore());
const handleClickDetails = (library) => {
    //   console.log("library", library);
    libraryStore.setSelectedLibrary(library);
    // router.push("/details" :to="{name: 'Category', params: {slug: category.slug }}");
    router.push({ name: "Library", params: { slug: library.slug } });
};
const props = defineProps({
    slug: {
        type: String,
        default: "",
    },
    title: {
        type: String,
        default: "",
    },
    content: {
        type: String,
        default: "",
    },
    src: {
        type: String,
        default: "",
    },
});
</script>
<template>
    <div
        class="text-start flex items-center gap-6 ltr:pr-8 rtl:pl-8 shadow-library rounded-normal"
    >
        <img :src="props.src" />
        <div>
            <p class="text-[#45315D] text-lg font-bold pb-2">
                {{ props.title }}
            </p>
            <p class="text-[#313131] text-sm font-normal pb-1" v-html="props.content" />
            <p
                @click="() => handleClickDetails(props)"
                class="text-[#F36A10] text-sm font-bold underline pb-3 cursor-pointer"
            >
                {{ t("library.readMore") }}
            </p>
            <!-- <div class="wave-container">Content here</div> -->
        </div>
    </div>
</template>
<style>
.wavy-border:before {
    content: "";
    display: block;
    position: absolute;
    top: 0;
    right: 0;
    bottom: 0;
    left: 0;
    /* Creating a wavy pattern using repeating-linear-gradient */
    background: repeating-linear-gradient(
        -45deg,
        #000,
        #000 2px,
        transparent 2px,
        transparent 4px
    );
    /* Apply padding to compensate for the 'border' size */
    padding: 5px;
    /* Allows the pseudo-element to sit behind the content */
    /* z-index: -1; */
}
.wave-container {
    height: 40vh;
    background-color: #20b2aa;
    position: relative;
}

.wave-container::before {
    content: "";
    width: 100%;
    height: 168px;
    position: absolute;
    bottom: -0.3%;
    left: 0;
    background-size: auto;
    background-repeat: repeat no-repeat;
    background-position: 36vw bottom;
    background-image: url("data:image/svg+xml;utf8,<svg viewBox='0 0 1200 134' fill='none' xmlns='http://www.w3.org/2000/svg'><path d='M0 1C19.5523 3 32.2291 5 51.5 9C104.5 19 200 43 300 65C400 88 500 111 600 102C700 93 800 53 900 30C987.526 5 1085.36 -1 1150 0C1169.54 -1 1180.49 0 1200 1V134H1150C1100 134 1000 134 900 134C800 134 700 134 600 134C500 134 400 134 300 134C200 134 100 134 50 134H0V1.98128Z' fill='%23FFF5EE'/></svg>");
}

@media (max-width: 850px) {
    .wave-container::before {
        height: 84px;
    }
}
</style>
