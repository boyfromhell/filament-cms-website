import { defineStore } from "pinia";
import { articleService } from "@/services";
import axios from "axios";

export const useArticleStore = defineStore("article", {
    state: () => ({
        selectedArticle: null,
        articleSelected: false,
        articles: [],
        articleFetchError: null,
        loading: false,
    }),
    actions: {
        clear() {
            this.selectedArticle = null;
            this.articleSelected = false;
            this.loading = false;
        },
        setSelectedArticle(payload) {
            console.log(payload.id);
            this.selectedArticle = payload;
            if (payload) {
                this.articleSelected = true;
            } else {
                this.articleSelected = false;
            }
        },

        fetch() {
            
            this.loading = true;
            articleService
                .getList()
                .then((res) => {
                    console.log("LIBRS_OK", res.data.articles)
                    this.articles = res.data.articles;
                })
                .catch((err) => {
                    console.log("LIBRS_ERR")
                    this.articleFetchError = err;
                })
                .finally(() => {
                    this.loading = false;
                });
        },

        fetchLocalData() {
            axios
                .get(`data-sources/pieces.json`, {
                    baseURL: window.location.origin,
                })
                .then((r) => {
                    console.log(r.data);
                    this.pieces = r.data;
                });
        },

        async create(title) {
            this.loading = true;
            try {
                const res = await pieceService.create(title);
                if (res.data.piece) {
                    this.pieces.push(res.data.piece);
                }

                return res.data;
            } catch (error) {
                this.pieceFetchError = error;
                return error;
            } finally {
                this.loading = false;
            }
        },

        async edit(pieceId, title) {
            this.loading = true;
            try {
                const res = await pieceService.edit(pieceId, title);
                const pieceIndex = this.pieces.findIndex(
                    (p) => p.id === pieceId
                );
                this.pieces[pieceIndex] = res.data;
                return true;
            } catch (error) {
                this.pieceFetchError = error;
                return error;
            } finally {
                this.loading = false;
            }
        },
        async delete(pieceId) {
            this.loading = true;
            try {
                await pieceService.delete(pieceId);
                console.log("pieces::", this.pieces, pieceId)
                this.pieces = this.pieces.filter((p) => p.id !== pieceId);
                return true;
            } catch (error) {
                this.pieceFetchError = error;
                return error;
            } finally {
                this.loading = false;
            }
        },
    },
});
