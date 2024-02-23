import { Controller } from '@hotwired/stimulus';

export default class extends Controller {
    static targets = ["menu"];

    

    connect() {
        console.log("Dropdown controller connected");
    }

    toggle(event) {
        if (event.target.tagName === 'A' && event.target.getAttribute('href')) {
            // Allow the default link behavior
            return;
          }
        event.preventDefault();
        this.menuTarget.classList.toggle("active"); // Use "active" to show or hide
    }

    hide(event) {
        if (!this.element.contains(event.target)) {
            this.menuTarget.classList.remove("active"); // Remove "active" to hide
        }
    }
}
