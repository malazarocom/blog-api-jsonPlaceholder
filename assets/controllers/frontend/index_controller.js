 import { Controller } from '@hotwired/stimulus';
import $ from 'jquery';
const InfiniteScroll = require('infinite-scroll');

/* stimulusFetch: 'lazy' */
export default class extends Controller {
    static targets = [
        'cardlist',
        'modal'
    ];
    
    initialize() {
        console.log('hola');
        this.showLoadingHtml = '<div class="mt-5 text-center"><i class="fa fa-3x fa-spinner fa-pulse fa-fw text-orange-pure "></i></div>';
    }
    
    connect() {
        this.loadContent();
    }
    
    loadContent() {
        console.log('funcion:loadContent');
   
          //-------------------------------------//
          // init Infinte Scroll
          let elem = this.cardlistTarget;
          var infScroll = new InfiniteScroll( elem, {
            path: function() {
                let pageNumber = ( this.loadCount + 1 );
                return `/blog/articles/${pageNumber}`;
              },
            append: '.article',
            // disable loading on scroll 
            loadOnScroll: false,
            status: '.page-load-status',
          });
          
          // load next page & enable loading on scroll on button click
          
          var viewMoreButton = elem.querySelector('.view-more-button');
          viewMoreButton.addEventListener( 'click', function() {
            // load next page
            infScroll.loadNextPage();
            // enable loading on scroll
            infScroll.options.loadOnScroll = true;
            // hide page
            button.style.display = 'none';
          });
    }

    launchModal(event) {
        let modalController = this.application.getControllerForElementAndIdentifier(
            this.modalTarget,
            "modal"
        );
        let coHostModalController = this.application.getControllerForElementAndIdentifier(
            this.modalTarget,
            "co-host-modal"
        );
        coHostModalController.setCoHostContent(event.currentTarget.dataset);
        modalController.open();
    }
}
