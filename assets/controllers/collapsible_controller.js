
import { Controller } from '@hotwired/stimulus';

export default class extends Controller {
  static targets = ["container"];

  toggle() {
    if (this.containerTarget.classList.contains('visible')) {
      this.containerTarget.classList.remove('visible');
    } else {
      this.containerTarget.classList.add('visible');
    }
  }
}
