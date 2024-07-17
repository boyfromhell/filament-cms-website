import { http } from "./http";

class ContactService {
    apiUrl = "/send-email";
    sendEmail(value) {
        return http.post(this.apiUrl, {
            value,
        });
    }
    
}

export const contactService = new ContactService();
