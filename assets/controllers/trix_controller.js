import {Controller} from '@hotwired/stimulus';

/*
* The following line makes this controller "lazy": it won't be downloaded until needed
* See https://github.com/symfony/stimulus-bridge#lazy-controllers
*/
/* stimulusFetch: 'lazy' */
export default class extends Controller {
  static values = {
    allowFileUpload: Boolean, uploadUrl: String
  }

  initialize() {
    this._OnFileAccept = this._OnFileAccept.bind(this);
    this._OnAttachmentAdd = this._OnAttachmentAdd.bind(this);
  }

  connect() {
    this.element.addEventListener('trix-file-accept', this._OnFileAccept);
    this.element.addEventListener('trix-attachment-add', this._OnAttachmentAdd);
  }

  disconnect() {
    this.element.removeEventListener('trix-file-accept', this._OnFileAccept);
    this.element.removeEventListener('trix-attachment-add', this._OnAttachmentAdd);
  }

  _OnFileAccept(event) {
    if (!this.allowFileUploadValue) {
      event.preventDefault();
    }
  }

  _OnAttachmentAdd(event) {
    if (event.attachment.file) {
      const attachment = event.attachment;
      const xhr = new XMLHttpRequest()

      xhr.open("POST", this.uploadUrlValue, true)

      xhr.upload.onprogress = function (event) {
        attachment.setUploadProgress(event.loaded / event.total * 100);
      }

      xhr.onload = function (event) {
        if (xhr.status === 201) {
          const response = JSON.parse(xhr.response);
          attachment.setAttributes({url: response.url, href: response.url});
        }
      };

      const formData = new FormData();
      formData.append('file', attachment.file);
      xhr.send(formData);
    }
  }
}
