// assets/controllers/product-card_controller.js

import { Controller } from '@hotwired/stimulus';

export default class extends Controller {
    static targets = ["info"];

    connect() {
        console.log("Product card controller connected");
    }

    want(event) {
        event.preventDefault();
        // Implement your logic to add the product to the user's wishlist
        console.log("Added to wishlist");
    }

    toggleInfo(event) {
        event.preventDefault();
        this.infoTarget.classList.toggle("active");
        if (this.infoTarget.classList.contains("active")) {
            this.infoTarget.style.display = 'block';
        } else {
            this.infoTarget.style.display = 'none';
        }
    }
}
