import { Controller } from 'stimulus';

import * as routing from '../javascripts/routing.js';

export class ApplicationController extends Controller {
  /**
   * Generates a URL from the specified route and parameters.
   *
   * @param {string} route Route.
   * @param {string[]} parameters Parameters.
   */
  generateUrl(route, parameters) {
    return routing.generateUrl(route, parameters);
  }
  
  /**
   * Tells whether the application has the specified route.
   *
   * @param {string} route Route.
   */
  hasRoute(route) {
    return routing.hasRoute(route);
  }

  /**
   * Backported from stimulus 3.
   */
  dispatch(eventName, { target = this.element, detail = {}, prefix = this.identifier, bubbles = true, cancelable = true } = {}) {
    const type = prefix ? `${prefix}:${eventName}` : eventName;
    const event = new CustomEvent(type, { detail, bubbles, cancelable });
    target.dispatchEvent(event);
    return event;
  }
}
