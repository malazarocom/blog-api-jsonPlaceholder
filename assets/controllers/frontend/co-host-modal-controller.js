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
    
    initialize() {
        console.log("Connected to co-host-modal");
    }

    setCoHostContent(data) {
        this.titleTarget.innerHTML = data.title;
        this.bodyTarget.innerHTML = data.body;
        this.nameTarget.innerHTML = data.name;
        this.usernameTarget.innerHTML = data.username;
        this.emailTarget.href = 'mailto:' + data.email;
        this.emailTarget.innerHTML = data.email;
        this.phoneTarget.innerHTML = data.phone;
        this.websiteTarget.innerHTML = data.website;
    }
}