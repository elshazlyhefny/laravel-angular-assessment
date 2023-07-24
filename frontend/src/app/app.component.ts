import { Component } from '@angular/core';

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
})
export class AppComponent {
  isMenuCollapsed = true;
  onFilesUploaded() {
    // This function will be called when files are uploaded successfully
    // Implement any additional logic here, if needed
  }
}
