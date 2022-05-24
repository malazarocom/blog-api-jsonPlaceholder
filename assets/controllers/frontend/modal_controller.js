import { Controller } from '@hotwired/stimulus';
 
export default class extends Controller {
    static targets = [
        'title', 
        'body',
        'name',
        'username',
        'email',
        'phone',
        'website'
    ];

    setCoHostContent(data) {
        // this.nameTarget.innerHTML = data.name;
        this.titleTarget.innerHTML = data.title;
        // this.emailTarget.href = 'mailto:' + data.email;
        // this.emailTarget.innerHTML = data.email;
    }

    open() {
        document.body.classList.add("modal-open");
        this.element.setAttribute("style", "display: block;");
        this.element.classList.add("show");
        document.body.innerHTML += '<div class="modal-backdrop fade show"></div>';
    }
 
    close() {
        document.body.classList.remove("modal-open");
        this.element.removeAttribute("style");
        this.element.classList.remove("show");
        document.getElementsByClassName("modal-backdrop")[0].remove();
    }
}