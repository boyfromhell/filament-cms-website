import { http } from "./http";

class ArticleService {
    apiUrl = "/article";
    create(title) {
        return http.post(this.apiUrl, {
            title,
        });
    }
    // getList() {
    //   return http.get('/piece-list')
    // }
    getList() {
        return http.get(this.apiUrl + "/");
    }
    // getList() {
    //   return http.get('/prices')
    // }

    addLike(slug, like) {
        console.log('lekfef', slug, like)
        return http.post(this.apiUrl + "/add/" + slug, {
            like,
        });
    }

    getApiWithSlug(slug) {
        return http.get(this.apiUrl + "/" + slug);
    }

    delete(pieceId) {
        return http.delete(this.apiUrl + "/" + pieceId);
    }
}

export const articleService = new ArticleService();
