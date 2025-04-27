import {Controller} from '@hotwired/stimulus';
import {bootstrap} from "@tabler/core";

/*
* The following line makes this controller "lazy": it won't be downloaded until needed
* See https://github.com/symfony/stimulus-bridge#lazy-controllers
*/
/* stimulusFetch: 'lazy' */
export default class extends Controller {
  static values = {entityId: Number, url: String};

  show(entityId) {
    new bootstrap.Modal(this.element).show();
    this.entityIdValue = entityId;
    this.urlValue = encodeURI(decodeURI(this.urlValue).replace('{id}', this.entityIdValue));
    const form = this.element.querySelector('form');
    form.action = this.urlValue;
  }
}
