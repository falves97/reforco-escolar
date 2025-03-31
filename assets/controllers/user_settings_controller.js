import {Controller} from "@hotwired/stimulus";

export default class extends Controller {
  static targets = ['userAvatar', 'avatarInitials', 'inputAvatar'];
  static values = {userAvatarUrl: String, userInitials: String};

  inputAvatarTargetConnected(element) {
    if (element.checked) {
      this.userAvatarUrlValue = element.dataset.userSettingsImageUrlParam;
      this.updateAvatarImage();
    }
  }

  setAvatarImageUrl(event) {
    this.userAvatarUrlValue = event.params.imageUrl;
  }

  updateAvatarImage() {
    if (this.userAvatarUrlValue) {
      this.avatarInitialsTarget.innerHTML = '';
      this.userAvatarTarget.style.backgroundImage = `url(${this.userAvatarUrlValue})`;
    } else {
      this.avatarInitialsTarget.innerHTML = this.userInitialsValue;
      this.userAvatarTarget.style.backgroundImage = '';
      this.userAvatarTarget.style.backgroundImageUrl = '';
    }
  }
}
