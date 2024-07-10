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
  router.push({ name: 'Library', params: { slug: library.slug } });
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
      <p class="text-[#313131] text-sm font-normal pb-1">
        {{ props.content }}
      </p>
      <!-- <p class="text-[#313131] text-sm font-normal pb-1">
        {{ props.content2 }}
      </p> -->
      <p
        @click="() => handleClickDetails(props)"
        class="text-[#F36A10] text-sm font-bold underline pb-3 cursor-pointer"
      >
        {{ t("library.readMore") }}
      </p>
    </div>
  </div>
</template>
